<?php
	
  Class cp_Author_box_red {

	public static function init() {
		global $wp_version;
		// cp Author Bio requires Wordpress 2.9 or grater
		if (version_compare($wp_version, "2.9", "<")) {
			return false;
		}
		self::addFilters();
		self::addActions();
		load_plugin_textdomain('cp-author-bio-div', false, dirname(plugin_basename(__FILE__ )));
		return true;
	}

	public static function filterContactMethods($contactmethods) {
		//add
		$contactmethods['twitter'] = 'Twitter';
		$contactmethods['facebook'] = 'Facebook';
		$contactmethods['lnkin'] = 'LinkedIn';
		$contactmethods['gplus'] = 'Google+';
		// remove
		unset($contactmethods['yim']);
		unset($contactmethods['aim']);
		return $contactmethods;
	}}
	
	add_filter('user_contactmethods', array('cp_Author_box_red', 'filterContactMethods'));    
	function cp_get_author_box(){
		$bab_auttxt2 = get_option('bab_auttxt2');
			$bab_showautbio = get_option('bab_showautbio');
			$bab_showautintro = get_option('bab_showautintro');
			$bab_showautgra = get_option('bab_showautgra');
			$author = array();
			$author['name'] = get_the_author();
			$author['twitter'] = get_the_author_meta('twitter');
			$author['facebook'] = get_the_author_meta('facebook');
			$author['gplus'] = get_the_author_meta('gplus');
			$author['posts'] = (int)get_the_author_posts();
			ob_start();
    echo "<div class='about-author-wrapper'>";
		 echo "<div class='about-author-avartar'>" . get_avatar( get_the_author_meta('ID'), 90 ) . "</div>";
						echo "<div class='about-author-info'>";
						echo "<div class='about-author-title cp-link-title cp-title'>" . __('About the Author','cp_front_end') . "</div>";
						echo get_the_author_meta('description');
						echo "</div>";?>
<?php $bab_showauttxt = get_option('bab_showauttxt');
		             	$bab_auttxt1 = get_option('bab_auttxt1');
			             ?>

                        <ul class="author_links">
                          <li class="first"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"> <?php printf( __( 'View all posts by %s','crunchpress' ), get_the_author() ); ?> </a></li>
                          <li class="blog"><a href="<?php echo get_the_author_meta('url'); ?>" title="<?php echo esc_attr(sprintf(__('Read %s&#8217;s blog', 'cp-author-bio-div'), $author['name'])); ?>"><?php echo __('Blog','crunchpress'); ?></a></li>
                          <?php if(!empty($author['twitter'])): ?>
                          <li class="twitter"><a href="<?php echo $author['twitter']; ?>" title="<?php echo esc_attr(sprintf(__('Follow %s on Twitter', 'cp-author-bio-div'), $author['name'])); ?>" rel="external">Twitter</a></li>
                          <?php endif; ?>
                          <?php if(!empty($author['facebook'])): ?>
                          <li class="facebook"><a href="<?php echo $author['facebook']; ?>" title="<?php echo esc_attr(sprintf(__('Be %s&#8217;s friend on Facebook', 'cp-author-bio-div'), $author['name'])); ?>" rel="external">Facebook</a></li>
                          <?php endif; ?>
                          <?php if(!empty($author['gplus'])): ?>
                          <li class="gplus"><a href="<?php echo $author['gplus']; ?>" rel="me" title="<?php echo esc_attr(sprintf(__('Add %s in your circle', 'cp-author-bio-div'), $author['name'])); ?>" rel="external">Google+</a></li>
                          <?php endif; ?>
                          <?php if(!empty($author['lknin'])): ?>
                          <li class="linkin"><a href="<?php echo $author['lnkin']; ?>"  title="<?php echo esc_attr(sprintf(__('Connect with %s', 'cp-author-bio-div'), $author['name'])); ?>" rel="external">LinkedIn</a></li>
                          <?php endif; ?>
                        </ul>

<?php echo "<div class='clear'></div>"; echo "</div>";} ?>