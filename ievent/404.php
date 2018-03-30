<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package iEVENT
 */

get_header(); ?>

	 <!-- BOF Main Content -->
    <div id="main" role="main" class="main">    
        <div id="primary" class="content-area">
                <div class="container">
                    <div class="sixteen columns jx-ievent-padding">
                        <div class="jx-ievent-error">
                            <div class="jx-ievent-error-msg"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'ievent' ); ?></div>
                            <div class="jx-ievent-error-code"><?php esc_html_e( '404', 'ievent' ); ?></div>
                        </div>
                    </div>
                    
                    <div class="sixteen columns small-width">
                    	 
                        <div class="jx-ievent-page-search wide bg-grey">
                                <form action="#" id="searchForm-1" method="post" class="jx-ievent-form-wrapper cf">
                                <div id="message-input-1" class="search-inline-block">
                                <input kl_virtual_keyboard_secure_input="on" id="first_name-1" name="first_name" placeholder="Search..." class="jx-ievent-form-name" type="text">
                                </div>
                                <div id="message-submit-1">
                                <button type="submit"><i class="fa fa-search"></i></button>
                                <!-- Submit Button -->	
                                </div>
                                </form>                        
                        </div>
                        <div class="row"></div>
                        <div class="row"></div>
                    </div>
                </div>
    
        </div><!-- #primary -->
    </div>

<?php get_footer(); ?>
