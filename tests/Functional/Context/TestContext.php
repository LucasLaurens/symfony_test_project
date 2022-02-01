<?php

declare(strict_types=1);

namespace App\Tests\Functional\Context;

use App\Tests\Functional\Page\TestPage;
use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;

class TestContext implements Context
{
    public function __construct(private TestPage $testPage)
    {
    }

    /**
     * @Given I am a user
     */
    public function iAmAUser()
    {
        $this->testPage->iAmAUser();
    }

    /**
     * @When I request of my base route :arg1
     */
    public function iRequestOfMyBaseRoute($arg1)
    {
        $this->testPage->iRequestOfMyBaseRoute($arg1);
    }

    /**
     * @Then I shouldn't see any errors
     */
    public function iShouldntSeeAnyErrors()
    {
        $this->testPage->iShouldntSeeAnyErrors();
    }
}
