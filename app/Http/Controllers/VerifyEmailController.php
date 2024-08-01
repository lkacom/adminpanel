<?php
namespace App\Http\Controllers;

use Illuminate\Auth\Events\Verified;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Exceptions\InvalidSignatureException;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\VerifyEmailResponse;

class VerifyEmailController extends Controller
{

    public function store(Request $request)
    {

        $user = Auth::user();

        if($user->hasVerifiedEmail())
            return app(VerifyEmailResponse::class);

        if(!$user->hasVerifiedEmail() && $user->verification_code === $request->code){
            if ($user->markEmailAsVerified()) {
                event(new Verified($user));
            }
            return app(VerifyEmailResponse::class);
        }
        return $request->wantsJson() ? new JsonResponse('', 400) : throw new InvalidSignatureException;
    }
}
