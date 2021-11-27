<?php

namespace Modules\User\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\User\Entities\User;
use Modules\User\Http\Requests\LoginRequest;
use Modules\User\Http\Requests\RegisterRequest;
use Modules\User\Services\AuthService;

class AuthController extends Controller
{
    /**
     * @return Response
     */
    public function user()
    {
        $user = User::current();
        try {
            $user->load(['company', 'roles' => function ($q) {
                return $q->with(['permissions' => function ($q) {
                    return $q->select('id', 'name');
                }])->select('id', 'name');
            }]);
            return response($user);
        } catch (\Throwable $th) {
            return res()->error($th->getMessage());
        }
    }

    /**
     * @param \Modules\User\Http\Requests\LoginRequest $request
     * @param \Modules\User\Services\AuthService $authService
     * @return Response
     */
    public function login(LoginRequest $request, AuthService $authService)
    {
        try {
            $auth = $authService->login($request->email, $request->password);
            return response($auth);
        } catch (\Throwable $th) {
            return res()->error($th->getMessage());
        }
    }

    /**
     * @param \Modules\User\Http\Requests\RegisterRequest $request
     * @param \Modules\User\Services\AuthService $authService
     * @return Response
     */
    public function register(RegisterRequest $request, AuthService $authService)
    {
        try {
            $authService->createAccount($request->name, $request->email, $request->password, $request->is_employer);
            return res()->success();
        } catch (\Throwable $th) {
            return res()->error($th->getMessage());
        }
    }
}
