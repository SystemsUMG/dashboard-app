<?php

namespace App\Http\Controllers;


use App\Models\PoliticalPartie;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class PoliticalPartieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('app.political_parties.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function list()
    {
        $political = PoliticalPartie::all();
        return response()->json(['recordsTotal' => $political->count(), 'data' => $political]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validate = $request->validate([
                'name' =>['string', 'required'],
                'color' =>['string', 'required'],
                'image' =>['file', 'required'],
                'active' =>['boolean', 'required'],
            ]);
            $validate['image'] = $request->file('image')->store('images', 'public');
            PoliticalPartie::create($validate);
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
        $political = PoliticalPartie::find($id);
        return response()->json($political);
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
                    'color' =>['string', 'required'],
                    'image' =>['file', 'required'],
                    'active' =>['boolean', 'required'],
                ]);
                $political = PoliticalPartie::find($id);
                $political->update($validate);
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
            $political = PoliticalPartie::find($id);
            Storage::disk('public')->delete($political->image);
            $political->delete();
            $this->status_code = 200;
            $this->message = 'Se ha eliminado el partido';
        } catch (\Exception $exception) {
            $this->message = $exception->getMessage();
        } finally {
            $this->response = [
                'message' => $this->message
            ];
        }
        return response()->json($this->response, $this->status_code);
    }
}
