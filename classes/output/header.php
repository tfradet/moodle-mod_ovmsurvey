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
 *
 * @copyright  2019 Pierre Duverneix <pierre.duverneix@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace mod_ovmsurvey\output;
defined('MOODLE_INTERNAL') || die();

use renderable;
use renderer_base;
use templatable;
use stdClass;

class header implements renderable, templatable {

    public function __construct($name, $id) {
        $this->name = $name;
        $this->id = $id;
    }

    /**
     * Export this data so it can be used as the context for a mustache template.
     *
     * @param \renderer_base $output
     * @return stdClass
     */
    public function export_for_template(renderer_base $output) {
        
        global $CFG, $COURSE;

        $status = get_string(get_status(), 'mod_ovmsurvey');

        $course_link = $CFG->wwwroot."/course/view.php?id=".$COURSE->id;

        $review_link = $CFG->wwwroot."/mod/ovmsurvey/review.php?id=".$this->id;

        return [
            'review' => get_string('view_report', 'mod_ovmsurvey'),
            'review_link' => $review_link,
            'course_link' => $course_link,
            'course_name' => $COURSE->fullname,
            'name' => $this->name,
            'instructions' => get_string('instructions', 'mod_ovmsurvey'),
            'my_status' => get_string('my_status', 'mod_ovmsurvey'),
            'student' => get_string('student', 'mod_ovmsurvey'),
            'teacher' => get_string('teacher', 'mod_ovmsurvey'),
            'status' => $status,
            'set_status' => get_string('set_status', 'mod_ovmsurvey')
        ];
    }
}
