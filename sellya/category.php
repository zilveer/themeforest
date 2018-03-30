<?php get_header(); ?>

<section id="midsection" class="container">
    <div class="row">
     <?php get_blogleftbar(); ?>
        <div class="span9" id="content">
            <div class="row-fluid">
                <div class="blog blog-one-column">
                    <?php if ( have_posts() ) : ?>
                        <header class="archive-header">
                            <h1 class="archive-title"><?php printf( __( '%s', 'sellya' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h1>
                            <?php if ( category_description() ) : // Show an optional category description ?>
                                <div class="archive-meta"><?php echo category_description(); ?></div>
                            <?php endif; ?>						
                        </header><!-- .archive-header -->					
                        <?php
                        /* Start the Loop */
                        while ( have_posts() ) : the_post(); 
                        
                            $arch_day = get_the_time('d');
                            
                            $arch_mon = get_the_time('m');
                            
                            $arch_year = get_the_time('Y');
                            
                            $day_link = get_day_link($arch_year,$arch_mon,$arch_day);
                        ?>
                            <div class="span12 span-first-child">
                        
                                <div class="span4 span-first-child">
                                    <a href="<?php the_permalink();?>" rel="bookmark" title="<?php the_title();?>">
                                        <?php the_post_thumbnail(array(211,211));?>
                                    </a>
                                </div><!--.image -->                           
                                <div class="span8">                            
                                    <h2 class="blog_title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
                                    <?php echo get_sellya_blog_short_text(get_the_content());?><br /><a class="readmore" href="<?php the_permalink()?>"><?php echo __('Read More&nbsp;<i class="icon-circle-arrow-right"></i>','sellya');?></a>
                                    <div class="postinfo">
                                        <div class="postinfo_left">
                                        <i class="icon-calendar"></i>&nbsp;<a href="<?php echo $day_link?>"><em><?php echo get_the_date();?></em></a>
                                        &nbsp;&nbsp;<i class="icon-tag"></i>&nbsp;<?php $cats = get_the_category(); 
                                            if(!empty($cats)):
                                            foreach($cats as $i=>$cat):
                                                
                                                if($i>0)
                                                    echo ',&nbsp;';
                                            
                                                echo "<a href='".get_category_link($cat->term_id)."'>$cat->name</a>";
                                            endforeach;
                                            endif;
                                        ?>
                                        &nbsp;<span class="comments_count"><?php comments_popup_link(__( '<i class="icon-comments"></i> No comments', 'sellya' ),__( '<i class="icon-comment-alt"></i> 1 comment', 'sellya' ),__( '<i class="icon-comments-alt"></i> % comments', 'sellya' ),'',__( '<i class="icon-lock"></i> Comments off', 'sellya' ))?></span>
                                        </div>
                                        
                                    </div>
                                </div> <!--.span8 -->
                                                    
                            </div>	<!--.span12 -->
                        
                        <?php endwhile; ?>
                        <div class="pagination">
                            <?php
                                global $wp_query;					
                                $big = 999999999; // need an unlikely integer					
                                echo paginate_links( array(
                                    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                                    'format' => '?paged=%#%',
                                    'current' => max( 1, get_query_var('paged') ),
                                    'total' => $wp_query->max_num_pages,
                                    'type' => 'list'
                                ) );
                            ?>
                        </div><!--.pagination -->
            
                    <?php else : ?>
                        <?php get_template_part( 'content', 'none' ); ?>
                    <?php endif; ?>
                </div><!--.blog -->
            </div><!--.row-fluid -->
        </div><!--#content -->
    </div><!--.row -->	
</section><!--#midsection -->

<?php get_footer(); ?>