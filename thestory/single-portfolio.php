<?php
/**
 * Single Portfolio Template - This is the template for the single portfolio item content.
 */
get_header();

if(have_posts()){
	while(have_posts()){
		the_post();
		//get all the page data needed and set it to an object that can be used in other files
		$pexeto_page=pexeto_get_post_meta($post->ID, array('type'), PEXETO_PORTFOLIO_POST_TYPE);
		$pexeto_page['layout']=pexeto_option('portfolio_layout');
		$pexeto_page['sidebar']=pexeto_option('portfolio_sidebar');
		$pexeto_portf = new stdClass();

		$pexeto_portf->show_title = pexeto_option('portfolio_show_title');
		$pexeto_portf->single_slider=false;
		$pexeto_portf->video = false;
		if(in_array($pexeto_page['type'], array('smallslider','fullslider','smallvideo','fullvideo'))){
			$pexeto_page['layout']='full';
			// $pexeto_page['portfolio_slider']=true;
			$pexeto_portf->single_slider=true;

			if($pexeto_page['type']=='fullvideo' || $pexeto_page['type']=='smallvideo'){
				$pexeto_portf->video=true;
			}
			$pexeto_portf->show_title = false;
		}
		$pexeto_page['header_display']['show_title']=false;
		
		//include the before content template
		locate_template( array( 'includes/html-before-content.php'), true, true ); 
		
		if(!$pexeto_portf->single_slider){
			//PRINT A STANDARD LAYOUT PAGE WITH CONTENT
			
		?>
		<div class="content-box">
		<?php

			if($pexeto_page['type']=='standard' || $pexeto_page['type']=='custom'){ 
				if($pexeto_portf->show_title){
					?><h2 class="content-page-title"><?php the_title(); ?></h2><?php
				}
				//PRINT the FEATURED IMAGE
				$pexeto_portf->custom_link = pexeto_get_single_meta($post->ID, 'custom_link');
				$pexeto_portf->link = ($pexeto_page['type']=='custom' && $pexeto_portf->custom_link) ? $pexeto_portf->custom_link : null;
				if ( has_post_thumbnail() && pexeto_option('portfolio_show_featured')!=false){

					$pexeto_portf->img_size = pexeto_get_image_size_options(1);

					if($pexeto_portf->link){
						?><a href="<?php echo esc_url( $pexeto_portf->link ); ?>"><?php
					}
					
					$pexeto_portf->thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
						
					<img class="portfolio-featured" src="<?php echo pexeto_get_resized_image( $pexeto_portf->thumb[0], $pexeto_portf->img_size['width'], $pexeto_portf->img_size['height'], $pexeto_portf->img_size['crop'] ); ?>" />
				
					<?php if($pexeto_portf->link){
						?></a><?php
					}

				}
				?>
			<?php }

			the_content();

			//print sharing
			echo pexeto_get_share_btns_html($post->ID, 'portfolio');

			?>
			</div>
			<?php
			
			if(pexeto_option('portfolio_comments')=='on'){  
				comments_template();  
			} 
		}else{
			//PRINT A PORTFOLIO ITEM SLIDER
			?>
			<div id="portfolio-slider">
			<?php 
				echo pexeto_get_portfolio_slider_item_html($post->ID, true); 
				echo pexeto_get_portfolio_carousel_html($post->ID);
			?>
			</div>
			<?php
			//set the initialization scripts
			global $pexeto_scripts;
			$pexeto_portf->scr_args = array(
					'ajaxUrl' => admin_url( 'admin-ajax.php' ),
					'singleItem' => true,
					'video' => $pexeto_portf->video,
					'itemId' => $post->ID,
					'enableAJAX' => pexeto_option('portfolio_ajax')
				);
			$pexeto_scripts['portfolio-gallery'] = array('selector'=>'#portfolio-slider', 'options'=>$pexeto_portf->scr_args);
	
		}
		
		

	}
}

	 
//include the after content template
locate_template( array( 'includes/html-after-content.php'), true, true );

get_footer();
?>

