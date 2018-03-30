</div>
<?php 
global $pgl_options;
 ?>
<footer>
    <div class="footer-container">
        <div class="container">
            <div class="footer-top">
                <div class="row">
                    <?php
                    if ( is_active_sidebar( 'footer-widget-area' ) && function_exists( 'dynamic_sidebar' ) ) {
                        dynamic_sidebar('footer-widget-area');
                    } else {
                        //placeholder - for demo purpose only
                        ?>
                        <div class="col-md-4 col-sm-4">
                            <h3>contact detail</h3>

                            <p>Pellentesque nec erat. Aenean semper, neque non faucibus. Malesuada, dui felis tempor felis, vel varius ante diam ut mauris. </p>

                            <p>
                                <span>Phone. 012.666.999 </span><br /><span>Fax. 012.666.999 </span><br /><span>Mail. <a href="mailto:someone@example.com?Subject=Hello%20again">Pixelgeeklab@gmail.com</a>  </span><br />
                            </p>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <h3>Useful links</h3>
                            <ul>
                                <li><a href="#" title="">Help and FAQs</a></li>
                                <li><a href="#" title="">Home Price</a></li>
                                <li><a href="#" title="">Market View</a></li>
                                <li><a href="#" title="">Free Credit Report</a></li>
                                <li><a href="#" title="">Terms and Conditions</a></li>
                                <li><a href="#" title="">Privacy Policy</a></li>
                                <li><a href="#" title="">Community Guidelines</a></li>
                            </ul>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <h3>don’t miss out</h3>
                            <p>In venenatis neque a eros laoreet eu placerat erat suscipit. Fusce cursus, erat ut scelerisque condimentum, quam odio ultrices leo.</p>
                            <div class="newletter">
                                <form>
                                    <input type="text" class="textnewletter" placeholder="Enter your email here…">
                                    <button type="submit" class="buttonnewletter">Submit</button>
                                </form>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>

            </div>
            <div class="footer-bottom">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                    <?php if ( $copy = $pgl_options->option('footer_copyright')):?>
                    <?php echo $copy; ?>
                    <?php else:?>
                    <p>Copyright © 2013 PGL RealEstate. Designed by <a href="#" title="">PixelGeekLab</a><br />All rights reserved.</p>
                    <?php endif;?>                        
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="social pull-right">
                            <ul>
                                <?php
                                if ( $link = $pgl_options->option('link_facebook')) {
                                    echo '<li><a class="facebook" title="'.__('Facebook', PGL).'" href="'.$link.'"><i class="fa fa-facebook"></i></a></li>';
                                }
                                if ( $link = $pgl_options->option('link_twitter')) {
                                    echo '<li><a class="twitter" title="'.__('Twitter', PGL).'" href="'.$link.'"><i class="fa fa-twitter"></i></a></li>';
                                }
                                if ( $link = $pgl_options->option('link_plus')) {
                                    echo '<li><a class="googplus" title="'.__('Google Plus', PGL).'" href="'.$link.'"><i class="fa fa-google-plus"></i></a></li>';
                                }
                                if ( $link = $pgl_options->option('link_pinterest')) {
                                    echo '<li><a class="pinterest" title="'.__('Pinterest', PGL).'" href="'.$link.'"><i class="fa fa-pinterest"></i></a></li>';
                                }
                                if ( $link = $pgl_options->option('link_email')) {
                                    echo '<li><a class="email" title="'.__('Email', PGL).'" href="mailto:'.$link.'"><i class="fa fa-envelope"></i></a></li>';
                                }
                                 ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<?php do_action('before_end_footer');?>
</footer>
</div>
<div class="pushy pushy-left">
	<?php
	wp_nav_menu(
		array(
			'theme-location' => 'primary_navigation',
			'walker'         => new Walker_Nav_Menu()
		)
	);
	?>
</div>
<div class="site-overlay"></div>
<div id='bttop'><span class="arrow-top"></span></div>
<?php wp_footer(); ?>
<?php do_action('before_end_page');?>
</body>
</html>