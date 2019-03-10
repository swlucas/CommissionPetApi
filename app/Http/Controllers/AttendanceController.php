<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attendance;
use App\Service;
use App\Animal;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function create(Request $request)
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        if ($user) {
            $animal = Animal::find($request->animal_id);
            if ($animal) {
                $earnings = 0;
                for ($i = 0; $i < count($request->service_id); $i++) {
                    $service[] = Service::find($request->service_id[$i]);
                    if ($service[$i] == null) {
                        return response()->json(['error' => 'Serviço não existe!'], 200);
                    }
                    $earnings += ($service[$i]->percentage / 100) * $request->value[$i];
                }

                $attendance = new Attendance();
                $attendance->user()->associate($user);
                $attendance->animal()->associate($animal);
                $attendance->amount = array_sum($request->value);
                $attendance->earnings = $earnings;
                $attendance->save();

                for ($i = 0; $i < count($service); $i++) {
                    $value = $request->value[$i];
                    $gain = ($service[$i]->percentage / 100) * $request->value[$i];
                    $attendance->service()->sync([$request->service_id[$i] => ['value' => $value, 'gain' => $gain]], false);
                }

                if ($attendance) {
                    return response()->json(['success' => 'Atendimento adicionado com Sucesso!'], 200);
                }
                return response()->json(['error' => 'Falha ao adicionar um novo atendimento!'], 200);
            }
            return response()->json(['error' => 'Animal não existe!'], 200);
        }
        return response()->json(['error' => 'Usuário não existe!'], 200);
    }

    public function getById(Request $request)
    {
        $attendance = Attendance::find($request->id);
        if ($attendance) {
            $attendance->user;
            $attendance->animal;
            $attendance->service;
            return $attendance;
        }
    }
    public function getByUser(Request $request)
    {
        $user_id = Auth::user()->id;
        $attendance = Attendance::with("animal","service")->where("user_id",$user_id)->get();
        return $attendance;
    }
}

