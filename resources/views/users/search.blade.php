<div class="px-8 sm:px-10 lg:my-4">
    <form action="{{ route('users.index') }}" method="get" class="lg:grid lg:grid-cols-4 lg:gap-x-4 lg:gap-y-2 items-end">
        <div class="flex flex-col py-2">
            <label for="user">User</label>
            <input type="text" name="user" value="{{ request('user') }}">
        </div>
        <button type="submit" class="bg-green-600 px-6 py-2 rounded-lg text-white h-[42px] my-2">Search</button>
    </form>
</div>