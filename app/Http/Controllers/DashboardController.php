<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function info(){
       $user_id = Auth::user()->id;
       $data['attendances'] = \DB::table('attendances')->where('user_id',$user_id)->count();
       $data['animal'] = \DB::table('animals')->where('user_id',$user_id)->count();
       $data['earnings'] = \DB::table('attendances')->where('user_id',$user_id)->sum('earnings');

       return $data;
    }

    // public function earnings(){
        //     $user_id = Auth::user()->id;
    //    $earnings =  \DB::table('attendances')->where('user_id',$user_id)->sum('earnings');
    //    return Response()->json(number_format($earnings, 2, ',', '.'));
    // }

    // public function amount(){
    //     $user_id = Auth::user()->id;
    //     $amount =  \DB::table('attendances')->where('user_id',$user_id)->sum('amount');
    //     return Response()->json(number_format($amount, 2, ',', '.'));
    //  }

    //  public function attendance(){
    //     $user_id = Auth::user()->id;
    //     $attendance =  \DB::table('attendances')->where('user_id',$user_id)->count();
    //     return $attendance;
    //  }
    //  public function animal(){
    //     $user_id = Auth::user()->id;
    //     $animal =  \DB::table('animals')->where('user_id',$user_id)->count();
    //     return $animal;
    //  }

}
