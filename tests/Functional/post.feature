# @core
Feature: Post

  Scenario: I want a list of posts
    Given I am an unauthenticated user
    When I request a list of posts from "http://localhost:8000/homepage"
    Then The results should include a post with ID "1"
