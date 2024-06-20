<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Mail\ProjectAssigned;
use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ProjectController extends Controller
{
    use SoftDeletes;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $inputClients = Client::all();
        $inputDeadlines = [
            'all' => 'All',
            'expired' => 'Expired',
            'today' => 'Today',
            'expires_in_three_days' =>  'Expires in three days'
        ];
        $projectRequest = request('project');
        $clientId = request('client_id');
        $deadline = request('deadline');

        /** @var Projects $projects */
        $projects = Project::when($projectRequest, function ($query) use ($projectRequest) {
            $query->where('title',  'like', "%$projectRequest%");
        })
        ->when($clientId, function ($query) use ($clientId) {
            $query->where('client_id', $clientId);
        })
        ->when($deadline == 'expired', function ($query) {
            $today = now()->startOfDay();
            $query->where('deadline', '<', $today);

        })
        ->when($deadline == 'today', function ($query) {
            $dataInicio = now()->startOfDay();
            $dataFim = $dataInicio->copy()->endOfDay();

            $query->whereBetween('deadline', [ $dataInicio, $dataFim ]);

        })
        ->when($deadline == 'expires_in_three_days', function($query){
            $dataInicio = now()->startOfDay();
            $dataFim = $dataInicio->copy()->addDays(2)->endOfDay();

            $query->whereBetween('deadline', [ $dataInicio, $dataFim ]);
        })
        ->latest()->orderBy('deadline', 'asc')->paginate(10);

        return view('projects.index', [
            'projects' => $projects,
            'clients' => $inputClients,
            'deadlines' => $inputDeadlines
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $clients = Client::all();
        $users = User::all();

        return view('projects.create', ['clients' => $clients, 'users' => $users] );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $project = $request->all();
        $project['status'] = 'open';

        $project = Project::create($project);

        $user = User::find($request->user_id);

        Mail::to($user)->send(new ProjectAssigned($project));

        session()->flash('messageSuccess','Project successfully created!');

        return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $project = Project::findOrFail($id);

        return view('projects/project', ['project' => $project]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        $clients = Client::all();
        $users = User::all();

        return view('projects/edit', ['project' => $project, 'clients' => $clients, 'users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, $id)
    {
        $project = Project::findOrFail($id);

        $project->update($request->all());

        session()->flash('messageSuccess','Project successfully updated!');

        return redirect()->route('projects.show', ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        $project->delete();

        session()->flash('messageSuccess','Project successfully deleted!');

        return redirect(route('index'));
    }

    public function updateStatus($id, Request $request){

        $status = $request->input('status');
        $project = Project::findOrFail($id);
        $project->update([
            'status' => $status
        ]);

        return $project->status;
    }
}
