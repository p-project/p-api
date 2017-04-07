# features/Annotation.feature
Feature: Manage comment
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

  Scenario: Create a review
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/reviews" with body:
    """
    {
      "content": "string",
      "video": "/videos/1",
      "dateReview": "2017-02-04T09:36:08.044Z",
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
        "dateReview": "2017-02-04T09:36:08+00:00",
        "replies": [],
        "author": "/accounts/1"
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
      "dateReply": "2017-02-04T09:36:08.014Z"
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
      "dateReply": "2017-02-04T09:36:08+00:00"
    }
    """

  Scenario: Throw errors when there is only bad properties
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/replies" with body:
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
      "hydra:description": "content: This value should not be blank.\ndateReply: This value should not be blank.",
      "violations": [
        {
          "propertyPath": "content",
          "message": "This value should not be blank."
        },
        {
          "propertyPath": "dateReply",
          "message": "This value should not be blank."
        }
      ]
    }
    """

  Scenario: Retrieve the replies list
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/replies"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Reply",
      "@id": "/replies",
      "@type": "hydra:Collection",
      "hydra:member": [
        {
          "@id": "/replies/1",
          "@type": "Reply",
          "id": 1,
          "content": "string",
          "review": "/reviews/1",
          "author": "/accounts/1",
          "dateReply": "2017-02-04T09:36:08+01:00"
        }
      ],
      "hydra:totalItems": 1
    }
    """

  Scenario: Update replies
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "PUT" request to "/replies/1" with body:
    """
    {
      "content": "stringUpdated"
    }
    """
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Reply",
      "@id": "/replies/1",
      "@type": "Reply",
      "id": 1,
      "content": "stringUpdated",
      "review": "/reviews/1",
      "author": "/accounts/1",
      "dateReply": "2017-02-04T09:36:08+01:00"
    }
    """

  Scenario: Delete a reply
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "DELETE" request to "/replies/1"
    Then the response status code should be 204

  @dropSchema
  Scenario: Delete a comment which not exists
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "DELETE" request to "/replies/1"
    Then the response status code should be 404
