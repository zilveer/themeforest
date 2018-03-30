<?php get_header(); ?>

<div class="container">
	
    <?php
	$page_layout 	= dttheme_option('specialty','post-archives-layout');
  	$page_layout 	= !empty($page_layout) ? $page_layout : "content-full-width";
	$show_sidebar = $show_left_sidebar = $show_right_sidebar =  false;
	$sidebar_class = "";

	switch ( $page_layout ) {
		case 'with-left-sidebar':
			$page_layout = "with-sidebar with-left-sidebar";
			$show_sidebar = $show_left_sidebar = true;
			$sidebar_class = "secondary-has-left-sidebar";
		break;

		case 'with-right-sidebar':
			$page_layout = "with-sidebar with-right-sidebar";
			$show_sidebar = $show_right_sidebar	= true;
			$sidebar_class = "secondary-has-right-sidebar";
		break;

		case 'both-sidebar':
			$page_layout = "with-sidebar page-with-both-sidebar";
			$show_sidebar = $show_right_sidebar	= $show_left_sidebar = true;
			$sidebar_class = "secondary-has-both-sidebar";
		break;

		case 'content-full-width':
		default:
			$page_layout = "content-full-width";
		break;
	}

	if ( $show_sidebar ):
		if ( $show_left_sidebar ): ?>
			<!-- Secondary Left -->
			<div id="secondary-left" class="secondary-sidebar <?php echo $sidebar_class;?>"><?php get_sidebar( 'left' );?></div><?php
		endif;
	endif;?>

	<!-- ** Primary Section ** -->
	<div id="primary" class="<?php echo $page_layout;?>"><?php
	
		$post_layout = dttheme_option('specialty','post-archives-post-layout'); 
		$post_layout = !empty($post_layout) ? $post_layout : "one-column";
		$post_class = $container_class =  "";

		switch($post_layout):
			case 'one-column':
				$post_class = $show_sidebar ? " column dt-sc-one-column with-sidebar blog-fullwidth" : " column dt-sc-one-column blog-fullwidth";
				$columns = 1;
			break;

			case 'one-half-column';
				$post_class = $show_sidebar ? " column dt-sc-one-half with-sidebar" : " column dt-sc-one-half";
				$columns = 2;
				$container_class = "apply-isotope";
			break;

			case 'one-third-column':
				$post_class = $show_sidebar ? " column dt-sc-one-third with-sidebar" : " column dt-sc-one-third";
				$columns = 3;
				$container_class = "apply-isotope";
			break;

		endswitch;

		echo "<div class='blog-items {$container_class}'>";
		if( have_posts() ):
			$i = 1;
			while( have_posts() ):
				the_post();
				$temp_class = "";
				if($i == 1) $temp_class = $post_class." first"; else $temp_class = $post_class;
				if($i == $columns) $i = 1; else $i = $i + 1;
				?>
				<div class="<?php echo $temp_class;?>"><?php  get_template_part( 'framework/loops/content', 'archive');?></div>
<?php 		endwhile;
		endif;
		echo "</div>"; ?><!-- .tpl-blog-holder  -->


			<!-- **Pagination** -->
           <div class="pagination">
                <div class="prev-post"><?php previous_posts_link('<span class="fa fa-angle-double-left"></span> Prev');?></div>
                <?php echo dttheme_pagination();?>
                <div class="next-post"><?php next_posts_link('Next <span class="fa fa-angle-double-right"></span>');?></div>
           </div><!-- **Pagination - End** -->
		           

		</div><!-- ** Primary Section End ** --><?php

	if ( $show_sidebar ):
		if ( $show_right_sidebar ): ?>
			<!-- Secondary Right -->
			<div id="secondary-right" class="secondary-sidebar <?php echo $sidebar_class;?>"><?php get_sidebar( 'right' );?></div><?php
		endif;
	endif;?>

</div>
<div class="dt-sc-margin70"></div>    
<?php get_footer(); ?>