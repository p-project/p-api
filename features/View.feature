# features/Annotation.feature
Feature: Manage view
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

  Scenario: Create video
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/videos" with body:
    """
    {
      "title": "string",
      "description": "string",
      "uploadDate": "2017-02-01T18:30:52.055Z",
      "channel": "/channels/1"
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
      "categories": []
    }
    """

  Scenario: Create a view
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/views" with body:
    """
    {
      "account": "/accounts/1",
      "video": "/videos/1"
    }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/View",
      "@id": "/views/1",
      "@type": "View",
      "id": 1,
      "account": "/accounts/1",
      "video": "/videos/1"
    }
    """

  Scenario: Retrieve the views list
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/views"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/View",
      "@id": "/views",
      "@type": "hydra:Collection",
      "hydra:member": [
        {
          "@id": "/views/1",
          "@type": "View",
          "id": 1,
          "account": "/accounts/1",
          "video": "/videos/1"
        }
      ],
      "hydra:totalItems": 1
    }
    """

  Scenario: Delete a view
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "DELETE" request to "/views/1"
    Then the response status code should be 204

  @dropSchema
  Scenario: Delete a view which not exists
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "DELETE" request to "/views/1"
    Then the response status code should be 404
