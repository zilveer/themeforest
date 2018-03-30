<?php
/**
 * Aboutme Widget
 */
if(!class_exists('WP_Widget_Aboutme')){
	class WP_Widget_Aboutme extends WP_Widget {
		
		const API_KEY = '8200bb086a407093faffc6ed21db003074db380a';
		const CACHE_TIME = 3600;
		const ERROR_NO_USER = 1;
		const ERROR_EMPTY_USER = 2;
		const API_PROFILE_ERROR = 3;
		const API_SERVER_ERROR = 4;
		const API_REGISTRATION_ERROR = 5;
		const API_EMPTY_RESPONSE = 6;
		const ERROR_UNKNOWN = 9;
		
		const AUTO_MAILING = 0;
		const SHOW_DEBUG_URL = 1;
		
		function WP_Widget_Aboutme() {
			$widgetOps = array('classname' => 'wd_widget_aboutme', 'description' => __('Display your about.me profile with thumbnail','wpdance'));
			parent::__construct('wd_aboutme', __('WD - About Me','wpdance'), $widgetOps);
		}

		function widget( $args, $instance ) {
			
			if ( empty($instance['client_id']) || 0 != $instance['error'] ){
				return;
			}
			
			extract($args, EXTR_SKIP);
			$title = empty( $instance['title'] ) ? '' : apply_filters( 'widget_title', $instance['title'] );
			$fontsize = empty( $instance['fontsize'] ) ? 'large' : $instance['fontsize'];
			$photo = empty( $instance['photo'] ) ? 'background' : $instance['photo'];
			$username = empty( $instance['username'] ) ? '' : $instance['username'];
			//We need to check the key existence as this option was absent in initial release, otherwise widget might break
			$headline = array_key_exists( 'headline', $instance )? $instance['headline'] : "1";
			$biography = array_key_exists( 'biography', $instance )? $instance['biography'] : "1";
			$links = array_key_exists( 'links', $instance )? $instance['links'] : "1";
			
			if ( empty( $username ) ){
				return;
			}
			$data = get_transient( 'wdam_' . $username . '_data' );
			
			if ( false === $data ) {
				$url = 'https://api.about.me/api/v2/json/user/view/' . $username . '?client_id=' . $instance['client_id'] . '&extended=true&on_match=true&strip_html=false';
				$data = $this->get_api_content( $url );
				if ( false !== $data ) {
					$data = $this->extract_api_data( $data );
					if ( ! empty( $data ) ) {
						//Store this profile data in database
						set_transient( 'wdam_' . $username . '_data', $data, self::CACHE_TIME );
					} else {
						//If empty profile data, return
						return;
					}
				} else {
					//Some wrong happen in getting profle response from aboutme server, so return
					return;
				}
			}
			
			// if any key value is not present in stored data, delete the data as it is not in proper format
			$keys = array( 'app_icons', 'link_icons', 'profile_url', 'thumbnail', 'avatar', 'first_name', 'last_name', 'header', 'bio' );
			foreach ( $keys as $k => $val ) {
				if ( ! array_key_exists( $val, $data ) ) {
					delete_transient( 'wdam_' . $username . '_data' );
					return;
				}
			}
			if ( is_array( $data ) && ! empty( $data ) ) {
				echo $before_widget;
				echo $before_title . $title . $after_title; 
				
				if ( $photo == 'background' ){
					$thumbnail = $data['thumbnail'];
				}
				elseif ( $photo == 'bio' ){
					$thumbnail =  $data['avatar'];
				}
				else{
					$thumbnail =  '';
				}
				
				echo '<div class="wd_aboutme_wrapper">';
				
				if ( ! empty( $thumbnail ) ) {
					echo '<div class="thumbnail">
						<a href="' . esc_url( $data['profile_url'] ) . '" target="_blank" rel="me">
							<img src="' . esc_url( $thumbnail ) . '" alt="' . esc_attr( $data['first_name'] ) . ' ' . esc_attr( $data['last_name'] ) . '">
						</a>
						</div>';
				}
				if( $fontsize != 'no-name' ) {
					echo '<h2 class="name">
							<a href="' . $data['profile_url'] . '" style="font-size:' . $fontsize . ';" target="_blank" rel="me">' . esc_attr( $data['first_name'] ) . ' ' . esc_attr( $data['last_name'] ) . '</a>
						</h2>';
				}
				//If user opts to show headline show that
				if ( $headline && ! empty( $data['header'] ) ){ 
					echo '<h3 class="headline">' . esc_attr( $data['header'] ) . '</h3>'; 
				}
				//If user opts to show bio show that
				if ( $biography && ! empty( $data['bio'] ) ) {
					$biostr = '<p>' . str_replace( "\n", '</p><p>', wp_kses_data( $data['bio'] ) ) . '</p>';
				} else {
					$biostr = '';
				}
				echo '<div class="bio">' . $biostr . '</div>';
				//If user opts to show links show that
				if ( $links && count( $data['link_icons'] ) > 0 ) {
					echo '<div class="services">';
					foreach ( $data['link_icons'] as $v ) {
						echo '<a href="' . esc_url( $v['url'] ) . '" target="_blank" class="service_icon" rel="me">
								<img src="' . esc_url( $v['icon'] ) . '">
							</a>';
					}
					echo '</div>';
				}
				
				echo '</div>'; /* wrapper */
				
				echo $after_widget;
			}
		}

		function update( $new_instance, $old_instance ) {
			$discard = array( 'https://about.me/', 'http://about.me/', 'about.me/' );
			$username = empty( $new_instance['username'] ) ? '' : trim($new_instance['username']);
			$new_instance['username'] = trim( strip_tags( stripslashes( str_replace( $discard, '',  $username ) ) ) );
			$pos = strpos( $new_instance['username'], '/' );
			if( false !== $pos) {
				$new_instance['username'] = substr($new_instance['username'], 0 , $pos);
			}
			$pos = strpos( $new_instance['username'], '#' );
			if( false !== $pos) {
				$new_instance['username'] = substr($new_instance['username'], 0 , $pos);
			}
			$new_instance['username'] = trim($new_instance['username']);
			$username = $new_instance['username'];
			
			$src_url = empty( $new_instance['src_url'] ) ? get_site_url() : $new_instance['src_url'];
			$new_instance['src_url'] = str_ireplace( array('https://','http://'), '' , $src_url );
			$new_instance['headline'] = array_key_exists('headline', $new_instance) ? '1' : '0';
			$new_instance['biography'] = array_key_exists('biography', $new_instance) ? '1' : '0';
			/*$new_instance['apps'] = array_key_exists('apps', $new_instance) ? '1' : '0';*/
			$new_instance['links'] = array_key_exists('links', $new_instance) ? '1' : '0';
			$registration_flag = true; //This determines if we need to call registration api or not.
			$dataurl = '';
			$url = '';
			$new_instance['debug_url'] = '';
			
			//Process only if username has been entered
			if ( empty( $username ) ) {
				$new_instance['error'] = self::ERROR_EMPTY_USER;
			} elseif( false !== strpos( $username, ' ') ) {
				$new_instance['error'] = self::ERROR_NO_USER;
			} else {
				//If no client_id has been alloted, call for aboutme registration
				//If username has been changed, call for aboutme registration
				//If src_url or wordpress site url got changed, call for aboutme registration
				if ( empty( $new_instance['client_id'] ) ) {
					$registration_flag = false;
				} elseif ( $username != $old_instance['username'] ) {
					delete_transient( 'wdam_' . $old_instance['username'] . '_data' );
					$registration_flag = false;
				} elseif ( ! array_key_exists( 'src_url', $old_instance ) || $src_url != $old_instance['src_url']) {
					$registration_flag = false;
				}
				if ( ! $registration_flag ) {
					$new_instance['client_id'] = '';
					$url = 'https://api.about.me/api/v2/json/user/register/' . $username . '?apikey=' . self::API_KEY . '&src_url=' . $src_url . '&src=wordpress&verify=true';
					$data = $this->get_api_content( $url );
					if ( false === $data ) {
						$new_instance['error'] = self::API_SERVER_ERROR;
						$new_instance['debug_url'] = $url;
					} else {
						if ( ! empty( $data ) ) {
							if ( 200 == $data->status ) {
								//store this apikey as persistence object
								$new_instance['client_id'] = $data->apikey;
								$new_instance['error'] = 0;
							} elseif ( 401 == $data->status ) {
								$new_instance['error'] = self::API_REGISTRATION_ERROR;
								$new_instance['debug_url'] = $url.'&status=401';
							} elseif ( 404 == $data->status ) {
								$new_instance['error'] = self::ERROR_NO_USER;
							} else {
								$new_instance['error'] = self::ERROR_UNKNOWN;
								$new_instance['debug_url'] = $url.'&status='.$data->status;
							}
						} else {
							$new_instance['error'] = self::API_EMPTY_RESPONSE;
							$new_instance['debug_url'] = $url.'&status=empty';
						}
					}
				}
				// If client_id is available call profile api to get profile data
				if ( ! empty( $new_instance['client_id'] ) ){
					$dataurl = "https://api.about.me/api/v2/json/user/view/$username?client_id={$new_instance['client_id']}&extended=true&on_match=true&strip_html=false";
					$userdata = $this->get_api_content( $dataurl );
					if ( false === $userdata ) {
						$new_instance['error'] = self::API_SERVER_ERROR;
						$new_instance['debug_url'] = $dataurl;
					} else {
						if ( ! empty( $userdata ) ){
							if ( 200 == $userdata->status ) {
								// Reset any previous error that might have been set
								$new_instance['error'] = 0;
								$data = $this->extract_api_data( $userdata );
								set_transient( 'wdam_' . $username . '_data', $data, self::CACHE_TIME );
							} elseif ( 401 == $userdata->status ) {
								$new_instance['error'] = self::API_PROFILE_ERROR;
								$new_instance['client_id'] = '';
								$new_instance['debug_url'] = $dataurl.'&status=401';
								
							} elseif ( 404 == $userdata->status ) {
								$new_instance['error'] = self::ERROR_NO_USER;
								$new_instance['client_id'] = '';
							} else {
								$new_instance['error'] = self::ERROR_UNKNOWN;
								$new_instance['client_id'] = '';
								$new_instance['debug_url'] = $dataurl.'&status='.$userdata->status;
							}
						} else {
							$new_instance['error'] = self::API_EMPTY_RESPONSE;
							$new_instance['client_id'] = '';
							$new_instance['debug_url'] = $dataurl.'&status=empty';
						}
					}
				}
			}
			return $new_instance;
		}

		function form( $instance ) {
			$array_default = array(
							'title'				=> 'About Me'
							,'fontsize'			=> 'large'
							,'photo'			=> 'background'
							,'client_id'		=> 'light'
							,'error'			=> 0
							,'debug_url'		=> ''
							,'src_url'			=> str_ireplace( array('https://','http://'), '' , get_site_url() )
							,'username'			=> 'wpdance'
							,'headline'			=> '1'
							,'biography'		=> 1
							,'apps'				=> 1
							,'links'			=> 1
							);
							
			$instance = wp_parse_args( (array) $instance, $array_default );
			$title		= esc_attr($instance['title']);
			$fontsize	= esc_attr($instance['fontsize']);
			$photo 		= esc_attr($instance['photo']);
			$username 	= array_key_exists( 'username', $instance )? $instance['username'] : '';
			$headline 	= array_key_exists( 'headline', $instance )? $instance['headline'] : '1';
			$biography 	= array_key_exists( 'biography', $instance )? $instance['biography'] : '1';
			$apps 		= array_key_exists( 'apps', $instance )? $instance['apps'] : '1';
			$links 		= array_key_exists( 'links', $instance )? $instance['links'] : '1';
		?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Enter your title','wpdance'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Username','wpdance'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" type="text" value="http://about.me/<?php echo $username; ?>" />
			</p>
			<?php 
			if ( array_key_exists( 'error', $instance ) ) {
				
				if ( self::ERROR_NO_USER == $instance['error'] ) { ?>
					<span style="font-size:80%;color:red">
					<?php printf( __( "We're sorry, that's not a valid username. If you haven't, please <a href=\"%s\" target='_blank'>sign up and make your page</a>. If you have, please copy and paste your full about.me URL in the box( http://about.me/username ).", 'wpdance' ), 'https://about.me/?ncid=aboutmewpwidget' ); ?>
					</span>
				
				<?php
				} else if ( self::ERROR_EMPTY_USER == $instance['error'] ) { ?>
					<span style="font-size:80%"><?php printf(__( 'Don\'t have an about.me page? <a href="%s" target="_blank">Sign up now!', 'wpdance' ), 'https://about.me/?ncid=aboutmewpwidget');?></a></span>
				
				<?php
				} else if ( self::API_PROFILE_ERROR == $instance['error'] ) { 
					
					$message = __( 'There was an authorization error in the profile api request.', 'wpdance' ); 
					if ( array_key_exists( 'debug_url', $instance ) && ! empty( $instance['debug_url'] ) ) {
						if ( self::AUTO_MAILING ) {
							if ( ! wp_mail('help@about.me', 'Wordpress Widget Profile Error!!!!!!!!!', $message . ' The api url was: '. $instance['debug_url']) ) {
								$message .= __( ' Please contact help@about.me for support', 'wpdance' );
							} else { 
								$message .= __( 'Email has been sent to help@about.me for support', 'wpdance' );
							}
						} else {
							$message .= __( ' Please contact help@about.me for support', 'wpdance' );
						}
						if ( self::SHOW_DEBUG_URL ) {
							$message .= __( ' mentiontioning following url:', 'wpdance' ); 
							$message .= '<b>' . $instance['debug_url'] .'</b>';
						}
					} else{
						$message .= __( ' Please contact help@about.me for support', 'wpdance' );
					}?>
					<span style="font-size:80%;color:red"><?php echo $message; ?></span>
				
				<?php
				} else if ( self::API_REGISTRATION_ERROR == $instance['error'] ) { 
				
					$message = __( 'There was an authorization error in the registration process.', 'wpdance' );
					if ( array_key_exists( 'debug_url', $instance ) && ! empty( $instance['debug_url'] ) ) {
						if ( self::AUTO_MAILING ) {
							if ( ! wp_mail('help@about.me', 'Wordpress Widget Registration Error!!!!!!!!!', $message . ' The api url was: '. $instance['debug_url']) ) {
								$message .= __( ' Please email help@about.me for support', 'wpdance' );
							} else { 
								_e( 'Email has been sent to help@about.me for support', 'wpdance' );
							}
						} else {
							$message .= __( ' Please email help@about.me for support', 'wpdance' );
						}
						if ( self::SHOW_DEBUG_URL ) {
							$message .= __( ' mentiontioning following url:', 'wpdance' ); 
							$message .= '<b>' . $instance['debug_url'] .'</b>';
						}
					} else{
						$message .= __( ' Please email help@about.me for support', 'wpdance' );
					}?>
					<span style="font-size:80%;color:red"><?php echo $message; ?></span>
					
				<?php
				} else if ( self::API_SERVER_ERROR == $instance['error'] ) { ?>
					<span style="font-size:80%;color:red"><?php _e( 'We encountered an error while communicating with the about.me server.  Please try again later.', 'wpdance' ) ?></span>
				<?php
				} else if ( self::API_EMPTY_RESPONSE == $instance['error'] ) { ?>
					<span style="font-size:80%;color:red"><?php _e( 'about.me server returns empty data. Please email help@about.me for support.', 'wpdance' ) ?></span>
				<?php
				} else if ( self::ERROR_UNKNOWN == $instance['error'] ) { ?>
					<span style="font-size:80%;color:red"><?php _e( 'An unknown error occurs while communicating with the about.me server. Please email help@about.me for support.', 'wpdance' ) ?></span>
				<?php
				}
			}
			?>
			<p>
				<label for="<?php echo $this->get_field_id( 'photo' ); ?>"><?php _e( 'Photo', 'wpdance' );?></label>
				<select class="widefat" id="<?php echo $this->get_field_id( 'photo' ); ?>" name="<?php echo $this->get_field_name( 'photo' ); ?>">
					<option value='background' <?php selected( $photo, 'background' ); ?>><?php _e( 'Background Image', 'wpdance' ) ?></option>
					<option value='bio' <?php selected( $photo, 'bio' ); ?>><?php _e( 'Bio Photo', 'wpdance' ) ?></option>
					<option value='no-photo' <?php selected( $photo, 'no-photo' ); ?>><?php _e( 'None', 'wpdance' ) ?></option>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'fontsize' ); ?>"><?php _e( 'Name', 'wpdance' );?></label>
				<select class="widefat" id="<?php echo $this->get_field_id( 'fontsize' ); ?>" name="<?php echo $this->get_field_name( 'fontsize' ); ?>">
					<option value='x-large' <?php selected( $fontsize, 'x-large' ); ?>><?php _e( 'Display X-Large', 'wpdance' ) ?></option>
					<option value='large' <?php selected( $fontsize, 'large' ); ?>><?php _e( 'Display Large', 'wpdance' ) ?></option>
					<option value='medium' <?php selected( $fontsize, 'medium' ); ?>><?php _e( 'Display Medium', 'wpdance' ) ?></option>
					<option value='small' <?php selected( $fontsize, 'small' ); ?>><?php _e( 'Display Small', 'wpdance' ) ?></option>
					<option value='no-name' <?php selected( $fontsize, 'no-name' ); ?>><?php _e( "Don't Display Name", 'wpdance' ) ?></option>
				</select>
			</p>
			<p>
				<input type="checkbox" id="<?php echo $this->get_field_id( 'headline' ); ?>" name="<?php echo $this->get_field_name( 'headline' ); ?>" value="1" <?php checked( $headline, '1' ); ?> /> 
				<label for="<?php echo $this->get_field_id( 'headline' ); ?>"><?php _e( 'Headline', 'wpdance' );?></label>
			</p>
			<p>
				<input type="checkbox" id="<?php echo $this->get_field_id( 'biography' ); ?>" name="<?php echo $this->get_field_name( 'biography' ); ?>" value="1" <?php checked( $biography, '1' ); ?> /> 
				<label for="<?php echo $this->get_field_id( 'biography' ); ?>"><?php _e( 'Biography', 'wpdance' );?></label>
			</p>
			<p>
				<input type="checkbox" id="<?php echo $this->get_field_id( 'links' ); ?>" name="<?php echo $this->get_field_name( 'links' ); ?>" value="1" <?php checked( $links, '1' ); ?> /> 
				<label for="<?php echo $this->get_field_id( 'links' ); ?>"><?php _e( 'Links', 'wpdance' );?></label>
			</p>
			<p>
				<input type="hidden" id="<?php echo $this->get_field_id( 'client_id' ); ?>" name="<?php echo $this->get_field_name( 'client_id' ); ?>" value="<?php echo $instance['client_id']; ?>">
				<input type="hidden" id="<?php echo $this->get_field_id( 'error' ); ?>" name="<?php echo $this->get_field_name( 'error' ); ?>" value="<?php echo $instance['error']; ?>">
				<input type="hidden" id="<?php echo $this->get_field_id( 'src_url' ); ?>" name="<?php echo $this->get_field_name( 'src_url' ); ?>" value="<?php echo $instance['src_url']; ?>">
			</p>
			
			<?php 
		}
		
		/**
		 * To read the response from aboutme api call
		 *
		 * @params string $url api url
		 *
		 * @retun mixed json class or false
		 */
		private function get_api_content( $url ) {
			$response = wp_remote_get( $url, array( 'sslverify'=>0, 'User-Agent' => 'WordPress.com About.me Widget' ) );
			if ( is_wp_error( $response ) ) {
				return false;
			} else {
				return json_decode( $response['body'] );
			}
		}
		/**
		 * Only extract required keys from json data of api profile call
		 * @param class $data json content of profile
		 *
		 * @return array
		 */
		private function extract_api_data( $data ) {
			$retarr = array();
			if ( ! empty( $data ) && 200 == $data->status ) {
				$app_icons = array();
				$link_icons = array();
				$i = 0;
				$j = 0;
				foreach ( $data->websites as $c ) {
					if ( 'default' == $c->platform || 'syndication_feed' == $c->platform) {
						continue; //we want to show only service icons
					} elseif ( 'link' == $c->platform ){
						$icon_url = $c->icon_url;
						if ( $c->site_url ) {
							$url = $c->site_url;
						} else if( $c->modal_url ) {
							$url = $c->modal_url;
						} else if( $c->service_url ) {
							$url = $c->service_url;
						}
						$link_icons[$i++] = array( 'icon'=>$icon_url, 'url'=>$url, 'text'=>$c->display_name );
					} elseif ( ! empty( $c->icon42_url ) ) {
						$icon_url = $c->icon42_url;
						$icon_url = str_replace( '42x42', '32x32', $icon_url );
						if ( $c->site_url ) {
							$url = $c->site_url;
						} else if( $c->modal_url ) {
							$url = $c->modal_url;
						} else {
							$url = 'http://about.me/' . $data->user_name . '/#!/service/' . $c->platform;
						}
						$app_icons[$j++] = array( 'icon'=>$icon_url, 'url'=>$url );
					}
				}
				$retarr['app_icons'] = $app_icons;
				$retarr['link_icons'] = $link_icons;
				$retarr['profile_url'] = $data->profile;
				$retarr['thumbnail'] = $data->background;
				$retarr['avatar'] = $data->avatar;
				$retarr['first_name'] = $data->first_name;
				$retarr['last_name'] = $data->last_name;
				$retarr['header'] = $data->header;
				$retarr['bio'] = $data->bio;
			}
			return $retarr;
		}
	}
}

