<?php

namespace App\Http\Controllers\V1\Auth;

use App\Mail\MailResetPassword;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Mail\MailActivation;
use Illuminate\Http\Testing\MimeType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;
use App\Mail\RegisterUser;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Http\Controllers\V1\Auth\JWTAuth;

class UserController extends Controller
{


    public function index(Request $request)
    {

        $per_page = $request->query('rowsPerPage');
        $page = $request->query('page');

        try {

        $users = User::query()->orderByDesc('id', 'DESC')->paginate($per_page, ['*'], 'page', $page);

        $response = new UserCollection($users);
        $response->additional(['message'=>'Successfully fetched all messages']);

        return $response;


        }catch (\Exception $exception) {
            return response()->json(['status' => 'error','message' => $exception->getMessage(),'data' => ''],500);
        }
    }


    public function deleteUser($id)
    {
        try {

            $user = User::find($id);
            if ($user) {

            $user->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'You have successfully deleted the User',
                'data' => $user
            ]);

            }else{

                return response()->json(['status' => 'error', 'message' => 'User not found by ID ' . $id], 404);

            }


        }catch (\Exception $exception) {
            return response()->json([
                'status' => 'error',
                'message' => $exception->getMessage(),
                'data' => ''
            ]);
        }
    }





}
