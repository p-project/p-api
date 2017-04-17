Feature: Manage network
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

  Scenario: Create a playlists
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/playlists" with body:
    """
    {
      "name": "string",
      "account": "/accounts/1"
    }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Playlist",
      "@id": "/playlists/1",
      "@type": "Playlist",
      "id": 1,
      "name": "string",
      "channel": null,
      "network": null,
      "account": "/accounts/1"
    }
    """

  Scenario: Retrieve the playlist list
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/playlists"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Playlist",
      "@id": "/playlists",
      "@type": "hydra:Collection",
      "hydra:member": [
           {
            "@id": "/playlists/1",
            "@type": "Playlist",
            "id": 1,
            "name": "string",
            "channel": null,
            "network": null,
            "account": "/accounts/1"
          }
      ],
      "hydra:totalItems": 1
    }
    """

  Scenario: Modify name
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "PUT" request to "/playlists/1" with body:
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
      "@context": "/contexts/Playlist",
      "@id": "/playlists/1",
      "@type": "Playlist",
      "id": 1,
      "name": "stringUpdated",
      "channel": null,
      "network": null,
      "account": "/accounts/1"
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

  Scenario: Create a playlists with channel
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/playlists" with body:
    """
    {
      "name": "string",
      "channel": "/channels/1"
    }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Playlist",
      "@id": "/playlists/2",
      "@type": "Playlist",
      "id": 2,
      "name": "string",
      "channel": "/channels/1",
      "network": null,
      "account": null
    }
    """

  Scenario: Create a network
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/networks" with body:
    """
    {
        "channels": [ "/channels/1" ],
        "name": "string"
    }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Network",
      "@id": "/networks/1",
      "@type": "Network",
      "id": 1,
      "channels": [ "/channels/1" ],
      "name": "string",
      "peoples": [],
      "playlists": []
    }
    """

  Scenario: Create a playlists with network
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/playlists" with body:
    """
    {
      "name": "string",
      "network": "/networks/1"
    }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Playlist",
      "@id": "/playlists/3",
      "@type": "Playlist",
      "id": 3,
      "name": "string",
      "channel": null,
      "network": "/networks/1",
      "account": null
    }
    """

  Scenario: Throw errors when there is only bad properties
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/playlists" with body:
    """
    {
      "channel": "/channels/1",
      "account": "/accounts/1"
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
      "hydra:description": "Playlist: There is at least two value of playlist association which are not null\nname: This value should not be blank.",
      "violations": [
        {
          "propertyPath": "Playlist",
          "message": "There is at least two value of playlist association which are not null"
        },
        {
          "propertyPath": "name",
          "message": "This value should not be blank."
        }
      ]
    }
    """

  Scenario: Delete a playlist
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "DELETE" request to "/playlists/1"
    Then the response status code should be 204

  @dropSchema
  Scenario: Delete a playlist which not exists
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "DELETE" request to "/playlists/1"
    Then the response status code should be 404
