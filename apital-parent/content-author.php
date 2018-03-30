<?php
$author_description = get_the_author_meta('description');
if((!empty($author_description))): ?>
    <div>
        <div class="tittle-line">
            <h5><?php _e('about the author','fw');?></h5>
            <div class="divider-1 small">
                <div class="divider-small"></div>
            </div>
        </div>
        <div class="w-clearfix">
            <div class="blog-author"><?php echo get_avatar( get_the_author_meta( 'ID' ), '100' ); ?></div>
            <div class="author-wrapper">
                <p><?php echo esc_html($author_description);?></p>
            </div>
        </div>
    </div>
    <div class="divider-space less-space">
        <div class="divider-1-pattern"></div>
    </div>
<?php endif; ?>