<?php

namespace Prem\LaravelArtisanShortcuts\Commands;

use Illuminate\Console\Command;

class ShortcutCommand extends Command
{
    protected $signature = 'ps {cmd} {name?}';
    protected $description = 'Run Laravel Artisan commands via shortcut aliases';

    public function handle()
    {
        $cmd = $this->argument('cmd');
        $name = $this->argument('name');

        // $shortcuts = [
        //     'm' => "make:model $name -mcr",
        //     'c' => "make:controller {$name}Controller",
        //     'r' => "route:list",
        //     's' => "serve",
        //     'mig' => "migrate",
        // ];
        $shortcuts = [
            // Make commands
            'm'  => "make:model $name -mcr",           // model + migration + controller + resource
            'c'  => "make:controller {$name}Controller", // controller
            'f'  => "make:factory {$name}Factory",     // factory
            'sdr' => "make:seeder {$name}Seeder",      // seeder
            'p'  => "make:policy {$name}Policy",       // policy
            'migc' => "make:migration create_{$name}_table", // migration create
            'migf' => "migrate --force",               // migrate force
        
            // Migration commands
            'mi' => "migrate",                         // migrate
            'mir' => "migrate:reset",                  // migrate reset
            'mib' => "migrate:rollback",               // migrate rollback
            'mip' => "migrate:refresh",                // migrate refresh
            'mis' => "migrate:status",                 // migrate status
            'mif' => "migrate --path=database/migrations/{$name}.php", // run specific migration
        
             // Serve
            's' => "serve",

            // Seeder commands
            'sd' => "db:seed",                         // db seed
            'sdf' => "db:seed --force",                // db seed force
            'sdc' => "db:seed --class={$name}Seeder",  // seed specific class
        
            // Route commands
            'rl' => "route:list",                      // route list
            'rc' => "route:cache",                     // route cache
            'rcl' => "route:clear",                    // route clear
        
            // Cache/config/view
            'cc' => "cache:clear",                     // clear cache
            'cfgc' => "config:cache",                  // config cache
            'cfgcl' => "config:clear",                 // config clear
            'vc' => "view:clear",                      // view clear
            'opt' => "optimize",                       // optimize
        
            // Tinker
            'tk' => "tinker",                          // tinker shell
        ];
        
        

        if (!isset($shortcuts[$cmd])) {
            $this->error("Unknown shortcut: $cmd");
            return 1;
        }

        $this->info("Running: php artisan {$shortcuts[$cmd]}");
        passthru("php artisan {$shortcuts[$cmd]}");
        return 0;
    }
}
