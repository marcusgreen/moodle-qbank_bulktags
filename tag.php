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

/**
 * Bulk tag questions page.
 *
 * @package    qbank_bulktags
 * @copyright  2025 Marcus Green
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

 require_once(__DIR__ . '/../../../config.php');
 require_once($CFG->dirroot . '/question/editlib.php');

 global $CFG, $OUTPUT, $PAGE, $COURSE;

 $tagsselected = optional_param('bulktags', false, PARAM_BOOL);
 $returnurl = optional_param('returnurl', 0, PARAM_LOCALURL);
 $cmid = optional_param('cmid', 0, PARAM_INT);
 $courseid = optional_param('courseid', 0, PARAM_INT);
 $cancel = optional_param('cancel', null, PARAM_ALPHA);

if (!empty($returnurl)) {
    $returnurl = new moodle_url($returnurl);
    if ($cancel) {
        redirect($returnurl);
    }
}
 // Check if plugin is enabled or not.
 \core_question\local\bank\helper::require_plugin_enabled('qbank_bulktags');

if ($cmid) {
    [$module, $cm] = get_module_from_cmid($cmid);

    require_login($cm->course, false, $cm);
    $thiscontext = context_module::instance($cmid);
} else if ($courseid) {
    require_login($courseid, false);
    $thiscontext = context_course::instance($courseid);
} else {
    throw new moodle_exception('missingcourseorcmid', 'question');
}
require_capability('moodle/question:editall', $thiscontext);

$contexts = new core_question\local\bank\question_edit_contexts($thiscontext);
$url = new moodle_url('/question/bank/bulktags/tag.php');
$title = get_string('pluginname', 'qbank_bulktags');

 // Context and page setup.
$PAGE->set_url($url);
$PAGE->set_title($title);
$PAGE->set_heading($COURSE->fullname);
$PAGE->set_pagelayout('standard');
$PAGE->activityheader->disable();
$PAGE->set_secondary_active_tab("questionbank");

if ($tagsselected) {
    $request = data_submitted();
    [$questionids, $questionlist] = \qbank_bulktags\helper::process_question_ids($request);

    // No questions were selected.
    if (!$questionids) {
        redirect($returnurl);
    }
    // Create the urls.
    $bulktagsparams = [
        'selectedquestions' => $questionlist,
        'confirm' => md5($questionlist),
        'sesskey' => sesskey(),
        'returnurl' => $returnurl,
        'cmid' => $cmid,
        'courseid' => $courseid,
    ];
}

$form = new \qbank_bulktags\output\form\bulk_tags_form(null);

if (isset($bulktagsparams)) {
    $form->set_data($bulktagsparams);
}
if ($fromform = $form->get_data()) {
    if (isset($fromform->submitbutton)) {
        \qbank_bulktags\helper::bulk_tag_questions($fromform);
        redirect($returnurl);
    }
}
 // Show the header.
echo $OUTPUT->header();
$form->display();
 // Show the footer.
echo $OUTPUT->footer();
