<?php

use App\Permission;
use App\Role;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesAndPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('label')->nullable();
            $table->timestamps();
        });

        $adminRole = Role::create([
            'name' => 'admin',
            'label' => 'Administrator'
        ]);

        Role::create([
            'name' => 'client',
            'label' => 'Klient'
        ]);

        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('label')->nullable();
            $table->timestamps();
        });

        $adminAccessPermission = Permission::create([
            'name' => 'admin-access',
            'label' => 'Dostęp do panelu administracyjnego'
        ]);
        $usersManagePermission = Permission::create([
            'name' => 'users-manage',
            'label' => 'Możliwość zarządzania użytkownikami'
        ]);

        Schema::create('permission_role', function (Blueprint $table) {
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->foreign('permission_id')
                ->references('id')
                ->on('permissions')
                ->onDelete('cascade');
            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->onDelete('cascade');
            $table->primary(['permission_Id', 'role_id']);
        });

        DB::insert('insert into `permission_role` (`permission_id`, `role_id`) values (?, ?)', [
            $adminAccessPermission->id,
            $adminRole->id,
        ]);
        DB::insert('insert into `permission_role` (`permission_id`, `role_id`) values (?, ?)', [
            $usersManagePermission->id,
            $adminRole->id
        ]);

        Schema::create('role_user', function (Blueprint $table) {
            $table->integer('role_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->primary(['role_id', 'user_id']);
        });

        $user = User::find(1);

        if ($user !== null) {
            DB::insert('insert into `role_user` (`role_id`, `user_id`) values (?, ?)', [
                $adminRole->id,
                $user->id
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permission_role');
        Schema::dropIfExists('role_user');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('permissions');
    }

}
