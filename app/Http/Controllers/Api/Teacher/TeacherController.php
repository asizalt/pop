<?php

namespace App\Http\Controllers\Api\Teacher;

use App\Http\Controllers\Api\ApiController;
use App\Period;
use Illuminate\Http\Request;

class TeacherController extends ApiController
{

    public function fetchStudentsByPeriod(Request $request,$period)
    {
        $r = ['period_id' => $period,];

        $validator = \Validator::make($r, [
            'period_id' => 'int|exists:periods,id',
        ]);

        if ($validator->fails()) {
            return $this->failure($validator->messages(),422);
        }
        $period = Period::where('name',$period)->first();

        return $this->success(null,$period);
    }

    public function fetchTeacherPeriod(Request $request)
    {
        return $this->success(null,$request->user()->periods);
    }

    public function studentsLinkTeachers(Request $request)
    {
        $periods = $request->user()->periods;
        $students = array();

        if(!empty($periods)){
            foreach($periods as $period)
               $students[] = $period->students;
        }



        return $this->success(null,$students);
    }

}
