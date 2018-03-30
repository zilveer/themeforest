<?php
/*
 * Template for 404 pages
 */
get_header(); ?>

<main class="inner" id="page-404">
	<div class="container">
		<div class="row">
			<div class="col-md-8 center-block">
				<div class="info-404 text-center">
					<h2 class="primary-color inner-bottom-xs"><?php echo __( '404', 'mediacenter' ); ?></h2>
					<p class="lead"><?php echo __( 'We are sorry, the page you\'ve requested is not available.', 'mediacenter' ); ?></p>
					<div class="sub-form-row inner-top-xs inner-bottom-xs">
		                <form id="search" class="search-form" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		                    <input type="search" name="s" id="s" placeholder="<?php echo __( 'Type to search', 'mediacenter' ); ?>" autocomplete="off" value="<?php echo $s;?>">
		                    <button type="submit" class="le-button"><?php echo __( 'Go', 'mediacenter' ); ?></button>
		                </form>
				    </div>
					<div class="text-center">
						<a class="btn-lg huge" href="#"><i class="fa fa-home"></i> <?php echo __( 'Go to Home Page', 'mediacenter' ); ?></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<?php 

get_footer();