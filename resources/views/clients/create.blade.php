<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold">Create Client</h1>

                    <form action="{{ route('clients.store') }}" method="POST">
                        @csrf

                        @include('clients.fields')

                        <button type="submit"
                            class="button text-white bg-green-500 rounded-lg mt-8 px-5 py-3 inline-flex items-center justify-between">
                            Create Client
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>