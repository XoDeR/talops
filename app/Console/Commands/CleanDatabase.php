<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CleanDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Truncate all user facing tables while preserving schema';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Cleaning database...');

        $tables = $this->getUserFacingTables();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        foreach ($tables as $table) {
            try {
                DB::table($table)->truncate();
                $this->line("Truncated: $table");
            } catch (\Exception $e) {
                $this->warn("Skipped: $table — " . $e->getMessage());
            }
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->info('Database cleaned successfully.');
    }

    private function getUserFacingTables(): array
    {
        $tables = DB::select('SHOW TABLES');
        $key = 'Tables_in_' . DB::getDatabaseName();

        $systemTables = [
            'cache', 'cache_locks', 'failed_jobs', 'job_batches', 'jobs',
            'migrations', 'sessions', 'password_reset_tokens',
        ];

        return collect($tables)
            ->pluck($key)
            ->filter(fn ($table) => !in_array($table, $systemTables))
            ->values()
            ->toArray();
    }

}
