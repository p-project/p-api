# features/UserAccount.feature
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
    And I send a "POST" request to "/user_accounts" with body:
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
      "@context": "/contexts/UserAccount",
      "@id": "/user_accounts/2",
      "@type": "UserAccount",
      "username": "string@string.fr",
      "email": "string@string.fr",
      "salt": "salt",
      "roles": [
          "ROLE_USER"
      ],
      "password": "password",
      "id": 2,
      "userProfile": null
    }
    """

  Scenario: Throw errors when there is only bad properties
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/user_accounts" with body:
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

  Scenario: Get his own user_account
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/user_accounts/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/UserAccount",
      "@id": "/user_accounts/1",
      "@type": "UserAccount",
      "username": "denis@denis.fr",
      "email": "denis@denis.fr",
      "salt": "iakegoihtfs4w44sgsg880wg",
      "roles": [
          "ROLE_USER"
      ],
      "password": "hvXTcPLThKqPeuYBr6qebw3SBAC1PkXR78vlr5GongvcOLyOniqjJ4QTYNoNsqHewKO0K+b5HhfEJwRSk0NJjw==",
      "id": 1,
      "userProfile": "/user_profiles/1"
    }
    """

  Scenario: Get another user_account
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/user_accounts/2"
    Then the response status code should be 403

  Scenario: Update his user_account
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "PUT" request to "/user_accounts/1" with body:
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
      "@context": "/contexts/UserAccount",
      "@id": "/user_accounts/1",
      "@type": "UserAccount",
      "username": "denis@denis.fr",
      "email": "denis@denis.fr",
      "salt": "iakegoihtfs4w44sgsg880wg",
      "roles": [
          "ROLE_USER"
      ],
      "password": "hvXTcPLThKqPeuYBr6qebw3SBAC1PkXR78vlr5GongvcOLyOniqjJ4QTYNoNsqHewKO0K+b5HhfEJwRSk0NJjw==",
      "id": 1,
      "userProfile": "/user_profiles/1"
    }
    """

  Scenario: Update another user_account
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "PUT" request to "/user_accounts/2" with body:
    """
    {
      "emai": "stringUpdated@denis.fr"
    }
    """
    Then the response status code should be 403


  Scenario: Delete an user_account
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "DELETE" request to "/user_accounts/2"
    Then the response status code should be 403
