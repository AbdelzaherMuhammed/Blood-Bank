<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Arr;
use Request;
use Illuminate\Auth\AuthenticationException;
use Response;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
     * Report or log an exception.
     *
     * @param \Exception $exception
     * @return void
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into a response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Auth\AuthenticationException $exception
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->is('api/*')){

           return responseJson(0, 'Unauthenticated.');
        }

        $guard = Arr::get($exception->guards() , 0);
        switch ($guard)
        {
            case 'client-web' :
                $login = 'client-login';
                break;

            default :
                $login = 'login';
                break;
        }

        return redirect()->guest(route($login));



    }
}

/*$class = get_class($exception);
switch ($class) {
    case 'Illuminate\Auth\AuthenticationException':
        $guard = Arr::get($exception->guards(), 0);
        switch ($guard) {
            case 'client-web' :
                return redirect(route('client-login'));
                break;
            default:
                return redirect('login');
                break;
        }
}


