<?php
/**
 * @package quote
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-4 col-xs-12 portfolio-item'); ?>>
	<header class="entry-header">
   		<div class="item-inner">
            <?php the_post_thumbnail( 'main-featured', array( 'class' => 'img-responsive' ) ); ?>
            <div class="overlay">
                <a class="preview lb btn btn-outlined btn-primary" href="<?php echo $feat_image; ?>" data-rel="prettyPhoto" title="<?php the_title(); ?>"><i class="fa fa-eye"></i></a>  
            	<a class="preview btn btn-outlined btn-primary" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><i class="fa fa-link"></i></a>              
            </div>        	    
        </div>
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
	</header><!-- .entry-header -->
</article><!-- #post-## -->