<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use OpenAdmin\Admin\Controllers\AuthController as BaseAuthController;
use OpenAdmin\Admin\Facades\Admin;

class AuthController extends BaseAuthController
{
    /**
     * @var string
     */
    protected $loginView = 'admin.adminLogin';

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    protected function username()
    {
        return 'email';
    }

    /**
     * Handle a login request.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function postLogin(Request $request)
    {
        $rate_limit_key = 'login-tries-'.Admin::guardName();

        $this->loginValidator($request->all())->validate();

        $credentials = $request->only([$this->username(), 'password']);
        $credentials = array_merge($credentials, ['is_admin' => 1]);
        $remember    = $request->get('remember', false);

        if ($this->guard()->attempt($credentials, $remember) && Auth::guard('web')->attempt($credentials, $remember)) {
            RateLimiter::clear($rate_limit_key);
            return $this->sendLoginResponse($request);
        }

        if (config('admin.auth.throttle_logins')) {
            $throttle_timeout = config('admin.auth.throttle_timeout', 600);
            RateLimiter::hit($rate_limit_key, $throttle_timeout);
        }

        return back()->withInput()->withErrors([
            $this->username() => $this->getFailedLoginMessage(),
        ]);
    }

}
