<?php

use Illuminate\Database\Seeder;

class IssueTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $typeNameArray = ['Story', 'Bug', 'Documentation'];

        foreach ($typeNameArray as $typeName) {
            $this->storeIssueType($typeName);
        }
    }

    private function storeIssueType($typeName) 
    {
         DB::table('issue_types')->insert([
            'user_id' => 1,
            'name' => $typeName,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
    }
}
