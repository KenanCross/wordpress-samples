<?php
function my_acf_json_save_point($path)
{
    return get_stylesheet_directory() . '/acf-json';
}
add_filter('acf/settings/save_json', 'my_acf_json_save_point');

add_filter('acf/settings/load_json', 'my_acf_json_load_point');

function my_acf_json_load_point($paths)
{

    // remove original path (optional)
    unset($paths[0]);


    // append path
    $paths[] = get_stylesheet_directory() . '/acf-json';


    // return
    return $paths;
}

function study_cat_load_field($field)
{
    $field['choices'] = array();
    $args = [
        'post_type' => 'study',
        'numberposts'   => -1,
        'order' => 'DESC',
        'orderby'   => 'date',
        'cache_results' => false
    ];
    $posts = get_posts($args); //get all posts in CPT
    foreach ($posts as $p) :
        $cat =  get_the_category($p->ID); //get its category
        $field["choices"][$cat[0]->slug] = $cat[0]->name; //add category to field choices
    endforeach;

    natsort($field["choices"]); //sort the results alphabetically
    return $field;
}

function tracker_cat_load_field($field)
{
    $field['choices'] = array();
    $args = [
        'post_type' => 'tracker',
        'numberposts'   => -1,
        'order' => 'DESC',
        'orderby'   => 'date',
        'cache_results' => false
    ];
    $posts = get_posts($args); //get all posts in CPT
    foreach ($posts as $p) :
        $cat =  get_the_category($p->ID); //get its category
        $field["choices"][$cat[0]->slug] = $cat[0]->name; //add category to field choices
    endforeach;

    natsort($field["choices"]); //sort the results alphabetically
    return $field;
}

// Apply to all fields.
// add_filter('acf/load_field', 'my_acf_load_field');

// Apply to select fields.
// add_filter('acf/load_field/type=select', 'my_acf_load_field');

// Apply to fields named "custom_select".
// add_filter('acf/load_field/name=custom_select', 'my_acf_load_field');

// Apply to field with key "field_123abcf".
add_filter('acf/load_field/key=field_65b94f99b5bec', 'study_cat_load_field');
add_filter('acf/load_field/key=field_65cf869826755', 'tracker_cat_load_field');
