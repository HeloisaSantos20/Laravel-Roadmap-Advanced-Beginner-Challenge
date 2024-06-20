<div class="px-8 sm:px-10 lg:my-4">
    <form action="{{ route('tasks.index') }}" method="get" class="lg:grid lg:grid-cols-4 lg:gap-x-4 lg:gap-y-2 items-end">
        <div class="flex flex-col py-2">
            <label for="task">Task</label>
            <input type="text" name="task" value="{{ request('task') }}">
        </div>
        <div class="flex flex-col py-2">
            <label for="project_id">Project</label>
            <select class="js-select" name="project_id">
                <option value="">All</option>
                @foreach ($projects as $project)
                    <option value="{{ $project->id }}" @if (request('project_id') == $project->id) selected @endif>
                        {{ $project->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex flex-col py-2">
            <label for="deadline">Deadline</label>
            <select class="js-select" name="deadline">
                @foreach ($deadlines as $key => $value)
                    <option value="{{ $key }}" @if (request('deadline') == $key) selected @endif>
                        {{ $value }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-green-600 px-6 py-2 rounded-lg text-white h-[42px] my-2">Search</button>
    </form>
</div>