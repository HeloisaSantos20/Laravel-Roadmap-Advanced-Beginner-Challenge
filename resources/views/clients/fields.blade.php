<div class="grid grid-cols-2 gap-8 py-4">
    <div class="flex flex-col">
        <label for="company">Company</label>
        <input type="text" name="company" value="{{isset($client->company) ? $client->company : ''}}" required />
    </div>

    <div class="flex flex-col">
        <label for="telephone">Telephone</label>
        <input type="text" name="telephone" value="{{isset($client->telephone) ? $client->telephone : ''}}" required />
    </div>

    <div class="flex flex-col">
        <label for="email">Email</label>
        <input type="text" name="email" value="{{isset($client->email) ? $client->email : ''}}" required />
    </div>

    <div class="flex flex-col">
        <label for="address">Address</label>
        <input type="text" name="address" value="{{isset($client->address) ? $client->address : ''}}" required />
    </div>
</div>