<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="py-6 overflow-hidden bg-white shadow-sm sm:rounded-lg ">
                <div class="flex flex-col justify-between px-8 lg:flex-row sm:px-10">
                    <h1 class="text-2xl font-bold">Tasks</h1>
                    <a href="{{ route('tasks.create') }}"
                        class="text-white rounded-lg px-5 py-3 items-center justify-between bg-[#7700ff] my-4 lg:my-0">
                        <i class="fa fa-solid fa-plus fa-lg" style="color: white; padding-right: 10px"></i>
                        Add Task
                    </a>
                </div>
                @include('tasks.search')
                <table class="w-full mx-auto divide-y table-auto">
                    <thead>
                        <tr>
                            <th class="px-8 py-4 text-lg text-left sm:px-10">Task</th>
                            <th class="hidden px-8 py-4 text-lg text-left sm:px-10 lg:table-cell">Project</th>
                            <th class="px-8 py-4 text-lg text-left sm:px-10">Deadline</th>

                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @if ($tasks->count() > 0)
                        @foreach ($tasks as $task)
                            <tr class="font-light text-violet-950">
                                <td class="table-cell px-8 py-2 sm:px-10">
                                    <a href="{{ route('tasks.show', [$task->id]) }}"
                                        class="hover:underline">{{ $task->title }}</a>
                                </td>

                                <td class="hidden px-8 py-2 sm:px-10 lg:table-cell">
                                    <a href="{{ route('projects.show', [$task->project->id]) }}}}"
                                        class="hover:underline">{{ $task->project->title }}</a>
                                </td>

                                <td class="table-cell px-8 py-2 sm:px-10">
                                    {{ \Carbon\Carbon::parse($task->deadline)->format('d/m/Y') }}</td>


                                <td class="hidden px-8 py-2 lg:table-cell sm:px-10">
                                    <div class="flex">
                                        @if (Auth::user()->hasPermission('tasks-update'))
                                            <a class="inline-flex items-center px-4 py-6 mr-2 text-sm font-medium bg-white border rounded-lg text-violet-950 hover:bg-slate-100 border-slate-200"
                                                href="{!! route('tasks.edit', [$task->id]) !!}">
                                                <i class="fa-regular fa-pen-to-square fa-xl"></i>
                                            </a>
                                        @endif
                                        @if (Auth::user()->hasPermission('tasks-delete'))
                                            <form action="{!! route('tasks.destroy', [$task->id]) !!}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button
                                                    onclick="return confirm('Are you sure you want to delete this task?')"
                                                    class="inline-flex items-center px-4 py-6 space-x-1 text-sm font-medium bg-white border rounded-lg text-violet-950 hover:bg-slate-100 border-slate-200">
                                                    <i class="fa-regular fa-trash-can fa-xl"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                        </tr>
                        @endforeach
                        @else
                            <tr></tr>
                            <td colspan="4" class="text-center py-2 sm:px-10">
                                No tasks found
                            </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div class="px-8 py-2 pagination sm:px-10">
                    {{ $tasks->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
