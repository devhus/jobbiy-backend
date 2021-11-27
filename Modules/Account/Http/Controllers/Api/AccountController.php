<?php

namespace Modules\Account\Http\Controllers\Api;

use Hash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Account\Http\Requests\UpdateAccountRequest;
use Modules\User\Entities\User;

class AccountController extends Controller
{
    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return User::withCompany()->findOrFail(User::current()->id);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @return Response
     */
    public function update(UpdateAccountRequest $request)
    {
        $user       = User::current();
        $updateData = [
            'name' => $request->name,
        ];
        if ($request->email && $request->email !== $user->email) {
            $updateData['email'] = $request->email;
        }
        if ($request->password && !Hash::check($request->password, $user->password)) {
            $updateData['password'] = Hash::make($request->password);
        }
        $user->update($updateData);
        return response($user);
    }
}
