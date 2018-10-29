<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(EmailSettingsTableSeeder::class);
        $this->call(RolesPermissionsTableSeeder::class);
        $this->call(ContractBillingsTableSeeder::class);
        $this->call(PermanentPlacementsTableSeeder::class);
        $this->call(DistributionListsTableSeeder::class);
    }
}
