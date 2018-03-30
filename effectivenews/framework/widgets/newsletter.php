<?php 

add_action('widgets_init','mom_widget_newsletter');

function mom_widget_newsletter() {
	register_widget('mom_widget_newsletter');
	
	}

class mom_widget_newsletter extends WP_Widget {
	function mom_widget_newsletter() {
			
		$widget_ops = array('classname' => 'momizat-news_letter','description' => __('Widget display NewsLetter Subscribe form it support Mailchimp, feedburner','theme'));
		parent::__construct('momizatNewsLetter',__('Effective - NewsLetter','theme'),$widget_ops);

		}
		
	function widget( $args, $instance ) {
		extract( $args );
		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$style = $instance['style'];
		$type = $instance['type'];
		$msg = $instance['msg'];
		$list = $instance['list'];
		$feed_url = $instance['feed_url'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
?>
                        <div class="mom-newsletter <?php echo $style; ?>">
			    <?php if ($type == 'feedburner') { ?>
		<form class="mn-form" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $feed_url; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
		     <i class="mn-icon brankic-icon-envelope"></i><input type="text" class="nsf" name="email" name="uri" placeholder="<?php _e('Enter your e-mail ..', 'theme'); ?>" />
		     <input type="hidden" name="loc" value="en_US"/>
			<input type="hidden" value="<?php echo $feed_url; ?>" name="uri"/>
                                <button class="button" type="submit"><?php _e('Subscribe','theme');?></button>
                 </form>

		<?php } else { ?>
			    <form action="" class="mn-form mom_mailchimp_subscribe" method="post" data-list_id="<?php echo $list; ?>">
                                <i class="mn-icon brankic-icon-envelope"></i><input name="email" class="mms-email" type="text" placeholder="<?php _e('YOUR EMAIL', 'theme'); ?>">
				<span class="sf-loading"><img src="<?php echo MOM_IMG; ?>/ajax-search-nav.png" alt=""></span>

                                <button class="button" type="submit"><?php _e('Subscribe','theme');?></button>

                            </form>
		<?php } ?>
		<div class="clear"></div>
                        </div>
<?php 
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['style'] = $new_instance['style'];
		$instance['type'] = $new_instance['type'];
		$instance['msg'] = $new_instance['msg'];
		$instance['list'] = $new_instance['list'];
		$instance['feed_url'] = $new_instance['feed_url'];

		return $instance;
	}
	
function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
			'title' => __('Newsletter','theme'),
			'style' => '',
			'type' => 'mailchimp',
			'msg' => __('Subscribe to our email newsletter.', 'theme'),
			'list' => '',
			'feed_url' => ''
 			);
		$instance = wp_parse_args( (array) $instance, $defaults );
		
		$api_key = mom_option('mailchimp_api_key');
		
		require_once(MOM_FW . '/inc/mailchimp/Mailchimp.php');
		if ($api_key != '') {
			$Mailchimp = new Mom_Mailchimp( $api_key );
			$Mailchimp_Lists = new Mailchimp_Lists( $Mailchimp );
			$lists = $Mailchimp_Lists->getList();
		}
			//echo '<pre>'; print_r($lists['data']); echo '</pre>';
	
		?>
	<script>
		jQuery(document).ready(function($) {
			$('.widget-content').on( 'change', '#<?php echo $this->get_field_id( 'type' ); ?>',function () {
				if ($(this).val() === 'mailchimp') {
					$('#<?php echo $this->get_field_id('list'); ?>').parent().fadeIn();
					$('#<?php echo $this->get_field_id('feed_url'); ?>').parent().fadeOut();
				} else {
					$('#<?php echo $this->get_field_id('list'); ?>').parent().fadeOut();
					$('#<?php echo $this->get_field_id('feed_url'); ?>').parent().fadeIn();
				}
				
			});
				if ($('#<?php echo $this->get_field_id( 'type' ); ?>').val() === 'mailchimp') {
					$('#<?php echo $this->get_field_id('list'); ?>').parent().fadeIn();
					$('#<?php echo $this->get_field_id('feed_url'); ?>').parent().fadeOut();
				} else {
					$('#<?php echo $this->get_field_id('list'); ?>').parent().fadeOut();
					$('#<?php echo $this->get_field_id('feed_url'); ?>').parent().fadeIn();
				}
		});
	</script>
	
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:','theme'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  class="widefat" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'msg' ); ?>"><?php _e('Message:','theme'); ?></label>
		<textarea id="<?php echo $this->get_field_id( 'msg' ); ?>" name="<?php echo $this->get_field_name( 'msg' ); ?>" class="widefat" cols="20" rows="2"><?php echo $instance['msg']; ?></textarea>
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'style' ); ?>"><?php _e('Style', 'theme') ?></label>
		<select id="<?php echo $this->get_field_id( 'style' ); ?>" name="<?php echo $this->get_field_name( 'style' ); ?>" class="widefat">
		<option value="" <?php selected($instance['style'], ''); ?>><?php _e('Default', 'theme'); ?></option>
		<option value="compact" <?php selected($instance['style'], 'compact'); ?>><?php _e('Compact', 'theme'); ?></option>
		</select>
		</p>
		
		<p>
		<label for="<?php echo $this->get_field_id( 'type' ); ?>"><?php _e('Maillist Type', 'theme') ?></label>
		<select id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" class="widefat">
		<option value="mailchimp" <?php selected($instance['type'], 'mailchimp'); ?>><?php _e('Mailchimp', 'theme'); ?></option>
		<option value="feedburner" <?php selected($instance['type'], 'feedburner'); ?>><?php _e('feedburner', 'theme'); ?></option>
		</select>
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'list' ); ?>"><?php _e('Select List', 'theme') ?></label>
		<?php if ($api_key != '') { ?>
		<select id="<?php echo $this->get_field_id( 'list' ); ?>" name="<?php echo $this->get_field_name( 'list' ); ?>" class="widefat">
		<?php
			if (isset($lists['data'])) {
			foreach ($lists['data'] as $list ) {
		?>
			<option value="<?php echo $list['id']; ?>" <?php selected($instance['list'], $list['id']); ?>><?php echo $list['name']; ?></option>
		<?php
			}
			}
		?>
		</select>
		<?php
		} else {
			echo '<span id="'.$this->get_field_id( 'list' ).'" style="color:red;">'.__('No API key Go to "<a href="'.admin_url('?page=momizat_options').'">options</a> / API\'s Authentication" Section and add Mailchimp API Key','theme').'</span>';
		}
		?>
		</p>

		<p class="hide">
		<label for="<?php echo $this->get_field_id( 'feed_url' ); ?>"><?php _e('feedburner name: (your name without http://feeds.feedburner.com/) ', 'theme'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'feed_url' ); ?>" name="<?php echo $this->get_field_name( 'feed_url' ); ?>" value="<?php echo $instance['feed_url']; ?>" class="widefat" />
		</p>


<?php 
}
	} //end class