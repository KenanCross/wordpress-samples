<?php
/* Template Name: Custom Layout Page */

/*
Custom Layout Page Template
Requires: Advanced Custom Fields Pro Plugin

Description: Using ACF Pro, allows user to query any post type for data, return that data and display it 
within a content block of their choosing. This allows the user to dynamically make a landing page without need 
to know a single line of code. 

Output is santized at the block level. Easily scalable with additional components found within the components folder.

Developed for PYMNTS editors to use on the fly when needing to spin up a quick landing page to serve to vistors or for brands
that want to sponsor a page with curated content.

*/

$layouts = get_field("layouts");
$header = get_field("header");

$vidIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-play-circle" viewBox="0 0 16 16">
<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"></path>
<path d="M6.271 5.055a.5.5 0 0 1 .52.038l3.5 2.5a.5.5 0 0 1 0 .814l-3.5 2.5A.5.5 0 0 1 6 10.5v-5a.5.5 0 0 1 .271-.445"></path>
</svg>&nbsp;';

get_header();

$add_header = $header['add_header'];
if ($add_header === "yes") {
    include(get_stylesheet_directory() . '/components/content/header-block.php');
}

foreach ($layouts as $layout) {
    $header = $layout["header"];
    $type = $layout["type"];
    $postTag = $layout["tag"];
    $layoutTag = strtolower(str_replace(' ', '-', $postTag));
    $video_id = $layout["video_id"];
    $category = $layout["category"];
    $trackerCategory = $layout["tracker_category"];
    $number = $layout["number"];
    $style = $layout["style"];
    $custom_html = $layout["custom_html"];

    if ($type === "videos") {
        $jw_videos = jwplayerMediaFromPlaylistID($video_id); //Code written to return JSON feed from jwPlayer
        $videos = [];

        foreach ($jw_videos as $jw) {
            $videos[] = ["title" => $jw->title, "media" => $jw->mediaid, "excerpt" => $jw->description, "file" => $jw->sources[5]->file, "date" => $jw->pubdate];
        }
        $posts = $videos;
    }
    if ($type === "post") {
        $posts = queryByTag($type, $layoutTag, $number);
    }
    if ($type === "tracker" || $type === "study") {
        if ($type === "tracker") : $category = $trackerCategory;
        endif;

        $posts = recentReports($number, [$type], [$category]);
    }

    $style = $type === "html" ? "html" : $style;

    $count = 0;
    $lastPost = count($posts);

    include(get_stylesheet_directory() . '/components/content/' . $style . '-block.php');
}

get_footer();
