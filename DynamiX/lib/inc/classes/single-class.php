<?php 
/**
 * The template for displaying single post data
 *
 * @package WordPress
 */ ?>
 
	<div class="nextprevious_posts clearfix">
		<?php 
		
		next_post_link('<span class="alignright">%link &rarr;</span>'); 
		
		if(  get_post_type() == 'portfolio' &&  of_get_option('portfoliopagelink') != 'disable' )
		{
			if( of_get_option('portfoliopage' ) != '' )
			{
				if( get_post_meta( $post->ID, '_cmb_portfoliopage', true ) != '' )
				{
					$url 	= get_permalink( get_post_meta( $post->ID, '_cmb_portfoliopage', true ) );
					$title 	= get_the_title( get_post_meta( $post->ID, '_cmb_portfoliopage', true ) );				
				}
				else
				{
					$url 	= get_permalink( of_get_option('portfoliopage' ) );
					$title 	= get_the_title( of_get_option('portfoliopage' ) );
				}
				
				echo '<span class="portfolio-link"><a title="'. $title .'" href="'. $url .'"><i class="fa fa-th fa-lg"></i></a></span>';
			}
		}
		
		previous_post_link('<span class="alignleft">&larr; %link</span>'); 
		
		?>
	</div>

	<?php 
	// related posts
	$tags = wp_get_post_tags($post->ID);
	
	if( !empty($tags) ) 
	{ 
		$tag_ids = array();
		foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
                
		$args = array(
			'tag__in' => $tag_ids,
			'post__not_in' => array( $post->ID ),
			'posts_per_page' => 4, // Number of related posts that will be shown.
			'caller_get_posts' => 1,
			'orderby'=>'rand' // Randomize the posts
		);
            
		$related_query = new wp_query( $args );	
		
		if( $related_query->found_posts > 0 )
		{ ?>
            <div id="related_posts" class="row">
                <section class="columns twelve">
                <?php add_image_size( 'related-posts', 84, 84, true );
            
                if( $related_query->have_posts() ) 
                {
                    echo '<h3>'.__('Related Posts','themeva').'</h3>
                    <ul class="clearfix">';
                        while( $related_query->have_posts() )
                        {
                        $related_query->the_post(); ?>
                            <li class="columns four_column">
                                <a href="<?php the_permalink()?>" class="recent-posts-title" rel="bookmark" title="<?php the_title(); ?>">
									<?php the_title(); ?>
                                </a>
                                <a href="<?php the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>">
                                    <?php the_post_thumbnail( 'related-posts' ); ?>
                                </a>                                        
                            </li>
                        <?php 
                        }
                    echo '</ul>';
                } 
            
                wp_reset_query(); ?>
                
                </section>
            </div>
	<?php 
		}
	}

	// If a user has filled out their description and this is a multi-author blog, show a bio on their entries
	if ( get_the_author_meta( 'user_description' ) && $NV_authorname != 'disable' ) :  ?>
	<div class="author-info row">
		<aside id="author-avatar" class="columns two">
			<?php echo get_avatar( get_the_author_meta( 'user_email' ) ); ?>
		</aside><!-- #author-avatar -->    
	
		<section id="author-description" class="columns ten last clearfix">
			<h3><?php printf( esc_attr__( 'About %s', 'themeva' ), get_the_author() ); ?></h3>
            <span class="vcard author">
                <span class="fn">
                <p><?php the_author_meta( 'description' ); ?></p>
                </span>
            </span>
			<div id="author-link">
				<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
					<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'themeva' ), get_the_author() ); ?>
				</a>
			</div><!-- #author-link	-->
		</section><!-- #author-description -->
	</div>
	<?php endif;