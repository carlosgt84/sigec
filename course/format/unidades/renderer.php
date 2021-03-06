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
 * Renderer for outputting the topics course format.
 *
 * @package format_topics
 * @copyright 2012 Dan Poltawski
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @since Moodle 2.3
 */
defined('MOODLE_INTERNAL') || die();
require_once($CFG->dirroot . '/course/format/renderer.php');
require_once($CFG->dirroot . '/course/format/unidades/unidad_form.php');
require_once($CFG->libdir . '/itse/lib.php');

/**
 * Basic renderer for topics format.
 *
 * @copyright 2012 Dan Poltawski
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class format_unidades_renderer extends format_section_renderer_base
{
    /**
     * Generate the starting container html for a list of sections
     * @return string HTML to output.
     */
    protected
        function start_section_list()
    {
        return html_writer::start_tag('ul', array('class' => 'topics'));
    }

    /**
     * Generate the closing container html for a list of sections
     * @return string HTML to output.
     */
    protected
        function end_section_list()
    {
        return html_writer::end_tag('ul');
    }

    /**
     * Generate the title for this section page
     * @return string the page title
     */
    protected
        function page_title()
    {
        return get_string('topicoutline');
    }

    /**
     * Generate the edit controls of a section
     *
     * @param stdClass $course The course entry from DB
     * @param stdClass $section The course_section entry from DB
     * @param bool $onsectionpage true if being printed on a section page
     * @return array of links with edit controls
     */
    protected
        function section_edit_controls($course, $section, $onsectionpage = false)
    {
        global $PAGE;

        if (!$PAGE->user_is_editing())
        {
            return array();
        }

        $coursecontext = context_course::instance($course->id);

        if ($onsectionpage)
        {
            $url = course_get_url($course, $section->section);
        }
        else
        {
            $url = course_get_url($course);
        }
        $url->param('sesskey', sesskey());

        $controls = array();
        if (has_capability('moodle/course:setcurrentsection', $coursecontext))
        {
            if ($course->marker == $section->section)
            {  // Show the "light globe" on/off.
                $url->param('marker', 0);
                $controls[] = html_writer::link($url, html_writer::empty_tag('img', array('src' => $this->output->pix_url('i/marked'),
                            'class' => 'icon ', 'alt' => get_string('markedthistopic'))), array('title' => get_string('markedthistopic'), 'class' => 'editing_highlight'));
            }
            else
            {
                $url->param('marker', $section->section);
                $controls[] = html_writer::link($url, html_writer::empty_tag('img', array('src' => $this->output->pix_url('i/marker'),
                            'class' => 'icon', 'alt' => get_string('markthistopic'))), array('title' => get_string('markthistopic'), 'class' => 'editing_highlight'));
            }
        }

        return array_merge($controls, parent::section_edit_controls($course, $section, $onsectionpage));
    }

    /**
     * Generate the display of the header part of a section before
     * course modules are included
     *
     * @param stdClass $section The course_section entry from DB
     * @param stdClass $course The course entry from DB
     * @param bool $onsectionpage true if being printed on a single-section page
     * @param int $sectionreturn The section to return to after an action
     * @return string HTML to output.
     */
    protected function section_header($section, $course, $onsectionpage, $sectionreturn = null)
    {
        global $PAGE, $CFG, $USER;

        $context = context_course::instance($course->id);

        $unidad = new Unidad($course, $section);
        $url = new moodle_url('/course/format/unidades/confirma.php', array('id' => $unidad->id, 'sesskey' => sesskey()));
        $forma = new unidad_form($url, array(
            'context' => $context,
            'unidad' => $unidad
        ));

        $o = '';
        $sectionstyle = '';

        if ($section->section != 0)
        {
            // Only in the non-general sections.
            if (!$section->visible)
            {
                $sectionstyle = ' hidden';
            }
            else if (course_get_format($course)->is_section_current($section))
            {
                $sectionstyle = ' current';
            }
        }

        $o.= html_writer::start_tag('li', array('id' => 'section-' . $section->section,
                'class' => 'section main clearfix' . $sectionstyle));

        $leftcontent = $this->section_left_content($section, $course, $onsectionpage);
        $o.= html_writer::tag('div', $leftcontent, array('class' => 'left side'));

        $rightcontent = $this->section_right_content($section, $course, $onsectionpage);
        $o.= html_writer::tag('div', $rightcontent, array('class' => 'right side'));
        $o.= html_writer::start_tag('div', array('class' => 'content'));

        // When not on a section page, we display the section titles except the general section if null
        $hasnamenotsecpg = (!$onsectionpage && ($section->section != 0 || !is_null($section->name)));

        // When on a section page, we only display the general section title, if title is not the default one
        $hasnamesecpg = ($onsectionpage && ($section->section == 0 && !is_null($section->name)));

        if ($hasnamenotsecpg || $hasnamesecpg)
        {
            $o.= $this->output->heading($this->section_title($section, $course), 3, 'sectionname');
        }

        $o.= html_writer::start_tag('div', array('class' => 'summary'));

        $forma->set_data($unidad->get_unidad());
        $o .= $forma->render();

        if ($PAGE->user_is_editing() && has_capability('moodle/course:update', $context) 
            && (has_capability('courseformat/unidades:crear', $context)
            || has_capability('courseformat/unidades:editar', $context))
                && $unidad->puedeSerEditada())
        {
            $url = new moodle_url('/course/editsection.php', array('id' => $section->id, 'sr' => $sectionreturn));
            $o.= html_writer::link($url, get_string('edit') . ' ' . html_writer::empty_tag('img', array('src' => $this->output->pix_url('t/edit'),
                        'class' => 'iconsmall edit', 'alt' => get_string('edit'))), array('title' => get_string('editsummary')));
        }
        $o .= html_writer::end_tag('div');

        $o .= $section->section != 0 ? "<br/><h3>Actividades Unidad $unidad->nu_unidad</h3>": '<br/><h3>Evaluación diagnóstica y Recursos</h3>';
        $o .= $this->section_availability_message($section, has_capability('moodle/course:viewhiddensections', $context));

        return $o;
    }

    /**
     * Output the html for a multiple section page
     *
     * @param stdClass $course The course entry from DB
     * @param array $sections (argument not used)
     * @param array $mods (argument not used)
     * @param array $modnames (argument not used)
     * @param array $modnamesused (argument not used)
     */
    public
        function print_multiple_section_page($course, $sections, $mods, $modnames, $modnamesused)
    {
        global $PAGE, $DB;

        $modinfo = get_fast_modinfo($course);
        $course = course_get_format($course)->get_course();

        $context = context_course::instance($course->id);
        // Title with completion help icon.
        $completioninfo = new completion_info($course);
        echo $completioninfo->display_help_icon();
        echo $this->output->heading($this->page_title(), 2, 'accesshide');

        // Copy activity clipboard..
        echo $this->course_activity_clipboard($course, 0);

        // Now the list of sections..
        echo $this->start_section_list();

        foreach ($modinfo->get_section_info_all() as $section => $thissection)
        {
            $unidad = new Unidad($course, $thissection);
            if ($section == 0)
            {
                // 0-section is displayed a little different then the others
                if ($PAGE->user_is_editing())
                {
                    echo $this->section_header($thissection, $course, false, 0);
                    echo $this->courserenderer->course_section_cm_list($course, $thissection, 0);
                    if($unidad->puedeSerEditada())
                        echo $this->courserenderer->course_section_add_cm_control($course, 0, 0);

                    echo $this->section_footer();
                }
                else
                {
                    echo $this->section_header($thissection, $course, false, 0);
                    echo $this->courserenderer->course_section_cm_list($course, $thissection, 0);
                    echo $this->section_footer();
                }
                continue;
            }
            if ($section > $course->numsections)
            {
                // activities inside this section are 'orphaned', this section will be printed as 'stealth' below
                continue;
            }
            // Show the section if the user is permitted to access it, OR if it's not available
            // but showavailability is turned on (and there is some available info text).
            $showsection = $thissection->uservisible ||
                ($thissection->visible && !$thissection->available && $thissection->showavailability && !empty($thissection->availableinfo));
            if (!$showsection)
            {
                // Hidden section message is overridden by 'unavailable' control
                // (showavailability option).
                if (!$course->hiddensections && $thissection->available)
                {
                    echo $this->section_hidden($section);
                }

                continue;
            }

            if (!$PAGE->user_is_editing() && $course->coursedisplay == COURSE_DISPLAY_MULTIPAGE)
            {
                // Display section summary only.
                echo $this->section_summary($thissection, $course, null);
            }
            else
            {
                echo $this->section_header($thissection, $course, false, 0);
                if ($thissection->uservisible)
                {
                    echo $this->courserenderer->course_section_cm_list($course, $thissection, 0);
                    if($unidad->puedeSerEditada())
                        echo $this->courserenderer->course_section_add_cm_control($course, $section, 0);
                }
                echo $this->section_footer();
            }
        }

        echo $this->end_section_list();
    }

    /**
     * Output the html for a single section page .
     *
     * @param stdClass $course The course entry from DB
     * @param array $sections (argument not used)
     * @param array $mods (argument not used)
     * @param array $modnames (argument not used)
     * @param array $modnamesused (argument not used)
     * @param int $displaysection The section number in the course which is being displayed
     */
    public
        function print_single_section_page($course, $sections, $mods, $modnames, $modnamesused, $displaysection)
    {
        global $PAGE;

        $modinfo = get_fast_modinfo($course);
        $course = course_get_format($course)->get_course();

        // Can we view the section in question?
        if (!($sectioninfo = $modinfo->get_section_info($displaysection)))
        {
            // This section doesn't exist
            print_error('unknowncoursesection', 'error', null, $course->fullname);
            return;
        }

        if (!$sectioninfo->uservisible)
        {
            if (!$course->hiddensections)
            {
                echo $this->start_section_list();
                echo $this->section_hidden($displaysection);
                echo $this->end_section_list();
            }
            // Can't view this section.
            return;
        }

        // Copy activity clipboard..
        echo $this->course_activity_clipboard($course, $displaysection);
        $thissection = $modinfo->get_section_info(0);

        if ($thissection->summary or !empty($modinfo->sections[0]) or $PAGE->user_is_editing())
        {
            $unidad = new Unidad($course, $thissection);
            echo $this->start_section_list();
            echo $this->section_header($thissection, $course, true, $displaysection);
            echo $this->courserenderer->course_section_cm_list($course, $thissection, $displaysection);
            if($unidad->puedeSerEditada())
                echo $this->courserenderer->course_section_add_cm_control($course, 0, $displaysection);
            echo $this->section_footer();
            echo $this->end_section_list();
        }

        // Start single-section div
        echo html_writer::start_tag('div', array('class' => 'single-section'));

        // The requested section page.
        $thissection = $modinfo->get_section_info($displaysection);

        // Title with section navigation links.
        $sectionnavlinks = $this->get_nav_links($course, $modinfo->get_section_info_all(), $displaysection);
        $sectiontitle = '';
        $sectiontitle .= html_writer::start_tag('div', array('class' => 'section-navigation header headingblock'));
        $sectiontitle .= html_writer::tag('span', $sectionnavlinks['previous'], array('class' => 'mdl-left'));
        $sectiontitle .= html_writer::tag('span', $sectionnavlinks['next'], array('class' => 'mdl-right'));
        // Title attributes
        $titleattr = 'mdl-align title';
        if (!$thissection->visible)
        {
            $titleattr .= ' dimmed_text';
        }
        $sectiontitle .= html_writer::tag('div', get_section_name($course, $displaysection), array('class' => $titleattr));
        $sectiontitle .= html_writer::end_tag('div');
        echo $sectiontitle;

        // Now the list of sections..
        echo $this->start_section_list();

        echo $this->section_header($thissection, $course, true, $displaysection);
        // Show completion help icon.
        $completioninfo = new completion_info($course);
        echo $completioninfo->display_help_icon();

        echo $this->courserenderer->course_section_cm_list($course, $thissection, $displaysection);
        $unidad = new Unidad($course, $thissection);
        if($unidad->puedeSerEditada())
            echo $this->courserenderer->course_section_add_cm_control($course, $displaysection, $displaysection);
        echo $this->section_footer();
        echo $this->end_section_list();

        // Display section bottom navigation.
        $sectionbottomnav = '';
        $sectionbottomnav .= html_writer::start_tag('div', array('class' => 'section-navigation mdl-bottom'));
        $sectionbottomnav .= html_writer::tag('span', $sectionnavlinks['previous'], array('class' => 'mdl-left'));
        $sectionbottomnav .= html_writer::tag('span', $sectionnavlinks['next'], array('class' => 'mdl-right'));
        $sectionbottomnav .= html_writer::tag('div', $this->section_nav_selection($course, $sections, $displaysection), array('class' => 'mdl-align'));
        $sectionbottomnav .= html_writer::end_tag('div');
        echo $sectionbottomnav;

        // Close single-section div.
        echo html_writer::end_tag('div');
    }

}
