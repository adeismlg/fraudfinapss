<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureUserHasCompany
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if (!$user->company) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
