# features/Profile.feature
Feature: Manage Profile
  In order to manage Profile
  As a client software developer
  I need to be able to retrieve, create, update and delete them trough the API.

  Background:
    Given I am connected as "denis@denis.fr" with password "password"

  @refreshSchema
  @requiresOAuth
  Scenario: Create a profile
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/profiles" with body:
    """
    {
      "username": "string",
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
      "@context": "/contexts/Profile",
      "@id": "/profiles/2",
      "@type": "Profile",
      "id": 2,
      "username": "string",
      "channels": [],
      "views": [],
      "forums": [],
      "networks": [],
      "playlists": [],
      "replies": [],
      "reviews": [],
      "sustainabilityOffers": [],
      "seeders": [],
      "firstName": "string",
      "lastName": "string"
    }
    """

  Scenario: Retrieve the profile list
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/profiles"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
        "@context": "/contexts/Profile",
        "@id": "/profiles",
        "@type": "hydra:Collection",
        "hydra:member": [
            {
              "@id": "/profiles/1",
              "@type": "Profile",
              "id": 1,
              "username": "denis",
              "channels": [],
              "views": [],
              "forums": [],
              "networks": [],
              "playlists": [],
              "replies": [],
              "reviews": [],
              "sustainabilityOffers": [],
              "seeders": [],
              "firstName": "denis",
              "lastName": "denis"
            },
            {
              "@id": "/profiles/2",
              "@type": "Profile",
              "id": 2,
              "username": "string",
              "channels": [],
              "views": [],
              "forums": [],
              "networks": [],
              "playlists": [],
              "replies": [],
              "reviews": [],
              "sustainabilityOffers": [],
              "seeders": [],
              "firstName": "string",
              "lastName": "string"
            }
        ],
        "hydra:totalItems": 2,
        "hydra:search": {
            "@type": "hydra:IriTemplate",
            "hydra:template": "/profiles{?id,id[],username,firstName}",
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
                    "variable": "username",
                    "property": "username",
                    "required": false
                },
                {
                    "@type": "IriTemplateMapping",
                    "variable": "firstName",
                    "property": "firstName",
                    "required": false
                }
            ]
        }
    }
    """
  
  Scenario: Throw errors when there is only bad properties
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/profiles" with body:
    """
    {
      "username": "string",
      "firstName": "string",
      "lastName": "string"
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
      "hydra:description": "username: This value should not be blank.\nfirstName: This value should not be blank.\nlastName: This value should not be blank.",
      "violations": [
        {
          "propertyPath": "username",
          "message": "This value should not be blank."
        },
        {
          "propertyPath": "firstName",
          "message": "This value should not be blank."
        },
        {
          "propertyPath": "lastName",
          "message": "This value should not be blank."
        }
      ]
    }
    """
  
  Scenario: Update a profile
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "PUT" request to "/profiles/2" with body:
    """
    {
      "username": "stringUpdated"
    }
    """
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Profile",
      "@id": "/profiles/2",
      "@type": "Profile",
      "id": 2,
      "username": "stringUpdated",
      "channels": [],
      "views": [],
      "forums": [],
      "networks": [],
      "playlists": [],
      "replies": [],
      "reviews": [],
      "sustainabilityOffers": [],
      "seeders": [],
      "firstName": "string",
      "lastName": "string"
    }
    """
  
  Scenario: Get a specific profile
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/profiles/2"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Profile",
      "@id": "/profiles/2",
      "@type": "Profile",
      "id": 2,
      "username": "stringUpdated",
      "channels": [],
      "views": [],
      "forums": [],
      "networks": [],
      "playlists": [],
      "replies": [],
      "reviews": [],
      "sustainabilityOffers": [],
      "seeders": [],
      "firstName": "string",
      "lastName": "string"
    }
    """
  
  Scenario: See channel in profile
    Given There are "channel" "/channels/1,/channels/2" which have "profile" "/profiles/2"
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/profiles/2"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Profile",
      "@id": "/profiles/2",
      "@type": "Profile",
      "id": 2,
      "username": "stringUpdated",
      "channels": [
        "/channels/1",
        "/channels/2"
      ],
      "views": [],
      "forums": [],
      "networks": [],
      "playlists": [],
      "replies": [],
      "reviews": [],
      "sustainabilityOffers": [],
      "seeders": [],
      "firstName": "string",
      "lastName": "string"
    }
    """
  
  Scenario: See view in profile
    Given There are "view" "/views/1,/views/2" which have "profile" "/profiles/2"
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/profiles/2"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Profile",
      "@id": "/profiles/2",
      "@type": "Profile",
      "id": 2,
      "username": "stringUpdated",
      "channels": [
        "/channels/1",
        "/channels/2"
      ],
      "views": [
        "/views/1",
        "/views/2"
      ],
      "forums": [],
      "networks": [],
      "playlists": [],
      "replies": [],
      "reviews": [],
      "sustainabilityOffers": [],
      "seeders": [],
      "firstName": "string",
      "lastName": "string"
    }
    """
  
  Scenario: See forum in profile
    Given There are "forum" "/forums/1,/forums/2" which have "profile" "/profiles/2"
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/profiles/2"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Profile",
      "@id": "/profiles/2",
      "@type": "Profile",
      "id": 2,
      "username": "stringUpdated",
      "channels": [
        "/channels/1",
        "/channels/2"
      ],
      "views": [
        "/views/1",
        "/views/2"
      ],
      "forums": [
        "/forums/1",
        "/forums/2"
      ],
      "networks": [],
      "playlists": [],
      "replies": [],
      "reviews": [],
      "sustainabilityOffers": [],
      "seeders": [],
      "firstName": "string",
      "lastName": "string"
    }
    """
  
  Scenario: See network in profile
    Given There are "network" "/networks/1,/networks/2" which have "profile" "/profiles/2"
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/profiles/2"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Profile",
      "@id": "/profiles/2",
      "@type": "Profile",
      "id": 2,
      "username": "stringUpdated",
      "channels": [
        "/channels/1",
        "/channels/2"
      ],
      "views": [
        "/views/1",
        "/views/2"
      ],
      "forums": [
        "/forums/1",
        "/forums/2"
      ],
      "networks": [
        "/networks/1",
        "/networks/2"
      ],
      "playlists": [],
      "replies": [],
      "reviews": [],
      "sustainabilityOffers": [],
      "seeders": [],
      "firstName": "string",
      "lastName": "string"
    }
    """
  
  Scenario: See review in profile
    Given There are "review" "/reviews/1,/reviews/2" which have "profile" "/profiles/2"
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/profiles/2"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Profile",
      "@id": "/profiles/2",
      "@type": "Profile",
      "id": 2,
      "username": "stringUpdated",
      "channels": [
        "/channels/1",
        "/channels/2"
      ],
      "views": [
        "/views/1",
        "/views/2"
      ],
      "forums": [
        "/forums/1",
        "/forums/2"
      ],
      "networks": [
        "/networks/1",
        "/networks/2"
      ],
      "playlists": [],
      "replies": [],
      "reviews": [
        "/reviews/1",
        "/reviews/2"
      ],
      "sustainabilityOffers": [],
      "seeders": [],
      "firstName": "string",
      "lastName": "string"
    }
    """
  
  Scenario: See reply in profile
    Given There are "reply" "/replies/1,/replies/2" which have "profile" "/profiles/1,/profiles/2"
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/profiles/2"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Profile",
      "@id": "/profiles/2",
      "@type": "Profile",
      "id": 2,
      "username": "stringUpdated",
      "channels": [
        "/channels/1",
        "/channels/2"
      ],
      "views": [
        "/views/1",
        "/views/2"
      ],
      "forums": [
        "/forums/1",
        "/forums/2"
      ],
      "networks": [
        "/networks/1",
        "/networks/2"
      ],
      "playlists": [],
      "replies": [
        "/replies/1",
        "/replies/2"
      ],
      "reviews": [
        "/reviews/1",
        "/reviews/2"
      ],
      "sustainabilityOffers": [],
      "seeders": [],
      "firstName": "string",
      "lastName": "string"
    }
    """
  
  Scenario: See Sustainability Offers in profile
    Given There are "sustainability offer" "/sustainability_offers/1,/sustainability_offers/2" which have "profile" "/profiles/2"
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/profiles/2"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Profile",
      "@id": "/profiles/2",
      "@type": "Profile",
      "id": 2,
      "username": "stringUpdated",
      "channels": [
        "/channels/1",
        "/channels/2"
      ],
      "views": [
        "/views/1",
        "/views/2"
      ],
      "forums": [
        "/forums/1",
        "/forums/2"
      ],
      "networks": [
        "/networks/1",
        "/networks/2"
      ],
      "playlists": [],
      "replies": [
        "/replies/1",
        "/replies/2"
      ],
      "reviews": [
        "/reviews/1",
        "/reviews/2"
      ],
      "sustainabilityOffers": [
         "/sustainability_offers/1",
         "/sustainability_offers/2"
      ],
      "seeders": [],
      "firstName": "string",
      "lastName": "string"
    }
    """
  
  Scenario: See seeder in profile
    Given There are "seeder" "/seeders/1,/seeders/2" which have "profile" "/profiles/2"
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/profiles/2"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Profile",
      "@id": "/profiles/2",
      "@type": "Profile",
      "id": 2,
      "username": "stringUpdated",
      "channels": [
        "/channels/1",
        "/channels/2"
      ],
      "views": [
        "/views/1",
        "/views/2"
      ],
      "forums": [
        "/forums/1",
        "/forums/2"
      ],
      "networks": [
        "/networks/1",
        "/networks/2"
      ],
      "playlists": [],
      "replies": [
        "/replies/1",
        "/replies/2"
      ],
      "reviews": [
        "/reviews/1",
        "/reviews/2"
      ],
      "sustainabilityOffers": [
         "/sustainability_offers/1",
         "/sustainability_offers/2"
      ],
      "seeders": [
        "/seeders/1",
        "/seeders/2"
      ],
      "firstName": "string",
      "lastName": "string"
    }
    """
  
  Scenario: See playlist in profile
    Given There are "playlist" "/playlists/1,/playlist/2" which have "profile" "/profiles/2"
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/profiles/2"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Profile",
      "@id": "/profiles/2",
      "@type": "Profile",
      "id": 2,
      "username": "stringUpdated",
      "channels": [
        "/channels/1",
        "/channels/2"
      ],
      "views": [
        "/views/1",
        "/views/2"
      ],
      "forums": [
        "/forums/1",
        "/forums/2"
      ],
      "networks": [
        "/networks/1",
        "/networks/2"
      ],
      "playlists": [
        "/playlists/1",
        "/playlists/2"
      ],
      "replies": [
        "/replies/1",
        "/replies/2"
      ],
      "reviews": [
        "/reviews/1",
        "/reviews/2"
      ],
      "sustainabilityOffers": [
         "/sustainability_offers/1",
         "/sustainability_offers/2"
      ],
      "seeders": [
        "/seeders/1",
        "/seeders/2"
      ],
      "firstName": "string",
      "lastName": "string"
    }
    """
  
  Scenario: Delete an profile
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "DELETE" request to "/profiles/2"
    Then the response status code should be 204
  
  Scenario: Delete an profile
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "DELETE" request to "/profiles/2"
    Then the response status code should be 404
