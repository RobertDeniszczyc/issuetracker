<?php

use Illuminate\Database\Seeder;

class IssueTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $issueArray = [
                            [
                                'user_id' => 1,
                                'project_id' => 1,
                                'issue_type_id' => 1,
                                'status_id' => 1,
                                'title' => $faker->sentences($nb = 1, $asText = true),
                                'description' => $faker->sentences($nb = 6, $asText = true),
                                'created_at' => date("Y-m-d H:i:s"),
                                'updated_at' => date("Y-m-d H:i:s")
                            ]
                        ];

        foreach ($issueArray as $issue) {
            $this->storeIssue($issue);
        }
    }

    private function storeIssue($issue) 
    {
         DB::table('issues')->insert([
            $issue
        ]);
    }
}
