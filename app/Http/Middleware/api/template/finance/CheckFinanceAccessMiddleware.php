<?php

namespace App\Http\Middleware\api\template\epi;

use App\Enums\RoleEnum;
use App\Models\FinanceUser;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckFinanceAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $paramId = $request->route('id');
        $userId = $paramId ? $paramId : $request->id;
        $user = FinanceUser::find($userId);
        $role_id = $user->role_id;

        // 1. It is super user do not allow access
        if ($role_id == RoleEnum::epi_super->value || $request->user()->id == $userId) {
            return response()->json([
                'message' => __('app_translation.unauthorized'),
            ], 403, [], JSON_UNESCAPED_UNICODE);
        }
        $request->attributes->set('validatedUser', $user);
        return $next($request);
    }
}
