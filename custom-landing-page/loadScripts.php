<?php


function loadScripts()
{
    wp_enqueue_script('bs5-lightbox', 'https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.3/dist/index.bundle.min.js', array(), '1.8.3', true);
    wp_enqueue_script('venoBox', 'https://cdn.jsdelivr.net/npm/venobox@2.1.6/dist/venobox.min.js', array(), '2.1.6', true);
    wp_enqueue_script('venoBox-init', get_stylesheet_directory() . '/js/venobox-init.js', array(), filemtime(get_stylesheet_directory() . '/js/venobox-init.js'), true);

    //Styles for any scripts above
    wp_enqueue_style('venoBox', 'https://cdn.jsdelivr.net/npm/venobox@2.1.6/dist/venobox.min.css', array());
}

add_action('wp_enqueue_scripts', 'loadScripts');
