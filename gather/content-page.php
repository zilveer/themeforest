<?php
/**
 * @package Gather - Event Landing Page Wordpress Theme
 * @author Cththemes - http://themeforest.net/user/cththemes
 * @date: 10-8-2015
 *
 * @copyright  Copyright ( C ) 2014 - 2015 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */
 
global $cththemes_options;
?>
<div <?php post_class('content-page cth-page');?>>
    <div class="row">
		
		<div class="col-sm-12">
			<?php //the_title( '<h4 class="article-title">', '</h4>' ); ?>
			<?php if(has_post_thumbnail( )){ ?>
			<div class="entry-image">
		        <?php the_post_thumbnail('full',array('class'=>'img-responsive') ); ?>
		    </div>
			<?php } ?>
	        <?php edit_post_link( __( 'Edit', 'gather' ), '<span class="edit-link">', '</span>' ); ?>	
			<?php the_content( ); ?>
			<div class="clearfix"></div>
			<?php
				wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'gather' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				) );
			?>
		</div>
    </div>
</div>