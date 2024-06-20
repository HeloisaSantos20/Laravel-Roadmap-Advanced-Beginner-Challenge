<div class="grid grid-cols-2 gap-8 py-4">
    <div class="flex flex-col">
        <label for="title">Name*</label>
        <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}"  required/>
    </div>
    <div class="flex flex-col">
        <label for="email">Email*</label>
        <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" required/>
    </div>

    @if(isset($user))
        <div class="flex flex-col">
            <label for="current_password">Current Password*</label>
            <input type="password" name="current_password" required />
        </div>
    @endif
    <div class="flex flex-col">
        <label for="password">New password*</label>
        <input type="password" name="password" required />
    </div>
    <div class="flex flex-col">
        <label for="password_confirmation">Confirm new password*</label>
        <input type="password" name="password_confirmation" required />
    </div>
</div>

<div class="flex flex-col">
    <label for="role">Permission*</label>
    <select class="js-select" name="role" required >
        @foreach($rolesList as $role)
            <option value="{{ $role['id'] }}"  {{ (old('role') == $role['id'] || (isset($user) && $user->roles->contains($role['id']))) ? 'selected' : '' }}>
                {{ $role['nome'] }}
            </option>
        @endforeach
    </select>
</div>
