# features/Video.feature
Feature: Manage video
  In order to manage videos
  As a client software developer
  I need to be able to retrieve, create, update and delete them trough the API.

  Background:
    Given I am connected as "denis@denis.fr" with password "password"
    And There are "channel" "/channels/1"
    And There are "category" "/categories/1"

  @refreshSchema
  @requiresOAuth
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
      "hash": "Abdsbfs",
      "magnet": "ssdf",
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
      "categories": [
        "/categories/1"
      ],
      "metadata": {
        "@id": "/metadatas/1",
        "@type": "Metadata",
        "id": 1,
        "height": 100,
        "width": 100,
        "format": "mp3"
      },
      "seeders": [],
      "hash": "Abdsbfs",
      "magnet": "ssdf"
    }
    """

  Scenario: See subtitles in video
    Given There are "subtitles" "/subtitles/1,/subtitles/2" which have "video" "/videos/1"
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/videos/1"
    Then the response status code should be 200
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
      "uploadDate": "2017-02-01T18:30:52+01:00",
      "numberView": 120,
      "annotations": [],
      "channel": "/channels/1",
      "comments": [],
      "forums": [],
      "views": [],
      "reviews": [],
      "subtitles": [
        "/subtitles/1",
        "/subtitles/2"
      ],
      "categories": [
        "/categories/1"
      ],
      "metadata": {
        "@id": "/metadatas/1",
        "@type": "Metadata",
        "id": 1,
        "height": 100,
        "width": 100,
        "format": "mp3"
      },
      "seeders": [],
      "hash": "Abdsbfs",
      "magnet": "ssdf"
    }
    """

  Scenario: See reviews in video
    Given There are "review" "/reviews/1,/reviews/2" which have "video" "/videos/1"
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/videos/1"
    Then the response status code should be 200
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
      "uploadDate": "2017-02-01T18:30:52+01:00",
      "numberView": 120,
      "annotations": [],
      "channel": "/channels/1",
      "comments": [],
      "forums": [],
      "views": [],
      "reviews": [
        "/reviews/1",
        "/reviews/2"
      ],
      "subtitles": [
        "/subtitles/1",
        "/subtitles/2"
      ],
      "categories": [
        "/categories/1"
      ],
      "metadata": {
        "@id": "/metadatas/1",
        "@type": "Metadata",
        "id": 1,
        "height": 100,
        "width": 100,
        "format": "mp3"
      },
      "seeders": [],
      "hash": "Abdsbfs",
      "magnet": "ssdf"
    }
    """

  Scenario: See views in video
    Given There are "view" "/views/1,/views/2" which have "video" "/videos/1"
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/videos/1"
    Then the response status code should be 200
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
      "uploadDate": "2017-02-01T18:30:52+01:00",
      "numberView": 120,
      "annotations": [],
      "channel": "/channels/1",
      "comments": [],
      "forums": [],
      "views": [
        "/views/1",
        "/views/2"
      ],
      "reviews": [
        "/reviews/1",
        "/reviews/2"
      ],
      "subtitles": [
        "/subtitles/1",
        "/subtitles/2"
      ],
      "categories": [
        "/categories/1"
      ],
      "metadata": {
        "@id": "/metadatas/1",
        "@type": "Metadata",
        "id": 1,
        "height": 100,
        "width": 100,
        "format": "mp3"
      },
      "seeders": [],
      "hash": "Abdsbfs",
      "magnet": "ssdf"
    }
    """

  Scenario: See forums in video
    Given There are "forum" "/forums/1,/forums/2" which have "video" "/videos/1"
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/videos/1"
    Then the response status code should be 200
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
      "uploadDate": "2017-02-01T18:30:52+01:00",
      "numberView": 120,
      "annotations": [],
      "channel": "/channels/1",
      "comments": [],
      "forums": [
        "/forums/1",
        "/forums/2"
      ],
      "views": [
        "/views/1",
        "/views/2"
      ],
      "reviews": [
        "/reviews/1",
        "/reviews/2"
      ],
      "subtitles": [
        "/subtitles/1",
        "/subtitles/2"
      ],
      "categories": [
        "/categories/1"
      ],
      "metadata": {
        "@id": "/metadatas/1",
        "@type": "Metadata",
        "id": 1,
        "height": 100,
        "width": 100,
        "format": "mp3"
      },
      "seeders": [],
      "hash": "Abdsbfs",
      "magnet": "ssdf"
    }
    """

  Scenario: See annotations in video
    Given There are "annotation" "/annotations/1,/annotations/2" which have "video" "/videos/1"
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/videos/1"
    Then the response status code should be 200
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
      "uploadDate": "2017-02-01T18:30:52+01:00",
      "numberView": 120,
      "annotations": [
        "/annotations/1",
        "/annotations/2"
      ],
      "channel": "/channels/1",
      "comments": [],
      "forums": [
        "/forums/1",
        "/forums/2"
      ],
      "views": [
        "/views/1",
        "/views/2"
      ],
      "reviews": [
        "/reviews/1",
        "/reviews/2"
      ],
      "subtitles": [
        "/subtitles/1",
        "/subtitles/2"
      ],
      "categories": [
        "/categories/1"
      ],
      "metadata": {
        "@id": "/metadatas/1",
        "@type": "Metadata",
        "id": 1,
        "height": 100,
        "width": 100,
        "format": "mp3"
      },
      "seeders": [],
      "hash": "Abdsbfs",
      "magnet": "ssdf"
    }
    """

  Scenario: See comments in video
    Given There are "comment" "/comments/1,/comments/2" which have "video" "/videos/1"
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/videos/1"
    Then the response status code should be 200
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
      "uploadDate": "2017-02-01T18:30:52+01:00",
      "numberView": 120,
      "annotations": [
        "/annotations/1",
        "/annotations/2"
      ],
      "channel": "/channels/1",
      "comments": [
        "/comments/1",
        "/comments/2"
      ],
      "forums": [
        "/forums/1",
        "/forums/2"
      ],
      "views": [
        "/views/1",
        "/views/2"
      ],
      "reviews": [
        "/reviews/1",
        "/reviews/2"
      ],
      "subtitles": [
        "/subtitles/1",
        "/subtitles/2"
      ],
      "categories": [
        "/categories/1"
      ],
      "metadata": {
        "@id": "/metadatas/1",
        "@type": "Metadata",
        "id": 1,
        "height": 100,
        "width": 100,
        "format": "mp3"
      },
      "seeders": [],
      "hash": "Abdsbfs",
      "magnet": "ssdf"
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
      "hydra:description": "title: This value should not be blank.\nhash: This value should not be blank.\nmagnet: This value should not be blank.",
      "violations": [
        {
          "propertyPath": "title",
          "message": "This value should not be blank."
        },
        {
          "propertyPath": "hash",
          "message": "This value should not be blank."
        },
        {
          "propertyPath": "magnet",
          "message": "This value should not be blank."
        }
      ]
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
      "@context": "/contexts/Video",
      "@id": "/videos/1",
      "@type": "Video",
      "id": 1,
      "title": "stringUpdated",
      "description": "string",
      "uploadDate": "2017-02-01T18:30:52+01:00",
      "numberView": 120,
      "annotations": [
        "/annotations/1",
        "/annotations/2"
      ],
      "channel": "/channels/1",
      "comments": [
        "/comments/1",
        "/comments/2"
      ],
      "forums": [
        "/forums/1",
        "/forums/2"
      ],
      "views": [
        "/views/1",
        "/views/2"
      ],
      "reviews": [
        "/reviews/1",
        "/reviews/2"
      ],
      "subtitles": [
        "/subtitles/1",
        "/subtitles/2"
      ],
      "categories": [
        "/categories/1"
      ],
      "metadata": {
        "@id": "/metadatas/1",
        "@type": "Metadata",
        "id": 1,
        "height": 100,
        "width": 100,
        "format": "mp3"
      },
      "seeders": [],
      "hash": "Abdsbfs",
      "magnet": "ssdf"
    }
    """

  Scenario: See seeders in video
    Given There are "seeder" "/seeders/1,/seeders/2" which have "video" "/videos/1"
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/videos/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/Video",
      "@id": "/videos/1",
      "@type": "Video",
      "id": 1,
      "title": "stringUpdated",
      "description": "string",
      "uploadDate": "2017-02-01T18:30:52+01:00",
      "numberView": 120,
      "annotations": [
        "/annotations/1",
        "/annotations/2"
      ],
      "channel": "/channels/1",
      "comments": [
        "/comments/1",
        "/comments/2"
      ],
      "forums": [
        "/forums/1",
        "/forums/2"
      ],
      "views": [
        "/views/1",
        "/views/2"
      ],
      "reviews": [
        "/reviews/1",
        "/reviews/2"
      ],
      "subtitles": [
        "/subtitles/1",
        "/subtitles/2"
      ],
      "categories": [
        "/categories/1"
      ],
      "metadata": {
        "@id": "/metadatas/1",
        "@type": "Metadata",
        "id": 1,
        "height": 100,
        "width": 100,
        "format": "mp3"
      },
      "seeders": [
        "/seeders/1",
        "/seeders/2"
      ],
      "hash": "Abdsbfs",
      "magnet": "ssdf"
    }
    """

  Scenario: Delete a video
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "DELETE" request to "/videos/1"
    Then the response status code should be 204

  Scenario: Delete a video which not exists
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "DELETE" request to "/videos/1"
    Then the response status code should be 404
