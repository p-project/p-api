# features/Comment.feature
Feature: Manage comment
  In order to manage comments
  As a client software developer
  I need to be able to retrieve, create, update and delete them trough the API.

  Background:
    Given I am connected as "denis" with password "password"
    And There are "Video" "/videos/1"

  @createSchema
  @requiresOAuth
  Scenario: Create a comment
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/comments" with body:
    """
    {
      "content": "string",
      "dateComment": "2017-02-03T08:56:37.848Z",
      "video": "/videos/1",
      "author": "/accounts/1"
    }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Comment",
      "@id": "/comments/1",
      "@type": "Comment",
      "id": 1,
      "content": "string",
      "dateComment": "2017-02-03T08:56:37+00:00",
      "video": "/videos/1",
      "author": "/accounts/1"
    }
    """

  Scenario: Throw errors when there is only bad properties
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/comments" with body:
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
        "hydra:description": "content: This value should not be blank.\ndateComment: This value should not be blank.",
        "violations": [
            {
                "propertyPath": "content",
                "message": "This value should not be blank."
            },
            {
                "propertyPath": "dateComment",
                "message": "This value should not be blank."
            }
        ]
    }
    """

  Scenario: Retrieve the comments list
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/comments"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Comment",
      "@id": "/comments",
      "@type": "hydra:Collection",
      "hydra:member": [
        {
          "@id": "/comments/1",
          "@type": "Comment",
          "id": 1,
          "content": "string",
          "dateComment": "2017-02-03T08:56:37+01:00",
          "video": "/videos/1",
          "author": "/accounts/1"
        }
      ],
      "hydra:totalItems": 1
    }
    """

  Scenario: Update comments
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "PUT" request to "/comments/1" with body:
    """
    {
      "content": "stringUpdated"
    }
    """
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Comment",
      "@id": "/comments/1",
      "@type": "Comment",
      "id": 1,
      "content": "stringUpdated",
      "dateComment": "2017-02-03T08:56:37+01:00",
      "video": "/videos/1",
      "author": "/accounts/1"
    }
    """

  Scenario: Delete a comments
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "DELETE" request to "/comments/1"
    Then the response status code should be 204

  @dropSchema
  Scenario: Delete a comment which not exists
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "DELETE" request to "/comments/1"
    Then the response status code should be 404
