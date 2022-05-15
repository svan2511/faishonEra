<?php

namespace App\Http\Middleware;

use App\Models\Category;
use Closure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class PassDataToAllViews
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $userData = getUserSessionStatus( $request );
        $cart_details = DB::table('cart')
        ->where('user_id',  $userData['user_id'])
        ->where('user_type',  $userData['user_type'])
        ->count();
      // echo $cart_details;die;
        $categories = Category::with('subCategory')->get();
        
        View::share(['categories'=> $categories , 'cart_details' => $cart_details]);

        return $next($request);
    }
}
