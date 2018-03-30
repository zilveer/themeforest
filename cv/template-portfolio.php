
<?php
	$mult = min(2, max(1, get_theme_option("retina_ready")));
	$portfolio_title = get_theme_option('portfolio_title');
	$args = array(
		'post_type' => 'portfolio',
		'post_status' => 'publish',
		'post_password' => '',
		'posts_per_page' => -1,	//max(3, get_theme_option('portfolio_ppp')),
		'orderby' => 'date',
		'order' => 'desc'
	);
	$query = new WP_Query($args); 
	$post_number = 0;
	$items_output = '';
	$cats_list = array();
	$ppp = max(3, get_theme_option('portfolio_ppp', 1));
 
	if ($query->have_posts()) {
?>
			<section id="portfolio" class="section portfolio_section odd">
				<div class="section_header portfolio_section_header">
					<h2 class="section_title portfolio_section_title"><a href="#"><span class="icon icon-briefcase"></span><span class="section_name"><?php echo $portfolio_title; ?></span></a><span class="section_icon"></span></h2>
				</div>
				<div class="section_body portfolio_section_body">
				<?php
				while ($query->have_posts()) {
					$query->the_post();
					$post_number++;
					$post_id = get_the_ID();
					$desc = '';
					if(has_excerpt($post_id)) {
						$desc = get_the_excerpt();
					}
					$post_link = get_permalink($post_id);
					$post_date = get_the_date();
					$post_title = getPostTitle($post_id, 50, '...');
					$post_text = getPostDescription();
					$post_thumb = getResizedImageTag($post_id, 252*$mult, 174*$mult); //get_ the_post_thumbnail($post_id, 'portfolio');
					$post_attachment = wp_get_attachment_url(get_post_thumbnail_id($post_id));
					$post_cats_list = getCategoriesByPostId($post_id, array('category_portfolio'));
					$post_cats = '';
					$post_classes = '';
					$post_content = '';
					if(get_theme_option('portfolio_excerpt')) {
						$post_content = getShortString(get_the_excerpt(), 100, '');
					}
					$sz = '';
                    $post_custom = get_post_custom($post_id);
                    $item_url = isset($post_custom["link_url"][0]) ? $post_custom["link_url"][0] : '';
					$rel = ' rel="prettyPhoto[pp_gal]"';
					if($item_url != '') {
						$post_attachment = $item_url;
						if(my_strpos($item_url, 'youtube.com') === false && my_strpos($item_url, 'vimeo.com') === false && my_strpos($item_url, '.swf') === false) {
							$rel = '';
						}
						$sz = '?width=auto&height=auto';
					}
					foreach ($post_cats_list as $cat) {
						$post_cats .= ($post_cats ? ', ' : '') . $cat['name'];
						$post_classes .= ($post_classes ? ' ' : '') . 'category_'.$cat['term_id'];
						$cats_list[$cat['term_id']] = $cat['name'];
					}
					$items_output .= '
						<article class="post portfolio_post portfolio_post_' . $post_number . ($post_number==1 ? ' first' : '') . ($post_number%2==1 ? ' even' : ' odd') . ' ' .$post_classes . '" style="z-index: ' . (999-$post_number) . '">
							<div class="post_pic portfolio_post_pic">
								<a href="' . $post_attachment.$sz . '" class="w_hover img-link img-wrap"'.$rel.' target="_blank" title="'.$desc.'">
									<span class="overlay"></span>
									<span class="link-icon"></span>
									' . $post_thumb . '
								</a>
							</div>
							<h4 class="post_title">' . $post_title . '</h4>
							<h5 class="post_subtitle">' . $post_cats . '</h5>';
					if($post_content) {							
					$items_output .='		
						<div class="post_content"><a href="'.$post_link.'">'.$post_content.'<span class="arr">&rarr;</span></a></div>';
					}								
					$items_output .='		
						</article>
						';
				} // while (have_posts)
	
				if ($items_output) {
				?>
                	<div class="portfolio_wrapper">
                        	<?php
							$iso_selector = '';
							if (count($cats_list) > 0) {
								foreach ($cats_list as $slug=>$name) {
									$iso_selector .= '<li><a href="#" data-filter=".category_' . $slug . '">' . $name . '</a></li>';
								}
							}
							wp_enqueue_script( 'isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array('jquery'), '1.5.25', true );
							?>
							<ul id="portfolio_iso_filters">
								<li><a href="#" data-filter="*" class="current">All</a></li>
								<?php echo $iso_selector; ?>
							</ul>
							<script>
								var ppp = <?php echo $ppp; ?>;
							</script>
	                	<div class="portfolio_items">
                        	<?php echo $items_output; ?>
                        </div>
						<div class="portfolio_iso_pages">
							<ul id="portfolio_iso_pages">
							</ul>
							<div id="portfolio_iso_pages_2">
								Page <span id="portfolio_iso_pages_current">1</span> of <span id="portfolio_iso_pages_total"></span>
							</div>
						</div>
                    </div>
<?php
				} // if (items_output)
?>
				</div> <!-- .section_body -->
			</section> <!-- #portfolio -->

<?php
	} // if (have_posts)
?>