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
 * Block class for block_coursectrl.
 *
 * This block acts purely as a course-context entry point into the
 * local_coursectrl plugin. All business logic lives in local_coursectrl.
 *
 * @package    block_coursectrl
 * @copyright  2026 Course Control Hub Contributors
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Course Control Hub block – renders a launch link into local_coursectrl.
 */
class block_coursectrl extends block_base {
    /**
     * Initialise block title.
     */
    public function init(): void {
        $this->title = get_string('pluginname', 'block_coursectrl');
    }

    /**
     * This block is only meaningful inside a course view.
     *
     * @return array
     */
    public function applicable_formats(): array {
        return [
            'course-view' => true,
            'site'        => false,
            'my'          => false,
        ];
    }

    /**
     * Block does not have instance-level configuration yet.
     *
     * @return bool
     */
    public function instance_allow_config(): bool {
        return false;
    }

    /**
     * Build and return the block content.
     *
     * @return stdClass|null
     */
    public function get_content(): ?stdClass {
        if ($this->content !== null) {
            return $this->content;
        }

        $this->content         = new stdClass();
        $this->content->footer = '';

        if (!has_capability('local/coursectrl:view', $this->context)) {
            $this->content->text = '';
            return $this->content;
        }

        $url = new moodle_url('/local/coursectrl/index.php', [
            'courseid' => $this->page->course->id,
        ]);

        $this->content->text = html_writer::link(
            $url,
            get_string('open_hub', 'block_coursectrl'),
            ['class' => 'btn btn-primary btn-sm']
        );

        return $this->content;
    }
}
