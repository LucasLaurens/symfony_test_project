<?php

declare(strict_types=1);

namespace App\Tests\Functional\Page;

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use FriendsOfBehat\PageObjectExtension\Page\SymfonyPage;
use PHPUnit\Framework\Assert;

class TestPage extends SymfonyPage
{
    public function getRouteName(): string
    {
        return 'homepage';
    }

    /**
     * @Given I am an unauthenticated user
     */
    public function iAmAUser()
    {
        // $this->open();
        // Assert::assertNotNull($this->response);
    }

    /**
     * @When I request of my base route :arg1
     */
    public function iRequestOfMyBaseRoute($arg1)
    {
        // throw new PendingException();
        Assert::assertNotNull($arg1);
    }

    /**
     * @Then I shouldn't see any errors
     */
    public function iShouldntSeeAnyErrors()
    {
        // throw new PendingException();
    }
}
