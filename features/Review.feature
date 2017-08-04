# features/Review.feature
Feature: Manage review
  In order to manage reviews
  As a client software developer
  I need to be able to retrieve, create, update and delete them trough the API.

  Background:
    Given I am connected as "denis@denis.fr" with password "password"
    And There are "video" "/videos/1"

  @refreshSchema
  @requiresOAuth
  Scenario: Create a review
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/reviews" with body:
    """
    {
      "content": "string",
      "video": "/videos/1",
      "dateReview": "2017-02-04T09:36:08.044Z",
      "author": "/profiles/1"
    }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
        "@context": "/contexts/Review",
        "@id": "/reviews/1",
        "@type": "Review",
        "id": 1,
        "content": "string",
        "video": "/videos/1",
        "dateReview": "2017-02-04T09:36:08+00:00",
        "replies": [],
        "author": "/profiles/1"
    }
    """

  Scenario: See reply in reviews
    Given There are "reply" "/replies/1,/replies/2" which have "review" "/reviews/1"
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/reviews/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Review",
      "@id": "/reviews/1",
      "@type": "Review",
      "id": 1,
      "content": "string",
      "video": "/videos/1",
      "dateReview": "2017-02-04T09:36:08+01:00",
      "replies": [
          "/replies/1",
          "/replies/2"
      ],
      "author": "/profiles/1"
    }
    """

  Scenario: Throw errors when there is only bad properties
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/reviews" with body:
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
      "hydra:description": "content: This value should not be blank.\ndateReview: This value should not be blank.",
      "violations": [
        {
          "propertyPath": "content",
          "message": "This value should not be blank."
        },
        {
          "propertyPath": "dateReview",
          "message": "This value should not be blank."
        }
      ]
    }
    """

  Scenario: Update review
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "PUT" request to "/reviews/1" with body:
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
      "@context": "/contexts/Review",
      "@id": "/reviews/1",
      "@type": "Review",
      "id": 1,
      "content": "stringUpdated",
      "video": "/videos/1",
      "dateReview": "2017-02-04T09:36:08+01:00",
      "replies": [
          "/replies/1",
          "/replies/2"
      ],
      "author": "/profiles/1"
    }
    """

  Scenario: Delete a review
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "DELETE" request to "/reviews/1"
    Then the response status code should be 204

  Scenario: Delete a comment which not exists
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "DELETE" request to "/reviews/1"
    Then the response status code should be 404
