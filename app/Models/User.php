<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends \TCG\Voyager\Models\User
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     * 
     * front-end deve conter 3 telas 
     * simples para exibição reativa dos dados
     * (Dashboard, Pedidos e Clientes)
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',

    ];
    
 public function reservations()
   {
       return $this->hasMany(\App\Models\Order::class)->where('orders.status', '0');
   }

   public function purchases()
   {
       return $this->hasMany(\App\Models\Order::class)->where('orders.status', '1');
   }

   public function expirations()
   {
       return $this->hasMany(\App\Models\Order::class)->where('orders.status', 2);
   }

   public function orders()
   {
       return $this->hasMany(\App\Models\Order::class);
   } 
}   


