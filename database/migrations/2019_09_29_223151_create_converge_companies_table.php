<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\ConvergeCompany;

class CreateConvergeCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('converge_companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->timestamps();
        });

        ConvergeCompany::create([
            'title' => 'Corus360',
        ]);

        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        $roles = ['super-admin', 'admin'];
        $permissions = [
            'view_admin_converge_companies', 'add_admin_converge_companies', 'edit_admin_converge_companies', 'delete_admin_converge_companies',
        ];

        foreach($permissions as $permission)
        {
            Permission::create(['name' => $permission]);
        }

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('converge_companies');
    }
}
