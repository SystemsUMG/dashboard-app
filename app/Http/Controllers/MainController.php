<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Municipality;
use App\Models\PoliticalParty;
use App\Models\Vote;
use App\Models\Voter;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $departments = Department::on($this->connection())->with('municipalities')->get();
        $political_parties = PoliticalParty::on($this->connection())->get();
        return view('app.main.index', compact('departments', 'political_parties'));
    }

    public function municipalities(Request $request)
    {
        $municipalities = Municipality::on($this->connection())->where('department_id', $request->department_id)->get();
        return response()->json($municipalities);
    }

    public function searchVoter(Request $request) {
        $voter = Voter::on($this->connection())->where('cui', $request->cui)->with('municipality.department')->first();
        return response()->json($voter);
    }

    public function saveVote(Request $request)
    {
        $validate = $request->validate([
            'voter_id' => ['required', 'string'],
            'political_party_id' => ['required', 'string'],
        ]);
        $vote = Vote::on($this->connection())->where('voter_id', $validate['voter_id'])->first();
        $this->message = 'Ya se ha registrado un voto con este CUI';
        $this->response_type = 'info';
        if (!$vote) {
            $vote = Vote::on($this->connection())->create($validate);
            $this->message = 'Se ha registrado el voto correctamente';
            $this->response_type = 'success';
        }
        return response()->json(['data' => $vote, 'message' => $this->message, 'result' => $this->response_type]);
    }

    public function dashboard(Request $request) {
        $validate = $request->validate([
            'department_id' => ['required', 'integer'],
            'municipality_id' => ['required', 'integer'],
        ]);

        if ($validate['municipality_id'] != 0) {
            $votes = Vote::on($this->connection())->whereRelation('voter', 'municipality_id', $validate['municipality_id']);
            $voters = Voter::on($this->connection())->where('municipality_id', $validate['municipality_id']);
            $political_parties = PoliticalParty::on($this->connection())->withCount(['votes' => function($votes) use($validate) {
                $votes->whereRelation('voter', 'municipality_id', $validate['municipality_id']);
            }])->orderBy('votes_count', 'DESC');
        } elseif ($validate['department_id'] != 0) {
            $votes = Vote::on($this->connection())->whereHas('voter', function ($voter) use($validate) {
                $voter->whereRelation('municipality', 'department_id', $validate['department_id']);
            });
            $voters = Voter::on($this->connection())->whereRelation('municipality', 'department_id', $validate['department_id']);
            $political_parties = PoliticalParty::on($this->connection())->withCount(['votes' => function($votes) use($validate) {
                $votes->whereHas('voter', function ($voter) use($validate) {
                    $voter->whereRelation('municipality', 'department_id', $validate['department_id']);
                });
            }])->orderBy('votes_count', 'DESC');
        } else {
            $votes = Vote::on($this->connection());
            $voters = Voter::on($this->connection());
            $political_parties = PoliticalParty::on($this->connection())->withCount('votes')->orderBy('votes_count', 'DESC');
        }
        $departments = Department::on($this->connection())->get();
        $votes_per_departments = [];
        foreach ($departments as $department) {
            $votes_per_departments[] = [
                'name' => $department->name,
                'value' => Vote::on($this->connection())->whereHas('voter', function ($voter) use ($department) {
                    $voter->whereRelation('municipality', 'department_id', $department->id);
                })->count(),
            ];
        }

        $political_parties_collect = collect($political_parties->get());
        $votes_collect = collect($votes->get());
        $voters_collect = collect($voters->get());

        $labels = [];
        $colors = [];
        $values = [];
        foreach ($political_parties_collect as $political_party) {
            $labels[] = $political_party->name;
            $colors[] = $political_party->color;
            $values[] = $political_party->votes_count;
        }

        $this->response = [
            'votes' => $votes_collect->count(),
            'voters' => $voters_collect->count(),
            'political_parties' => $political_parties_collect->count(),
            'graphics' => [
                'votes' => [
                    'labels' => $labels,
                    'values' => $values,
                    'colors' => $colors,
                ],
                'departments' => $votes_per_departments,
                'voters' => Voter::on($this->connection())->with('municipality.department')
                    ->orderBy('id', 'DESC')->take(10)->get()
            ]
        ];
        return response()->json($this->response);
    }
}
