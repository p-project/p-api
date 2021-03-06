# features/Metadata.feature
Feature: Manage metadata
  In order to manage metadata
  As a client software developer
  I need to be able to retrieve, create, update and delete them trough the API.

  Background:
    Given I am connected as "denis" with password "password"

  @refreshSchema
  @requiresOAuth
  Scenario: Create a metadata
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/metadatas" with body:
    """
    {
      "height": 0,
      "width": 0,
      "format": "string"
    }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Metadata",
      "@id": "/metadatas/1",
      "@type": "Metadata",
      "id": 1,
      "height": 0,
      "width": 0,
      "format": "string"
    }
    """

  Scenario: Throw errors when there is only bad properties
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/metadatas" with body:
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
      "hydra:description": "height: This value should not be blank.\nwidth: This value should not be blank.\nformat: This value should not be blank.",
      "violations": [
        {
          "propertyPath": "height",
          "message": "This value should not be blank."
        },
        {
          "propertyPath": "width",
          "message": "This value should not be blank."
        },
        {
          "propertyPath": "format",
          "message": "This value should not be blank."
        }
      ]
    }
    """

  Scenario: Retrieve the metadata list
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/metadatas"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Metadata",
      "@id": "/metadatas",
      "@type": "hydra:Collection",
      "hydra:member": [
        {
          "@id": "/metadatas/1",
          "@type": "Metadata",
          "id": 1,
          "height": 0,
          "width": 0,
          "format": "string"
        }
      ],
      "hydra:totalItems": 1
    }
    """

  Scenario: Update metadata
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "PUT" request to "/metadatas/1" with body:
    """
    {
      "format": "stringUpdated"
    }
    """
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Metadata",
      "@id": "/metadatas/1",
      "@type": "Metadata",
      "id": 1,
      "height": 0,
      "width": 0,
      "format": "stringUpdated"
    }
    """

  Scenario: Delete a metadata
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "DELETE" request to "/metadatas/1"
    Then the response status code should be 204

  Scenario: Delete a metadata which not exists
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "DELETE" request to "/metadatas/1"
    Then the response status code should be 404
