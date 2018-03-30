<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/4/15
 * Time: 11:33 AM
 */
?>
<?php if (is_home() && current_user_can('publish_posts')) : ?>

    <p><?php printf(wp_kses_post(__('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'g5plus-handmade')), admin_url('post-new.php')); ?></p>

<?php elseif (is_search()) : ?>

    <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with different keywords.', 'g5plus-handmade'); ?></p>
    <?php get_search_form(); ?>

<?php
else : ?>
    <p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'g5plus-handmade'); ?></p>
    <?php get_search_form(); ?>
<?php endif; ?>