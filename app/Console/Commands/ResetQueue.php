<?php

namespace App\Console\Commands;

use App\Models\Queue;
use Illuminate\Console\Command;

class ResetQueue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reset-queue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Queue::truncate();
        $this->info('Antrian berhasil direset.');
    }
}
