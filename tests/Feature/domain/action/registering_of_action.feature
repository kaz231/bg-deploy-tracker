Feature: Registering of action
  In order to have a new recorded action
  As a owner
  I want to be able to register a new action

  Scenario: Registering of action
    Given I have action name "click"
      And I have action value "ad_banner"
     When I'm registering a new action
     Then I should be notified that new action was recorded