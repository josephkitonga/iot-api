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
use App\Http\Controllers\V1\CommonController;

use function GuzzleHttp\json_encode;

class ApiController extends Controller
{


    public function subjects($school_level_id)
    {

        // $per_page = $request->query('rowsPerPage');
        // $page = $request->query('page');

        try {
            // subject_school_level\

           $subjects = \DB::table('subject_school_level')
           ->select('subject_school_level.subject_id','subject_school_level.school_level_id','subjects.subject_id','subjects.name','subjects.description', 'subjects.image_url', 'subjects.active')
           ->join('subjects','subjects.subject_id','=','subject_school_level.subject_id')
           ->where('school_level_id', '=',$school_level_id)
           ->get();

            // $subjects = Subjects::get();
            // $clients = User::query()->orderByDesc('id', 'DESC')->paginate($per_page, ['*'], 'page', $page);

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully retrieved subjects ',
            'data' => $subjects
        ]);

        } catch (\Exception $exception) {
            return response()->json([
                'status' => 'error',
                'message' => $exception->getMessage(),
                'data' => ''
            ],500);
        }
    }


    public function topics($subject_id,$school_level_id="")
    {

        // $per_page = $request->query('rowsPerPage');
        // $page = $request->query('page');

        try {
            // subject_school_level

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

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully retrieved topics ',
            'data' => $subjects
        ]);

        } catch (\Exception $exception) {
            return response()->json([
                'status' => 'error',
                'message' => $exception->getMessage(),
                'data' => ''
            ],500);
        }
    }

    public function subTopics($topic_id)
    {

        // $per_page = $request->query('rowsPerPage');
        // $page = $request->query('page');

        try {
            // subject_school_level

           $subjects = \DB::table('topic_subtopic')
           ->select('topic_subtopic.topic_id','topic_subtopic.sub_topic_id','sub_topic.sub_topic_id','sub_topic.name','sub_topic.description', 'sub_topic.active')
           ->join('sub_topic','sub_topic.sub_topic_id','=','topic_subtopic.sub_topic_id')
           ->where('topic_id', '=',$topic_id)
           ->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully retrieved topics ',
            'data' => $subjects
        ]);

        } catch (\Exception $exception) {
            return response()->json([
                'status' => 'error',
                'message' => $exception->getMessage(),
                'data' => ''
            ],500);
        }
    }


    public function studentParents($user_id)
    {

        try {

            $subjects = \DB::table('student_parent')
           ->select('student_parent.student_id','student_parent.parent_id')
           ->where('student_id', '=',$user_id)
           ->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully retrieved topics ',
            'data' => $subjects
        ]);

        } catch (\Exception $exception) {
            return response()->json([
                'status' => 'error',
                'message' => $exception->getMessage(),
                'data' => ''
            ],500);
        }

    }

    public function studentSubjectsTested($user_id)
    {

        try {

            $subjects = \DB::table('user_test_logs')
           ->select('subject_id','topic_id')
           ->groupBy('subject_id')
           ->where('user_id', '=',$user_id)
           ->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully retrieved topics ',
            'data' => $subjects
        ]);

        } catch (\Exception $exception) {
            return response()->json([
                'status' => 'error',
                'message' => $exception->getMessage(),
                'data' => ''
            ],500);
        }

    }

    public function studentTutors($user_id)
    {

        try {

            $subjects = \DB::table('student_tutor')
           ->select('student_tutor.student_id','student_tutor.tutor_id')
           ->where('student_id', '=',$user_id)
           ->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully retrieved topics ',
            'data' => $subjects
        ]);

        } catch (\Exception $exception) {
            return response()->json([
                'status' => 'error',
                'message' => $exception->getMessage(),
                'data' => ''
            ],500);
        }

    }

    public function studentQuestions($user_id)
    {

        try {

            $subjects = \DB::table('user_test_logs')
           ->select('*')
           ->groupBy('trace_no')
           ->where('user_id', '=',$user_id)
           ->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully retrieved topics ',
            'data' => $subjects
        ]);

        } catch (\Exception $exception) {
            return response()->json([
                'status' => 'error',
                'message' => $exception->getMessage(),
                'data' => ''
            ],500);
        }

    }

    public function getQuestions(Request $request)
    {

        try {

            $questionsNo = $request->input('questions');
            $user_id = $request->input('user_id');
            $amount = \DB::table('user_wallet')->select('amount')->where('user_id', '=',$user_id)->get()->first();
            $subject_id = $request->input('subject_id');
            $topic_id = $request->input('topic_id');
            $level_id = $request->input('level_id');
            $school_level_id = $request->input('school_level_id');
            $sub_topic_id = $request->input('sub_topic');
            $finalAmount = 0;
            $Where = [];

            $finalAmount =  $amount->amount;

            if($request->input('test_type')=="1"){

                $setting = \DB::table('setting')->select('time_per_test')->get()->first();
                // $setting = $this->LogModel->getSetting();
                $myNumber = $setting->time_per_test;

                $data['testTime'] = $myNumber*$questionsNo;
            }

            if($finalAmount <= 0 || $finalAmount <  $questionsNo){

                return response()->json([
                    'status' => 'error',
                    'message' => 'Your current balance is '.number_format($finalAmount,2,'.',',').' please top up '.number_format($questionsNo,2,'.',','),
                    'data' => ''
                ],401);

                exit;
            }


            $whereArr['subject_id'] = $subject_id;

            if($topic_id !="5eb3ac554fac5"){
                $whereArr['topic_id'] = $topic_id;
            }

            if($level_id !="14"){
                $whereArr['level_id'] = $level_id;
            }

            $whereArr['school_level_id'] = $school_level_id;

             if($sub_topic_id && $sub_topic_id !="sub9898989894544oo"){
                $whereArr['sub_topic'] = $sub_topic_id;
                // $whereArr['sub_sub_topic'] = $postData['sub_sub_topic_id'];
             }


        // $data['questionData'] = $this->QuestionModel->getQuestionLimit($whereArr,$questionsNo);
		// $data['linkedQuestion'] = $this->QuestionModel->getLinkedQuestion();
		// $data['answerData'] = $this->QuestionModel->getQuestionAnswers();
		// $data['answerFileData'] = $this->QuestionModel->getQuestionAnswerFiles();

        foreach ($whereArr as $key => $value) {
            array_push($Where,[$key, '=', $value]);
        }


        // print_r($Where);
        // exit;

        // $data['questionData'] = \DB::table('question')->select('*')->limit($questionsNo)->where('subject_id','=',$whereArr['subject_id'])->where('topic_id', '=', $whereArr['topic_id'])->where('school_level_id', '=', $whereArr['school_level_id'])->where('level_id', '=', $whereArr['level_id'])->where('sub_topic', '=', $whereArr['sub_topic'])->get();
        $data['questionData'] = \DB::table('question')->select('*')->limit($questionsNo)->where($Where)->where('question_type','=','0')->inRandomOrder()->get();


        // $data['questionData'] = \DB::table('question')->select('*')->limit($questionsNo)->where('subject_id','=',$whereArr['subject_id'])->where('topic_id', '=', $whereArr['topic_id'])->where('school_level_id', '=', $whereArr['school_level_id'])->where('level_id', '=', $whereArr['level_id'])->where('sub_topic', '=', $whereArr['sub_topic'])->get();
        // $data['answerData'] = \DB::table('question_answers')->select('*')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully retrieved question data',
            'data' => $data
        ]);

        } catch (\Exception $exception) {
            return response()->json([
                'status' => 'error',
                'message' => $exception->getMessage(),
                'data' => ''
            ]);
        }

    }

    public function getComprehensionQuestions(Request $request)
    {

        try {

            $questionsNo = $request->input('questions');
            $user_id = $request->input('user_id');
            $amount = \DB::table('user_wallet')->select('amount')->where('user_id', '=',$user_id)->get()->first();
            $subject_id = $request->input('subject_id');
            $topic_id = $request->input('topic_id');
            $level_id = $request->input('level_id');
            $school_level_id = $request->input('school_level_id');
            $sub_topic_id = $request->input('sub_topic');
            $finalAmount = 0;
            $Where = [];

            $finalAmount =  $amount->amount;

            if($request->input('test_type')=="1"){

                $setting = \DB::table('setting')->select('time_per_test')->get()->first();
                // $setting = $this->LogModel->getSetting();
                $myNumber = $setting->time_per_test;

                $data['testTime'] = $myNumber*$questionsNo;
            }

            if($finalAmount <= 0 || $finalAmount <  $questionsNo*15){

                return response()->json([
                    'status' => 'error',
                    'message' => 'Your current balance is '.number_format($finalAmount,2,'.',',').' please top up '.number_format($questionsNo,2,'.',','),
                    'data' => ''
                ],401);

                exit;
            }


            $whereArr['subject_id'] = $subject_id;


            if($level_id !="14"){
                $whereArr['level_id'] = $level_id;
            }

            $whereArr['school_level_id'] = $school_level_id;

        foreach ($whereArr as $key => $value) {
            array_push($Where,[$key, '=', $value]);
        }


        // print_r($Where);
        // exit;

        // $data['questionData'] = \DB::table('question')->select('*')->limit($questionsNo)->where('subject_id','=',$whereArr['subject_id'])->where('topic_id', '=', $whereArr['topic_id'])->where('school_level_id', '=', $whereArr['school_level_id'])->where('level_id', '=', $whereArr['level_id'])->where('sub_topic', '=', $whereArr['sub_topic'])->get();
        $data['questionData'] = \DB::table('question')->select('*')->limit($questionsNo)->where($Where)->where('question_type','=','1')->inRandomOrder()->get();


        // $data['questionData'] = \DB::table('question')->select('*')->limit($questionsNo)->where('subject_id','=',$whereArr['subject_id'])->where('topic_id', '=', $whereArr['topic_id'])->where('school_level_id', '=', $whereArr['school_level_id'])->where('level_id', '=', $whereArr['level_id'])->where('sub_topic', '=', $whereArr['sub_topic'])->get();
        // $data['answerData'] = \DB::table('question_answers')->select('*')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully retrieved question data',
            'data' => $data
        ]);

        } catch (\Exception $exception) {
            return response()->json([
                'status' => 'error',
                'message' => $exception->getMessage(),
                'data' => ''
            ]);
        }

    }

    public function getComprehensionSubQuestions(Request $request)
    {

        try {

        $questions = $request->input('questions');

        $data['questionData'] = \DB::table('question')->select('*')->whereIn('parent_question_id',$questions)->where('question_type','=','2')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully retrieved question data',
            'data' => $data
        ]);

        } catch (\Exception $exception) {
            return response()->json([
                'status' => 'error',
                'message' => $exception->getMessage(),
                'data' => ''
            ]);
        }

    }

    public function getQuestionAnswers(Request $request)
    {

        try {

        $questions = $request->input('questions');

        $data = \DB::table('question_answers')->select('*')->whereIn('question_id',$questions)->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully retrieved question data',
            'data' => $data
        ]);

        } catch (\Exception $exception) {
            return response()->json([
                'status' => 'error',
                'message' => $exception->getMessage(),
                'data' => ''
            ]);
        }

    }


    public function saveAnswers(Request $request)
    {

        try {

            $questions_arr = $request->input('questions_arr');
            $test_start_time = $request->input('questions_arr');
            $subject_id = $request->input('subject_id');
            $topic_id = $request->input('topic_id');
            $answers_arr = $request->input('answers_arr');
            $no_questions = $request->input('no_questions');

            // $data = \DB::table('question_answers')->select('*')->whereIn('question_id',$questions)->get();
            // return response()->json([
            //     'status' => 'success',
            //     'message' => 'Successfully retrieved question data',
            //     'data' => $data
            // ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Successfully submitted question data',
                'data' => ''
            ]);


            } catch (\Exception $exception) {
                return response()->json([
                    'status' => 'error',
                    'message' => $exception->getMessage(),
                    'data' => ''
                ]);
            }

    }


    public function studentWallet($user_id)
    {
        try {

            // $data = \DB::table('user_wallet')->select('*')->where('user_id', '=',$user_id)->get();

            $amount = \DB::table('user_wallet')->select('amount')->where('user_id', '=',$user_id)->get()->first();

            return response()->json([
                'status' => 'success',
                'message' => 'Successfully retrieved wallet',
                'data' => $amount->amount
            ]);

            } catch (\Exception $exception) {
                return response()->json([
                    'status' => 'error',
                    'message' => $exception->getMessage(),
                    'data' => ''
                ]);
            }
    }


    public function updatePackage($user_id,$type)
	{

        $elitePackage = \DB::table('elite_package_log')->select('amount')->where('user_id', '=',$user_id)->where('status', '=',0)->get()->first();

		// $elitePackage = $this->db->select('*')->from('elite_package_log')->where('user_id', $session_data['user_id'])->where('status', 0)->get()->result();

		if($type == 1){

      if(empty($elitePackage)){

          CommonController::elite_package_manual_update($user_id);
          CommonController::set_debit_credit_txn($user_id,1000,1,5,'ELP');
          CommonController::set_debit_credit_txn('12345678',1000,0,5,'ELP');

			}else{
				// $this->db->update('users', array('account_type'=> 1), array('user_id'=> $session_data['user_id']));

                return response()->json([
                    'status' => 'error',
                    'message' => 'Your enrolled to elite package, end Date : '.$elitePackage->end_at,
                    'data' => ''
                ]);

				// $this->session->set_flashdata('err', 'Your enrolled to elite package, end Date : '.$elitePackage[0]->end_at);

			}

		}else{

			if(!empty($elitePackage)){
			 	// $this->session->set_flashdata('err', 'Your enrolled to elite package, end Date : '.$elitePackage[0]->end_at);
                 return response()->json([
                    'status' => 'error',
                    'message' => 'Your enrolled to elite package, end Date : '.$elitePackage->end_at,
                    'data' => ''
                ]);

			}else{
				// $this->db->update('users', array('account_type'=> 0), array('user_id'=> $session_data['user_id']));

                \DB::table('users')->where('user_id', '=',$user_id)->update(array('account_type'=> 0));

                return response()->json([
                    'status' => 'success',
                    'message' => 'updated package',
                    'data' => ''
                ]);

			}
		}
	}


    public function applyCoupon($user_id,$coupon_code)
	{
		$session_data = $this->common->loadSession();

		// $coupon_code = $this->input->post('coupon_code');
		$data = array('user_id' => $session_data['user_id'],'state'=>1,'updated_at'=>\Carbon\Carbon::now()->toDateTimeString());

		// $coupon = $this->db->where('coupon_code',$coupon_code)->where('state',0)->get('coupons')->result();
        $coupon = \DB::table('coupons')->select('*')->where('coupon_code', '=',$coupon_code)->where('status', '=',0)->get()->first();

		if($coupon){


			// $wallet_balance = check_wallet_balance($session_data['user_id'])+$coupon->value;
            $wallet_balance = \DB::table('user_wallet')->select('amount')->where('user_id', '=',$coupon_code)->get()->first()->amount +$coupon->value;

            // user_wallet

			$userData = array(
				'user_id'=>$session_data['user_id'],
				'updated_at'=>\Carbon\Carbon::now()->toDateTimeString(),
				'amount' => $wallet_balance);

			// $this->LogModel->updateWallet($userData,$session_data['user_id']);
            \DB::table('user_wallet')->where('user_id', '=',$user_id)->update($userData);

            // user_wallet
			CommonController::set_debit_credit_txn($session_data['user_id'],$coupon->value,0,3,'CP');
            CommonController::set_debit_credit_txn('12345678',$coupon->value,1,3,'CP');


			// $this->db->update('coupons', $data, array('coupon_code'=> $coupon_code));
            \DB::table('coupons')->where('coupon_code', '=',$coupon_code)->update($data);

            return response()->json([
                'status' => 'success',
                'message' => 'Coupon applied successfully',
                'data' => ''
            ]);

			// $this->session->set_flashdata('message', 'Coupon applied successfully');
		}else{

            return response()->json([
                'status' => 'error',
                'message' => 'Coupon does not exist or is already used',
                'data' => ''
            ]);
			// $this->session->set_flashdata('err', 'Coupon does not exist or is already used');
		}

		// redirect('user-profile','refresh');

	}


}
