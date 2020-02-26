<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Requests\Api\AccountRequest;
use App\Http\Requests\Api\PasswordRequest;
use App\Http\Requests\Api\CompanyRequest;
use App\Http\Resources\UserResource;
use App\Models\Backend\Company;
use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Регистрация нового пользователя
     *
     * @param RegisterRequest $request
     * @param User $user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request, User $user)
    {
        $user->create([
            'name' => $request->get('name'),
            'lastName' => $request->get('lastName'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'password' => bcrypt($request->get('password'))
        ]);

        return response()->json([
            'status' => 'success'
        ], 200);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        if (!$token = JWTAuth::attempt($request->only(['email', 'password']))) {
            return response()->json([
                'status' => 'error',
                'error' => 'invalid.credentials',
                'msg' => 'Invalid Credentials.'
            ], 401);
        }

        return response()
            ->json([
                'status' => 'success',
                'token' => $token,
                'user' => new UserResource(User::where('id', auth()->user()->getAuthIdentifier())->first())
            ], 200);

    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function user()
    {
        $user = User::where('id', auth()->user()->getAuthIdentifier())->first();

        return new UserResource($user);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        JWTAuth::invalidate();

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out'
        ], 200);
    }

    /**
     * Refresh JWT token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        if ($token = JWTAuth::refresh()) {
            return response()
                ->json(['status' => 'success'], 200)
                ->header('Authorization', $token);
        }
        return response()->json(['error' => 'refresh_token_error'], 401);
    }

    /**
     * Изменение учетной записи
     *
     * @param AccountRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function editAccount(AccountRequest $request)
    {
        $user = User::where('id', auth()->user()->getAuthIdentifier())->first();

        $user->update([
            'name' => $request->get('name'),
            'lastName' => $request->get('lastName'),
            'phone' => $request->get('phone')
        ]);

        if ($user->email !== $request->get('email')) {
            $isEmail = User::where('email', $request->get('email'))->first();
            if (!$isEmail) {
                $user->update(['email' => $request->get('email')]);

                return response()->json([
                    'status' => 'success',
                    'user' => new UserResource(User::where('id', auth()->user()->getAuthIdentifier())->first())
                ], 200);
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Такой email уже существует!'
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'user' => new UserResource(User::where('id', auth()->user()->getAuthIdentifier())->first())
        ], 200);
    }

    /**
     * Изменение пароля
     *
     * @param PasswordRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function editPassword(PasswordRequest $request)
    {
        $user = User::where('id', auth()->user()->getAuthIdentifier())->first();

        $user->update([
            'password' => bcrypt($request->get('password'))
        ]);

        return response()->json([
            'status' => 'success'
        ], 200);
    }

    /**
     * Изменение компании
     *
     * @param CompanyRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function editCompany(CompanyRequest $request)
    {
        $user = User::where('id', auth()->user()->getAuthIdentifier())->first();

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

        return response()->json([
            'status' => 'success'
        ], 200);
    }
}
