<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="py-6 overflow-hidden bg-white shadow-sm sm:rounded-lg ">
                <div class="flex flex-col justify-between px-8 lg:flex-row sm:px-10">
                    <h1 class="text-2xl font-bold">Projects</h1>
                    <a href="/projects/create"
                        class="text-white rounded-lg px-5 py-3 items-center justify-between bg-[#7700ff] my-4 lg:my-0">
                        <i class="fa fa-solid fa-plus fa-lg" style="color: white; padding-right: 10px"></i>
                        Add Project
                    </a>
                </div>
                @include('projects.search')
                <table class="w-full mx-auto divide-y table-auto">
                    <thead>
                        <tr>
                            <th class="px-8 py-4 text-lg text-left sm:px-10">Project</th>
                            <th class="hidden px-8 py-4 text-lg text-left sm:px-10 lg:table-cell">Client</th>
                            <th class="px-8 py-4 text-lg text-left sm:px-10">Deadline</th>
                            <th class="hidden px-8 py-4 text-lg text-left sm:px-10 lg:table-cell">Status</th>

                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @if ($projects->count() > 0)
                            @foreach ($projects as $project)
                                <tr class="font-light text-violet-950">
                                    <td class="table-cell px-8 py-2 sm:px-10">
                                        <a href="/projects/{{ $project->id }}"
                                            class="hover:underline">{{ $project->title }}</a>
                                    </td>

                                    <td class="hidden px-8 py-2 lg:table-cell sm:px-10">
                                        <a href="/clients/{{ $project->client->id }}"
                                            class="hover:underline">{{ $project->client->company }}</a>
                                    </td>

                                    <td class="table-cell px-8 py-2 sm:px-10">
                                        {{ \Carbon\Carbon::parse($project->deadline)->format('d/m/Y') }}
                                    </td>

                                    <td class="hidden py-2 pl-8 lg:table-cell sm:pl-10">
                                        {{ $project->status }}

                                    </td>

                                    <td class="hidden px-8 py-2 lg:table-cell sm:px-10">
                                        <div class="flex">
                                            @if (Auth::user()->hasPermission('projects-update'))
                                                <a class="inline-flex items-center px-4 py-6 mr-2 text-sm font-medium bg-white border rounded-lg text-violet-950 hover:bg-slate-100 border-slate-200"
                                                    href="{!! route('projects.edit', [$project->id]) !!}">
                                                    <i class="fa-regular fa-pen-to-square fa-xl"></i>
                                                </a>
                                            @endif
                                            @if (Auth::user()->hasPermission('projects-delete'))
                                                <form action="{!! route('projects.destroy', [$project->id]) !!}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button
                                                        onclick="return confirm('Are you sure you want to delete this project?')"
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
                                No projects found
                            </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div class="px-8 py-2 pagination sm:px-10">
                    {{ $projects->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
