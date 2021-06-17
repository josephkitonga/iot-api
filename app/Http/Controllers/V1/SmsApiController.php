<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Subjects;
use App\SubjectSchoolLevel;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;



use function GuzzleHttp\json_encode;

class SmsApiController extends Controller
{


    public function optIn(Request $request)
    {

     try{

            $phone_number = $request->input('phone_number');

            $api_token = $request->bearerToken();
            $serchToken = \DB::table('users')->select('api_token')->where('api_token', '=',$api_token)->get()->first()->api_token;
            if (!$serchToken) {
                $statusCode = 404;
                return response()->json([
                    'statusCode' => $statusCode,
                    'status' => 'failed',
                    'message' => 'Please provide a valid token',
                    'data' => '',
                    'state' => '0'
                ], $statusCode);

                exit;
            }

            $users = \DB::table('users')->select('*')->where('phone_number', '=',$phone_number)->get()->first();
            if($users){
                $statusCode = 200;
                return response()->json([
                    'statusCode' => $statusCode,
                    'status' => 'success',
                    'message' => 'Profile found',
                    'data' => $users,
                    'state' => '1'
                ], $statusCode);

            }else{
                $statusCode = 300;
                return response()->json([
                    'statusCode' => $statusCode,
                    'status' => 'failed',
                    'message' => 'Profile not found, kindly register!.',
                    'data' => '',
                    'state' => '0'
                ], $statusCode);
            }

        } catch (\Exception $exception) {
            $statusCode = 500;
            return response()->json([
                'statusCode' => $statusCode,
                'status' => 'error',
                'message' => 'Please a provide valid token',
                'data' => '',
                'state' => '0'
            ], $statusCode);
        }

    }

    public function register(Request $request)
    {
        try {

            $api_token = $request->bearerToken();
            $serchToken = \DB::table('users')->select('api_token')->where('api_token', '=',$api_token)->get()->first()->api_token;
            if (!$serchToken) {
                $statusCode = 400;
                return response()->json([
                    'statusCode' => $statusCode,
                    'status' => 'failed',
                    'message' => 'Please provide a valid token',
                    'data' => '',
                    'state' => '0'
                ], $statusCode);

                exit;
            }

            $phone_number = $request->input('phone_number');
            $name = $request->input('name');
            $school_level_id = $request->input('school_level_id');
            $level_id = $request->input('level_id') == null ? $request->input('class_id') : $request->input('level_id');

            $users = \DB::table('users')->select('*')->where('phone_number', '=',$phone_number)->get()->first();
            if ($users) {
                $statusCode = 300;
                return response()->json([
                    'statusCode' => $statusCode,
                    'status' => 'failed',
                    'message' => 'User exists',
                    'data' => $users,
                    'state' => '1',
                ], $statusCode);

                exit;
            }
            $statusCode = 200;
            $users = \DB::table('users')->insert([
                'user_id' => time(),
                'name' => $name,
                'phone_number'=> $phone_number,
                'school_level_id' => $school_level_id,
                'level_id' => $level_id,
                'user_type' => 'de8786ddf7c161',
                'activation_status' => 1,
                'verification_code' => 1,
                "platform_id" => "1611572075038",
                "password" => sha1($phone_number),
                'state' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ]);

            $users = \DB::table('users')->select('*')->where('phone_number', '=',$phone_number)->get()->first();
            $statusCode = 200;
            return response()->json([
                'statusCode' => $statusCode,
                'status' => 'success',
                'message' => 'User info',
                'data' => $users,
                'state' => '1'
            ], $statusCode);


        } catch (\Exception $exception) {
            $statusCode = 500;
            return response()->json([
                'statusCode' => $statusCode,
                'status' => 'error',
                'message' => 'Please a provide valid token '.$exception,
                // $exception->getMessage(),
                'data' => '',
                'state' => '0'
            ], $statusCode);
        }

    }

    public function schoolLevel(Request $request)
    {
        try{

            $api_token = $request->bearerToken();
            $serchToken = \DB::table('users')->select('api_token')->where('api_token', '=',$api_token)->get()->first()->api_token;
            if (!$serchToken) {
                $statusCode = 400;
                return response()->json([
                    'statusCode' => $statusCode,
                    'status' => 'failed',
                    'message' => 'Please provide a valid token',
                    'data' => '',
                    'state' => '0'
                ], $statusCode);

                exit;
            }

            $phone_number = $request->input('phone_number');
            $name = $request->input('name');
            $school_level_id = $request->input('school_level_id');


            $schoolLevel = \DB::table('school_level')->select('*')->get();
            $statusCode = 200;
            return response()->json([
                'statusCode' => $statusCode,
                'status' => 'success',
                'message' => 'School levels',
                'data' => $schoolLevel,
                'state' => '1'
            ], $statusCode);


        } catch (\Exception $exception) {
            $statusCode = 500;
            return response()->json([
                'statusCode' => $statusCode,
                'status' => 'error',
                'message' => 'Please a provide valid token',
                // $exception->getMessage(),
                'data' => '',
                'state' => '0'
            ], $statusCode);
        }
    }

    public function subjects($school_level_id,Request $request)
    {


        try {

            $api_token = $request->bearerToken();
            $serchToken = \DB::table('users')->select('api_token')->where('api_token', '=',$api_token)->get()->first()->api_token;
            if (!$serchToken) {
                $statusCode = 400;
                return response()->json([
                    'statusCode' => $statusCode,
                    'status' => 'failed',
                    'message' => 'Please provide a valid token',
                    'data' => '',
                    'state' => '0'
                ], $statusCode);

                exit;
            }

           $subjects = \DB::table('subject_school_level')
           ->select('subject_school_level.subject_id','subject_school_level.school_level_id','subjects.subject_id','subjects.name','subjects.description', 'subjects.image_url', 'subjects.active')
           ->join('subjects','subjects.subject_id','=','subject_school_level.subject_id')
           ->where('school_level_id', '=',$school_level_id)
           ->get();

            // $subjects = Subjects::get();
            // $clients = User::query()->orderByDesc('id', 'DESC')->paginate($per_page, ['*'], 'page', $page);

        $statusCode = 200;
        return response()->json([
            'statusCode' => $statusCode,
            'status' => 'success',
            'message' => 'Successfully retrieved subjects ',
            'data' => $subjects,
            'state' => '1'

        ], $statusCode);

        } catch (\Exception $exception) {
            $statusCode = 500;
            return response()->json([
                'statusCode' => $statusCode,
                'status' => 'error',
                'message' => $exception->getMessage(),
                'data' => '',
                'state' => '0'
            ], $statusCode);
        }
    }

    public function topics($subject_id,$school_level_id="",Request $request)
    {

        try {

            $api_token = $request->bearerToken();
            $serchToken = \DB::table('users')->select('api_token')->where('api_token', '=',$api_token)->get()->first()->api_token;
            if (!$serchToken) {
                $statusCode = 400;
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Please provide a valid token',
                    'data' => '',
                    'state' => '0'
                ], $statusCode);

                exit;
            }

           if($school_level_id!=""){

           $subjects = \DB::table('subject_topic')
           ->select('subject_topic.subject_id','subject_topic.school_level_id','subject_topic.topic_id','topic.topic_id','topic.name','topic.description', 'topic.active')
           ->join('topic','topic.topic_id','=','subject_topic.topic_id')
           ->where('subject_id', '=',$subject_id)
           ->where('school_level_id', '=',$school_level_id)
           ->get();

           }else{

            $subjects = \DB::table('subject_topic')
            ->select('subject_topic.subject_id','subject_topic.school_level_id','subject_topic.topic_id','topic.topic_id','topic.name','topic.description', 'topic.active')
            ->join('topic','topic.topic_id','=','subject_topic.topic_id')
            ->where('subject_id', '=',$subject_id)
            ->get();

           }

        $statusCode = 200;
        return response()->json([
            'statusCode' => $statusCode,
            'status' => 'success',
            'message' => 'Successfully retrieved topics ',
            'data' => $subjects,
            'state' => '1'
        ], $statusCode);

        } catch (\Exception $exception) {
            $statusCode = 500;
            return response()->json([
                'statusCode' => $statusCode,
                'status' => 'error',
                'message' => $exception->getMessage(),
                'data' => '',
                'state' => '0'
            ], $statusCode);
        }
    }

    public function class($school_level_id="",Request $request)
    {
        try {

            $api_token = $request->bearerToken();
            $serchToken = \DB::table('users')->select('api_token')->where('api_token', '=',$api_token)->get()->first()->api_token;
            if (!$serchToken) {
                $statusCode = 400;
                return response()->json([
                    'statusCode' => $statusCode,
                    'status' => 'failed',
                    'message' => 'Please provide a valid token',
                    'data' => '',
                    'state' => '0'
                ], $statusCode);

                exit;
            }

        $class = \DB::table('class_school_level')
           ->select('class_school_level.m_level_id as class_id','class_school_level.school_level_id','m_level.id','m_level.name')
           ->join('m_level','m_level.id','=','class_school_level.m_level_id')
           ->where('class_school_level.school_level_id', '=',$school_level_id)
           ->get();

        $statusCode = 200;
        return response()->json([
            'statusCode' => $statusCode,
            'status' => 'success',
            'message' => 'Successfully retrieved class ',
            'data' => $class,
            'state' => '1'
        ], $statusCode);

        } catch (\Exception $exception) {
            $statusCode = 500;
            return response()->json([
                'statusCode' => $statusCode,
                'status' => 'error',
                'message' => $exception->getMessage(),
                'data' => '',
                'state' => '0'
            ], $statusCode);
        }
    }

    public function numberOfQuestion(Request $request)
    {

        try {

            $api_token = $request->bearerToken();
            $serchToken = \DB::table('users')->select('api_token')->where('api_token', '=',$api_token)->get()->first()->api_token;
            if (!$serchToken) {
                $statusCode = 400;
                return response()->json([
                    'statusCode' => $statusCode,
                    'status' => 'failed',
                    'message' => 'Please provide a valid token',
                    'data' => '',
                    'state' => '0'
                ], $statusCode);

                exit;
            }

        $number_of_question = \DB::table('number_of_question')->select('*')->get();
        $statusCode = 200;
        return response()->json([
            'statusCode' => $statusCode,
            'status' => 'success',
            'message' => 'Successfully retrieved number of question ',
            'data' => $number_of_question,
            'state' => '1'
        ], $statusCode);

        } catch (\Exception $exception) {
            $statusCode = 500;
            return response()->json([
                'statusCode' => $statusCode,
                'status' => 'error',
                'message' => $exception->getMessage(),
                'data' => '',
                'state' => '0'
            ], $statusCode);
        }

    }


    public function questions(Request $request)
    {

        $school_level_id = $request->input('school_level_id');
        $subject_id = $request->input('subject_id');
        $number_of_question = $request->input('number_of_question');

        try {

        $api_token = $request->bearerToken();
        $serchToken = \DB::table('users')->select('api_token')->where('api_token', '=',$api_token)->get()->first()->api_token;
        if (!$serchToken) {
            $statusCode = 400;
            return response()->json([
                'statusCode' => $statusCode,
                'status' => 'failed',
                'message' => 'Please provide a valid token',
                'data' => '',
                'state' => '0'
            ], $statusCode);

            exit;
        }

        $question = \DB::table('platform_questions')
           ->select('platform_questions.question_id','platform_questions.platform_id','platform_questions.question_id','platform_questions.active','question.question_id', 'question.question','question.subject_id', 'question.topic_id', 'question.class_id','question.school_level_id','question.year','question.level_id', 'question.working','question.question_type','question.active')
           ->join('question','question.question_id','=','platform_questions.question_id')
           ->where('platform_questions.platform_id', '=',"1611574422989")
           ->where('question.school_level_id', '=',$school_level_id)
           ->where('question.subject_id', '=',$subject_id)
           ->skip(0)
           ->take($number_of_question)
           ->get();

        $statusCode = 200;
        return response()->json([
            'statusCode' => $statusCode,
            'status' => 'success',
            'message' => 'Successfully retrieved questions ',
            'data' => $question,
            'state' => '1'
        ], $statusCode);

        } catch (\Exception $exception) {
            $statusCode = 500;
            return response()->json([
                'statusCode' => $statusCode,
                'status' => 'error',
                'message' => "Please provide a valid token",
                'data' => '',
                'state' => '0'
            ], $statusCode);
        }
    }

    public function questionAnswers(Request $request)
    {

        try {

        $api_token = $request->bearerToken();
        $serchToken = \DB::table('users')->select('api_token')->where('api_token', '=',$api_token)->get()->first()->api_token;
        if (!$serchToken) {
            $statusCode = 400;
            return response()->json([
                'statusCode' => $statusCode,
                'status' => 'failed',
                'message' => 'Please provide a valid token',
                'data' => '',
                'state' => '0'
            ], $statusCode);

            exit;
        }

        $questions = $request->input('questions');

        $data = \DB::table('question_answers')->select('*')->whereIn('question_id',$questions)->get();
        $statusCode = 200;
        return response()->json([
            'statusCode' => $statusCode,
            'status' => 'success',
            'message' => 'Successfully retrieved question answers data',
            'data' => $data,
            'state' => '1'
        ], $statusCode);

        } catch (\Exception $exception) {
            $statusCode = 500;
            return response()->json([
                'statusCode' => $statusCode,
                'status' => 'error',
                'message' => 'Please provide a valid token',
                //$exception->getMessage(),
                'data' => '',
                'state' => '0'
            ], $statusCode);
        }

    }

    public function marking()
    {
        # code...
    }


    public function validator($api_token)
    {

            // print_r(empty($api_token));

            // if(empty($api_token)){

            // return response()->json([
            //         'status' => 'failed',
            //         'message' => 'Please a provide valid token',
            //         'data' => ''
            //     ],404);

            //     exit;
            // }
            try{

            $serchToken = \DB::table('users')->select('api_token')->where('api_token', '=',$api_token)->get()->first()->api_token;
            if (!$serchToken) {
                $statusCode = 400;
                return response()->json([
                    'statusCode' => $statusCode,
                    'status' => 'failed',
                    'message' => 'Please provide a valid token',
                    'data' => '',
                    'state' => '0'
                ], $statusCode);

                exit;
            }

        } catch (\Exception $exception) {
            $statusCode = 500;
            return response()->json([
                'statusCode' => $statusCode,
                'status' => 'error',
                'message' => "Please provide a valid token",
                'data' => '',
                'state' => '0'
            ], $statusCode);
        }

    }
}
