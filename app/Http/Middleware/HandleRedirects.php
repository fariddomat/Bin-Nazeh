<?php

namespace App\Http\Middleware;

use App\Models\Redirect;
use Illuminate\Support\Facades\Redirect as FacadeRedirect;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HandleRedirects
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $currentUrl = $request->path();
        $redirect = Redirect::where('source_url', $currentUrl)->first();
        // dd($redirect);
        if ($redirect) {
            return FacadeRedirect::to($redirect->destination_url, $redirect->status_code);
        }

        return $next($request);
    }
}
