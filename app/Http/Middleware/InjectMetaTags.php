<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InjectMetaTags
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $metaTag = \App\Models\MetaTag::where('page_route', $request->path())->first();

        if ($metaTag) {
            view()->share('metaTitle', $metaTag->meta_title);
            view()->share('metaDescription', $metaTag->meta_description);
            view()->share('metaTag', $metaTag);
        }
        return $next($request);
    }
}
