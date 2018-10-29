<?php

use Illuminate\Database\Seeder;
use App\DistributionList;
use App\DistributionEmail;

class DistributionListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $titles = ['Corus360 Contract Billing', 'Corus360 Contract Billing Approval	', 'Corus360 Permanent Placement', 'Corus360 Permanent Placement Approval'];
        $emails = ['newhiregrids@corus360.com', 'skite@corus360.com', 'dadam@corus360.com', 'lyang@corus360.com', 'kmiller@corus360.com', 'jcrowder@corus360.com', 'smathews@corus360.com'];

        foreach($titles as $title){
            DistributionList::create([
                'title' => $title,
            ]);
        }

        foreach($emails as $email){
            DistributionEmail::create([
                'email' => $email,
            ]);
        }

        $list = DistributionList::find(1);
        $list->distributionEmails()->sync([1,2,3,4,5,6]);

        $list = DistributionList::find(2);
        $list->distributionEmails()->sync([2,5,6]);

        $list = DistributionList::find(3);
        $list->distributionEmails()->sync([1,2,3,4,5,6]);

        $list = DistributionList::find(4);
        $list->distributionEmails()->sync([2,3,4,5,6]);
    }
}
