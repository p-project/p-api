# features/Annotation.feature
Feature: Manage forum
  In order to manage account
  As a client software developer
  I need to be able to retrieve, create, update and delete them trough the API.

  @createSchema
  @requiresOauth
  Scenario: I am connected as Denis with passwowrd: password
    Given I am connected as "denis" with password "password"

  Scenario: Create an account
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/accounts" with body:
    """
    {
      "username": "string",
      "email": "string@string.fr",
      "firstName": "string",
      "lastName": "string",
      "password": "password",
      "salt": "salt"
    }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
        "@context": "/contexts/Account",
        "@id": "/accounts/2",
        "@type": "Account",
        "id": 2,
        "username": "string",
        "email": "string@string.fr",
        "firstName": "string",
        "lastName": "string",
        "channels": [],
        "views": [],
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
      "numberView": 120,
      "channel": "/channels/1",
      "hash": "Abdsbfs",
      "magnet": "string",
      "metadata":
      {
        "height": 100,
        "width": 100,
        "format": "mp3"
      }
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
      "numberView": 120,
      "annotations": [],
      "channel": "/channels/1",
      "comments": [],
      "forums": [],
      "views": [],
      "reviews": [],
      "subtitles": [],
      "categories": [],
      "metadata": {
          "@id": "/metadatas/1",
          "@type": "Metadata",
          "id": 1,
          "height": 100,
          "width": 100,
          "format": "mp3"
      },
      "seeders": [],
      "hash": "Abdsbfs",
      "magnet": "string"
    }
    """

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

  @dropSchema
  Scenario: Delete a comment which not exists
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "DELETE" request to "/forums/1"
    Then the response status code should be 404
