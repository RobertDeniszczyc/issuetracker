<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Chrome;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Symfony\Component\Console\Output\ConsoleOutput;

class IssueTypeTest extends DuskTestCase
{
    use DatabaseMigrations;
    
    private $output;

    function __construct() {
        $this->output = new ConsoleOutput();
    }


    /**
     * Test an issue type can be created when providing valid inputs
     *
     * @return void
     */
    public function testCanCreateIssueTypeWhenProvidingValidInputs()
    {   
        $this->output->writeln('Running testCanCreateIssueTypeWhenProvidingValidInputs...');
        
        $user = factory(User::class)->create([
            'email' => 'user@test.com',
        ]);

        $this->browse(function ($browser) use ($user) {

            $browser->loginAs(User::find(1))
                    ->visit('/home')
                    ->clickLink('Create Issue Type')
                    ->type('name', 'Story')
                    ->press('Create')
                    ->assertPathIs('/home');
        });


        $this->assertDatabaseHas('issue_types', [
            'name' => 'Story'
        ]);
    }

    /**
     * Test an issue type cannot be created when providing no name
     *
     * @return void
     */
    public function testCannotCreateIssueTypeWhenProvidingNoName()
    {   
        $this->output->writeln('Running testCannotCreateIssueTypeWhenProvidingNoName...');
        
        $user = factory(User::class)->create([
            'email' => 'user@test.com',
        ]);

        $this->browse(function ($browser) use ($user) {

            $browser->loginAs(User::find(1))
                    ->visit('/home')
                    ->clickLink('Create Issue Type')
                    ->type('name', '')
                    ->press('Create')
                    ->assertPathIs('/issuetype/create');
        });
    }
}