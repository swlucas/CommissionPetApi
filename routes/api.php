<?php

use Illuminate\Http\Request;

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
$this->post('login', 'API\PassportController@login');
$this->post('register', 'API\PassportController@register');


$this->group(['middleware' => 'auth:api'], function(){
    $this->post('get-details', 'API\PassportController@getDetails');

    $this->get('dashboard','DashboardController@info');

    $this->group(['prefix' => 'service'], function () {
        $this->post('create', 'ServiceController@create');
        // $this->get('get', 'ServiceController@getAll');
        $this->get('get', 'ServiceController@getByUser');
        $this->get('{id}/get', 'ServiceController@getById');
        $this->put('{id}/update', 'ServiceController@update');
        $this->delete('{id}/delete', 'ServiceController@delete');
        // $this->get('{id}/user/{user_id}/get','ServiceController@getByUserId');
    });

    $this->group(['prefix' => 'animal'], function () {
        $this->post('create', 'AnimalController@create');
        // $this->get('get', 'AnimalController@getAll');
        $this->get('get', 'AnimalController@getByUser');
        $this->get('{id}/get', 'AnimalController@getById');
        $this->put('{id}/update', 'AnimalController@update');
        $this->delete('{id}/delete', 'AnimalController@delete');
        // $this->get('{id}/user/{user_id}/get', 'AnimalController@getByUserId');
    });

    $this->group(['prefix' => 'attendance'], function () {
        $this->post('create', 'AttendanceController@create');
        $this->get('{id}/get', 'AttendanceController@getById');
        $this->get('get', 'AttendanceController@getByUser');
    });


    // $this->group(['prefix'=>'dashboard'],function(){
    //     $this->get('earnings','DashboardController@earnings');
    //     $this->get('amount','DashboardController@amount');
    //     $this->get('animal','DashboardController@animal');
    //     $this->get('attendance','DashboardController@attendance');
    // });

});