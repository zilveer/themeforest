                    <div class="clear"></div>
                    <div class="posts">
                    <?php      
                        global $wp_query, $post, $more, $blog_type;
                        
                        $tmp_query = $wp_query;
                        
                        if (have_posts()) : 
                    
                    $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
                    <?php 
                        
                        while (have_posts()) : the_post(); 
                        
                        if ( !is_single() ) 
                            $more = 0;
                        
                        $title = is_null( the_title( '', '', false ) ) ? __( '(this post has no title)', 'yiw' ) : the_title( '', '', false );
                        $video = get_post_meta(get_the_ID(), '_portfolio_video', true);
                        
                        $date_format  = yiw_get_option('portfolio_date_format','F j, Y');
                        $skills_label = yiw_translate( get_post_meta(get_the_ID(), '_portfolio_skills_label', true) ? get_post_meta(get_the_ID(), '_portfolio_skills_label', true) : __('Skills', 'yiw') );
                        $skills       = yiw_translate( get_post_meta(get_the_ID(), '_portfolio_skills', true) );
                        $date_label   = yiw_translate( get_post_meta(get_the_ID(), '_portfolio_date_label', true) ? get_post_meta(get_the_ID(), '_portfolio_date_label', true) : __('Date', 'yiw') );        
                        $date         = yiw_translate( get_post_meta(get_the_ID(), '_portfolio_date', true) );
                    ?>        
                    
                    <div id="post-<?php the_ID(); ?>" <?php post_class('hentry-post group portfolio-post internal-post'); ?>>

                            <?php if($video): list( $type, $id ) = explode( ':', yiw_video_type_by_url( $video ) ); ?>
                                <div class="post_video <?php echo $type ?>">
                                    <?php echo do_shortcode( "[$type video_id=\"$id\" width=\"100%\" height=\"100%\"]" ); ?>
                                </div>
                            <?php else: ?>
                            <div class="post_header portfolio_header group">
                                <?php the_post_thumbnail('blog_big', array('class'=>'internal')) ?>
                                <h2><?php the_title() ?></h2>
                            </div>
                            <?php endif ?>
                            
                            <div class="post_content group">
                                
                                <div class="work-skillsdate">
                                    <?php if( $skills ): ?><p class="skills"><span class="label"><?php echo $skills_label ?>:</span> <?php echo $skills ?></p><?php endif ?>
                                    <?php if( $date ): ?><p class="workdate"><span class="label"><?php echo $date_label ?>: </span><?php echo $date ?></p><?php endif ?>
                                </div>
                                
                                <?php if($video): ?><h2><?php the_title() ?></h2><?php endif ?>
                                <?php the_content(__( yiw_get_option('blog_read_more_text') )); ?>
                            </div>
                            
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
                
                    <?php if( is_singular() ): ?>
                        <?php if(function_exists('yiw_pagination')) : yiw_pagination(); else : ?> 
                
                            <div class="navigation group">
                                <div class="alignleft"><?php next_posts_link(__('Next &raquo;', 'yiw')) ?></div>
                                <div class="alignright"><?php previous_posts_link(__('&laquo; Back', 'yiw')) ?></div>
                            </div>
                        
                        <?php endif; ?>
                    <?php endif; ?>
        
                    <?php //comments_template(); ?>
                    </div>