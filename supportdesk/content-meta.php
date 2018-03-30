<?php 
$st_post_meta = of_get_option('st_blog_meta' );
$number = get_comments_number(get_the_ID()); ?>
<?php if ( ($st_post_meta['date'] == 1) || ($st_post_meta['author'] == 1) || ($st_post_meta['category'] == 1) || ($st_post_meta['comments'] == 1) ) { ?>
<ul class="entry-meta clearfix">

<?php if ($st_post_meta['date'] == 1) { ?>
 <li class="date"> 
    <strong><?php _e( 'Posted: ', 'framework' ); ?></strong>
    <time datetime="<?php the_time('Y-m-d')?>"><?php the_time( get_option('date_format') ); ?></time>
    </li>
<?php } ?>

<?php if ($st_post_meta['author'] == 1) { ?>
<li class="author">
	<?php if ($st_post_meta['date'] == 1) { ?><span>/</span><?php } ?> 
    <strong><?php _e( 'By: ', 'framework' ); ?></strong>
	<?php the_author(); ?></li>
<?php } ?>


<?php if ( ($st_post_meta['category'] == 1) && (!in_category( '1' )) ) { ?>
<li class="category">
<?php if ($st_post_meta['author'] == 1) { ?><span>/</span><?php } ?> 
<strong><?php _e( 'In: ', 'framework' ); ?></strong>
<?php the_category('/ '); ?></li>
<?php } ?>

<?php if( ($st_post_meta['comments'] == 1) && ($number != 0)) { ?>
	<?php if ( comments_open() ){ ?>
	<?php if ($st_post_meta['category'] == 1) { ?><span>/</span><?php } ?>
    <strong><?php _e( 'Comments: ', 'framework' ); ?></strong>
	<?php comments_popup_link( __( '0', 'framework' ), __( '1', 'framework' ), __( '%', 'framework' ) ); ?><?php } ?>
<?php } ?>
</ul>
<?php } ?>