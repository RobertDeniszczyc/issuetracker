<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Chrome;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Symfony\Component\Console\Output\ConsoleOutput;

class ProjectTest extends DuskTestCase
{
    use DatabaseMigrations;
    
    private $output;

    function __construct() {
        $this->output = new ConsoleOutput();
    }


    /**
     * Test a project can be created when providing valid inputs
     *
     * @return void
     */
    public function testCanCreateProjectWhenProvidingValidInputs()
    {   
        $this->output->writeln('Running testCanCreateProjectWhenProvidingValidInputs...');
        
        $user = factory(User::class)->create([
            'email' => 'user@test.com',
        ]);

        $this->browse(function ($browser) use ($user) {

            $browser->loginAs(User::find(1))
                    ->visit('/home')
                    ->clickLink('Add Project')
                    ->type('name', 'Test Project')
                    ->type('shortcode', 'TEST')
                    ->type('description', 'This is a test project')
                    ->press('Create')
                    ->assertPathIs('/home');
        });


        $this->assertDatabaseHas('projects', [
            'shortcode' => 'TEST'
        ]);
    }

    /**
     * Test a project cannot be created when providing no name
     *
     * @return void
     */
    public function testCannotCreateProjectWhenProvidingNoName()
    {   
        $this->output->writeln('Running testCannotCreateProjectWhenProvidingNoName...');
        
        $user = factory(User::class)->create([
            'email' => 'user@test.com',
        ]);

        $this->browse(function ($browser) use ($user) {

            $browser->loginAs(User::find(1))
                    ->visit('/home')
                    ->clickLink('Add Project')
                    ->type('name', '')
                    ->type('shortcode', 'TEST')
                    ->type('description', 'This is a test project')
                    ->press('Create')
                    ->assertPathIs('/projects/create');
        });
    }

    /**
     * Test a project cannot be created when providing no shortcode
     *
     * @return void
     */
    public function testCannotCreateProjectWhenProvidingNoShortcode()
    {   
        $this->output->writeln('Running testCannotCreateProjectWhenProvidingNoShortcode...');
        
        $user = factory(User::class)->create([
            'email' => 'user@test.com',
        ]);

        $this->browse(function ($browser) use ($user) {

            $browser->loginAs(User::find(1))
                    ->visit('/home')
                    ->clickLink('Add Project')
                    ->type('name', 'Test Project')
                    ->type('shortcode', '')
                    ->type('description', 'This is a test project')
                    ->press('Create')
                    ->assertPathIs('/projects/create');
        });
    }

    /**
     * Test a project can be created when providing no shortcode
     *
     * @return void
     */
    public function testCanCreateProjectWhenProvidingNoDescription()
    {   
        $this->output->writeln('Running testCanCreateProjectWhenProvidingNoDescription...');
        
        $user = factory(User::class)->create([
            'email' => 'user@test.com',
        ]);

        $this->browse(function ($browser) use ($user) {

            $browser->loginAs(User::find(1))
                    ->visit('/home')
                    ->clickLink('Add Project')
                    ->type('name', 'Test Project')
                    ->type('shortcode', 'TEST')
                    ->type('description', '')
                    ->press('Create')
                    ->assertPathIs('/home');
        });
    }

    /**
     * Test a project can be edited when providing valid inputs
     *
     * @return void
     */
    public function testCanEditProjectWhenProvidingValidInputs()
    {   
        $this->output->writeln('Running testCanEditProjectWhenProvidingValidInputs...');
        
        $user = factory(User::class)->create([
            'email' => 'user@test.com',
        ]);

        $this->browse(function ($browser) use ($user) {

            $browser->loginAs(User::find(1))
                    ->visit('/home')
                    ->clickLink('Add Project')
                    ->type('name', 'Test Project')
                    ->type('shortcode', 'TEST')
                    ->type('description', 'This is a test project')
                    ->press('Create')
                    ->assertPathIs('/home')
                    ->clickLink('View all projects')
                    ->clickLink('Edit Project')
                    ->type('name', 'TEST EDIT')
                    ->press('Submit edit')
                    ->assertPathIs('/home');
        });

        $this->assertDatabaseHas('projects', [
            'name' => 'TEST EDIT'
        ]);
    }
}