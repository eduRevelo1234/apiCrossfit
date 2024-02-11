<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddCorsHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     *@param  \Closure  $next
     * @return mixed
     
     */
    
     public function handle($request, Closure $next)
     {
         // Agrega el encabezado Access-Control-Allow-Origin a la respuesta
         $response = $next($request);
         $response->header('Access-Control-Allow-Origin', '*');
         // Puedes agregar otros encabezados CORS aquí si es necesario
 
         return $response;
     }
}
