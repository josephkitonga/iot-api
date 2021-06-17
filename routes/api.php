<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
$router = app()->router;

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

// $router->get('/', function () use ($router) {
//     return response()->json(['status' => 'success', 'message' => 'Welcome to ' . env('APP_NAME'), 'framework' => $router->app->version()]);
// });

/*------------------------------------------ Api Version 1 Routes -------------------------------------------*/
$router->group(['prefix' => '/v1', 'middleware' => 'cors', 'namespace' => 'V1'], function () use ($router) {

    /*------------------------------------------ Guest Routes -------------------------------------------*/
    $router->group(['prefix' => 'auth'], function () use ($router) {

        $router->post('login', ['uses' => 'Auth\AuthsController@mobileLogin']);
        $router->post('register', ['uses' => 'Auth\AuthsController@register']);
        $router->post('invite', ['uses' => 'Auth\AuthsController@invite']);
        $router->get('activate/{code}', ['uses' => 'Auth\AuthsController@activate']);
        $router->post('email/reset/password/link', ['uses' => 'Auth\AuthsController@email']);
        $router->post('password-forgot', ['uses' => 'Auth\AuthsController@email']);
        $router->post('reset/password', ['uses' => 'Auth\AuthsController@reset']);
        $router->get('password/reset/{$id}', ['uses' => 'Auth\AuthsController@resetLink']);

        $router->get('logout', ['uses' => 'Auth\AuthsController@logout']);
        $router->get('user', ['uses' => 'Auth\AuthsController@profile']);

        // $router->get('refresh', ['uses' => 'Auth\AuthsController@refresh']);
        $router->get('/users', ['uses' => 'Auth\UserController@index']);
        $router->delete('delete/user/{id}', ['uses' => 'Auth\UserController@deleteUser']);

    });

    /*------------------------------------------ JWT Refresh Routes -------------------------------------------*/
    $router->group(['prefix' => 'auth', 'middleware' => 'jwt.refresh'], function () use ($router) {
        $router->get('refresh', ['uses' => 'Auth\AuthsController@refresh']);

    });

    $router->get('subjects/{school_id}', ['uses' => 'ApiController@subjects']);
    $router->get('topics/{school_id}/{school_level_id}', ['uses' => 'ApiController@topics']);
    $router->get('topics/{school_id}', ['uses' => 'ApiController@topics']);
    $router->get('sub-topics/{topic_id}', ['uses' => 'ApiController@subTopics']);

    $router->get('student/parents/{user_id}', ['uses' => 'ApiController@studentParents']);
    $router->get('student/subjects/{user_id}', ['uses' => 'ApiController@studentSubjectsTested']);
    $router->get('student/tutors/{user_id}', ['uses' => 'ApiController@studentTutors']);
    $router->get('student/questions/{user_id}', ['uses' => 'ApiController@studentQuestions']);

    $router->get('student/wallet/{user_id}', ['uses' => 'ApiController@studentWallet']);
    $router->get('student/update-package/{user_id}/{type}', ['uses' => 'ApiController@updatePackage']);
    $router->get('student/apply-coupon/{user_id}/{coupon}', ['uses' => 'ApiController@applyCoupon']);

    $router->post('questions/get', ['uses' => 'ApiController@getQuestions']);
    $router->post('questions/get/answers', ['uses' => 'ApiController@getQuestionAnswers']);
    $router->post('questions/save/answers', ['uses' => 'ApiController@saveAnswers']);

    $router->post('questions/comprehension/get', ['uses' => 'ApiController@getComprehensionQuestions']);
    $router->post('questions/comprehension/sub/get', ['uses' => 'ApiController@getComprehensionSubQuestions']);


    Route::group(['prefix' => 'sms','as' => 'sms'], function () {

        Route::post('opt-in', 'SmsApiController@optIn');
        Route::post('register', 'SmsApiController@register');
        Route::get('school-level', 'SmsApiController@schoolLevel');
        Route::get('question-number', 'SmsApiController@numberOfQuestion');

        Route::get('subjects/{school_level_id}', 'SmsApiController@subjects');
        Route::get('topics/{subject_id}/{school_level_id}', 'SmsApiController@topics');
        Route::get('topics/{subject_id}', 'SmsApiController@topics');
        Route::get('class/{school_level_id}', 'SmsApiController@class');
        Route::post('questions', 'SmsApiController@questions');
        Route::get('question/answers', 'SmsApiController@questionAnswers');
        Route::get('question/marking', 'SmsApiController@marking');

    });
});
