<?php

namespace App\View\Components;

use App\Models\AdminUser;
use App\Models\ClientUser;
use App\Models\techUser;
use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class profile extends Component
{
    public $title;
    public $taskCounts;

    public function __construct($title)
    {


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
        $this->taskCounts=$data->avatar;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|string
    {
        return view('components.profile-component', [
            'taskCounts' => $this->taskCounts,
        ]);
    }
}
