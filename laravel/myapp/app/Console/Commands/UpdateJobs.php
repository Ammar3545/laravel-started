<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Console\Command;

class UpdateJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update-jobs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update job feild';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $order=Order::create();
    }
}
