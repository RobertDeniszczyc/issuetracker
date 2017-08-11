<?php

use Illuminate\Database\Seeder;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $projectArray = [
                            [
                                'user_id' => 1,
                                'name' => 'Project Tap',
                                'shortcode' => 'TAP',
                                'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                                'created_at' => date("Y-m-d H:i:s"),
                                'updated_at' => date("Y-m-d H:i:s")
                            ],
                            [
                                'user_id' => 1,
                                'name' => 'Project Dog',
                                'shortcode' => 'DOG',
                                'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                                'created_at' => date("Y-m-d H:i:s"),
                                'updated_at' => date("Y-m-d H:i:s")
                            ],
                            [
                                'user_id' => 1,
                                'name' => 'Project Tuns',
                                'shortcode' => 'TUNS',
                                'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                                'created_at' => date("Y-m-d H:i:s"),
                                'updated_at' => date("Y-m-d H:i:s")
                            ]
                        ];

        foreach ($projectArray as $project) {
            $this->storeProject($project);
        }
    }

    private function storeProject($project) 
    {
         DB::table('projects')->insert([
            $project
        ]);
    }
}
