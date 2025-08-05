<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (DB::table('roles')->count() === 0 && DB::table('users')->count() === 0) {
            Role::create(['name' => 'admin']);
            Role::create(['name' => 'user']);

            User::factory()->create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password')
            ])->assignRole('admin');
        }

        $this->seedIfEmpty('companies', CompanySeeder::class);
    }

    private function seedIfEmpty(
        string $table,
        string $seederClass
    ): void {
        if (DB::table($table)->count() === 0) {
            $this->call($seederClass);
        }
    }
}
