# features/Annotation.feature
Feature: Manage seeder
  In order to manage account
  As a client software developer
  I need to be able to retrieve, create, update and delete them trough the API.

  @createSchema
  @requiresOAuth
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
      "magnet": "ssdf",
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
        "magnet": "ssdf"
    }
    """

  Scenario: Create a seeder
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/seeders" with body:
    """
    {
      "platform": "string",
      "account": "/accounts/1",
      "video": "/videos/1",
      "ip": "127.0.0.1"
    }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Seeder",
      "@id": "/seeders/1",
      "@type": "Seeder",
      "id": 1,
      "platform": "string",
      "account": "/accounts/1",
      "ip": "127.0.0.1",
      "video": "/videos/1"
    }
    """

  Scenario: Throw errors when there is only bad properties
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/seeders" with body:
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
      "hydra:description": "platform: This value should not be blank.\nip: This value should not be blank.",
      "violations": [
        {
          "propertyPath": "platform",
          "message": "This value should not be blank."
        },
        {
          "propertyPath": "ip",
          "message": "This value should not be blank."
        }
      ]
    }
    """

  Scenario: Retrieve the seeds list
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/seeders"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Seeder",
      "@id": "/seeders",
      "@type": "hydra:Collection",
      "hydra:member": [
        {
          "@id": "/seeders/1",
          "@type": "Seeder",
          "id": 1,
          "platform": "string",
          "account": "/accounts/1",
          "ip": "127.0.0.1",
          "video": "/videos/1"
        }
      ],
      "hydra:totalItems": 1
    }
    """

  Scenario: Update seed
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "PUT" request to "/seeders/1" with body:
    """
    {
      "platform": "stringUpdated"
    }
    """
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Seeder",
      "@id": "/seeders/1",
      "@type": "Seeder",
      "id": 1,
      "platform": "stringUpdated",
      "account": "/accounts/1",
      "ip": "127.0.0.1",
      "video": "/videos/1"
    }
    """

  Scenario: Delete a seeder
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "DELETE" request to "/seeders/1"
    Then the response status code should be 204

  @dropSchema
  Scenario: Delete a seed which not exists
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "DELETE" request to "/seeders/1"
    Then the response status code should be 404
