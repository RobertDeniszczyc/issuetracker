<?php

namespace Tests\Browser;

use App\User;
use App\Project;
use App\IssueType;
use App\IssueStatus;
use App\Issue;
use App\Comment;
use Tests\DuskTestCase;
use Laravel\Dusk\Chrome;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Symfony\Component\Console\Output\ConsoleOutput;

class CommentTest extends DuskTestCase
{
    use DatabaseMigrations;
    
    private $output;

    function __construct() {
        $this->output = new ConsoleOutput();
    }


    /**
     * Test a comment can be added on an issue
     *
     * @return void
     */
    public function testCanAddACommentOnAnIssue()
    {   
        $this->output->writeln('Running testCanAddACommentOnAnIssue...');
        
        $user = factory(User::class)->create([
            'email' => 'user@test.com',
        ]);

        $project = factory(Project::class)->create([
            'name' => 'Test Project',
            'shortcode' => 'TEST'
        ]);

        $issueStatus = factory(IssueStatus::class)->create([
            'name' => 'Open'
        ]);

        $issueType = factory(IssueType::class)->create([
            'name' => 'Story'
        ]);

        $issue = factory(Issue::class)->create([
            'user_id' => '1'
        ]);

        $this->browse(function ($browser) use ($user, $project) {

            $browser->loginAs(User::find(1))
                    ->visit('/issues/1')
                    ->type('content', 'Test comment')
                    ->press('Comment');
        });


        $this->assertDatabaseHas('comments', [
            'content' => 'Test comment'
        ]);
    }
}