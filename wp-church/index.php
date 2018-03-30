<?php
/**
 * The main template file.
 *
 */

get_header(); ?>

<div class="container">
	<?php get_slideshow(); ?>
</div>

<?php if (get_option('nets_latestmess')  == 'false') {?>
<div class="lastmess">
	<div class="container">
		<div class="grid10 first">
			<?php $musposts = get_posts('numberposts=1&post_type=messages');
			foreach($musposts as $musentry) { 
				$pagevalue = $musentry->ID;		
				$past = get_post_meta($pagevalue, 'netlabs_preacher' , true); 
				$evnt = get_post_meta($pagevalue, 'netlabs_messevent' , true);
				$dte = get_post_meta($pagevalue, 'netlabs_messagedate' , true);
				$pssg = get_post_meta($pagevalue, 'netlabs_passage' , true);
				$yout = get_post_meta($pagevalue, 'netlabs_messyoutube' , true);  
				$vimeo = get_post_meta($pagevalue, 'netlabs_messvimeo' , true); 
				$mplink = get_post_meta($pagevalue, 'netlabs_uploadlink' , true);   ?>		
			<?php } ?>
			<div class="lasthead"><?php echo get_option('nets_sptlatest')?></div>
			<div class="lasttitle">
			
				<span class="messspan"><?php echo get_the_title($pagevalue); ?></span> <span><?php echo book_replace($pssg); ?></span>
				<?php 
				if ($mplink) {
					echo '<img rel="' . $mplink . '" src="' . get_template_directory_uri() . '/images/micfront.png" class="micfront">';
				} else {											
					get_mpt2($pagevalue); 
				}
										 
				?>		
				
				
				<?php if ($yout) {?>	
					<a class="vid" href="http://www.youtube.com/watch?v=<?php echo $yout; ?>"><img class="movfront" src="<?php echo get_template_directory_uri(); ?>/images/movfront.png"></a>
				<?php } ?>
				<?php if ($vimeo) {?>	
					<a class="vim" href="http://vimeo.com/<?php echo $vimeo; ?>"><img class="movfront" src="<?php echo get_template_directory_uri(); ?>/images/movfront.png"></a>
				<?php } ?>
			
			
			</div>
			<div class="clear"></div>
			<div class="infoholder" style="margin: 0px 0px 0px 170px;"></div>
		</div>
		<div class="grid2 dirr">
			<?php if (get_option('nets_reassdir')){ ?>
			<a href="<?php echo get_option('nets_reassdir'); ?>"><span><?php echo get_option('nets_sptdir'); ?></span></a>
			<?php } else { ?>
				<a class="vmp" href="#"><span><?php echo get_option('nets_sptdir'); ?></span></a>
			<?php } ?>
		</div>
	</div>
</div>


</script> 

<?php } ?>

<div class="bodymid">
	<div class="stripetop">
	<div class="stripebot">
	<div class="hfeed container">
		<div class="mapdiv"></div>
		<div class="clear"></div>
		<div id="main">	
			<?php if (get_option('nets_tagline')){ ?>			
			<div class="mainwelcome">				
				<h1><?php echo stripslashes(get_option('nets_tagline')); ?></h1>				
			</div>		
			<?php } ?>			
			<?php if ( is_active_sidebar( 'index-left' ) ) : ?>	
			<div id="primary" class="widget-area grid4 first" role="complementary">				
				<ul class="xoxo">	
					<?php dynamic_sidebar( 'index-left' ); ?>
				</ul>
			</div>
			<?php endif; ?>
					
			<?php if ( is_active_sidebar( 'index-center' ) ) : ?>	
			<div id="primary" class="widget-area grid4" role="complementary">					
				<ul class="xoxo">	
					<?php dynamic_sidebar( 'index-center' ); ?>
				</ul>
			</div>
			<?php endif; ?>
					
			<?php if ( is_active_sidebar( 'index-right' ) ) : ?>	
			<div id="primary" class="widget-area grid4" role="complementary">					
				<ul class="xoxo">	
					<?php dynamic_sidebar( 'index-right' ); ?>
				</ul>
			</div>
			<?php endif; ?>
					
				

<?php get_footer(); ?>
