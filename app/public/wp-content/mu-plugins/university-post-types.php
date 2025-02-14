<?php
function university_post_types()
{
    // Event Post Type
    register_post_type('event', array(
        'capability_type' => 'event',
        'map_meta_cap' => true,
        'supports' => array('title', 'editor', 'excerpt'),
        'rewrite' => array('slug' => 'events'),
        'has_archive' => true,
        'public' => true,
        'show_in_rest' => true,
        'labels' => array(
            'name' => 'Events',
            'add_new_item' => 'Add New Event',
            'edit_item' => 'Edit Event',
            'all_items' => 'All Events',
            'singular_name' => 'Event'
        ),
        'menu_icon' => 'dashicons-calendar-alt',
    ));
    // Program post type
    register_post_type('program', array(
        'supports' => array('title', 'editor'),
        'rewrite' => array('slug' => 'programs'),
        'has_archive' => true,
        'public' => true,
        'show_in_rest' => true,
        'labels' => array(
            'name' => 'Programs',
            'add_new_item' => 'Add New Program',
            'edit_item' => 'Edit Program',
            'all_items' => 'All Programs',
            'singular_name' => 'Program'
        ),
        'menu_icon' => 'dashicons-awards',
    ));
    // Professor post type
    register_post_type('professor', array(
        'supports' => array('title', 'editor', 'thumbnail'),
        'rewrite' => array('slug' => 'professors'),
        'public' => true,
        'show_in_rest' => true,
        'labels' => array(
            'name' => 'professors',
            'add_new_item' => 'Add New professor',
            'edit_item' => 'Edit professor',
            'all_items' => 'All professors',
            'singular_name' => 'professor'
        ),
        'menu_icon' => 'dashicons-welcome-learn-more',
    ));
    //campus post type
    register_post_type('campus', array(
        'supports' => array('title', 'editor', 'thumbnail'),
        'has_archive' => true,
        'rewrite' => array('slug' => 'campuses'),
        'public' => true,
        'show_in_rest' => true,
        'labels' => array(
            'name' => 'Campuses',
            'add_new_item' => 'Add New Campus',
            'edit_item' => 'Edit Campus',
            'all_items' => 'All Campuses',
            'singular_name' => 'Campus'
        ),
        'menu_icon' => 'dashicons-location-alt',
    ));
    register_post_type('note', array(
        'supports' => array('title', 'editor'),
        'has_archive' => true,
        'rewrite' => array('slug' => 'notes'),
        'public' => false,//this will hide a specific user's notes from the public
        'show_ui' => true,//this will show the notes in the admin dashboard
        'show_in_rest' => true,
        'labels' => array(
            'name' => 'Notes',
            'add_new_item' => 'Add New Note',
            'edit_item' => 'Edit Note',
            'all_items' => 'All Notees',
            'singular_name' => 'Note'
        ),
        'menu_icon' => 'dashicons-welcome-write-blog',
    ));
}

add_action('init', 'university_post_types');
