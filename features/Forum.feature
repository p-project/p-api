# features/Forum.feature
Feature: Manage forum
  In order to manage forums
  As a client software developer
  I need to be able to retrieve, create, update and delete them trough the API.

  Background:
    Given I am connected as "denis" with password "password"
    And There are "video" "/videos/1"

  @refreshSchema
  @requiresOAuth
  Scenario: Create a forum
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/forums" with body:
    """
    {
      "name": "string",
      "video": "/videos/1",
      "createdBy": "/accounts/1"
    }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Forum",
      "@id": "/forums/1",
      "@type": "Forum",
      "id": 1,
      "name": "string",
      "video": "/videos/1",
      "createdBy": "/accounts/1"
    }
    """

  Scenario: Throw errors when there is only bad properties
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/forums" with body:
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
        "hydra:description": "name: This value should not be blank.",
        "violations": [
            {
                "propertyPath": "name",
                "message": "This value should not be blank."
            }
        ]
    }
    """

  Scenario: Retrieve the forums list
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/forums"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Forum",
      "@id": "/forums",
      "@type": "hydra:Collection",
      "hydra:member": [
        {
          "@id": "/forums/1",
          "@type": "Forum",
          "id": 1,
          "name": "string",
          "video": "/videos/1",
          "createdBy": "/accounts/1"
        }
      ],
      "hydra:totalItems": 1
    }
    """

  Scenario: Update forums
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "PUT" request to "/forums/1" with body:
    """
    {
      "name": "stringUpdated"
    }
    """
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Forum",
      "@id": "/forums/1",
      "@type": "Forum",
      "id": 1,
      "name": "stringUpdated",
      "video": "/videos/1",
      "createdBy": "/accounts/1"
    }
    """

  Scenario: Delete a forum
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "DELETE" request to "/forums/1"
    Then the response status code should be 204

  Scenario: Delete a comment which not exists
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "DELETE" request to "/forums/1"
    Then the response status code should be 404
