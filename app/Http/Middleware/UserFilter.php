<?php

namespace App\Http\Middleware;

use App\Models\Collection;
use Closure;
use Illuminate\Http\Request;

class UserFilter extends Middleware
{
    /**
     * Filter Resources for the authenticated User
     * // TO DO
     */
    protected function handle(Request $request, Closure $next): ?string
    {
        $user = $request->user();

        if ($user) {
            $data = Collection::where('user_id', $user->id)->get();
            $request->merge(['filtered_data' => $data]);
        }

        return $next($request);
    }
}
