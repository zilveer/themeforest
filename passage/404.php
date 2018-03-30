<?php 
global $qode_options_passage; 

$title_in_grid = false;
if(isset($qode_options_passage['title_in_grid'])){
if ($qode_options_passage['title_in_grid'] == "yes") $title_in_grid = true;
}

?>	

<?php get_header(); ?>
			<div class="title animate" >
				<?php if($title_in_grid){ ?>
				<div class="container">
					<div class="container_inner clearfix">
				<?php } ?>
				<h1><?php if($qode_options_passage['404_title'] != ""): echo $qode_options_passage['404_title']; else: ?> <?php _e('404', 'qode'); ?> <?php endif;?></h1>	
				<?php if($title_in_grid){ ?>
					</div>
				</div>
				<?php } ?>
			</div>
			<div class="container top_move">
				<div class="container_inner">
					<div class="container_inner2 clearfix">
						<div class="page_not_found">
							<h2><?php if($qode_options_passage['404_text'] != ""): echo $qode_options_passage['404_text']; else: ?> <?php _e('Page not found', 'qode'); ?> <?php endif;?></h2>
							<p><a href="<?php echo home_url(); ?>/"><?php if($qode_options_passage['404_backlabel'] != ""): echo $qode_options_passage['404_backlabel']; else: ?> <?php _e('Back to homepage', 'qode'); ?> <?php endif;?></a></p>
						</div>
					</div>
				</div>
			</div>
			
<?php get_footer(); ?>	