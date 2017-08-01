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
     * Test a project can be created when providing valid inputs
     *
     * @return void
     */
    public function testCanCreateIssueWhenProvidingValidInputs()
    {   
        $this->output->writeln('Running testCanCreateIssueWhenProvidingValidInputs...');
        
        $user = factory(User::class)->create([
            'email' => 'user@test.com',
        ]);




    }
}