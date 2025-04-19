<?php

namespace App\Http\Middleware\api\template\finance\sub;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class FinanceHasSubAddPermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $permission = null, $subPermission = null): Response
    {
        $authUser = $request->user();
        if ($authUser) {
            // 1. Check user has user permission
            $permission = DB::table("finance_permissions as fp")
                ->where("finance_user_id", "=", $authUser->id)
                ->where("permission", $permission)
                ->join("finance_permission_subs as fps", function ($join) use ($subPermission) {
                    return $join->on('fps.finance_permission_id', '=', 'fp.id')
                        ->where('fps.sub_permission_id', $subPermission)
                        ->where('fps.add', true);
                })->select("fps.id")->first();

            if ($permission) {
                return $next($request);
            }
        }
        return response()->json([
            'message' => __('app_translation.unauthorized'),
        ], 403, [], JSON_UNESCAPED_UNICODE);
    }
}
