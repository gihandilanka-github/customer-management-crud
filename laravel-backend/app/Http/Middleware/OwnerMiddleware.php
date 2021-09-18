<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class OwnerMiddleware
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $model)
    {
        $model = 'App\Model\User';
        $model::where('id', $this->auth->getUser()->id)->first();

        if ($model->created_by !== $this->auth->getUser()->id) {
            return response()->json([ 'error'=> 403, 'message'=> 'Unauthorized action.' ], 403);
        }

        return $next($request);
    }
}
