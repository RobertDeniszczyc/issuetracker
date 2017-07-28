<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Chrome;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Symfony\Component\Console\Output\ConsoleOutput;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;
    
    private $output;

    function __construct() {
        $this->output = new ConsoleOutput();
    }


    /**
     * Test the login logs the user in when providing valid inputs
     *
     * @return void
     */
    public function testLoginIsSuccessfulWhenProvidingValidInputs()
    {
        
        $this->output->writeln('Running testLoginIsSuccessfulWhenProvidingValidInputs...');

        $user = factory(User::class)->create([
            'email' => 'user@test.com',
        ]);

        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                    ->type('email', $user->email)
                    ->type('password', 'secret')
                    ->press('Login')
                    ->assertPathIs('/home');
        });
    }
}