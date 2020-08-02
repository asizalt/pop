<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Api\ApiController;
use App\Period;
use Illuminate\Http\Request;

/**
 * Class StudentController
 * @package App\Http\Controllers\Api\Student
 */
class StudentController extends ApiController
{
    /**
     * @param Request $request
     * @param $pid
     * @return \Illuminate\Http\JsonResponse
     */
    public function RegisterToPeriod(Request $request,$pid)
    {
        //can make also route model Binding

        $r = ['period_id' => $pid,];

        $validator = \Validator::make($r, [
            'period_id' => 'int|exists:periods,id',
        ]);

        if ($validator->fails()) {
            return $this->failure($validator->messages(),422);
        }

       if ($request->user()->periods()->where('period_id', $pid)->exists())
           return $this->failure('You are all ready registered to the given period');

        $register = $request->user()->periods()->attach($pid);

        return $this->success("You have been registered ",$register);

    }

    /**
     * @param Request $request
     * @param $pid
     * @return \Illuminate\Http\JsonResponse
     */
    public function UnregisterFromPeriod(Request $request,$pid)
    {

       if ($request->user()->periods()->where('period_id', $pid)->exists()) {
           $detach = $request->user()->period()->detach($pid);
           return $this->success("You are no longer registered to the period ", $detach);
       }
       return $this->failure('');
    }

    //list all periods for a given student

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function listPeriods()
    {
        $periods = Period::all();

        return $this->success(null,$periods);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function listRegisteredPeriods(Request $request)
    {
        $periods = optional($request->user())->periods;

        return $this->success(null,$periods);
    }

}
