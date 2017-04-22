# features/Reply.feature
Feature: Manage reply
  In order to manage reply
  As a client software developer
  I need to be able to retrieve, create, update and delete them trough the API.

  Background:
    Given I am connected as "denis" with password "password"
    And There are "Review" "/reviews/1"

  @createSchema
  @requiresOAuth
  Scenario: Create a reply
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/replies" with body:
    """
    {
      "content": "string",
      "review": "/reviews/1",
      "author": "/accounts/1",
      "dateReply": "2017-02-04T09:36:08.014Z"
    }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Reply",
      "@id": "/replies/1",
      "@type": "Reply",
      "id": 1,
      "content": "string",
      "review": "/reviews/1",
      "author": "/accounts/1",
      "dateReply": "2017-02-04T09:36:08+00:00"
    }
    """

  Scenario: Throw errors when there is only bad properties
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/replies" with body:
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
      "hydra:description": "content: This value should not be blank.\ndateReply: This value should not be blank.",
      "violations": [
        {
          "propertyPath": "content",
          "message": "This value should not be blank."
        },
        {
          "propertyPath": "dateReply",
          "message": "This value should not be blank."
        }
      ]
    }
    """

  Scenario: Retrieve the replies list
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/replies"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Reply",
      "@id": "/replies",
      "@type": "hydra:Collection",
      "hydra:member": [
        {
          "@id": "/replies/1",
          "@type": "Reply",
          "id": 1,
          "content": "string",
          "review": "/reviews/1",
          "author": "/accounts/1",
          "dateReply": "2017-02-04T09:36:08+01:00"
        }
      ],
      "hydra:totalItems": 1
    }
    """

  Scenario: Update replies
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "PUT" request to "/replies/1" with body:
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
      "@context": "/contexts/Reply",
      "@id": "/replies/1",
      "@type": "Reply",
      "id": 1,
      "content": "stringUpdated",
      "review": "/reviews/1",
      "author": "/accounts/1",
      "dateReply": "2017-02-04T09:36:08+01:00"
    }
    """

  Scenario: Delete a reply
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "DELETE" request to "/replies/1"
    Then the response status code should be 204

  @dropSchema
  Scenario: Delete a comment which not exists
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "DELETE" request to "/replies/1"
    Then the response status code should be 404
