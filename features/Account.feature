# features/Account.feature
Feature: Manage account
  In order to manage accounts
  As a client software developer
  I need to be able to retrieve, create, update and delete them trough the API.

  Background:
    Given I am connected as "denis" with password "password"

  @createSchema
  @requiresOAuth
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

  Scenario: Retrieve the account list
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/accounts"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
        "@context": "/contexts/Account",
        "@id": "/accounts",
        "@type": "hydra:Collection",
        "hydra:member": [
            {
                "@id": "/accounts/1",
                "@type": "Account",
                "id": 1,
                "username": "denis",
                "email": "denis@denis.fr",
                "firstName": "denis",
                "lastName": "denis",
                "channels": [],
                "views": [],
                "forums": [],
                "networks": [],
                "playlists": [],
                "replies": [],
                "reviews": [],
                "sustainabilityOffers": [],
                "seeders": []
            },
            {
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
        ],
        "hydra:totalItems": 2,
        "hydra:search": {
            "@type": "hydra:IriTemplate",
            "hydra:template": "/accounts{?id,id[],username,email,firstName}",
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
                    "variable": "email",
                    "property": "email",
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
    And I send a "POST" request to "/accounts" with body:
    """
    {
      "email": "string"
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
      "hydra:description": "username: This value should not be blank.\nemail: This value is not a valid email address.\nfirstName: This value should not be blank.\nlastName: This value should not be blank.\nsalt: This value should not be blank.\npassword: This value should not be blank.",
      "violations": [
        {
          "propertyPath": "username",
          "message": "This value should not be blank."
        },
        {
          "propertyPath": "email",
          "message": "This value is not a valid email address."
        },
        {
          "propertyPath": "firstName",
          "message": "This value should not be blank."
        },
        {
          "propertyPath": "lastName",
          "message": "This value should not be blank."
        },
        {
          "propertyPath": "salt",
          "message": "This value should not be blank."
        },
        {
          "propertyPath": "password",
          "message": "This value should not be blank."
        }
      ]
    }
    """

  Scenario: Update an account
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "PUT" request to "/accounts/2" with body:
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
        "@context": "/contexts/Account",
        "@id": "/accounts/2",
        "@type": "Account",
        "id": 2,
        "username": "stringUpdated",
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

  Scenario: Get a specific account
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/accounts/2"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
        "@context": "/contexts/Account",
        "@id": "/accounts/2",
        "@type": "Account",
        "id": 2,
        "username": "stringUpdated",
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

  Scenario: See channel in account
    Given There are "Channel" "/channels/1,/channels/2" which have "Account" "/accounts/2"
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/accounts/2"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
        "@context": "/contexts/Account",
        "@id": "/accounts/2",
        "@type": "Account",
        "id": 2,
        "username": "stringUpdated",
        "email": "string@string.fr",
        "firstName": "string",
        "lastName": "string",
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
        "seeders": []
    }
    """

  Scenario: See view in account
    Given There are "View" "/views/1,/views/2" which have "Account" "/accounts/2"
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/accounts/2"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
        "@context": "/contexts/Account",
        "@id": "/accounts/2",
        "@type": "Account",
        "id": 2,
        "username": "stringUpdated",
        "email": "string@string.fr",
        "firstName": "string",
        "lastName": "string",
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
        "seeders": []
    }
    """

  Scenario: See forum in account
    Given There are "Forum" "/forums/1,/forums/2" which have "Account" "/accounts/2"
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/accounts/2"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
        "@context": "/contexts/Account",
        "@id": "/accounts/2",
        "@type": "Account",
        "id": 2,
        "username": "stringUpdated",
        "email": "string@string.fr",
        "firstName": "string",
        "lastName": "string",
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
        "seeders": []
    }
    """

  Scenario: See network in account
    Given There are "Network" "/networks/1,/networks/2" which have "Account" "/accounts/2"
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/accounts/2"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
        {
        "@context": "/contexts/Account",
        "@id": "/accounts/2",
        "@type": "Account",
        "id": 2,
        "username": "stringUpdated",
        "email": "string@string.fr",
        "firstName": "string",
        "lastName": "string",
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
        "seeders": []
    }
    """

  Scenario: See review in account
    Given There are "Review" "/reviews/1,/reviews/2" which have "Account" "/accounts/2"
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/accounts/2"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
        "@context": "/contexts/Account",
        "@id": "/accounts/2",
        "@type": "Account",
        "id": 2,
        "username": "stringUpdated",
        "email": "string@string.fr",
        "firstName": "string",
        "lastName": "string",
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
        "seeders": []
    }
    """

  Scenario: See reply in account
    Given There are "Reply" "/replies/1,/replies/2" which have "Account" "/accounts/1,/accounts/2"
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/accounts/2"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
        "@context": "/contexts/Account",
        "@id": "/accounts/2",
        "@type": "Account",
        "id": 2,
        "username": "stringUpdated",
        "email": "string@string.fr",
        "firstName": "string",
        "lastName": "string",
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
        "seeders": []
    }
    """

  Scenario: See Sustainability Offers in account
    Given There are "SustainabilityOffer" "/sustainability_offers/1,/sustainability_offers/2" which have "Account" "/accounts/2"
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/accounts/2"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
        "@context": "/contexts/Account",
        "@id": "/accounts/2",
        "@type": "Account",
        "id": 2,
        "username": "stringUpdated",
        "email": "string@string.fr",
        "firstName": "string",
        "lastName": "string",
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
        "seeders": []
    }
    """

  Scenario: See seeder in account
    Given There are "Seeder" "/seeders/1,/seeders/2" which have "Account" "/accounts/2"
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/accounts/2"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
        "@context": "/contexts/Account",
        "@id": "/accounts/2",
        "@type": "Account",
        "id": 2,
        "username": "stringUpdated",
        "email": "string@string.fr",
        "firstName": "string",
        "lastName": "string",
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
        ]
    }
    """

  Scenario: See playlist in account
    Given There are "Playlist" "/playlists/1,/playlist/2" which have "Account" "/accounts/2"
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/accounts/2"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
        {
        "@context": "/contexts/Account",
        "@id": "/accounts/2",
        "@type": "Account",
        "id": 2,
        "username": "stringUpdated",
        "email": "string@string.fr",
        "firstName": "string",
        "lastName": "string",
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
        ]
    }
    """

  Scenario: Delete an account
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "DELETE" request to "/accounts/2"
    Then the response status code should be 204

  @dropSchema
  Scenario: Delete an account
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "DELETE" request to "/accounts/2"
    Then the response status code should be 404
