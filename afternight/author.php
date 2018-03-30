<?php get_header(); ?>
<?php
    $template = 'author';
    global $wp_query;
    $curauth = $wp_query->get_queried_object();

    $author_id = $curauth->ID;
    $user_display_name = $curauth -> display_name;
?>
<section id="main">
    
    <?php echo get_my_search_form(); ?>

    <div class="main-container">
        <div class="row">
            <div class="twelve columns cat-title">
                <?php
                    
                    $user_bio = get_user_meta( $author_id, 'description',  true ); /*get the user bio*/
                    $author_website_url = get_user_meta($author_id, 'user_url', true);
                    $author_email = get_user_meta($author_id, 'user_email', true);

                    if(strlen(trim($user_bio)) || strlen(trim($author_website_url))  || strlen(trim($author_email)) ){
                ?>        
                        <div class="author-bio-box">
                            <div class="inner-content">
                                <div class="author-avatar">
                <?php
                                    echo cosmo_avatar( $author_id , 120 , DEFAULT_AVATAR ); 
                ?>
                                </div>
                                <div class="author-bio-content">
                <?php        
                                    echo '<h2>'.$user_display_name.'</h2>';

                                    
                                    if(strlen($author_website_url)){
                                        echo  '<p>'.__('Website: ','cosmotheme') .$author_website_url.'</p>';                                        
                                    }
                                    if(strlen($author_email)){
                                        echo  '<p>'.__('Email: ','cosmotheme') .$author_email.'</p>';                                        
                                    }
                                    
                                    if(strlen(trim($user_bio)) ){
                                        $order   = array("\r\n", "\n", "\r");
                                        $replace = '<br />';
                                        echo str_replace($order, $replace, $user_bio);    
                                    }
                                    
                ?>          
                                </div>  
                            </div>  
                        </div>
                <?php        
                    }

                    if( have_posts () ){
                ?>
                        <h2 >
                            <span>
                            <?php 
                                _e( 'Author archives: ' , 'cosmotheme' );  
                                echo get_the_author_meta( 'display_name' , $post-> post_author );
                            ?>
                            </span>
                        </h2>
                <?php
                    }else{
                        ?><h2 ><?php _e( 'Sorry, no posts found' , 'cosmotheme' ); ?></h2><?php
                    }
                ?> 
            </div>
        </div>
        <?php
            $layout = new LBSidebarResizer( 'author' );
            $layout -> render_frontend();
        ?>
    </div>
</section>
<?php get_footer(); ?>