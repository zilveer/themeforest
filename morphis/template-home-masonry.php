<?php
/*
Template Name: Home - Masonry
*/
?>

<?php get_header(); ?>
	<?php 

global $NHP_Options; 
$options_morphis = $NHP_Options; 

		if( $options_morphis['toggleHeadline'] == '1' ) {	
			get_template_part('inc/headline'); 
		}
	?>
	
  </div>
  <!-- END HEADER CONTAINER-->         
	
  <div class="container">	
	<!-- MAIN BODY -->
	<div id="main" role="main" >	
		<?php global $wp_query; ?>
		<?php $page_id = $wp_query->get_queried_object_id(); ?>	
		
		<?php $masonry_headline = get_post_meta($page_id,'_cmb_masonry_headline',TRUE); ?>
		<?php $masonry_headline_desc = get_post_meta($page_id,'_cmb_masonry_headline_desc',TRUE); ?>
		
		<?php if($masonry_headline != '' && $masonry_headline_desc != '') : ?>
			<div id="headline-page" class="container-frame">		
				<?php if($masonry_headline != '') : ?>
					<h1><?php echo $masonry_headline; ?></h1>
				<?php endif; ?>
				<?php if($masonry_headline_desc != '') : ?>
					<p><?php echo $masonry_headline_desc; ?></p>
				<?php endif; ?>
			</div>		
			<hr />
		<?php endif; ?>
		<?php get_template_part('inc/masonry'); ?>
		<div class="clear"></div>
    </div> 
	<!-- END MAIN BODY -->
  </div> 
  <!-- END MAIN CONTAINER --> 
 
 <?php if( $options_morphis['twitter_hide_below'] == '1' ) { ?>
		<?php twitter_strip($options_morphis['twitter_username']); ?>
 <?php } ?>
          
<?php get_footer(); ?>