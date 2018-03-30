<?php
get_header();
$cv = implode(' ', jwLayout::content_width());
?>

<!-- Row for main content area -->
<div id="content" class="<?php echo $cv; ?> builder-section" role="main">
    <div class="post-box  row ">
        <div   class="<?php echo $cv; ?> builder-section" > 
            <div class="row ">
                <div   class="<?php echo $cv; ?>" > 
                    <?php
                    echo jwOpt::get_option('error_custom_html', '
				<h1>File Not Found</h1>
				<div class="error">
					<p class="bottom">The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>
				</div>
				<p>Please try the following:</p>
				<ul> 
					<li>Return to the <a href="' . SITE_URL . '">home page</a></li>
				</ul>
			');
                    ?> 
                </div>
            </div>
            <div class="row ">
                <div   class="col-lg-3" > 
                    <?php echo __('Search:', 'jawtemplates');?>
                    <?php get_search_form(); ?>	 
                </div>
            </div>
        </div>
    </div><!-- End postbox -->
</div><!-- End Content row -->
<?php get_sidebar(); ?>

<?php
get_footer();
