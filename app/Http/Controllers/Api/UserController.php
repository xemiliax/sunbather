<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;
use DB;

class UserController extends Controller
{

   public function get(Request $request)
   {
       try {
           $userLogged = Auth::user();
           $user = $this->formateduser($userLogged);

           return response($user, 200)->header('Content-Type', 'application/json');
       } catch (\Exception $e) {
           $result = [
               'code' => '7000',
               'message' => 'Não foi possível completar a solicitação',
               'error' => $e->getMessage(),
           ];
           Log::error('UserController.get', $result);
           return response($result, 500)->header('Content-Type', 'application/json');
       }
   }

   protected function formateduser($userLogged){
    $user = new User();
    $user->name = $userLogged->name;
    $user->email = $userLogged->email;
    $user->settings = $userLogged->settings;
    $user->city_id = $userLogged->city_id;
    
    if ($userLogged -> city_id)
    {
    $user -> city = \App\Models\City::where('id', $userLogged -> city_id)
          ->first();
    } else {
        $user -> city = 'Nenhuma cidade cadastrada';
    }

    return $user; 
        
}


}


/* O recurso de "clientes" deve conter:

Primeiro nome
Último nome
E-mail */ 