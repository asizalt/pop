<?php

namespace App\Http\Controllers\Api\Teacher;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\StoreTeacherLogin;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;
use App\Model\Authenticator;
use Carbon\Carbon;

class LoginController extends ApiController
{

    /**
     * @var Authenticator
     */
    private $authenticator;

    public function __construct(Authenticator $authenticator)
    {
        $this->authenticator = $authenticator;
    }


    /**
     * Login Teacher and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */

    public function loginTeacher(StoreTeacherLogin $request)
    {

        $login = ($request->has('email'))?'email':'user_name';

        $credentials = array_values($request->only($login, 'password'));
        array_push($credentials,'teachers');

        if (! $user = $this->authenticator->attempt(...$credentials)) {
            throw new AuthenticationException();
        }

        $token = $user->createToken('My Token')->accessToken;

        $response = array(
            'access_token' => $token,
            'token_type' => 'Bearer'
        );

        return $this->success(null,$response);
    }

}
