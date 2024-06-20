<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold">{{ $user->name }}</h1>


                <div class="grid md:grid-cols-2 gap-6 py-4">
                    <div>
                        <h2 class="font-bold">Email</h2>
                        <p class="text-sm">
                            {{$user->email}}
                        </p>
                    </div>
                    <div>
                        <h2 class="font-bold">Permission</h2>
                        <p class="text-sm">
                            {{$user->roles()->value('name')}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
