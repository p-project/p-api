# features/Account.feature
Feature: Manage account
  In order to manage accounts
  As a client software developer
  I need to be able to retrieve, create, update and delete them trough the API.

  Background:
    Given I am connected as "denis@denis.fr" with password "password"

  @refreshSchema
  @requiresOAuth
  Scenario: Create an account
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/accounts" with body:
    """
    {
      "email": "string@string.fr",
      "password": "password",
      "salt": "salt"
    }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Account",
      "@id": "/accounts/2",
      "@type": "Account",
      "username": "string@string.fr",
      "email": "string@string.fr",
      "salt": "salt",
      "roles": [
          "ROLE_USER"
      ],
      "password": "password",
      "id": 2,
      "profile": "/profiles/2"
    }
    """

  Scenario: Throw errors when there is only bad properties
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/accounts" with body:
    """
    {
    }
    """
    Then the response status code should be 400
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/ConstraintViolationList",
      "@type": "ConstraintViolationList",
      "hydra:title": "An error occurred",
      "hydra:description": "email: This value should not be blank.\nsalt: This value should not be blank.\npassword: This value should not be blank.",
      "violations": [
        {
          "propertyPath": "email",
          "message": "This value should not be blank."
        },
        {
          "propertyPath": "salt",
          "message": "This value should not be blank."
        },
        {
          "propertyPath": "password",
          "message": "This value should not be blank."
        }
      ]
    }
    """

  Scenario: Get his own account
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/accounts/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Account",
      "@id": "/accounts/1",
      "@type": "Account",
      "username": "",
      "email": "denis@denis.fr",
      "salt": "salt",
      "roles": [
          "ROLE_USER"
      ],
      "password": "password",
      "id": 2,
      "profile": "/profiles/1"
    }
    """

  Scenario: Get another account
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/accounts/2"
    Then the response status code should be 403

  Scenario: Update his account
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "PUT" request to "/accounts/1" with body:
    """
    {
    }
    """
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
        "@context": "/contexts/Account",
        "@id": "/accounts/2",
        "@type": "Account",
        "id": 2,
        "username": "stringUpdated",
        "email": "string@string.fr",
        "firstName": "string",
        "lastName": "string",
        "channels": [],
        "views": [],
        "forums": [],
        "networks": [],
        "playlists": [],
        "replies": [],
        "reviews": [],
        "sustainabilityOffers": [],
        "seeders": []
    }
    """

  Scenario: Update another account
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "PUT" request to "/accounts/2" with body:
    """
    {
      "username": "stringUpdated"
    }
    """
    Then the response status code should be 403


  Scenario: Delete an account
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "DELETE" request to "/accounts/2"
    Then the response status code should be 403
