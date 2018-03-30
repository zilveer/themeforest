<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package shift_cv
 */

global $is_resume_page;
if (isset($_REQUEST['prn'])) {
	get_template_part('template', 'print');
} else if (get_theme_option("homepage") == 'blog' && !isset($_REQUEST['cv'])) {
	$is_resume_page = false;
	get_template_part('template', 'blog');
} else {
	$is_resume_page = true;
	get_template_part('template', 'home');
}
?>