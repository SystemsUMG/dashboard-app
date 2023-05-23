<?php

namespace App\Http\Controllers;


use App\Models\Department;
use App\Models\PoliticalPartie;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('app.departments.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function list()
    {
        $department = Department::all();
        return response()->json(['recordsTotal' => $department->count(), 'data' => $department]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validate = $request->validate([
                'name' =>['string', 'required'],
            ]);
            Department::create($validate);
            $this->response_type = 'success';
            $this->message = 'Se ha creado el partido';
        } catch (\Exception $exception) {
            $this->message = $exception->getMessage();
        }
        return redirect()->back()->with($this->response_type, $this->message);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $department = Department::find($id);
        return response()->json($department);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        {
            try {
                $validate = $request->validate([
                    'name' =>['string', 'required'],
                ]);
                $department = Department::find($id);
                $department->update($validate);
                $this->response_type = 'success';
                $this->message = 'Se ha actualizado el partido';
            } catch (\Exception $exception) {
                $this->message = $exception->getMessage();
            }
            return redirect()->back()->with($this->response_type, $this->message);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {

            $department = Department::find($id);
            $department->delete();
            $this->status_code = 200;
            $this->message = 'Se ha eliminado el Departamento';
        } catch (\Exception) {
            $this->message = 'No se ha podido eliminar';
        } finally {
            $this->response = [
                'message' => $this->message
            ];
        }
        return response()->json($this->response, $this->status_code);
    }
}
