<?php

namespace App\Providers;

use App\Models\product_task;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;

class CustomServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {


        Blade::directive('nullOrValue', function ($expression) {
            $params = explode(',', $expression);
            $param1 = $params[0] ?? null;
            $param2 = $params[1] ?? null;

            return "<?php echo (!empty($param1) ? $param1 : '<span class=\"placeholder-text\">Please Enter ' . $param2 . ' <i class=\"bi bi-exclamation-circle\"></i></span>'); ?>";
        });
        Blade::directive('nullOrValuenostyle', function ($expression) {
            $params = explode(',', $expression);
            $param1 = $params[0] ?? null;
            $param2 = $params[1] ?? null;

            return "<?php echo (!empty($param1) ? $param1 : 'Please Enter ' . $param2  ); ?>";
        });
        Blade::directive('countTaskStatus', function ($expression) {
            $count =trim($expression, "()");


$count=DB::table('product_tasks')->where('task_id', $count )->count();
            // $count = product_task::where('task_id', $count )->count();

            return "<?php echo e($count); ?>";

        });
        
    }
}
