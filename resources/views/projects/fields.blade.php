<div class="grid grid-cols-2 gap-8 py-4">
    <div class="flex flex-col">
        <label for="title">Project</label>
        <input type="text" name="title" required />
    </div>
    <div class="flex flex-col">
        <label for="client_id">Client</label>
        <select class="js-select" name="client_id" required>
            @foreach($clients as $client)
            <option value="{{ $client->id }}">
                {{ $client->company }}
            </option>
            @endforeach
        </select>
    </div>
    <div class="flex flex-col">
        <label for="user_id">Assigned User</label>
        <select class="js-select" name="user_id" required>
            @foreach($users as $user)
            <option value="{{ $user->id }}">
                {{ $user->name }}
            </option>
            @endforeach
        </select>
    </div>
    <div class="flex flex-col">
        <label for="deadline">Deadline</label>
        <input type="date" name="deadline" required />
    </div>
</div>

<div class="flex flex-col pt-4">
    <label for="description">Description</label>
    <textarea id="description" name="description" >{{ old('description', isset($project->description) ? $project->description : '') }}</textarea>
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