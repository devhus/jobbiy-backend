<?php
namespace Modules\User\Services;

use Exception;
use Hash;
use Modules\User\Entities\User;
use Modules\User\Enums\Roles;

class AuthService
{
    /**
     * Gets user's account info with the ability to load roles and permissions
     *
     * @param int $userId
     * @param bool $loadRelations if true will load the roles and permissions relationships.
     *
     * @return \Modules\User\Entities\User|null
     */
    public function user(int $userId, bool $loadRelations = false)
    {
        $query = User::where('id', $userId);
        if ($loadRelations) {
            $query->with(['company', 'roles' => function ($q) {
                return $q->with(['permissions' => function ($q) {
                    return $q->select('id', 'name');
                }])->select('id', 'name');
            }]);
        }
        return $query->first();
    }

    /**
     * Signs in a user using email & password and return a sanctum token for the user's session after assigning it.
     *
     * @param string $email
     * @param string $password
     *
     * @return string
     */
    public function login($email, $password)
    {
        /**@var User|null */
        $user = User::withCompany()->where('email', $email)->first();
        if (!$user || !Hash::check($password, $user->password)) {
            throw new Exception("Invalid Credentials.");
        }

        // here we will have a check of account verification but i will not code it at this sample project
        // just letting you know that i am aware of this point.

        $access_token = $user->createToken(env('APP_KEY'))->plainTextToken;
        return compact('user', 'access_token');
    }

    /**
     * Creates a user account to be ready to have a filable profile
     *
     * @param string $email
     * @param string $email
     * @param string $password
     * @param boolean $isEmployer
     *
     * @return string
     */
    public function createAccount($name, $email, $password, $isEmployer = false)
    {
        $existsEmail = User::where('email', $email)->count();
        if ($existsEmail > 0) {
            throw new Exception("Email is already in use");
        }
        $user = User::create([
            'name'        => $name,
            'email'       => $email,
            'password'    => Hash::make($password),
            'is_employer' => $isEmployer,
        ]);

        $user->assignRole($isEmployer ? Roles::EMPLOYER : Roles::EMPLOYEE);

        // here we will have to send a queued email message to the user to verify the account through thier email
        // the message needs to be queued not directly sent, so it doesn't delay the response to the user
    }
}
