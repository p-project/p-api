# features/Network.feature
Feature: Manage network
  In order to manage network
  As a client software developer
  I need to be able to retrieve, create, update and delete them trough the API.

  Background:
    Given I am connected as "denis" with password "password"
    And There are "Channel" "/channels/1"

  @createSchema
  @requiresOAuth
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

  Scenario: Put a user
    Given There are "Account" "/accounts/1,/accounts/2"
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "PUT" request to "/networks/1" with body:
    """
    {
        "peoples": [
          "/accounts/1",
          "/accounts/2"
        ]
    }
    """
    Then the response status code should be 200
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
      "peoples": [
        "/accounts/1",
        "/accounts/2"
      ],
      "playlists": []
    }
    """

  Scenario: Retrieve the networks list
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/networks"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Network",
      "@id": "/networks",
      "@type": "hydra:Collection",
      "hydra:member": [
        {
          "@id": "/networks/1",
          "@type": "Network",
          "id": 1,
          "channels": [ "/channels/1" ],
          "name": "string",
          "peoples": [
              "/accounts/1",
              "/accounts/2"
          ],
          "playlists": []
        }
      ],
      "hydra:totalItems": 1
    }
    """

  Scenario: See a playlist in network
    Given There are "Playlist" "/playlists/1,/playlist/2" which have "Network" "/networks/1"
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/networks/1"
    Then the response status code should be 200
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
      "peoples": [
        "/accounts/1",
        "/accounts/2"
      ],
      "playlists": [
        "/playlists/1",
        "/playlists/2"
      ]
    }
    """

  Scenario: Throw errors when there is only bad properties
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/networks" with body:
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

  Scenario: Delete a network
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "DELETE" request to "/networks/1"
    Then the response status code should be 204

  @dropSchema
  Scenario: Delete a network which not exists
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "DELETE" request to "/networks/1"
    Then the response status code should be 404
