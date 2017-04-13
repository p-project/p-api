# features/Annotation.feature
Feature: Manage annotation
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
      "hash": "string",
      "magnet": "string",
      "metadata":
      {
        "height": 100,
        "width": 100,
        "format": "mp3"
      }
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
      "numberView": 120,
      "annotations": [],
      "channel": "/channels/1",
      "comments": [],
      "forums": [],
      "views": [],
      "reviews": [],
      "subtitles": [],
      "categories": [],
      "metadata": {
          "@id": "/metadatas/1",
          "@type": "Metadata",
          "id": 1,
          "height": 100,
          "width": 100,
          "format": "mp3"
      },
      "seeders": [],
      "hash": "string",
      "magnet": "string"
    }
    """

  Scenario: Create an annotation
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/annotations" with body:
     """
     {
         "begin": "2017-02-01T21:22:44.929Z",
         "end": "2017-02-01T21:22:44.929Z",
         "annotationText": "string",
         "video": "/videos/1"
     }
     """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
     """
     {
        "@context": "/contexts/Annotation",
        "@id": "/annotations/1",
        "@type": "Annotation",
        "id": 1,
        "begin": "2017-02-01T21:22:44+00:00",
        "end": "2017-02-01T21:22:44+00:00",
        "annotationText": "string",
        "video": "/videos/1"
     }
     """

  Scenario: Retrieve the annotation list
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/annotations"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Annotation",
      "@id": "/annotations",
      "@type": "hydra:Collection",
      "hydra:member": [
        {
          "@id": "/annotations/1",
          "@type": "Annotation",
          "id": 1,
          "begin": "2017-02-01T21:22:44+01:00",
          "end": "2017-02-01T21:22:44+01:00",
          "annotationText": "string",
          "video": "/videos/1"
        }
      ],
      "hydra:totalItems": 1
    }
    """

  Scenario: Throw errors when there is only bad properties
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/annotations" with body:
    """
    {
      "videos": "/videos/1"
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
      "hydra:description": "begin: This value should not be blank.\nend: This value should not be blank.",
      "violations": [
        {
          "propertyPath": "begin",
          "message": "This value should not be blank."
        },
        {
          "propertyPath": "end",
          "message": "This value should not be blank."
        }
      ]
    }
    """

  Scenario: Update an annotation
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "PUT" request to "/annotations/1" with body:
    """
    {
      "annotationText": "stringUpdated"
    }
    """
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Annotation",
      "@id": "/annotations/1",
      "@type": "Annotation",
      "id": 1,
      "begin": "2017-02-01T21:22:44+01:00",
      "end": "2017-02-01T21:22:44+01:00",
      "annotationText": "stringUpdated",
      "video": "/videos/1"
    }
    """

  Scenario: Get a specific annotation
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/annotations/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Annotation",
      "@id": "/annotations/1",
      "@type": "Annotation",
      "id": 1,
      "begin": "2017-02-01T21:22:44+01:00",
      "end": "2017-02-01T21:22:44+01:00",
      "annotationText": "stringUpdated",
      "video": "/videos/1"
    }
    """

  Scenario: Delete an annotation
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "DELETE" request to "/annotations/1"
    Then the response status code should be 204

  @dropSchema
  Scenario: Delete an annotation which not exists
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "DELETE" request to "/annotations/1"
    Then the response status code should be 404
