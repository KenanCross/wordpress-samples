<?php

function recentReports(int $number, array $postTypes, array $keywords = NULL, int $offset = 0)
{
    if (!empty($keywords)) :
        $tag_args = [
            'post_type' => $postTypes,
            'numberposts'   => $number,
            'order' => 'DESC',
            'orderby'   => 'date',
            'offset' => $offset,
            'update_post_meta_cache' => false,
            'update_post_term_cache' => false,
            'ignore_sticky_posts' => true,
            'no_found_rows' => true,
            'tax_query' => [
                'relation' => 'OR',
                [
                    'taxonomy' => 'post_tag',
                    'field'    => 'slug',
                    'terms'    => $keywords,
                ],
                [
                    'taxonomy' => 'category',
                    'field'    => 'slug',
                    'terms'    => $keywords,
                ]
            ]
        ];
        $edition_query = get_posts($tag_args);
    else :
        $args = [
            'post_type' => $postTypes,
            'numberposts'   => $number,
            'order' => 'DESC',
            'orderby'   => 'date',
            'offset' => $offset,
            'update_post_meta_cache' => false,
            'update_post_term_cache' => false,
            'ignore_sticky_posts' => true,
            'no_found_rows' => true,
        ];
        $edition_query = get_posts($args);
    endif;

    $reports = array(); //create empty array
    foreach ($edition_query as $edition => $e) :
        $coverImage = get_field('cover_image', $e->ID);
        $cat =  get_the_category($e->ID); //get its category
        if (is_numeric($coverImage)) :
            $coverImage = wp_get_attachment_image_src($coverImage, 'medium_large');
            $coverImage = $coverImage[0];
        else :
            $coverImage = $coverImage['sizes']['medium_large'];
        endif;
        $reports[] = ['title' => get_field('tracker_title', $e->ID), 'cover' => $coverImage, 'url' => get_permalink($e->ID), 'date' => $e->post_date, 'category' => $cat[0]->name, 'excerpt' => get_field('intro_copy', $e->ID)];
    endforeach;
    return $reports;
}

function queryByTag($type, $tag, $number)
{
    $args = [
        "post_type" => $type,
        "numberposts" => $number,
        'update_post_meta_cache' => false,
        'update_post_term_cache' => false,
        'ignore_sticky_posts' => true,
        'no_found_rows' => true,
        "tax_query" => array(
            array(
                'taxonomy' => 'post_tag',
                'field' => 'slug',
                'terms' => $tag
            )
        )
    ];
    $result = get_posts($args);
    return $result;
}

function prepareContent($p, $r, $type = 'post')
{
    $thumbnail = '';
    $title = '';
    $link = '';
    $video = '';
    $category = '';
    $excerpt = '';
    $date = '';

    switch ($type) {
        case 'tracker':
            $thumbnail = $p['cover'];
            $title = $p['title'];
            $link = $p['url'];
            $date = $p['date'];
            $category = $p['category'];
            $excerpt = $p['excerpt'];
            break;
        case 'study':
            $thumbnail = $p['cover'];
            $title = $p['title'];
            $link = $p['url'];
            $date = $p['date'];
            $category = $p['category'];
            $excerpt = $p['excerpt'];
            break;
        case 'videos':
            $excerpt = $p['excerpt'];
            $title = $p['title'];
            $thumbnail = 'https://cdn.jwplayer.com/thumbs/' . $p['media'] . '-1920.jpg';
            $video = $p['file'];
            $link = "";
            $date = $p['date'];
            break;
        default:
            $thumbnail = get_the_post_thumbnail_url($p->ID, 'post-thumbnail');
            $date = $p->post_date;
            $title = $p->post_title;
            $link = get_permalink($p->ID);
            $category = get_the_category($p->ID);
            $category = $category[0]->cat_name;
            if (empty($p->post_excerpt)) { // check if post does not have a post excerpt else get excerpt from content
                $excerpt = get_the_excerpt($p->ID);
            } else { // use post excerpt from post
                $excerpt = $p->post_excerpt;
            }
    }
    switch ($r) {
        case 'thumbnail':
            $value = $thumbnail;
            break;
        case 'title':
            $value = $title;
            break;
        case 'link':
            $value = $link;
            break;
        case 'category':
            $value =  $category;
            break;
        case 'excerpt':
            $value = $excerpt;
            break;
        case 'video':
            $value = $video;
            break;
        case 'date':
            $value = $date;
            break;
        default:
            $value = 'NULL VALUE';
    }

    return $value;
}
