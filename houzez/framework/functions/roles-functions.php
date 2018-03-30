<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 08/08/16
 * Time: 10:38 PM
 */

function add_theme_caps() {
    // gets the author role
    $role = get_role( 'administrator' );

    $role->add_cap( 'create_properties' );

    $role->add_cap( 'publish_properties' );
    $role->add_cap( 'read_property' );
    $role->add_cap( 'delete_property' );
    $role->add_cap( 'edit_property' );
    $role->add_cap( 'edit_properties' );
    $role->add_cap( 'delete_properties' );
    $role->add_cap( 'edit_published_properties' );
    $role->add_cap( 'delete_published_properties' );
    $role->add_cap( 'read_private_properties' );
    $role->add_cap( 'delete_private_properties' );
    $role->add_cap( 'edit_others_properties' );
    $role->add_cap( 'delete_others_properties' );
    $role->add_cap( 'edit_private_properties' );
    $role->add_cap( 'delete_private_properties' );
    $role->add_cap( 'edit_published_properties' );

    $role->add_cap( 'delete_user_package_info' );
    $role->add_cap( 'edit_user_packages' );
    $role->add_cap( 'delete_others_user_packages' );

    $role->add_cap( 'read_testimonial' );
    $role->add_cap( 'edit_testimonial' );
    $role->add_cap( 'delete_testimonial' );
    $role->add_cap( 'create_testimonials' );
    $role->add_cap( 'publish_testimonials' );
    $role->add_cap( 'edit_testimonials' );
    $role->add_cap( 'edit_published_testimonials' );
    $role->add_cap( 'delete_published_testimonials' );
    $role->add_cap( 'delete_testimonials' );
    $role->add_cap( 'delete_private_testimonials' );
    $role->add_cap( 'delete_others_testimonials' );
    $role->add_cap( 'edit_others_testimonials' );
    $role->add_cap( 'edit_private_testimonials' );
    $role->add_cap( 'edit_published_testimonials' );

    $role->add_cap( 'read_agent' );
    $role->add_cap( 'delete_agent' );
    $role->add_cap( 'edit_agent' );
    $role->add_cap( 'create_agents' );
    $role->add_cap( 'edit_agents' );
    $role->add_cap( 'edit_others_agents' );
    $role->add_cap( 'publish_agents' );
    $role->add_cap( 'read_private_agents' );
    $role->add_cap( 'delete_agents' );
    $role->add_cap( 'delete_private_agents' );
    $role->add_cap( 'delete_published_agents' );
    $role->add_cap( 'delete_others_agents' );
    $role->add_cap( 'edit_private_agents' );
    $role->add_cap( 'edit_published_agents' );


    // gets the author role
    $role = get_role( 'editor' );

    $role->add_cap( 'create_properties' );

    $role->add_cap( 'read_property' );
    $role->add_cap( 'delete_property' );
    $role->add_cap( 'edit_property' );
    $role->add_cap( 'publish_properties' );
    $role->add_cap( 'edit_properties' );
    $role->add_cap( 'edit_published_properties' );
    $role->add_cap( 'delete_published_properties' );
    $role->add_cap( 'read_private_properties' );
    $role->add_cap( 'delete_private_properties' );
    $role->add_cap( 'edit_others_properties' );
    $role->add_cap( 'delete_others_properties' );
    $role->add_cap( 'edit_private_properties' );
    $role->add_cap( 'edit_published_properties' );

    $role->add_cap( 'read_testimonial' );
    $role->add_cap( 'delete_testimonial' );
    $role->add_cap( 'edit_testimonial' );
    $role->add_cap( 'create_testimonials' );
    $role->add_cap( 'delete_testimonial' );
    $role->add_cap( 'publish_testimonials' );
    $role->add_cap( 'edit_testimonials' );
    $role->add_cap( 'edit_published_testimonials' );
    $role->add_cap( 'delete_published_testimonials' );
    $role->add_cap( 'delete_testimonials' );
    $role->add_cap( 'delete_private_testimonials' );
    $role->add_cap( 'delete_others_testimonials' );
    $role->add_cap( 'edit_others_testimonials' );
    $role->add_cap( 'edit_private_testimonials' );
    $role->add_cap( 'edit_published_testimonials' );

    $role->add_cap( 'read_agent' );
    $role->add_cap( 'delete_agent' );
    $role->add_cap( 'edit_agent' );
    $role->add_cap( 'create_agents' );
    $role->add_cap( 'edit_agents' );
    $role->add_cap( 'edit_others_agents' );
    $role->add_cap( 'publish_agents' );
    $role->add_cap( 'read_private_agents' );
    $role->add_cap( 'delete_agents' );
    $role->add_cap( 'delete_private_agents' );
    $role->add_cap( 'delete_published_agents' );
    $role->add_cap( 'delete_others_agents' );
    $role->add_cap( 'edit_private_agents' );
    $role->add_cap( 'edit_published_agents' );


    // gets the author role
    $role = get_role( 'houzez_agent' );

    $role->add_cap( 'create_properties' );

    $role->add_cap( 'read_property' );
    $role->add_cap( 'delete_property' );
    $role->add_cap( 'edit_property' );
    // $role->add_cap( 'publish_property' );
    $role->add_cap( 'publish_properties' );
    $role->add_cap( 'edit_properties' );
    $role->add_cap( 'edit_published_properties' );
    $role->add_cap( 'delete_published_properties' );
    $role->remove_cap( 'read_private_properties' );
    $role->remove_cap( 'delete_private_properties' );
    $role->remove_cap( 'edit_others_properties' );
    $role->remove_cap( 'delete_others_properties' );
    $role->remove_cap( 'edit_private_properties' );

    $role->add_cap( 'create_testimonials' );

    $role->add_cap( 'read_testimonial' );
    $role->add_cap( 'delete_testimonial' );
    $role->add_cap( 'edit_testimonial' );
    // $role->add_cap( 'delete_testimonial' );
    $role->remove_cap( 'publish_testimonials' );
    $role->remove_cap( 'edit_testimonials' );
    $role->remove_cap( 'edit_published_testimonials' );
    $role->remove_cap( 'delete_published_testimonials' );


    // gets the author role
    $role = get_role( 'contributor' );

    $role->add_cap( 'create_properties' );

    $role->add_cap( 'read_property' );
    $role->add_cap( 'delete_property' );
    $role->add_cap( 'edit_property' );
    $role->remove_cap( 'publish_properties' );
    $role->add_cap( 'edit_properties' );
    $role->add_cap( 'edit_published_properties' );
    $role->add_cap( 'delete_published_properties' );
    $role->remove_cap( 'read_private_properties' );
    $role->remove_cap( 'delete_private_properties' );
    $role->remove_cap( 'edit_others_properties' );
    $role->remove_cap( 'delete_others_properties' );
    $role->remove_cap( 'edit_private_properties' );

}
add_action( 'admin_init', 'add_theme_caps');