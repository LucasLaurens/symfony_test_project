<?php

declare(strict_types=1);

namespace App\Tests\Functional\Context;

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;

class TestContext implements Context
{
    /**
     * @Given I am an unauthenticated user
     */
    public function iAmAnUnauthenticatedUser()
    {
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
