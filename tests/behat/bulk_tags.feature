@qbank @qbank_bulktags @qbank_bulktags_tag
Feature: Use the qbank plugin manager page for bulkmove
    In order to check the plugin behaviour with enable and disable

  Background:
    Given the following "users" exist:
          | username | firstname | lastname | email                |
          | teacher1 | Teacher   | 1        | teacher1@example.com |
    And the following "courses" exist:
          | fullname | shortname | category |
          | Course 1 | C1        | 0        |
    And the following "course enrolments" exist:
          | user     | course | role           |
          | teacher1 | C1     | editingteacher |
    And the following "course enrolments" exist:
          | user     | course | role           |
          | teacher1 | C1     | editingteacher |
    And the following "activities" exist:
          | activity | name            | course | idnumber |
          | quiz     | Test quiz       | C1     | quiz1    |
          | qbank    | Question bank 1 | C1     | qbank1   |
    And the following "question categories" exist:
          | contextlevel    | reference | name             |
          | Activity module | quiz1     | Test questions 1 |

    And the following "questions" exist:
          | questioncategory | qtype     | name           | questiontext              |
          | Test questions 1 | truefalse | First question | Answer the first question |

  @javascript
  Scenario: Enable/disable bulk edit tags questions bulk action from the base view
    Given I log in as "admin"
    When I navigate to "Plugins > Question bank plugins > Manage question bank plugins" in site administration
    And I should see "Bulk tag questions"
    And I click on "Disable" "link" in the "Bulk tag questions" "table_row"
    And I am on the "Test quiz" "mod_quiz > question bank" page
    And I set the field "Category" to "Test questions 1 (1)"
    And I click on "Apply filters" "button"
    And I click on "First question" "checkbox"
    And I click on "With selected" "button"
    Then I should not see question bulk action "bulktags"
    And I navigate to "Plugins > Question bank plugins > Manage question bank plugins" in site administration
    And I click on "Enable" "link" in the "Bulk tag questions" "table_row"
    And I am on the "Test quiz" "mod_quiz > question bank" page
    And I set the field "Category" to "Test questions 1 (1)"
    And I click on "Apply filters" "button"
    And I click on "First question" "checkbox"
    And I click on "With selected" "button"
    And I should see question bulk action "bulktags"
