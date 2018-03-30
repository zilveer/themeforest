<?php
/**
 * The template for displaying search forms in CookingPress
 *
 * @package CookingPress
 */

$elements = ot_get_option('pp_search_elements', array());
if(in_array('allergens', $elements)) { }
?>
<div class="advsearch-container">
    <div class="advsearch">
        <form method="get" action="<?php bloginfo('url'); ?>">
            <?php
            if (isset($_GET['include_ing']) && is_array($_GET['include_ing'])) { $tags = $_GET['include_ing'];  } else { $tags = array(); }
            if (isset($_GET['exclude_ing']) && is_array($_GET['exclude_ing'])) { $extags = $_GET['exclude_ing'];  } else { $extags = array(); }
            ?>
            <fieldset>
                <p>
                   <label><?php _e('By keyword (optional)', 'cookingpress'); ?></label>
                   <input type="text" id="s" name="s" value="<?php echo esc_attr( get_search_query() ); ?>"  placeholder="search&hellip;" maxlength="50"/>
               </p>
               <p>
                <label class="full"><?php _e('Select one or more ingredients that should be <strong>included in recipe</strong>', 'cookingpress'); ?></label>
                <?php echo cp_tags_multiselect("include_ing",$tags); ?>
            </p>
            <p id="relation"><?php _e('Recipe needs to have', 'cookingpress'); ?>
                <select name="relation" class="chosen" style="width:70px;min-width:70px">
                    <option value="any" <?php if(isset( $_GET['relation'])) { echo $_GET['relation'] == 'any' ? ' selected="selected"' : ''; } ?>><?php _e('Any', 'cookingpress'); ?></option>
                    <option value="all" <?php if(isset( $_GET['relation'])) { echo $_GET['relation'] == 'all' ? ' selected="selected"' : ''; } ?>><?php _e('All', 'cookingpress'); ?></option>
                </select><?php _e(' of selected ingredients', 'cookingpress'); ?>
            </p>
            <p>
                <label  class="full"><?php _e('Select one or more ingredients that should be <strong>excluded from recipe</strong>', 'cookingpress'); ?></label>
                <?php echo cp_tags_multiselect("exclude_ing",$extags); ?>
            </p>
           <?php if(in_array('category', $elements)) { ?>
            <p>
                <label><?php _e( 'Choose category', 'cookingpress' ); ?></label>
                <?php wp_dropdown_categories( 'show_option_all=Select...&hide_empty=0&id=cat2&class=chosen' ); ?>
            </p>
           <?php } ?>
           <?php if(in_array('level', $elements)) { ?>
            <p>
                <label><?php _e( 'Choose level', 'cookingpress' ); ?></label>
                <select name="level" class="chosen">
                    <option value=""><?php _e('Select an option','cookingpress'); ?></option>
                    <?php
                    $theterms = get_terms('level', 'orderby=name');
                    foreach ($theterms AS $term) :
                        echo "<option value='".$term->slug."'";
                    if(isset($_GET['level'])) { $_GET['level'] == $term->slug ? ' selected="selected"' : ''; }
                    echo ">".$term->name."</option>\n";
                    endforeach; ?>
                </select>
            </p>
            <?php } ?>
            <?php if(in_array('serving', $elements)) { ?>
            <p>
                <label><?php _e( 'Choose serving', 'cookingpress' ); ?></label>
                <select name="serving" class="chosen">
                    <option value=""><?php _e('Select an option','cookingpress'); ?></option>
                    <?php
                    $theterms = get_terms('serving', 'orderby=name');
                    foreach ($theterms AS $term) :
                        echo "<option value='".$term->slug."'";
                    if(isset($_GET['serving'])) { $_GET['serving'] == $term->slug ? ' selected="selected"' : ''; }
                    echo ">".$term->name."</option>\n";
                    endforeach; ?>
                </select>
            </p>
            <?php } ?>
            <?php if(in_array('timeneeded', $elements)) { ?>
            <p>
                <label><?php _e( 'Choose time needed', 'cookingpress' ); ?></label>
                <select name="timeneeded" class="chosen">
                    <option value=""><?php _e('Select an option','cookingpress'); ?></option>
                    <?php
                    $theterms = get_terms('timeneeded', 'orderby=name');
                    foreach ($theterms AS $term) :
                        echo "<option value='".$term->slug."'";
                    if(isset($_GET['timeneeded'])) { $_GET['timeneeded'] == $term->slug ? ' selected="selected"' : ''; }
                    echo ">".$term->name."</option>\n";
                    endforeach; ?>
                </select>
            </p>
            <?php } ?>
             <?php if(in_array('allergens', $elements)) { ?>
            <p>
                <label><?php _e( 'Choose allergens', 'cookingpress' ); ?></label>
                <select name="allergens[]" multiple="true" size="5" class="chosen">
                    <option value="0"><?php _e( 'Select...', 'cookingpress' ); ?></option>
                    <?php
                    $theterms = get_terms('allergen', 'orderby=name&hide_empty=0');
                    foreach ($theterms AS $term) :
                        echo "<option value='".$term->slug."'";
                    if(isset($_GET['allergens'])) { $_GET['allergen'] == $term->slug ? ' selected="selected"' : ''; }
                    echo ">".$term->name."</option>\n";
                    endforeach; ?>
                </select>
            </p>
            <?php } ?>

            <button type="submit"><?php _e('Search','cookingpress'); ?></button>
        </fieldset>
    </form>
</div>
</div>