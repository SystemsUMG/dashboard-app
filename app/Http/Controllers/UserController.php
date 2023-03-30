<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('app.users.index');
    }

    public function list() {
        $users = User::all();
        $data = [];
        //dd($users);
        foreach ($users as $user) {
            $data[] = [
                'id' => $user->id,
                'name' => $user->name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'type' => $user->type->description,
                'status' => $this->status[$user->active],
                'actions' => '<button onclick="showModalEdit('.$user->id.')" type="button" class="btn btn-warning" title="Editar"><i class="fa-sharp fa-solid fa-pen-to-square"></i></button>
                                    <button onclick="destroy('."'"."users/".$user->id."'".')" type="button" class="btn btn-danger" title="Eliminar"><i class="fa-solid fa-trash"></i></button>'

            ];
        }
        return response()->json(['data' => $data, 'recordsTotal' => count($data)]);
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
