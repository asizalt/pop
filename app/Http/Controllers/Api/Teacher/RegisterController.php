<?php

namespace App\Http\Controllers\Api\Teacher;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\StoreTeacherRegister;
use App\Teacher;
use Illuminate\Http\Request;

class RegisterController extends ApiController
{
    /**
     * @param  [string] user_name
     * @param  [string] full_name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return \Illuminate\Http\JsonResponse
     */
    public function registerTeacher(StoreTeacherRegister $request)
    {

        $teacher = new Teacher([
            'user_name' => $request->user_name,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        $teacher->save();

        //response from base controller
        return $this->success('Successfully created user!');
    }
}
