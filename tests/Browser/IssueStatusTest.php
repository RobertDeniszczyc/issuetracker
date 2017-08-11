<?php

namespace Tests\Browser;

use App\User;
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
                    ->assertPathIs('/issuestatus/create');
        });
    }
}