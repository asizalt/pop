<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\StoreStudenRegister;
use Illuminate\Http\Request;
use App\Student;

class RegisterController extends ApiController
{
    /**
     * @param  [string] user_name
     * @param  [string] full_name
     * @param  [string] email
     *  @param  [int] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return \Illuminate\Http\JsonResponse
     */
    public function registerStudent(StoreStudenRegister $request)
    {

        $student = new Student([
            'user_name' => $request->user_name,
            'full_name' => $request->full_name,
            'grade' => $request->grade,
            'password' => bcrypt($request->password)
        ]);
        $student->save();

        //response from base controller
        return $this->success('Successfully created user!');

    }
}
