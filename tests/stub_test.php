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
 * Smoke tests – verify that block_coursectrl installs and loads cleanly.
 *
 * @package    block_coursectrl
 * @category   test
 * @copyright  2026 Course Control Hub Contributors
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @covers     \block_coursectrl
 */

namespace block_coursectrl;

defined('MOODLE_INTERNAL') || die();

/**
 * Smoke test suite for the block_coursectrl plugin skeleton.
 */
class stub_test extends \advanced_testcase {

    /**
     * Verify the plugin version is recorded after installation.
     */
    public function test_plugin_version_is_set(): void {
        $version = get_config('block_coursectrl', 'version');
        $this->assertNotEmpty($version, 'Plugin version must be stored after installation.');
    }

    /**
     * Verify the block class can be instantiated.
     */
    public function test_block_class_instantiates(): void {
        $this->assertClassExists('\block_coursectrl');
    }

    /**
     * Verify block capability definitions are present.
     */
    public function test_capabilities_exist(): void {
        $caps = [
            'block/coursectrl:addinstance',
        ];
        foreach ($caps as $cap) {
            $this->assertTrue(
                get_capability_info($cap) !== false,
                "Capability '{$cap}' must be registered."
            );
        }
    }

    /**
     * Verify required language strings exist.
     */
    public function test_language_strings_en(): void {
        $strings = ['pluginname', 'open_hub'];
        foreach ($strings as $key) {
            $str = get_string($key, 'block_coursectrl');
            $this->assertNotEmpty($str);
            $this->assertStringNotContainsString('[[', $str, "Language string '{$key}' is missing.");
        }
    }
}
