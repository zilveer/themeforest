<?php
//adding columns start

add_filter('manage_cs_cause_posts_columns', 'cause_columns_add');

function cause_columns_add($columns) {

    $columns['category'] = 'Category';

    $columns['tag'] = 'Tags';

    $columns['author'] = 'Author';

    return $columns;
}

add_action('manage_cs_cause_posts_custom_column', 'cause_columns');

function cause_columns($name) {

    global $post;

    switch ($name) {

        case 'category':

            $categories = get_the_terms($post->ID, 'cs_cause-category');

            if ($categories <> "") {

                $couter_comma = 0;

                foreach ($categories as $category) {

                    echo $category->name;

                    $couter_comma++;

                    if ($couter_comma < count($categories)) {

                        echo ", ";
                    }
                }
            }

            break;

        case 'tag':

            $categories = get_the_terms($post->ID, 'cs_cause-tag');

            if ($categories <> "") {

                $couter_comma = 0;

                foreach ($categories as $category) {

                    echo $category->name;

                    $couter_comma++;

                    if ($couter_comma < count($categories)) {

                        echo ", ";
                    }
                }
            }

            break;

        case 'author':

            echo get_the_author();

            break;
    }
}

//adding columns end



function cs_cause_register() {

    $labels = array(
        'name' => __('Cause', 'AidReform'),
        'add_new_item' => __('Add New Cause', 'AidReform'),
        'edit_item' => __('Edit Cause', 'AidReform'),
        'new_item' => __('New Cause Item', 'AidReform'),
        'add_new' => __('Add New Cause', 'AidReform'),
        'view_item' => __('View Cause Item', 'AidReform'),
        'search_items' => __('Search Cause', 'AidReform'),
        'not_found' => __('Nothing found', 'AidReform'),
        'not_found_in_trash' => __('Nothing found in Trash', 'AidReform'),
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'menu_icon' => get_stylesheet_directory_uri() . '/images/admin/cause-icon.png',
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments')
    );

    register_post_type('cs_cause', $args);
}

add_action('init', 'cs_cause_register');

function cs_cause_categories() {

    $labels = array(
        'name' => 'Menu Categories',
        'search_items' => 'Search Cause Categories',
        'edit_item' => 'Edit Cause Category',
        'update_item' => 'Update Cause Category',
        'add_new_item' => 'Add New Category',
        'menu_name' => 'Cause Categories',
    );

    register_taxonomy('cs_cause-category', array('cs_cause'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'cs_cause-category'),
    ));
}

add_action('init', 'cs_cause_categories');

function cs_cause_tag() {

    $labels = array(
        'name' => 'Cause Tags',
        'singular_name' => 'cs_menu-tag',
        'search_items' => 'Search Tags',
        'popular_items' => 'Popular Tags',
        'all_items' => 'All Tags',
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => 'Edit Tag',
        'update_item' => 'Update Tag',
        'add_new_item' => 'Add New Tag',
        'new_item_name' => 'New Tag Name',
        'separate_items_with_commas' => 'Separate writers with commas',
        'add_or_remove_items' => 'Add or remove tags',
        'choose_from_most_used' => 'Choose from the most used tags',
        'menu_name' => 'Cause Tags',
    );

    register_taxonomy('cs_cause-tag', 'cs_cause', array(
        'hierarchical' => false,
        'labels' => $labels,
        'show_ui' => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var' => true,
        'rewrite' => array('slug' => 'cs_cause-tag'),
    ));
}

add_action('init', 'cs_cause_tag');



// adding tag end
// adding album meta info start

add_action('add_meta_boxes', 'cs_meta_menu_add');

function cs_meta_menu_add() {

    add_meta_box('cs_meta_menu', 'Cause Options', 'cs_meta_menu', 'cs_cause', 'normal', 'high');
}

function cs_meta_menu($post) {

    global $cs_xmlObject, $cs_xmlObject_transaction;

    $cs_xmlObject_transaction = new stdclass();

    $cs_menu = get_post_meta($post->ID, "cs_cause_meta", true);

    $cause_end_date = get_post_meta($post->ID, "cause_end_date", true);

    $cs_cause = get_post_meta($post->ID, "cs_cause_transaction_meta", true);

    $payment_gross = 0;

    $percentage_amount = $payment_gross_total = 0;

    if ($cs_cause <> "") {

        $cs_xmlObject_transaction = new SimpleXMLElement($cs_cause);

        if (count($cs_xmlObject_transaction->transaction) > 0) {

            foreach ($cs_xmlObject_transaction->transaction as $transct) {

                $payment_gross_total = $payment_gross_total + $transct->payment_gross;
            }
        }

        $cause_raised_amount = $payment_gross_total;
    } else {

        $cause_raised_amount = '0';
    }



    if ($cs_menu <> "") {

        $cs_xmlObject = new SimpleXMLElement($cs_menu);

        $sub_title = $cs_xmlObject->sub_title;

        $cause_social_share = $cs_xmlObject->cause_social_share;

        $cause_goal_amount = $cs_xmlObject->cause_goal_amount;

        $payment_gross_total = 0;

        $cause_related = $cs_xmlObject->cause_related;

        $cause_gallery = $cs_xmlObject->cause_gallery;

        $cause_related_post_title = $cs_xmlObject->cause_related_post_title;

        $cause_end_date = $cs_xmlObject->cause_end_date;

        $cause_paypal_email = $cs_xmlObject->cause_paypal_email;

        $cs_donations_show = $cs_xmlObject->cs_donations_show;
    } else {

        $sub_title = '';

        $cause_social_share = '';

        $cause_related = '';

        $cause_related_post_title = '';

        $cause_goal_amount = '100';

        $cause_raised_amount = '0';

        $cause_gallery = '';

        $cause_end_date = '';

        $cause_paypal_email = '';

        $cs_donations_show = '';
    }
    ?>

    <div class="page-wrap page-opts left" style="overflow:hidden; position:relative;">

        <script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/scripts/admin/jquery.scrollTo-min.js"></script>

        <script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/scripts/admin/select.js"></script>

        <script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/scripts/admin/prettyCheckable.js"></script>

        <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/css/admin/jquery.ui.datepicker.css">

        <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/css/admin/jquery.ui.datepicker.theme.css">

        <script>

            jQuery(function ($) {

                $('#payment_date').datepicker();

                $('#cause_end_date').datepicker();

            });



        </script>

        <div class="option-sec" style="margin-bottom:0;">



            <div class="opt-conts">

                <ul class="form-elements">

                    <li class="to-label"><label>Sub Title</label></li>

                    <li class="to-field">

                        <input type="text" name="sub_title" value="<?php echo $sub_title ?>" />

                        <p>Put the sub title.</p>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label>Social Sharing</label></li>

                    <li class="to-field">

                        <div class="on-off"><input type="checkbox" name="cause_social_share" value="on" class="myClass" <?php if ($cause_social_share == 'on') echo "checked" ?> /></div>

                        <p>Enable/Disbale social sharing</p>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label>Related Cause</label></li>

                    <li class="to-field">

                        <div class="on-off"><input type="checkbox" onchange="javascript:related_title_toggle_inside_post(this)" name="cause_related" class="myClass" <?php
                            if (empty($cause_related) || $cause_related == "on") {
                                echo "checked";
                            }
                            ?> /></div>

                        <p>Enable/Disbale Related Cause</p>

                    </li>

                </ul>

                <ul class="form-elements" id="related_post">

                    <li class="to-label"><label>Related Post Title</label></li>

                    <li class="to-field">

                        <input id="inside_cause_related_post_title" name="cause_related_post_title" value="<?php
                        if ($cause_related_post_title <> '') {
                            echo $cause_related_post_title;
                        } else {
                            echo __('Related Post', 'AidReform');
                        }
                        ?>" type="text" class="small" />

                        <p>Put Related Post Title</p>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label>Cause End Date</label></li>

                    <li class="to-field">

                        <input type="text" id="cause_end_date" name="cause_end_date" value="<?php echo $cause_end_date; ?>" />

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label>Select Gallery</label></li>

                    <li class="to-field">

                        <select name="cause_gallery" class="dropdown">

                            <option value="0">--Select Gallery--</option>

                            <?php
                            query_posts(array('posts_per_page' => "-1", 'post_status' => 'publish', 'post_type' => 'cs_gallery'));

                            while (have_posts()) : the_post();
                                ?>

                                <option <?php if ($cause_gallery == get_the_ID()) echo "selected" ?> value="<?php the_ID() ?>"><?php the_title() ?></option>

                                <?php
                            endwhile;
                            ?>

                        </select>

                    </li>

                </ul>

                <ul class="form-elements ">

                    <li class="to-label"><label>Goal Amount</label></li>

                    <li class="to-field"><input type="text" name="cause_goal_amount" value="<?php echo htmlspecialchars($cause_goal_amount) ?>" /><p>Put Goal Amount</p></li>



                </ul>

                <ul class="form-elements ">

                    <li class="to-label"><label>Cause Raised Amount</label></li>

                    <li class="to-field"><input type="text" disabled="disabled" name="cause_raised_amount" value="<?php echo htmlspecialchars($cause_raised_amount) ?>" /><p> Auto Calculated Raised Amount From Donations</p></li>



                </ul>

                <ul class="form-elements ">

                    <li class="to-label"><label>Paypal Email</label></li>

                    <li class="to-field"><input type="text" name="cause_paypal_email" value="<?php echo htmlspecialchars($cause_paypal_email) ?>" /><p> Please enter your paypal bussiness email for individual Cause. If you dont enter paypal email here. You must enter paypal email at theme options <?php echo '<a target="_blank" href="' . get_admin_url() . 'themes.php?page=cs_theme_option#tab-paypalapi-key-show">' . __('here', 'AidReform') . '.</a>'; ?> that will be used for default for all cuases.</p></li>



                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label>Donors On/Off</label></li>

                    <li class="to-field">

                        <div class="on-off"><input type="checkbox"  name="cs_donations_show" class="myClass" <?php
                            if (empty($cs_donations_show) || $cs_donations_show == "on") {
                                echo "checked";
                            }
                            ?> /></div>

                        <p>Enable/Disbale Donor</p>

                    </li>

                </ul>

            </div>

            <div class="clear"></div>

        </div>



        <div class="boxes tracklists">

            <div id="add_ingrediant" class="poped-up">

                <div class="opt-head">

                    <h5>Donor Settings</h5>

                    <a href="javascript:closepopedup('add_ingrediant')" class="closeit">&nbsp;</a>

                    <div class="clear"></div>

                </div>

                <ul class="form-elements">

                    <li class="to-label"><label>Name</label></li>

                    <li class="to-field">

                        <input type="text" id="address_name_dummy" name="address_name_dummy" value="Title" />

                        <p>Put Name</p>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label>Email</label></li>

                    <li class="to-field">

                        <input type="text" id="payer_email" name="payer_email" value="" />

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label>Amount</label></li>

                    <li class="to-field">

                        <input type="text" id="payment_gross" name="payment_gross" value="" />

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label>Transaction ID</label></li>

                    <li class="to-field">

                        <input type="text" id="txn_id" name="txn_id" value="" />

                        <p>Put Transaction ID</p>

                    </li>

                </ul>

                <ul class="form-elements">

                    <li class="to-label"><label>Payment Date</label></li>

                    <li class="to-field">

                        <input type="text" id="payment_date" name="payment_date" value="" />

                    </li>

                </ul>

                <ul class="form-elements noborder">

                    <li class="to-label"></li>

                    <li class="to-field"><input type="button" value="Add Donation" onclick="add_menu_to_list('<?php echo admin_url('admin-ajax.php'); ?>', '<?php echo get_template_directory_uri() ?>')" /></li>

                </ul>

            </div>

            <script>

                jQuery(document).ready(function ($) {

                    $("#total_tracks").sortable({
                        cancel: 'td div.poped-up',
                    });

                });

            </script>

            <div class="opt-head">

                <h4 style="padding-top:12px;">Cause Donors</h4>

                <a href="javascript:openpopedup('add_ingrediant')" class="button">Add Donor</a>

                <div class="clear"></div>

            </div>

            <table class="to-table" border="0" cellspacing="0">

                <thead>

                    <tr>

                        <th style="width:20%;">Donor Name</th>

                        <th style="width:20%;">Email</th>

                        <th style="width:20%;">Amount</th>

                        <th style="width:20%;">Transaction ID</th>

                        <th style="width:20%;">Date</th>

                        <th style="width:20%;" class="centr">Actions</th>

                    </tr>

                </thead>

                <tbody id="total_tracks">

                    <?php
                    global $counter_track, $address_name, $payer_email, $payment_gross, $txn_id, $payment_date;

                    $counter_track = $post->ID;

                    $cs_cause_trans = get_post_meta($post->ID, "cs_cause_transaction_meta", true);

                    if ($cs_cause_trans <> "") {

                        $cs_xmlObject_transact = new SimpleXMLElement($cs_cause_trans);

                        foreach ($cs_xmlObject_transact->transaction as $transct) {

                            $address_name = $transct->address_name;

                            $payer_email = $transct->payer_email;

                            $payment_gross = $transct->payment_gross;

                            $txn_id = $transct->txn_id;

                            $payment_date = $transct->payment_date;

                            $counter_track++;

                            add_gradiants_to_list();
                        }
                    }
                    ?>

                </tbody>

            </table>

        </div>

        <?php meta_layout() ?>

        <input type="hidden" name="cause_meta_form" value="1" />

        <div class="clear"></div>

    </div>

    <div class="clear"></div>

    <?php
}

if (isset($_POST['cause_meta_form']) and $_POST['cause_meta_form'] == 1) {

    if (empty($_POST['cs_layout']))
        $_POST['cs_layout'] = 'none';

    add_action('save_post', 'cs_meta_cause_save');

    function cs_meta_cause_save($post_id) {

        $payment_gross = 0;

        $sxe = new SimpleXMLElement("<cause></cause>");

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return;

        if (empty($_POST["sub_title"])) {
            $_POST["sub_title"] = "";
        }

        if (empty($_POST["cause_social_share"]))
            $_POST["cause_social_share"] = "";

        if (empty($_POST["cause_related"]))
            $_POST["cause_related"] = "";

        if (empty($_POST["cause_related_post_title"]))
            $_POST["cause_related_post_title"] = "";

        if (empty($_POST["cause_goal_amount"]))
            $_POST["cause_goal_amount"] = "";

        if (empty($_POST["cause_end_date"]))
            $_POST["cause_end_date"] = "";

        if (empty($_POST["cause_raised_amount"]))
            $_POST["cause_raised_amount"] = "";

        if (empty($_POST["cause_gallery"]))
            $_POST["cause_gallery"] = "";

        if (empty($_POST["cause_paypal_email"]))
            $_POST["cause_paypal_email"] = "";

        if (empty($_POST["cs_donations_show"]))
            $_POST["cs_donations_show"] = "";

        $sxe = save_layout_xml($sxe);

        $sxe->addChild('sub_title', $_POST['sub_title']);



        $sxe->addChild('cause_social_share', htmlspecialchars($_POST['cause_social_share']));

        $sxe->addChild('cause_related', htmlspecialchars($_POST['cause_related']));

        $sxe->addChild('cause_related_post_title', htmlspecialchars($_POST['cause_related_post_title']));

        $sxe->addChild('cause_goal_amount', htmlspecialchars($_POST['cause_goal_amount']));

        $sxe->addChild('cause_end_date', htmlspecialchars($_POST['cause_end_date']));

        $sxe->addChild('cause_gallery', htmlspecialchars($_POST['cause_gallery']));

        $sxe->addChild('cause_paypal_email', htmlspecialchars($_POST['cause_paypal_email']));

        $sxe->addChild('cs_donations_show', htmlspecialchars($_POST['cs_donations_show']));

        $cs_counter = 0;
        $tran = new SimpleXMLElement("<cause_transaction></cause_transaction>");
        if (isset($_POST['address_name'])) {
            foreach ($_POST['address_name'] as $count) {

                $payment_gross = $payment_gross + $_POST['payment_gross'][$cs_counter];

                $trans = $tran->addChild('transaction');

                $trans->addChild('txn_id', htmlspecialchars($_POST['txn_id'][$cs_counter]));

                $trans->addChild('payment_date', htmlspecialchars($_POST['payment_date'][$cs_counter]));

                $trans->addChild('payer_email', htmlspecialchars($_POST['payer_email'][$cs_counter]));

                $trans->addChild('payment_gross', htmlspecialchars($_POST['payment_gross'][$cs_counter]));

                $trans->addChild('address_name', htmlspecialchars($_POST['address_name'][$cs_counter]));

                $cs_counter++;
            }
        }

        update_post_meta($post_id, 'cs_cause_transaction_meta', $tran->asXML());

        update_post_meta($post_id, 'cs_cause_raised_amount', $payment_gross);

        update_post_meta($post_id, 'cause_end_date', htmlspecialchars($_POST['cause_end_date']));

        update_post_meta($post_id, 'cs_cause_meta', $sxe->asXML());
    }

}

// adding menu meta info end
?>