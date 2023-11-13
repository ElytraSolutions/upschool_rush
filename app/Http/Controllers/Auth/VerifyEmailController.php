<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    // public function __invoke(EmailVerificationRequest $request): RedirectResponse
    // {
    //     if ($request->user()->hasVerifiedEmail()) {
    //         return redirect()->intended(
    //             config('app.frontend_url').RouteServiceProvider::HOME.'?verified=1'
    //         );
    //     }

    //     if ($request->user()->markEmailAsVerified()) {
    //         event(new Verified($request->user()));
    //     }

    //     return redirect()->intended(
    //         config('app.frontend_url').RouteServiceProvider::HOME.'?verified=1'
    //     );
    // }
    public function __invoke(Request $request)
    {
        $user =
            User::query()->where("id", $request->route("id"))->first();
        if (!$user || !hash_equals(sha1($user->getEmailForVerification()), (string) $request->route('hash'))) {
            return Response("Invalid URL", Response::HTTP_BAD_REQUEST);
        }

        if ($user->hasVerifiedEmail()) {
            return redirect()->intended(
                config('app.frontend_url') . RouteServiceProvider::HOME . '?verified=1'
            );
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect()->intended(
            config('app.frontend_url') . RouteServiceProvider::HOME . '?verified=1'
        );
    }
}
