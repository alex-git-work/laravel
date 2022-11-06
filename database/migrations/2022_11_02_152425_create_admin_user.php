<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
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
            $user = new User([
                'role_id' => Role::ADMIN,
                'name' => env('ADMIN_NAME', 'admin'),
                'email' => config('mail.admin.address'),
                'password' => Hash::make(env('ADMIN_PASSWORD', 'admin')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            $user->save();
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
            $user = User::where('role_id', '=', Role::ADMIN);
            $user?->delete();
        }
    }
};
