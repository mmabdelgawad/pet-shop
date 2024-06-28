<?php

namespace App\Actions\Auth;

use App\Exceptions\UserException;
use App\Http\Requests\Api\Auth\ForgotPasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ForgotPasswordAction
{
    /**
     * @param ForgotPasswordRequest $request
     * @return string
     * @throws UserException
     */
    public function handle(ForgotPasswordRequest $request): string
    {
        $user = User::firstWhere('email', $request->email);

        if ( ! $user) {
            throw UserException::notFound();
        }

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        $token = Str::random(60);
        DB::table('password_reset_tokens')->insert(['email' => $request->email, 'token' => $token, 'created_at' => now()]);

        return $token;
    }
}
