<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\InnException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Requests\Api\AccountRequest;
use App\Http\Requests\Api\PasswordRequest;
use App\Http\Requests\Api\CompanyRequest;
use App\Http\Resources\UserResource;
use App\Models\Backend\Company;
use App\Models\Backend\Individual;
use App\Models\Backend\LegalEntity;
use App\Repositories\Frontend\AuthRepository;
use App\User;
use Fomvasss\Dadata\Facades\DadataSuggest;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\JWTAuth;

class AuthController extends Controller
{
    private $company;
    /**
     * @var JWTAuth
     */
    private $auth;

    /**
     * AuthController constructor.
     * @param JWTAuth $JWTAuth
     */
    public function __construct(JWTAuth $JWTAuth)
    {
        $this->auth = $JWTAuth;
    }

    /**
     * Регистрация нового пользователя и компании
     *
     * @param RegisterRequest $request
     * @param AuthRepository $repository
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request, AuthRepository $repository)
    {
        $repository->storeUserAndCompany($request);

        if (!$token = $this->auth->attempt($request->only(['email', 'password']))) {
            return response()->json([
                'status' => 'error',
                'error' => 'invalid.credentials',
                'msg' => 'Invalid Credentials.'
            ], 401);
        }

        return response()->json([
            'status' => 'success',
            'token' => $token,
            'user' => new UserResource(User::where('id', auth()->user()->getAuthIdentifier())->first())
        ], 200);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        if (!$token = $this->auth->attempt($request->only(['email', 'password']))) {
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
        $this->auth->invalidate();

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
        if ($token = $this->auth->refresh()) {
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
            'phone' => $request->get('phone')
        ]);

        if ($user->email !== $request->get('email')) {
            $isEmail = User::where('email', $request->get('email'))->first();
            if (!$isEmail) {
                $user->update(['email' => $request->get('email')]);

                return new UserResource(User::where('id', auth()->user()->getAuthIdentifier())->first());
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Такой email уже существует!'
            ], 500);
        }

        return new UserResource(User::where('id', auth()->user()->getAuthIdentifier())->first());
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
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function editCompany(Request $request)
    {
        $user = User::where('id', auth()->user()->getAuthIdentifier())->first();

        if ($user->type_company === 'ИП') {
            $user->usertable()->update([
                'name_company' => $request->get('nameCompany'),
                'address' => $request->get('address'),
                'inn' => $request->get('inn'),
                'ogrnip' => $request->get('ogrnip')
            ]);
        } else {
            $user->usertable()->update([
                'name_company' => $request->get('nameCompany'),
                'address' => $request->get('address'),
                'inn' => $request->get('inn'),
                'kpp' => $request->get('kpp'),
                'ogrn' => $request->get('ogrn')
            ]);
        }

        return new UserResource($user);
    }

    /**
     * Get a company by INN
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCompanyByInn(Request $request)
    {
        if ($request->get('type') === 'ooo') {
            $request->validate([
                'inn' => 'required|max:10|min:10',
            ]);
        } else {
            $request->validate([
                'inn' => 'required|max:12|min:12',
            ]);
        }

        $result = DadataSuggest::partyById($request->get('inn'), ["branch_type"=>"MAIN"]);

        return response()->json([
            'status' => 'success',
            'company' => $result
        ]);
    }

    /**
     * User registration validation
     *
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function userRegistrationValidation(RegisterRequest $request)
    {
        return response()->json([
            'status' => 'success'
        ]);
    }
}
