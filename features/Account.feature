# features/Account.feature
Feature: Manage account
  In order to manage account
  As a client software developer
  I need to be able to retrieve, create, update and delete them trough the API.

  @createSchema
  Scenario: Create an account
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/accounts" with body:
    """
    {
      "username": "string",
      "email": "string@string.fr",
      "firstName": "string",
      "lastName": "string"
    }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Account",
      "@id": "/accounts/1",
      "@type": "Account",
      "views": null,
      "channels": null,
      "id": 1,
      "username": "string",
      "email": "string@string.fr",
      "firstName": "string",
      "lastName": "string",
      "forums": null,
      "networks": null,
      "playlists": null,
      "replies": null,
      "reviews": null,
      "sustainabilityOffers": null,
      "seeders": null
    }
    """

  Scenario: Retrieve the book list
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/accounts"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Account",
      "@id": "/accounts",
      "@type": "hydra:Collection",
      "hydra:member": [
        {
          "@id": "/accounts/1",
          "@type": "Account",
          "views": [],
          "channels": [],
          "id": 1,
          "username": "string",
          "email": "string@string.fr",
          "firstName": "string",
          "lastName": "string",
          "forums": [],
          "networks": [],
          "playlists": [],
          "replies": [],
          "reviews": [],
          "sustainabilityOffers": [],
          "seeders": []
        }
      ],
      "hydra:totalItems": 1
    }
    """

  Scenario: Throw errors when a post is invalid
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/books" with body:
    """
    {
      "isbn": "1312",
      "title": "",
      "description": "Yo!",
      "author": "Me!",
      "publicationDate": "2016-01-01"
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
      "hydra:description": "isbn: This value is neither a valid ISBN-10 nor a valid ISBN-13.\ntitle: This value should not be blank.",
      "violations": [
        {
          "propertyPath": "isbn",
          "message": "This value is neither a valid ISBN-10 nor a valid ISBN-13."
        },
        {
          "propertyPath": "title",
          "message": "This value should not be blank."
        }
      ]
    }
    """

  # The "@dropSchema" annotation must be added on the last scenario of the feature file to drop the temporary SQLite database
  @dropSchema
  Scenario: Add a review
    When I add "Content-Type" header equal to "application/ld+json"
    When I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/reviews" with body:
    """
    {
      "rating": 5,
      "body": "Must have!",
      "author": "Foo Bar",
      "publicationDate": "2016-01-01",
      "book": "/books/1"
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
      "rating": 5,
      "body": "Must have!",
      "author": "Foo Bar",
      "publicationDate": "2016-01-01T00:00:00+00:00",
      "book": "/books/1"
    }
    """
