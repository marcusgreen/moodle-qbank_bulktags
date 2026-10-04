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

// NOTE: no MOODLE_INTERNAL test here, this file may be required by behat before including /config.php.

require_once(__DIR__ . '/../../../../../lib/behat/behat_base.php');

/**
 * Behat steps for qbank_bulktags.
 *
 * @package    qbank_bulktags
 * @copyright  2026 Marcus Green
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class behat_qbank_bulktags extends behat_base {
    /**
     * Open the question bank bulk actions menu if the UI has one.
     *
     * Up to Moodle 5.2 bulk actions are hidden in a "With selected" dropdown.
     * From Moodle 5.3 they are always-visible buttons in a sticky footer,
     * so there is nothing to open.
     *
     * @When I open the question bulk actions menu
     */
    public function i_open_the_question_bulk_actions_menu(): void {
        $selector = $this->getSession()->getPage()->find('css', '#bulkactionsui-selector');
        if ($selector) {
            $selector->click();
        }
    }
}
