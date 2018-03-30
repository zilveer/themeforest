<?php get_header(); ?>
<?php
global $post;

if(function_exists("rwmb_meta")){
	$page_para = rwmb_meta( 'wish_header_bg', 'type=image&size=full', $post->ID );
	$page_text = rwmb_meta('wish_under_title', $post->ID);
	$page_check = rwmb_meta('wish_under_check', $post->ID);
}else{

	$page_para = "";
	$page_text = "";
	$page_check = false;
}

if ($page_check == 1) {

?>

<div class="parallax-inner page-10" <?php if(!empty($page_para)) { foreach($page_para as $image){ ?>style="background-image:url(<?php echo esc_url( $image['url'] ); ?>);"<?php } } ?>>
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-lg-offset-3">
				<div class="info">
					<h1 class="animated" data-animation="flipInX" data-animation-delay="100"><?php echo esc_attr( get_the_title() ); ?></h1>
					<div class="description animated" data-animation="fadeInUp" data-animation-delay="300"><?php echo esc_attr($page_text); ?></div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /. PARALLAX BANNER ENDS
	========================================================================= -->
<?php } ?>
			
			
			
		<!-- PROJECT DETAILS STARTS
			========================================================================= -->
		<div class="container project-page">
		
		<?php while ( have_posts() ) : the_post(); ?>

			<!-- Project Intro Starts -->
			<div class="row">
				<div class="col-lg-10 col-lg-offset-1">
					<div class="project-intro">
						<h1 class="animated" data-animation="fadeInUp" data-animation-delay="100"><?php esc_attr( the_title() ); ?></h1>
						<div class="description animated" data-animation="fadeInUp" data-animation-delay="300"><p><?php echo get_post_meta($post->ID, 'wish_about_project', true); ?></p></div>
					</div>
				</div>
			</div>
			<!-- Project Intro Ends -->
			           
			<!-- Slider Starts -->
			<?php 
			if(function_exists("rwmb_meta")){
				$slides = rwmb_meta( 'wish_project_gal', 'type=image&size=full' );
			}else{
				$slides = array();
			}	 

			if($slides){
			?>
			<div class="pictures-carousel animated" data-animation="fadeInUp" data-animation-delay="100">
			<?php foreach($slides as $slide){ ?>
				<div><img src="<?php echo esc_url( $slide['url'] ); ?>" class="img-responsive" alt=""></div>
				<?php } ?>
			</div>
			<?php } ?>
			<!-- Slider Ends -->
			<?php 
			$wish_project_client = get_post_meta($post->ID, 'wish_project_client', true);
			$wish_project_date = get_post_meta($post->ID, 'wish_project_date', true);
			$wish_project_url = get_post_meta($post->ID, 'wish_project_url', true);
			?>
			<div class="row project-details">
				<div class="col-lg-10 col-lg-offset-1">
					<div class="row">
						<div class="col-lg-5">
							<h2 class="animated" data-animation="fadeInUp" data-animation-delay="100"><?php esc_html_e("Project Details", "wish"); ?></h2>
							<ul class="project-info">
							<?php if($wish_project_client){ ?>
								<li class="animated" data-animation="fadeInRight" data-animation-delay="300">
									<div class="caption"><?php esc_html_e("CLIENT", "wish"); ?></div>
									<div class="detail"><?php echo esc_attr( $wish_project_client ); ?></div>
								</li>
								<?php } ?>
								<?php if($wish_project_date){ ?>
								<li class="animated" data-animation="fadeInRight" data-animation-delay="600">
									<div class="caption"><?php esc_html_e("DATE", "wish"); ?></div>
									<div class="detail"><?php echo esc_attr( $wish_project_date ); ?></div>
								</li>
								<?php } ?>
								<?php if($wish_project_url){ ?>
								<li class="animated" data-animation="fadeInRight" data-animation-delay="900">
									<div class="caption"><?php esc_html_e("ONLINE", "wish"); ?></div>
									<div class="detail"><a href=""><?php echo esc_attr( $wish_project_url ); ?></a></div>
								</li>
								<?php } ?>
							</ul>
								<?php if($wish_project_url){ ?>
							<div class="buttons animated" data-animation="flipInX" data-animation-delay="1200"><a href="<?php echo esc_url( $wish_project_url ); ?>" class="fill"><?php esc_html_e("GO LIVE", "wish"); ?></a></div>
							<?php } ?>
						</div>
						
						<div class="col-lg-7">
							<div class="description animated" data-animation="fadeInUp" data-animation-delay="100"><?php the_content(); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // end of the loop. ?>
		</div>
		<!-- /. PROJECT DETAILS ENDS
			========================================================================= -->
		<!-- RELATED PROJECTS STARTS
			========================================================================= -->
			
		<div class="container related-projects">
			<div class="row">
			<?php $custom_terms = wp_get_post_terms($post->ID, 'projects_categories', array("fields" => "all"));  $postID = $post->ID; ?>
			<?php
				if( $custom_terms ){

    $tax_query = array();

    if( count( $custom_terms > 1 ) )
        $tax_query['relation'] = 'OR' ;

    foreach( $custom_terms as $custom_term ) {

        $tax_query[] = array(
            'taxonomy' => 'projects_categories',
            'field' => 'slug',
            'terms' => $custom_term->slug,
        );

    }
 // put all the WP_Query args together
    $args = array( 'post_type' => 'wish_projects',
                    'posts_per_page' => 4,
                    'tax_query' => $tax_query );

    // finally run the query
    $loop = new WP_Query($args);
	 if( $loop->have_posts() ) {
$i=0;
?>
<div class="col-lg-12">
					<h1 class="animated" data-animation="fadeInUp" data-animation-delay="100"><?php esc_html_e("RELATED PROJECTS", "wish"); ?></h1>
				</div>
<?php
        while( $loop->have_posts() ) : $loop->the_post(); if($postID!=$post->ID){ $i = $i+1; ?>
				
				<?php if($i<=3){ ?>
				
				<div class="col-lg-4 animated" data-animation="fadeInUp" data-animation-delay="400">
					<div class="image"><?php get_the_post_thumbnail( array(350,450) ); ?></div>
					<div class="caption"><a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php the_title(); ?></a></div>
					<div class="date"><?php $date = get_post_meta($post->ID, 'wish_project_date', true); echo date("Y", strtotime($date)); ?></div>
				</div>
				<?php 
				}
		}
        endwhile;

    }

    wp_reset_query();

}
?>
			
				
			</div>
		</div>
		<!-- /. RELATED PROJECTS ENDS
			========================================================================= -->

 
		   
<?php get_footer(); ?>