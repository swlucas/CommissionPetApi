<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Service;
use App\User;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function create(Request $request)
    {
        $user_id = Auth::user()->id;

        if (User::find($user_id)) {
            $service =$request->all();
            $service['user_id'] = $user_id;
            if (Service::create($service)) {
                return response()->json(['success' => 'Serviço criado com Sucesso!'], 200);
            }
            return response()->json(['error' => 'Falha ao criar um novo serviço'], 200);
        }
        return response()->json(['error' => 'Usuário não existe!'], 200);
        /*
        $service = Service::create($request->all());
        if ($service) {
            return response()->json(['success' => 'Serviço criado com Sucesso!'], 200);
        }
        return response()->json(['error' => 'Falha ao criar um novo serviço'], 200);
         */
    }

    public function getAll()
    {
        $service = Service::all();
        return $service;
    }

    public function getByUser()
    {
        $user_id = Auth::user()->id;
        $service = Service::where('user_id',$user_id)->get();
        return $service;
    }

    public function getById(Request $request)
    {
        $service = Service::find($request->id);
        if ($service) {
            return $service;
        }
        return response()->json(['error' => 'Este serviço não existe!'], 200);
    }


    // public function getByUserId(Request $request)
    // {
    //     $user = User::find(Auth::user()->id);
    //     if ($user) {
    //         $service = Service::find($request->id);
    //         $service->where('user_id', '=', Auth::user()->id);
    //         if ($service) {
    //             return $service;
    //         }
    //         return Response()->json(['error' => 'Serviço não existe'], 200);
    //     }
    //     return Response()->json(['error' => 'usuário não existe'], 200);
    // }

    public function update(Request $request)
    {
        $service = Service::find($request->id);
        if ($service) {
            $service->update($request->all());
            return response()->json(['success' => 'Serviço atualizado com Sucesso!'], 200);
        }
        return response()->json(['error' => 'Este serviço não existe!'], 200);
    }

    public function delete(Request $request)
    {
        $service = Service::find($request->id);
        if ($service) {
            $service->delete();
            return response()->json(['success' => 'Serviço excluido com Sucesso!'], 200);
        }
        return response()->json(['error' => 'Este serviço não existe!'], 200);
    }

}
