# features/Annotation.feature
Feature: Manage video
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

  Scenario: Create a category
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/categories" with body:
    """
    {
      "name": "string",
      "description": "string"
    }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Category",
      "@id": "/categories/1",
      "@type": "Category",
      "id": 1,
      "name": "string",
      "description": "string",
      "videos": []
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
      "categories": [
        "/categories/1"
      ],
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
      "categories": [
        "/categories/1"
      ],
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

  Scenario: Create a subtitles
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/subtitles" with body:
    """
    {
      "begin": "2017-02-04T09:58:45.951Z",
      "end": "2017-02-04T09:58:45.951Z",
      "path": "string",
      "video": "/videos/1"
    }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Subtitles",
      "@id": "/subtitles/1",
      "@type": "Subtitles",
      "id": 1,
      "begin": "2017-02-04T09:58:45+00:00",
      "end": "2017-02-04T09:58:45+00:00",
      "path": "string",
      "video": "/videos/1"
    }
    """

  Scenario: See subtitles in video
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/videos/1"
    Then the response status code should be 200
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
      "uploadDate": "2017-02-01T18:30:52+01:00",
      "numberView": 120,
      "annotations": [],
      "channel": "\/channels\/1",
      "comments": [],
      "forums": [],
      "views": [],
      "reviews": [],
      "subtitles": [
        "/subtitles/1"
      ],
      "categories": [
        "/categories/1"
      ],
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

  Scenario: See reviews in video
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/videos/1"
    Then the response status code should be 200
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
      "uploadDate": "2017-02-01T18:30:52+01:00",
      "numberView": 120,
      "annotations": [],
      "channel": "\/channels\/1",
      "comments": [],
      "forums": [],
      "views": [],
      "reviews": [
        "/reviews/1"
      ],
      "subtitles": [
        "/subtitles/1"
      ],
      "categories": [
        "/categories/1"
      ],
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

  Scenario: See views in video
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/videos/1"
    Then the response status code should be 200
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
      "uploadDate": "2017-02-01T18:30:52+01:00",
      "numberView": 120,
      "annotations": [],
      "channel": "\/channels\/1",
      "comments": [],
      "forums": [],
      "views": [
        "/views/1"
      ],
      "reviews": [
        "/reviews/1"
      ],
      "subtitles": [
        "/subtitles/1"
      ],
      "categories": [
        "/categories/1"
      ],
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

  Scenario: See forums in video
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/videos/1"
    Then the response status code should be 200
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
      "uploadDate": "2017-02-01T18:30:52+01:00",
      "numberView": 120,
      "annotations": [],
      "channel": "\/channels\/1",
      "comments": [],
      "forums": [
        "/forums/1"
      ],
      "views": [
        "/views/1"
      ],
      "reviews": [
        "/reviews/1"
      ],
      "subtitles": [
        "/subtitles/1"
      ],
      "categories": [
        "/categories/1"
      ],
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

  Scenario: See annotations in video
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/videos/1"
    Then the response status code should be 200
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
      "uploadDate": "2017-02-01T18:30:52+01:00",
      "numberView": 120,
      "annotations": [
        "/annotations/1"
      ],
      "channel": "\/channels\/1",
      "comments": [],
      "forums": [
        "/forums/1"
      ],
      "views": [
        "/views/1"
      ],
      "reviews": [
        "/reviews/1"
      ],
      "subtitles": [
        "/subtitles/1"
      ],
      "categories": [
        "/categories/1"
      ],
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

  Scenario: See comments in video
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/videos/1"
    Then the response status code should be 200
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
      "uploadDate": "2017-02-01T18:30:52+01:00",
      "numberView": 120,
      "annotations": [
        "/annotations/1"
      ],
      "channel": "\/channels\/1",
      "comments": [
        "/comments/1"
      ],
      "forums": [
        "/forums/1"
      ],
      "views": [
        "/views/1"
      ],
      "reviews": [
        "/reviews/1"
      ],
      "subtitles": [
        "/subtitles/1"
      ],
      "categories": [
        "/categories/1"
      ],
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

  Scenario: Throw errors when there is only bad properties
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/videos" with body:
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
      "hydra:description": "title: This value should not be blank.",
      "violations": [
        {
          "propertyPath": "title",
          "message": "This value should not be blank."
        }
      ]
    }
    """

  Scenario: Retrieve the videos list
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/videos"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Video",
      "@id": "/videos",
      "@type": "hydra:Collection",
      "hydra:member": [
        {
          "@id": "/videos/1",
          "@type": "Video",
          "id": 1,
          "title": "string",
          "description": "string",
          "uploadDate": "2017-02-01T18:30:52+01:00",
          "numberView": 120,
          "annotations": [
            "/annotations/1"
          ],
          "channel": "/channels/1",
          "comments": [
            "/comments/1"
          ],
          "forums": [
            "/forums/1"
          ],
          "views": [
            "/views/1"
          ],
          "reviews": [
            "/reviews/1"
          ],
          "subtitles": [
            "/subtitles/1"
          ],
          "categories": [
            "/categories/1"
          ],
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
      ],
      "hydra:totalItems": 1
    }
    """

  Scenario: Update subtitle
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "PUT" request to "/videos/1" with body:
    """
    {
      "title": "stringUpdated"
    }
    """
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "\/contexts\/Video",
      "@id": "\/videos\/1",
      "@type": "Video",
      "id": 1,
      "title": "stringUpdated",
      "description": "string",
      "uploadDate": "2017-02-01T18:30:52+01:00",
      "numberView": 120,
      "annotations": [
        "/annotations/1"
      ],
      "channel": "\/channels\/1",
      "comments": [
        "/comments/1"
      ],
      "forums": [
        "/forums/1"
      ],
      "views": [
        "/views/1"
      ],
      "reviews": [
        "/reviews/1"
      ],
      "subtitles": [
        "/subtitles/1"
      ],
      "categories": [
        "/categories/1"
      ],
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

  Scenario: Create a seeder
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/seeders" with body:
    """
    {
      "id": 0,
      "platform": "string",
      "account": "/accounts/1",
      "ip": "string",
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
      "ip": "string",
      "video": "/videos/1"
    }
    """

  Scenario: See seeders in video
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/videos/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "\/contexts\/Video",
      "@id": "\/videos\/1",
      "@type": "Video",
      "id": 1,
      "title": "stringUpdated",
      "description": "string",
      "uploadDate": "2017-02-01T18:30:52+01:00",
      "numberView": 120,
      "annotations": [
        "/annotations/1"
      ],
      "channel": "\/channels\/1",
      "comments": [
        "/comments/1"
      ],
      "forums": [
        "/forums/1"
      ],
      "views": [
        "/views/1"
      ],
      "reviews": [
        "/reviews/1"
      ],
      "subtitles": [
        "/subtitles/1"
      ],
      "categories": [
        "/categories/1"
      ],
      "metadata": {
          "@id": "\/metadatas\/1",
          "@type": "Metadata",
          "id": 1,
          "height": 100,
          "width": 100,
          "format": "mp3",
          "hash": "Abdsbfs"
      },
      "seeders": [
        "/seeders/1"
      ]
    }
    """

  Scenario: Delete a video
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "DELETE" request to "/videos/1"
    Then the response status code should be 204

  @dropSchema
  Scenario: Delete a video which not exists
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "DELETE" request to "/videos/1"
    Then the response status code should be 404
