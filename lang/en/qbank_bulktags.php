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
 * Strings for component qbank_bulktags, language 'en'
 *
 * @package    qbank_bulktags
 * @copyright  2025 Marcus Green
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['bulktags'] = 'Bulk tags';
$string['bulktagsheader'] = 'Bulk update question tags';
$string['cancel_bulk_tags'] = 'Cancel bulk tags';
$string['close'] = 'Close';
$string['editbulkaction'] = 'Bulk tag questions';
$string['error:no_tags_selected'] = 'No tags selected';
$string['findtext'] = 'Find text';
$string['backends'] = "AI back end systems";
$string['backends_text'] = '
<ul>
  <li>Core AI System</li>
  <li>Local AI System is from <a href="https://https://github.com/bycs-lp/moodle-local_ai_manager">https://github.com/bycs-lp/moodle-local_ai_manager</a></li>
  <li>Tool AI System is from <a href="https://github.com/marcusgreen/moodle-tool_aiconnect">https://github.com/marcusgreen/moodle-tool_aiconnect</a></li>
</ul>
';
$string['coreaisubsystem'] = 'Core AI Subsystem';
$string['count'] = 'Count';
$string['enable_ai_suggestions'] = 'Enable AI suggestions';
$string['enable_ai_suggestions_description'] = 'An additional button will appear on th tagging form. When clicked it will loop through the selected questions questiontext and ask for suggested tags from the external LLM';
$string['error:no_tags_selected'] = 'No tags selectd';
$string['getaisuggestions_button'] = 'Get AI Suggestions';
$string['localaimanager'] = 'Local AI Manager';
$string['pluginname'] = 'Bulk tag questions';
$string['privacy:metadata'] = 'The View question text question bank plugin does not store any personal data.';
$string['prompt'] = 'Prompt';
$string['prompt_description'] = 'Prompt sent to the external LLM to ask for tags for the questiontext content';
$string['replacetags'] = 'Replace tags';
$string['replacetags_help'] = 'Remove existing tags before update';
$string['suggestioncounthelp'] = 'The number of tags that will be suggested';
$string['suggestioncounthelp_help'] = 'Loop through the question text of the selected questions, Make an LLM request to ask for a suggested tag';
$string['suggestioncountrequired'] = 'Suggestion count is required';
$string['tagbulkaction'] = 'Bulk edit tags';
$string['toolaimanager'] = 'AI Manager tool';
