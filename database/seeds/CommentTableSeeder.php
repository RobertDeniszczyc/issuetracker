<?php

use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $commentArray = [
                            [
                                'user_id' => 1,
                                'issue_id' => 1,
                                'content' => $faker->sentences($nb = 6, $asText = true),
                                'created_at' => date("Y-m-d H:i:s"),
                                'updated_at' => date("Y-m-d H:i:s")
                            ]
                        ];

        foreach ($commentArray as $comment) {
            $this->storeComment($comment);
        }
    }

    private function storeComment($comment) 
    {
         DB::table('comments')->insert([
            $comment
        ]);
    }
}
