<?php

namespace Tests\Browser;

use App\User;
use App\Project;
use App\IssueType;
use App\IssueStatus;
use App\Issue;
use Tests\DuskTestCase;
use Laravel\Dusk\Chrome;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Symfony\Component\Console\Output\ConsoleOutput;

class IssueTest extends DuskTestCase
{
    use DatabaseMigrations;
    
    private $output;

    function __construct() {
        $this->output = new ConsoleOutput();
    }


    /**
     * Test an issue can be created when providing valid inputs
     *
     * @return void
     */
    public function testCanCreateIssueWhenProvidingValidInputs()
    {   
        $this->output->writeln('Running testCanCreateIssueWhenProvidingValidInputs...');
        
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

        $this->browse(function ($browser) use ($user, $project) {

            $browser->loginAs(User::find(1))
                    ->visit('/home')
                    ->clickLink('Add Issue')
                    ->type('title', 'Test issue')
                    ->type('description', 'This is a test issue')
                    ->press('Create Issue')
                    ->assertPathIs('/home');
        });


        $this->assertDatabaseHas('issues', [
            'title' => 'Test issue'
        ]);
    }

    /**
     * Test an issue cannot be created when providing empty required inputs
     *
     * @return void
     */
    public function testCannotCreateIssueWhenProvidingEmptyRequiredInputs()
    {   
        $this->output->writeln('Running testCannotCreateIssueWhenProvidingEmptyRequiredInputs...');
        
        $user = factory(User::class)->create([
            'email' => 'user@test.com',
        ]);

        $this->browse(function ($browser) use ($user) {

            $browser->loginAs(User::find(1))
                    ->visit('/home')
                    ->clickLink('Add Issue')
                    ->type('title', '')
                    ->type('description', 'This is a test issue')
                    ->press('Create Issue')
                    ->assertPathIs('/issues/create');
        });
    }


    /**
     * Test an issue can be edited when providing valid inputs
     *
     * @return void
     */
    public function testCanEditIssueWhenProvidingValidInputs()
    {   
        $this->output->writeln('Running testCanEditIssueWhenProvidingValidInputs...');
        
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
                    ->visit('/issues')
                    ->clickLink('Edit Issue')
                    ->type('title', 'Test edited issue')
                    ->type('description', 'This is an edited test issue')
                    ->press('Submit')
                    ->assertPathIs('/issues');
        });


        $this->assertDatabaseHas('issues', [
            'title' => 'Test edited issue'
        ]);
    }
}