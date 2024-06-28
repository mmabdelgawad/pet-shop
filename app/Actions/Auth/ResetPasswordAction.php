<?php

namespace App\Actions\Auth;

use App\Exceptions\PasswordResetException;
use App\Http\Requests\Api\Auth\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use stdClass;

class ResetPasswordAction
{
    /**
     * @param ResetPasswordRequest $request
     * @return void
     * @throws PasswordResetException
     */
    public function handle(ResetPasswordRequest $request): void
    {
        /** @var stdClass|null $passwordReset */
        $passwordReset = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if ( ! $passwordReset) {
            throw PasswordResetException::invalidToken();
        }

        /** @var User $user */
        $user = User::firstWhere('email', $passwordReset->email);

        $user->update([
            'password' => bcrypt($request->password),
        ]);

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();
    }
}
