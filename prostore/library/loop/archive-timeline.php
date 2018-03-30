<?php
/**
 * Theme Name: proStore
 * Theme URI: http://themeforest.net/user/gnrocks/portfolio
 * Theme demo : http://rchour.net/prostore
 * Description: A WordPress premium theme exclusively for sale on ThemeForest
 *
 * Author: gnrocks
 * Author URI: http://themeforest.net/user/gnrocks
 * License : http://codex.wordpress.org/GPL & http://wiki.envato.com/support/legal-terms/licensing-terms/
 *
 *
 * @package 	proStore/library/loop/archive-timeline.php
 * @file	 	1.0
 */
?>
<?php 
	$temp = $wp_query;
	$wp_query= null;
	$wp_query = new WP_Query();
	
	$args = array(
			'post_type'=>array('post'),
 			'posts_per_page'=>'-1',
			'post_status' => 'publish',
 			'orderby'=>'date',
 			'order'=>'DSC',
 			'ignore_sticky_posts' => 1,
 			);	
	$wp_query->query($args);						
?>			

<?php	
	$prev_year = "";	
	$prev_month = "";	
	$prev_day = "";
	$posts = array();
	
	while ($wp_query->have_posts()) : $wp_query->the_post();
		
		$year = get_the_time('Y');
		$month = get_the_time('F');
		$day = get_the_time('d');				
		
		if($year==$prev_year && $month == $prev_month && $day == $prev_day) {
			$posts[$prev_year][$prev_month][$prev_day][]=get_the_ID();
		} elseif($year==$prev_year && $month == $prev_month && $day != $prev_day) {
			$posts[$prev_year][$prev_month][$day][]=get_the_ID();							
		} elseif($year==$prev_year && $month != $prev_month && $day != $prev_day) {
			$posts[$prev_year][$month][$day][]=get_the_ID();									
		} elseif($year!=$prev_year && $month != $prev_month && $day != $prev_day) {
			$posts[$year][$month][$day][]=get_the_ID();									
		}
		
		$prev_year = $year;
		$prev_month = $month;
		$prev_day = $day;
	
	endwhile;
	
?>

<dl id="magellanTopNav" class="sub-nav clearfix" data-magellan-expedition="fixed" style="">
    <dt>Years</dt>
	<?php
		foreach ($posts as $year => $value) {
			echo '<dd data-magellan-arrival="'.$year.'"><a href="#'.$year.'">'.$year.'</a></dd>';
		}
	?>
</dl>		
  					
<?php
	
	echo '<div class="timeline clearfix" style="position:relative">';
	echo '<ul class="years" data-magellan-expedition>';
	foreach ($posts as $year => $value_first) {
		echo '<li data-magellan-destination="'.$year.'" id="'.$year.'"><h5><time datetime="'.$year.'" pubdate>'.$year.'</span></h5><ul class="months">';
			foreach ($value_first as $month => $value_second) {
				echo '<li><h6><em><time datetime="'.$month.'" pubdate>'.$month.'</time></em></h6><ul class="days">';
					foreach ($value_second as $day=>$value_third) {
						echo '<li><span class="label round secondary"><time datetime="'.$day.'" pubdate>'.$day.'</time></span><ul class="posts">';
							foreach ($value_third as $key=>$value_four) {
								echo '<li><a href="'.get_permalink($value_four).'" rel="bookmark" title="'.get_the_title($value_four).'">'.get_the_title($value_four).'</a></li>';
							}
						echo '</ul></li>';
					}
				echo '</ul></li>';
			}							
		echo '</ul></li>';
	}
	echo '</ul>';
	echo '</div>';
	
?>

<?php
	$wp_query = null; $wp_query = $temp;
	wp_reset_query();
?>
