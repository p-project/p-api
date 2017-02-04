# features/Annotation.feature
Feature: Manage network
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

  Scenario: Create a network
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/networks" with body:
    """
    {
        "channel": "/channels/1",
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
      "channel": "/channels/1",
      "name": "string",
      "peoples": [],
      "playlists": []
    }
    """

  Scenario: Create an other account
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/accounts" with body:
    """
    {
      "username": "string2",
      "email": "string@string2.fr",
      "firstName": "string",
      "lastName": "string",
      "networks": []
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
      "views": [],
      "channels": [],
      "id": 2,
      "username": "string2",
      "email": "string@string2.fr",
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

  Scenario: Put a user
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
      "channel": "/channels/1",
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
          "channel": "/channels/1",
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
