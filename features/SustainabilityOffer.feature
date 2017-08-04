# features/SustainabilityOffer.feature
Feature: Manage substainability_offer
  In order to manage substainability_offer
  As a client software developer
  I need to be able to retrieve, create, update and delete them trough the API.

  Background:
    Given I am connected as "denis@denis.fr" with password "password"
    And There are "channel" "/channels/1"

  @refreshSchema
  @requiresOAuth
  Scenario: Create SustainabilityOffer
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/sustainability_offers" with body:
    """
    {
      "name": "string",
      "duration": 0,
      "userProfile": "/user_profiles/1",
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
      "userProfile": "/user_profiles/1",
      "channel": "/channels/1"
    }
    """

  Scenario: Throw errors when there is only bad properties
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/sustainability_offers" with body:
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
      "hydra:description": "name: This value should not be blank.\nduration: This value should not be blank.",
      "violations": [
        {
          "propertyPath": "name",
          "message": "This value should not be blank."
        },
        {
          "propertyPath": "duration",
          "message": "This value should not be blank."
        }
      ]
    }
    """

  Scenario: Retrieve the SustainabilityOffers list
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/sustainability_offers"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/SustainabilityOffer",
      "@id": "/sustainability_offers",
      "@type": "hydra:Collection",
      "hydra:member": [
        {
          "@id": "/sustainability_offers/1",
          "@type": "SustainabilityOffer",
          "id": 1,
          "name": "string",
          "duration": 0,
          "userProfile": "/user_profiles/1",
          "channel": "/channels/1"
        }
      ],
      "hydra:totalItems": 1
    }
    """

  Scenario: Update SustainabilityOffers
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "PUT" request to "/sustainability_offers/1" with body:
    """
    {
      "name": "stringUpdated"
    }
    """
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/SustainabilityOffer",
      "@id": "/sustainability_offers/1",
      "@type": "SustainabilityOffer",
      "id": 1,
      "name": "stringUpdated",
      "duration": 0,
      "userProfile": "/user_profiles/1",
      "channel": "/channels/1"
    }
    """

  Scenario: Delete a SustainabilityOffers
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "DELETE" request to "/sustainability_offers/1"
    Then the response status code should be 204

  Scenario: Delete a SustainabilityOffers which not exists
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "DELETE" request to "/sustainability_offers/1"
    Then the response status code should be 404
