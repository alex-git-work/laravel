<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        if (Schema::hasColumns('users', ['role_id', 'name', 'email', 'password', 'created_at' , 'updated_at'])) {
            DB::table('users')->insert(
                [
                    'role_id' => 1,
                    'name' => env('ADMIN_NAME', 'admin'),
                    'email' => config('mail.admin.address'),
                    'password' => Hash::make(env('ADMIN_PASSWORD', 'admin')),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]
            );
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        if (Schema::hasColumn('users', 'role_id')) {
            DB::table('users')->where('role_id', '=', 1)->delete();
        }
    }
};
