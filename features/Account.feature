# features/Account.feature
Feature: Manage account
  In order to manage account
  As a client software developer
  I need to be able to retrieve, create, update and delete them trough the API.

  @createSchema
  @fixtures
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
      "@context": "\/contexts\/Account",
      "@id": "\/accounts\/2",
      "@type": "Account",
      "views": [],
      "channels": [],
      "id": 2,
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
      "seeders": [],
      "salt": "salt",
      "roles": [
          "ROLE_USER"
      ],
      "password": "password"
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
      "@context": "\/contexts\/Account",
      "@id": "\/accounts",
      "@type": "hydra:Collection",
      "hydra:member": [
        {
          "@id": "\/accounts\/1",
          "@type": "Account",
          "views": [],
          "channels": [],
          "id": 1,
          "username": "denis",
          "email": "denis@denis.fr",
          "firstName": "denis",
          "lastName": "denis",
          "forums": [],
          "networks": [],
          "playlists": [],
          "replies": [],
          "reviews": [],
          "sustainabilityOffers": [],
          "seeders": [],
          "salt": "12xiixme87y8wgk4c0k0gwko0",
          "roles": [
              "ROLE_USER"
          ],
          "password": "6x5r9+XhV5fQXQe5Vl311LJOiTBsQXk1+PTw4WBH4QvQGjo\/qDnLsF5O5bPRvd8R0eGDVXeDx2IBWX1qmP58Mg=="
        },
        {
          "@id": "\/accounts\/2",
          "@type": "Account",
          "views": [],
          "channels": [],
          "id": 2,
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
          "seeders": [],
          "salt": "salt",
          "roles": [
              "ROLE_USER"
          ],
          "password": "password"
        }
      ],
      "hydra:totalItems": 2
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
      "@context": "\/contexts\/ConstraintViolationList",
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
    And I send a "PUT" request to "/accounts/1" with body:
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
      "@context": "\/contexts\/Account",
      "@id": "\/accounts\/1",
      "@type": "Account",
      "views": [],
      "channels": [],
      "id": 1,
      "username": "stringUpdated",
      "email": "denis@denis.fr",
      "firstName": "denis",
      "lastName": "denis",
      "forums": [],
      "networks": [],
      "playlists": [],
      "replies": [],
      "reviews": [],
      "sustainabilityOffers": [],
      "seeders": [],
      "salt": "12xiixme87y8wgk4c0k0gwko0",
      "roles": [
        "ROLE_USER"
      ],
      "password": "6x5r9+XhV5fQXQe5Vl311LJOiTBsQXk1+PTw4WBH4QvQGjo\/qDnLsF5O5bPRvd8R0eGDVXeDx2IBWX1qmP58Mg=="
    }
    """

  Scenario: Get a specific account
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/accounts/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "\/contexts\/Account",
      "@id": "\/accounts\/1",
      "@type": "Account",
      "views": [],
      "channels": [],
      "id": 1,
      "username": "stringUpdated",
      "email": "denis@denis.fr",
      "firstName": "denis",
      "lastName": "denis",
      "forums": [],
      "networks": [],
      "playlists": [],
      "replies": [],
      "reviews": [],
      "sustainabilityOffers": [],
      "seeders": [],
      "salt": "12xiixme87y8wgk4c0k0gwko0",
      "roles": [
        "ROLE_USER"
      ],
      "password": "6x5r9+XhV5fQXQe5Vl311LJOiTBsQXk1+PTw4WBH4QvQGjo\/qDnLsF5O5bPRvd8R0eGDVXeDx2IBWX1qmP58Mg=="
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

  Scenario: See channel in account
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/accounts/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "\/contexts\/Account",
      "@id": "\/accounts\/1",
      "@type": "Account",
      "views": [],
      "channels": [
        "\/channels\/1"
      ],
      "id": 1,
      "username": "stringUpdated",
      "email": "denis@denis.fr",
      "firstName": "denis",
      "lastName": "denis",
      "forums": [],
      "networks": [],
      "playlists": [],
      "replies": [],
      "reviews": [],
      "sustainabilityOffers": [],
      "seeders": [],
      "salt": "12xiixme87y8wgk4c0k0gwko0",
      "roles": [
        "ROLE_USER"
      ],
      "password": "6x5r9+XhV5fQXQe5Vl311LJOiTBsQXk1+PTw4WBH4QvQGjo\/qDnLsF5O5bPRvd8R0eGDVXeDx2IBWX1qmP58Mg=="
    }
    """

  Scenario: Create a video
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
      "metadata":
      {
        "height": 100,
        "width": 100,
        "format": "mp3",
        "hash": "Abdsbfs"
      }
    }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "\/contexts\/Video",
      "@id": "\/videos\/1",
      "@type": "Video",
      "id": 1,
      "title": "string",
      "description": "string",
      "uploadDate": "2017-02-01T18:30:52+00:00",
      "numberView": 120,
      "annotations": [],
      "channel": "\/channels\/1",
      "comments": [],
      "forums": [],
      "views": [],
      "reviews": [],
      "subtitles": [],
      "categories": [],
      "metadata": {
          "@id": "\/metadatas\/1",
          "@type": "Metadata",
          "id": 1,
          "height": 100,
          "width": 100,
          "format": "mp3",
          "hash": "Abdsbfs"
      },
      "seeders": []
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

  Scenario: See view in account
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/accounts/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "\/contexts\/Account",
      "@id": "\/accounts\/1",
      "@type": "Account",
      "views": [
        "\/views\/1"
      ],
      "channels": [
        "\/channels\/1"
      ],
      "id": 1,
      "username": "stringUpdated",
      "email": "denis@denis.fr",
      "firstName": "denis",
      "lastName": "denis",
      "forums": [],
      "networks": [],
      "playlists": [],
      "replies": [],
      "reviews": [],
      "sustainabilityOffers": [],
      "seeders": [],
      "salt": "12xiixme87y8wgk4c0k0gwko0",
      "roles": [
        "ROLE_USER"
      ],
      "password": "6x5r9+XhV5fQXQe5Vl311LJOiTBsQXk1+PTw4WBH4QvQGjo\/qDnLsF5O5bPRvd8R0eGDVXeDx2IBWX1qmP58Mg=="
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

  Scenario: See forum in account
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/accounts/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "\/contexts\/Account",
      "@id": "\/accounts\/1",
      "@type": "Account",
      "views": [
        "\/views\/1"
      ],
      "channels": [
        "\/channels\/1"
      ],
      "id": 1,
      "username": "stringUpdated",
      "email": "denis@denis.fr",
      "firstName": "denis",
      "lastName": "denis",
      "forums": [
        "\/forums\/1"
      ],
      "networks": [],
      "playlists": [],
      "replies": [],
      "reviews": [],
      "sustainabilityOffers": [],
      "seeders": [],
      "salt": "12xiixme87y8wgk4c0k0gwko0",
      "roles": [
        "ROLE_USER"
      ],
      "password": "6x5r9+XhV5fQXQe5Vl311LJOiTBsQXk1+PTw4WBH4QvQGjo\/qDnLsF5O5bPRvd8R0eGDVXeDx2IBWX1qmP58Mg=="
    }
    """

  Scenario: Create a network
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/networks" with body:
    """
    {
      "channels": ["/channels/1"],
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
      "channels": [
         "/channels/1"
      ],
      "name": "string",
      "peoples": [
        "/accounts/1"
      ],
      "playlists": []
    }
    """

  Scenario: See network in account
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/accounts/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "\/contexts\/Account",
      "@id": "\/accounts\/1",
      "@type": "Account",
      "views": [
        "\/views\/1"
      ],
      "channels": [
        "\/channels\/1"
      ],
      "id": 1,
      "username": "stringUpdated",
      "email": "denis@denis.fr",
      "firstName": "denis",
      "lastName": "denis",
      "forums": [
        "\/forums\/1"
      ],
      "networks": [
        "\/networks\/1"
      ],
      "playlists": [],
      "replies": [],
      "reviews": [],
      "sustainabilityOffers": [],
      "seeders": [],
      "salt": "12xiixme87y8wgk4c0k0gwko0",
      "roles": [
        "ROLE_USER"
      ],
      "password": "6x5r9+XhV5fQXQe5Vl311LJOiTBsQXk1+PTw4WBH4QvQGjo\/qDnLsF5O5bPRvd8R0eGDVXeDx2IBWX1qmP58Mg=="
    }
    """

  Scenario: Create a review
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/reviews" with body:
    """
    {
      "content": "string",
      "video": "/videos/1",
      "dateReview": "2017-02-01T19:43:22.729Z",
      "author": "/accounts/1"
    }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Review",
      "@id": "/reviews/1",
      "@type": "Review",
      "id": 1,
      "content": "string",
      "video": "/videos/1",
      "dateReview": "2017-02-01T19:43:22+00:00",
      "replies": [],
      "author": "/accounts/1"
    }
    """

  Scenario: See review in account
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/accounts/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "\/contexts\/Account",
      "@id": "\/accounts\/1",
      "@type": "Account",
      "views": [
        "\/views\/1"
      ],
      "channels": [
        "\/channels\/1"
      ],
      "id": 1,
      "username": "stringUpdated",
      "email": "denis@denis.fr",
      "firstName": "denis",
      "lastName": "denis",
      "forums": [
        "\/forums\/1"
      ],
      "networks": [
        "\/networks\/1"
      ],
      "playlists": [],
      "replies": [],
      "reviews": [
        "\/reviews\/1"
      ],
      "sustainabilityOffers": [],
      "seeders": [],
      "salt": "12xiixme87y8wgk4c0k0gwko0",
      "roles": [
        "ROLE_USER"
      ],
      "password": "6x5r9+XhV5fQXQe5Vl311LJOiTBsQXk1+PTw4WBH4QvQGjo\/qDnLsF5O5bPRvd8R0eGDVXeDx2IBWX1qmP58Mg=="
    }
    """

  Scenario: Create a reply
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/replies" with body:
    """
    {
      "content": "string",
      "review": "/reviews/1",
      "author": "/accounts/1",
      "dateReply": "2017-02-01T19:43:22.700Z"
    }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Reply",
      "@id": "/replies/1",
      "@type": "Reply",
      "id": 1,
      "content": "string",
      "review": "/reviews/1",
      "author": "/accounts/1",
      "dateReply": "2017-02-01T19:43:22+00:00"
    }
    """

  Scenario: See review in account
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/accounts/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "\/contexts\/Account",
      "@id": "\/accounts\/1",
      "@type": "Account",
      "views": [
        "\/views\/1"
      ],
      "channels": [
        "\/channels\/1"
      ],
      "id": 1,
      "username": "stringUpdated",
      "email": "denis@denis.fr",
      "firstName": "denis",
      "lastName": "denis",
      "forums": [
        "\/forums\/1"
      ],
      "networks": [
        "\/networks\/1"
      ],
      "playlists": [],
      "replies": [
        "\/replies\/1"
      ],
      "reviews": [
        "\/reviews\/1"
      ],
      "sustainabilityOffers": [],
      "seeders": [],
      "salt": "12xiixme87y8wgk4c0k0gwko0",
      "roles": [
        "ROLE_USER"
      ],
      "password": "6x5r9+XhV5fQXQe5Vl311LJOiTBsQXk1+PTw4WBH4QvQGjo\/qDnLsF5O5bPRvd8R0eGDVXeDx2IBWX1qmP58Mg=="
    }
    """

  Scenario: See reply in account
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/accounts/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "\/contexts\/Account",
      "@id": "\/accounts\/1",
      "@type": "Account",
      "views": [
        "\/views\/1"
      ],
      "channels": [
        "\/channels\/1"
      ],
      "id": 1,
      "username": "stringUpdated",
      "email": "denis@denis.fr",
      "firstName": "denis",
      "lastName": "denis",
      "forums": [
        "\/forums\/1"
      ],
      "networks": [
        "\/networks\/1"
      ],
      "playlists": [],
      "replies": [
        "\/replies\/1"
      ],
      "reviews": [
        "\/reviews\/1"
      ],
      "sustainabilityOffers": [],
      "seeders": [],
      "salt": "12xiixme87y8wgk4c0k0gwko0",
      "roles": [
        "ROLE_USER"
      ],
      "password": "6x5r9+XhV5fQXQe5Vl311LJOiTBsQXk1+PTw4WBH4QvQGjo\/qDnLsF5O5bPRvd8R0eGDVXeDx2IBWX1qmP58Mg=="
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

  Scenario: See Sustainability Offers in account
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/accounts/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "\/contexts\/Account",
      "@id": "\/accounts\/1",
      "@type": "Account",
      "views": [
        "\/views\/1"
      ],
      "channels": [
        "\/channels\/1"
      ],
      "id": 1,
      "username": "stringUpdated",
      "email": "denis@denis.fr",
      "firstName": "denis",
      "lastName": "denis",
      "forums": [
        "\/forums\/1"
      ],
      "networks": [
        "\/networks\/1"
      ],
      "playlists": [],
      "replies": [
        "\/replies\/1"
      ],
      "reviews": [
        "\/reviews\/1"
      ],
      "sustainabilityOffers": [
        "\/sustainability_offers\/1"
      ],
      "seeders": [],
      "salt": "12xiixme87y8wgk4c0k0gwko0",
      "roles": [
        "ROLE_USER"
      ],
      "password": "6x5r9+XhV5fQXQe5Vl311LJOiTBsQXk1+PTw4WBH4QvQGjo\/qDnLsF5O5bPRvd8R0eGDVXeDx2IBWX1qmP58Mg=="
    }
    """

  Scenario: Create a seeder
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/seeders" with body:
    """
    {
      "id": 0,
      "platform": "string",
      "ip": "127.0.0.1",
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

  Scenario: See seeder in account
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/accounts/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "\/contexts\/Account",
      "@id": "\/accounts\/1",
      "@type": "Account",
      "views": [
        "\/views\/1"
      ],
      "channels": [
        "\/channels\/1"
      ],
      "id": 1,
      "username": "stringUpdated",
      "email": "denis@denis.fr",
      "firstName": "denis",
      "lastName": "denis",
      "forums": [
        "\/forums\/1"
      ],
      "networks": [
        "\/networks\/1"
      ],
      "playlists": [],
      "replies": [
        "\/replies\/1"
      ],
      "reviews": [
        "\/reviews\/1"
      ],
      "sustainabilityOffers": [
        "\/sustainability_offers\/1"
      ],
      "seeders": [
        "\/seeders\/1"
      ],
      "salt": "12xiixme87y8wgk4c0k0gwko0",
      "roles": [
        "ROLE_USER"
      ],
      "password": "6x5r9+XhV5fQXQe5Vl311LJOiTBsQXk1+PTw4WBH4QvQGjo\/qDnLsF5O5bPRvd8R0eGDVXeDx2IBWX1qmP58Mg=="
    }
    """

  Scenario: Create playlist in account
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

  Scenario: See playlist in account
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/accounts/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "\/contexts\/Account",
      "@id": "\/accounts\/1",
      "@type": "Account",
      "views": [
        "\/views\/1"
      ],
      "channels": [
        "\/channels\/1"
      ],
      "id": 1,
      "username": "stringUpdated",
      "email": "denis@denis.fr",
      "firstName": "denis",
      "lastName": "denis",
      "forums": [
        "\/forums\/1"
      ],
      "networks": [
        "\/networks\/1"
      ],
      "playlists": [
        "\/playlists\/1"
      ],
      "replies": [
        "\/replies\/1"
      ],
      "reviews": [
        "\/reviews\/1"
      ],
      "sustainabilityOffers": [
        "\/sustainability_offers\/1"
      ],
      "seeders": [
        "\/seeders\/1"
      ],
      "salt": "12xiixme87y8wgk4c0k0gwko0",
      "roles": [
        "ROLE_USER"
      ],
      "password": "6x5r9+XhV5fQXQe5Vl311LJOiTBsQXk1+PTw4WBH4QvQGjo\/qDnLsF5O5bPRvd8R0eGDVXeDx2IBWX1qmP58Mg=="
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
