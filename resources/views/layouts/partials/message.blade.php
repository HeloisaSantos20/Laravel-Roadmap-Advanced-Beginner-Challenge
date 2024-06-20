@if ($errors->any())
<div
class="fixed flex justify-between p-4 my-6 text-sm text-red-800 border border-red-400 rounded bg-red-50 cardMessage right-3 max-w-[80%]">
    <div class="flex flex-col">
        @foreach ($errors->all() as $error)
            <div class="flex items-center">
                <i class="fa-solid fa-circle-info"></i>
                <p class="px-2">
                    <span class="font-bold">Info:</span>
                    {{ $error }}
                    </p>
            </div>
        @endforeach
    </div>
    <div onclick="ocultarCard()" class="cursor-pointer">
        <i class="fa fa-solid fa-xmark"></i>
    </div>
</div>
@endif
@if (session()->has('messageSuccess'))
<div
    class="fixed flex justify-between p-4 my-6 text-sm text-green-800 border border-green-400 rounded bg-green-50 cardMessage right-3 max-w-[80%]">
    <div>
        <div class="flex items-center">
            <i class="fa-solid fa-circle-info"></i>
            <p class="px-2">
                <span class="font-bold">Info:</span>
                {!! session("messageSuccess") !!}
            </p>
        </div>
    </div>
    <div onclick="ocultarCard()" class="cursor-pointer">
        <i class="fa fa-solid fa-xmark"></i>
    </div>
</div>
@endif

<script>
    function ocultarCard() {
        var card = document.querySelector('.cardMessage');
        console.log(card)
        card.classList.add('hidden');
    }
</script>
