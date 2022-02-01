@test
Feature: Test

  Scenario: I just wan't to access of my base route url
    Given I am a user
    When I request of my base route "https://127.0.0.1:8000/homepage"
    Then I shouldn't see any errors
