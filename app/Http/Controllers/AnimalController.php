<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Animal;
use App\User;
use Illuminate\Support\Facades\Auth;

class AnimalController extends Controller
{
    public function create(Request $request)
    {
        $user_id = Auth::user()->id;

        if (User::find($user_id)) {
            $animal = $request->all();

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = $animal['name'].date('Ymd').date('His').'.'.$image->getClientOriginalExtension();
                // $resize_image = Image::make($image->getRealPath())->resize(300,300)->save();
                $image->storeAs('\images\animal\profile', $name);
                $animal['image'] = url('storage/images/animal/profile/'.$name);
            }else{
                $animal['image'] = '';
            }
            $animal['user_id'] = $user_id;
            $animal = Animal::create($animal);
            if ($animal) {
                return response()->json(['success' => 'Animal criado com Sucesso!'], 200);
            }
            return response()->json(['error' => 'Falha ao criar um novo animal'], 200);
        }
        return response()->json(['error' => 'Usuário não existe'], 200);
    }

    public function getAll()
    {
        $animal = Animal::all();
        return $animal;
    }

    public function getByUser()
    {
        $animal = Animal::where('user_id',Auth::user()->id)->get();
        return $animal;
    }

    public function getById(Request $request)
    {
        $animal = Animal::find($request->id);
        if ($animal) {
            $animal->attendances;
            return $animal;
        }
        return response()->json(['error' => 'Este animal não existe!'], 200);
    }

    // public function getByUserId(Request $request){
    //     $user = User::find(Auth::user()->id);
    //     if($user){
    //         $animal = Animal::find($request->id);
    //         $animal->where('user_id','=',Auth::user()->id);
    //         if($animal){
    //             return $animal;
    //         }
    //         return Response()->json(['error'=>'Animal não existe'],200);
    //     }
    //     return Response()->json(['error'=>'usuário não existe'],200);
    // }

    public function update(Request $request)
    {
        $animal = Animal::find($request->id);
        if ($animal) {
            $data = $request->all();
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = $animal['name'].date('Ymd').date('His').'.'.$image->getClientOriginalExtension();
                $image->storeAs('\images\animal\profile', $name);
                $animal['image'] = url('storage/images/animal/profile/'.$name);
            }else{
                $animal['image'] = '';
            }
            $animal->update($data);
            return response()->json(['success' => 'Animal atualizado com Sucesso!'], 200);
        }
        return response()->json(['error' => 'Este animal não existe!'], 200);
    }

    public function delete(Request $request)
    {
        $animal = Animal::find($request->id);
        if ($animal) {
            $animal->delete();
            return response()->json(['success' => 'Animal excluido com Sucesso!'], 200);
        }
        return response()->json(['error' => 'Este animal não existe!'], 200);
    }
}
