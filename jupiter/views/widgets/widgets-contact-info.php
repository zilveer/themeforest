<?php 
class Artbees_Widget_Contact_Info extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 'widget_contact_info', 'description' => 'Displays a list of contact info.' );
		WP_Widget::__construct( 'contact_info', THEME_SLUG.' - '. 'Contact Info', $widget_ops );

	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$company = $instance['company'];
		$person = $instance['person'];
		$phone = $instance['phone'];
		$fax = $instance['fax'];
		$email = $instance['email'];
		$address = $instance['address'];
		$website = $instance['website'];
		$skype = $instance['skype'];



		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;

?>
			<ul <?php echo get_schema_markup('person'); ?>>
			<?php if ( !empty( $person ) ):?><li><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true,'mk-moon-user-7', 16); ?><span itemprop="name"><?php echo $person;?></span></li><?php endif;?>	
			<?php if ( !empty( $company ) ):?><li><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true,'mk-moon-office', 16); ?><span itemprop="jobTitle"><?php echo $company;?></span></li><?php endif;?>
			<?php if ( !empty( $address ) ):?><li><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true,'mk-icon-home', 16); ?><span itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress"><?php echo $address;?></span></li><?php endif;?>
			<?php if ( !empty( $phone ) ):?><li><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true,'mk-icon-phone', 16); ?><span><?php echo $phone;?></span></li><?php endif;?>
			<?php if ( !empty( $fax ) ):?><li><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true,'mk-icon-print', 16); ?><span><?php echo $fax;?></span></li><?php endif;?>
			
			<?php if ( !empty( $email ) ):?>
				<li><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true,'mk-icon-envelope'); ?><span>
				<a itemprop="email" href="mailto:<?php echo str_replace( '@', '&#64;', $email) ?>"><?php echo str_replace( '@', '&#64;', $email);?></a></span></li>
			<?php endif;?>

			<?php if ( !empty( $website ) ):?>
				<?php if(is_html( $website ) ): ?> 
					<li><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true,'mk-icon-globe', 16); ?><?php echo $website; ?></li>
				<?php else: ?>
					<li><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true,'mk-icon-globe', 16); ?><span><a href="<?php echo esc_url($website); ?>" itemprop="url"><?php echo $website; ?></a></span></li>
				<?php endif;?>
			<?php endif;?>
			<?php if ( !empty( $skype ) ):?><li><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true,'mk-moon-skype', 16); ?><span><a href="skype:<?php echo esc_attr($skype); ?>?call"><?php echo $skype;?></a></span></li><?php endif;?>
			</ul>
		<?php
		echo $after_widget; 

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['phone'] = strip_tags( $new_instance['phone'] );
		$instance['fax'] = strip_tags( $new_instance['fax'] );
		$instance['email'] = strip_tags( $new_instance['email'] );
		$instance['address'] = $new_instance['address'];
		$instance['website'] =  $new_instance['website'];
		$instance['person'] = strip_tags( $new_instance['person'] );
		$instance['company'] = strip_tags( $new_instance['company'] );
		$instance['skype'] = strip_tags( $new_instance['skype'] );


		return $instance;
	}

	function form( $instance ) {
		//Defaults
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$phone = isset( $instance['phone'] ) ? esc_attr( $instance['phone'] ) : '';
		$fax = isset( $instance['fax'] ) ? esc_attr( $instance['fax'] ) : '';
		$email = isset( $instance['email'] ) ? esc_attr( $instance['email'] ) : '';
		$address = isset( $instance['address'] ) ? esc_attr( $instance['address'] ) : '';
		$website = isset( $instance['website'] ) ? esc_attr( $instance['website'] ) : '';
		$person = isset( $instance['person'] ) ? esc_attr( $instance['person'] ) : '';
		$company = isset( $instance['company'] ) ? esc_attr( $instance['company'] ) : '';
		$skype = isset( $instance['skype'] ) ? esc_attr( $instance['skype'] ) : '';

?>

		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'mk_framework'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id( 'person' ); ?>"><?php _e('Person:', 'mk_framework'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'person' ); ?>" name="<?php echo $this->get_field_name( 'person' ); ?>" type="text" value="<?php echo $person; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'company' ); ?>"><?php _e('Company:', 'mk_framework'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'company' ); ?>" name="<?php echo $this->get_field_name( 'company' ); ?>" type="text" value="<?php echo $company; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'address' ); ?>"><?php _e('Address:', 'mk_framework'); ?></label>
		<textarea class="widefat" id="<?php echo $this->get_field_id( 'address' ); ?>" name="<?php echo $this->get_field_name( 'address' ); ?>" rows="5"><?php echo $address; ?></textarea>
		<em>You can use HTML content in this field (e.g. for line breaks use &lt;br/&gt;)</em>
		</p>

		<p><label for="<?php echo $this->get_field_id( 'phone' ); ?>"><?php _e('Phone:', 'mk_framework'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'phone' ); ?>" name="<?php echo $this->get_field_name( 'phone' ); ?>" type="text" value="<?php echo $phone; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'fax' ); ?>"><?php _e('Fax:', 'mk_framework'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'fax' ); ?>" name="<?php echo $this->get_field_name( 'fax' ); ?>" type="text" value="<?php echo $fax; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php _e('Email:', 'mk_framework'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" type="text" value="<?php echo $email; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'website' ); ?>"><?php _e('Website:', 'mk_framework'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'website' ); ?>" name="<?php echo $this->get_field_name( 'website' ); ?>" type="text" value="<?php echo $website; ?>" />
			<em>You can use HTML content in this field (e.g. for line breaks use &lt;br/&gt;)</em>
		</p>

		<p><label for="<?php echo $this->get_field_id( 'skype' ); ?>"><?php _e('Skype Username:', 'mk_framework'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'skype' ); ?>" name="<?php echo $this->get_field_name( 'skype' ); ?>" type="text" value="<?php echo $skype; ?>" /></p>



		

<?php
	}

}

register_widget("Artbees_Widget_Contact_Info");