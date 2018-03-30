<?php
// Template Name: Product Category
get_header(); ?>
<?php
	$id_current_category = get_meta_option('page_meta_box');
	$sidebar_id = get_meta_option('custom_sidebar');
	$type_image = 'project';
		
	?> <!--BLOG BEGIN-->
    <div id="container" class = "right_sidebar blogs"> <!--start breadcrumb-->
		<div class="wrapper">
            <div id="breadcrumb">
                <?php //the_breadcrumb(); ?>
            </div>
            
            
            
            <div id="page">
						<!-- content -->
						<div id="content">
							<div class="region">
								<article class="node">
									<h2 class="title"><?php echo esc_html(get_the_title());?></h2>
									<div class="content block">
                                    
                                    <?php get_template_part( 'loop-search', 'index' ); ?>
                                    
										<div class="item-list">
											<ul class="pager">
                                           		<?php //kama_pagenavi(); ?> 
											</ul>
										</div>
                                        
							
									</div>
								</article>
							</div>
						</div>
						<!-- end content -->
                        <div id="content_bottom banner_content_bottom">
                            <div class="region banner_m">
                                 <?php //dynamic_sidebar( 'Banner Sidebar Blog' ); ?>
                            </div>
						</div>
	
					</div>
					<!-- right sidebar -->
					<div id="right_sidebar">
						<div class="region">
							 <?php mm_sidebar('blog',$sidebar_id);?>
						</div>
					</div><!-- end right sidebar -->
    	</div>
    </div>
<?php get_footer(); ?>