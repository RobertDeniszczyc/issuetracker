<?php

namespace Tests\Browser;

use App\User;
use App\IssueStatus;
use Tests\DuskTestCase;
use Laravel\Dusk\Chrome;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Symfony\Component\Console\Output\ConsoleOutput;

class IssueStatusTest extends DuskTestCase
{
    use DatabaseMigrations;
    
    private $output;

    function __construct() {
        $this->output = new ConsoleOutput();
    }


    /**
     * Test an issue status can be created when providing valid inputs
     *
     * @return void
     */
    public function testCanCreateIssueStatusWhenProvidingValidInputs()
    {   
        $this->output->writeln('Running testCanCreateIssueStatusWhenProvidingValidInputs...');
        
        $user = factory(User::class)->create([
            'email' => 'user@test.com',
        ]);

        $this->browse(function ($browser) use ($user) {

            $browser->loginAs(User::find(1))
                    ->visit('/home')
                    ->clickLink('Create Issue Status')
                    ->type('name', 'Open')
                    ->press('Create')
                    ->assertPathIs('/home');
        });


        $this->assertDatabaseHas('issue_statuses', [
            'name' => 'Open'
        ]);
    }

    /**
     * Test an issue status cannot be created when providing no name
     *
     * @return void
     */
    public function testCannotCreateIssueStatusWhenProvidingNoName()
    {   
        $this->output->writeln('Running testCannotCreateIssueStatusWhenProvidingNoName...');
        
        $user = factory(User::class)->create([
            'email' => 'user@test.com',
        ]);

        $this->browse(function ($browser) use ($user) {

            $browser->loginAs(User::find(1))
                    ->visit('/home')
                    ->clickLink('Create Issue Status')
                    ->type('name', '')
                    ->press('Create')
                    ->assertPathIs('/issue-status/create');
        });
    }

    /**
     * Test an issue status can be edited when providing valid inputs
     *
     * @return void
     */
    public function testCanEditIssueStatusWhenProvidingValidInputs()
    {   
        $this->output->writeln('Running testCanEditIssueStatusWhenProvidingValidInputs...');
        
        $user = factory(User::class)->create([
            'email' => 'user@test.com',
        ]);

        $user = factory(IssueStatus::class)->create([
            'name' => 'Test Status',
        ]);

        $this->browse(function ($browser) use ($user) {

            $browser->loginAs(User::find(1))
                    ->visit('/issue-status')
                    ->clickLink('Edit Issue Status')
                    ->type('name', 'Not started')
                    ->press('Submit')
                    ->assertPathIs('/home');
        });

        $this->assertDatabaseHas('issue_statuses', [
            'name' => 'Not started'
        ]);
    }

    /**
     * Test an issue status can be destroyed
     *
     * @return void
     */
    public function testCanDestroyIssueStatus()
    {
        $this->output->writeln('Running testCanDestroyIssueStatus...');

        $user = factory(User::class)->create([
            'email' => 'user@test.com',
        ]);

        $user = factory(IssueStatus::class)->create([
            'name' => 'Test Status',
        ]);


        $this->browse(function ($browser) use ($user) {

            $browser->loginAs(User::where('email', 'user@test.com')->first())
                    ->visit('/issue-status')
                    ->press('Delete Issue Status')
                    ->assertPathIs('/issue-status');
        });

        $this->assertDatabaseMissing('issue_statuses', [
            'name' => 'Test Status'
        ]);
    }
}