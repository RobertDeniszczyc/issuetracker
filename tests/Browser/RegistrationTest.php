<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Chrome;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Symfony\Component\Console\Output\ConsoleOutput;

class RegistrationTest extends DuskTestCase
{
    use DatabaseMigrations;

    private $output;

    function __construct() {
        $this->output = new ConsoleOutput();
    }


    /**
     * Test the registration form successfully registers a user when providing valid inputs
     *
     * @return void
     */
    public function testRegistrationIsSuccessfulWithValidInputs()
    {
        $this->output->writeln('Running testRegistrationIsSuccessfulWithValidInputs...');

        $this->browse(function ($browser) {
            $browser->visit('/register')
                    ->type('name', 'John Smith')
                    ->type('email', 'user@test.com')
                    ->type('password', 'secret')
                    ->type('password_confirmation', 'secret')
                    ->press('Register')
                    ->assertPathIs('/home');
        });
    }

    /**
     * Test the registration form does not submit when not providing the required valid inputs
     *
     * @return void
     */
    public function testRegistrationFailsWithEmptyNameField()
    {
        $this->output->writeln('Running testRegistrationFailsWithEmptyNameField...');

        $this->browse(function ($browser) {
            $browser->visit('/register')
                    ->type('name', '')
                    ->type('email', 'user@test.com')
                    ->type('password', 'secret')
                    ->type('password_confirmation', 'secret')
                    ->press('Register')
                    ->assertPathIs('/register');
        });
    }

    public function testRegistrationFailsWithEmptyEmailField()
    {
        $this->output->writeln('Running testRegistrationFailsWithEmptyEmailField...');

        $this->browse(function ($browser) {
            $browser->visit('/register')
                    ->type('name', 'John Smith')
                    ->type('email', '')
                    ->type('password', 'secret')
                    ->type('password_confirmation', 'secret')
                    ->press('Register')
                    ->assertPathIs('/register');
        });
    }

    public function testRegistrationFailsWithEmptyPasswordField()
    {
        $this->output->writeln('Running testRegistrationFailsWithEmptyPasswordField...');

        $this->browse(function ($browser) {
            $browser->visit('/register')
                    ->type('name', 'John Smith')
                    ->type('email', 'user@test.com')
                    ->type('password', '')
                    ->type('password_confirmation', 'secret')
                    ->press('Register')
                    ->assertPathIs('/register');
        });
    }

    public function testRegistrationFailsWithEmptyPasswordConfirmField()
    {
        $this->output->writeln('Running testRegistrationFailsWithEmptyPasswordConfirmField...');

        $this->browse(function ($browser) {
            $browser->visit('/register')
                    ->type('name', 'John Smith')
                    ->type('email', 'user@test.com')
                    ->type('password', 'secret')
                    ->type('password_confirmation', '')
                    ->press('Register')
                    ->assertPathIs('/register');
        });
    }
}