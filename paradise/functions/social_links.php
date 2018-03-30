<?php
global $_theme_social_links;
$_theme_social_links = array(
	'audioboo' => __('audioboo', TEMPLATENAME),
	'bebo' => __('bebo', TEMPLATENAME),
	'behance' => __('behance', TEMPLATENAME),
	'blogger' => __('blogger', TEMPLATENAME),
	'buzz' => __('buzz', TEMPLATENAME),
	'creativecommons' => __('creativecommons', TEMPLATENAME),
	'dailybooth' => __('dailybooth', TEMPLATENAME),
	'delicious' => __('delicious', TEMPLATENAME),
	'designfloat' => __('designfloat', TEMPLATENAME),
	'deviantart' => __('deviantart', TEMPLATENAME),
	'digg' => __('digg', TEMPLATENAME),
	'dopplr' => __('dopplr', TEMPLATENAME),
	'dribbble' => __('dribbble', TEMPLATENAME),
	'email' => __('email', TEMPLATENAME),
	'ember' => __('ember', TEMPLATENAME),
	'facebook' => __('facebook', TEMPLATENAME),
	'flickr' => __('flickr', TEMPLATENAME),
	'forrst' => __('forrst', TEMPLATENAME),
	'friendfeed' => __('friendfeed', TEMPLATENAME),
	'google' => __('google', TEMPLATENAME),
	'gowalla' => __('gowalla', TEMPLATENAME),
	'grooveshark' => __('grooveshark', TEMPLATENAME),
	'hyves' => __('hyves', TEMPLATENAME),
	'lastfm' => __('lastfm', TEMPLATENAME),
	'linkedin' => __('linkedin', TEMPLATENAME),
	'livejournal' => __('livejournal', TEMPLATENAME),
	'lockerz' => __('lockerz', TEMPLATENAME),
	'megavideo' => __('megavideo', TEMPLATENAME),
	'myspace' => __('myspace', TEMPLATENAME),
	'piano' => __('piano', TEMPLATENAME),
	'playfire' => __('playfire', TEMPLATENAME),
	'playstation' => __('playstation', TEMPLATENAME),
	'reddit' => __('reddit', TEMPLATENAME),
	'rss' => __('rss', TEMPLATENAME),
	'skype' => __('skype', TEMPLATENAME),
	'socialvibe' => __('socialvibe', TEMPLATENAME),
	'soundcloud' => __('soundcloud', TEMPLATENAME),
	'spotify' => __('spotify', TEMPLATENAME),
	'steam' => __('steam', TEMPLATENAME),
	'stumbleupon' => __('stumbleupon', TEMPLATENAME),
	'technorati' => __('technorati', TEMPLATENAME),
	'tumblr' => __('tumblr', TEMPLATENAME),
	'twitpic' => __('twitpic', TEMPLATENAME),
	'twitter' => __('twitter', TEMPLATENAME),
	'typepad' => __('typepad', TEMPLATENAME),
	'vimeo' => __('vimeo', TEMPLATENAME),
	'wakoopa' => __('wakoopa', TEMPLATENAME),
	'wordpress' => __('wordpress', TEMPLATENAME),
	'xing' => __('xing', TEMPLATENAME),
	'yahoo' => __('yahoo', TEMPLATENAME),
	'youtube' => __('youtube', TEMPLATENAME),
);

function get_social_links() {
?>
		<!-- Start Social Icons -->
			<ul class="social">
			<?php
			global $_theme_social_links;
			foreach ($_theme_social_links as $key => $title):
				$link = get_option($key.'_social_link');
				if (!empty($link)):
			?>
			<li><a href="<?php echo $link; ?>" style="background: url(<?php echo get_bloginfo('template_url')."/images/social/{$key}.png"; ?>) no-repeat 0px 0px;" title="<?php echo ucfirst($title); ?>"></a></li>
			<?php
				endif;
			endforeach;
			?>
			</ul>
		<!-- End Social Icons -->
<?php
}
?>
