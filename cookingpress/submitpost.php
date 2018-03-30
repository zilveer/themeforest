<div class="addrecipe-cont">
    <div class="addrecipe">
       <?php if( isset($postAdded)) { ?>
       <div class="notification closeable success">
        <p><?php echo ot_get_option('add_recipe_success'); ?></p>
    </div>
    <?php } ?>

    <form id="new_post" name="new_post" method="post" action="" class="addrecipe-form" enctype="multipart/form-data">
        <!-- post name -->
        <fieldset class="title <?php if(isset($hasError) && isset($titleError)) { echo 'error'; } ?>" name="name">
            <h4><span><?php _e('Recipe Title:', 'cookingpress'); ?></span></h4>
            <?php if(isset($hasError) && isset($titleError)) {?>
            <div class="notification closeable error" >
                <p><?php _e(' Title is required!', 'cookingpress'); ?></p>
            </div>
            <?php } ?>
            <input type="text" id="title" value="<?php if(isset($_POST['title'])) echo $_POST['title'];?>" tabindex="1" name="title" />
        </fieldset>
        <?php if(ot_get_option('add_recipe_content','off') == 'on') { ?>
        <!-- post Content -->
        <fieldset class="content">
            <h4><span><?php _e('Post Content:', 'cookingpress'); ?></span></h4>
            <?php
            $editor_settings = array(
                'wpautop' => true,
                'media_buttons' => true,
                'editor_class' => 'frontend',
                'textarea_rows' => 5,
                'tabindex' => 2,
                'teeny' => true
                );
            wp_editor(' ','description', $editor_settings);
            ?>

        </fieldset>
        <?php } ?>
        <?php if(ot_get_option('add_recipe_category','on') == 'on') { ?>
        <!-- post Category -->
        <fieldset class="category">
            <h4><span><?php _e('Category:', 'cookingpress'); ?></span><?php wp_dropdown_categories( 'tab_index=3&taxonomy=category&hide_empty=0&id=cat2&class=chosen' ); ?></h4>

        </fieldset>
        <?php } ?>
        <?php if(ot_get_option('add_recipe_summary','off') == 'on') { ?>
        <fieldset class="content">
            <h4><span><?php _e('Short summary:', 'cookingpress'); ?></span></h4>
            <?php
            $editor_settings = array(
                'wpautop' => true,
                'media_buttons' => true,
                'editor_class' => 'cookingpresssummary',
                'textarea_rows' => 5,
                'tabindex' => 4,
                'teeny' => true

                );
            wp_editor(' ','cookingpresssummary', $editor_settings);
            ?>

        </fieldset>
        <?php } ?>

        <fieldset class="ingridients <?php if(isset($hasError) && isset($ingridientsError)) { echo 'error'; } ?>">
            <h4><span><?php _e('Ingredients:', 'cookingpress'); ?></span></h4>
            <?php if(isset($hasError) && isset($ingridientsError)) { ?>
            <div class="notification closeable error" >
                <p><?php echo ot_get_option('add_recipe_ingredient'); ?></p>
            </div>
            <?php } ?>
            <table id="ingridients-sort" class="widefat">
                <thead>
                    <tr>
                        <th></th>
                        <th><?php _e("Name of ingriedient", 'cookingpress'); ?></th>
                        <th><?php _e("Notes (quantity, additional info)", 'cookingpress'); ?></th>
                        <th><?php _e("Actions", 'cookingpress'); ?></th>
                    </tr>
                </thead>
                <tbody>

                    <tr class="ingridients-cont ing">
                        <td><i class="icon icon-arrows"></i></td>
                        <td><input name="cookingpressingridients_name[]" tabindex="5" type="text" class="ingridient" value="" /> </td>
                        <td><input name="cookingpressingridients_note[]" tabindex="6" type="text" class="notes"  value="" /></td>
                        <td class="action">
                            <a title="Delete ingridient" href="#" class="delete" ><i class="icon icon-trash-o"></i></a>
                        </td>
                    </tr>

                </tbody>
            </table>

            <a href="#" class="add_ingridient button "><?php _e("Add new ingridient", 'cookingpress'); ?></a>
            <a href="#" class="add_separator button "><?php _e("Add separator", 'cookingpress'); ?></a>

        </fieldset>

        <input type="hidden" value="<?php wp_create_nonce('new-post')?>" id="cookingpressinstructions_noncename" name="cookingpressinstructions_noncename">

        <fieldset class="instructions <?php if(isset($hasError) && isset($instructionsError)) { echo 'error'; } ?>">
            <h4>Instructions:</h4>
            <?php if(isset($hasError) && isset($instructionsError)) { ?>
            <div class="notification closeable error" >
                <p><?php echo ot_get_option('add_recipe_instructions'); ?></p>
            </div>
            <?php } ?>
            <?php
            $editor_settings2 = array(
                'wpautop' => true,
                'media_buttons' => true,
                'editor_class' => 'frontend2',
                'textarea_rows' => 5,
                'tabindex' => 10,
                'teeny' => true
                );
            wp_editor(' ','cookingpressinstructions', $editor_settings2);
            ?>

        </fieldset>
        <?php if(ot_get_option('add_recipe_addinfo','off') == 'on') { ?>
        <fieldset class="nutritionfacts">
            <h4><?php _e("Additional informations:", 'cookingpress'); ?></h4>
            <ul id="nutritionfacts_list">
                <li><?php _e('Preparation time ', 'cookingpress'); ?><input type="text" name="cookingpressrecipeoptions_preptime" /> <?php _e('minutes', 'cookingpress'); ?></li>
                <li><?php _e('Cooking time ', 'cookingpress'); ?><input type="text" name="cookingpressrecipeoptions_cooktime" /> <?php _e('minutes', 'cookingpress'); ?></li>
                <li><?php _e('Yield:', 'cookingpress'); ?> <input type="text" name="cookingpressrecipeoptions_yield" /></li>

            </ul>
        </fieldset>
        <?php } ?>
        <?php if(ot_get_option('add_recipe_nutritionfacts','off') == 'on') { ?>
        <fieldset class="nutritionfacts">
            <h4><?php _e("Nutrition facts:", 'cookingpress'); ?></h4>
            <table class="widefat">
                <?php
                $foodiepress = new FoodiePress;
                $nutritionsfacts = $foodiepress->nutritions; ?>
                <?php foreach ($nutritionsfacts as $key => $desc) { ?>
                <tr class="ingridients-cont">
                    <td><label for="<?php echo $key; ?>"><?php echo $desc; ?></label></td>
                    <td><input id="<?php echo $key; ?>" type="text" name="cookingpressntfacts[<?php echo $key; ?>]"  value="<?php echo (!empty($meta_box_value[$key])) ? $meta_box_value[$key] : ''; ?>"></td>
                </tr>
                <?php } ?>
            </table>
        </fieldset>
        <?php } ?>
        <?php if(ot_get_option('add_recipe_serving','off') == 'on') { ?>
        <fieldset class="category">
            <label for="cat"><?php _e('Servings:', 'cookingpress'); ?></label>
            <?php $serving = get_terms('serving', 'hide_empty=0'); ?>
            <select name="serving" class="chosen">
                <option class='theme-option' value=''>None</option>
                <?php foreach ($serving as $serve) {
                    echo "<option class='theme-option' value='" . $serve->slug . "'>" . $serve->name . "</option>\n";
                } ?>
            </select>
        </fieldset>
        <?php } ?>
        <?php if(ot_get_option('add_recipe_level','off') == 'on') { ?>
        <fieldset class="category">
            <label for="cat"><?php _e('Levels:', 'cookingpress'); ?></label>
            <?php $levels = get_terms('level', 'hide_empty=0'); ?>
            <select name="level" class="chosen">
                <option class='theme-option' value=''>None</option>
                <?php foreach ($levels as $level) {
                    echo "<option class='theme-option' value='" . $level->slug . "'>" . $level->name . "</option>\n";
                } ?>
            </select>
        </fieldset>
        <?php } ?>
        <?php if(ot_get_option('add_recipe_timeneeded','off') == 'on') { ?>
        <fieldset class="category">
            <label for="cat"><?php _e('Time needed:', 'cookingpress'); ?></label>
            <?php $timeneeded = get_terms('timeneeded', 'hide_empty=0'); ?>
            <select name="timeneeded" class="chosen">
                <option class='theme-option' value=''>None</option>
                <?php foreach ($timeneeded as $time) {
                    echo "<option class='theme-option' value='" . $time->slug . "'>" . $time->name . "</option>\n";
                } ?>
            </select>
        </fieldset>
        <?php } ?>
        <?php if(ot_get_option('add_recipe_allergens','off') == 'on') { ?>
        <fieldset class="allergens">
            <label><?php _e( 'Allergens', 'cookingpress' ); ?></label>
            <select name="allergens[]" multiple="true" size="5" class="chosen">
                <option value="0"><?php _e( 'Select...', 'cookingpress' ); ?></option>
                <?php
                $theterms = get_terms('allergen', 'orderby=name&hide_empty=0');
                foreach ($theterms AS $term) :
                    echo "<option value='".$term->slug."'";

                echo ">".$term->name."</option>\n";
                endforeach; ?>
            </select>
        </fieldset>
        <?php } ?>
        <fieldset class="submit">
            <input type="submit" value="<?php _e( 'Submit Recipe', 'cookingpress' ); ?>" tabindex="40" id="submit" name="submit" />
        </fieldset>

        <input type="hidden" name="action" value="new_post" />
        <?php wp_nonce_field( 'new-post' ); ?>
    </form>
</div>
</div>