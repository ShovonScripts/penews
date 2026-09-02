<?php

namespace App\Http\Middleware;

use App\Models\Redirect;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\Response;

class RedirectMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->isMethod('GET') && !$request->is('admin*') && !$request->is('_debugbar*')) {
            if (Schema::hasTable('redirects')) {
                $path = '/' . ltrim($request->path(), '/');

                $redirect = Redirect::where('old_url', $path)
                    ->where('is_active', true)
                    ->first();

                if ($redirect) {
                    $redirect->increment('hits');
                    return redirect($redirect->new_url, $redirect->status_code);
                }
            }
        }

        return $next($request);
    }
}
