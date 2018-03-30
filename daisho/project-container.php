<?php
/**
 * We load projects dynamically but for direct entrance it's advisable to print the content with PHP.
 * This improves search engine and sharing services compatibility.
 */
while ( have_posts() ) : the_post();

$title = $description = $slides = $sharing_url = $sharing_text = $date = $client = $agency = $ourrole = '';
$share_url = esc_url( get_home_url() );
$share_text = urlencode( get_bloginfo( 'name' ) );
$parent_portfolio_password_required = false;
if(is_singular('portfolio')){

	// Title
	$title = get_the_title();
	
	// Description
	if ( ! post_password_required() ) {
		$description = do_shortcode( wpautop( wp_kses_post( get_post_meta( $post->ID, 'flow_post_description', true ) ) ) );
	}
	
	// Content
	$slides = apply_filters('the_content', get_the_content());
	
	// Meta data
	$date = get_post_meta($post->ID, 'portfolio_date', true);
	$client = get_post_meta($post->ID, 'portfolio_client', true);
	$agency = get_post_meta($post->ID, 'portfolio_agency', true);
	$ourrole = get_post_meta($post->ID, 'portfolio_ourrole', true);
	
	// Share data
	$share_url = get_permalink( $post->ID );
	$share_text = urlencode( $title );
	
	// Password protected parent portfolio page
	$main_portfolio_page = get_option( 'flow_portfolio_page' );
	$id_of_parent_portfolio = -1;
	if(($parent_page = get_post_meta($post->ID, 'portfolio_back_button', true)) && !empty($parent_page) && ($parent_page != 'none')){
		$id_of_parent_portfolio = $parent_page;
	}else if($main_portfolio_page != ''){
		$id_of_parent_portfolio = $main_portfolio_page;
	}
	if ( $id_of_parent_portfolio != -1 && post_password_required( $id_of_parent_portfolio ) ) {
		$parent_portfolio_password_required = true;
	}
}
?>
<div class="portfolio_box <?php if(is_singular('portfolio')){ echo 'portfolio_box-visible'; } ?>">
	<div class="content-projectc">
		<div class="project-meta clearfix">
			<div class="project-meta-col-1">
				<?php if($date){ ?>
				<div class="project-meta-data project-date clearfix">
					<div class="project-meta-heading"><?php _e( 'Date', 'flowthemes' ); ?></div>
					<div class="project-meta-description project-exdate"><?php echo $date; ?></div>
				</div>
				<?php } ?>
				<?php if($client){ ?>
				<div class="project-meta-data project-client clearfix">
					<div class="project-meta-heading"><?php _e( 'Client', 'flowthemes' ); ?></div>
					<div class="project-meta-description project-exclient"><?php echo $client; ?></div>
				</div>
				<?php } ?>
				<?php if($agency){ ?>
				<div class="project-meta-data project-agency clearfix">
					<div class="project-meta-heading"><?php _e( 'Agency', 'flowthemes' ); ?></div>
					<div class="project-meta-description project-exagency"><?php echo $agency; ?></div>
				</div>
				<?php } ?>
			</div>
			<div class="project-meta-col-2">
				<?php if($ourrole){ ?>
				<div class="project-meta-data project-ourrole clearfix">
					<div class="project-meta-heading"><?php _e( 'Our Role', 'flowthemes' ); ?></div>
					<div class="project-meta-description project-exourrole"><?php echo $ourrole; ?></div>
				</div>
				<?php } ?>
			</div>
		</div>
		<div class="sharing-icons">
			<a href="https://twitter.com/share?url=<?php echo $share_url; ?>&amp;text=<?php echo $share_text; ?>" target="_blank" class="sharing-icons-twitter">
				<span class="sharing-icons-icon">t</span>
				<span class="sharing-icons-tooltip" data-tooltip="Twitter"></span>
			</a>
			<a href="http://www.facebook.com/sharer.php?u=<?php echo $share_url; ?>&amp;t=<?php echo $share_text; ?>" target="_blank" class="sharing-icons-facebook">
				<span class="sharing-icons-icon">f</span>
				<span class="sharing-icons-tooltip" data-tooltip="Facebook"></span>
			</a>
			<a href="https://plus.google.com/share?url=<?php echo $share_url; ?>" target="_blank" class="sharing-icons-googleplus">
				<span class="sharing-icons-icon">g</span>
				<span class="sharing-icons-tooltip" data-tooltip="Google+"></span>
			</a>
		</div>
		<h2 class="project-title"><?php echo $title; ?></h2>
		<div class="project-description"><?php echo $description; ?></div>
		<div class="project-slides clearfix"><?php echo $slides; ?></div>
	</div>
</div>

<?php if ( ! $parent_portfolio_password_required ) { ?>
<nav class="project-navigation clearfix" role="navigation">
	<a class="portfolio-arrowleft portfolio-arrowleft-visible"><?php _e( 'Previous', 'flowthemes' ); ?></a>
	<a class="portfolio-arrowright portfolio-arrowright-visible"><?php _e( 'Next', 'flowthemes' ); ?></a>
</nav>
<?php } ?>

<div class="project-coverslide <?php if(is_singular('portfolio')){ echo 'project-coverslide-visible'; } ?>"></div>

<?php endwhile; ?>
