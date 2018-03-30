<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 10/08/16
 * Time: 6:12 PM
 */
global $houzez_local, $prop_data, $prop_meta_data, $hide_add_prop_fields, $required_fields;
$prop_agent_display_option = $prop_meta_data['fave_agent_display_option'][0];
$prop_agent_id = $prop_meta_data['fave_agents'][0];
?>
<div class="account-block">
    <div class="add-title-tab">
        <h3><?php echo $houzez_local['agent_information']; ?></h3>
        <div class="add-expand"></div>
    </div>
    <div class="add-tab-content">
        <div class="add-tab-row push-padding-bottom">
            <p><?php echo $houzez_local['what_display_agentbox']; ?></p>
            <div class="radio">
                <label><input value="author_info" <?php checked( $prop_agent_display_option, 'author_info' ); ?> type="radio" class="rwmb-radio" name="fave_agent_display_option" checked="checked"><?php echo $houzez_local['author_info']; ?></label>
            </div>
            <div class="radio">
                <label><input value="agent_info" <?php checked( $prop_agent_display_option, 'agent_info' ); ?> type="radio" class="rwmb-radio" name="fave_agent_display_option"><?php echo $houzez_local['agent_info']; ?></label>
            </div>
            <div class="radio">
                <label><input value="none" <?php checked( $prop_agent_display_option, 'none' ); ?> type="radio" class="rwmb-radio" name="fave_agent_display_option"><?php echo $houzez_local['hide_info_box']; ?></label>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <select name="fave_agents" class="selectpicker" data-live-search="false" data-live-search-style="begins">
                            <option value="-1"><?php echo $houzez_local['none']; ?></option>
                            <?php
                            $agents_posts = get_posts(array('post_type' => 'houzez_agent', 'posts_per_page' => -1, 'suppress_filters' => 0));
                            if (!empty($agents_posts)) {
                                foreach ($agents_posts as $agent_post) {
                                    echo '<option '.selected( $prop_agent_id, $agent_post->ID ).' value="'.$agent_post->ID.'">'.$agent_post->post_title.'</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
