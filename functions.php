<?php

//Add the parent theme's styles

add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

function my_theme_enqueue_styles() {

    $parent_style = 'parent-style'; 
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );

}


//Remove font-awesome and the js script that handles the slider

add_action('wp_enqueue_scripts', 'remove_parent_styles',20);

function remove_parent_styles() {
    wp_dequeue_style('font-awesome');
    wp_deregister_style('font-awesome');

    wp_dequeue_script('jquery-flexslider');
    wp_dequeue_script('photozoom-scripts');
}

// Add the new script that does not require the slider function

add_action('wp_enqueue_scripts' , 'add_custom_js', 30);

function add_custom_js() {
  wp_register_script('photozoom', get_stylesheet_directory_uri().'/js/photozoom.js', array('jquery'), '1.0.0', true);

  /* Contains the strings used in our JavaScript file*/
  $photozoomStrings = array (
    'slicknav_menu_home' => _x( 'Menu', 'The main label for the expandable mobile menu', 'photozoom' )
  );

  wp_localize_script( 'photozoom', 'photozoomStrings', $photozoomStrings );

  wp_enqueue_script( 'photozoom' );
}
