<?php 
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	get_header();
	wp_reset_query();

	if (df_is_template_active("template-contact.php")) {
		$contactPages = df_get_page("contact");
		if($contactPages[0]) {
			$contactUrl = get_page_link($contactPages[0]);
		}
	} else {
		$contactUrl = false;
	}
?>
            <!-- Section -->
            <section>
                <div class="container">
                    <div class="row">
                        <!-- Main content -->
                        <div class="col col_12_of_12">
                            <!-- Page title -->
                            <h1 class="page_title"><?php esc_html_e("Page not found",THEME_NAME);?></h1><!-- End Page title -->
                            <!-- 404 Page -->
                            <div class="page_404">
                                <h3><?php esc_html_e("404",THEME_NAME);?></h3>
                                <h4><?php esc_html_e("Something went terribly wrong...",THEME_NAME);?></h4>
                                <p>
                                	<?php esc_html_e("But don't worry, it can happen to the best of us - and it just happen to you!",THEME_NAME);?><br>
                               		<?php esc_html_e("You can search something else or read this text one more time.",THEME_NAME);?>
                               	</p>
			                    <form method="get" action="<?php echo esc_url(home_url());?>">
			                        <input type="text" placeholder="<?php esc_attr_e("Type and press enter...", THEME_NAME);?>" name="s" id="s"/>
			                    </form>
                            </div><!-- End 404 Page -->
                        </div><!-- End Main content -->
                    </div>
                </div>
            </section><!-- End Section -->
<?php get_footer(); ?>