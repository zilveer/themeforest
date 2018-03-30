<?php get_header(); ?>

<!-- Main Content Starts HERE -->
<div class="page-container pattern-2" id="news">
	<div class="row">
		<div class="twelve columns news">
			<!-- News Item -->
			<div style="padding-top: 100px;" class="news-section">
			<?php while (have_posts()) : the_post(); ?>

				<div class="blog-format format-posts">
					<div <?php post_class(); ?>>
				    <h3 class="news-blog-title format-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				    <div class="twelve columns news-item paragraph-section item-news mobile-two">
				        <section class="news-cat-image format-cat-image">
				            <img src="<?php global $smof_data; $dreamer_news_image_post_icon = $smof_data['news_image_post_icon']; echo $dreamer_news_image_post_icon ?>" alt="News Image">
				        </section>
				        <?php if ( has_post_thumbnail() ) { the_post_thumbnail('format-large'); } ?>
				        <section style="height: auto; background-color: transparent;" class="news-details">
				            <div class="twelve columns">
				                <div class="twelve columns padding-left">
				                    <p class="news-content"><?php the_content(); ?></p>
				                </div>
				            </div>
				        </section>
				    </div>
				    <div class="single-project-share-buttons single-buttons-share">
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
				                        <script src="http://platform.linkedin.com/in.js" type="text/javascript"></script><script type="IN/Share" data-url="<?php the_permalink(); ?>" data-counter="right"></script>
				                    </div>
				                </div>
				            </div>
				        </div>
				    </div>
				    </div>
				</div>

            <?php endwhile; ?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>