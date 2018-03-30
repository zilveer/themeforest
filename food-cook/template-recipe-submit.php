<?php
/*
 * Template Name: Submit Recipes Template
 */
get_header();
global $woo_options, $current_user;
?>

<!-- #content Starts -->
<?php woo_content_before(); ?>

<div id="content" class="col-full">

    <div id="main-sidebar-container">

        <!-- #main Starts -->
        <?php woo_main_before(); ?>

        <div id="main" class="col-left">

            <?php woo_loop_before(); ?>

            <?php
            $show_message = false;

            if ('POST' == $_SERVER['REQUEST_METHOD'] && !empty($_POST['action']) && $_POST['action'] == "submit-recipe") {

                $title = $_POST['title'];
                $short_description = $_POST['short-description'];
                $description = $_POST['description'];

                // ADD THE FORM INPUT TO $new_recipe ARRAY
                $new_recipe = array(
                    'post_title' => $title,
                    'post_content' => $description,
                    'post_excerpt' => $short_description,
                    'post_status' => 'pending', // Choose: publish, pending, future, draft, etc.
                    'post_type' => 'recipe'
                );

                if (is_user_logged_in()) {
                    wp_get_current_user();
                    $new_recipe['post_author'] = $current_user->ID;
                }

                //SAVE THE POST
                $recipe_id = wp_insert_post($new_recipe);

                // Attache Post Meta
                if (isset($_POST['youtube']))
                    add_post_meta($recipe_id, 'RECIPE_META_youtube', $_POST['youtube'], true);

                if (isset($_POST['vimeo']))
                    add_post_meta($recipe_id, 'RECIPE_META_vimeo', $_POST['vimeo'], true);

                if (isset($_POST['yield']))
                    add_post_meta($recipe_id, 'RECIPE_META_yield', $_POST['yield'], true);

                if (isset($_POST['servings']))
                    add_post_meta($recipe_id, 'RECIPE_META_servings', $_POST['servings'], true);

                if (isset($_POST['prep-time']))
                    add_post_meta($recipe_id, 'RECIPE_META_prep_time', $_POST['prep-time'], true);

                if (isset($_POST['cook-time']))
                    add_post_meta($recipe_id, 'RECIPE_META_cook_time', $_POST['cook-time'], true);

                if (isset($_POST['ready-in']))
                    add_post_meta($recipe_id, 'RECIPE_META_ready_in', $_POST['ready-in'], true);

                if (isset($_POST['ingredients']))
                    add_post_meta($recipe_id, 'RECIPE_META_ingredients', $_POST['ingredients'], true);

                if (isset($_POST['method']))
                    add_post_meta($recipe_id, 'RECIPE_META_method_steps', $_POST['method'], true);

                if (isset($_POST['nutName']))
                    add_post_meta($recipe_id, 'RECIPE_META_nut_name', $_POST['nutName'], true);

                if (isset($_POST['nutVal']))
                    add_post_meta($recipe_id, 'RECIPE_META_nut_mass', $_POST['nutVal'], true);

                // Attach Recipe Taxonomies to created recipe
                if (isset($_POST['recipe-type']) && ($_POST['recipe-type'] != "-1"))
                    wp_set_object_terms($recipe_id, intval($_POST['recipe-type']), 'recipe_type');

                if (isset($_POST['skill-level']) && ($_POST['skill-level'] != "-1"))
                    wp_set_object_terms($recipe_id, intval($_POST['skill-level']), 'skill_level');

                if (isset($_POST['cuisine']) && ($_POST['cuisine'] != "-1"))
                    wp_set_object_terms($recipe_id, intval($_POST['cuisine']), 'cuisine');

                if (isset($_POST['course']) && ($_POST['course'] != "-1"))
                    wp_set_object_terms($recipe_id, intval($_POST['course']), 'course');

                if (isset($_POST['calories']) && ($_POST['calories'] != "-1"))
                    wp_set_object_terms($recipe_id, intval($_POST['calories']), 'calories');

                if (isset($_POST['ingredient']) && ($_POST['ingredient'] != "-1"))
                    wp_set_object_terms($recipe_id, intval($_POST['ingredient']), 'ingredient');

                if ($_FILES) {
                    $size = intval($_FILES['recipe-image']['size']);
                    if ($size > 0) {
                        foreach ($_FILES as $file => $array) {
                            $newupload = woo_fnc_insert_attachment($file, $recipe_id, true);
                            // $newupload returns the attachment id of the file that
                            // was just uploaded. Do whatever you want with that now.
                        }
                    }
                }

                //REDIRECT TO THE NEW POST ON SAVE
                //$link = get_permalink( $recipe_id );
                //wp_redirect( $link );

                $show_message = true;
            } // END THE IF STATEMENT THAT STARTED THE WHOLE FORM
            //POST THE POST YO
            do_action('wp_insert_post', 'wp_insert_post');

            get_header();
            ?>

            <div class="main">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <div>
                            <?php
                            if (has_post_thumbnail()) {
                                ?>
                                <div class="post-thumb single-img-box sub-img">
                                    <a rel="prettyPhoto" title="<?php the_title(); ?>" href="<?php
                                    $image_id = get_post_thumbnail_id();
                                    $image_url = wp_get_attachment_image_src($image_id, 'full-size', true);
                                    echo $image_url[0];
                                    ?>">
                                           <?php
                                           get_the_image(array(
                                               'order' => array('featured', 'default'),
                                               'featured' => true,
                                               'default' => esc_url(get_template_directory_uri() . '/includes/assets/images/image.jpg'),
                                               'size' => 'full',
                                               'link_to_post' => false
                                           ));
                                           ?>
                                    </a>
                                </div>
                                <?php get_template_part('includes/cook-info'); ?>
                                <h1 class="title"><?php the_title(); ?></h1>
                                <?php
                            }

                            the_content();
                            ?>

                        </div><!-- end of post div -->

                    <?php endwhile; ?>

                <?php endif; ?>

                <?php
                if (is_user_logged_in()) {
                    if (!$show_message) {
                        ?>

                        <form id="recipe-form" name="recipe-form" method="post"  enctype="multipart/form-data">
                            <fieldset class="outer">

                                <fieldset>
                                    <h3 class="title-recipe"><?php _e('Recipe Detail', 'woothemes'); ?></h3>
                                    <div class="outer-form">
                                        <!-- recipe title -->
                                        <fieldset class="in-set">

                                            <label for="title"><?php _e('Recipe Title', 'woothemes'); ?>
                                            </label>
                                            <input type="text" value="" tabindex="15" name="title" class="required input-title" title="insert your title here"/>
                                        </fieldset>
                                        <fieldset class="in-set">
                                            <label for="short-description"><?php _e('Short Description', 'woothemes'); ?>

                                            </label>
                                            <textarea id="short-description" tabindex="16" name="short-description" class="required" title="insert your description here"></textarea>
                                        </fieldset>

                                        <fieldset class="in-set">

                                            <div class="half">
                                                <label for="yield"><?php _e('Yield', 'woothemes'); ?>

                                                </label>
                                                <input type="text" id="yield" value="" tabindex="19" name="yield" title="insert your yield here. eg: 2 people"/>
                                            </div>
                                            <div class="half">
                                                <label for="servings"><?php _e('Servings', 'woothemes'); ?>

                                                </label>
                                                <input type="text" id="servings" value="" tabindex="20" name="servings" title="insert your serving here. eg: 2 people"/>
                                            </div>


                                        </fieldset>

                                        <fieldset class="in-set">

                                            <div class="third">
                                                <label for="prep-time"><?php _e('Prep Time', 'woothemes'); ?>
                                                </label>
                                                <input type="text" id="prep-time" value="" tabindex="21" name="prep-time" title="Specify the time in minutes and value greater than 60 will be automatically displayed in hours."/>
                                            </div>
                                            <div class="third">
                                                <label for="cook-time"><?php _e('Cook Time', 'woothemes'); ?>
                                                </label>
                                                <input type="text" id="cook-time" value="" tabindex="22" name="cook-time" title="Specify the time in minutes and value greater than 60 will be automatically displayed in hours."/>

                                            </div>
                                            <div class="third">

                                                <label for="ready-in"><?php _e('Ready In', 'woothemes'); ?>
                                                </label>
                                                <input type="text" id="ready-in" value="" tabindex="23" name="ready-in" title="Specify the time in minutes and value greater than 60 will be automatically displayed in hours."/>
                                            </div>

                                        </fieldset>

                                    </div>
                                </fieldset>
                                <!-- recipe content -->
                                <fieldset>
                                    <h3 class="title-recipe"><?php _e('Post Content', 'woothemes'); ?></h3>
                                    <div class="outer-form">
                                        <fieldset class="in-set">
                                            <!-- recipe featured image -->

                                            <label for="featured-image"><?php _e('Featured Image', 'woothemes'); ?>

                                                <em class="fa fa-question tltip tip">
                                                    <div class="tooltip"><p><?php _e('You can upload your pictures below.', 'woothemes'); ?></p></div>
                                                </em>
                                            </label>
                                            <input   type="file" name="recipe-image"  size="18" tabindex="1">

                                        </fieldset>
                                        <label for="description"><?php _e('Recipe Content', 'woothemes'); ?>

                                            <em class="fa fa-question tltip tip2">
                                                <div class="tooltip"><p><?php _e('You can fill your content below.', 'woothemes'); ?></p></div>
                                            </em>
                                        </label>
                                        <div class="wys">
                                            <?php
                                            $settings = array(
                                                'tabindex' => 17,
                                                'editor_class' => '',
                                                'media_buttons' => false
                                            );

                                            wp_editor('', 'description', $settings);
                                            ?>

                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <h3 class="title-recipe"> <?php _e('Ingredients', 'woothemes'); ?>
                                        <em class="fa fa-question tltip tip3" >
                                            <div class="tooltip"><p><?php _e('You can add your recipe ingredients below (this field is required).', 'woothemes'); ?></p></div>
                                        </em>
                                    </h3>
                                    <div class="outer-form">
                                        <fieldset class="in-set">

                                            <div class="rwmb-input">
                                                <label for="ready-in"><?php _e('add your ingredient by clicking plus buttom', 'woothemes'); ?>

                                                </label>

                                                <div  class="rwmb-clone"><input type="textarea" value="" tabindex="23" name="ingredients[]" class="required"/>
                                                    <button class="remove-clone" ><em class="fa fa-remove"></em></button>
                                                </div>
                                                <button class="add-clone"  ><em class=" fa fa-plus"></em></button>
                                            </div>
                                        </fieldset>

                                    </div>
                                </fieldset>

                                <fieldset>
                                    <h3 class="title-recipe"> <?php _e('Instructions', 'woothemes'); ?>
                                        <em class="fa fa-question tltip tip4" >
                                            <div class="tooltip"><p><?php _e('You can add your text recipe instruction below (this field is required).', 'woothemes'); ?></p></div>
                                        </em>
                                    </h3>
                                    <div class="outer-form">
                                        <fieldset class="in-set">
                                            <div class="rwmb-input">
                                                <label for="ready-in"><?php _e('Method Step', 'woothemes'); ?>

                                                </label>
                                                <div  class="rwmb-clone"><input type="textarea" value="" tabindex="23" name="method[]" class="required"/>
                                                    <button class="remove-clone"><em class="fa fa-remove "></em></button>
                                                </div>
                                                <button class="add-clone" title="Click for add more ingredients"><em class=" fa fa-plus"></em></button>
                                            </div>
                                        </fieldset>
                                        <h3 class="title-recipe"> <?php _e('Add Video', 'woothemes'); ?>
                                            <em class="fa fa-question tltip tip5" >
                                                <div class="tooltip"><p><?php _e('You can add your video from youtube or vimeo below.', 'woothemes'); ?></p></div>
                                            </em>
                                        </h3>

                                        <fieldset class="in-set">
                                            <div class="half">
                                                <label for="ready-in"><?php _e('Id youtube video', 'woothemes'); ?>

                                                </label>
                                                <input type="text"  value="" tabindex="23" name="youtube" />
                                            </div>
                                            <div class="half">

                                                <label for="ready-in"><?php _e('Id vimeo video', 'woothemes'); ?>
                                                </label>
                                                <input type="text"   value="" tabindex="23" name="vimeo" />
                                            </div>
                                        </fieldset>
                                    </div>
                                </fieldset>

                                <fieldset >
                                    <h3 class="title-recipe"><?php _e('Nutrition Info', 'woothemes'); ?></h3>
                                    <div class="outer-form">
                                        <fieldset class="in-set">
                                            <div class="oneThird">
                                                <div class="rwmb-input">
                                                    <label for="ready-in"><?php _e('Nutrition Value', 'woothemes'); ?>
                                                        <em class="fa fa-question tltip tip6" >
                                                            <div class="tooltip"><p><?php _e('Add your nutrition mass below (eg 120g).', 'woothemes'); ?></p></div>
                                                        </em>
                                                    </label>
                                                    <div  class="rwmb-clone"><input type="text" value="" tabindex="23" name="nutVal[]" />
                                                        <button class="remove-clone"><em class="fa fa-remove"></em></button>
                                                    </div>
                                                    <button class="add-clone" title="Click for add more ingredients"><em class=" fa fa-plus"></em></button>
                                                </div>

                                            </div>
                                            <div class="twoThird ">
                                                <div class="rwmb-input">
                                                    <label for="ready-in"><?php _e('Nutrition Name', 'woothemes'); ?>
                                                        <em class="fa fa-question tltip tip7" >
                                                            <div class="tooltip"><p><?php _e('Add your nutrition name below (eg natrium).', 'woothemes'); ?></p></div>
                                                        </em>
                                                    </label>
                                                    <div  class="rwmb-clone"><input type="text" value="" tabindex="23" name="nutName[]" />
                                                        <button class="remove-clone"><em class="fa fa-remove"></em></button>
                                                    </div>
                                                    <button class="add-clone" title="Click for add more ingredients"><em class=" fa fa-plus"></em></button>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </fieldset>

                                <fieldset class="last-field">
                                    <h3 class="title-recipe"><?php _e('Categorize your recipe', 'woothemes') ?>
                                        <em class="fa fa-question tltip tip8">
                                            <div class="tooltip"><p><?php _e('Select your category recipe below.', 'woothemes'); ?></p></div>
                                        </em>
                                    </h3>
                                    <div class="outer-form">


                                        <fieldset class="in-set">
                                            <div class="half">
                                                <div class="clearfix">
                                                    <label for="recipe-type"><?php _e('Recipe Type', 'woothemes'); ?>

                                                    </label>
                                                    <?php wp_dropdown_categories('tab_index=25&taxonomy=recipe_type&name=recipe-type&show_option_none=None&hide_empty=0'); ?>
                                                </div>
                                            </div>
                                            <div class="half">

                                                <div class="clearfix">
                                                    <label for="cuisine"><?php _e('Cuisine', 'woothemes'); ?>
                                                    </label>
                                                    <?php wp_dropdown_categories('tab_index=26&taxonomy=cuisine&name=cuisine&show_option_none=None&hide_empty=0'); ?>
                                                </div>
                                            </div>

                                        </fieldset>


                                        <fieldset class="in-set">
                                            <div class="half">

                                                <div class="clearfix">
                                                    <label for="course"><?php _e('Course', 'woothemes'); ?>
                                                    </label>
                                                    <?php wp_dropdown_categories('tab_index=27&taxonomy=course&name=course&show_option_none=None&hide_empty=0'); ?>
                                                </div>
                                            </div>


                                            <div class="half">
                                                <div class="clearfix">
                                                    <label for="skill-level"><?php _e('Skill Level', 'woothemes'); ?>
                                                    </label>
                                                    <?php wp_dropdown_categories('tab_index=28&taxonomy=skill_level&name=skill-level&show_option_none=None&hide_empty=0'); ?>
                                                </div>
                                            </div>
                                        </fieldset>

                                        <fieldset class="in-set">
                                            <div class="half">
                                                <div class="clearfix">
                                                    <label for="calories"><?php _e('Calories', 'woothemes'); ?>
                                                    </label>
                                                    <?php wp_dropdown_categories('tab_index=28&taxonomy=calories&name=calories&show_option_none=None&hide_empty=0'); ?>
                                                </div>
                                            </div>


                                            <div class="half">
                                                <div class="clearfix">
                                                    <label for="calories"><?php _e('ingredient', 'woothemes'); ?>
                                                    </label>
                                                    <?php wp_dropdown_categories('tab_index=28&taxonomy=ingredient&name=ingredient&show_option_none=None&hide_empty=0'); ?>
                                                </div>
                                            </div>
                                        </fieldset>

                                    </div>
                                </fieldset>
                            </fieldset>

                            <fieldset class="submit">
                                <button type="submit"><p><?php _e('Submit Recipe', 'woothemes') ?></p></button>

                            </fieldset>


                            <input type="hidden" name="action" value="submit-recipe" />
                            <?php wp_nonce_field('submit-recipe'); ?>

                        </form>
                        <?php  
                    } else {
                        ?>
                        <div class="recipe-message">
                            <h4 class="title-recipe"><em class="fa fa-leaf"></em><?php _e('Thanks for adding recipe. We will publish your Recipe after Review.', 'woothemes'); ?></h4>
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <div class="tabed" id="login-signup-forgot">

                        <ul class="tabs">
                            <li class="current"><?php _e('Login', 'woothemes'); ?><span></span></li>


                            <li><?php _e('Sign Up', 'woothemes'); ?><span></span></li>


                            <li><?php _e('Forgot Password', 'woothemes'); ?><span></span></li>
                        </ul>

                        <div class="block current">
                            <form id="login-form" action="<?php echo wp_login_url(get_permalink()); ?>" method="post">
                                <fieldset class="outer">
                                    <fieldset>
                                        <div class="outer-form">
                                            <!-- recipe title -->
                                            <fieldset class="in-set">
                                                <p>
                                                    <br/>
                                                    <label for="username"><?php _e('User Name', 'woothemes'); ?></label>
                                                    <input type="text" name="log" id="username" tabindex="10" />
                                                </p>
                                            </fieldset>
                                            <fieldset class="in-set">
                                                <p>
                                                    <label for="password"><?php _e('Password', 'woothemes'); ?></label>
                                                    <input type="password" name="pwd" id="password"  tabindex="15" />
                                                </p>
                                            </fieldset>
                                            <fieldset class="in-set">
                                                <p>
                                                    <input type="checkbox" class="checkbox" id="remember" name="rememberme" value="forever" />
                                                    <label for="remember" class="checkbox-label"><?php _e('Remember me', 'woothemes'); ?></label>
                                                    <br/>




                                                </p>
                                            </fieldset>
                                        </div>
                                    </fieldset>
                                </fieldset>
                                <fieldset class="submit">
                                    <button type="submit"><p><?php _e('Login Recipe', 'woothemes'); ?></p></button>

                                    <input type="hidden" name="redirect_to" value="<?php the_permalink(); ?>" />
                                </fieldset>
                            </form>
                        </div>


                        <div class="block">
                            <form action="<?php echo site_url('wp-login.php?action=register', 'login_post') ?>" id="signup-form"  method="post">
                                <fieldset class="outer">
                                    <fieldset>
                                        <div class="outer-form">
                                            <!-- recipe title -->
                                            <fieldset class="in-set">
                                                <p>
                                                    <label for="userName"><?php _e('Username', 'woothemes'); ?></label>
                                                    <input type="text" id="userName" name="user_login" />
                                                </p>
                                            </fieldset>
                                            <fieldset class="in-set">
                                                <p>
                                                    <label for="user_email"><?php _e('Email', 'woothemes'); ?></label>
                                                    <input type="text" id="user_email" name="user_email" />
                                                </p>
                                                <p><?php _e('A password will be e-mailed to you.', 'woothemes'); ?></p>

                                            </fieldset>

                                        </div>
                                    </fieldset>
                                </fieldset>
                                <fieldset class="submit">
                                    <button type="submit"><p><?php _e('Sign Up', 'woothemes'); ?></p></button>

                                    <input type="hidden" name="redirect_to" value="<?php the_permalink(); ?>" />
                                    <input type="hidden" name="user-cookie" value="1" />

                                </fieldset>
                            </form>
                        </div>


                        <div class="block">
                            <form action="<?php echo site_url('wp-login.php?action=lostpassword', 'login_post') ?>" id="forgot-form"  method="post">
                                <fieldset class="outer">
                                    <fieldset>
                                        <div class="outer-form">
                                            <!-- recipe title -->
                                            <fieldset class="in-set">
                                                <p>
                                                    <label for="user_login" class="forgot-email"><?php _e('Username or Email', 'woothemes'); ?></label>
                                                    <input type="text" name="user_login" value="" id="user_login" />
                                                </p>
                                            </fieldset>

                                        </div>
                                    </fieldset>
                                </fieldset>
                                <fieldset class="submit">
                                    <button type="submit"><p><?php _e('Reset Password', 'woothemes'); ?></p></button>

                                    <input type="hidden" name="redirect_to" value="<?php the_permalink(); ?>" />
                                    <input type="hidden" name="user-cookie" value="1" />

                                </fieldset>
                            </form>
                        </div>

                    </div><!-- end of tabed div -->
                    <?php
                }
                ?>
            </div><!-- end  -->
            <?php woo_loop_after(); ?>
        </div><!-- /#main -->
        <?php woo_main_after(); ?>

        <?php get_sidebar(); ?>

    </div><!-- /#main-sidebar-container -->

    <?php dahz_get_sidebar( 'secondary' ); ?>

</div><!-- /#content -->
<?php woo_content_after(); ?>

<?php get_footer(); ?>
