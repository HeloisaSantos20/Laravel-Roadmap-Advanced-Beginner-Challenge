<div class="grid grid-cols-2 gap-8 py-4">
    <div class="flex flex-col">
        <label for="title">Task*</label>
        <input type="text" name="title" value="{{ old('title', $task->title ?? '') }}" required />
    </div>
    <div class="flex flex-col">
        <label for="project_id">Project*</label>
        <select class="js-select" name="project_id" required>
            @foreach ($projects as $project)
            <option value="{{ $project->id }}" {{ (old('project_id') == $project->id || (isset($task->project_id) && $task->project_id == $project->id)) ? 'selected' : '' }}>
                {{ $project->title }}
            </option>
            @endforeach
        </select>
    </div>
    <div class="flex flex-col">
        <label for="user_id">Assigned User*</label>
        <select class="js-select" name="user_id" required>
            @foreach ($users as $user)
            <option value="{{ $user->id }}" {{ (old('user_id') == $user->id || (isset($task->user_id) && $task->user_id == $user->id)) ? 'selected' : '' }}>
                {{ $user->name }}
            </option>
            @endforeach
        </select>
    </div>
    <div class="flex flex-col">
        <label for="deadline">Deadline*</label>
        <input type="date" name="deadline"
            value="{{ old('deadline', isset($task->deadline) ? $task->getDeadline() : '') }}" required />
    </div>
</div>

<div class="flex flex-col pt-4">
    <label for="description">Description</label>
    <textarea type="text" id="description" class="hidden" name="description" >{{ old('description', isset($task->description) ? $task->description : '') }}</textarea>

</div>

@section('scripts')
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection