<?php
/**
 * @package WordPress
 * @subpackage 3D
 * @since Idea 3D
 * Graphic Desing : Ilkay ALPGIRAY
 * Code : Mustafa TANRIVERDI
 */
?>
<?php global $wpdb;	$prefix = $wpdb->prefix; ?>
<?php get_header(); ?>

<?php
$cat_title = single_cat_title('', false);
$cat_id = get_cat_ID($cat_title);
if(mysql_num_rows(mysql_query("SELECT * FROM ".$prefix."iam WHERE cat_id='$cat_id' AND value1='PORTFOLIO_CATEGORY'")) > 0){
?>


<!-- Tab Menu Slide -->
    <div class="tabmenu-back-two"></div>
    <div class="grid_24 bigtitle">
    	<h1 class="tabmenu-bigtitle-two"><strong><?php echo single_cat_title( '', false ); ?></strong></h1>
    </div>
    
    <div class="clear"></div>
    
    <!-- Portfolio Start -->
    <div class="grid_24">
    	
        <div class="portfolio">
        
        	<section class="ff-container">
			
            	<input id="select-type-all" name="radio-set-1" type="radio" class="ff-selector-type-all" checked="checked" />
				<label for="select-type-all" class="ff-label-type-all"><?php echo get_option('im_lang_portfolio_all', true); ?></label>
            
            	<?php
				$tag_name = array();
				$i = 0;
				$query_portfolio_tag = mysql_query("SELECT * FROM ".$prefix."term_relationships, ".$prefix."term_taxonomy 
				WHERE ".$prefix."term_taxonomy.term_id='$cat_id'
				AND ".$prefix."term_relationships.term_taxonomy_id=".$prefix."term_taxonomy.term_taxonomy_id");
				while($list_portfolio_tag = mysql_fetch_assoc($query_portfolio_tag))
				{
					$portfolio_id = $list_portfolio_tag['object_id'];
					
					if(array_key_exists(get_post_meta($portfolio_id, 'im_theme_portfolio_tag', true), $tag_name))
					{
						
					}
					else
					{
						$i++;
						$tag_name[get_post_meta($portfolio_id, 'im_theme_portfolio_tag', true)] = $i;	
						echo '
						<input id="select-type-'.$i.'" name="radio-set-1" type="radio" class="ff-selector-type-'.$i.'" />
						<label for="select-type-'.$i.'" class="ff-label-type-'.$i.'">'.get_post_meta($portfolio_id, 'im_theme_portfolio_tag', true).'</label>
						';
					}
				}
				?>
                
				
				<div class=" clear"></div>
				
				<ul class="ff-items">
                <?php
				$query_portfolio_tag = mysql_query("SELECT * FROM ".$prefix."term_relationships, ".$prefix."term_taxonomy 
				WHERE ".$prefix."term_taxonomy.term_id='$cat_id'
				AND ".$prefix."term_relationships.term_taxonomy_id=".$prefix."term_taxonomy.term_taxonomy_id");
   				$post_count = mysql_num_rows($query_portfolio_tag);
				
				$limit = get_option('im_theme_portfolio_amount', true);
				$git = @$_GET["pgd"];
				if(empty($git) or !is_numeric($git)) 
				{
					$git = 1;
				}

				$toplamsayfa    = ceil($post_count / $limit);
				$baslangic  = ($git-1)*$limit;

                $query_portfolio_tag = mysql_query("SELECT * FROM ".$prefix."term_relationships, ".$prefix."term_taxonomy 
				WHERE ".$prefix."term_taxonomy.term_id='$cat_id'
				AND ".$prefix."term_relationships.term_taxonomy_id=".$prefix."term_taxonomy.term_taxonomy_id
				ORDER BY ".$prefix."term_relationships.object_id DESC
				LIMIT $baslangic,$limit");
				echo mysql_error();
				while($list_portfolio_tag = mysql_fetch_assoc($query_portfolio_tag))
				{
					$portfolio_id = $list_portfolio_tag['object_id'];
					
					$fancy = get_post_meta($portfolio_id, 'im_theme_portfolio_video_url', true);
					$fancy_iframe = get_post_meta($portfolio_id, 'im_theme_portfolio_iframe_url', true);
					
					$fancy_class = '';
					$fancy_url = '';
					$fancy_s_image = '';
					
					if($fancy != '' and $fancy != 'http://')
					{
						$fancy_url = $fancy;
						$fancy_class = 'fancyvideo';
						$fancy_s_image = get_bloginfo('template_url').'/image/film.png';
					}
					else if($fancy_iframe != '' and $fancy_iframe != 'http://')
					{
						$fancy_url = $fancy_iframe;
						$fancy_class = 'fancylink';
						$fancy_s_image = get_bloginfo('template_url').'/image/link.png';
					}
					else
					{
						$fancy_url = wp_get_attachment_url( get_post_thumbnail_id($portfolio_id));	
						$fancy_class = 'fancypicture';
						$fancy_s_image = get_bloginfo('template_url').'/image/zoom.png';
					}
				?>
                		
                    <!-- PORTFOLIO ITEM -->
                    <li class="ff-item-type-<?php echo $tag_name[get_post_meta($portfolio_id, 'im_theme_portfolio_tag', true)]; ?>">
						<a href="<?php echo $fancy_url; ?>" class="<?php echo $fancy_class; ?>" title="<?php the_title(); ?>">
							<span><img src="<?php echo $fancy_s_image; ?>" width="64" height="64" alt=""></span>
                            <?php echo get_the_post_thumbnail($portfolio_id, 'homepage-portfolio'); ?>
						</a>
                        <span class="clear"></span>
                        <h1><a href="<?php echo get_permalink($portfolio_id); ?>"><?php echo mb_substr(get_the_title($portfolio_id),'0', '20','UTF-8'); ?></a></h1>
                        <p><?php echo get_post_meta($portfolio_id, 'im_theme_portfolio_description', true); ?></p>
					</li>
				<?php
				}
				?>	                  
				</ul>
			</section>
            
            <div class="clear"></div>
            
<!-- Page Navi -->
<div class="page-navi">
    <?php
		$numberOfPages = ceil($post_count / $limit);
		if($numberOfPages > 1)
		{
			for($i = 1; $i <= $numberOfPages; $i++)
			{ 
			   echo '<a href="?cat='.$cat_id.'&pgd='.$i.'" class="More3d pagenavi">'.$i.'</a>';
			} 
			$i = $i - 1; 
			if($_GET['pgd'] > $i-1)
			{ 
				echo '<a href="?cat='.$cat_id.'&pgd='.($_GET['pgd'] - 1).'" class="More3d pagenavi"> < </a>';
			} 
			elseif($i > $git)
			{
				echo '<a href="?cat='.$cat_id.'&pgd='; echo $git + 1; echo '" class="More3d pagenavi"> > </a>';
			} 
		}
		 ?>
</div> <!-- /.page-navi -->
        
        </div>
    	
    </div> 
    
    <div class="clear"></div>
    



<?php } else { ?>

	<!-- Tab Menu Slide -->
    <div class="tabmenu-back-two"></div>
    <div class="grid_24 bigtitle">
    	<h1 class="tabmenu-bigtitle-two"><strong><?php echo single_cat_title( '', false ); ?></strong></h1>
    </div>
    
    <div class="clear"></div>
		
    <?php if(get_option('im_theme_sidebar_category_lr', true) == 'LEFT')
	{
		echo '<div class="grid_6">';
			get_sidebar(); 
		echo '</div><!-- /.grid16 -->';
		
		echo '<div class="grid_16 prefix_1 bloglist-main">'; 
	} 
	else 
	{
		echo '<div class="grid_16 suffix_1 bloglist-main-two">';
	} 
	?>
    
		<?php get_template_part( 'loop', 'category' ); ?>

	</div><!-- Blog Post List .grid_18 -->
    
	
    <?php if(get_option('im_theme_sidebar_category_lr', true) == 'RIGHT')
	{
		echo '<div class="grid_6 sidebar-floatright">';
			get_sidebar(); 
		echo '</div><!-- /.grid16 prefix_1-->';
	}
	?>
	
    <div class="clear"></div> 
    
<?php } ?>    

<?php get_footer(); ?>
