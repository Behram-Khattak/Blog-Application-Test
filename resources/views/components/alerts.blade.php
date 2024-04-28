@if (session('deleted'))
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100" role="alert">
        {{ session('deleted') }}
    </div>

    @elseif (session('created'))
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100" role="alert">
        {{ session('created') }}
    </div>

    @elseif (session('updated'))
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100" role="alert">
        {{ session('updated') }}
    </div>
@endif
