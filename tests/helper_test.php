<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

namespace qbank_bulktags;

use qbank_bulktags\helper;
use advanced_testcase;

/**
 * Test class for the helper class.
 *
 * @package   qbank_bulktags
 * @copyright 2024 Marcus Green
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class helper_test extends advanced_testcase {
    /**
     * Summary of question1.
     * @var $question1 \stdClass
     */
    public $question1;

    /**
     * Summary of question2
     * @var $question2 \stdClass
     */
    public $question2;

    /**
     * Course context the test questions live in, used to attach tags.
     * @var \context_course
     */
    public $coursecontext;
    
    public function setUp(): void {
        parent::setUp();
        $category = $this->getDataGenerator()->create_category();
        $course = $this->getDataGenerator()->create_course(['category' => $category->id]);
        $coursecontext = \context_course::instance($course->id);
        $this->coursecontext = $coursecontext;
        $generator = $this->getDataGenerator()->get_plugin_generator('core_question');
        $qcat = $generator->create_question_category(['contextid' => $coursecontext->id]);
        $this->question1 = $generator->create_question('multichoice', null, ['category' => $qcat->id]);
        $this->question2 = $generator->create_question('multichoice', null, ['category' => $qcat->id]);
    }

    /**
     * Test the process_question_ids method.
     *
     * @covers \qbank_bulktags\helper::process_question_ids
     */
    public function test_process_question_ids(): void {
        $this->resetAfterTest();
        $rawquestions = (object)[
            'q' . $this->question1->id => "1",
            'q' . $this->question2->id => "1",
        ];
        [$questionids, $questionlist] = helper::process_question_ids($rawquestions);
        $this->assertTrue(count($questionids) == 2);
        $this->assertTrue(count(explode(',', $questionlist)) == 2);
    }
    /**
     * Test the bulk_tag_questions method.
     *
     * @covers \qbank_bulktags\helper::bulk_tag_questions
     */
    public function test_bulk_tag_questions(): void {
        $this->resetAfterTest();
        $existingtags = \core_tag_tag::get_item_tags('core_question', 'question', $this->question1->id);
        $this->assertEmpty($existingtags);
        $existingtags = \core_tag_tag::get_item_tags('core_question', 'question', $this->question2->id);
        $this->assertEmpty($existingtags);

        $fromform = (object) [
            'tags' => ['tag1', 'tag2'],
            'selectedquestions' => implode(",", [$this->question1->id, $this->question2->id]),
            'formtags' => ['foo', 'bar'],
            'replacetags' => 0,
        ];
        helper::bulk_tag_questions($fromform);
        $updatedtags = \core_tag_tag::get_item_tags('core_question', 'question', $this->question1->id);
        $this->assertNotEmpty($updatedtags);

        $updatedtags = \core_tag_tag::get_item_tags('core_question', 'question', $this->question2->id);
        $this->assertNotEmpty($updatedtags);
    }
    
    /**
     * In merge mode (replacetags = 0) each selected question must only receive
     * its own existing tags merged with the submitted tags, never the existing
     * tags of the other selected questions. Regression test for tag
     * accumulation across the question loop.
     *
     * @covers \qbank_bulktags\helper::bulk_tag_questions
     */
    public function test_bulk_tag_questions_no_cross_contamination(): void {
        $this->resetAfterTest();

        // Give each question a distinct existing tag.
        \core_tag_tag::set_item_tags('core_question', 'question', $this->question1->id,
            $this->coursecontext, ['alpha']);
        \core_tag_tag::set_item_tags('core_question', 'question', $this->question2->id,
            $this->coursecontext, ['beta']);

        // Add a shared tag to both questions without replacing existing tags.
        $fromform = (object) [
            'selectedquestions' => implode(',', [$this->question1->id, $this->question2->id]),
            'formtags' => ['shared'],
            'replacetags' => 0,
        ];
        helper::bulk_tag_questions($fromform);

        $q1tags = array_values(\core_tag_tag::get_item_tags_array('core_question', 'question', $this->question1->id));
        $q2tags = array_values(\core_tag_tag::get_item_tags_array('core_question', 'question', $this->question2->id));
        sort($q1tags);
        sort($q2tags);

        // Question 1 keeps only its own tag plus the shared one (not 'beta').
        $this->assertEquals(['alpha', 'shared'], $q1tags);
        // Question 2 keeps only its own tag plus the shared one (not 'alpha').
        $this->assertEquals(['beta', 'shared'], $q2tags);
    }

    /**
     * Test get_selected_questions with empty selectedquestions.
     *
     * @covers \qbank_bulktags\helper::get_selected_questions
     */
    public function test_get_selected_questions(): void {
        $this->resetAfterTest();

        $fromform = (object) [
            'selectedquestions' => '',
        ];

        $selectedquestions = helper::get_selected_questions($fromform);

        // Empty string will create array with one empty element, but no matching questions.
        $this->assertIsArray($selectedquestions);
        $this->assertEmpty($selectedquestions);

        $fromform = (object) [
            'selectedquestions' => $this->question1->id . ',99999,' . $this->question2->id,
        ];

        $selectedquestions = helper::get_selected_questions($fromform);

        $this->assertIsArray($selectedquestions);
        $this->assertCount(2, $selectedquestions); // Only valid questions should be returned.
        $this->assertArrayHasKey($this->question1->id, $selectedquestions);
        $this->assertArrayHasKey($this->question2->id, $selectedquestions);
        $this->assertArrayNotHasKey(99999, $selectedquestions);
    }
}
