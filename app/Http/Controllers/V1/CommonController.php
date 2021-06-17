<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DateTime;
use DateInterval;


class CommonController extends Controller
{


    public static function elite_package_manual_update($user_id)
    {

            //get main CodeIgniter object
            // $ci =& get_instance();

            // $data = $ci->LogModel->getWallet($user_id);
            $amount = \DB::table('user_wallet')->select('amount')->where('user_id', '=',$user_id)->get()->first();
            if($amount->amount >= 1000){
                // elite_package_log

                $created_at = date("Y-m-d"); // Y-m-d
                $start_date = new DateTime(); // Y-m-d
                $start_date->add(new DateInterval('P30D'));
                $end_at =  $start_date->format('Y-m-d');
                // $user_id = '5ec057311f74a';

                $postArr = array(
                    'created_at' => $created_at,
                    'end_at' => $end_at,
                    'user_id' => $user_id
                );


                //Insert
                \DB::table('elite_package_log')->insert($postArr);


                // $ci->db->insert('elite_package_log', $postArr);

                // $ci->db->update('users', array('account_type'=> 1), array('user_id'=> $user_id));

                \DB::table('users')->where('user_id', '=',$user_id)->update(["account_type" => 1]);


                $userData = array('amount' => $amount->amount - 1000, 'updated_at' => $created_at);
                // $ci->LogModel->updateWallet($userData, $user_id);
                \DB::table('elite_package_log')->where('user_id', '=',$user_id)->update($userData);

                // $ci->LogModel->addAccountTxn(array('user_id' => $user_id, 'created_at' => $created_at, 'amount' => 1000,'txn_type'=>1,'txn_name'=>"ElitePackage"));

            }else{

                // $ci->session->set_flashdata('err', 'Activation Failed please make sure you have enough money for the package');

                // $ci->db->update('users', array('account_type'=> 0), array('user_id'=> $user_id));
                \DB::table('users')->where('user_id', '=',$user_id)->update(["account_type" => 0]);

            }

    }

    public static function set_debit_credit_txn($user_id,$amount,$txn_type,$payment_type_id,$txn_number=null)
	{

		$dateTime = date('Y-m-d H:i:s');

		// $data = $ci->LogModel->getAccount($user_id);
        $data = \DB::table('user_account')->select('amount')->where('user_id', '=',$user_id)->get()->first();
        $result = \DB::table('amount')->select('amount')->where('user_id', '=',$user_id)->get()->first()->amount;

		$postArr = array('txn_type' => $txn_type, 'payment_type_id' => $payment_type_id,'user_id' => $user_id, 'updated_at' => $dateTime, 'amount' => $amount,'txn_number' => $txn_number.uniqid(),'state'=>1);
        \DB::table('user_account_txn')->insert($postArr);

		if (empty($data))
		{
			$userData = array('user_id' => $user_id, 'updated_at' => $dateTime, 'amount' => $amount);
			// $ci->LogModel->insertAccount($userData);
            \DB::table('user_account')->insert($userData);
		}else{

			$userData = array('amount' => number_format($result+$amount, 4, '.', ''), 'updated_at' => $dateTime);
			if($txn_type==1){
				$userData = array('amount' => number_format($result-$amount, 4, '.', ''), 'updated_at' => $dateTime);

			}

            \DB::table('user_account')->where('user_id', '=',$user_id)->update($userData);

			// $ci->LogModel->updateAccount($userData, $user_id);
		}

	}


}
