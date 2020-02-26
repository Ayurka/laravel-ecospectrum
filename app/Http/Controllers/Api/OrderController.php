<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OrderRequest;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
use App\Models\Backend\Company;
use App\Models\Backend\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * @param OrderRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(OrderRequest $request)
    {
        $user = User::where('id', auth()->user()->getAuthIdentifier())->first();

        DB::transaction(function () use ($user, $request) {

            $this->saveCompany($user, $request);

            $order = $this->saveOrder($user, $request);

            $result = [];
            foreach($request->get('products') as $item){
                $result[$item['id']] = ['quantity' => $item['quantity']];
            }
            $order->products()->sync($result);
        });

        return response()->json([
            'status' => 'success'
        ], 200);

    }

    /**
     * Создаем заказ
     *
     * @param $user
     * @param $request
     *
     * @return Order
     */
    public function saveOrder($user, $request)
    {
        return $user->orders()->create([
            'quantity' => $request->get('quantity'),
            'total' => $request->get('total'),
            'delivery_address' => 'asfadsfad',
            'status' => Order::STATUS[1]
        ]);
    }

    /**
     * Создаем или обновляем реквизиты компании
     *
     * @param $user
     * @param $request
     *
     * @return void
     */
    public function saveCompany($user, $request)
    {
        Company::updateOrCreate(
            ['user_id' => $user->id],
            [
                'nameCompany' => $request->get('nameCompany'),
                'address' => $request->get('address'),
                'inn' => $request->get('inn'),
                'kpp' => $request->get('kpp'),
                'nameBank' => $request->get('nameBank'),
                'bik' => $request->get('bik'),
                'paymentAccount' => $request->get('paymentAccount'),
                'correlationAccount' => $request->get('correlationAccount')
            ]);
    }

    /**
     * Получаем заказы текущего пользователя
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function orders()
    {
        $user = User::where('id', auth()->user()->getAuthIdentifier())->first();
        return OrderResource::collection($user->orders);
    }

    /**
     * Получаем заказ текущего пользователя
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function order(Request $request)
    {
        $user = User::where('id', auth()->user()->getAuthIdentifier())->first();
        return new OrderResource($user->order($request->id));
    }
}
