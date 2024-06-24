<?php

namespace App\Http\Middleware;

use App\Actions\Jwt\TokenDecode;
use App\Exceptions\Auth\JwtException;
use App\Exceptions\UserException;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JwtMiddleware
{
    public function __construct(
        private TokenDecode $tokenDecode,
    ) {
    }

    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     * @throws JwtException|UserException
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        if ( ! $token) {
            throw JwtException::missingToken();
        }

        $decodedToken = $this->tokenDecode->handle($token);

        $user = User::whereUuid($decodedToken['sub'])->first();

        if ( ! $user) {
            throw UserException::notFound();
        }

        // update last used at for this token
        $user->tokens()->where('unique_id', $decodedToken['jti'])->update([
            'last_used_at' => now(),
        ]);

        $request->setUserResolver(function () use ($user) {
            return $user;
        });

        return $next($request);
    }
}
