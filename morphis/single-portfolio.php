<?php
/**
 * The template for displaying content in the single.php template
 *
 * @package WordPress
 * @subpackage Morphis
 * @since Morphis 1.0
 */
?>

<?php get_header(); ?>


<!-- END HEADER -->	
	<div class="clear"></div>
	<!-- MAIN BODY -->
    <div id="main" role="main" class="sixteen columns">
		<!-- START BLOG CONTAINER -->
		<div class="blog-post single-post2">
			<!-- START BLOG MAIN -->
			
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
		<div id="portfolio-single">
			<div id="content" class="portfolio-single add-bottom-full clearfix">
				
				<div class="twelve columns alpha add-bottom">
					<h4 class="entry-title"><?php the_title(); ?></h4>					
					<h6 class="portfolio-client"><?php echo get_post_meta($post->ID, '_cmb_client_name', TRUE); ?></h6>
					<p class="portfolio-info-desc"><?php echo wpautop(do_shortcode(get_post_meta($post->ID, '_cmb_info_desc', TRUE))); ?></p>
					<!-- Portfolio Attachment -->
					<?php $portfolio_attachment = get_post_meta($post->ID,'_cmb_select_attachment',TRUE); ?>																	
					<?php if($portfolio_attachment == 'slideshow') : ?>
					<?php $portfolio_attachment_slideshow = get_post_meta($post->ID,'_cmb_attachment_slideshow',TRUE); ?>
						<?php gallery_carouFredSel($post->ID, $portfolio_attachment_slideshow); ?>
						
					<?php elseif($portfolio_attachment == 'multiple_image') : ?>
					
						<?php gallery_multiple_image($post->ID); ?>
						
					<?php elseif($portfolio_attachment == 'image') : ?>
						<?php $image_pf = get_post_meta($post->ID,'_cmb_attachment_image',TRUE); ?>							
						<?php if ( $image_pf != '' ) { ?>
							<div class="overlay squared half-bottom">
								<figure>
									<a class="icon-view" href="<?php echo $image_pf; ?>" rel="prettyPhoto" title=""></a>
									<a class="icon-link" href="<?php echo get_permalink(); ?>"></a>
									<a href="<?php echo $image_pf; ?>" class="overlay-lightbox" rel="prettyPhoto" title="<?php echo get_the_title ($post->ID); ?>">
										<img src="<?php echo $image_pf; ?>" width="700" alt="<?php echo get_the_title ($post->ID); ?>" />
									</a>
								</figure>
							</div>
						<?php } ?>
					<?php elseif($portfolio_attachment == 'vimeo') : ?>
						<div class="video-figure half-bottom">
						<?php $codeEmbed = get_post_meta($post->ID, '_cmb_attachment_vimeo', true); ?>						
						<?php echo stripslashes(htmlspecialchars_decode($codeEmbed)); ?>
						</div>
					<?php elseif($portfolio_attachment == 'youtube') : ?>
						<div class="video-figure half-bottom">
						<?php $codeEmbed = get_post_meta($post->ID, '_cmb_attachment_youtube', true); ?>						
						<?php echo stripslashes(htmlspecialchars_decode($codeEmbed)); ?>
						</div>
					<?php endif; ?>
					<!-- End Portfolio Attachment -->					
					
				<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'morphis' ) . '</span>', 'after' => '</div>' ) ); ?>
				<nav id="nav-single">						
					<span class="nav-previous"><?php previous_post_link( '%link', '&larr; %title' ); ?></span>
					<span class="nav-next"><?php next_post_link( '%link', '%title &rarr;' ); ?></span>
				</nav><!-- #nav-single -->
				<div class="clear"></div>
					
				</div>
					
				<div class="four columns omega sidebar-right">
				
						<dl class="portfolio-meta sidebar-borders">
						
							<?php // get user-defined attributes name ?>
							<?php $ud_att_client = get_post_meta($post->ID, '_cmb_client_name_att', TRUE); ?>
							<?php $ud_att_date = get_post_meta($post->ID, '_cmb_date_completed_att', TRUE); ?>
							<?php $ud_att_skills = get_post_meta($post->ID, '_cmb_skills_tech_att', TRUE); ?>
							<?php $ud_att_portfolio_cats = get_post_meta($post->ID, '_cmb_categories_att', TRUE); ?>
							<?php $ud_att_launch_proj = get_post_meta($post->ID, '_cmb_launch_project_att', TRUE); ?>
												
							 <?php $ud_att_client = $ud_att_client != ''  ? $ud_att_client : __('Client', 'morphis'); ?>
							 <?php $ud_att_date = $ud_att_date != ''  ? $ud_att_date : __('Date', 'morphis'); ?>
							 <?php $ud_att_skills = $ud_att_skills != ''  ? $ud_att_skills : __('Skills &amp; Technologies', 'morphis'); ?>
							 <?php $ud_att_portfolio_cats = $ud_att_portfolio_cats != ''  ? $ud_att_portfolio_cats : __('Categories', 'morphis'); ?>
							 <?php $ud_att_launch_proj = $ud_att_launch_proj != ''  ? $ud_att_launch_proj : __('Launch Project', 'morphis'); ?>
							 
							 
						
							<?php $att_client = get_post_meta($post->ID, '_cmb_client_name', TRUE); ?>
							<?php $att_date = get_post_meta($post->ID, '_cmb_date_completed', TRUE); ?>
							<?php $att_skills = get_the_terms( $post->ID, 'Skills'); ?>
							<?php $att_portfolio_cats = get_the_terms( $post->ID, 'Categories'); ?>
							<?php $att_optional_desc = get_post_meta($post->ID, '_cmb_info_optional_desc', TRUE); ?>
							<?php $att_launch_proj = get_post_meta($post->ID, '_cmb_launch_link', TRUE); ?>
							
							<?php if($att_client != ''): ?>
							<dt><?php echo $ud_att_client; ?></dt>
								<dd><?php echo $att_client; ?></dd>
							<?php endif; ?>
							<?php if($att_date != ''): ?>
							<dt><?php echo $ud_att_date; ?></dt>
								<dd><?php echo $att_date; ?></dd>
							<?php endif; ?>
							<?php if(!empty($att_skills)): ?>
							<dt><?php echo $ud_att_skills; ?></dt>
								<dd>
								  	<ul id="skills-list" class="clearfix">
									<?php $skills_list = $att_skills; ?>
										<?php if(!empty($skills_list)): ?>
										<?php foreach( $skills_list as $skill ) { ?>
											<li><?php echo $skill->name; ?></li>	
										<?php } ?>
										<?php endif; ?>
									</ul>
								</dd>
							<?php endif; ?>
							<?php if(!empty($att_portfolio_cats)): ?>
							<dt><?php echo $ud_att_portfolio_cats; ?></dt>
								<dd>
									<ul id="" class="clearfix">
									<?php $portfolio_cats = $att_portfolio_cats; ?>
									<?php if(!empty($portfolio_cats)): ?>
										<?php foreach( $portfolio_cats as $portfolio_cat ) { ?>
											<li><?php echo $portfolio_cat->name; ?></li>	
										<?php } ?>
									<?php endif; ?>
									</ul>
								</dd>
							<?php endif; ?>
							<?php if($att_optional_desc != ''): ?>	
							<p><?php echo $att_optional_desc; ?></p>
							<?php endif; ?>
							<?php if($att_launch_proj != ''): ?>
							<a href="<?php echo $att_launch_proj; ?>" class="portfolio-launch read-this"><?php echo $ud_att_launch_proj; ?></a>
							<?php endif; ?>
						</dl>
				</div>
				
			</div>
			
		</div>
</article><!-- #post-<?php the_ID(); ?> -->
		
		<div class="clear"></div>
		</div><!-- #blog post -->
	</div>
	</div> <!-- #end cntainer -->
	
	
<?php 
global $NHP_Options; 
$options_morphis = $NHP_Options; 
?>
 <?php if( $options_morphis['twitter_hide_below'] == '1' ) { ?>
		<?php twitter_strip($options_morphis['twitter_username']); ?>
 <?php } ?>
<?php get_footer(); ?>
