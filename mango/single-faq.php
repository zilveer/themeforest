<?php
/**
 * FAQs Single Template
 * * @subpackage mango
 * @since Mango 1.0
 */

global $mango_settings, $args, $mango_layout_columns, $post;
$mango_layout_columns = mango_page_columns ();
$mango_class_name = mango_class_name ();
$containerClass = mango_main_container_class();
get_header (); ?>
    <div class="<?php echo esc_attr($containerClass); ?> main">
                <div class="row">
                    <div class="<?php echo esc_attr($mango_class_name); ?>">
                            <?php while ( have_posts () ) : the_post (); ?>
                        <article class="single faq">
                            <?php  if(has_post_thumbnail()){
                                get_template_part("content-thumbnail");
                            } ?>
                            <h2 class="entry-title"><?php the_title(); ?></h2>
                            <div class="entry-meta">
                                <?php  _e("Posted at",'mango') ?> <span class="entry-meta-date"><?php the_time('h:i A, j F Y') ?></span>
                                <?php $terms = get_the_terms(get_the_ID(), 'faq-category' );
                                if ( $terms && ! is_wp_error( $terms )) {
                                    $faq_tags = array();
                                    foreach ($terms as $term) {
                                        $term_link = get_term_link( $term );
                                        $faq_tags[] = "<a href='".esc_url($term_link)."'>".$term->name."</a>";
                                    }
                                }
                                ?> 
                                <?php if( !empty($faq_tags)){ ?>
                                    <span class="separator">/</span>
                                    <span class="entry-cats"><?php _e("Category",'mango')?>: <?php echo rtrim(implode(", ",$faq_tags),', '); ?></span>
                                <?php }
                                $label_text = get_post_meta ( get_the_ID(), 'mango_label_text', true ) ? get_post_meta ( $post->ID, 'mango_label_text', true ) : '';
                                $label_type = get_post_meta ( get_the_ID(), 'mango_label_type', true ) ? get_post_meta ( $post->ID, 'mango_label_type', true ) : '';
                                if($label_text && $label_type){ ?>
                                <span class="separator">/</span>
                                <span class="label label-<?php echo esc_attr($label_type) ?>"><?php echo esc_attr($label_text); ?></span>
                                <?php } ?>
                            </div><!-- End .entry-meta -->
                            <div class="entry-content">
                                <?php the_content(); ?>
                            </div><!-- End .entry-content -->
                            <?php mango_add_social_share() ?>
                        </article>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                    </div><!-- End .col-md-* -->
                    <div class="md-margin2x clearfix visible-sm visible-xs"></div><!-- space -->
                <?php  get_sidebar() ?>
                </div><!-- End .row -->
    </div><!-- End .container -->
        <div class="lg-margin hidden-xs hidden-sm"></div><!-- space -->
    </section><!-- End #content -->
<?php get_footer () ?>