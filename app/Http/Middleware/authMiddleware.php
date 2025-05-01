<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class authMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $isEmailPresent = $request->session()->get('currentUserEmail');
        $isUserRolePresent = $request->session()->get('currentUserRole');
        $userId = $request->session()->get('userId');

        // var_dump($isUserRolePresent);
        // var_dump($userId); exit;

        if ($isEmailPresent && $isUserRolePresent == 'admin') {
            return redirect('/admin');
        }
        if ($isEmailPresent && $isUserRolePresent == 'user') {
            // return redirect('/userHome');
            return redirect()->route('userHome.show', $userId);
        }

        return $next($request);
    }
}
