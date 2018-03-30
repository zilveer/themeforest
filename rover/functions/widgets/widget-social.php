<?php
/*
 * @package by Theme Record
 * @auther: MattMao
*/

class theme_widget_social extends WP_Widget 
{
	public $widget_cssclass;
	public $widget_description;
	public $widget_id;
	public $widget_name;

	#
	#Constructor
	#
	public function __construct() {

		/* Widget variable settings. */
		$this->widget_cssclass      = 'widget-social';
		$this->widget_description   = __('This widget will display a social section.', 'TR');
		$this->widget_id            = THEME_SLUG. '_social';
		$this->widget_name          = sprintf( __( '%1$s %2$s', 'TR' ), THEME_NAME, __( '&raquo; Social', 'TR' ) );

		$widget_ops = array( 
			'classname'   => $this->widget_cssclass, 
			'description' => $this->widget_description 
		);
		parent::__construct( $this->widget_id, $this->widget_name, $widget_ops );
	}


	#
	#Form
	#
	function form($instance) 
	{
		$instance = wp_parse_args((array) $instance, array( 
			'title' => 'Social',
			'size' => '16px',
			's500px' => 'http://500px.com/username',
			'AddThis' => 'http://www.addthis.com',
			'Behance' => 'http://www.behance.net/username',
			'Blogger' => 'http://username.blogspot.com',
			'Mail' => 'mailto:user@name.com',
			'Delicious' => 'http://delicious.com/username',
			'DeviantART' => 'http://username.deviantart.com/',
			'Digg' => 'http://digg.com/username',
			'Dopplr' => 'http://www.dopplr.com/traveller/username',
			'Dribbble' => 'http://dribbble.com/username',
			'Evernote' => 'http://www.evernote.com',
			'Facebook' => 'http://www.facebook.com/username',
			'Flickr' => 'http://www.flickr.com/photos/username',
			'Forrst' => 'http://forrst.me/username',
			'GitHub' => 'https://github.com/username',
			'Google' => 'http://plus.google.com/userID',
			'Grooveshark' => 'http://grooveshark.com/username',
			'Instagram' => 'http://instagr.am/p/picID',
			'Lastfm' => 'http://www.last.fm/user/username',
			'LinkedIn' => 'http://www.linkedin.com/in/username',
			'MySpace' => 'http://www.myspace.com/userID',
			'Path' => 'https://path.com/p/picID',
			'PayPal' => 'email@address',
			'Picasa' => 'https://picasaweb.google.com/userID',
			'Posterous' => 'http://username.posterous.com',
			'Reddit' => 'http://www.reddit.com/user/username',
			'RSS' => 'http://example.com/feed',
			'ShareThis' => 'http://sharethis.com',
			'Skype' => 'skype:username',
			'Soundcloud' => 'http://soundcloud.com/username',
			'Spotify' => 'http://open.spotify.com/user/username',
			'StumbleUpon' => 'http://www.stumbleupon.com/stumbler/username',
			'Tumblr' => 'http://username.tumblr.com',
			'Twitter' => 'http://twitter.com/username',
			'Viddler' => 'http://www.viddler.com/explore/username',
			'Vimeo' => 'http://vimeo.com/username',
			'Virb' => 'http://username.virb.com',
			'Windows' => 'http://www.apple.com',
			'WordPress' => 'http://username.wordpress.com',
			'YouTube' => 'http://www.youtube.com/user/username',
			'Zerply' => 'http://zerply.com/username'
		));
		$title = strip_tags($instance['title']);
		$size = strip_tags($instance['size']);
		$s500px = stripslashes($instance['s500px']);
		$AddThis = stripslashes($instance['AddThis']);
		$Behance = stripslashes($instance['Behance']);
		$Blogger = stripslashes($instance['Blogger']);
		$Mail = stripslashes($instance['Mail']);
		$Delicious = stripslashes($instance['Delicious']);
		$DeviantART = stripslashes($instance['DeviantART']);
		$Digg = stripslashes($instance['Digg']);
		$Dopplr = stripslashes($instance['Dopplr']);
		$Dribbble = stripslashes($instance['Dribbble']);
		$Evernote = stripslashes($instance['Evernote']);
		$Facebook = stripslashes($instance['Facebook']);
		$Flickr = stripslashes($instance['Flickr']);
		$Forrst = stripslashes($instance['Forrst']);
		$GitHub = stripslashes($instance['GitHub']);
		$Google = stripslashes($instance['Google']);
		$Grooveshark = stripslashes($instance['Grooveshark']);
		$Instagram = stripslashes($instance['Instagram']);
		$Lastfm = stripslashes($instance['Lastfm']);
		$LinkedIn = stripslashes($instance['LinkedIn']);
		$MySpace = stripslashes($instance['MySpace']);
		$Path = stripslashes($instance['Path']);
		$PayPal = stripslashes($instance['PayPal']);
		$Picasa = stripslashes($instance['Picasa']);
		$Posterous = stripslashes($instance['Posterous']);
		$Reddit = stripslashes($instance['Reddit']);
		$RSS = stripslashes($instance['RSS']);
		$ShareThis = stripslashes($instance['ShareThis']);
		$Skype = stripslashes($instance['Skype']);
		$Soundcloud = stripslashes($instance['Soundcloud']);
		$Spotify = stripslashes($instance['Spotify']);
		$StumbleUpon = stripslashes($instance['StumbleUpon']);
		$Tumblr = stripslashes($instance['Tumblr']);
		$Twitter = stripslashes($instance['Twitter']);
		$Viddler = stripslashes($instance['Viddler']);
		$Vimeo = stripslashes($instance['Vimeo']);
		$Virb = stripslashes($instance['Virb']);
		$Windows = stripslashes($instance['Windows']);
		$WordPress = stripslashes($instance['WordPress']);
		$YouTube = stripslashes($instance['YouTube']);
		$Zerply = stripslashes($instance['Zerply']);
		?>
		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:','TR'); ?></label>
			<input  id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</div>

		<div class="theme-widget-wrap">
		<label for="<?php echo $this->get_field_id( 'size' ); ?>"><?php _e('Size:','TR'); ?></label>
		<select name="<?php echo $this->get_field_name('size'); ?>">
			<option value="16px" <?php selected('16px', $size); ?>><?php _e('16px','TR'); ?></option>
			<option value="32px" <?php selected('32px', $size); ?>><?php _e('32px','TR'); ?></option>
		</select>
		</div>

		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 's500px' ); ?>"><?php _e('500px:','TR'); ?></label>
			<input  id="<?php echo $this->get_field_id( 's500px' ); ?>" name="<?php echo $this->get_field_name( 's500px' ); ?>" type="text" value="<?php echo esc_attr( $s500px ); ?>" />
		</div>

		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 'AddThis' ); ?>"><?php _e('AddThis:','TR'); ?></label>
			<input  id="<?php echo $this->get_field_id( 'AddThis' ); ?>" name="<?php echo $this->get_field_name( 'AddThis' ); ?>" type="text" value="<?php echo esc_attr( $AddThis ); ?>" />
		</div>

		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 'Behance' ); ?>"><?php _e('Behance:','TR'); ?></label>
			<input  id="<?php echo $this->get_field_id( 'Behance' ); ?>" name="<?php echo $this->get_field_name( 'Behance' ); ?>" type="text" value="<?php echo esc_attr( $Behance ); ?>" />
		</div>

		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 'Blogger' ); ?>"><?php _e('Blogger:','TR'); ?></label>
			<input  id="<?php echo $this->get_field_id( 'Blogger' ); ?>" name="<?php echo $this->get_field_name( 'Blogger' ); ?>" type="text" value="<?php echo esc_attr( $Blogger ); ?>" />
		</div>

		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 'Mail' ); ?>"><?php _e('Mail:','TR'); ?></label>
			<input  id="<?php echo $this->get_field_id( 'Mail' ); ?>" name="<?php echo $this->get_field_name( 'Mail' ); ?>" type="text" value="<?php echo esc_attr( $Mail ); ?>" />
		</div>

		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 'Delicious' ); ?>"><?php _e('Delicious:','TR'); ?></label>
			<input  id="<?php echo $this->get_field_id( 'Delicious' ); ?>" name="<?php echo $this->get_field_name( 'Delicious' ); ?>" type="text" value="<?php echo esc_attr( $Delicious ); ?>" />
		</div>

		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 'DeviantART' ); ?>"><?php _e('DeviantART:','TR'); ?></label>
			<input  id="<?php echo $this->get_field_id( 'DeviantART' ); ?>" name="<?php echo $this->get_field_name( 'DeviantART' ); ?>" type="text" value="<?php echo esc_attr( $DeviantART ); ?>" />
		</div>

		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 'Digg' ); ?>"><?php _e('Digg:','TR'); ?></label>
			<input  id="<?php echo $this->get_field_id( 'Digg' ); ?>" name="<?php echo $this->get_field_name( 'Digg' ); ?>" type="text" value="<?php echo esc_attr( $Digg ); ?>" />
		</div>

		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 'Dopplr' ); ?>"><?php _e('Dopplr:','TR'); ?></label>
			<input  id="<?php echo $this->get_field_id( 'Dopplr' ); ?>" name="<?php echo $this->get_field_name( 'Dopplr' ); ?>" type="text" value="<?php echo esc_attr( $Dopplr ); ?>" />
		</div>

		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 'Dribbble' ); ?>"><?php _e('Dribbble:','TR'); ?></label>
			<input  id="<?php echo $this->get_field_id( 'Dribbble' ); ?>" name="<?php echo $this->get_field_name( 'Dribbble' ); ?>" type="text" value="<?php echo esc_attr( $Dribbble ); ?>" />
		</div>

		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 'Evernote' ); ?>"><?php _e('Evernote:','TR'); ?></label>
			<input  id="<?php echo $this->get_field_id( 'Evernote' ); ?>" name="<?php echo $this->get_field_name( 'Evernote' ); ?>" type="text" value="<?php echo esc_attr( $Evernote ); ?>" />
		</div>

		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 'Facebook' ); ?>"><?php _e('Facebook:','TR'); ?></label>
			<input  id="<?php echo $this->get_field_id( 'Facebook' ); ?>" name="<?php echo $this->get_field_name( 'Facebook' ); ?>" type="text" value="<?php echo esc_attr( $Facebook ); ?>" />
		</div>

		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 'Flickr' ); ?>"><?php _e('Flickr:','TR'); ?></label>
			<input  id="<?php echo $this->get_field_id( 'Flickr' ); ?>" name="<?php echo $this->get_field_name( 'Flickr' ); ?>" type="text" value="<?php echo esc_attr( $Flickr ); ?>" />
		</div>

		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 'Forrst' ); ?>"><?php _e('Forrst:','TR'); ?></label>
			<input  id="<?php echo $this->get_field_id( 'Forrst' ); ?>" name="<?php echo $this->get_field_name( 'Forrst' ); ?>" type="text" value="<?php echo esc_attr( $Forrst ); ?>" />
		</div>

		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 'GitHub' ); ?>"><?php _e('GitHub:','TR'); ?></label>
			<input  id="<?php echo $this->get_field_id( 'GitHub' ); ?>" name="<?php echo $this->get_field_name( 'GitHub' ); ?>" type="text" value="<?php echo esc_attr( $GitHub ); ?>" />
		</div>

		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 'Google' ); ?>"><?php _e('Google:','TR'); ?></label>
			<input  id="<?php echo $this->get_field_id( 'Google' ); ?>" name="<?php echo $this->get_field_name( 'Google' ); ?>" type="text" value="<?php echo esc_attr( $Google ); ?>" />
		</div>

		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 'Grooveshark' ); ?>"><?php _e('Grooveshark:','TR'); ?></label>
			<input  id="<?php echo $this->get_field_id( 'Grooveshark' ); ?>" name="<?php echo $this->get_field_name( 'Grooveshark' ); ?>" type="text" value="<?php echo esc_attr( $Grooveshark ); ?>" />
		</div>

		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 'Instagram' ); ?>"><?php _e('Instagram:','TR'); ?></label>
			<input  id="<?php echo $this->get_field_id( 'Instagram' ); ?>" name="<?php echo $this->get_field_name( 'Instagram' ); ?>" type="text" value="<?php echo esc_attr( $Instagram ); ?>" />
		</div>

		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 'Lastfm' ); ?>"><?php _e('Lastfm:','TR'); ?></label>
			<input  id="<?php echo $this->get_field_id( 'Lastfm' ); ?>" name="<?php echo $this->get_field_name( 'Lastfm' ); ?>" type="text" value="<?php echo esc_attr( $Lastfm ); ?>" />
		</div>

		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 'LinkedIn' ); ?>"><?php _e('LinkedIn:','TR'); ?></label>
			<input  id="<?php echo $this->get_field_id( 'LinkedIn' ); ?>" name="<?php echo $this->get_field_name( 'LinkedIn' ); ?>" type="text" value="<?php echo esc_attr( $LinkedIn ); ?>" />
		</div>

		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 'MySpace' ); ?>"><?php _e('MySpace:','TR'); ?></label>
			<input  id="<?php echo $this->get_field_id( 'MySpace' ); ?>" name="<?php echo $this->get_field_name( 'MySpace' ); ?>" type="text" value="<?php echo esc_attr( $MySpace ); ?>" />
		</div>

		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 'Path' ); ?>"><?php _e('Path:','TR'); ?></label>
			<input  id="<?php echo $this->get_field_id( 'Path' ); ?>" name="<?php echo $this->get_field_name( 'Path' ); ?>" type="text" value="<?php echo esc_attr( $Path ); ?>" />
		</div>

		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 'PayPal' ); ?>"><?php _e('PayPal:','TR'); ?></label>
			<input  id="<?php echo $this->get_field_id( 'PayPal' ); ?>" name="<?php echo $this->get_field_name( 'PayPal' ); ?>" type="text" value="<?php echo esc_attr( $PayPal ); ?>" />
		</div>

		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 'Picasa' ); ?>"><?php _e('Picasa:','TR'); ?></label>
			<input  id="<?php echo $this->get_field_id( 'Picasa' ); ?>" name="<?php echo $this->get_field_name( 'Picasa' ); ?>" type="text" value="<?php echo esc_attr( $Picasa ); ?>" />
		</div>

		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 'Posterous' ); ?>"><?php _e('Posterous:','TR'); ?></label>
			<input  id="<?php echo $this->get_field_id( 'Posterous' ); ?>" name="<?php echo $this->get_field_name( 'Posterous' ); ?>" type="text" value="<?php echo esc_attr( $Posterous ); ?>" />
		</div>

		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 'Reddit' ); ?>"><?php _e('Reddit:','TR'); ?></label>
			<input  id="<?php echo $this->get_field_id( 'Reddit' ); ?>" name="<?php echo $this->get_field_name( 'Reddit' ); ?>" type="text" value="<?php echo esc_attr( $Reddit ); ?>" />
		</div>

		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 'RSS' ); ?>"><?php _e('RSS:','TR'); ?></label>
			<input  id="<?php echo $this->get_field_id( 'RSS' ); ?>" name="<?php echo $this->get_field_name( 'RSS' ); ?>" type="text" value="<?php echo esc_attr( $RSS ); ?>" />
		</div>

		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 'ShareThis' ); ?>"><?php _e('ShareThis:','TR'); ?></label>
			<input  id="<?php echo $this->get_field_id( 'ShareThis' ); ?>" name="<?php echo $this->get_field_name( 'ShareThis' ); ?>" type="text" value="<?php echo esc_attr( $ShareThis ); ?>" />
		</div>

		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 'Skype' ); ?>"><?php _e('Skype:','TR'); ?></label>
			<input  id="<?php echo $this->get_field_id( 'Skype' ); ?>" name="<?php echo $this->get_field_name( 'Skype' ); ?>" type="text" value="<?php echo esc_attr( $Skype ); ?>" />
		</div>

		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 'Soundcloud' ); ?>"><?php _e('Soundcloud:','TR'); ?></label>
			<input  id="<?php echo $this->get_field_id( 'Soundcloud' ); ?>" name="<?php echo $this->get_field_name( 'Soundcloud' ); ?>" type="text" value="<?php echo esc_attr( $Soundcloud ); ?>" />
		</div>

		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 'Spotify' ); ?>"><?php _e('Spotify:','TR'); ?></label>
			<input  id="<?php echo $this->get_field_id( 'Spotify' ); ?>" name="<?php echo $this->get_field_name( 'Spotify' ); ?>" type="text" value="<?php echo esc_attr( $Spotify ); ?>" />
		</div>

		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 'StumbleUpon' ); ?>"><?php _e('StumbleUpon:','TR'); ?></label>
			<input  id="<?php echo $this->get_field_id( 'StumbleUpon' ); ?>" name="<?php echo $this->get_field_name( 'StumbleUpon' ); ?>" type="text" value="<?php echo esc_attr( $StumbleUpon ); ?>" />
		</div>

		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 'Tumblr' ); ?>"><?php _e('Tumblr:','TR'); ?></label>
			<input  id="<?php echo $this->get_field_id( 'Tumblr' ); ?>" name="<?php echo $this->get_field_name( 'Tumblr' ); ?>" type="text" value="<?php echo esc_attr( $Tumblr ); ?>" />
		</div>

		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 'Twitter' ); ?>"><?php _e('Twitter:','TR'); ?></label>
			<input  id="<?php echo $this->get_field_id( 'Twitter' ); ?>" name="<?php echo $this->get_field_name( 'Twitter' ); ?>" type="text" value="<?php echo esc_attr( $Twitter ); ?>" />
		</div>

		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 'Viddler' ); ?>"><?php _e('Viddler:','TR'); ?></label>
			<input  id="<?php echo $this->get_field_id( 'Viddler' ); ?>" name="<?php echo $this->get_field_name( 'Viddler' ); ?>" type="text" value="<?php echo esc_attr( $Viddler ); ?>" />
		</div>

		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 'Vimeo' ); ?>"><?php _e('Vimeo:','TR'); ?></label>
			<input  id="<?php echo $this->get_field_id( 'Vimeo' ); ?>" name="<?php echo $this->get_field_name( 'Vimeo' ); ?>" type="text" value="<?php echo esc_attr( $Vimeo ); ?>" />
		</div>

		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 'Virb' ); ?>"><?php _e('Virb:','TR'); ?></label>
			<input  id="<?php echo $this->get_field_id( 'Virb' ); ?>" name="<?php echo $this->get_field_name( 'Virb' ); ?>" type="text" value="<?php echo esc_attr( $Virb ); ?>" />
		</div>

		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 'Windows' ); ?>"><?php _e('Windows:','TR'); ?></label>
			<input  id="<?php echo $this->get_field_id( 'Windows' ); ?>" name="<?php echo $this->get_field_name( 'Windows' ); ?>" type="text" value="<?php echo esc_attr( $Windows ); ?>" />
		</div>

		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 'WordPress' ); ?>"><?php _e('WordPress:','TR'); ?></label>
			<input  id="<?php echo $this->get_field_id( 'WordPress' ); ?>" name="<?php echo $this->get_field_name( 'WordPress' ); ?>" type="text" value="<?php echo esc_attr( $WordPress ); ?>" />
		</div>

		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 'YouTube' ); ?>"><?php _e('YouTube:','TR'); ?></label>
			<input  id="<?php echo $this->get_field_id( 'YouTube' ); ?>" name="<?php echo $this->get_field_name( 'YouTube' ); ?>" type="text" value="<?php echo esc_attr( $YouTube ); ?>" />
		</div>

		<div class="theme-widget-wrap">
			<label for="<?php echo $this->get_field_id( 'Zerply' ); ?>"><?php _e('Zerply:','TR'); ?></label>
			<input  id="<?php echo $this->get_field_id( 'Zerply' ); ?>" name="<?php echo $this->get_field_name( 'Zerply' ); ?>" type="text" value="<?php echo esc_attr( $Zerply ); ?>" />
		</div>

		<?php
	}	


	#
	#Update & save the widget
	#
	function update($new_instance, $old_instance) 
	{
		$instance = $old_instance;	
		foreach($new_instance as $key=>$value)
		{
			$instance[$key]	= stripslashes($new_instance[$key]);
		}
		return $instance;
	}


	#
	#Prints the widget
	#
	function widget($args, $instance) 
	{
		extract($args, EXTR_SKIP);
		$title = $instance['title'];
		$size = $instance['size'];
		$s500px = $instance['s500px'];
		$AddThis = $instance['AddThis'];
		$Behance = $instance['Behance'];
		$Blogger = $instance['Blogger'];
		$Mail = $instance['Mail'];
		$Delicious = $instance['Delicious'];
		$DeviantART = $instance['DeviantART'];
		$Digg = $instance['Digg'];
		$Dopplr = $instance['Dopplr'];
		$Dribbble = $instance['Dribbble'];
		$Evernote = $instance['Evernote'];
		$Facebook = $instance['Facebook'];
		$Flickr = $instance['Flickr'];
		$Forrst = $instance['Forrst'];
		$GitHub = $instance['GitHub'];
		$Google = $instance['Google'];
		$Grooveshark = $instance['Grooveshark'];
		$Instagram = $instance['Instagram'];
		$Lastfm = $instance['Lastfm'];
		$LinkedIn = $instance['LinkedIn'];
		$MySpace = $instance['MySpace'];
		$Path = $instance['Path'];
		$PayPal = $instance['PayPal'];
		$Picasa = $instance['Picasa'];
		$Posterous = $instance['Posterous'];
		$Reddit = $instance['Reddit'];
		$RSS = $instance['RSS'];
		$ShareThis = $instance['ShareThis'];
		$Skype = $instance['Skype'];
		$Soundcloud = $instance['Soundcloud'];
		$Spotify = $instance['Spotify'];
		$StumbleUpon = $instance['StumbleUpon'];
		$Tumblr = $instance['Tumblr'];
		$Twitter = $instance['Twitter'];
		$Viddler = $instance['Viddler'];
		$Vimeo = $instance['Vimeo'];
		$Virb = $instance['Virb'];
		$Windows = $instance['Windows'];
		$WordPress = $instance['WordPress'];
		$YouTube = $instance['YouTube'];
		$Zerply = $instance['Zerply'];
	?>
	<?php echo $before_widget; ?>
	<?php echo $before_title . $title . $after_title; ?>
	<ul class="clearfix">

	<?php if($s500px) { echo '<li><a href="'.$s500px.'" rel="external"><img src="'.ASSETS_URI.'/images/medias/'.$size.'/500px.png" /></a></li>'; } ?>
	<?php if($AddThis) { echo '<li><a href="'.$AddThis.'" rel="external"><img src="'.ASSETS_URI.'/images/medias/'.$size.'/AddThis.png" /></a></li>'; } ?>
	<?php if($Behance) { echo '<li><a href="'.$Behance.'" rel="external"><img src="'.ASSETS_URI.'/images/medias/'.$size.'/Behance.png" /></a></li>'; } ?>
	<?php if($Blogger) { echo '<li><a href="'.$Blogger.'" rel="external"><img src="'.ASSETS_URI.'/images/medias/'.$size.'/Blogger.png" /></a></li>'; } ?>
	<?php if($Mail) { echo '<li><a href="'.$Mail.'" rel="external"><img src="'.ASSETS_URI.'/images/medias/'.$size.'/Mail.png" /></a></li>'; } ?>
	<?php if($Delicious) { echo '<li><a href="'.$Delicious.'" rel="external"><img src="'.ASSETS_URI.'/images/medias/'.$size.'/Delicious.png" /></a></li>'; } ?>
	<?php if($DeviantART) { echo '<li><a href="'.$DeviantART.'" rel="external"><img src="'.ASSETS_URI.'/images/medias/'.$size.'/DeviantART.png" /></a></li>'; } ?>
	<?php if($Digg) { echo '<li><a href="'.$Digg.'" rel="external"><img src="'.ASSETS_URI.'/images/medias/'.$size.'/Digg.png" /></a></li>'; } ?>
	<?php if($Dopplr) { echo '<li><a href="'.$Dopplr.'" rel="external"><img src="'.ASSETS_URI.'/images/medias/'.$size.'/Dopplr.png" /></a></li>'; } ?>
	<?php if($Dribbble) { echo '<li><a href="'.$Dribbble.'" rel="external"><img src="'.ASSETS_URI.'/images/medias/'.$size.'/Dribbble.png" /></a></li>'; } ?>
	<?php if($Evernote) { echo '<li><a href="'.$Evernote.'" rel="external"><img src="'.ASSETS_URI.'/images/medias/'.$size.'/Evernote.png" /></a></li>'; } ?>
	<?php if($Facebook) { echo '<li><a href="'.$Facebook.'" rel="external"><img src="'.ASSETS_URI.'/images/medias/'.$size.'/Facebook.png" /></a></li>'; } ?>
	<?php if($Flickr) { echo '<li><a href="'.$Flickr.'" rel="external"><img src="'.ASSETS_URI.'/images/medias/'.$size.'/Flickr.png" /></a></li>'; } ?>
	<?php if($Forrst) { echo '<li><a href="'.$Forrst.'" rel="external"><img src="'.ASSETS_URI.'/images/medias/'.$size.'/Forrst.png" /></a></li>'; } ?>
	<?php if($GitHub) { echo '<li><a href="'.$GitHub.'" rel="external"><img src="'.ASSETS_URI.'/images/medias/'.$size.'/GitHub.png" /></a></li>'; } ?>
	<?php if($Google) { echo '<li><a href="'.$Google.'" rel="external"><img src="'.ASSETS_URI.'/images/medias/'.$size.'/Google+.png" /></a></li>'; } ?>
	<?php if($Grooveshark) { echo '<li><a href="'.$Grooveshark.'" rel="external"><img src="'.ASSETS_URI.'/images/medias/'.$size.'/Grooveshark.png" /></a></li>'; } ?>
	<?php if($Instagram) { echo '<li><a href="'.$Instagram.'" rel="external"><img src="'.ASSETS_URI.'/images/medias/'.$size.'/Instagram.png" /></a></li>'; } ?>
	<?php if($Lastfm) { echo '<li><a href="'.$Lastfm.'" rel="external"><img src="'.ASSETS_URI.'/images/medias/'.$size.'/Lastfm.png" /></a></li>'; } ?>
	<?php if($LinkedIn) { echo '<li><a href="'.$LinkedIn.'" rel="external"><img src="'.ASSETS_URI.'/images/medias/'.$size.'/LinkedIn.png" /></a></li>'; } ?>
	<?php if($MySpace) { echo '<li><a href="'.$MySpace.'" rel="external"><img src="'.ASSETS_URI.'/images/medias/'.$size.'/MySpace.png" /></a></li>'; } ?>
	<?php if($Path) { echo '<li><a href="'.$Path.'" rel="external"><img src="'.ASSETS_URI.'/images/medias/'.$size.'/Path.png" /></a></li>'; } ?>
	<?php if($PayPal) { echo '<li><a href="'.$PayPal.'" rel="external"><img src="'.ASSETS_URI.'/images/medias/'.$size.'/PayPal.png" /></a></li>'; } ?>
	<?php if($Picasa) { echo '<li><a href="'.$Picasa.'" rel="external"><img src="'.ASSETS_URI.'/images/medias/'.$size.'/Picasa.png" /></a></li>'; } ?>
	<?php if($Posterous) { echo '<li><a href="'.$Posterous.'" rel="external"><img src="'.ASSETS_URI.'/images/medias/'.$size.'/Posterous.png" /></a></li>'; } ?>
	<?php if($Reddit) { echo '<li><a href="'.$Reddit.'" rel="external"><img src="'.ASSETS_URI.'/images/medias/'.$size.'/Reddit.png" /></a></li>'; } ?>
	<?php if($RSS) { echo '<li><a href="'.$RSS.'" rel="external"><img src="'.ASSETS_URI.'/images/medias/'.$size.'/RSS.png" /></a></li>'; } ?>
	<?php if($ShareThis) { echo '<li><a href="'.$ShareThis.'" rel="external"><img src="'.ASSETS_URI.'/images/medias/'.$size.'/ShareThis.png" /></a></li>'; } ?>
	<?php if($Skype) { echo '<li><a href="'.$Skype.'" rel="external"><img src="'.ASSETS_URI.'/images/medias/'.$size.'/Skype.png" /></a></li>'; } ?>
	<?php if($Soundcloud) { echo '<li><a href="'.$Soundcloud.'" rel="external"><img src="'.ASSETS_URI.'/images/medias/'.$size.'/Soundcloud.png" /></a></li>'; } ?>
	<?php if($Spotify) { echo '<li><a href="'.$Spotify.'" rel="external"><img src="'.ASSETS_URI.'/images/medias/'.$size.'/Spotify.png" /></a></li>'; } ?>
	<?php if($StumbleUpon) { echo '<li><a href="'.$StumbleUpon.'" rel="external"><img src="'.ASSETS_URI.'/images/medias/'.$size.'/StumbleUpon.png" /></a></li>'; } ?>
	<?php if($Tumblr) { echo '<li><a href="'.$Tumblr.'" rel="external"><img src="'.ASSETS_URI.'/images/medias/'.$size.'/Tumblr.png" /></a></li>'; } ?>
	<?php if($Twitter) { echo '<li><a href="'.$Twitter.'" rel="external"><img src="'.ASSETS_URI.'/images/medias/'.$size.'/Twitter.png" /></a></li>'; } ?>
	<?php if($Viddler) { echo '<li><a href="'.$Viddler.'" rel="external"><img src="'.ASSETS_URI.'/images/medias/'.$size.'/Viddler.png" /></a></li>'; } ?>
	<?php if($Vimeo) { echo '<li><a href="'.$Vimeo.'" rel="external"><img src="'.ASSETS_URI.'/images/medias/'.$size.'/Vimeo.png" /></a></li>'; } ?>
	<?php if($Virb) { echo '<li><a href="'.$Virb.'" rel="external"><img src="'.ASSETS_URI.'/images/medias/'.$size.'/Virb.png" /></a></li>'; } ?>
	<?php if($Windows) { echo '<li><a href="'.$Windows.'" rel="external"><img src="'.ASSETS_URI.'/images/medias/'.$size.'/Windows.png" /></a></li>'; } ?>
	<?php if($WordPress) { echo '<li><a href="'.$WordPress.'" rel="external"><img src="'.ASSETS_URI.'/images/medias/'.$size.'/WordPress.png" /></a></li>'; } ?>
	<?php if($YouTube) { echo '<li><a href="'.$YouTube.'" rel="external"><img src="'.ASSETS_URI.'/images/medias/'.$size.'/YouTube.png" /></a></li>'; } ?>
	<?php if($Zerply) { echo '<li><a href="'.$Zerply.'" rel="external"><img src="'.ASSETS_URI.'/images/medias/'.$size.'/Zerply.png" /></a></li>'; } ?>

	</ul>
	<?php echo $after_widget; ?>
	<?php
	}
}

register_widget( 'theme_widget_social' );
?>