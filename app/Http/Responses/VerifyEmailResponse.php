<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use Laravel\Fortify\Contracts\VerifyEmailResponse as VerifyEmailResponseContract;
use Laravel\Fortify\Fortify;

class VerifyEmailResponse implements VerifyEmailResponseContract
{
    public function toResponse($request)
    {
        return $request->wantsJson()
            ? new JsonResponse(['success'=>'true','redirectBackURL' => redirect()->intended()->getTargetUrl()])
            : redirect()->intended(Fortify::redirects('register'));
    }
}