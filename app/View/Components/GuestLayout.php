<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class GuestLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        if ( request()->route()->getAction("controller") == "Laravel\Fortify\Http\Controllers\AuthenticatedSessionController@create" )
        {
           $title = "Login Form";
        }
        else
        {
            $title = "Registration Form";
        }
        return view('layouts.guest',['title'=>$title]);
    }
}
