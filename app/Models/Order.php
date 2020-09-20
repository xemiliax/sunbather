<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    //
        protected $fillable = [
            'product_id', 'user_id'
        ];
     
     
        /**
         *  "0": "Reserva",
         *  "1": "Aguardando Pagamento",
         *  "2": "Pago",
         *  "3": "Expirado",
         *  "4": "Cancelado"
        */
        public function user()
        {
            return $this->belongsTo(\App\User::class);
        }
     
        public function customer()
        {
            return $this->belongsTo(\App\User::class, 'user_id');
        }
     
       public function product()
        {
            return $this->belongsTo(Product::class);
        }
     
               
            
        public static function getStatus($status) {
            switch($status){
                case 0 :return "Reserva";
                case 1 :return "Aguardando Pagamento";
                case 2 :return "Pago";
                case 3 :return "Expirado";
                case 4 :return "Cancelado";
            }
        }
     
        public function getValueBrowseAttribute()
        {
            return 'R$ ' . number_format($this->value / 100, 2, ',', '.');
        }
     
        public function getValueReadAttribute()
        {
            return 'R$ ' . number_format($this->value / 100, 2, ',', '.');
        }
     
        public function getOriginalvalueReadAttribute()
        {
            return 'R$ ' . number_format($this->originalvalue / 100, 2, ',', '.');
        }
     
}
