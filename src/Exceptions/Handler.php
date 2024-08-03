<?php

namespace Happynessarl\Caching\Management\Exceptions;

use Request;
use Throwable;
use PDOException;
use Illuminate\Support\Arr;
use Psr\Log\LoggerInterface;
use Happynessarl\Caching\Management\Http\ApiResponse;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**@author Frederick Dikaprio <freedikaprio@email.com> */
class Handler extends ExceptionHandler
{
    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(
            function (Throwable $e) {
                try {
                    $logger = $this->container->make(LoggerInterface::class);
                } catch (\Exception $e) {
                    throw $e;
                }

                $response = $this->render(app()->request, $e);

                $logger->error(
                    $e->getMessage(),
                    array_merge(
                        $this->exceptionContext($e),
                        $this->context(),
                        ['exception' => $e, 'response' => $response]
                    )
                );

                return false;
            }
        );
    }

    /**
     * @inheritDoc
     */
    public function render($request, Throwable $e)
    {
        if (empty($e)) {
            return parent::render($request, $e);
        }

        if ($e instanceof BaseException) {
            return $e->render($request);
        }

        $status = method_exists($e, 'getStatusCode')
            ? $e->getStatusCode()
            : HttpResponse::HTTP_INTERNAL_SERVER_ERROR;
        $extra = (!config('app.debug'))
            ? [] :
            [
                'exception' => [
                    'name' => get_class($e),
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => collect($e->getTrace())->map(
                        function ($trace) {
                            return Arr::except($trace, ['args']);
                        }
                    )->all()
                ],

            ];

        if ($e instanceof PDOException) {
            return ApiResponse::error(
                'Internal database error',
                HttpResponse::HTTP_INTERNAL_SERVER_ERROR,
                $extra
            );
        }

        if ($e instanceof NotFoundHttpException) {
            return ApiResponse::error(
                'The specified URL cannot be found',
                HttpResponse::HTTP_NOT_FOUND,
                $extra
            );
        }


        if ($this->isHttpException($e)) {
            return ApiResponse::error('Request error', $status, $extra);
        }

        return ApiResponse::error('Technical error. Try later', $status, $extra);
    }
}
