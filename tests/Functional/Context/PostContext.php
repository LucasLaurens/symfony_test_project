<?php

declare(strict_types=1);

namespace App\Tests\Functional\Context;

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Symfony\Component\HttpClient\HttpClient;
use PHPUnit\Framework\Assert;

class PostContext implements Context
{
    protected $response;

    /**
     * @Given I am an unauthenticated user
     */
    public function iAmAnUnauthenticatedUser()
    {
        $httpClient = HttpClient::create();
        $this->response = $httpClient->request("GET", "http://localhost:8000/homepage");

        if ($this->response->getStatusCode() != 200) {
            throw new \Exception("Not able to access");
        }

        Assert::assertNotNull($this->response);
    }

    /**
     * @When I request a list of posts from :arg1
     */
    public function iRequestAListOfPostsFrom($arg1)
    {
        $httpClient = HttpClient::create();
        $this->response = $httpClient->request("GET", $arg1);

        $responseCode = $this->response->getStatusCode();

        if ($responseCode != 200) {
            throw new \Exception("Expected a 200, but received " . $responseCode);
        }

        Assert::assertNotNull($this->response);
    }

    /**
     * @Then The results should include a post with ID :arg1
     */
    public function theResultsShouldIncludeAPostWithId($arg1)
    {
        dd($arg1);
        
        // $posts = json_decode($this->response->getContent());

        // if (is_null($posts)) {
        //     throw new \Exception('Not any post has been found');
        // }

        // foreach($posts as $post) {
        //     if ($post->id == $arg1) {
        //         return true;
        //     }
        // }

        // throw new Exception('Expected to find post with an ID of ' . $arg1 . ' , but didnt');
    }
}
