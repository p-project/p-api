# features/Annotation.feature
Feature: Manage channel
  In order to manage account
  As a client software developer
  I need to be able to retrieve, create, update and delete them trough the API.

  Background:
    Given I am connected as "denis" with password "password"
    And There are "accounts" "/accounts/2"

  @createSchema
  @requiresOAuth
  Scenario: Create a channel
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/channels" with body:
    """
    {
      "account": "/accounts/2",
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
      "account": "/accounts/2",
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

  Scenario: See video on channel
    Given There are "channels" "/channels/1" which have "videos" "/videos/1,/videos/2"
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

  Scenario: See networks on channel
    Given There are "networks" "/networks/1,networks/2" which have "channels" "/channels/1"
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
          "/networks/1",
          "/networks/2"
      ],
      "playlists": [],
      "sustainabilityOffers": []
    }
    """

  Scenario: See sustainability offer on channel
    Given There are "sustainabilityOffers" "/sustainability_offers/1,/sustainability_offers/2" which have "channels" "/channels/1"
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
          "/sustainability_offers/1",
          "/sustainability_offers/2",
      ]
    }
    """

  Scenario: Retrieve the channels list
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
          "hydra:totalItems": 1,
          "hydra:search": {
              "@type": "hydra:IriTemplate",
              "hydra:template": "/channels{?id,id[],name,account,account[]}",
              "hydra:variableRepresentation": "BasicRepresentation",
              "hydra:mapping": [
                  {
                      "@type": "IriTemplateMapping",
                      "variable": "id",
                      "property": "id",
                      "required": false
                  },
                  {
                      "@type": "IriTemplateMapping",
                      "variable": "id[]",
                      "property": "id",
                      "required": false
                  },
                  {
                      "@type": "IriTemplateMapping",
                      "variable": "name",
                      "property": "name",
                      "required": false
                  },
                  {
                      "@type": "IriTemplateMapping",
                      "variable": "account",
                      "property": "account",
                      "required": false
                  },
                  {
                      "@type": "IriTemplateMapping",
                      "variable": "account[]",
                      "property": "account",
                      "required": false
                  }
              ]
          }
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

  Scenario: Create playlist in channel
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
      "@id": "/playlists/1",
      "@type": "Playlist",
      "id": 1,
      "name": "string",
      "channel": "/channels/1",
      "network": null,
      "account": null
    }
    """

  Scenario: See playlist in channel
    Given There are "playlists" "/playlists/1,/playlist/2" which have "/channels/1"
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
      "playlists": [
          "/playlists/1"
      ],
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
