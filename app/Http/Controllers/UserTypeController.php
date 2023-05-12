<?php

namespace App\Http\Controllers;

use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserTypeController extends Controller
{

    public function index()
    {
        return view('app.user_types.index');
    }

    public function user_types()
    {
        $types = UserType::on($this->connection())->get();
        $data = [];
        foreach ($types as $type)
        {
            $data[] = [
                'id'            => $type->id,
                'description'   => $type->description,
                'active'        => $this->status[$type->active],
                'actions'       => '<button onclick="showModalEdit('.$type->id.')" type="button" class="btn btn-warning" title="Editar"><i class="fa-sharp fa-solid fa-pen-to-square"></i></button>
                                    <button onclick="destroy('."'"."user-types/".$type->id."'".')" type="button" class="btn btn-danger" title="Eliminar"><i class="fa-solid fa-trash"></i></button>'
            ];
        }
        return response()->json(['data' => $data, 'recordsTotal' => count($data)]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => ['required', 'string'],
            'active' => ['required', 'int'],
        ]);
        UserType::on($this->connection())->create($request->all());
        return back()->with('success', 'Registro creado.');
    }

    public function show($id)
    {
        $type = new UserType();
        $type->setConnection($this->connection());
        $result = $type->find($id);
        return response()->json($result);
    }


    public function update(Request $request, $id)
    {
        $type = UserType::on($this->connection())->find($id);
        $type->update($request->all());
        return back()->with('success', 'Se ha actualizado el registro.');
    }

    public function destroy($id)
    {
        try {
            $type = new UserType();
            $type->setConnection($this->connection());
            $result = $type->find($id);
            $result->delete();
            return response()->json(['message' => 'Se ha eliminado el registro']);
        } catch (\Exception) {
            return response()->json(['message' => 'Error: este registro es necesario en el sistema.'], 500);
        }

    }
}
