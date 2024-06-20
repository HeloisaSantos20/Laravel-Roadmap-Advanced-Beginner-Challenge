<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold">{{ $client->company }}</h1>

                <div class="grid md:grid-cols-2 gap-6 py-4">
                    <div>
                        <h2 class="font-bold">Email</h2>
                        <p class="text-sm">
                            {{$client->email}}
                        </p>
                    </div>
                    <div>
                        <h2 class="font-bold">Telephone</h2>
                        <p class="text-sm">
                            {{$client->telephone}}
                        </p>
                    </div>
                    <div>
                        <h2 class="font-bold">Address</h2>
                        <p class="text-sm">
                            {{$client->address}}
                        </p>
                    </div>
                </div>
                @if ($client->projects)
                <div class="pt-8">
                    <p class="font-bold text-xl pb-2">Last Projects</p>
                    <table class="table-auto w-full divide-y">
                        <thead>
                          <tr>
                            <th class="py-3 text-left">Project</th>
                            <th class="py-3 text-left hidden md:table-cell">Assigned User</th>
                            <th class="py-3 text-left">Deadline</th>
                          </tr>
                        </thead>
                        <tbody class="divide-y">
                            @foreach ($client->projects->sortByDesc('created_at')->take(5) as $project )
                                <tr class=" font-light">
                                    <td class="table-cell py-2">
                                        <a href="{{ route('projects.show', [$project->id]) }}" class="hover:underline text-sm">{{ $project->title }}</a>
                                    </td>
        
                                    <td class="hidden md:table-cell py-2">
                                        <a href="{{ route('users.show', [$project->user->id]) }}" class="hover:underline text-sm">{{ $project->user->name }}</a>
                                    </td>
        
                                    <td class="table-cell py-2 text-sm">{{  \Carbon\Carbon::parse($project->deadline)->format('d/m/Y') }}</td>
        
                                    @if(Auth::user()->hasPermission('projects-update'))
                                        <td class="hidden lg:table-cell py-2">
                                            <div class="flex">
                                                <a
                                                class="py-6 px-4 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-lg font-medium px-3 py-1 inline-flex mr-2 items-center"  href="{!! route('projects.edit', [$project->id])  !!}">
                                                    <i class="fa-regular fa-pen-to-square fa-xl"></i>
                                                </a>
                                                <form action="{!! route('projects.destroy', [$project->id]) !!}" method="POST">
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

