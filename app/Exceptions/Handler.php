<?php

namespace App\Exceptions;

use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
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
        $this->reportable(function (Throwable $e) {
        });
        $this->renderable(function (Throwable $e, $request) {
            if ($e instanceof ValidationException) {
                // dd($e);
                return redirect()->route($request->route()->getName())->with('toast', $e->errorBag);
                // dd($e->errorBag);
            }
            if ($e instanceof HttpExceptionInterface) {
                switch ($e->getStatusCode()) {
                    case 404:
                        return redirect('errors/notfound',302);
                        break;
                    default:
                        break;
                }
            }

            // if ($e instanceof QueryException){
            //     return redirect()->route('error',['error'=>'query']);
            // }
        });
    }
}
