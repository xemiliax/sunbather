<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/* O recurso de "pedidos" deve conter:

    Data do pedido
    Status do pedido
    Cliente correlacionado do pedido
    Valor do pedido */ 

class OrdersController extends Controller
{
    public function getOrders(Resquest $request)
    {

        try {
        
        $orders = \App\Models\Order::where('orders.status')
        ->join('users', 'users_id', '=' , 'orders.user_id')
        ->join('products', 'products.id', '=', 'orders.product_id')
        ->select([
            'orders.id',
            'users.name as user',
            'users.email',
            'products.name as product',
            'products.value',
            'orders.product_id',
            'orders.user_id',
        ])->get();


    return response($orders, 200)->header('Content-Type', 'application/json');
       } catch (\Exception $e) {
           $result = [
               'code' => '8000',
               'message' => 'Não foi possível completar a solicitação',
               'error' => $e->getMessage(),
           ];
           Log::error('OrdersController.index', $result);
           return response($result, 500)->header('Content-Type', 'application/json');
       }
    } 

   public function cancelOrder(Request $request, $orderId)
   {
       try {

           $order = \App\Models\Order::select()->where('id', $orderId)
               ->where('status', '!=', '2')
               ->first();
           $order->status = 4;
           $order->save();
           return response(['success' => true], 201)->header('Content-Type', 'application/json');
       } catch (\Exception $e) {
           $result = [
               'code' => '8001',
               'message' => 'Não foi possível completar a solicitação',
               'error' => $e->getMessage(),
           ];
           Log::error('UserController.get', $result);
           return response($result, 500)->header('Content-Type', 'application/json');
       }
   }
}



