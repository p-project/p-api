# features/Video.feature
Feature: Manage video
  In order to manage video
  As a client software developer
  I need to be able to retrieve, create, update and delete them trough the API.

  Background:
    Given I am connected as "denis" with password "password"
    And There are "Channel" "/channels/1"
    And There are "Category" "/categories/1"

  @createSchema
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
    Given There are "Subtitles" "/subtitles/1,/subtitles/2" which have "Video" "/videos/1"
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
    Given There are "Review" "/reviews/1,/reviews/2" which have "Video" "/videos/1"
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
    Given There are "View" "/views/1,/views/2" which have "Video" "/videos/1"
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
    Given There are "Forum" "/forums/1,/forums/2" which have "Video" "/videos/1"
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
    Given There are "Annotation" "/annotations/1,/annotations/2" which have "Video" "/videos/1"
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
    Given There are "Comment" "/comments/1,/comments/2" which have "Video" "/videos/1"
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
            },
            {
                "@id": "/videos/2",
                "@type": "Video",
                "id": 2,
                "title": "string",
                "description": "string",
                "uploadDate": "1879-03-14T00:00:00+01:00",
                "numberView": 120,
                "annotations": [],
                "channel": "/channels/2",
                "comments": [],
                "forums": [],
                "views": [],
                "reviews": [],
                "subtitles": [],
                "categories": [],
                "metadata": null,
                "seeders": [],
                "hash": "et",
                "magnet": "et"
            },
            {
                "@id": "/videos/3",
                "@type": "Video",
                "id": 3,
                "title": "string",
                "description": "string",
                "uploadDate": "1879-03-14T00:00:00+01:00",
                "numberView": 120,
                "annotations": [],
                "channel": "/channels/3",
                "comments": [],
                "forums": [],
                "views": [],
                "reviews": [],
                "subtitles": [],
                "categories": [],
                "metadata": null,
                "seeders": [],
                "hash": "et",
                "magnet": "et"
            },
            {
                "@id": "/videos/4",
                "@type": "Video",
                "id": 4,
                "title": "string",
                "description": "string",
                "uploadDate": "1879-03-14T00:00:00+01:00",
                "numberView": 120,
                "annotations": [],
                "channel": "/channels/4",
                "comments": [],
                "forums": [],
                "views": [],
                "reviews": [],
                "subtitles": [],
                "categories": [],
                "metadata": null,
                "seeders": [],
                "hash": "et",
                "magnet": "et"
            },
            {
                "@id": "/videos/5",
                "@type": "Video",
                "id": 5,
                "title": "string",
                "description": "string",
                "uploadDate": "1879-03-14T00:00:00+01:00",
                "numberView": 120,
                "annotations": [],
                "channel": "/channels/5",
                "comments": [],
                "forums": [],
                "views": [],
                "reviews": [],
                "subtitles": [],
                "categories": [],
                "metadata": null,
                "seeders": [],
                "hash": "et",
                "magnet": "et"
            },
            {
                "@id": "/videos/6",
                "@type": "Video",
                "id": 6,
                "title": "string",
                "description": "string",
                "uploadDate": "1879-03-14T00:00:00+01:00",
                "numberView": 120,
                "annotations": [],
                "channel": "/channels/6",
                "comments": [],
                "forums": [],
                "views": [],
                "reviews": [],
                "subtitles": [],
                "categories": [],
                "metadata": null,
                "seeders": [],
                "hash": "et",
                "magnet": "et"
            },
            {
                "@id": "/videos/7",
                "@type": "Video",
                "id": 7,
                "title": "string",
                "description": "string",
                "uploadDate": "1879-03-14T00:00:00+01:00",
                "numberView": 120,
                "annotations": [],
                "channel": "/channels/7",
                "comments": [],
                "forums": [],
                "views": [],
                "reviews": [],
                "subtitles": [],
                "categories": [],
                "metadata": null,
                "seeders": [],
                "hash": "et",
                "magnet": "et"
            },
            {
                "@id": "/videos/8",
                "@type": "Video",
                "id": 8,
                "title": "string",
                "description": "string",
                "uploadDate": "1879-03-14T00:00:00+01:00",
                "numberView": 120,
                "annotations": [],
                "channel": "/channels/8",
                "comments": [],
                "forums": [],
                "views": [],
                "reviews": [],
                "subtitles": [],
                "categories": [],
                "metadata": null,
                "seeders": [],
                "hash": "et",
                "magnet": "et"
            },
            {
                "@id": "/videos/9",
                "@type": "Video",
                "id": 9,
                "title": "string",
                "description": "string",
                "uploadDate": "1879-03-14T00:00:00+01:00",
                "numberView": 120,
                "annotations": [],
                "channel": "/channels/9",
                "comments": [],
                "forums": [],
                "views": [],
                "reviews": [],
                "subtitles": [],
                "categories": [],
                "metadata": null,
                "seeders": [],
                "hash": "et",
                "magnet": "et"
            },
            {
                "@id": "/videos/10",
                "@type": "Video",
                "id": 10,
                "title": "string",
                "description": "string",
                "uploadDate": "1879-03-14T00:00:00+01:00",
                "numberView": 120,
                "annotations": [],
                "channel": "/channels/10",
                "comments": [],
                "forums": [],
                "views": [],
                "reviews": [],
                "subtitles": [],
                "categories": [],
                "metadata": null,
                "seeders": [],
                "hash": "et",
                "magnet": "et"
            },
            {
                "@id": "/videos/11",
                "@type": "Video",
                "id": 11,
                "title": "string",
                "description": "string",
                "uploadDate": "1879-03-14T00:00:00+01:00",
                "numberView": 120,
                "annotations": [],
                "channel": "/channels/11",
                "comments": [],
                "forums": [],
                "views": [],
                "reviews": [],
                "subtitles": [],
                "categories": [],
                "metadata": null,
                "seeders": [],
                "hash": "et",
                "magnet": "et"
            },
            {
                "@id": "/videos/12",
                "@type": "Video",
                "id": 12,
                "title": "string",
                "description": "string",
                "uploadDate": "1879-03-14T00:00:00+01:00",
                "numberView": 120,
                "annotations": [],
                "channel": "/channels/12",
                "comments": [],
                "forums": [],
                "views": [],
                "reviews": [],
                "subtitles": [],
                "categories": [],
                "metadata": null,
                "seeders": [],
                "hash": "et",
                "magnet": "et"
            },
            {
                "@id": "/videos/13",
                "@type": "Video",
                "id": 13,
                "title": "string",
                "description": "string",
                "uploadDate": "1879-03-14T00:00:00+01:00",
                "numberView": 120,
                "annotations": [],
                "channel": "/channels/13",
                "comments": [],
                "forums": [],
                "views": [],
                "reviews": [],
                "subtitles": [],
                "categories": [],
                "metadata": null,
                "seeders": [],
                "hash": "et",
                "magnet": "et"
            }
        ],
        "hydra:totalItems": 13,
        "hydra:search": {
            "@type": "hydra:IriTemplate",
            "hydra:template": "/videos{?id,id[],title,channel,channel[],magnet,hash}",
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
                    "variable": "title",
                    "property": "title",
                    "required": false
                },
                {
                    "@type": "IriTemplateMapping",
                    "variable": "channel",
                    "property": "channel",
                    "required": false
                },
                {
                    "@type": "IriTemplateMapping",
                    "variable": "channel[]",
                    "property": "channel",
                    "required": false
                },
                {
                    "@type": "IriTemplateMapping",
                    "variable": "magnet",
                    "property": "magnet",
                    "required": false
                },
                {
                    "@type": "IriTemplateMapping",
                    "variable": "hash",
                    "property": "hash",
                    "required": false
                }
            ]
        }
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
    Given There are "Seeder" "/seeders/1,/seeders/2" which have "Video" "/videos/1"
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

  @dropSchema
  Scenario: Delete a video which not exists
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "DELETE" request to "/videos/1"
    Then the response status code should be 404
