<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OrderRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
use App\Models\Backend\Company;
use App\Repositories\Frontend\AuthRepository;
use App\Repositories\Frontend\OrderRepository;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Создаем пользователя и заказ
     *
     * @param Request $request
     * @param OrderRepository $orderRepository
     * @param AuthRepository $authRepository
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeGuest(Request $request, OrderRepository $orderRepository, AuthRepository $authRepository)
    {
        $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890!$%^&!$%^&');
        $password = substr($random, 0, 6);
        $request->merge(['password' => $password]);

        $user = $authRepository->storeUserAndCompany($request);

        $orderRepository->create($request, $user);

        return response()->json([
            'status' => 'success',
            'password' => $password
        ], 201);
    }

    /**
     * Создаем заказ
     *
     * @param Request $request
     * @param OrderRepository $orderRepository
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeAuth(Request $request, OrderRepository $orderRepository)
    {
        $user = User::where('id', auth()->user()->getAuthIdentifier())->first();

        $orderRepository->create($request, $user);

        return response()->json([
            'status' => 'success',
        ], 201);
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
                'kpp' => $request->get('kpp')
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

    public function createPDF()
    {
        $data = [
            'title' => 'First PDF for Medium',
            'heading' => 'Hello from 99Points. Информация',
            'content' => 'Lorem Ipsum - просто фиктивный текст индустрии печати и набора текста.'
        ];

        return PDF::loadView('pdf_view', $data)->save(public_path() . '/my_stored_file.pdf')->stream('download.pdf');
    }
}
