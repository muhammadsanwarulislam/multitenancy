<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Controllers\JsonResponseTrait;
use Symfony\Component\HttpFoundation\Response;

class CheckRequestValidation
{
    use JsonResponseTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $domain = str_replace(['https://','http://',':3000'], '', $request->headers->get('Origin'));
        if (!$domain) {
            return $this->badJsonResponse('Domain name is required');
        }
        return $next($request);
    }
}
