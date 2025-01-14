<?php

function university_files(){
    wp_enqueue_script('main-university-js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);//hey wordpress, please output the main.js file
    wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('custom-google-fonts', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('university_main_styles', get_theme_file_uri('/build/style-index.css'));//hey wordpress, please output the style.css file(default stylesheet in wordpress)
    wp_enqueue_style('university_extra_styles', get_theme_file_uri('/build/index.css'));
}
add_action('wp_enqueue_scripts', 'university_files');//hey wordpress, when you are about to output the scripts, please run this function


function university_features(){
    add_theme_support('title-tag');//hey wordpress, please add the title tag to the head of the document
}
add_action( 'after_setup_theme','university_features');