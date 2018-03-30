<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 7/4/2015
 * Time: 3:32 PM
 */
?>
<ul class="entry-meta">
    <li class="entry-meta-author">
        <i class="pe-7s-users p-color"></i> <?php printf('<a href="%1$s">%2$s</a>',esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),esc_html( get_the_author() )); ?>
    </li>

     <li class="entry-meta-date">
         <i class="pe-7s-clock p-color"></i> <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"> <?php echo  get_the_date(get_option('date_format'));?> </a>
     </li>

    <?php if (has_category()): ?>
        <li class="entry-meta-category">
            <i class="pe-7s-folder p-color"></i> <?php echo get_the_category_list(', '); ?>
        </li>
    <?php endif; ?>

    <?php if ( comments_open() || get_comments_number() ) : ?>
        <li class="entry-meta-comment">
            <?php comments_popup_link( wp_kses_post(__('<i class="pe-7s-comment p-color"></i> 0 Comment','g5plus-handmade')),wp_kses_post(__('<i class="pe-7s-comment p-color"></i> 1 Comment','g5plus-handmade')), wp_kses_post(__('<i class="pe-7s-comment p-color"></i> % Comments','g5plus-handmade'))); ?>
        </li>
    <?php endif; ?>
    <?php edit_post_link( esc_html__( 'Edit', 'g5plus-handmade' ), '<li class="edit-link"><i class="pe-7s-tools p-color"></i> ', '</li>' ); ?>
</ul>