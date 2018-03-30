<?php get_header(); ?>
<div class="row">
    <div class="large-12 columns main-content-top">
        <div class="row">
            <div class="large-6 columns">
                <h2>
					<?php if ( is_day() ) : ?>
					<?php printf( __( 'Daily Archives: <span>%s</span>', 'Evolution' ), get_the_date() ); ?>
					<?php elseif ( is_month() ) : ?>
					<?php printf( __( 'Monthly Archives: <span>%s</span>', 'Evolution' ), get_the_date('F Y') ); ?>
					<?php elseif ( is_year() ) : ?>
					<?php printf( __( 'Yearly Archives: <span>%s</span>', 'Evolution' ), get_the_date('Y') ); ?>
					<?php elseif ( is_category() ) : ?>
					<?php single_cat_title();?>
					<?php else : ?>
					<?php _e( 'Blog Archives', 'Evolution' ); ?>
					<?php endif; ?>
				</h2>
            </div>        
            <div class="large-6 columns">
                <?php if(class_exists('the_breadcrumb')){ $albc = new the_breadcrumb; } ?>
            </div>
        </div>
    </div>
</div>
<div class="row main-content">
    <div class="large-12 columns">
        <div class="large-9 columns">
            <?php
            if ( have_posts() ) the_post();
			rewind_posts();       
			get_template_part( 'loop', 'archive' );
            ?>
    	</div>
		<aside class="large-3 columns sidebar-right" id="sidebar"> 
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Blog Sidebar") ) : ?> <?php   endif;?>
		</aside>
       	<div class="clear"></div>
    </div>
</div>

<?php get_footer(); ?>