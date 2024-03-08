<?php

namespace App\Listeners;

use App\Events\NewProjectAdded;
use App\Models\ClientUser;
use App\Models\Notification;
use App\Models\product_add;
use App\Models\type_service;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewProjectNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */

    public function handle(NewProjectAdded $event): void
    {
        info('cnvm');
        $project = $event->prdt_task;

        $users = User::whereIn('user_type', ['admin', 'tech', 'user'])->get();
        $product = product_add::with('client_pdt')->find($project->product_id);
        $services_name=type_service::find($project->type_services_id);
        $msg=$services_name->service_name;
        info($event->prdt_task);
        foreach ($users as $user) {
            $notificationData = ['project_id' => $product->product_code, 'message' => 'New Job Added: ' . $msg];

            if (in_array($user->user_type, ['admin', 'tech'])) {
                $notification = new Notification([
                    'admin_id' => $user->id,
                    'product_tasks_id' => $project->id,
                    'data' => json_encode($notificationData),
                ]);
                $notification->save();
            }

            if ($user->user_type === 'user' && ($user->id == $product->client_pdt->user_id) )
            {

                $client = ClientUser::find($product->client_id);

                if ($client->suboffice === 'main') {
                    $notification = new Notification([
                        'admin_id' => $client->user_id,
                        'product_tasks_id' => $project->id,
                        'data' => json_encode($notificationData),
                    ]);
                    $notification->save();
                }
                else

                {
                    $notification = new Notification([
                        'admin_id' => $client->user_id,
                        'product_tasks_id' => $project->id,
                        'data' => json_encode($notificationData),
                    ]);
                    $notification->save();

                    $client2 = ClientUser::where('suboffice', $client->suboffice)->first();

                    $client3 = ClientUser::where('id', $client2->suboffice)->first();

                    info($client2 );
                    $notification = new Notification([
                        'admin_id' => $client3->user_id,
                        'product_tasks_id' => $project->id,
                        'data' => json_encode($notificationData),
                    ]);
                    $notification->save();
                }
            }
        }
    }
}
