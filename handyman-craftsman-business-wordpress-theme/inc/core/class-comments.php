<?php
namespace Handyman\Core;

/**
 * Class Comments
 * @package Handyman\Core
 */
class Comments{


    public static $single;


    public function __construct()
    {
        self::$single = $this;

        // Filter default fields
        add_filter('comment_form_default_fields', array($this, 'commentFormDefaultFields'));

        // Alter markup
        add_filter('comment_form_defaults', array($this, 'commentFormDefaults'));
    }


    /**
     * @param $fields
     */
    public function commentFormDefaultFields($fields)
    {
        unset($fields['url']);
        return $fields;
    }


    /**
     * @param $params
     * @return mixed
     */
    public function commentFormDefaults($params)
    {
        preg_match('/value="([^"]*)"/', $params['fields']['author'], $author);
        preg_match('/value="([^"]*)"/', $params['fields']['email'] , $email);
        preg_match('~<textarea>([^<]*)<\/texterea>~', $params['comment_field'], $comment_field);

        if(!isset($author[1])) $author = ''; else $author = trim($author[1]);
        if(!isset($email[1]))  $email = ''; else $email = trim($email[1]);

        if(!isset($comment_field[1])){
            $comment_field = '';
        }
        else{
            $comment_field[1] = trim($comment_field[1]);
        }

        $params['fields']['author'] = '<div class="comment-form-author span-6 column">
                                            <input placeholder="'.__('Name', TL_DOMAIN).'" id="author" name="author" type="text" value="'.$author.'" aria-required="true" required="required" />
                                       </div>';

        $params['fields']['email']  = '<div class="comment-form-email span-6 column">
                                            <input placeholder="'.__('Email address', TL_DOMAIN).'" id="email" name="email" type="email" value="'.$email.'" aria-describedby="email-notes" aria-required="true" required="required" />
                                       </div>';

        $params['comment_field']    = '<p class="comment-form-comment span-12 column">
                                            <textarea placeholder="'.__('Message', TL_DOMAIN).'" id="comment" name="comment" cols="45" rows="8" aria-describedby="form-allowed-tags" aria-required="true" required="required">'.$comment_field.'</textarea>
                                       </p>';

        $params['comment_notes_before'] = '';
        return $params;
    }
}
