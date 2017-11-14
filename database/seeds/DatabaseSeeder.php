<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(IssueStatusTableSeeder::class);
        $this->call(IssueTypeTableSeeder::class);
        $this->call(ProjectTableSeeder::class);
        $this->call(IssueTableSeeder::class);
        $this->call(CommentTableSeeder::class);
    }
}
