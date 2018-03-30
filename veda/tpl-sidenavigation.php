<?php
/*
Template Name: Side Navigation Template
*/
get_header();
	$tpl_default_settings = get_post_meta($post->ID,'_tpl_default_settings',TRUE);
	$tpl_default_settings = is_array( $tpl_default_settings ) ? $tpl_default_settings  : array();

	$page_layout  = array_key_exists( "layout", $tpl_default_settings ) ? $tpl_default_settings['layout'] : "content-full-width";
	$show_sidebar = $show_left_sidebar = $show_right_sidebar = false;
	$sidebar_class = "";
	
	switch ( $page_layout ) {
		case 'with-left-sidebar':
			$page_layout = "page-with-sidebar with-left-sidebar";
			$show_sidebar = $show_left_sidebar = true;
			$sidebar_class = "secondary-has-left-sidebar";
		break;

		case 'with-right-sidebar':
			$page_layout = "page-with-sidebar with-right-sidebar";
			$show_sidebar = $show_right_sidebar	= true;
			$sidebar_class = "secondary-has-right-sidebar";
		break;
		
		case 'with-both-sidebar':
			$page_layout = "page-with-sidebar with-both-sidebar";
			$show_sidebar = $show_left_sidebar = $show_right_sidebar = true;
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
			<section id="secondary-left" class="secondary-sidebar <?php echo esc_attr( $sidebar_class );?>"><?php get_sidebar('left');?></section><?php
		endif;
	endif;?>
    <section id="primary" class="<?php echo esc_attr( $page_layout );?>">

      	<!-- **Side Navigation** -->
        <div class="side-navigation">
	        <div class="side-nav-container">
            <ul class="side-nav"><?php
				if( $post->post_parent ):
					$args = array('child_of' => $post->post_parent,'title_li' => '','sort_order'=> 'ASC','sort_column' => 'menu_order');
				else:
					$args = array('child_of' => $post->ID,'title_li' => '','sort_order'=> 'ASC','sort_column' => 'menu_order');
				endif;
				
				$pages = get_pages( $args );
				$ids = array();
				$page_id = $post->ID;
				
				foreach($pages as $value){
					$ids[] = $value->ID;
				}
				
				foreach( $ids as $id ) {
					$title = get_the_title($id);
					$title = esc_attr( $title );
					$permalink = get_permalink( $id );
					$permalink = esc_url( $permalink );
					
					$tpl_default_settings = get_post_meta($id,'_tpl_default_settings',TRUE);
					$tpl_default_settings = is_array($tpl_default_settings) ? $tpl_default_settings  : array();
					
					$current = ( $id ===  $page_id) ? "current_page_item" : "";
					$current = esc_attr( $current );
					echo "<li class='{$current}'>";
					echo "<a href='{$permalink}'>$title</a>";
					echo "</li>";
				}?></ul>            
            </div>    
        </div><!-- **Side Navigation End** -->

      	<!-- **Side Navigation Content** -->
        <div class="side-navigation-content"><?php
        	if( have_posts() ):
        		while( have_posts() ):
        			the_post();
        			get_template_part( 'functions/loops/content', 'page' );
        		endwhile;
        	endif;?>
        </div><!-- **Side Navigation Content End** -->
    </section><!-- **Primary - End** --><?php
	
	if ( $show_sidebar ):
		if ( $show_right_sidebar ): ?>
			<!-- Secondary Right -->
			<section id="secondary-right" class="secondary-sidebar <?php echo esc_attr( $sidebar_class );?>"><?php get_sidebar('right');?></section><?php
		endif;
	endif;
get_footer();?>