# features/Annotation.feature
Feature: Manage category
  In order to manage account
  As a client software developer
  I need to be able to retrieve, create, update and delete them trough the API.

  Background:
    Given I am connected as "denis" with password "password"
    Given There are channels "/channels/1, /channels/2"

  @createSchema
  @requiresOauth
  Scenario: Create a category
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/categories" with body:
    """
    {
      "name": "string",
      "description": "string"
    }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Category",
      "@id": "/categories/1",
      "@type": "Category",
      "id": 1,
      "name": "string",
      "description": "string",
      "videos": []
    }
    """

  Scenario: See videos in category
    Given There are videos "/videos/1, /videos/2"
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/categories/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Category",
      "@id": "/categories/1",
      "@type": "Category",
      "id": 1,
      "name": "string",
      "description": "string",
      "videos": [
          "/videos/1",
          "/videos/2"
      ]
    }
    """

  Scenario: Retrieve the categories list
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/categories"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Category",
      "@id": "/categories",
      "@type": "hydra:Collection",
      "hydra:member": [
        {
          "@id": "/categories/1",
          "@type": "Category",
          "id": 1,
          "name": "string",
          "description": "string",
          "videos": [
              "/videos/1",
              "/videos/2"
          ]
        }
      ],
      "hydra:totalItems": 1
    }
    """

  Scenario: Throw errors when there is only bad properties
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/categories" with body:
    """
    {
      "description": "string"
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
      "hydra:description": "name: This value should not be blank.",
      "violations": [
        {
          "propertyPath": "name",
          "message": "This value should not be blank."
        }
      ]
    }
    """

  Scenario: Update a category
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "PUT" request to "/categories/1" with body:
    """
    {
      "description": "stringUpdated"
    }
    """
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Category",
      "@id": "/categories/1",
      "@type": "Category",
      "id": 1,
      "name": "string",
      "description": "stringUpdated",
      "videos": [
          "/videos/1",
          "/videos/2"
      ]
    }
    """

  Scenario: Delete a category
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "DELETE" request to "/categories/1"
    Then the response status code should be 204

  @dropSchema
  Scenario: Delete a category which not exists
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "DELETE" request to "/categories/1"
    Then the response status code should be 404
