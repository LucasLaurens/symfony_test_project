<?php

namespace App\Tests\Functional\Context;

use Behat\MinkExtension\Context\MinkContext;

class WebContext extends MinkContext
{
    /**
     * @When I wait for :arg1 seconds
     */
    public function iWaitForSeconds($arg1)
    {
        $this->getSession()->wait($arg1 * 1000);
    }
}
