# features/Seeder.feature
Feature: Manage seeder
  In order to manage seeders
  As a client software developer
  I need to be able to retrieve, create, update and delete them trough the API.

  Background:
    Given I am connected as "denis@denis.fr" with password "password"
    And There are "video" "/videos/1"

  @refreshSchema
  @requiresOAuth
  Scenario: Create a seeder
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/seeders" with body:
    """
    {
      "platform": "string",
      "userProfile": "/user_profiles/1",
      "video": "/videos/1",
      "ip": "127.0.0.1"
    }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Seeder",
      "@id": "/seeders/1",
      "@type": "Seeder",
      "id": 1,
      "platform": "string",
      "userProfile": "/user_profiles/1",
      "ip": "127.0.0.1",
      "video": "/videos/1"
    }
    """

  Scenario: Throw errors when there is only bad properties
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/seeders" with body:
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
      "hydra:description": "platform: This value should not be blank.\nip: This value should not be blank.",
      "violations": [
        {
          "propertyPath": "platform",
          "message": "This value should not be blank."
        },
        {
          "propertyPath": "ip",
          "message": "This value should not be blank."
        }
      ]
    }
    """

  Scenario: Retrieve the seeds list
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/seeders"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Seeder",
      "@id": "/seeders",
      "@type": "hydra:Collection",
      "hydra:member": [
        {
          "@id": "/seeders/1",
          "@type": "Seeder",
          "id": 1,
          "platform": "string",
          "userProfile": "/user_profiles/1",
          "ip": "127.0.0.1",
          "video": "/videos/1"
        }
      ],
      "hydra:totalItems": 1
    }
    """

  Scenario: Update seed
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "PUT" request to "/seeders/1" with body:
    """
    {
      "platform": "stringUpdated"
    }
    """
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Seeder",
      "@id": "/seeders/1",
      "@type": "Seeder",
      "id": 1,
      "platform": "stringUpdated",
      "userProfile": "/user_profiles/1",
      "ip": "127.0.0.1",
      "video": "/videos/1"
    }
    """

  Scenario: Delete a seeder
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "DELETE" request to "/seeders/1"
    Then the response status code should be 204

  Scenario: Delete a seed which not exists
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "DELETE" request to "/seeders/1"
    Then the response status code should be 404
