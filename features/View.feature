# features/View.feature
Feature: Manage view
  In order to manage views
  As a client software developer
  I need to be able to retrieve, create, update and delete them trough the API.

  Background:
    Given I am connected as "denis@denis.fr" with password "password"
    And There are "video" "/videos/1"

  @refreshSchema
  @requiresOAuth
  Scenario: Create a view
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/views" with body:
    """
    {
      "userProfile": "/user_profiles/2",
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
      "userProfile": "/user_profiles/2",
      "video": "/videos/1"
    }
    """

  Scenario: Retrieve the views list
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/views"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/View",
      "@id": "/views",
      "@type": "hydra:Collection",
      "hydra:member": [
        {
          "@id": "/views/1",
          "@type": "View",
          "id": 1,
          "userProfile": "/user_profiles/2",
          "video": "/videos/1"
        }
      ],
      "hydra:totalItems": 1
    }
    """

  Scenario: Delete a view
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "DELETE" request to "/views/1"
    Then the response status code should be 204

  Scenario: Delete a view which not exists
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "DELETE" request to "/views/1"
    Then the response status code should be 404
