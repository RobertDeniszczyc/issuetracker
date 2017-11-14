<?php

namespace Tests\Browser;

use App\User;
use App\IssueType;
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
                    ->assertPathIs('/issue-type');
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
                    ->assertPathIs('/issue-type/create');
        });
    }

    /**
     * Test an issue type can be edited when providing valid inputs
     *
     * @return void
     */
    public function testCanEditIssueTypeWhenProvidingValidInputs()
    {   
        $this->output->writeln('Running testCanEditIssueTypeWhenProvidingValidInputs...');
        
        $user = factory(User::class)->create([
            'email' => 'user@test.com',
        ]);

        $user = factory(IssueType::class)->create([
            'name' => 'Test Type',
        ]);

        $this->browse(function ($browser) use ($user) {

            $browser->loginAs(User::find(1))
                    ->visit('/issue-type')
                    ->clickLink('Edit Issue Type')
                    ->type('name', 'Test')
                    ->press('Submit')
                    ->assertPathIs('/issue-type');
        });

        $this->assertDatabaseHas('issue_types', [
            'name' => 'Test'
        ]);
    }

    /**
     * Test an issue type can be destroyed
     *
     * @return void
     */
    public function testCanDestroyIssueType()
    {
        $this->output->writeln('Running testCanDestroyIssueType...');

        $user = factory(User::class)->create([
            'email' => 'user@test.com',
        ]);

        $user = factory(IssueType::class)->create([
            'name' => 'Test Type',
        ]);

        $this->browse(function ($browser) use ($user) {

            $browser->loginAs(User::where('email', 'user@test.com')->first())
                    ->visit('/issue-type')
                    ->press('Delete Issue Type')
                    ->assertPathIs('/issue-type');
        });

        $this->assertDatabaseMissing('issue_types', [
            'name' => 'Test Type'
        ]);
    }
}