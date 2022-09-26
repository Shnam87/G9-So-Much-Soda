<?php 

// Que in scripts (worked without but just in case)
add_action('wp_enqueue_scripts', 'somuchsoda_enqueue');

function somuchsoda_enqueue(){
  wp_enqueue_style('style', get_stylesheet_uri());
}


