<?php
/**
 * @package    WordPress
 * @subpackage Website
 * @since      1.0
 */

if (($breadcrumbs = Website::to_('nav/breadcrumbs', '__hidden')) !== null && $breadcrumbs->value()) {

	echo '<section class="breadcrumbs">'.Website::getBreadcrumbs().'</section>';

}