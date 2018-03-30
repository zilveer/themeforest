<?php global $smof_data; ?>

    <div class="footer-container">
        <div class="row">
            <div class="four columns first-column hide-for-small">
                <p class="footer-left">
                    <?php if (isset($smof_data['footer_description_one_text'])): ?>
                        <?php echo $smof_data['footer_description_one_text']; ?>
                    <?php endif ?>
                </p>
            </div>
            <div class="four columns middle-column back-to-top hide-for-small">
                <a href="#homepage"><img src="<?php echo get_template_directory_uri(); ?>/images/back-to-top.png" alt="Go Back To Top"></a>
            </div>
            <div class="four columns last-column mobile-four">
                <p class="footer-right"><a href="<?php if (isset($smof_data['footer_link_url'])): ?><?php echo $smof_data['footer_link_url']; ?><?php endif ?>" target="_blank">
                <?php if (isset($smof_data['footer_description_two_text'])): ?>
                        <?php echo $smof_data['footer_description_two_text']; ?>
                    <?php endif ?>
                </a></p>
            </div>
        </div>
    </div>

	<?php $args = array( 'post_type' => 'portfolios', 'posts_per_page' => 100 );
	$loop = new WP_Query( $args );
	while ( $loop->have_posts() ) : $loop->the_post(); ?>
	<?php $terms = get_the_terms($post->id,"project-type");
	$project_cats = NULL;
	if ( !empty($terms) ){ foreach ( $terms as $term ) { $project_cats .= strtolower($term->name) . ' '; } } ?>

    <!-- Pop Up Windows - Single Project With Photo -->
    <div id="<?php the_ID(); ?>" class="reveal-modal large">
        <div class="single-project-image-video">
            <?php if(has_post_thumbnail()) { the_post_thumbnail('portfolio-large'); }?>
        </div>
        <h3 class="single-project-title"><?php the_title(); ?></h3>
        <p class="single-project-details hide-for-small">
            <span>Published on</span> <?php the_time('F j') ?> by <?php the_author() ?>
            <span class="category">Category:</span> <?php echo $term->slug ?>
            <span class="tags">Tags:</span> <?php the_tags('', ', ', ''); ?>
        </p>
		<?php the_content(); ?>
    	<div class="single-project-share-buttons">
    		<div class="twelve columns">
    			<div class="facebook-share-button">
    				<div class="facebook-share-button-over">Like It Now</div>
    				<div class="facebook-share-button-inner">
    					<iframe src="//www.facebook.com/plugins/like.php?href=<?php the_permalink(); ?>&amp;send=false&amp;layout=button_count&amp;width=100&amp;show_faces=false&amp;font&amp;colorscheme=light&amp;action=like&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:21px;" allowTransparency="true"></iframe>
    				</div>
    			</div>
                <div class="twitter-tweet-button">
                	<div class="twitter-tweet-button-over">Tweet It</div>
                    <div class="twitter-tweet-button-inner">
                    	<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>" data-via="<?php global $smof_data; $dreamer_twitter_user_one = $smof_data['twitter_user_one']; echo $dreamer_twitter_user_one ?>" data-related="<?php global $smof_data; $dreamer_twitter_user_one = $smof_data['twitter_user_one']; echo $dreamer_twitter_user_one ?>">Tweet</a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                    </div>
                </div>
                <div class="linkedin-share-button">
                    <div class="linkedin-share-button-over">Share It</div>
                    <div class="linkedin-share-button-inner">
                    	<script src="//platform.linkedin.com/in.js" type="text/javascript"></script><script type="IN/Share" data-url="<?php the_permalink(); ?>" data-counter="right"></script>
                    </div>
                </div>
    		</div>
    	</div>
    	<a class="close-reveal-modal">&#215;</a>
    </div>

	<?php endwhile; ?>

	<?php wp_reset_query(); ?>

	<?php wp_footer(); ?>

</body>
</html>