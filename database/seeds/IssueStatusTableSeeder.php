<?php

use Illuminate\Database\Seeder;

class IssueStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statusTitleArray = ['Open', 'In progress', 'Closed'];

        foreach ($statusTitleArray as $statusTitle) {
            $this->insertIssueStatus($statusTitle);
        }
    }

    private function insertIssueStatus($statusTitle) 
    {
         DB::table('issue_statuses')->insert([
            'user_id' => 1,
            'name' => $statusTitle
        ]);
    }
}
