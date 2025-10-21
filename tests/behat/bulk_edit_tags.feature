@qbank @qbank_bulktags @qbank_bulktags_edit_tags

Feature: Testing multiple_tags in qbank_bulktags
  Background:
    And the following "course" exists:
          | fullname  | Course 1 |
          | shortname | C1       |
    # Without this it will show the pending progress bar and the back
    # to course button introduced in Moodle 4.3
    # https://docs.moodle.org/403/en/Course_backup#Asynchronous_course_backups
    And the following config values are set as admin:
          | enableasyncbackup | 0 |
  @javascript @_file_upload
  Scenario: Restore the bulktags_test course
        # Scenario: Restore course containing quiz questions
    Given I am on the "Course 1" "restore" page logged in as "admin"
    And I press "Manage course backups"
    And I upload "question/bank/bulktags/tests/fixtures/bulktags_test.mbz" file to "Files" filemanager
    And I press "Save changes"
    And I restore "bulktags_test.mbz" backup into a new course using this options:
          | Schema | Course name       | Bulk Tags Test |
          | Schema | Course short name | BulkTagsTest   |
            #And I am on the "Course 1" course page logged in as "admin"
    And I am on the "Bulk tags test" "core_question > course question bank" page logged in as "admin"
    And I set the field "Category" to "Default for Bulktags Test (2)"
    And I click on "Apply filters" "button"
    And I should see "First question"
    And I click on "First question" "checkbox"
    And I click on "Second question" "checkbox"
    And I click on "With selected" "button"
    And I click on question bulk action "bulktags"
    And I set the following fields to these values:
          | Tags | Tag1, Tag2 |
    And I press "Save changes"
    And I choose "Edit question" action for "First question" in the question bank
    And I expand all fieldsets
    And I should see "truefalse_qtype"
    And I should see "Tag1"
    And I should see "Tag1"




