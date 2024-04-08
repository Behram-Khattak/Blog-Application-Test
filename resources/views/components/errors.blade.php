@props(['errors' => null])

@if ($errors && (is_array($errors) || $errors->all()))
  <div class="bg-red-100 text-red-600 flex flex-col items-stretch space-y-3 p-4 mb-2 border border-red-300 rounded-lg">
    <div class="flex flex-col space-y-1 pb-1.5 border-b border-red-300">
      <h4 class="text-lg font-medium">Errors encounteded!</h4>
    </div>
    <ul class="list-decimal pl-4 space-y-0.5 flex flex-col">
      @foreach ((is_array($errors) ? $errors : $errors->all()) as $error)
        <li class="text-sm">{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
