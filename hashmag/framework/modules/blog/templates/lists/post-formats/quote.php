<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="mkdf-post-item" des>
        <div class="mkdf-post-item-inner">
            <div class="mkdf-post-content-holder">
                <div class="mkdf-post-title-holder">
                    <div class="mkdf-post-title">
                        <h2 class="mkdf-post-quote-text">"<?php the_title(); ?>"</h2>
                        <?php if((get_post_meta(get_the_ID(), "mkdf_post_quote_author_meta", true) != '')) { ?>
                            <span class="mkdf-post-quote-author">-<?php echo esc_html(get_post_meta(get_the_ID(), "mkdf_post_quote_author_meta", true)); ?></span>
                        <?php } ?>
                    </div>
                    <?php
                    hashmag_mikado_post_info_category(array(
                        'category' => $display_category
                    )); ?>
                    <?php if ($display_date == 'yes' || $display_author == 'yes' || $display_comments == 'yes' || $display_like == 'yes' || $display_share == 'yes') { ?>
                        <div class="mkdf-post-info-section">
                            <?php hashmag_mikado_post_info_author(array(
                                'author' => $display_author
                            )) ?>
                            <?php hashmag_mikado_post_info_date(array(
                                'date' => $display_date,
                                'date_format' => get_option('date_format')
                            )) ?>
                            <?php hashmag_mikado_post_info_comments(array(
                                'comments' => $display_comments
                            )) ?>
                            <?php hashmag_mikado_post_info_like(array(
                                'like' => $display_like
                            )); ?>
                            <?php hashmag_mikado_post_info_share(array(
                                'share' => $display_share
                            ));
                            ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="mkdf-post-excerpt-holder">
                    <?php hashmag_mikado_excerpt($excerpt_length); ?>
                </div>
                <div class="mkdf-post-read-more-holder">
                    <?php if ($display_read_more) { ?>
                        <?php hashmag_mikado_read_more_button(); ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php do_action('hashmag_mikado_before_blog_list_article_closed_tag'); ?>
</article>








