<div>



@php
use App\Models\User;
use App\Models\AdminUser;
use App\Models\ClientUser;
use App\Models\techUser;

$data_type=User::find($title);
        switch( $data_type->user_type)
        {
            case 'admin':
                $data=AdminUser::select('avatar')->where('user_id',$title)->first();
            break;
            case 'user':
                $data=ClientUser::select('avatar')->where('user_id',$title)->first();
            break;
            case 'tech':
                $data=techUser::select('avatar')->where('user_id',$title)->first();
            break;

        }

        @endphp


         @if ($data->avatar)
        <img src="{{ asset('storage/images/images/' . $data->avatar) }}" alt="Profile" class="rounded-circle">
    @else
        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="Profile"
            class="rounded-circle">
    @endif


</div>
