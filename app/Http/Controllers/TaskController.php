<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tasks\TaskRequest;
use App\Mail\TaskAssigned;
use App\Models\Client;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $projects = Project::all();
        $inputDeadlines = [
            'all' => 'All',
            'expired' => 'Expired',
            'today' => 'Today',
            'expires_in_three_days' =>  'Expires in three days'
        ];
        $projectRequest = request('project_id');
        $deadline = request('deadline');
        $taskRequest = request('task');

        /** @var Tasks $tasks */
        $tasks = Task::when($taskRequest, function ($query) use ($taskRequest) {
            $query->where('title',  'like', "%$taskRequest%");
        })
        ->when($projectRequest, function ($query) use ($projectRequest) {
            $query->where('project_id', $projectRequest);
        })
        ->when($deadline == 'expired', function ($query) {
            $today = now()->startOfDay();
            $query->where('deadline', '<', $today);

        })
        ->when($deadline == 'today', function ($query) {
            $dataInicio = now()->startOfDay();
            $dataFim = $dataInicio->copy()->endOfDay();
            $query->whereBetween('deadline', [ $dataInicio, $dataFim]);

        })
        ->when($deadline == 'expires_in_three_days', function($query){
            $dataInicio = now()->startOfDay();
            $dataFim = $dataInicio->copy()->addDays(2)->endOfDay();

            $query->whereBetween('deadline', [ $dataInicio, $dataFim]);
        })
        ->latest()->orderBy('deadline', 'asc')->paginate(10);

        return view('tasks.index', [
            'tasks' => $tasks,
            'projects' => $projects,
            'deadlines' => $inputDeadlines
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = Project::all();
        $users = User::all();

        return view('tasks.create', ['projects' => $projects, 'users' => $users] );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        $task = $request->validated();
        $task['finished'] = 0;


        $task = Task::create($task);
        
        $user = User::find($request->user_id);
        
        Mail::to($user)->send(new TaskAssigned($task));

        session()->flash('messageSuccess','Task successfully created!');

        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);

        return view('tasks/task', ['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $clients = Client::all();
        $projects = Project::all();
        $users = User::all();


        return view('tasks/edit', ['task' => $task, 'clients' => $clients, 'users' => $users, 'projects' => $projects]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->update($request->all());

        session()->flash('messageSuccess','Task successfully updated!');

        return redirect()->route('tasks.show', [$task->id] );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $task = task::findOrFail($id);

        $task->delete();

        session()->flash('messageSuccess','Task successfully deleted!');

        return redirect(route('tasks.index'));
    }

    public function updateStatus($id, Request $request){

        $status = $request->input('status');
        $task = Task::findOrFail($id);
        $task->update([
            'status' => $status
        ]);

        session()->flash('messageSuccess','Task status successfully updated!');

        return $task->status;
    }
}
