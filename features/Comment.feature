# features/Annotation.feature
Feature: Manage comment
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

  Scenario: Create a comment
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/comments" with body:
    """
    {
      "content": "string",
      "dateComment": "2017-02-03T08:56:37.848Z",
      "video": "/videos/1",
      "author": "/accounts/1"
    }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Comment",
      "@id": "/comments/1",
      "@type": "Comment",
      "id": 1,
      "content": "string",
      "dateComment": "2017-02-03T08:56:37+00:00",
      "video": "/videos/1",
      "author": "/accounts/1"
    }
    """

  Scenario: Throw errors when there is only bad properties
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/comments" with body:
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
        "@context": "\/contexts\/ConstraintViolationList",
        "@type": "ConstraintViolationList",
        "hydra:title": "An error occurred",
        "hydra:description": "content: This value should not be blank.\ndateComment: This value should not be blank.",
        "violations": [
            {
                "propertyPath": "content",
                "message": "This value should not be blank."
            },
            {
                "propertyPath": "dateComment",
                "message": "This value should not be blank."
            }
        ]
    }
    """

  Scenario: Retrieve the comments list
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/comments"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Comment",
      "@id": "/comments",
      "@type": "hydra:Collection",
      "hydra:member": [
        {
          "@id": "/comments/1",
          "@type": "Comment",
          "id": 1,
          "content": "string",
          "dateComment": "2017-02-03T08:56:37+01:00",
          "video": "/videos/1",
          "author": "/accounts/1"
        }
      ],
      "hydra:totalItems": 1
    }
    """

  Scenario: Update comments
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "PUT" request to "/comments/1" with body:
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
      "@context": "/contexts/Comment",
      "@id": "/comments/1",
      "@type": "Comment",
      "id": 1,
      "content": "stringUpdated",
      "dateComment": "2017-02-03T08:56:37+01:00",
      "video": "/videos/1",
      "author": "/accounts/1"
    }
    """

  Scenario: Delete a comments
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "DELETE" request to "/comments/1"
    Then the response status code should be 204

  @dropSchema
  Scenario: Delete a comment which not exists
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "DELETE" request to "/comments/1"
    Then the response status code should be 404
