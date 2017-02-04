# features/Annotation.feature
Feature: Manage category
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
    """

  Scenario: Create a channel
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/channels" with body:
    """
    {
      "account": "/accounts/1",
      "name": "string",
      "tags": [
         "string"
      ]
    }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Channel",
      "@id": "/channels/1",
      "@type": "Channel",
      "account": "/accounts/1",
      "id": 1,
      "name": "string",
      "tags": [
        "string"
      ],
      "videos": [],
      "networks": [],
      "playlists": [],
      "sustainabilityOffers": []
    }
    """

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

  Scenario: Create a video
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/videos" with body:
    """
    {
      "title": "string",
      "description": "string",
      "uploadDate": "2017-02-01T18:30:52.055Z",
      "channel": "/channels/1",
      "categories": [
          "/categories/1"
      ]
    }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Video",
      "@id": "/videos/1",
      "@type": "Video",
      "id": 1,
      "title": "string",
      "description": "string",
      "uploadDate": "2017-02-01T18:30:52+00:00",
      "annotations": [],
      "channel": "/channels/1",
      "comments": [],
      "forums": [],
      "views": [],
      "reviews": [],
      "subtitles": [],
      "categories": [
          "/categories/1"
      ]
    }
    """

  Scenario: See videos in category
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
          "/videos/1"
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
              "/videos/1"
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
          "/videos/1"
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