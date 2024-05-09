<?php

namespace App\Http\Controllers;

use App\Mail\DemoMail;
use App\Models\aprovalquotation;
use App\Models\mail_sending;
use App\Models\product_add;
use App\Models\product_task;
use App\Models\signatures;
use App\Models\task_data;
use App\Models\techUser;
use App\Models\User;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;

class MailController extends Controller
{
      public function index($id,$id2)
    {
        $imagePaths = array(
            public_path() . '/admin/assets/img/Asset_6@4x.png',
            public_path() . '/admin/assets/img/Asset_6@4x.png',
            public_path() . '/admin/assets/img/watermark.png',
            public_path() . '/admin/assets/img/Footer_1@4x.png',
        );

        // Initialize an array to store base64 encoded images
        $base64Images = array();

        foreach ($imagePaths as $key => $path) {
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $imageData = file_get_contents($path);
            $base64Image = 'data:image/' . $type . ';base64,' . base64_encode($imageData);
            $base64Images["image$key"] = $base64Image;
        }

        $data = product_add::with(['equip_pdt', 'client_pdt', 'client_pdt.users', 'warranty'])->find($id);
        $mailData = [
            'title' => 'GarageXpert',
             'body' => 'http://127.0.0.1:8000/admin/joballocation/job_pdf_dowmload/eyJpdiI6IlgvYmJ3VWgxQmI2WE54MXd3UklDWmc9PSIsInZhbHVlIjoiWU1pOVhZNFY0KzZkWG95bTI3c1JGUT09IiwibWFjIjoiN2ExZThmNzhhMDc3NDg4YTZkOGFjN2ViYWI0MmU2MTZmY2QzYzA0NTUyYjZmYzQzNjc5M2YyNDg0NDIyOGFjZiIsInRhZyI6IiJ9',
             'base64Images' => $base64Images['image2'],
             'data'=>$data,
            ];

            $data_mail=mail_sending::where('product_tasks_id',$id2)->where('product_id',$id)->get();

            $recipients = $data->client_pdt->users->email;
           // Assuming $recipients is already defined with your primary recipient(s)
$recipients = ['recipient1@example.com', 'recipient2@example.com'];

// Initialize an empty array for BCC recipients
$bccRecipients = [];

// Check if $data_mail is set and not empty
if (!empty($data_mail)) {
    foreach ($data_mail as $data) {
        // Assuming each $data is an object with an 'email' property
        if (isset($data->email)) {
            // Add each email to the BCC recipients array
            $bccRecipients[] = $data->email;
        }
    }
}

            // if(($data_mail))
            // {
            //     foreach($data_mail as $data_mail)
            //     {
            //         $bccRecipients = [
            //             'ashiqakkarayil@gmail.com',
            //             $data_mail->email,

            //         ];

            //     }

            // }
            // else
            // {
            //     $bccRecipients = [
            //         'ashiqakkarayil@gmail.com',


            //     ];
            //     Mail::to($recipients)->cc($bccRecipients)->send(new DemoMail($mailData));
            // }

            Mail::to($recipients)->cc($bccRecipients)->send(new DemoMail($mailData));



    }

    public function jobpdfdowmload_mail(Request $request, $id)
    {
        $id = decrypt($id);
        $data = product_add::with(['equip_pdt', 'client_pdt', 'client_pdt.users', 'warranty'])->find($id);
        $prdt_task = product_task::with(['Type_service', 'task', 'users_pdt', 'sign'])->where('product_id', $data->product_id)->get();
        $prdt_task_2 = product_task::where('product_id', $data->product_id) // Sort by created_at in descending order
            ->first();

        foreach ($prdt_task as $task) {

            $admin_id = $task->admin_id;
            $pdut_id = $task->id;

            $product_id_job = $task->product_id;
        }
        $taskHistoryArray = [];


        $taskNames = [];

        $taskHistoryArray = []; // Initialize the array outside the loop

        foreach ($prdt_task as $task) {
            $mergedArray = []; // Initialize the merged array for each task

            $taskId = $task->id;

            $task_id_name = $task->Type_service->service_name;
            $taskNames[$taskId] = $task_id_name;
            $taskHistory = json_decode($task->taskhistory, true);

            $keyNames = array_keys($taskHistory);

            // Sort task history items by date and time
            usort($keyNames, function ($a, $b) use ($taskHistory) {
                $dateTimeA = Carbon::parse($taskHistory[$a]['date_time']);
                $dateTimeB = Carbon::parse($taskHistory[$b]['date_time']);
                return $dateTimeA <=> $dateTimeB;
            });

            foreach ($keyNames as $key) {
                $details = $taskHistory[$key];
                $details['name'] =  $key;
                $details['task_name_status'] = task_data::find($details['task_id'])->task_name;
                $details['user_name'] = User::find($details['user_id'])->name;
                $details['assign_name'] = User::find($details['assign'])->name;
                $details['Services'] = $task->type_service->service_name;
                if(isset($details['date_of_schedule']))
                {
                    $details['Date_Of_Schedule'] = $details['date_of_schedule'];
                }


                $dateTime = Carbon::parse($details['date_time']);
                $details['date'] = $dateTime->toDateString();
                $details['time'] = $dateTime->toTimeString();

                if (isset($details['signatures_data'])) {
                    $details['signatures_data'] = signatures::find($details['signatures_data']);
                }
                if (isset($details['quotationValue_name'])) {
                    $details['quotationValue_value_data'] = $details['Quotation_value'];
                }
                if (isset($details['aproval_waiting'])) {
                    $details['aproval_waiting'] =aprovalquotation::find($details['aproval_waiting']);
                }

                $mergedArray[$key] = $details;
            }

            $taskHistoryArray[$taskId] = $mergedArray; // Use the task ID as the key in the task history array
        }


        $tech = techUser::all();

        $imagePaths = array(
            public_path() . '/admin/assets/img/header@4x.png',
            public_path() . '/admin/assets/img/Garage-Logo-White.png',
            public_path() . '/admin/assets/img/watermark.png',
            public_path() . '/admin/assets/img/Footer_1@4x.png',

        );

        // Associative array to store base64 encoded images
        $base64Images = array();

        foreach ($imagePaths as $key => $path1) {
            $type = pathinfo($path1, PATHINFO_EXTENSION);
            $imagePathsdata = file_get_contents($path1);
            $base64Image = 'data:image/' . $type . ';base64,' . base64_encode($imagePathsdata);
            $base64Images["image$key"] = $base64Image;
        }

        $path = public_path() . '/admin/assets/img/header@4x.png';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data1 = file_get_contents($path);
        $image = 'data:image/' . $type . ';base64,' . base64_encode($data1);

        // $tech = techUser::all();
        $data2 = ['base64Images' => $base64Images, 'image' => $image, 'data' =>  $data, 'prdt_task' => $prdt_task, 'admin_id' => $admin_id, 'pdut_id' => $pdut_id, 'tech' => $tech, 'taskHistoryArray' => $taskHistoryArray, 'product_id_job' => $product_id_job, 'prdt_task_2' => $prdt_task_2, 'taskNames' => $taskNames];


        $html = view('admin.Pdf.pdfdownload', $data2)->render();
        $pdf = PDF::loadHTML($html);
        return $pdf->download($data->product_code . '.pdf');
    }

}
