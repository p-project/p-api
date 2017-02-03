# features/Annotation.feature
Feature: Manage channel
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

  Scenario: Throw errors when there is only bad properties
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/channels" with body:
    """
    {
      "tags": [
          "string"
      ]
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

  Scenario: Create video on channel
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
      "seeds": [],
      "subtitles": [],
      "categories": []
    }
    """

  Scenario: See video on channel
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/channels/1"
    Then the response status code should be 200
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
      "videos": [
          "/videos/1"
      ],
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
      "name": "string",
      "peoples": [
        "/accounts/1"
      ]
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
      "peoples": [
        "/accounts/1"
      ],
      "playlists": []
    }
    """

  Scenario: See networks on channel
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/channels/1"
    Then the response status code should be 200
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
      "videos": [
          "/videos/1"
      ],
      "networks": [
          "/networks/1"
      ],
      "playlists": [],
      "sustainabilityOffers": []
    }
    """

  Scenario: Create a Sustainability Offers
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/sustainability_offers" with body:
    """
    {
        "name": "string",
        "duration": 0,
        "account": "/accounts/1",
        "channel": "/channels/1"
    }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
       "@context": "/contexts/SustainabilityOffer",
      "@id": "/sustainability_offers/1",
      "@type": "SustainabilityOffer",
      "id": 1,
      "name": "string",
      "duration": 0,
      "account": "/accounts/1",
      "channel": "/channels/1"
    }
    """

  Scenario: See sustainability offer on channel
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/channels/1"
    Then the response status code should be 200
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
      "videos": [
          "/videos/1"
      ],
      "networks": [
          "/networks/1"
      ],
      "playlists": [],
      "sustainabilityOffers": [
          "/sustainability_offers/1"
      ]
    }
    """

  Scenario: Retrieve the categories list
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/channels"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Channel",
      "@id": "/channels",
      "@type": "hydra:Collection",
      "hydra:member": [
        {
          "@id": "/channels/1",
          "@type": "Channel",
          "account": "/accounts/1",
          "id": 1,
          "name": "string",
          "tags": [
            "string"
          ],
          "videos": [
              "/videos/1"
          ],
          "networks": [
              "/networks/1"
          ],
          "playlists": [],
          "sustainabilityOffers": [
              "/sustainability_offers/1"
          ]
        }
      ],
      "hydra:totalItems": 1
    }
    """

  Scenario: Update a channel
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "PUT" request to "/channels/1" with body:
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
      "@context": "/contexts/Channel",
      "@id": "/channels/1",
      "@type": "Channel",
      "account": "/accounts/1",
      "id": 1,
      "name": "stringUpdated",
      "tags": [
        "string"
      ],
      "videos": [
          "/videos/1"
      ],
      "networks": [
          "/networks/1"
      ],
      "playlists": [],
      "sustainabilityOffers": [
          "/sustainability_offers/1"
      ]
    }
    """

  Scenario: Delete a channel
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "DELETE" request to "/channels/1"
    Then the response status code should be 204

  @dropSchema
  Scenario: Delete a category which not exists
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "DELETE" request to "/channels/1"
    Then the response status code should be 404