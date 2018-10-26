<?php

namespace App\Http\Middleware;

use Closure;

class CheckOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $model = $request->route()->parameters();

        // check if owner of the model
        if(array_values($model)[0]->user_id == auth()->user()->id)
        {
            return $next($request);
        } elseif(auth()->user()->hasPermissionTo('edit_' . key($model) . 's')){ // check if can edit model
            return $next($request);
        } else {
            return redirect('/dashboard');
        }
    }
}
