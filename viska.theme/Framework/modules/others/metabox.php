<?php
/**
 * Project of Megadrupal.com
 * Author: duongle
 * Date: 5/1/14
 * Time: 6:06 PM
 */

class AWEMetabox extends AweFramework
{
    protected $pricing = array(
        'type'      =>  'awe_pricing',
        'name'      =>  'Pricing Table',
        'position'  =>  'normal'
    );
    protected $social  = array(
        'type'      =>  'awe_social',
        'name'      =>  'Social Box',
        'position'  =>  'normal',
    );

    protected $detail_editor   = array(
        'type'      =>  'awe_detail_editor',
        'name'      =>  'Detail',
        'position'  =>  'normal',
    );

    protected $offer   =   array(
        'type'      =>  'awe_offer',
        'name'      =>  'Offers',
        'position'  =>  'normal',
    );

    protected $feature =   array(
        'type'      =>  'awe_feature',
        'name'      =>  'Features',
        'position'  =>  'normal',
    );

    protected $skill = array(
        'type'      =>  'awe_skill',
        'name'      =>  'Skills',
        'position'  =>  'normal',
    );

    protected $resume = array(
        'type'      =>  'awe_resume',
        'name'      =>  'Resume CV',
        'position'  =>  'normal',
    );

    protected $funfact = array(
        'type'      =>  'awe_funfact',
        'name'      =>  'Fun Fact',
        'position'  =>  'normal',
    );

    protected $media = array(
        'type'      =>  'awe_media',
        'name'      =>  'Add Media',
        'position'  =>  'normal',
    );
    protected $format = array(
        'type'      =>  'awe_format',
        'name'      =>  'Format',
        'position'  =>  'side',
    );

    protected $client = array(
        'type'      =>  'awe_client',
        'name'      =>  'Client Information',
        'position'  =>  'normal',
    );

    protected $client_list = array(
        'type'      =>  'awe_client_list',
        'name'      =>  'Choose Client',
        'position'  =>  'side',
    );
    protected $total = array();
    public function __construct()
    {

        $this->total[] = $this->resume;
        $this->total[] = $this->funfact;
        $this->total[] = $this->skill;
        $this->total[] = $this->social;
        $this->total[] = $this->detail_editor;
        $this->total[] = $this->offer;
        $this->total[] = $this->feature;
        $this->total[] = $this->pricing;
        $this->total[] = $this->media;
        $this->total[] = $this->format;
        $this->total[] = $this->client;
        $this->total[] = $this->client_list;



        //loading script
        add_action( 'admin_enqueue_scripts',                array($this, 'loading_js') );
        add_action( 'admin_print_scripts',                array($this, 'print_js') );
        add_action( 'admin_enqueue_scripts',                   array($this, 'loading_css'));
        //Add meta box created by

        add_action( 'add_meta_boxes',                       array($this, 'add_meta_box') );
        // save service
        add_action( 'save_post',                            array($this, 'meta_save'),    100,2);
        //add pop up font
        add_action( 'edit_form_advanced',                   array($this, 'font_icon_panel'));
    }

    /**
     * Loading Meta Box Css
     */
    public function loading_css()
    {
        global $pagenow;
        if (in_array($pagenow,array('post.php','post-new.php')) && is_admin())
        foreach($this->total as $i)
        {
            if($this->is_support($i['type']))
            {
                wp_register_style( 'awe-metabox', AWE_CSS_URL. 'metabox.css', false, '1.0.0' );
                wp_enqueue_style( 'awe-metabox' );
                if(!wp_style_is('awe-font-icon')){
                    wp_register_style( 'awe-font-icon', AWE_CSS_URL. 'font-icon.css', false, '1.0.0' );
                    wp_enqueue_style( 'awe-font-icon' );
                    wp_register_style( 'awe-popup', AWE_CSS_URL. 'popup.css', false, '1.0.0' );
                    wp_enqueue_style( 'awe-popup' );
                }
            }
        }
    }
    /**
     * Loading Meta Box JS
     */
    public function loading_js()
    {
        global $pagenow;
        if(AWE_DEBUG==true)
            $min=".min";
        else
            $min="";

        $print = false;
        if (in_array($pagenow,array('post.php','post-new.php')) && is_admin())
        foreach($this->total as $i)
        {

            if($this->is_support($i['type']) && $print==false){
                wp_enqueue_script('awe-easypiechart', AWE_JS_URL. 'lib/jquery.easypiechart.js', array("jquery"), null, false);
                wp_enqueue_script('awe-metabox', AWE_JS_URL. 'metabox'.$min.'.js', array("jquery"), null, false);
                $print = true;
            }
        }
    }
    public function print_js()
    {
        global $pagenow;
        $print = false;
        if (in_array($pagenow,array('post.php','post-new.php')) && is_admin())
            foreach($this->total as $i)
            {
                if($this->is_support($i['type']) && $print==false){
                    echo "<script>var AWEURL = '".AWE_ROOT_URL."';</script>";
                    $print = true;
                }

            }
    }
    /**
     * Register meta box
     * @param $post_type
     */
    public function add_meta_box($post_type)
    {
        foreach($this->total as $i)
        {
            if($this->is_support($i['type']))
            {
                add_meta_box($i['type'],apply_filters($i['type']."_title",$i['name']),array($this,$i['type'].'_html'),$post_type,$i['position'],'high');
                add_filter( "postbox_classes_{$post_type}_{$i['type']}", array($this,'add_my_meta_box_classes') );
            }
        }


    }

    /**
     * Add awe-settings class into wrap
     * @param array $classes
     *
     * @return array
     */
    public function add_my_meta_box_classes( $classes=array() ) {
        /* In order to ensure we don't duplicate classes, we should
            check to make sure it's not already in the array */
        if( !in_array( 'awe-settings', $classes ) )
            $classes[] = 'awe-settings';

        return $classes;
    }

    public function awe_client_list_html()
    {
        if(!$this->is_support($this->client_list['type']))
            return;
        wp_nonce_field( $this->client_list['type'].'_save', $this->client_list['type'].'_nonce' );
        $value = $this->get_custom_fields('client_list',array()) ;
        $value = (!empty($value))?$value:'none';
        $posts = get_posts( array( 'post_type' => 'awe_client' ));
        if(!is_array($posts) || count($posts)<0){
            _e("You have to create client first!",self::LANG);
            return;
        }else{
        ?>
        <div class="awe-client-list">
            <select name="<?php echo $this->client_list['type']."[client_list]";?>">
                    <option <?php selected($value,'none');?> value="none">Private</option>
                <?php foreach($posts as $post):?>

                    <option <?php selected($value,$post->ID);?> value="<?php echo $post->ID;?>"><?php echo $post->post_title;?></option>
                <?php endforeach;?>
            </select>
        </div>
        <?php

            }
    }

    /**
     * Generate Client Info
     */
    public function awe_client_html()
    {
        if(!$this->is_support($this->client['type']))
            return;
        wp_nonce_field( $this->client['type'].'_save', $this->client['type'].'_nonce' );
        $values = $this->get_custom_fields('client',array()) ;
        $values['logo'] = (isset($values['logo']))?$values['logo']:AWE_ROOT_URL."asset/images/logo.png";
        $values['url'] = (isset($values['url']))?$values['url']:"#";
        ?>
        <div class="awe-client">
            <div class="client-url">
                <label id="client-url">Url</label>
                <input type="text" id="client-url" class="medium client-url" value="<?php echo $values['url'];?>" name="<?php echo $this->client['type']."[client][url]";?>">
            </div>
            <div class="client-logo">
                <label id="client-logo">Logo</label>
                <a href="#" class="photo"><img src="<?php echo $values['logo'];?>"></a>
                <input type="hidden" id="client-logo" class="input-photo" value="<?php echo $values['logo'];?>" name="<?php echo $this->client['type']."[client][logo]";?>">
            </div>
        </div>
        <?php
    }

    /**
     * Generate Format Posts Type
     */
    public function awe_format_html()
    {
        if(!$this->is_support($this->format['type']))
            return;

        $types = array(
            'standard'      =>  'Standard',
            'gallery'       =>  'Gallery',
            'audio'         =>  'Audio',
            'link'          =>  'Link',
            'video'         =>  'Video',
            'image'         =>  'Image',
            'quote'         =>  'Quote',
        );
        $formats = apply_filters('awe_format_types',$types);
        wp_nonce_field( $this->format['type'].'_save', $this->format['type'].'_nonce' );
        $value = $this->get_custom_fields('format',array('format'      =>  'standard')) ;
        ?>
        <div id="post-formats-select">
            <?php foreach($formats as $key=>$name):?>
            <input type="radio" <?php checked($value,$key);?> value="<?php echo $key;?>" id="post-format-<?php echo $key;?>" class="post-format" name="<?php echo $this->format['type']."[format]";?>"> <label class="post-format-icon post-format-<?php echo $key;?>" for="post-format-<?php echo $key;?>"><?php echo $name;?></label>
            <br>
            <?php endforeach;?>
        </div>
        <?php
    }

    /**
     * Generate Pricing Table
     */
    public function awe_pricing_html()
    {
        if(!$this->is_support($this->pricing['type']))
            return;
        wp_nonce_field( $this->pricing['type'].'_save', $this->pricing['type'].'_nonce' );
        $items=  $this->get_custom_fields('pricing',array()) ;
        if($items)
            $items = json_decode($items);

        ?>
        <div class="awe-pricing">
            <ul id="pricing-sortable">
                <?php
                if(is_array($items)):
                    foreach($items as $item):
                 ?>
                <li>
                    <div class="awe-pricing-price">
                        <label>Price</label>
                        <input type="text" class="pricing-price" value="<?php echo $item->price;?>">
                    </div>
                    <div class="awe-pricing-title">
                        <label id="pricing-title">Title</label>
                        <input type="text" class="pricing-title" value="<?php echo $item->title;?>">
                    </div>
                    <div class="awe-pricing-currency">
                        <label id="pricing-currency">currency</label>
                        <input type="text" class="pricing-currency" value="<?php echo $item->currency;?>">
                    </div>
                    <div class="awe-pricing-time">
                        <label id="pricing-time">Time</label>
                        <input type="text" class="pricing-time" value="<?php echo $item->time;?>">
                    </div>
                    <!-- <div class="awe-pricing-desc">
                        <label id="pricing-desc">Description</label>
                        <input type="text" class="pricing-desc" value="<?php echo $item->desc;?>">
                    </div> -->
                    <div class="awe-pricing-offer">
                        <label>Offers</label>
                        <div class="awe-pricing-offer-items">
                            <?php if(is_array($item->offers)):?>
                            <?php foreach($item->offers as $offer):?>
                            <div class="awe-pricing-offer-item">
                                <input type="text" class="pricing-offer-item" value="<?php echo $offer;?>">
                                <a href="#" class="pricing-offer-remove fa fa-trash-o"></a>
                            </div>
                            <?php endforeach;?>
                            <?php endif;?>
                        </div>
                        <input type="button" class="add-offer pricing-offer-add" value="Add Offer">
                    </div>
                    <div class="awe-pricing-url">
                        <label>Url</label>
                        <input type="text" class="pricing-url" value="<?php echo $item->url;?>">
                    </div>
                    <div class="awe-pricing-remove">
                        <a href="#" class="pricing-button pricing-item-remove">Remove</a>
                        <a href="#" class="pricing-button pricing-item-clone">Clone</a>
                    </div>
                </li>
                <?php
                    endforeach;
                endif;
                ?>
            </ul>

        </div>
        <div class="awe-pricing-addmore">
            <input type="hidden" class="pricing-value" name="<?php echo $this->pricing['type']."[pricing]";?>" value='<?php echo json_encode($items);?>'>
            <input type="button" value="Add More" class="button button-primary button-large pricing-add-more">
            <li style="display: none" class="clone">
                <div class="awe-pricing-price">
                    <label>Price</label>
                    <input type="text" class="pricing-price">
                </div>
                <div class="awe-pricing-title">
                    <label id="pricing-title">Title</label>
                    <input type="text" class="pricing-title" >
                </div>
                <div class="awe-pricing-currency">
                    <label id="pricing-currency">currency</label>
                    <input type="text" class="pricing-currency" value="">
                </div>
                <div class="awe-pricing-time">
                    <label id="pricing-time">Time</label>
                    <input type="text" class="pricing-time" value="">
                </div>
                <!-- <div class="awe-pricing-desc">
                    <label id="pricing-desc">Description</label>
                    <input type="text" class="pricing-desc" value="1">
                </div> -->
                <div class="awe-pricing-offer">
                    <label>Offers</label>
                    <div class="awe-pricing-offer-items">
                        <div class="awe-pricing-offer-item">
                            <input type="text" class="pricing-offer-item">
                            <a href="#" class="pricing-offer-remove  fa fa-trash-o"></a>
                        </div>
                    </div>
                    <input type="button" class="add-offer pricing-offer-add" value="Add Offer">
                </div>
                <div class="awe-pricing-url">
                    <label>Url Button</label>
                    <input type="text" class="pricing-url">
                </div>
                <div class="awe-pricing-remove">
                    <a href="#" class="pricing-button pricing-item-remove">Remove</a>
                    <a href="#" class="pricing-button pricing-item-clone">Clone</a>
                </div>
            </li>
        </div>
        <?php

    }

    /**
     * Gererate Social Box
     */
    public function awe_social_html()
    {
        if(!$this->is_support($this->social['type']))
            return;
        wp_nonce_field( $this->social['type'].'_save', $this->social['type'].'_nonce' );
        $social = array(
            'facebook'  =>  'fa-facebook-square',
            'google'    =>  'fa-google-plus',
            'twitter'   =>  'fa-twitter-square',
            'github'    =>  'fa-github-square',
            'instagram' =>  'fa-instagram',
            'pinterest' =>  'fa-pinterest-square',
            'linkedin'  =>  'fa-linkedin-square',
            'skype'     =>  'fa-skype',
            'tumblr'    =>  'fa-tumblr-square',
            'youtube'   =>  'fa-youtube-square',
            'vimeo'     =>  'fa-vimeo-square',
            'dribbble'  =>  'fa-dribbble'
        );
        $social = apply_filters($this->social['type'].'_fields',$social);
        $default = array();
        ?>
        <div class="awe-social">
            <ul>
                <?php $values = $this->get_custom_fields('social',array()) ;?>
                <?php foreach($social as $type=>$icon):?>
                    <?php $value = (isset($values[$type]))?$values[$type]:"";?>
                <li>
                    <label for="<?php echo $type;?>"><i class="fa <?php echo $icon;?>"></i></label>
                    <input type="text" class="medium" value="<?php echo $value;?>" id="<?php echo $type;?>" size="30" name="<?php echo $this->social['type']."[social][".$type."]";?>">
                </li>
                <?php endforeach;?>
            </ul>
        </div>

        <?php
    }

    /**
     * Generate Detail Editor base on Wp Editor
     */
    public function awe_detail_editor_html()
    {
        if(!$this->is_support($this->detail_editor['type']))
            return;
        wp_nonce_field( $this->detail_editor['type'].'_save', $this->detail_editor['type'].'_nonce' );
        $default = array('detail'=>'');
        $value=  $this->get_custom_fields('detail',$default) ;
        wp_editor( htmlspecialchars_decode($value), $this->detail_editor['type'].'detail', $settings = array('textarea_name'=>$this->detail_editor['type'].'[detail]','textarea_rows'=>'5','media_buttons'=>true,'tinymce'=>true) );
    }

    /**
     * Generate Offer Options
     */
    public function awe_offer_html()
    {
        if(!$this->is_support($this->offer['type']))
            return;
        wp_nonce_field( $this->offer['type'].'_save', $this->offer['type'].'_nonce' );
        $value = $this->get_custom_fields('offer',false);
        ?>
        <div class="awe-offer">
            <div class="awe-offer-fields">
            <?php if(is_array($value) && count($value)>0):?>
                <?php foreach($value as $i):?>
                    <div class="offer-item"><input name="<?php echo $this->offer['type'];?>[offer][]" class="medium" type="text" value="<?php echo $i;?>"><a href="#" class="remove-offer">Delete</a></div>
                <?php endforeach;?>
            <?php else:?>
                <div class="offer-item"><input name="<?php echo $this->offer['type'];?>[offer][]" class="medium" type="text" value=""><a href="#" class="remove-offer">Delete</a></div>
            <?php endif;?>

            </div>
            <div class="awe-offer-price-show">
                <input type="checkbox" id="show-price"  value="1" name="<?php echo $this->offer['type'];?>[offer_show_price]" <?php checked($this->get_custom_fields('offer_show_price',false),1) ?>>
                <label for="show-price"><?php _e('Display Price',self::LANG);?></label>
            </div>
            <div class="awe-offer-price" <?php if($this->get_custom_fields('offer_show_price',false)==0):?> style="display: none"<?php endif;?>><input type="text" name="<?php echo $this->offer['type'];?>[offer_price]" class="medium" type="text" value="<?php echo $this->get_custom_fields('offer_price',false);?>" placeholder="Pricing">$</div>
            <input type="button" class="button button-primary button-large offer-add-more" value="Add More">
        </div>
        <?php

    }

    /**
     * Generate Features Options
     */
    public function awe_feature_html()
    {
        if(!$this->is_support($this->feature['type']))
            return;
        wp_nonce_field( $this->feature['type'].'_save', $this->feature['type'].'_nonce' );
        ?>
        <div class="awe-feature">
            <div class="awe-feature-all-items clearfix">
                <?php
                $count=0;
                $features = $this->get_custom_fields('features',array());
                ?>
                <?php if(is_array($features) && count($features)>0):?>
                    <?php foreach($features as $num=>$value):?>
                        <?php $count++;?>
                <div class="awe-feature-item" num="<?php echo $num;?>">
                    <div class="awe-feature-left">
                        <div class="awe-feature-logo-option">
                            <input type="radio" name="<?php echo $this->feature['type'];?>[features][<?php echo $num;?>][logo_type]" value="none" <?php checked($value['logo_type'],'none');?>> None
                            <input type="radio" name="<?php echo $this->feature['type'];?>[features][<?php echo $num;?>][logo_type]" value="icon" <?php checked($value['logo_type'],'icon');?>> Icon
                            <input type="radio" name="<?php echo $this->feature['type'];?>[features][<?php echo $num;?>][logo_type]" value="image" <?php checked($value['logo_type'],'image');?>> Image
                        </div>
                        <div class="awe-feature-logo-preview">
                            <div class="awe-feature-logo-none" <?php if($value['logo_type']!='none'):?> style="display: none"<?php endif;?>>
                                none
                            </div>
                            <div class="awe-feature-logo-icon" <?php if($value['logo_type']!='icon'):?> style="display: none"<?php endif;?>>
                                <a href="#" class="choose-icon"><i class="<?php echo $value['logo_icon'];?>"></i></a>
                                <input type="hidden" class="input-icon skill-icon" value="<?php echo $value['logo_icon'];?>" name="<?php echo $this->feature['type'];?>[features][<?php echo $num;?>][logo_icon]">
                            </div>
                            <div class="awe-feature-logo-image" <?php if($value['logo_type']!='image'):?> style="display: none"<?php endif;?>>
                                <a href="#" class="photo"><img src="<?php echo $value['logo_img'];?>"></a>
                                <input type="hidden" class="input-photo" id="position" value="<?php echo $value['logo_img'];?>" name="<?php echo $this->feature['type'];?>[features][<?php echo $num;?>][logo_img]">
                            </div>
                        </div>
                    </div>

                    <div class="awe-feature-right">
                        <div class="awe-feature-title">
                            <input class="medium"  placeholder="Feature Name" type="text" name="<?php echo $this->feature['type'];?>[features][<?php echo $num;?>][title]" value="<?php echo $value['title'];?>">
                        </div>
                        <div class="awe-feature-desc">
                            <textarea class="medium" placeholder="Feature Description" t name="<?php echo $this->feature['type'];?>[features][<?php echo $num;?>][desc]"><?php echo $value['desc'];?></textarea>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
<!--                --><?php //else:?>
<!--                    <div class="awe-feature-item" num="1">-->
<!--                        <div class="awe-feature-left">-->
<!--                            <div class="awe-feature-logo-option">-->
<!--                                <input type="radio" name="--><?php //echo $this->feature['type'];?><!--[features][1][logo_type]" value="none" checked="checked"> None-->
<!--                                <input type="radio" name="--><?php //echo $this->feature['type'];?><!--[features][1][logo_type]" value="icon"> Icon-->
<!--                                <input type="radio" name="--><?php //echo $this->feature['type'];?><!--[features][1][logo_type]" value="image"> Image-->
<!--                            </div>-->
<!--                            <div class="awe-feature-logo-preview">-->
<!--                                <div class="awe-feature-logo-none">-->
<!--                                    <img src="--><?php //echo AWE_ROOT_URL."asset/images/none.jpg";?><!--">-->
<!--                                </div>-->
<!--                                <div class="awe-feature-logo-icon" style="display: none">-->
<!--                                    <a href="#" class="choose-icon"><i class="fa fa-facebook-square"></i></a>-->
<!--                                    <input type="hidden" class="input-icon" value="" name="--><?php //echo $this->feature['type'];?><!--[features][1][logo_icon]"">-->
<!--                                </div>-->
<!--                                <div class="awe-feature-logo-image" style="display: none">-->
<!--                                    <a href="#" class="photo"><img src="--><?php //echo AWE_ROOT_URL."asset/images/logo2.jpg";?><!--"></a>-->
<!--                                    <input type="hidden" size="70" class="input-photo" id="position" value="" name="--><?php //echo $this->feature['type'];?><!--[features][1][logo_img]">-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!---->
<!--                        <div class="awe-feature-right">-->
<!--                            <div class="awe-feature-title">-->
<!--                                <input type="text" size="20" name="--><?php //echo $this->feature['type'];?><!--[features][1][title]" placeholder="Title">-->
<!--                            </div>-->
<!--                            <div class="awe-feature-desc">-->
<!--                                <textarea name="--><?php //echo $this->feature['type'];?><!--[features][1][desc]" rows="3" cols="20" placeholder="Description"></textarea>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
                <?php endif;?>

            </div>
            <div class="awe-feature-item feature-clone" feature-name="<?php echo $this->feature['type'];?>" style="display: none">
                <div class="awe-feature-left">
                    <div class="awe-feature-logo-option">
                        <input type="radio" name="" value="none" checked="checked"> None
                        <input type="radio" name="" value="icon"> Icon
                        <input type="radio" name="" value="image"> Image
                    </div>
                    <div class="awe-feature-logo-preview">
                        <div class="awe-feature-logo-none">
                            none
                        </div>
                        <div class="awe-feature-logo-icon" style="display: none">
                            <a href="#" class="choose-icon"><i class="fa fa-facebook-square"></i></a>
                            <input type="hidden" class="input-icon" value="fa fa-facebook-square" name="">
                        </div>
                        <div class="awe-feature-logo-image" style="display: none">
                            <a href="#" class="photo"><img src="<?php echo AWE_ROOT_URL."asset/images/logo2.jpg";?>"></a>
                            <input type="hidden" class="input-photo" id="position" value="<?php echo AWE_ROOT_URL."asset/images/logo2.jpg";?>" name="">
                        </div>
                    </div>
                </div>

                <div class="awe-feature-right">
                    <div class="awe-feature-title">
                        <input class="medium" placeholder=" Feature Name" type="text" size="20" name="" placeholder="Title">
                    </div>
                    <div class="awe-feature-desc">
                        <textarea class="medium" name="" placeholder="Feature Description"></textarea>
                    </div>
                </div>
            </div>
            <input type="button" class="button button-primary button-large feature-add-more" value="Add More">
        </div>


    <?php
    }

    /**
     * Generate Skills Options
     */
    public function awe_skill_html()
    {
        if(!$this->is_support($this->skill['type']))
            return;
        wp_nonce_field( $this->skill['type'].'_save', $this->skill['type'].'_nonce' );
        ?>
        <div class="awe-skills">
            <?php $skills = $this->get_custom_fields('skills',array());?>
            <div class="all-skills">
                <?php $count=0;?>
                <?php if(is_array($skills) && count($skills)>0):?>
                    <?php foreach($skills as $num => $value):?> 
                        <?php $count++;?>
                        <div class="skill-item" num="<?php echo $num;?>">
                            <!-- <a href="#" class="choose-icon"><i class="<?php //echo $value['icon'];?>"></i></a> -->
                            <input type="hidden" class="input-icon skill-icon" value="<?php echo $value['icon'];?>" name="<?php echo $this->skill['type'];?>[skills][<?php echo $num;?>][icon]">

                            <!-- Skill Range -->
                            <div class="skill-custom">
                                <div class="piechart">
                                    <span data-percent="<?php echo $value['pro'];?>" class="chart">
                                        <span class="percent"><?php echo $value['pro'];?></span>
                                    </span>
                                </div>
                                <div class="skill-range"></div>
                            </div>

                            <input type="hidden" class="skill-pro" value="<?php echo $value['pro'];?>" name="<?php echo $this->skill['type'];?>[skills][<?php echo $num;?>][pro]" placeholder="<?php _e('Professional (%)',self::LANG);?>">
                            <input type="text" class="small skill-name" value="<?php echo $value['name'];?>" name="<?php echo $this->skill['type'];?>[skills][<?php echo $num;?>][name]" placeholder="<?php _e('Skill name',self::LANG);?>">
                            <input type="text" class="medium skill-desc" value="<?php echo $value['desc'];?>" name="<?php echo $this->skill['type'];?>[skills][<?php echo $num;?>][desc]" placeholder="<?php _e('Skill description',self::LANG);?>">
                        </div>
                    <?php endforeach;?>
                    <?php else:?>
                        <div class="skill-item" num="1">
                           <!-- <a href="#" class="choose-icon"><i class="fa fa-html5"></i></a> -->
                            <!-- <a class="choose-icon" href="#"><i class="fa fa-html5"></i></a> -->

                            <!-- Skill Range -->
                            <div class="skill-custom">
                                <div class="piechart">
                                 <span data-percent="0" class="chart">
                                    <span class="percent">0</span>
                                 </span>
                                </div>
                                <div class="skill-range"></div>
                            </div>

                            <input type="hidden" class="input-icon skill-icon" value="fa fa-html5" name="--><?php echo $this->skill['type'];?>[skills][1][icon]">
                            <input type="hidden" class="skill-pro" value="" name="<?php echo $this->skill['type'];?>[skills][1][pro]" placeholder="<?php _e('Professional (%)',self::LANG);?>">
                            <input type="text" class="small skill-name" value="" name="<?php echo $this->skill['type'];?>[skills][1][name]" placeholder="<?php _e('Skill name',self::LANG);?>">
                            <input type="text" class="medium skill-desc" value="" name="<?php echo $this->skill['type'];?>[skills][1][desc]" placeholder="<?php _e('Skill description',self::LANG);?>">
                       </div>
                    <?php endif;?>
                <?php $count++;?>
                <div class="clear"></div>
            </div>
            <div class="addmore-action">
                <div class="skill-item skill-clone" num="" style="display:none" skill-name="<?php echo $this->skill['type'];?>">
                     <!-- Skill Range -->
                    <div class="skill-custom">
                        <div class="piechart">
                            <span data-percent="0" class="chart">
                                <span class="percent">0</span>
                            </span>
                        </div>
                        <div class="skill-range"></div>
                    </div>

                    <input type="hidden" name="" value="fa fa-html5" class="input-icon">
                    <input type="hidden" placeholder="<?php _e('Professional (%)',self::LANG);?>" name="" value="" class="skill-pro" type="text">
                    <input placeholder="<?php _e('Skill name',self::LANG);?>" name="" value="" class="small skill-name" type="text">
                    <input placeholder="<?php _e('Skill description',self::LANG);?>" name="" value="" class="medium skill-desc" type="text">
                </div>
                <input type="button" class="button button-primary button-large skill-add-more" value="Add more">
            </div>
        </div>
        <?php
    }

    /** Generate Fun Fact Html */
    public function awe_funfact_html()
    {
        if(!$this->is_support($this->funfact['type']))
            return;
        wp_nonce_field( $this->funfact['type'].'_save', $this->funfact['type'].'_nonce' );
        ?>
        <div class="awe-funfacts">
            <?php $funfacts = $this->get_custom_fields('funfacts',array());?>
            <div class="all-funfacts">
                <?php $count=0;?>
                <?php if(is_array($funfacts) && count($funfacts)>0):?>
                    <?php foreach($funfacts as $num => $value):?>
                        <?php $count++;?>
                        <div class="funfact-item" num="<?php echo $num;?>">
                            <div class="funfact-item-inner">
                                 <a href="#" class="choose-icon"><i class="<?php echo $value['icon'];?>"></i></a>
                                <input type="hidden" class="input-icon" value="<?php echo $value['icon'];?>" name="<?php echo $this->funfact['type'];?>[funfacts][<?php echo $num;?>][icon]">
                                <input class="small funfact-total" placeholder="Ex: any numbers..." type="text" value="<?php echo $value['total'];?>" name="<?php echo $this->funfact['type'];?>[funfacts][<?php echo $num;?>][total]" placeholder="<?php _e('Total',self::LANG);?>">
                                <input class="medium funfact-title" placeholder="Ex: project, client,..." type="text" value="<?php echo $value['name'];?>" name="<?php echo $this->funfact['type'];?>[funfacts][<?php echo $num;?>][name]" placeholder="<?php _e('Title',self::LANG);?>">
                            </div>                                
                        </div>
                    <?php endforeach;?>
                <?php else:?>
                    <div class="funfact-item" num="1">
                        <div class="funfact-item-inner">
                             <a href="#" class="choose-icon"><i class="fa fa-html5"></i></a>
                            <input type="hidden" class="input-icon" value="fa fa-html5" name="<?php echo $this->funfact['type'];?>[funfacts][1][icon]">
                            <input class="small funfact-total" placeholder="Ex: any numbers..." type="text" type="text" value="" name="<?php echo $this->funfact['type'];?>[funfacts][1][total]" placeholder="<?php _e('Total',self::LANG);?>">
                            <input class="medium funfact-title" placeholder="Ex: project, client,..." type="text" value="" name="<?php echo $this->funfact['type'];?>[funfacts][1][name]" placeholder="<?php _e('Title',self::LANG);?>">
                        </div>  
                    </div>
                <?php endif;?>
            </div>
            <div class="addmore-action">
                <div class="funfact-item funfact-clone" num="" style="display:none" funfact-name="<?php echo $this->funfact['type'];?>">
                    <div class="funfact-item-inner">
                         <a class="choose-icon" href="#"><i class="fa fa-html5"></i></a>
                        <input type="hidden" name="" value="fa fa-html5" class="input-icon">
                        <input type="text" name="" value="" class="small funfact-total" placeholder="Ex: any numbers...">
                        <input type="text" name="" value="" class="medium funfact-title" placeholder="Ex: project, client,...">
                    </div>                
                </div>
                <!-- Button Add More -->
                <input type="button" class="button button-primary button-large funfact-add-more" value="Add more">
            </div>
        </div>
    <?php
    }
    /**
     * Generate Resume CV Profile HTML
     */
    public function awe_resume_html()
    {
        if(!$this->is_support($this->resume['type']))
            return;
        wp_nonce_field( $this->resume['type'].'_save', $this->resume['type'].'_nonce' );
        ?>
            <div class="awe-resume">
                <?php $items = $this->get_custom_fields('resumes',array());?>
                <div class="awe-resume-all-items">
                    <div class="awe-resume-download">
                        <label>Link Download Resume
                            <input class="big" type="text" placeholder="<?php _e("Enter your Resume CV url",self::LANG);?>" name="<?php echo $this->resume['type'];?>[resume_url]" value="<?php echo $this->get_custom_fields('resume_url',false);?>">
                            <input type="button" value="Upload" class="button button-large upload-resume">
                        </label>
                    </div>
                <?php $count=0;?>
                <?php if(is_array($items) && count($items)>0):?>

                <?php foreach($items as $num => $value):?>
                    <?php $count++;?>
                    <!-- Resume Item -->
                    <div class="awe-resume-item" num="<?php echo $count;?>">
                        <div class="awe-resume-item-left">
                            <div class="awe-resume-item-time">
                                <input class="mini" type="text" size="30" class="resume-time" name="<?php echo $this->resume['type'];?>[resumes][<?php echo $num;?>][time]" value="<?php echo $value['time'];?>" placeholder="Prior time">
                            </div>
                            <div class="awe-resume-item-type">
                                <select name="<?php echo $this->resume['type'];?>[resumes][<?php echo $num;?>][type]" class="resume-type">
                                    <option <?php selected($value['type'],'work');?> value="work">Work</option>
                                    <option <?php selected($value['type'],'education');?> value="education">Eduction</option>
                                </select>
                            </div>
                        </div>
                        <div class="awe-resume-item-right">
                            <div class="awe-resume-item-title">
                                <input class="medium" type="text" size="30" class="resume-title" name="<?php echo $this->resume['type'];?>[resumes][<?php echo $num;?>][title]" placeholder="Title" value="<?php echo $value['title'];?>">
                            </div>
                            <div class="awe-resume-item-position">
                                <input class="small" type="text" size="30" class="resume-position" name="<?php echo $this->resume['type'];?>[resumes][<?php echo $num;?>][position]" value="<?php echo $value['position'];?>" placeholder="Position">
                            </div>
                            <div class="awe-resume-item-desc">
                                <textarea name="<?php echo $this->resume['type'].'[resumes]['.$num.'][desc]';?>" class="resume-desc" placeholder="Writing an introduction, here ..."><?php echo $value['desc'];?></textarea>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <!-- End Resume Item -->
                    <?php endforeach;?>
                    <?php else:?>

                    <div class="awe-resume-item" num="1">
                        <div class="awe-resume-item-left">
                            <div class="awe-resume-item-time">
                                <input class="mini" type="text" size="30" class="resume-time" name="<?php echo $this->resume['type'];?>[resumes][1][time]" placeholder="Prior time">
                            </div>
                            <div class="awe-resume-item-type">
                                <select name="<?php echo $this->resume['type'];?>[resumes][1][type]" class="resume-type">
                                    <option value="work">Work</option>
                                    <option value="education">Eduction</option>
                                </select>
                            </div>
                        </div>
                        <div class="awe-resume-item-right">
                            <div class="awe-resume-item-title">
                                <input class="medium" type="text" size="30" class="resume-title" name="<?php echo $this->resume['type'];?>[resumes][1][title]" placeholder="Title">
                            </div>
                            <div class="awe-resume-item-position">
                                <input class="small" type="text" size="30" class="resume-position" name="<?php echo $this->resume['type'];?>[resumes][1][position]" placeholder="Position">
                            </div>
                            <div class="awe-resume-item-desc">
                                <textarea class="resume-desc" name="<?php echo $this->resume['type'];?>[resumes][1][desc]" placeholder="Writing an introduction, here ..."></textarea>
                            </div>
                        </div>
                    </div>
                <?php endif;?>

                </div>
                <div class="addmore-action">
                    <div class="awe-resume-item resume-clone" resume-name="<?php echo $this->resume['type'];?>" num="" style="display: none">
                        <div class="awe-resume-item-left">
                            <div class="awe-resume-item-time">
                                <input class="mini resume-time" type="text" size="30" class="resume-time" name="" placeholder="Prior time">
                            </div>
                            <div class="awe-resume-item-type">
                                <select name="" class="resume-type">
                                    <option value="work">Work</option>
                                    <option value="education">Education</option>
                                </select>
                            </div>
                        </div>
                        <div class="awe-resume-item-right">
                            <div class="awe-resume-item-title">
                                <input class="medium resume-title" type="text" size="30" class="resume-title" name="" placeholder="Title">
                            </div>
                            <div class="awe-resume-item-position">
                                <input class="small resume-position" type="text" size="30" class="resume-position" name="" placeholder="Position">
                            </div>
                            <div class="awe-resume-item-desc">
                                <textarea class="resume-desc" name="" placeholder="Writing an introduction, here ..."></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- Button Add More -->
                    <input type="button" class="button button-primary button-large resume-add-more" value="Add More">
                </div>

            </div>
        <?php
    }

    /**
     * Generate Media
     */

    public function awe_media_html()
    {
        if(!$this->is_support($this->media['type']))
            return;
        wp_nonce_field( $this->media['type'].'_save', $this->media['type'].'_nonce' );
        ?>
        <div class="awe-media" media-name="<?php echo $this->media['type'];?>">
            <div class="awe-media-select">
                <div class="content clearfix">
                    <?php
                    $default_types =  array(
                        'video'     =>  "Video",
                        'audio'     =>  "Audio",
                        'gallery'   =>  'Gallery - Image',
                        'link'      =>  'Link',
                        'quote'     =>  'Quote'
                    );
                    $screen = get_current_screen();
                    $types = apply_filters("awe_media_post_type_".$screen->post_type,$default_types);
                    $media_type = $this->get_custom_fields('media_type',array('media_type'=>'video'));
                    ?>
                    <select name="<?php echo $this->media['type'];?>[media_type]">
                        <?php foreach($types as $value=>$name):?>
                        <option value="<?php echo $value;?>" <?php selected($media_type,$value);?>><?php echo $name;?></option>
                        <?php endforeach;?>

                    </select>
                </div>
            </div>
            <div class="awe-media-quote" <?php if($media_type!='quote'):?>style="display: none"<?php endif;?>>
                <div class="content clearfix">
                    <?php
                    $quote = $this->get_custom_fields('quote',array("quote"=>array('text'=>'','source'=>'')));
                    ?>
                    <div class="awe-media-quote-text">
                        <label>Quote</label>
                        <textarea name="<?php echo $this->media['type']."[quote][text]";?>"><?php echo stripslashes($quote['text']);?></textarea>
                    </div>
                    <div class="awe-media-quote-source">
                        <label>Source</label>
                        <input type="text" name="<?php echo $this->media['type']."[quote][source]";?>" value="<?php echo $quote['source'];?>">
                    </div>
                </div>
            </div>
            <div class="awe-media-link" <?php if($media_type!='link'):?>style="display: none"<?php endif;?>>
                <?php
                $link = $this->get_custom_fields('link',array('link'=>array('title'=>'','url'=>'#','anchor'=>'')));
                ?>
                <div class="content clearfix">
                    <div class="awe-media-link-title">
                        <label>Title</label>
                        <input type="text" name="<?php echo $this->media['type']."[link][title]";?>" value="<?php echo $link['title'];?>">
                    </div>
                    <div class="awe-media-link-url">
                        <label>Url</label>
                        <input type="text" name="<?php echo $this->media['type']."[link][url]";?>" value="<?php echo $link['url'];?>">
                    </div>
                    <div class="awe-media-link-anchor-text">
                        <label>Anchor Text</label>
                        <input type="text" name="<?php echo $this->media['type']."[link][anchor]";?>" value="<?php echo $link['anchor'];?>">
                    </div>
                </div>
            </div>
            <div class="awe-media-audio" <?php if($media_type!='audio'):?>style="display: none"<?php endif;?>>
                <div class="content clearfix">
                    <?php
                    $audio = $this->get_custom_fields('audio',array('audio'=>array('link'=>'','auto_play'=>'true')));
                    ?>
                    <ul>
                        <li>
                            <label>Link</label>
                            <ul>
                                <li><input type="text" value="<?php echo $audio['link'];?>" class="awe-audio-link" id="awe-audio-link" name="<?php echo $this->media['type']."[audio][link]";?>"></li>
                            </ul>
                        </li>
                        <!-- Default Settings -->
                        <li>
                            <label>Auto Play</label>
                            <ul>
                                <li><input type="radio" <?php checked($audio['auto_play'],'true');?> value="true" class="awe-audio-auto-play" id="On" name="<?php echo $this->media['type']."[audio][auto_play]";?>"><label for="On">On</label></li>
                                <li><input type="radio" <?php checked($audio['auto_play'],'false');?> value="false" class="awe-audio-auto-play" id="Off" name="<?php echo $this->media['type']."[audio][auto_play]";?>"><label for="Off">Off</label></li>

                            </ul>
                        </li>
                        <li>
                            <label>Live Preview <small>(your latest track)</small></label>
                            <script src="//connect.soundcloud.com/sdk.js"></script>
                            <div class="awe-audio-preview">
                                <?php if(isset($audio['link']) && !empty($audio['link'])):?>

                                    <?php
                                        if(preg_match("/\/sets\//i",$audio['link']) || preg_match("/\/sets\//i",$audio['link']))
                                            $maxheight = "450px";
                                        else $maxheight = "166px";
                                    ?>
                                <div id="soundcloud-preview"></div>
                                <script type="text/JavaScript">
                                    SC.oEmbed("<?php echo $audio['link'];?>", {color: "ff0066",auto_play: <?php echo $audio['auto_play'];?>,maxheight:"<?php echo $maxheight;?>"},  document.getElementById("soundcloud-preview"));
                                </script>
                                <?php endif;?>
                            </div>
                        </li>
                    </ul>

                </div>
            </div>
            <div class="awe-media-gallery" <?php if($media_type!='gallery'):?>style="display: none"<?php endif;?>>
                <div class="content clearfix">

                    <?php
                    $gallery = $this->get_custom_fields('gallery',array());
                    if(is_array($gallery))
                        foreach($gallery as $img)
                            echo "
                            <div class=\"item\">
                                <img src=\"{$img}\"><input type=\"hidden\" name=\"{$this->media['type']}[gallery][]\" value=\"{$img}\">
                                <span class=\"dashicons dashicons-no-alt del-image\"></span>
                            </div>";
                    else{

                        echo "<div class=\"image-none \">
                                <img src=\"".AWE_ROOT_URL."asset/images/image-none.png\">
                            </div>";
                    }

                    ?>
                </div>
                
                <div class="add-image"><input type="button" class="button button-primary button-large media-add-gallery" value="Add Image"></div>
            </div>
            <div class="awe-media-video" <?php if($media_type!='video'):?>style="display: none"<?php endif;?>>
                <div class="content clearfix">
                    <?php
                    $videos = $this->get_custom_fields('videos',array());

                    if(is_array($videos))
                        foreach($videos as $video){
                            $v = (array)json_decode($video);
                            echo "<div class=\"item\">
                                <img src=\"{$v['image']}\">
                                <input type=\"hidden\" name=\"{$this->media['type']}[videos][]\" value='{$video}'>
                                <div class=\"dashicons dashicons-video-alt3 pattern\"></div>
                                <span class=\"dashicons dashicons-no-alt del-image\"></span>
                            </div>";
                        }
                    else{
                        echo "<div class=\"item video-none\">
                                <img src=\"".AWE_ROOT_URL."asset/images/video-none.png\">
                            </div>";
                    }
                    ?>
                </div>

                <div class="add-video">
                    <input class="awe-new-video-url medium" type="text" placeholder="Enter Youtube or Vimeo Url">
                    <input type="button" class="button button-primary button-large media-add-video" value="Add Video">
                    <p><?php _e("Note:",self::LANG);?></p>
                    <p><?php _e("Vimeo url like: <strong> http://vimeo.com/27260633</strong>",self::LANG);?></p>
                    <p><?php _e("Youtube url like: <strong> https://www.youtube.com/watch?v=KV2ssT8lzj8</strong>",self::LANG);?></p>
                </div>
            </div>
        </div>

        <?php
    }
    /**
     * Generate Font Icon html
     *
     */
    public function font_icon_panel()
    {
        include(AWE_ROOT_DIR."/modules/font/icons_tpl.php");
    }

    /**
     * Save meta data
     * @param $post_id
     * @param $post
     */
    public function meta_save($post_id, $post)
    {
        if(!is_admin())
            return;
        $reset_values = array(
            'awe_skill'     =>  array('skills'=>''),
            'awe_resume'    =>  array('resumes'=>'','resume_url'=>''),
            'awe_funfact'   =>  array('funfacts'=>''),
            'awe_feature'   =>  array('features'=>''),
            'awe_media'     =>  array('videos'=>'','gallery'=>''),
            'awe_offer'     =>  array('offer'   =>''),
            'awe_pricing'   =>  array('pricing'   =>''),
            'awe_format'   =>  array('format'   =>'standard'),
        );
        foreach($this->total as $i)
        {
            if($this->is_support($i['type']))
            {
                if(isset($_POST[$i['type']])){
                    $data = wp_parse_args( $_POST[$i['type']], array() );
                    if($i['type']=='awe_resume' && !isset($_POST[$i['type']]['resumes']) && empty($_POST[$i['type']]['resume_url']))
                        $data = $reset_values[$i['type']];
                    if($i['type']=='awe_offer' && !isset($_POST[$i['type']]['offer']) && empty($_POST[$i['type']]['offer_price']))
                        $data = $reset_values[$i['type']];

                    if($i['type']=='awe_pricing' && !isset($_POST[$i['type']]['pricing']))
                        $data = $reset_values[$i['type']];
                    if($i['type']=='awe_format' && !isset($_POST[$i['type']]['format']))
                        $data = $reset_values[$i['type']];

                    if($i['type']=='awe_offer' && isset($_POST[$i['type']]['offer'])){
                        $data = $this->array_remove_empty($data);
                    }
                }else{
                    $data = isset($reset_values[$i['type']])?$reset_values[$i['type']]:array();
                }
                $this->save_custom_fields( $data, $i['type'].'_save', $i['type'].'_nonce', $post );
            }
        }

    }

    /**
     * Remove empty element in deep array
     * @param $haystack
     *
     * @return mixed
     */
    public function array_remove_empty($haystack)
    {
        foreach ($haystack as $key => $value) {
            if (is_array($value)) {
                $haystack[$key] = $this->array_remove_empty($haystack[$key]);
            }

            if (empty($haystack[$key])) {
                unset($haystack[$key]);
            }
        }

        return $haystack;
    }

}

