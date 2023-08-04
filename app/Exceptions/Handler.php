<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ValidationException) {
            return new JsonResponse([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $exception->errors(),
            ], Response::HTTP_BAD_REQUEST);
        }

        if (config('app.debug')) {
            return parent::render($request, $exception);
        }

        return new JsonResponse([
            'status' => 'error',
            'message' => 'Internal Server Error',
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }


    public function report(Throwable $exception)
    {
        if ($this->shouldReport($exception)) {
            $logEntry = new ErrorLog();
            $logEntry->request_id = request()->request_id;
            $logEntry->error_type = get_class($exception);
            $logEntry->error_message = $exception->getMessage();
            $logEntry->error_trace = $exception->getTraceAsString();
            $logEntry->save();

            Log::error($exception);
        }
    }
}
