<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckDisableUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //controllo se utente ha fatto il login
        if(Auth::check()){
            //ottengo informazioni del utente autenticato
            $user = Auth::user();
            //se lo status di utente è false (disattivato)
            if($user->status == false){
                //forza logout
                Auth::logout();
                //invalidare la sessione e rigenerare il token
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect("/?errorMessage=" .  urlencode("Il tuo account è stato disattivato. Conttatta l'amministratore del sistema."));
            }
        }

        return $next($request);
    }
}
