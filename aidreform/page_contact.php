<?php global $cs_node,$cs_counter_node,$cs_theme_option ; 

cs_enqueue_validation_script();



?>

	<script type="text/javascript">

        jQuery().ready(function($) {

            var container = $('');

            var validator = jQuery("#frm<?php echo $cs_counter_node?>").validate({

                messages:{

                	contact_name: '',

                	contact_email:{

                		required: '',

                    	email:'',

                	},

                    subject: {

                        required:'',

                    },

                	contact_msg: '',

       	        },

                errorContainer: container,

                errorLabelContainer: jQuery(container),

                errorElement:'div',

                errorClass:'frm_error',

                meta: "validate"

            });

        });

        function frm_submit<?php echo $cs_counter_node?>(){

            var $ = jQuery;

            $("#submit_btn<?php echo $cs_counter_node?>").hide();

            $("#loading_div<?php echo $cs_counter_node?>").html('<img src="<?php echo get_template_directory_uri()?>/images/ajax-loader.gif" alt="" />');

            $.ajax({

                type:'POST', 

                url: '<?php echo get_template_directory_uri()?>/page_contact_submit.php',

                data:$('#frm<?php echo $cs_counter_node?>').serialize()+'&cs_contact_email=<?php echo $cs_node->cs_contact_email ?>', 

                success: function(response) {

                    //$('#frm').get(0).reset();

                    $("#loading_div<?php echo $cs_counter_node?>").html('');

                    $("#form_hide<?php echo $cs_counter_node?>").hide();

                    $("#succ_mess<?php echo $cs_counter_node?>").show('');

                    $("#succ_mess<?php echo $cs_counter_node?>").html(response);

                    //$('#frm_slide').find('.form_result').html(response);

                }

            });

        }

    </script>

    <div class="element_size_<?php echo $cs_node->contact_element_size; ?>">

    	<header class="cs-heading-title">

            <h2 class="cs-section-title">Send us a message</h2>

        </header>

        <div class="inputforms respond">

            <div class="textsection">

               <div class="succ_mess" id="succ_mess<?php echo $cs_counter_node?>"  style="display:none;"></div>

            </div>

            <div id="form_hide<?php echo $cs_counter_node;?>">

           		<div class="respond fullwidth" id="respond">

                

                <form id="frm<?php echo $cs_counter_node ?>" name="frm<?php echo $cs_counter_node ?>" method="post" action="javascript:<?php echo "frm_submit".$cs_counter_node. "()";

                ?>" novalidate>   

                	           

                    <p class="comment-form-author">

                        <label><?php _e('Name', 'AidReform'); ?><span><?php  _e('(required)','AidReform'); ?></span></label>



                        <input type="text" name="contact_name" id="contact_name" class="nameinput {validate:{required:true}}"   value="" />

                    </p>

                    <p class="comment-form-email">

                        <label><?php _e('Email', 'AidReform'); ?><span><?php  _e('(required)','AidReform'); ?></span></label>

                        <input type="text" name="contact_email" id="contact_email" class="emailinput {validate:{required:true ,email:true}}"   value="" />

                         

                    </p>

                    <p class="comment-form-contact">

                        <label><?php if(isset($cs_theme_option['trans_switcher'])){ if($cs_theme_option['trans_switcher']== "on"){ _e('Subject','AidReform');}} else{ if(isset($cs_theme_option['trans_subject'])){ echo $cs_theme_option['trans_subject']; }} ?><span><?php   _e('(required)','AidReform'); ?></span></label>

                        <input type="text" name="subject" id="subject" class="subjectinput {validate:{required:true}}"   value="" />

                        

                    </p>

                    <p class="comment-form-comment">

                        <label><?php if(isset($cs_theme_option['trans_switcher'])){ if($cs_theme_option['trans_switcher']== "on"){ _e('Message','AidReform');} } else{ if(isset($cs_theme_option['trans_message'])){ echo $cs_theme_option['trans_message']; ?><span><?php   _e('(required)','AidReform');} }?></span></label>

                        <textarea name="contact_msg"   id="contact_msg" class="{validate:{required:true}}" /></textarea>

                        

                    </p>

                 

                    <p class="form-submit">

                        <input type="hidden" value="<?php echo $cs_node->cs_contact_succ_msg ?>" name="cs_contact_succ_msg">

                        <input type="hidden" name="bloginfo" value="<?php echo get_bloginfo() ?>" />

                        <input type="hidden" name="counter_node" value="<?php echo $cs_counter_node ?>" />
                        
                        
                        
                        
                        
                        
                        
                        
                        

                        <input type="submit" value="<?php _e('Submit', 'AidReform'); ?>" id="submit_btn<?php echo $cs_counter_node ?>" class="backcolr btn button-default bgcolr">

						

                        <div id="loading_div<?php echo $cs_counter_node ?>"></div>

                    </p>

                </form>

            </div>

            </div>

         </div>

    </div>

 