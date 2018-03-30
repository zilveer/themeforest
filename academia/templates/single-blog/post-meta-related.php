<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 7/9/2015
 * Time: 4:12 PM
 */
?>
<ul class="entry-meta s-font">
    <li class="entry-meta-date">
        <i class="fa fa-calendar"></i><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"> <?php echo  get_the_date("j M, Y");?> </a>
    </li>
    <li class="entry-meta-author">
        <i class="fa fa-user"></i><?php printf('<a href="%1$s">%2$s</a>',esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),esc_html( get_the_author() )); ?>
    </li>
    <?php edit_post_link( esc_html__( 'Edit', 'g5plus-academia' ), '<li class="edit-link">', '</li>' ); ?>
</ul>