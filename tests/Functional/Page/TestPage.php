<?php

declare(strict_types=1);

namespace App\Tests\Functional\Page;

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;

class TestPage implements Context
{
    /**
     * @Given I am an unauthenticated user
     */
    public function iAmAnUnauthenticatedUser()
    {
        dd("test");
        throw new PendingException();
    }

    /**
     * @When I request of my base route :arg1
     */
    public function iRequestOfMyBaseRoute($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then I shouldn't see any errors
     */
    public function iShouldntSeeAnyErrors()
    {
        throw new PendingException();
    }
}
