<?php
/**
 * Home Tabs Widget Template
 *
 * @author 		Ibrahim Ibn Dawood
 * @category 	Widgets
 * @package 	MediaCenter/Framework/Templates/Widgets
 * @version 	1.0.6
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
<div class="inner-xs home-page-tabs">
	<div class="tab-holder">
		<ul class="nav nav-tabs">
			<li class="active"><a data-toggle="tab" href="#home-page-tab-1"><?php echo $title_tab_1; ?></a></li>
			<li><a data-toggle="tab" href="#home-page-tab-2"><?php echo $title_tab_2; ?></a></li>
			<li><a data-toggle="tab" href="#home-page-tab-3"><?php echo $title_tab_3; ?></a></li>
		</ul><!-- /.nav-tabs -->
		<div class="tab-content">
			<div id="home-page-tab-1" class="tab-pane active"><?php echo $content_tab_1;?></div><!-- /.tab-pane -->
			<div id="home-page-tab-2" class="tab-pane"><?php echo $content_tab_2;?></div><!-- /.tab-pane -->
			<div id="home-page-tab-3" class="tab-pane"><?php echo $content_tab_3;?></div><!-- /.tab-pane -->
		</div><!-- /.tab-content -->
	</div><!-- /.tab-holder -->
</div><!-- /.home-page-tabs -->