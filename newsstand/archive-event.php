<?php get_header(); ?>

<?php
	$get_date = getdate();
	$month_days = date("t");
	$current_month = $get_date['month'];
	$current_day = $get_date['mday'];
?>

	<br><br>

	<section class="boxed-content">
	    <div class="container">
	        <div class="row">

	            <div class="col-md-12 box-holder">
	                <div class="archive-events-holder">
	                	<?php $x = 1; while($x <= $month_days): ?>
	                	    <?php if ($x==$current_day): ?>
	                	        <div class="single current">
	                	    <?php else: ?>
	                	        <div class="single">
	                	    <?php endif ?>

	                	        <div class="date"><span><?php echo esc_html($x); ?></span>. <?php echo esc_html($current_month); ?></div>
	                	        <ul class="list">
	                	            <p class="emptyList"><?php echo _e('Nothing this day.', 'newsstand'); ?></p>
	                	            <?php
	                	                $args = array( 'post_type' => 'event', 'posts_per_page' => -1 );
	                	                $wp_query = new WP_Query( $args );
	                	            ?>

	                	            <?php if ($wp_query->have_posts()): ?>

	                	                <?php while($wp_query->have_posts()): $wp_query->the_post(); ?>
	                	                    <?php
	                	                        $date = get_post_meta(get_the_ID(), 'newsstand_event_date', 1, true);
	                	                        $date = explode('/', $date);
	                	                        if (isset($date[1]) && !empty($date[1])) {
	                	                            $date_day = $date[1];
	                	                        } else {
	                	                            $date_day = 0;
	                	                        }

	                	                    ?>
	                	                    <?php if ($x==$date_day): ?>
	                	                        <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
	                	                    <?php endif ?>
	                	                <?php endwhile; ?>

	                	            <?php endif ?>
	                	        </ul>

	                	    </div>
	                	<?php $x++; endwhile; ?>
	                </div>
	            </div>

	        </div>
	    </div>
	</section>

	<br>

<?php get_footer(); ?>