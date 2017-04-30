<?php

namespace App\Exceptions;

use Exception;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof ClientException || $exception instanceof RequestException) {
            $response = $exception->getResponse();
            if (!is_null($response)) {
                $jsonObj = json_decode($exception->getResponse()->getBody());
                $message = isset($jsonObj->error->message) ? $jsonObj->error->message : $jsonObj->message;
                $detail = isset($jsonObj->error->message)? $jsonObj->error->detail : [];
                if(!empty($detail)) {
                    if ($request->ajax())
                        return response()->json(['status' => 'error', 'api_error_message' => $message, 'api_error_detail' => $detail]);
                    return redirect()->back()->withInput($request->input())->with('api_error_message', $message)->with('api_error_detail', $detail);
                } else {
                    if ($request->ajax())
                        return response()->json(['status' => 'error', 'api_error_message' => $message]);
                    return redirect()->back()->withInput($request->input())->with('api_error_message', $message);
                }
            } else {
                if ($request->ajax())
                    return response()->json(['status' => 'error', 'api_error_message' => $exception->getMessage()]);
                return redirect()->back()->withInput($request->input())->with('api_error_message', $exception->getMessage());
            }
        } else {
            if(!$exception instanceof  \Illuminate\Validation\ValidationException) {
                if ($request->ajax())
                    return response()->json(['status' => 'error', 'api_error_message' => $exception->getMessage()]);
                return redirect()->back()->withInput($request->input())->with('api_error_message', $exception->getMessage());
            }
        }

        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest('login');
    }
}
