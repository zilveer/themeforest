<?php
add_image_size('portfolio-default',170,160);
add_image_size('portfolio-2-column',460,335);
add_image_size('portfolio-3-column',275,130);

if(class_exists('WC_Product')):

	class sellya_WC_Product extends WC_Product
	{
		
		function __construct($post)
		{
			parent::__construct($post);
			
		}	
		
	}

endif;

function getLatestWork(){
    $query = new WP_Query('post_type=portfolio&order=DESC&post_status=publish&posts_per_page=1&order=desc');
    if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
      $excerpt=get_the_excerpt();
      $excerpt_content= sds_custom_excerpt($excerpt,132);
?>
            
            <p><?php echo $excerpt_content.'...'; ?></p>
            <span><a href="<?php get_permalink(get_the_ID());?>">View Portfolio</a></span>
            <?php
            
        endwhile;
    endif;
    wp_reset_query();
}

function getTeam($showteam,$team_order){
	
    $query = new WP_Query('post_type=team&post_status=publish&posts_per_page='.$showteam.'&order='.$team_order);
	$i = 0;
	
	$baseurl = get_template_directory_uri();
	
	$bg = sprintf("%s/image/staff.png",$baseurl);
	
    if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();

        $image_id = get_post_thumbnail_id(get_the_ID());
		
        $image_url = wp_get_attachment_image_src($image_id, 'full', true);
		$team= get_post_custom(get_the_ID(),'swpf_team_metabox');
		$shortdesc = $team["shortdesc"][0];
		$facebook = $team['facebook'][0];
		$twitter = $team['twitter'][0];
		$google = $team['google'][0];
		$rss = $team['rss'][0];
		$pinterest = $team['pinterest'][0];
		$vimeo = $team['vimeo'][0];
		$flickr = $team['flickr'][0];
?>     		
         <div class="span3<?php echo ($i%4 == 0)?" span-first-child":""?>">
            <ul class="ch-grid" >
                <li>                	
                    <div class="ch-item ch-img-1" style="background:url('<?php echo (!empty($image_id)) ? $image_url[0] : $bg;?>') no-repeat;">                        
                        <div class="ch-info imgWrapper">
                
                            <h3><?php the_title();?></h3>
                            <p><?php echo $shortdesc;?></p>
                        </div>
                    </div>
                </li>
           </ul>
           
            <div class="list_style member_social">
            	<?php if(!empty($facebook)):?>
                
                    <a target="_blank" class="tiptip" title="Facebook" href="<?php echo $facebook?>"><img title="Facebook" alt="Facebook" src="<?php echo get_template_directory_uri()?>/image/follow_us/f_logo_16x16.png"></a>

                <?php endif;?>
                <?php if(!empty($twitter)):?>
                
                    <a target="_blank" class="tiptip" title="Twitter" href="<?php echo $twitter?>"><img title="Twitter" alt="Twitter" src="<?php echo get_template_directory_uri()?>/image/follow_us/t_logo_16x16.png"></a>
                
                <?php endif;?>
                <?php if(!empty($google)):?>
                
                    <a target="_blank" class="tiptip" title="Google+" href="<?php echo $google?>"><img title="Google+" alt="Google+" src="<?php echo get_template_directory_uri()?>/image/follow_us/g_logo_16x16.png"></a>
                
                <?php endif;?>
                <?php if(!empty($rss)):?>
                
                    <a target="_blank" class="tiptip" title="RSS" href="<?php echo $rss?>"><img title="RSS" alt="RSS" src="<?php echo get_template_directory_uri()?>/image/follow_us/r_logo_16x16.png"></a>
                
                <?php endif;?>
                <?php if(!empty($pinterest)):?>
                
                    <a target="_blank" class="tiptip" title="Pinterest" href="<?php echo $pinterest?>"><img title="Pinterest" alt="Pinterest" src="<?php echo get_template_directory_uri()?>/image/follow_us/p_logo_16x16.png"></a>
                
                <?php endif;?>
                <?php if(!empty($vimeo)):?>
                
                    <a target="_blank" class="tiptip" title="Vimeo" href="<?php echo $vimeo?>"><img title="Vimeo" alt="Vimeo" src="<?php echo get_template_directory_uri()?>/image/follow_us/v_logo_16x16.png"></a>
                
                <?php endif;?>
                <?php if(!empty($flickr)):?>
                
                    <a target="_blank" class="tiptip" title="Flickr" href="<?php echo $flickr?>"><img title="Flickr" alt="Flickr" src="<?php echo get_template_directory_uri()?>/image/follow_us/fl_logo_16x16.png"></a>
                
                <?php endif;?>
                
            
            </div>
                         <!-- End Thumb Container -->
			           
			<div class="desc"><?php the_content();?></div>
        </div><!--.span3 -->
          
         <?php
		$i++;
        endwhile;
	else:
	
		echo "<p>No staffs have been found...</p>";
	
    endif;
    wp_reset_query();
}

function get_portfolio_categories() {
    $terms = get_terms("portfolio-types");
    $count = count($terms);
    echo '<ul id="filters" class="option-set clearfix" data-option-key="filter">';
    echo '<li><a href="#filter"data-option-value="*" title="">All</a></li>';
    if ($count > 0) {

        foreach ($terms as $term) {

            $termname = strtolower($term->name);
            $termname = str_replace(' ', '-', $termname);
     
            echo '<li> / <a href="#filter" data-option-value=".'.$termname.'" title="" rel="' . $termname . '">' . $term->name . '</a></li>';
        }
    }
    echo "</ul>";
}

// function get_portfolio_terms() returns terms of a portfolio

function get_portfolio_terms($post_id)
{	
	$terms = get_the_terms($post_id, 'portfolio-types');

	if ($terms && !is_wp_error($terms)) :
		$links = array();

		foreach ($terms as $term) {
			$links[] = $term->name;
		}
		$links = str_replace(' ', '-', $links);
		$tax = join(" ", $links);
	else :
		$tax = '';
	endif;
	
	return $tax;
}

function get_filterable_portfolio() {

    $query = new WP_Query();
    $query->query('post_type=portfolio&posts_per_page=-1');
	$i = 0;
	
    if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();

			$postid = get_the_ID();
    
            $tax = get_portfolio_terms($postid);
            
            $url = wp_get_attachment_url(get_post_thumbnail_id($postid));
			
            $class=strtolower($tax);
          
                $image_id = get_post_thumbnail_id(get_the_ID());
                $image_url = wp_get_attachment_image_src($image_id, 'portfolio-3-column', true);
           
		   		$img_attr = array('class'=>'iframe');
		   
       ?>  
                <?php  
                  $excerpt=substr(strip_tags( get_the_excerpt()),0,100);
                ?>
                 <div class="portfolio-two portfolio-three span3 <?php echo ($i%4==0)?'span-first-child':'' ?> element motion mosaic-block views <?php echo $class; ?>" data-category="<?php echo $class; ?>" style="width:210px">
                 
                    <a href="<?php echo $image_url[0]; ?>" title="<?php the_title();?>" class="mosaic-overlay"><?php the_post_thumbnail('portfolio-3-column',$img_attr)?></a>
                    
                    
					<div class="whole">
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <?php                            
                        echo '<p>'.$excerpt.'</p>';                           
                        ?>                        
                        
                    </div> 
                </div><!--end:portfolio-three-->
            <?php
		$i++;
        endwhile;
        endif;
    wp_reset_query();
}
function getPortfolio($per_page,$columns = false,$showText = true) {
    global $post;
    global $paged;
    $query = new WP_Query('post_type=portfolio&posts_per_page=' . $per_page.'&paged='.$paged);
    $i=0;
	
	echo "<div id='works-container' class='portfolio-slides'>";
	
    if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();

			$tax = get_portfolio_terms($post->ID);
			
			$class=strtolower($tax);
			
            $url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
			

			$image_id = get_post_thumbnail_id(get_the_ID());
			$image_url = wp_get_attachment_image_src($image_id, 'large', true);
				
            $excerpt_content = $post->post_excerpt;   
            
            if ($columns == 2):
                $excerpt=substr(strip_tags( get_the_excerpt()),0,255);
              ?>
                <div class="portfolio-two span6 <?php echo ($i%2==0)?'span-first-child':'row-last' ?> element motion mosaic-block views <?php echo $class; ?>" data-category="<?php echo $class; ?>" style="width:440px;">
                    <a href="<?php echo ($image_id)?$image_url[0]:"#"; ?>" title="<?php the_title();?>" class="<?php if($image_id) echo 'mosaic-overlay';?>"><?php the_post_thumbnail(array(440,248)); ?></a>
                    <?php 
					if($showText):
					?>
                    <div>
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <?php 
                            if($excerpt_content):
                                echo '<p>'. $excerpt_content.'</p>';
                            else:
                                echo '<p>'.$excerpt.'</p>';
                            endif;
                          ?>
                       
                    </div>
                    <?php 
					else:
					echo "<div><p></p></div>";
					endif;
					?>
                </div><!--end:portfolio-two-->
             <?php
            elseif ($columns == 3):
                 $excerpt=substr(strip_tags( get_the_excerpt()),0,100);
                ?>
                 <div class="portfolio-two portfolio-three span4 <?php echo ($i%3==0)?'span-first-child':'' ?> element motion mosaic-block views <?php echo $class; ?>" data-category="<?php echo $class; ?>" style="width:285px;">
                   <a href="<?php echo ($image_id)?$image_url[0]:"#"; ?>" title="<?php the_title();?>" class="<?php if($image_id) echo 'mosaic-overlay';?>"><?php the_post_thumbnail(array(287,162))?></a>
                    
                    <?php 
					if($showText):
					?>
                    <div class="whole">
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <?php 
                            if($excerpt_content):
                                echo '<p>'. $excerpt_content.'</p>';
                            else:
                                echo '<p>'.$excerpt.'</p>';
                            endif;
                          ?>
                       
                    </div>
                    <?php 
					else:
					echo "<div><p></p></div>";
					endif;
					?>
                </div><!--end:portfolio-three-->
                 
            <?php
            else:
                 $excerpt=substr(strip_tags( get_the_excerpt()),0,100);
                ?>
                 <div class="portfolio-two portfolio-three span3 <?php echo ($i%4==0)?'span-first-child':'' ?> element motion mosaic-block views <?php echo $class; ?>" data-category="<?php echo $class; ?>" style="width:210px">
                    <a href="<?php echo ($image_id)?$image_url[0]:"#"; ?>" title="<?php the_title();?>" class="<?php if($image_id) echo 'mosaic-overlay';?>"><?php the_post_thumbnail(array(211,124))?></a>
                    
                    <?php 
					if($showText):
					?>
                    <div class="whole">
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <?php 
                            if($excerpt_content):
                                echo '<p>'. $excerpt_content.'</p>';
                            else:
                                echo '<p>'.$excerpt.'</p>';
                            endif;
                          ?>
                       
                    </div>
                    <?php
					else:
					echo "<div><p></p></div>"; 
					endif;
					?>
                </div><!--end:portfolio-three-->
                
              <?php 
           endif;
            
           $i++;
        endwhile;
          
    endif;
    
	echo '</div>';
	
	swpf_pagination($query->max_num_pages);
	
    wp_reset_query();
}
function getTestimonials($per_page) {
	global $paged;
    $query = new WP_Query("post_type=testimonial&order=DESC&post_status=publish&posts_per_page=$per_page&paged=$paged");
	
	$row_count =1;
	
	$altimg = sprintf("%s/image/man.png",get_template_directory_uri());
	
	
   if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();  
      $image_id = get_post_thumbnail_id(get_the_ID());
      $image_url = wp_get_attachment_image_src($image_id, 'large', true);
      global $post; 
      
            $by_testimonial=get_post_meta($post->ID,'testimonial_by',true);
            $url=get_post_meta($post->ID,'testimonial_url',true);
            $from_testimonial=get_post_meta($post->ID,'testimonial_from',true);
            //$excerpt=substr(strip_tags( get_the_excerpt()),0,150);
			
			$excerpt = get_sellya_blog_short_text(get_the_content());
            ?>  
     
             <div class="row-fluid testimonial_row" ><!--start:row-fluid--> 
                 
                  
                        <div class="first span3">
                        <center>
                            <img src="<?php echo (!empty($image_id)) ? $image_url[0] : $altimg; ?>" alt="Tesimonial"  />
                            </center>
                        </div> 
                        <div class="span7">
                             <div class="blockQuote">
                                      <span class="quot1"></span>
                                      <?php echo $excerpt; ?>
                                      <span class="quot2"></span>
                              </div>
                             <div class="second">  <br /><br /> 
                  
                  				<?php 
								
								$urllink = $url;
								
								if(!empty($urllink)):
								
									if(!preg_match("/http(|s):\/\//",$urllink)):
									
										$urllink = "http://".$url;
									
									else:
									
										$url = preg_replace("/http(|s):\/\//","",$url);
									
									endif; 
								
								endif;
								?>
                  
                                <span class='author'><?php echo $by_testimonial; ?> 
                                <?php if(!empty($from_testimonial)) echo ", $from_testimonial"; ?></span> 
                                <?php if(!empty($url)) echo ", <a target='_blank' href='$urllink'>$url</a>";?>
                                
                            </div>
                         </div> 
                  
                        
                      
             	</div><!--end:row-fluid-->
                         
        <?php
		$row_count++;
        endwhile;
		swpf_pagination($query->max_num_pages);
		
    endif;

    wp_reset_query();
}
function getFaqsTitle($per_page = -1) {
	
	$query = new WP_Query("post_type=faqs&order=DESC&post_status=publish&posts_per_page=$per_page");
	
	$row_count = 1;
	
	if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();  
	  
      global $post; 
       
	  ?> 
      <li><h4><a href="<?php the_permalink()?>"><?php the_title();?></a></h4></li>         
      <?php
		$row_count++;
        endwhile;
		
    endif;

    wp_reset_query();
}

function getFaqsGeneralQuestion($per_page = -1) {
	
	$query = new WP_Query("post_type=faqs&order=DESC&post_status=publish&posts_per_page=$per_page");
	
	$row_count = 1;
	
	if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();  
      
		global $post; 
       
	  ?>          
        <li><h4><a href="#<?php echo "faq-$row_count"?>">&raquo; <?php the_title();?></a></h4></li>
      <?php
		$row_count++;
        endwhile;
		
    endif;

    wp_reset_query();
}
function getFaqsGeneralAnswer($per_page = -1) {
	
	$query = new WP_Query("post_type=faqs&order=DESC&post_status=publish&posts_per_page=$per_page");
	
	$row_count = 1;
	
	
	if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();  
      
		global $post; 
       
	  ?>          
        <div id="faq-<?php echo $row_count;?>" class="details">     		
        	<h6><?php the_content();?></h6>
        </div>       
      <?php
		$row_count++;
        endwhile;
		
    endif;

    wp_reset_query();
}
function getFaqsAccordion($per_page = -1) {
	
	$query = new WP_Query("post_type=faqs&order=DESC&post_status=publish&posts_per_page=$per_page");
	
	$row_count = 1;
	
	
	if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();  
      
		global $post; 
       
	  ?>          
        <h4><?php the_title();?></h4>
		<div class="toggleText"><?php the_content();?></div>
      <?php
		$row_count++;
        endwhile;
		
    endif;

    wp_reset_query();
}


function swpf_pagination($pages, $range=2){

    $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
       
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo '<ul class="pagination">';
         echo  '<li class="page">Page '.$paged.' of '.$pages.'</li>';
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."'>First</a></li>";
         if($paged > 1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged - 1)."'>&laquo;</a></li>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<li><a href='#' class='active'>" .$i."</a></li>":"<li><a href='".get_pagenum_link($i)."'  >".$i."</a></li>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged + 1)."'>&raquo;</a></li>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."'>Last</a></li>";
         echo "</ul>";
     }
    
}


function sds_custom_excerpt($content,$limit){		
        $custom_cont= substr($content,0,$limit); 
        return $custom_cont;		
}



function getLatestBlogPost() {
    $query = new WP_Query('posts_per_page=2&ignore_sticky_posts=1&order=DESC&post_status=publish');
    if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
            ?>

            <li>
                <?php if ((function_exists('has_post_thumbnail') && has_post_thumbnail($id))) {
                    ?>
                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
                <?php } ?>
                <span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
                <small><?php echo the_time(get_option( 'date_format' )); ?></small>
            </li>
            <?php
        endwhile;
    endif;
    wp_reset_query();
}

function getTestimonialspage($per_page) {
    $query = new WP_Query('post_type=testimonial&order=DESC&post_status=publish&posts_per_page=' . $per_page);
    if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
            ?>
            <li>
                <div class="t-image">
                    <div class="inner">
                        <a id="author-name" href="#"> <?php the_post_thumbnail(); ?></a>
                    </div>
                </div>
                <div class="t-content">
                    <h4><?php the_title(); ?></h4>
                    <p><?php the_content(); ?></p>
                    <div class="arrow">&nbsp;</div>
                    <div class="t-author">
                        <span>By: <?php echo get_post_meta(get_the_ID(), 'testimonial', true); ?></span>
                    </div>
                </div>
            </li>

        <?php
        endwhile;
    endif;

    wp_reset_query();
}
?>
