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

/**
 * Class bulk_tag_action is the base class for tagging questions.
 *
 * @package    qbank_bulktags
 * @copyright  2024 Marcus Green
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class bulk_tag_action extends \core_question\local\bank\bulk_action_base {
    /**
     * Get the title for the bulk action.
     *
     * @return string The localized string for the bulk action title.
     */
    public function get_bulk_action_title(): string {
        return get_string('tagbulkaction', 'qbank_bulktags');
    }

    /**
     * Get/assign the position of this bulk action in the menu.
     *
     * @return int The menu position (higher numbers appear later in the menu).
     */
    public function get_menu_position(): int {
        return 400;
    }

    /**
     * Get the key for the bulk action.
     *
     * @return string The key for the bulk action.
     */
    public function get_key(): string {
        return 'bulktags';
    }

    /**
     * Returns the URL for the bulk tag action.
     *
     * @return \moodle_url The URL for the bulk tag action.
     */
    public function get_bulk_action_url(): \moodle_url {
        return new \moodle_url('/question/bank/bulktags/tag.php');
    }

    /**
     * Returns the required capabilities for this bulk tag action.
     *
     * @return array|null An array of required capabilities, or null if no capabilities are required.
     */
    public function get_bulk_action_capabilities(): ?array {
        return [
            'moodle/question:editall',
        ];
    }

    /**
     * Return the icon identifier for the action (used from Moodle 5.3).
     *
     * @return string
     */
    public function get_action_icon(): string {
        return 't/tags';
    }
}
