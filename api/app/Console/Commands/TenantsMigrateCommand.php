<?php

namespace App\Console\Commands;

use App\Models\Tenant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class TenantsMigrateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenants:migrate {tenant?} {--fresh} {--seed}';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($this->argument('tenant')) {
            $this->migrate(
                Tenant::find($this->argument('tenant'))
            );
        } else {
            Tenant::all()->each(
                fn ($tenant) => $this->migrate($tenant)
            );
        }
    }

    /**
     * @param \App\Tenant $tenant
     * @return int
     */
    public function migrate($tenant)
    {
        $tenant->configure()->use();
        $this->line('');
        $this->line("-----------------------------------------");
        $this->info("Migrating Tenant #{$tenant->id} ({$tenant->name})");
        $this->line("-----------------------------------------");

        $options = ['--force' => true];

        if ($this->option('seed')) {
            $options['--seed'] = true;
        }

        $this->call(
            $this->option('fresh') ? 'migrate:fresh' : 'migrate',
            $options
        );

        // Run passport:install command
        $this->line('');
        $this->line("-----------------------------------------");
        $this->info("Installing Passport for Tenant #{$tenant->id} ({$tenant->name})");
        $this->line("-----------------------------------------");

        Artisan::call('passport:install');
    }
}
