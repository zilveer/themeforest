<?php
/**
 * The default template for displaying posts loop
 *
 * Used for both single and index/archive/blog/search.
 *
 * @package Mango
 * @subpackage Mango
 * @since Mango 1.0
 */
?>
<?php  
		global $mango_settings, $blog_settings, $wp_query ,$thumbnail_size;  ?>
<?php
		$post_format = get_post_format();
		$catslug = '';
		$col4 = false;
		$thumbnail_size = 'large';
		
	if(!is_single()) {
		if ( $blog_settings[ 'blog_type' ] =='blog-list' ||  $blog_settings[ 'blog_type' ] == 'blog-masonry'  ||  $blog_settings[ 'blog_type' ] == 'timeline'  ) {
			$thumbnail_size = 'full';
		} elseif ( $blog_settings[ 'blog_type' ] =='classic'  ) {
			$thumbnail_size = 'full';
		}
	}
	
	foreach(get_the_category() as $category) {
		$catslug .= $category->slug . ' ';
	}
	
	if($blog_settings['blog_type']=='blog-list'){
		$class = 'entry entry-list';
	}elseif($blog_settings['blog_type']=='blog-masonry'){
		$class = 'entry entry-grid';
		
	}else{
		$class = "entry";
	}
	
	if(is_single()){
		$class = 'entry single';
	}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($class);?>>
<?php if($blog_settings['blog_type']=='blog-list' && !is_single()){?>
    <div class="row">
<?php } ?>
  <?php  if( ('video'==$post_format || 'gallery'==$post_format || 'audio'==$post_format) && !post_password_required()  ){ ?>
        <?php if($blog_settings['blog_type']=='blog-list' && !is_single()){?>
            <div class="col-md-4">
            <?php $col4 = true;
        } ?>
           <?php get_template_part('content',$post_format);  ?>
                <?php if(isset($col4) && $col4==true){?>
                </div>
                <?php } ?>
       <?php }elseif(has_post_thumbnail() && !post_password_required()){ ?>
        <?php if($blog_settings['blog_type']=='blog-list' && !is_single()){?>
            <div class="col-md-4">
            <?php $col4 = true;
          } ?>
          <?php   get_template_part("content","thumbnail"); ?>
                <?php if(isset($col4)  && $col4==true){?>
                    </div>
                <?php } ?>
        <?php }
  ?>
    <?php  if(!is_single()) { ?>
    <?php if($blog_settings['blog_type']!='timeline'){ ?>
            <?php if($blog_settings['blog_type']=='blog-list'){ ?>
                <?php if($col4==true){ $col4=false; ?>
                    <div class="col-md-8">
                <?php }else{?>
                    <div class="col-md-12">
                    <?php  } ?>
            <?php } ?>
         <div class="entry-wrapper">
        <?php } ?>
        <span class="entry-date">
            <?php $date =  get_the_date('j-M');
            $date =  explode("-",$date);
            echo esc_attr($date[0]); 
            ?>
            <span><?php  echo esc_attr($date[1]); ?></span>
        </span> 
    <?php } ?>
        <?php get_template_part("content",'link') ?>

        <?php get_template_part("content","meta") ?>
       <?php if('audio'==$post_format ){
           // get_template_part('content',$post_format);
        }?>
        <?php get_template_part("content","post") ?>
    <?php  if(!is_single()) { ?>
            <?php if($blog_settings['blog_type']!='timeline'){ ?>
                <?php if($blog_settings['blog_type']=='blog-list'){ ?>
                    </div>
                <?php } ?>
            </div><!-- End .entry-wrapper -->
        <?php } ?>
    <?php } ?>
    <?php if($blog_settings['blog_type']=='blog-list' && !is_single()){?>
        </div>
    <?php } ?>
        <?php  if(is_single()){
            mango_add_social_share();
        } ?>
</article> 