<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Auth;
use DB;
use Illuminate\Http\Request;
use Log;
use TCG\Voyager\Facades\Voyager;

class HomeController extends Controller
{
   /**
    * Create a new controller instance.
    *
    * @return void
    */
   public function __construct()
   {
       $this->middleware('auth');
   }

   function rand_color() {
       return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
   }

   public function index(Request $request)
   {
       $roles = DB::table('user_roles')
                   ->where('user_id', Auth::user()->id)
                   ->where(function ($query) {
                       $query->where('role_id', '=', 1)
                             ->orWhere('role_id', '=', 5);
                   })->first();
       if(!$roles) {
           if(Auth::user()->role_id != 1)
           die;
       }

       $userCount = \App\User::select(DB::raw('*'))->whereRaw('Date(created_at) = CURDATE()')->count();
      
             return view('admin.home.index', compact(
        'userCount'
 ));
      }
}