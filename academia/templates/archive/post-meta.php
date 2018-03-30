<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 7/4/2015
 * Time: 3:32 PM
 */

$size = 'full';
$thumbnail = g5plus_post_thumbnail($size,$showDate);
?>
<ul class="entry-meta s-font">
    <li class="entry-meta-author">
        <i class="fa fa-user"></i>
        <?php printf('<a href="%1$s">%2$s</a>',esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),esc_html( get_the_author() )); ?>
    </li>

    <?php if ( comments_open() || get_comments_number() ) : ?>
        <li class="entry-meta-comment">
            <?php comments_popup_link(wp_kses_post(__('<i class="fa fa-comments"></i> 0','g5plus-academia')) ,
                wp_kses_post(__('<i class="fa fa-comments"></i> 1','g5plus-academia')),
                wp_kses_post(__('<i class="fa fa-comments"></i> %','g5plus-academia'))); ?>
        </li>
    <?php endif; ?>
    <li class="entry-meta-view">
        <i class="fa fa-eye"></i>
        <?php if (function_exists('g5plus_get_post_views') ):?>
            <?php echo g5plus_get_post_views(); ?>
        <?php endif; ?>
    </li>
    <?php if(empty($thumbnail)):?>
        <li class="entry-meta-date">
            <i class="fa fa-calendar"></i><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"> <?php echo  get_the_date("M j, Y");?> </a>
        </li>
    <?php endif;?>
    <?php edit_post_link(esc_html__( 'Edit', 'g5plus-academia' ), '<li class="edit-link">', '</li>' ); ?>
</ul>