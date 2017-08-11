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
            $this->storeIssueStatus($statusTitle);
        }
    }

    private function storeIssueStatus($statusTitle) 
    {
         DB::table('issue_statuses')->insert([
            'user_id' => 1,
            'name' => $statusTitle,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
    }
}
