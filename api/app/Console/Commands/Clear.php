<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class Clear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emasbd-cache:clear';

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
        $this->info('Executing cache clear');
        Artisan::call('cache:clear');
        $this->line("-----------------------------------------");
        $this->info('Executing route clear');
        Artisan::call('route:clear');
        $this->line("-----------------------------------------");
        $this->info('Executing view clear');
        Artisan::call('view:clear');
        $this->line("-----------------------------------------");
        $this->info('Executing config cache');
        Artisan::call('config:cache');
        $this->line("-----------------------------------------");
        $this->info('Executing artisan optimize');
        Artisan::call('optimize');
        $this->line("-----------------------------------------");
    }
}
