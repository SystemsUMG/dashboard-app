<?php

namespace App\Http\Controllers;

use App\Models\PoliticalParty;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;
use Illuminate\Support\Facades\Storage;

class PoliticalPartyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('app.political-parties.index');
    }

    public function list(Request $request)
    {
        $data = PoliticalParty::on($this->connection());
        $this->response = $this->listData($request, $data);
        return response()->json($this->response);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $validate = $request->validate([
                'name' => ['required', 'string'],
                'color' => ['required', 'string'],
                'image' => ['required', 'file'],
                'active' => ['required'],
            ]);
            $validate['image'] = $request->file('image')->store('images', 'public');
            PoliticalParty::on($this->connection())->create($validate);
            $this->response_type = 'success';
            $this->message = 'Se ha creado el registro';
        } catch (Exception $exception) {
            $this->message = $exception->getMessage();
        } finally {
            return back()->with($this->response_type, $this->message);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $political_party = PoliticalParty::on($this->connection())->find($id);
        return response()->json($political_party);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {

        try {
            $validate = $request->validate([
                'name' => ['required', 'string'],
                'color' => ['required', 'string'],
                'image' => ['nullable', 'file'],
                'active' => ['required'],
            ]);
            $political_party = PoliticalParty::on($this->connection())->find($id);
            if ($request->file('image')) {
                $validate['image'] = $request->file('image')->store('images', 'public');
                Storage::disk('public')->delete($political_party->image);
            }
            $political_party->update($validate);
            $this->response_type = 'success';
            $this->message = 'Se ha actualizado el registro';
        } catch (Exception $exception) {
            $this->message = $exception->getMessage();
        } finally {
            return back()->with($this->response_type, $this->message);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $political_party = PoliticalParty::on($this->connection())->find($id);
            $image_url = $political_party->image;
            $political_party->delete();
            Storage::disk('public')->delete($image_url);
            $this->status_code = 200;
            $this->message = 'Se ha eliminado el registro';
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
