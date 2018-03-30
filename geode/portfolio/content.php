<?php
/**
 * @package WordPress
 * @subpackage ShortcodelicAddons
 * @since 1.0
 */
?>

<?php global $wp_query, $shortcodelic_loop, $singlefx; $gridder = geode_check_gridder(get_the_id()); ?>

<?php 

	/*if ( !is_single() )
		$classes[] = 'pix-letmebe';*/

	if ( $singlefx != '' ) {
		$classes[] = $singlefx;
	} else {
		$classes[] = apply_filters('geode_fx_onscroll','');
	}

	$archive = false;
	if ( is_post_type_archive( 'portfolio' ) || is_tax( 'portfolio_category' ) || is_tax('portfolio_tag') || $shortcodelic_loop==true ) {
		$archive = true;
	}
	$thumb_id = get_post_thumbnail_id(get_the_id());
	$postTh = wp_get_attachment_image_src( $thumb_id, 'full' );

	$link = geode_portfolio_linkto();
	$thumb = get_the_post_thumbnail(get_the_id(),'full');
	$thumb = apply_filters( 'geode_print_thumb' , $thumb);
	switch ($link) {
		case 'none':
			$title = get_the_title();
			$thumbnail = $thumb;
			break;
		case 'post':
			$title = '<a href="'.get_permalink().'">'.get_the_title().'</a>';
			$thumbnail = $thumb;
			break;
		case 'image':
			$title = get_the_title();
			$thumbnail = '<a href="'.$postTh[0].'" '.apply_filters( 'data_rel' , 'data-rel="gal"').' '.apply_filters( 'data_title' , 'data-title="'.get_the_title().'"').'>'.$thumb.'</a>';
			break;
		default:
			$title = '<a href="'.get_permalink().'">'.get_the_title().'</a>';
			$thumbnail = '<a href="'.get_permalink().'">'.$thumb.'</a>';
			break;
	}

	if ( is_single() ) {
		if ( get_option('pix_style_disable_colorbox_portfolio_items')!='true' ) {
			$thumbnail = '<a href="'.$postTh[0].'">'.$thumb.'</a>';		
		} else {
			$thumbnail = $thumb;		
		}
	}

	$dataSortCat = $dataSortTag = 'all ';
	
    $terms_cat = get_the_terms( get_the_id(), 'portfolio_category' ); 
	if($terms_cat){
		foreach ($terms_cat as $term) { 
			$dataSortCat .= $term->slug.' ';
		}
	}

    $terms_tag = get_the_terms( get_the_id(), 'portfolio_tag' ); 
	if($terms_tag){
		foreach ($terms_tag as $term) { 
			$dataSortTag .= $term->slug.' ';
		}
	}
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?> data-sort-cat="<?php echo $dataSortCat; ?>" data-sort-tag="<?php echo $dataSortTag; ?>">
		<div class="row">
			<div class="row-inside">

				<div class="entry-content sc-position-<?php echo geode_portfolio_fancy(); ?>">
				<?php if (geode_portfolio_fancy()!='fancy') echo '<div class="sc-bg-below">'; ?>

		        <?php if ( has_post_thumbnail() ) {
		            echo $thumbnail;
				} ?>

					<?php if ( !is_archive() && (!isset($gridder) || $gridder!=true) ) { ?>
						<div class="row">
							<div class="row-inside">
					<?php } ?>

					<?php if ( $archive ) : ?>
							<?php
								if (geode_portfolio_fancy()=='fancy') {
									echo '<div class="sc-bg-fancy">
									<div class="table_div">
										<div class="vertical_middle">
											<h4 class="sc-title entry-title">'.$title.'</h4>';
								}
							?>
							<?php
								if ( $link!='none' && !geode_is_related() ) {
							?>
								<?php if ( $link!='post' ) { ?>
										<a href="<?php echo $postTh[0]; ?>" class="sc-enlarge sc-iconaction" <?php echo apply_filters( 'data_rel', 'data-rel="gal"'); ?> <?php echo apply_filters( 'data_title', 'data-title="'.get_the_title().'"'); ?>><i class="scicon-awesome-resize-full"></i></a>
								<?php } ?>
							<?php 
								}
							?>
							<?php
								if (geode_portfolio_fancy()=='fancy') {
									echo '</div>
									</div>';
								}
							?>
						</div><!-- .sc-bg-<?php echo geode_portfolio_fancy(); ?> -->
						<?php if (geode_portfolio_fancy()!='fancy') echo '<h4 class="sc-title entry-title">'.$title.'</h4>'; ?>

						<?php if ( is_search() || ( $archive && geode_portfolio_fancy()!='fancy') ) : ?>
							<div class="entry-summary">
								<?php if ( !isset($gridder) || $gridder!=true ) { ?>
									<div class="row">
										<div class="row-inside">
								<?php } ?>
											<?php
												geode_posted_on('category');
											?>
								<?php if ( !isset($gridder) || $gridder!=true ) { ?>
										</div><!-- .row-inside -->
									</div><!-- .row -->
								<?php } ?>
							</div><!-- .entry-summary -->
						<?php endif; ?>

					<?php else :

						if ( get_post_meta( $post->ID, 'pix_sidebar_content', true )=='on' && geode_get_page_template()=='default' ) {
							echo '<br>';
						} else {
							echo '<div class="entry-text">';
							the_content();
							echo '</div><!-- .entry-text -->';
						}

					endif; ?>

					<?php if ( is_single() && !geode_is_related() ) { ?>

						<?php if (get_the_term_list( get_the_id(), 'portfolio_category', '', ', ', '' ) != '' ) { ?>
							<footer class="entry-meta"><span class="cat-links"><strong><?php _e('Categories','geode'); ?>: </strong><?php echo get_the_term_list( get_the_id(), 'portfolio_category', '', ', ', '' ); ?></span></footer>
						<?php } ?>
						<?php if (get_the_term_list( get_the_id(), 'portfolio_tag', '', ', ', '' ) != '' ) { ?>
							<footer class="entry-meta"><span class="tag-links"><strong><?php _e('Tags','geode'); ?>: </strong><?php echo get_the_term_list( get_the_id(), 'portfolio_tag', '', ', ', '' ); ?></span></footer>
						<?php } ?>


					<?php } ?>

					<?php if ( !is_archive() && (!isset($gridder) || $gridder!=true) ) { ?>
							</div><!-- .row-inside -->
						</div><!-- .row -->
					<?php } ?>
				</div><!-- .entry-content -->

			<?php if ( is_single() ) edit_post_link( __( 'Edit', 'geode' ), '<span class="edit-link">', '</span>' ); ?>

			</div><!-- .row-inside -->
		</div><!-- .row -->
	</article>