<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold">{{ $project->title }}</h1>

                <div class="flex flex-col mt-6">
                        <label for="status" class="font-bold">Status</label>
                        <select class="js-select max-w-40" name="status" id="project-status" required data-project-id="{{$project->id}}"
                            onchange="updateStatus()">
                            @foreach(App\Models\Task::STATUS as $status)
                            <option value="{{ $status }}" {{ $project->status == $status ? 'selected' : '' }}>
                                {{ ucfirst($status) }}
                            </option>
                            @endforeach
                            @csrf
                        </select>
                </div>

                <div class="grid grid-cols-2  lg:grid-cols-4 py-6">
                    <div>
                        <p class="font-bold">Created at</p>
                        <p class="text-sm">
                            {{ Carbon\Carbon::parse($project->created_at)->format('d/m/Y') }}
                        </p>
                    </div>
                    <div>
                        <p class="font-bold">Deadline</p>
                        <p class="text-sm">
                            {{ Carbon\Carbon::parse($project->deadline)->format('d/m/Y') }}
                        </p>
                    </div>
                </div>

                <div class="pb-6">
                    <p class="font-bold">Assigned User</p>
                    <p class="text-sm">{{ $project->user->name }}</p>
                </div>

                <p class="font-bold">Description</p>
                <p class="text-sm">{!! $project->description !!}</p>

                <div class="w-full h-[1.5px] bg-[#e5e7eb] my-8"></div>

                @if ($project->tasks)
                    <div>
                        <p class="font-bold text-2xl pb-2">Tasks</p>
                        <table class="table-auto w-full divide-y">
                            <thead>
                              <tr>
                                <th class="py-3 text-left">Task</th>
                                <th class="py-3 text-left hidden md:table-cell">Assigned User</th>
                                <th class="py-3 text-left">Deadline</th>
                              </tr>
                            </thead>
                            <tbody class="divide-y">
                                @foreach ($project->tasks as $task )
                                    <tr class=" font-light">
                                        <td class="table-cell py-2">
                                            <a href="{{ route('tasks.show', [$task->id]) }}" class="hover:underline text-sm">{{ $task->title }}</a>
                                        </td>
            
                                        <td class="hidden md:table-cell py-2">
                                            <a href="{{ route('users.show', [$task->user->id]) }}" class="hover:underline text-sm">{{ $task->user->name }}</a>
                                        </td>
            
                                        <td class="table-cell py-2 text-sm">{{  \Carbon\Carbon::parse($task->deadline)->format('d/m/Y') }}</td>
            
                                        @if(Auth::user()->hasPermission('projects-update'))
                                            <td class="hidden lg:table-cell py-2">
                                                <div class="flex">
                                                    <a
                                                    class="py-6 px-4 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-lg font-medium px-3 py-1 inline-flex mr-2 items-center"  href="{!! route('tasks.edit', [$task->id])  !!}">
                                                        <i class="fa-regular fa-pen-to-square fa-xl"></i>
                                                    </a>
                                                    <form action="{!! route('projects.destroy', [$task->id]) !!}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button
                                                        class="py-6 px-4 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-lg font-medium px-3 py-1 inline-flex space-x-1 items-center">
                                                            <i class="fa-regular fa-trash-can fa-xl"></i>
                                                    </button>
                                                    </form>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
        </div>
    </div>
</x-app-layout>

<script>
    
    function updateStatus(){
        var csrf = document.querySelector('input[name="_token"]').value;
        var status = document.querySelector("#project-status");
        var projectId = status.dataset.projectId;

        fetch("/projects/status/" + projectId, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrf,
            },
            body: JSON.stringify({ status: status.value }),
        }).then((response) => {
        });
    }
</script>
