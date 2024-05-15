<div>
    @if ($title)
        <img src="{{ asset('storage/images/images/' . $title) }}" alt="Profile" class="rounded-circle">
    @else
        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="Profile"
            class="rounded-circle">
    @endif

</div>
