<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold">{{ $task->title }}</h1>

                <div class="flex flex-col mt-6">
                    <label for="status" class="font-bold">Status</label>
                    <select class="js-select max-w-40" name="status" id="task-status" required data-task-id="{{$task->id}}"
                        onchange="updateStatus()">
                        @foreach(App\Models\Task::STATUS as $status)
                        <option value="{{ $status }}" {{ $task->status == $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                        @endforeach
                        @csrf
                    </select>
            </div>

                <div class="grid grid-cols-2 gap-3 py-4">
                    <div>
                        <h2 class="font-bold">Created at</h2>
                        <p class="text-sm">
                            {{ Carbon\Carbon::parse($task->created_at)->format('d/m/Y') }}
                        </p>
                    </div>
                    <div>
                        <h2 class="font-bold">Deadline</h2>
                        <p class="text-sm">
                            {{ Carbon\Carbon::parse($task->deadline)->format('d/m/Y') }}
                        </p>
                    </div>
                    <div>
                        <h2 class="font-bold">Assigned User</h2>
                        <p class="text-sm">{{ $task->user->name }}</p>
                    </div>
                    <div>
                        <h2 class="font-bold">Project</h2>
                        <p class="text-sm">{{ $task->project->title }}</p>
                    </div>
                </div>

                <h2 class="font-bold">Description</h2>
                <p class="text-sm">{!! $task->description !!}</p>
            </div>
        </div>
        </div>
    </div>
</x-app-layout>

<script>
    function updateStatus(){
        var csrf = document.querySelector('input[name="_token"]').value;
        var status = document.querySelector("#task-status");
        var taskId = status.dataset.taskId;

          fetch("/tasks/status/" + taskId, {
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

