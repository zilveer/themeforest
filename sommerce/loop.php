       				<div class="clear"></div>
                    <div class="posts group">
                    <?php      
						global $wp_query, $post, $more, $blog_type;
						
						if( !$blog_type) $blog_type = yiw_get_option('blog_type');
						
						$tmp_query = $wp_query;
						
						if (have_posts()) : 
                    
                    $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
                    <?php /* If this is a category archive */ if (is_category()) { ?>
                  <h2 class="red-normal"><?php printf(__('Archive for the &#8216;%s&#8217; Category', 'yiw'), single_cat_title('', false)); ?></h2>
                    <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
                  <h2 class="red-normal"><?php printf(__('Posts Tagged &#8216;%s&#8217;', 'yiw'), single_tag_title('', false) ); ?></h2>
                    <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
                  <h2 class="red-normal"><?php printf(__('Archive for %s | Daily archive page', 'yiw'), get_the_time(__('F jS, Y', 'yiw'))); ?></h2>
                    <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
                  <h2 class="red-normal"><?php printf(__('Archive for %s | Monthly archive page', 'yiw'), get_the_time(__('F Y', 'yiw'))); ?></h2>
                    <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
                  <h2 class="red-normal"><?php printf(__('Archive for %s | Yearly archive page', 'yiw'), get_the_time(__('Y', 'yiw'))); ?></h2>
                    <?php /* If this is a yearly archive */ } elseif (is_search()) { ?>
                  <h2 class="red-normal"><?php printf( __( 'Search Results for: %s', 'yiw' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
                   <?php /* If this is an author archive */ } elseif (is_author()) { ?>               
                  <h2 class="red-normal"><?php _e('Author Archive', 'yiw'); ?></h2>
                    <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
                  <h2 class="red-normal"><?php _e('Blog Archives', 'yiw'); ?></h2>        
                    <?php } else{ ?>
                  <div class="posts_space"></div>   
                    <?php }
                        
                        while (have_posts()) : the_post(); 
                        
                        if ( !is_single() ) 
							$more = 0;
                        
                        $title = is_null( the_title( '', '', false ) ) ? __( '(this post has no title)', 'yiw' ) : the_title( '', '', false );
                        
                    ?>        
                    
                    <div id="post-<?php the_ID(); ?>" <?php post_class('hentry-post group blog-' . $blog_type); ?>>
                        <?php if( has_post_thumbnail() ): ?>
                            <?php if($blog_type=='big'): ?>
                                <div class="post_header group">
                                    <?php the_post_thumbnail('blog_big') ?>
                                    <div class="post_title">
                                        <?php if ( is_single() ) : ?>
                                            <h2><?php echo $title ?></h2>
                                        <?php else : ?>
                                            <h2><a href="<?php the_permalink() ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'yiw' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php echo $title ?></a></h2>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                
                                <div class="post_content group">
                                    <div class="post_meta">
                                        <div class="post_date">
                                            <span class="day"><?php the_time('d') ?></span>
                                            <span class="month"><?php the_time('M'); ?></span>
                                            <span class="year"><?php the_time('Y'); ?></span>
                                        </div>
                                        <div class="post_comments"><?php comments_popup_link(__('No comments', 'yiw'), __('1 comment', 'yiw'), __('% comments', 'yiw')); ?></div>
                                        <div class="post_twitter"><a href="http://twitter.com?status=<?php echo urlencode(get_the_title() . " " . get_permalink()); ?>"><?php _e( 'Tweet this', 'yiw' ) ?></a></div>
                                        <div class="post_author"><?php _e( 'by', 'yiw' ) ?> <?php the_author_posts_link() ?></div>
                                    </div>
                                    
                                    <?php
                                        if ( is_archive() || is_search() )
                                            the_excerpt();
                                        else
                                            the_content(__( yiw_get_option('blog_read_more_text') )); 
                                    ?>
                                </div>
                            <?php else: ?>
                                <div class="post_content group">
                                    <div class="post_header">
                                        <?php the_post_thumbnail('blog_small'); ?>
                                        <div class="post_meta">
                                            <div class="post_date">
                                                <span class="day"><?php the_time('d') ?></span>
                                                <span class="month"><?php the_time('M'); ?></span>
                                                <span class="year"><?php the_time('Y'); ?></span>
                                            </div>
                                            <div class="post_comments"><?php comments_popup_link(__('No comments', 'yiw'), __('1 comment', 'yiw'), __('% comments', 'yiw')); ?></div>
                                            <div class="post_twitter"><a href="http://twitter.com?status=<?php echo urlencode(get_the_title() . " " . get_permalink()); ?>"><?php _e( 'Tweet this', 'yiw' ) ?></a></div>
                                            <div class="post_author"><?php _e( 'by', 'yiw' ) ?> <?php the_author_posts_link() ?></div>
                                        </div>
                                    </div>
                                    
                                    <div class="post_title">
                                        <?php if ( is_single() ) : ?>
                                            <h2><?php echo $title ?></h2>
                                        <?php else : ?>
                                            <h2><a href="<?php the_permalink() ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'yiw' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php echo $title ?></a></h2>
                                        <?php endif; ?>
                                    </div>
                                    <?php
                                        if ( is_archive() || is_search() )
                                            the_excerpt();
                                        else
                                            the_content(__( yiw_get_option('blog_read_more_text') ));
                                    ?>
                                </div>
                            <?php endif ?>
                            
                        <?php else: ?>
                                <div class="post_nothumb post_content group">
                                    <div class="post_meta">
                                        <div class="post_date">
                                            <span class="day"><?php the_time('d') ?></span>
                                            <span class="month"><?php the_time('M'); ?></span>
                                            <span class="year"><?php the_time('Y'); ?></span>
                                        </div>
                                        <div class="post_comments"><?php comments_popup_link(__('No comments', 'yiw'), __('1 comment', 'yiw'), __('% comments', 'yiw')); ?></div>
                                        <div class="post_twitter"><a href="http://twitter.com?status=<?php echo urlencode(get_the_title() . " " . get_permalink()); ?>"><?php _e( 'Tweet this', 'yiw' ) ?></a></div>
                                        <div class="post_author"><?php _e( 'by', 'yiw' ) ?> <?php the_author_posts_link() ?></div>
                                    </div>

                                    <div class="post_title">
                                        <?php if ( is_single() ) : ?>
                                            <h2><?php echo $title ?></h2>
                                        <?php else : ?>
                                            <h2><a href="<?php the_permalink() ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'yiw' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php echo $title ?></a></h2>
                                        <?php endif; ?>
                                    </div>
                                    <?php
                                        if ( is_archive() || is_search() )
                                            the_excerpt();
                                        else
                                            the_content(__( yiw_get_option('blog_read_more_text') ));
                                    ?>
                                </div>
                        <?php endif ?>
                        
                        <div class="post_ group">
                            <?php wp_link_pages(); ?>
    
                            <?php if( is_single() ) edit_post_link( __( 'Edit', 'yiw' ), '<span class="edit-link">', '</span>' ); ?>
    
                            <?php if( is_single() ) the_tags( '<p class="list-tags">Tags: ', ', ', '</p>' ) ?>
                        </div>
                    </div>          
                    
                    <?php 
						endwhile;
						
						else : ?>
						
							<div id="post-0" class="post error404 not-found group">
								<h1 class="entry-title"><?php _e( 'Not Found', 'yiw' ); ?></h1>
								<div class="entry-content">
									<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'yiw' ); ?></p>
									<?php get_search_form(); ?>
								</div><!-- .entry-content -->
							</div><!-- #post-0 -->
						
						<?php
						endif;
						 
						$wp_query = $tmp_query;
						wp_reset_postdata();
					?>    
                    </div>                       
                
                    <?php get_template_part( 'pagination' ) ?>       
        
                    <?php comments_template(); ?>