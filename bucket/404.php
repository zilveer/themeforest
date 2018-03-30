<?php 
/**
 * The template for displaying 404 pages (Not Found).
 *
 */

get_header(); ?>

<div id="main" class="container container--main">

    <div class="grid">

        <div class="grid__item  two-thirds  palm-one-whole  content content--404">
			<div class="heading  heading--main">
				<h2 class="hN"><?php _e( 'Oops! That page can&rsquo;t be found.', 'bucket' ); ?></h2>
			</div>
			<p><?php printf( __( 'This may be because of a mistyped URL, faulty referral or out-of-date search engine listing.<br />You should try the <a href="%s">homepage</a> instead or maybe do a search?', 'bucket' ), home_url()); ?></p>
			<div class="search-form  search-form--404">
				<?php get_search_form(); ?>
			</div>
        </div><!--
        
     --><div class="grid__item  one-third  palm-one-whole  sidebar">
            <?php get_sidebar(); ?>
        </div>

    </div>
</div>
    
<?php get_footer(); ?>