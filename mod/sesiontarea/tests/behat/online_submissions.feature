@mod @mod_sesiontarea
Feature: In an sesiontareament, students can add and edit text online
  In order to complete my submissions online
  As a student
  I need to submit my sesiontareament editing an online form

  @javascript
  Scenario: Submit a text online and edit the submission
    Given the following "courses" exists:
      | fullname | shortname | category | groupmode |
      | Course 1 | C1 | 0 | 1 |
    And the following "users" exists:
      | username | firstname | lastname | email |
      | teacher1 | Teacher | 1 | teacher1@asd.com |
      | student1 | Student | 1 | student1@asd.com |
    And the following "course enrolments" exists:
      | user | course | role |
      | teacher1 | C1 | editingteacher |
      | student1 | C1 | student |
    And I log in as "teacher1"
    And I follow "Course 1"
    And I turn editing mode on
    And I add a "Assignment" to section "1" and I fill the form with:
      | Assignment name | Test sesiontareament name |
      | Description | Submit your online text |
      | sesiontareasubmission_onlinetext_enabled | 1 |
      | sesiontareasubmission_file_enabled | 0 |
    And I log out
    And I log in as "student1"
    And I follow "Course 1"
    And I follow "Test sesiontareament name"
    When I press "Add submission"
    And I fill the moodle form with:
      | Online text | I'm the student first submission |
    And I press "Save changes"
    Then I should see "Submitted for grading"
    And I should see "I'm the student first submission"
    And I should see "Not graded"
    And I press "Edit submission"
    And I fill the moodle form with:
      | Online text | I'm the student second submission |
    And I press "Save changes"
    Then I should see "Submitted for grading"
    And I should see "I'm the student second submission"
    And I should not see "I'm the student first submission"
