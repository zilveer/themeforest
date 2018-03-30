<?php 
$alc_options = get_option('alc_general_settings');
$cats = '';
$breadcrumbs = $alc_options['alc_show_breadcrumbs'];
if (isset($post->ID))
{
	$cats =  get_post_meta($post->ID, "_page_portfolio_cat", $single = true);
}
$slider = get_post_meta($post->ID, "_chosen_slider", $single = false);
$breadcrumbs = $alc_options['alc_show_breadcrumbs'];
$titles = $alc_options['alc_show_page_titles'];?>

<?php  if ($breadcrumbs || $titles):?>
<div class="row">
    <div class="large-12 columns main-content-top">
        <div class="row">
            <div class="large-6 columns">
                <?php  if ($titles):?>
					<h2>
						<?php 
							$headline = get_post_meta($post->ID, "_headline", $single = false);
							if(!empty($headline[0]) ){echo $headline[0];}
							else{echo get_the_title();} 
						?>
					</h2>
				<?php endif?>
            </div>        
            <div class="large-6 columns">
				<?php  if ($breadcrumbs):?>
					<?php if(class_exists('the_breadcrumb')){ $albc = new the_breadcrumb; } ?>
				<?php endif?>
            </div>
        </div>
    </div>
</div>
<?php endif?>
<div class="shadow"></div>
