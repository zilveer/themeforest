<?php


function dtbaker_shortcode_fancy_posts($atts, $innercontent='', $code='') {
    extract(shortcode_atts(array(
        'id' => false,
        'category' => false,
        'max' => 4,
        'columns' => 2,
    ), $atts));
    // query wordpress for posts in this category.
	$custom_query = new WP_Query( 'category_name='.$category.'&posts_per_page='.$max );

    ob_start();
    ?>
<div class="fancy_posts">
    <?php if ( $custom_query->have_posts() ) :
	    $x=0;
    while ( $custom_query->have_posts() ) : $custom_query->the_post();
        ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class('blog fancy_post columns'.$columns.' '.(!($x++%$columns)?' first_row':'')); ?>>
            <?php if ( has_post_thumbnail() ) { ?>
                <div class="blog_image">
	                <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'boutique-kids' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
	                    <?php
		                if ( has_post_thumbnail() ) {
		                    the_post_thumbnail( 'boutique_blog-large', array(
		                        'class' => 'fancy_border',
		                    ) );
		                }
		                ?>
	                </a>
	            </div>
            <?php } ?>
            <div class="blog_summary_wrap">
                <div class="blog_date">
	                <span class="month"><?php echo get_the_date('M');?></span>
	                <span class="day"><?php echo get_the_date('j');?></span>
                    <span class="year"><?php echo get_the_date('Y');?></span>
	                <div></div>
                </div>
                <div class="blog_header">
                    <h2 class="entry-title <?php echo ( is_sticky() ) ? ' featured-post' : '';?> ?>"><span><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'boutique-kids' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></span></h2>
                </div>
		        <div class="blog_links">

			        <?php
			        $blog_links = array();
			        $blog_links [] = boutique_posted_on();
			        if ( comments_open() ){
				        ob_start();
				        comments_popup_link( '<span class="leave-comment">' . __( 'Leave a comment', 'boutique-kids' ) . '</span>', __( '<b>1</b> Comment', 'boutique-kids' ), __( '<b>%</b> Comments', 'boutique-kids' ) );
				        $blog_links[] = ob_get_clean();
			        }
			        $categories_list = get_the_category_list( __( ', ', 'boutique-kids' ) );
		            if ( $categories_list ){
		                $blog_links[] = sprintf( __( '<span class="%1$s">Categories:</span> %2$s', 'boutique-kids' ), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list );
		            }
			        $tags_list = get_the_tag_list( '', __( ', ', 'boutique-kids' ) );
		            if ( $tags_list ){
		                $blog_links[] = sprintf( __( '<span class="%1$s">Tags:</span> %2$s', 'boutique-kids' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list );
		            }
			        echo implode(' <span class="blog_links_sep">/</span> ',$blog_links);
			        ?>
		        </div>
                <div class="blog_summary">
                    <?php
                    //the_excerpt();
                    echo wp_html_excerpt(get_the_excerpt(),150).' [...]';
                    ?>
                </div>
            </div>
        </div>
        <?php
    endwhile;
else :
    ?> <p> <?php _e( 'Sorry, no posts were found.', 'boutique-kids' ); ?> </p> <?php
endif; ?>
</div>
    <div class="clear"></div>
    <script type="text/javascript">
        jQuery(function(){
            jQuery('.fancy_post')
        });
    </script>
<?php
	wp_reset_query();
    return ob_get_clean();
}

add_shortcode('fancy_posts', 'dtbaker_shortcode_fancy_posts');
