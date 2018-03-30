<?php

    /*
    *
    *	Swift Framework Permalinks Class
    *	------------------------------------------------
    *	Swift Framework v2.0
    * 	Copyright Swift Ideas 2015 - http://www.swiftideas.com
    *
    */

    if ( ! defined( 'ABSPATH' ) ) {
        exit;
    } // Exit if accessed directly

    if ( ! class_exists( 'sf_post_type_permalinks' ) ) :

        class sf_post_type_permalinks {

            public function __construct() {
                add_action( 'admin_init', array( $this, 'settings_init' ) );
                add_action( 'admin_init', array( $this, 'settings_save' ) );
            }

            public function settings_init() {

                // Add portfolio section to the permalinks page
                add_settings_section( 'sf-portfolio-permalink', __( 'Portfolio permalink base', 'swiftframework' ), array(
                        $this,
                        'portfolio_settings'
                    ), 'permalink' );

                // Add portfolio settings
                add_settings_field( 'portfolio_category_slug', __( 'Portfolio category base', 'swiftframework' ), array(
                        $this,
                        'portfolio_category_slug_input'
                    ), 'permalink', 'optional' );

                // Add galleries section to the permalinks page
                add_settings_section( 'sf-galleries-permalink', __( 'Galleries permalink base', 'swiftframework' ), array(
                        $this,
                        'galleries_settings'
                    ), 'permalink' );

                // Add galleries settings
                add_settings_field( 'galleries_category_slug', __( 'Galleries category base', 'swiftframework' ), array(
                        $this,
                        'galleries_category_slug_input'
                    ), 'permalink', 'optional' );

                // Add team section to the permalinks page
                add_settings_section( 'sf-team-permalink', __( 'Team permalink base', 'swiftframework' ), array(
                        $this,
                        'team_settings'
                    ), 'permalink' );

                // Add team settings
                add_settings_field( 'team_category_slug', __( 'Team category base', 'swiftframework' ), array(
                        $this,
                        'team_category_slug_input'
                    ), 'permalink', 'optional' );

                // Add team section to the permalinks page
                add_settings_section( 'sf-directory-permalink', __( 'Directory permalink base', 'swiftframework' ), array(
                        $this,
                        'directory_settings'
                    ), 'permalink' );

                // Add team settings
                add_settings_field( 'directory_category_slug', __( 'Directory category base', 'swiftframework' ), array(
                        $this,
                        'directory_category_slug_input'
                    ), 'permalink', 'optional' );

                // Add team settings
                add_settings_field( 'directory_location_slug', __( 'Directory location base', 'swiftframework' ), array(
                        $this,
                        'directory_location_slug_input'
                    ), 'permalink', 'optional' );

                // Add faqs section to the permalinks page
                add_settings_section( 'sf-faqs-permalink', __( 'FAQs permalink base', 'swiftframework' ), array(
                        $this,
                        'faqs_settings'
                    ), 'permalink' );

                // Add team settings
                add_settings_field( 'faqs_category_slug', __( 'FAQ category base', 'swiftframework' ), array(
                        $this,
                        'faqs_category_slug_input'
                    ), 'permalink', 'optional' );
            }

            public function portfolio_category_slug_input() {
                $port_permalinks = get_option( 'sf_portfolio_permalinks' );
                ?>
                <input name="portfolio_category_slug" type="text" class="regular-text code"
                       value="<?php if ( isset( $port_permalinks['category_base'] ) ) {
                           echo esc_attr( $port_permalinks['category_base'] );
                       } ?>" placeholder="<?php echo __( 'portfolio-category', 'swiftframework' ) ?>"/>
            <?php
            }

            public function galleries_category_slug_input() {
                $gallery_permalinks = get_option( 'sf_galleries_permalinks' );
                ?>
                <input name="galleries_category_slug" type="text" class="regular-text code"
                       value="<?php if ( isset( $gallery_permalinks['category_base'] ) ) {
                           echo esc_attr( $gallery_permalinks['category_base'] );
                       } ?>" placeholder="<?php echo __( 'galleries-category', 'swiftframework' ) ?>"/>
            <?php
            }

            public function team_category_slug_input() {
                $team_permalinks = get_option( 'sf_team_permalinks' );
                ?>
                <input name="team_category_slug" type="text" class="regular-text code"
                       value="<?php if ( isset( $team_permalinks['category_base'] ) ) {
                           echo esc_attr( $team_permalinks['category_base'] );
                       } ?>" placeholder="<?php echo __( 'team-category', 'swiftframework' ) ?>"/>
            <?php
            }

            public function directory_category_slug_input() {
                $directory_permalinks = get_option( 'sf_directory_permalinks' );
                ?>
                <input name="directory_category_slug" type="text" class="regular-text code"
                       value="<?php if ( isset( $directory_permalinks['category_base'] ) ) {
                           echo esc_attr( $directory_permalinks['category_base'] );
                       } ?>" placeholder="<?php echo __( 'directory-category', 'swiftframework' ) ?>"/>
            <?php
            }

            public function directory_location_slug_input() {
                $directory_permalinks = get_option( 'sf_directory_permalinks' );
                ?>
                <input name="directory_location_slug" type="text" class="regular-text code"
                       value="<?php if ( isset( $directory_permalinks['location_base'] ) ) {
                           echo esc_attr( $directory_permalinks['location_base'] );
                       } ?>" placeholder="<?php echo __( 'directory-location', 'swiftframework' ) ?>"/>
            <?php
            }

            public function faqs_category_slug_input() {
                $faqs_permalinks = get_option( 'sf_faqs_permalinks' );
                ?>
                <input name="faqs_category_slug" type="text" class="regular-text code"
                       value="<?php if ( isset( $faqs_permalinks['category_base'] ) ) {
                           echo esc_attr( $faqs_permalinks['category_base'] );
                       } ?>" placeholder="<?php echo __( 'faqs-category', 'swiftframework' ) ?>"/>
            <?php
            }

            public function portfolio_settings() {
                echo wpautop( __( 'These settings control the permalinks used for portfolio items. These settings only apply when <strong>not using "default" permalinks above</strong>.', 'swiftframework' ) );

                // Get current permalinks
                $permalinks          = get_option( 'sf_portfolio_permalinks' );
                $portfolio_permalink = $permalinks['portfolio_base'];

                // Get portfolio page
                global $sf_options;
                $portfolio_page = __( $sf_options['portfolio_page'], 'swiftframework' );
                $base_slug      = ( $portfolio_page > 0 && get_page( $portfolio_page ) ) ? get_page_uri( $portfolio_page ) : __( 'portfolio', 'swiftframework' );
                $portfolio_base = __( 'portfolio', 'swiftframework' );

                $structures = array(
                    0 => '',
                    1 => '/' . trailingslashit( $portfolio_base ),
                    2 => '/' . trailingslashit( $base_slug ),
                    3 => '/' . trailingslashit( $base_slug ) . trailingslashit( '%portfolio-category%' )
                );
                ?>
                <table class="form-table">
                    <tbody>
                    <tr>
                        <th><label><input name="portfolio_permalink" type="radio" value="<?php echo $structures[0]; ?>"
                                          class="sf_port_tog" <?php checked( $structures[0], $portfolio_permalink ); ?> /> <?php _e( 'Default', 'swiftframework' ); ?>
                            </label></th>
                        <td><code><?php echo home_url(); ?>/?portfolio=sample-portfolio-item</code></td>
                    </tr>
                    <tr>
                        <th><label><input name="portfolio_permalink" type="radio" value="<?php echo $structures[1]; ?>"
                                          class="sf_port_tog" <?php checked( $structures[1], $portfolio_permalink ); ?> /> <?php _e( 'Portfolio', 'swiftframework' ); ?>
                            </label></th>
                        <td><code><?php echo home_url(); ?>/<?php echo $portfolio_base; ?>/sample-portfolio-item/</code>
                        </td>
                    </tr>
                    <?php if ( $portfolio_page ) : ?>
                        <tr>
                            <th><label><input name="portfolio_permalink" type="radio"
                                              value="<?php echo $structures[2]; ?>"
                                              class="sf_port_tog" <?php checked( $structures[2], $portfolio_permalink ); ?> /> <?php _e( 'Portfolio base', 'swiftframework' ); ?>
                                </label></th>
                            <td><code><?php echo home_url(); ?>/<?php echo $base_slug; ?>/sample-portfolio-item/</code>
                            </td>
                        </tr>
                        <!--<tr>
							<th><label><input name="portfolio_permalink" type="radio" value="<?php echo $structures[3]; ?>" class="sftog" <?php checked( $structures[3], $portfolio_permalink ); ?> /> <?php _e( 'Portfolio base with category', 'swiftframework' ); ?></label></th>
							<td><code><?php echo home_url(); ?>/<?php echo $base_slug; ?>/portfolio-category/sample-portfolio-item/</code></td>
						</tr>-->
                    <?php endif; ?>
                    <tr>
                        <th><label><input name="portfolio_permalink" id="sf_portfolio_custom_selection" type="radio"
                                          value="custom"
                                          class="sf_port_tog" <?php checked( in_array( $portfolio_permalink, $structures ), false ); ?> />
                                <?php _e( 'Custom Base', 'swiftframework' ); ?></label></th>
                        <td>
                            <input name="portfolio_permalink_structure" id="sf_portfolio_permalink_structure"
                                   type="text" value="<?php echo esc_attr( $portfolio_permalink ); ?>"
                                   class="regular-text code"> <span
                                class="description"><?php _e( 'Enter a custom base to use. A base <strong>must</strong> be set or WordPress will use default instead.', 'swiftframework' ); ?></span>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <script type="text/javascript">
                    jQuery(
                        function() {
                            jQuery( 'input.sf_port_tog' ).change(
                                function() {
                                    jQuery( '#sf_portfolio_permalink_structure' ).val( jQuery( this ).val() );
                                }
                            );

                            jQuery( '#sf_portfolio_permalink_structure' ).focus(
                                function() {
                                    jQuery( '#sf_portfolio_custom_selection' ).click();
                                }
                            );
                        }
                    );
                </script>
            <?php
            }

            public function galleries_settings() {
                echo wpautop( __( 'These settings control the permalinks used for galleries. These settings only apply when <strong>not using "default" permalinks above</strong>.', 'swiftframework' ) );

                // Get current permalinks
                $permalinks          = get_option( 'sf_galleries_permalinks' );
                $galleries_permalink = $permalinks['galleries_base'];

                // Set base slug & portfolio base
                $base_slug      = __( 'galleries', 'swiftframework' );
                $galleries_base = __( 'galleries', 'swiftframework' );

                $structures = array(
                    0 => '',
                    1 => '/' . trailingslashit( $galleries_base ),
                    2 => '/' . trailingslashit( $base_slug ),
                    3 => '/' . trailingslashit( $base_slug ) . trailingslashit( '%galleries-category%' )
                );
                ?>
                <table class="form-table">
                    <tbody>
                    <tr>
                        <th><label><input name="galleries_permalink" type="radio" value="<?php echo $structures[0]; ?>"
                                          class="sf_gal_tog" <?php checked( $structures[0], $galleries_permalink ); ?> /> <?php _e( 'Default', 'swiftframework' ); ?>
                            </label></th>
                        <td><code><?php echo home_url(); ?>/?galleries=sample-gallery</code></td>
                    </tr>
                    <tr>
                        <th><label><input name="galleries_permalink" type="radio" value="<?php echo $structures[1]; ?>"
                                          class="sf_gal_tog" <?php checked( $structures[1], $galleries_permalink ); ?> /> <?php _e( 'Galleries', 'swiftframework' ); ?>
                            </label></th>
                        <td><code><?php echo home_url(); ?>/<?php echo $galleries_base; ?>/sample-gallery/</code></td>
                    </tr>
                    <tr>
                        <th><label><input name="galleries_permalink" id="sf_galleries_custom_selection" type="radio"
                                          value="custom"
                                          class="sf_gal_tog" <?php checked( in_array( $galleries_permalink, $structures ), false ); ?> />
                                <?php _e( 'Custom Base', 'swiftframework' ); ?></label></th>
                        <td>
                            <input name="galleries_permalink_structure" id="sf_galleries_permalink_structure"
                                   type="text" value="<?php echo esc_attr( $galleries_permalink ); ?>"
                                   class="regular-text code"> <span
                                class="description"><?php _e( 'Enter a custom base to use. A base <strong>must</strong> be set or WordPress will use default instead.', 'swiftframework' ); ?></span>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <script type="text/javascript">
                    jQuery(
                        function() {
                            jQuery( 'input.sf_gal_tog' ).change(
                                function() {
                                    jQuery( '#sf_galleries_permalink_structure' ).val( jQuery( this ).val() );
                                }
                            );

                            jQuery( '#sf_galleries_permalink_structure' ).focus(
                                function() {
                                    jQuery( '#sf_galleries_custom_selection' ).click();
                                }
                            );
                        }
                    );
                </script>
            <?php
            }

            public function team_settings() {
                echo wpautop( __( 'These settings control the permalinks used for team members. These settings only apply when <strong>not using "default" permalinks above</strong>.', 'swiftframework' ) );

                // Get current permalinks
                $permalinks     = get_option( 'sf_team_permalinks' );
                $team_permalink = $permalinks['team_base'];

                // Set base slug & team base
                $base_slug = __( 'team', 'swiftframework' );
                $team_base = __( 'team', 'swiftframework' );

                $structures = array(
                    0 => '',
                    1 => '/' . trailingslashit( $team_base ),
                    2 => '/' . trailingslashit( $base_slug ),
                    3 => '/' . trailingslashit( $base_slug ) . trailingslashit( '%team-category%' )
                );
                ?>
                <table class="form-table">
                    <tbody>
                    <tr>
                        <th><label><input name="team_permalink" type="radio" value="<?php echo $structures[0]; ?>"
                                          class="sf_team_tog" <?php checked( $structures[0], $team_permalink ); ?> /> <?php _e( 'Default', 'swiftframework' ); ?>
                            </label></th>
                        <td><code><?php echo home_url(); ?>/?team=sample-team-member</code></td>
                    </tr>
                    <tr>
                        <th><label><input name="team_permalink" type="radio" value="<?php echo $structures[1]; ?>"
                                          class="sf_team_tog" <?php checked( $structures[1], $team_permalink ); ?> /> <?php _e( 'Team', 'swiftframework' ); ?>
                            </label></th>
                        <td><code><?php echo home_url(); ?>/<?php echo $team_base; ?>/sample-team-member/</code></td>
                    </tr>
                    <tr>
                        <th><label><input name="team_permalink" id="sf_team_custom_selection" type="radio"
                                          value="custom"
                                          class="sf_team_tog" <?php checked( in_array( $team_permalink, $structures ), false ); ?> />
                                <?php _e( 'Custom Base', 'swiftframework' ); ?></label></th>
                        <td>
                            <input name="team_permalink_structure" id="sf_team_permalink_structure" type="text"
                                   value="<?php echo esc_attr( $team_permalink ); ?>" class="regular-text code"> <span
                                class="description"><?php _e( 'Enter a custom base to use. A base <strong>must</strong> be set or WordPress will use default instead.', 'swiftframework' ); ?></span>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <script type="text/javascript">
                    jQuery(
                        function() {
                            jQuery( 'input.sf_team_tog' ).change(
                                function() {
                                    jQuery( '#sf_team_permalink_structure' ).val( jQuery( this ).val() );
                                }
                            );

                            jQuery( '#sf_team_permalink_structure' ).focus(
                                function() {
                                    jQuery( '#sf_team_custom_selection' ).click();
                                }
                            );
                        }
                    );
                </script>
            <?php
            }

            public function directory_settings() {
                echo wpautop( __( 'These settings control the permalinks used for directory items. These settings only apply when <strong>not using "default" permalinks above</strong>.', 'swiftframework' ) );

                // Get current permalinks
                $permalinks          = get_option( 'sf_directory_permalinks' );
                $directory_permalink = $permalinks['directory_base'];

                // Set base slug & directory base
                $base_slug      = __( 'directory', 'swiftframework' );
                $directory_base = __( 'directory', 'swiftframework' );

                $structures = array(
                    0 => '',
                    1 => '/' . trailingslashit( $directory_base ),
                    2 => '/' . trailingslashit( $base_slug ),
                    3 => '/' . trailingslashit( $base_slug ) . trailingslashit( '%directory-category%' )
                );
                ?>
                <table class="form-table">
                    <tbody>
                    <tr>
                        <th><label><input name="directory_permalink" type="radio" value="<?php echo $structures[0]; ?>"
                                          class="sf_directory_tog" <?php checked( $structures[0], $directory_permalink ); ?> /> <?php _e( 'Default', 'swiftframework' ); ?>
                            </label></th>
                        <td><code><?php echo home_url(); ?>/?directory=sample-listing</code></td>
                    </tr>
                    <tr>
                        <th><label><input name="directory_permalink" type="radio" value="<?php echo $structures[1]; ?>"
                                          class="sf_directory_tog" <?php checked( $structures[1], $directory_permalink ); ?> /> <?php _e( 'Directory', 'swiftframework' ); ?>
                            </label></th>
                        <td><code><?php echo home_url(); ?>/<?php echo $directory_base; ?>/sample-listing/</code></td>
                    </tr>
                    <tr>
                        <th><label><input name="directory_permalink" id="sf_directory_custom_selection" type="radio"
                                          value="custom"
                                          class="sf_directory_tog" <?php checked( in_array( $directory_permalink, $structures ), false ); ?> />
                                <?php _e( 'Custom Base', 'swiftframework' ); ?></label></th>
                        <td>
                            <input name="directory_permalink_structure" id="sf_directory_permalink_structure"
                                   type="text" value="<?php echo esc_attr( $directory_permalink ); ?>"
                                   class="regular-text code"> <span
                                class="description"><?php _e( 'Enter a custom base to use. A base <strong>must</strong> be set or WordPress will use default instead.', 'swiftframework' ); ?></span>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <script type="text/javascript">
                    jQuery(
                        function() {
                            jQuery( 'input.sf_directory_tog' ).change(
                                function() {
                                    jQuery( '#sf_directory_permalink_structure' ).val( jQuery( this ).val() );
                                }
                            );

                            jQuery( '#sf_directory_permalink_structure' ).focus(
                                function() {
                                    jQuery( '#sf_directory_custom_selection' ).click();
                                }
                            );
                        }
                    );
                </script>
            <?php
            }

            public function faqs_settings() {
                echo wpautop( __( 'These settings control the permalinks used for FAQs. These settings only apply when <strong>not using "default" permalinks above</strong>.', 'swiftframework' ) );

                // Get current permalinks
                $permalinks          = get_option( 'sf_faqs_permalinks' );
                $faqs_permalink = $permalinks['faqs_base'];

                // Set base slug & directory base
                $base_slug      = __( 'faqs', 'swiftframework' );
                $faqs_base = __( 'faqs', 'swiftframework' );

                $structures = array(
                    0 => '',
                    1 => '/' . trailingslashit( $faqs_base ),
                    2 => '/' . trailingslashit( $base_slug ),
                    3 => '/' . trailingslashit( $base_slug ) . trailingslashit( '%faqs-category%' )
                );
                ?>
                <table class="form-table">
                    <tbody>
                    <tr>
                        <th><label><input name="faqs_permalink" type="radio" value="<?php echo $structures[0]; ?>"
                                          class="sf_faqs_tog" <?php checked( $structures[0], $faqs_permalink ); ?> /> <?php _e( 'Default', 'swiftframework' ); ?>
                            </label></th>
                        <td><code><?php echo home_url(); ?>/?faqs=sample-faq-item</code></td>
                    </tr>
                    <tr>
                        <th><label><input name="faqs_permalink" type="radio" value="<?php echo $structures[1]; ?>"
                                          class="sf_faqs_tog" <?php checked( $structures[1], $faqs_permalink ); ?> /> <?php _e( 'FAQs', 'swiftframework' ); ?>
                            </label></th>
                        <td><code><?php echo home_url(); ?>/<?php echo $faqs_base; ?>/sample-faq-item/</code>
                        </td>
                    </tr>
                    <tr>
                        <th><label><input name="faqs_permalink" id="sf_faqs_custom_selection" type="radio"
                                          value="custom"
                                          class="sf_faqs_tog" <?php checked( in_array( $faqs_permalink, $structures ), false ); ?> />
                                <?php _e( 'Custom Base', 'swiftframework' ); ?></label></th>
                        <td>
                            <input name="faqs_permalink_structure" id="sf_faqs_permalink_structure"
                                   type="text" value="<?php echo esc_attr( $faqs_permalink ); ?>"
                                   class="regular-text code"> <span
                                class="description"><?php _e( 'Enter a custom base to use. A base <strong>must</strong> be set or WordPress will use default instead.', 'swiftframework' ); ?></span>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <script type="text/javascript">
                    jQuery(
                        function() {
                            jQuery( 'input.sf_faqs_tog' ).change(
                                function() {
                                    jQuery( '#sf_faqs_permalink_structure' ).val( jQuery( this ).val() );
                                }
                            );

                            jQuery( '#sf_faqs_permalink_structure' ).focus(
                                function() {
                                    jQuery( '#sf_faqs_custom_selection' ).click();
                                }
                            );
                        }
                    );
                </script>
            <?php
            }

            public function settings_save() {
                if ( ! is_admin() ) {
                    return;
                }

                // Save options
                if ( isset( $_POST['permalink_structure'] ) || isset( $_POST['category_base'] ) && isset( $_POST['portfolio_permalink'] ) ) {

                    // Cat and tag bases
                    $sf_portfolio_category_slug = sanitize_text_field( $_POST['portfolio_category_slug'] );
                    $sf_galleries_category_slug = sanitize_text_field( $_POST['galleries_category_slug'] );
                    $sf_team_category_slug      = sanitize_text_field( $_POST['team_category_slug'] );
                    $sf_directory_category_slug = sanitize_text_field( $_POST['directory_category_slug'] );
                    $sf_directory_location_slug = sanitize_text_field( $_POST['directory_location_slug'] );
                    $sf_faqs_category_slug      = sanitize_text_field( $_POST['faqs_category_slug'] );

                    $port_permalinks = get_option( 'sf_portfolio_permalinks' );
                    if ( ! $port_permalinks ) {
                        $port_permalinks = array();
                    }
                    $port_permalinks['category_base'] = untrailingslashit( $sf_portfolio_category_slug );

                    $galleries_permalinks = get_option( 'sf_galleries_permalinks' );
                    if ( ! $galleries_permalinks ) {
                        $galleries_permalinks = array();
                    }
                    $galleries_permalinks['category_base'] = untrailingslashit( $sf_galleries_category_slug );

                    $team_permalinks = get_option( 'sf_team_permalinks' );
                    if ( ! $team_permalinks ) {
                        $team_permalinks = array();
                    }
                    $team_permalinks['category_base'] = untrailingslashit( $sf_team_category_slug );

                    $directory_permalinks = get_option( 'sf_directory_permalinks' );
                    if ( ! $directory_permalinks ) {
                        $directory_permalinks = array();
                    }
                    $directory_permalinks['category_base'] = untrailingslashit( $sf_directory_category_slug );
                    $directory_permalinks['location_base'] = untrailingslashit( $sf_directory_location_slug );

                    $faqs_permalinks = get_option( 'sf_faqs_permalinks' );
                    if ( ! $faqs_permalinks ) {
                        $$faqs_permalinks = array();
                    }
                    $faqs_permalinks['category_base'] = untrailingslashit( $sf_faqs_category_slug );

                    // Permalink bases
                    $portfolio_permalink = sanitize_text_field( $_POST['portfolio_permalink'] );
                    $galleries_permalink = sanitize_text_field( $_POST['galleries_permalink'] );
                    $team_permalink      = sanitize_text_field( $_POST['team_permalink'] );
                    $directory_permalink = sanitize_text_field( $_POST['directory_permalink'] );
                    $faqs_permalink      = sanitize_text_field( $_POST['faqs_permalink'] );

                    if ( $portfolio_permalink == 'custom' ) {
                        $portfolio_permalink = sanitize_text_field( $_POST['portfolio_permalink_structure'] );
                    } elseif ( empty( $portfolio_permalink ) ) {
                        $portfolio_permalink = false;
                    }
                    if ( $galleries_permalink == 'custom' ) {
                        $galleries_permalink = sanitize_text_field( $_POST['galleries_permalink_structure'] );
                    } elseif ( empty( $galleries_permalink ) ) {
                        $galleries_permalink = false;
                    }
                    if ( $team_permalink == 'custom' ) {
                        $team_permalink = sanitize_text_field( $_POST['team_permalink_structure'] );
                    } elseif ( empty( $team_permalink ) ) {
                        $team_permalink = false;
                    }
                    if ( $directory_permalink == 'custom' ) {
                        $directory_permalink = sanitize_text_field( $_POST['directory_permalink_structure'] );
                    } elseif ( empty( $directory_permalink ) ) {
                        $directory_permalink = false;
                    }
                    if ( $faqs_permalink == 'custom' ) {
                        $faqs_permalink = sanitize_text_field( $_POST['faqs_permalink_structure'] );
                    } elseif ( empty( $faqs_permalink ) ) {
                        $faqs_permalink = false;
                    }

                    // Set base for each permalinks variable
                    $port_permalinks['portfolio_base']      = untrailingslashit( $portfolio_permalink );
                    $galleries_permalinks['galleries_base'] = untrailingslashit( $galleries_permalink );
                    $team_permalinks['team_base'] = untrailingslashit( $team_permalink );
                    $directory_permalinks['directory_base'] = untrailingslashit( $directory_permalink );
                    $faqs_permalinks['faqs_base'] = untrailingslashit( $faqs_permalink );

                    // Update permalinks
                    update_option( 'sf_portfolio_permalinks', $port_permalinks );
                    update_option( 'sf_galleries_permalinks', $galleries_permalinks );
                    update_option( 'sf_team_permalinks', $team_permalinks );
                    update_option( 'sf_directory_permalinks', $directory_permalinks );
                    update_option( 'sf_faqs_permalinks', $faqs_permalinks );
                }
            }
        }

    endif;

    return new sf_post_type_permalinks();

?>
