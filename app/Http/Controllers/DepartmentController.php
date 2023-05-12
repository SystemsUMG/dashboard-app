<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('app.departments.index');
    }

    public function departments()
    {
        $departments = Department::all();
        return response()->json(['data' => $departments, 'recordsTotal' => count($departments)]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $validate = $request->validate([
                'name' => ['required', 'string']
            ]);
            Department::create($validate);
            $type = 'success';
            $this->message = 'Departamento creado';
        } catch (\Exception $exception) {
            $type = 'error';
            $this->message = $exception->getMessage();
        }
        return back()->with($type, $this->message);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $department = Department::find($id);
            $department->delete();
            return response()->json(['message' => 'Se ha eliminado el registro']);
        } catch (\Exception) {
            return response()->json(['message' => 'Error: este registro es necesario en el sistema.'], 500);
        }
    }
}
