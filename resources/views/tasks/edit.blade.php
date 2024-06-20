<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold">Edit Task</h1>

                    <form action="{{ route('tasks.edit', $task->id ) }}" method="POST">
                        @csrf
                        @method('put')
                        @include('tasks.fields')

                        <button type="submit"
                            class="inline-flex items-center justify-between px-5 py-3 mt-8 text-white bg-green-500 rounded-lg button">
                            Edit Task
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

