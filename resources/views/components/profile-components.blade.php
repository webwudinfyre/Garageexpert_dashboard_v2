<div>
    {{ $taskCounts }}
    {{-- @if ($taskCounts)
    <img src="{{ asset('storage/images/images/' . $data->avatar) }}" alt="Profile" class="rounded-circle">
@else
    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="Profile"
        class="rounded-circle">
@endif --}}

@if ($taskCounts)
    <img src="{{ asset('storage/images/images/' . $data->avatar) }}" alt="Profile" class="rounded-circle">
@else
    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="Profile"
        class="rounded-circle">
@endif
</div>
