<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Service;
use App\Animal;

class UserController extends Controller
{
    public function create(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        if ($user) {
            return Response()->json(['Success' => 'Usuário criado com Sucesso!'], 200);
        }
        return Response()->json(['error' => 'Falha ao criado o Usuário!'], 200);
    }
}
