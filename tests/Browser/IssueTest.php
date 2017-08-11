<?php

namespace Tests\Browser;

use App\User;
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

        $this->browse(function ($browser) use ($user) {

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
                    ->type('name', '')
                    ->type('description', 'This is a test issue')
                    ->press('Create Issue')
                    ->assertPathIs('/create/issue');
        });
    }
}