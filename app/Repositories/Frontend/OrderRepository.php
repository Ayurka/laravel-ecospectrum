<?php

namespace App\Repositories\Frontend;

use App\Models\Backend\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderRepository
{
    /**
     * Сохраняем заказ
     *
     * @param Request $request
     * @param User $user
     * @return void
     */
    public function create(Request $request, User $user)
    {
        DB::transaction(function () use ($request, $user) {

            $order = $user->orders()->create([
                'quantity' => $request->get('quantity'),
                'total' => $request->get('total'),
                'status' => Order::STATUS[1]
            ]);

            $result = [];
            foreach($request->get('products') as $item){
                $result[$item['id']] = ['quantity' => $item['quantity']];
            }

            $order->products()->sync($result);
        });
    }
}
