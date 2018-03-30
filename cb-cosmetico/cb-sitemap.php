<?php
/*
 Template Name: Cosmetico Sitemap
 */

get_header();

require(get_template_directory().'/inc/cb-general-options.php');
if(!isset($hst))$hst='';
if(!isset($header_type))$header_type='';
?>
<div class="cl"></div>


<?php if($show_bread=='yes'&&$header_type!='slider_head'){ if(function_exists('yoast_breadcrumb')){ yoast_breadcrumb('<div class="bread_wrap"><div class="wrapper_p"><div id="breadcrumbs">','</div><div class="cl"></div></div></div>'); } } ?>


</div>


<div id="middle">
	<div class="wrapper_p">

		<div class="wrapper_p head_title">
		<?php echo '<h1 class="title"><a href="'.get_permalink().'" '.$hst.'>'.get_the_title().'</a></h1>'; ?>
		</div>

		<div id="post-<?php echo $post->ID; ?>">
			<p>
			
			
			<div style="width: 26%; float: left; margin-right: 10px;">
				<div>
					<h3 class="in">
					<?php _e('Pages','cb-cosmetico');?>
					</h3>
					<ul class="normal">
					<?php wp_list_pages('title_li='); ?>
					</ul>
				</div>
			</div>

			<div style="width: 38%; float: left; margin-right: 10px;">
				<div>
					<h3 class="in">
					<?php _e('Latest Posts','cb-cosmetico');?>
					</h3>
					<ul class="normal">
					<?php $aq = new WP_Query('showposts=60');
					while ($aq->have_posts()) : $aq->the_post(); ?>
						<li><a href="<?php the_permalink() ?>" rel="bookmark"
							title="<?php the_title(); ?>"><?php the_title();?> </a></li>
							<?php endwhile; ?>
					</ul>
				</div>

				<div>
					<br />
					<h3 class="in" style="margin-top: 10px;">
					<?php _e('Categories','cb-cosmetico'); ?>
					</h3>
					<ul class="normal">
					<?php wp_list_categories('title_li=&hierarchical=0&show_count=1');?>
					</ul>
				</div>
			</div>

			<div style="width: 33%; float: left;">
				<div>
					<h3 class="in">
					<?php _e('Archives','cb-cosmetico');?>
					</h3>
					<ul class="normal">
					<?php wp_get_archives('type=monthly'); ?>
					</ul>
				</div>

				<div>
					<br />
					<h3 class="in" style="margin-top: 10px;">
					<?php _e('RSS','cb-cosmetico');?>
					</h3>
					<ul class="normal">
						<li><a href="<?php bloginfo('rss_url'); ?>" title="RSS 0.92 feed"><?php _e('RSS 0.92 Feed','cb-cosmetico');?>
						</a></li>
						<li><a href="<?php bloginfo('rdf_url'); ?>"
							title="RDF/RSS 1.0 feed"><?php _e('RDF / RSS 1.0 Feed','cb-cosmetico');?>
						</a></li>
						<li><a href="<?php bloginfo('rss2_url'); ?>" title="RSS 2.0 feed"><?php _e('RSS 2.0 Feed','cb-cosmetico');?>
						</a></li>
						<li><a href="<?php bloginfo('atom_url'); ?>" title="Atom feed"><?php _e('Atom Feed','cb-cosmetico');?>
						</a></li>
					</ul>
				</div>

			</div>
			</p>
		</div>

		<div class="cl">
			<br />
		</div>

	</div>
	<!-- wrapper #end -->
</div>
<!-- middle #end -->

<div class="cl"></div>

					<?php get_footer(); ?>