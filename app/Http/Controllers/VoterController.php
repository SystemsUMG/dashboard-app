<?php

namespace App\Http\Controllers;

use App\Models\Voter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VoterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('app.voters.index');
    }

    public function list()
    {
        $voters = Voter::on($this->connection())->get();
        return \response()->json([
            'recordsTotal' => $voters->count(),
            'data' => $voters,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => ['required', 'string'],
            'lastname' => ['required', 'string'],
            'cui' => ['required', 'numeric', 'max_digits:15', 'min_digits:13'],
            'municipality_id' => ['required', 'integer', 'exists:municipalities,id'],
        ]);
        $voter = Voter::on($this->connection())->where('cui', $validate['cui'])->with('municipality.department')->first();
        $this->message = 'Ya se ha registrado un votante con este CUI';
        $this->response_type = 'info';
        if (!$voter) {
            $voter = Voter::on($this->connection())->create($validate)->where('cui', $validate['cui'])->with('municipality.department')->first();
            $this->message = 'Se ha registrado al votante '.$voter->name.' '.$voter->lastname;
            $this->response_type = 'success';
        }
        return response()->json(['data' => $voter, 'message' => $this->message, 'result' => $this->response_type]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        //
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
    public function destroy(string $id): RedirectResponse
    {
        //
    }
}
