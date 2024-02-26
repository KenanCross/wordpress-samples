<?php
$bg_type = $header['bg_type'];
$bg_color = $header['bg_color'];
$bg_color_2 = $header['bg_color_2'];
$bg_images = $header['image'];
$header_description = $header['header_description'];
$text_color = $header['text_color'];
$large_image = $bg_images['sizes']['large'];
$gradient_option = "background-image: linear-gradient(to bottom right, $bg_color, $bg_color_2)";
$color_option = "background-color: $bg_color";
$img_option = "background-image: url($large_image); background-position; center; background-size; contain;";

$bg_option = "";
switch ($bg_type) {
    case "color":
        $bg_option = $color_option;
        break;
    case "gradient":
        $bg_option = $gradient_option;
        break;
    case "image";
        $bg_option = $img_option;
        break;
    default;
        $bg_option = "background-color: black";
        break;
}

?>
<section>
    <div class="container-fluid pt-5 pb-0 pb-md-5 mb-5" style="<?php echo esc_attr($bg_option) ?>">
        <div class="container pt-3 pb-0 py-lg-3">
            <div class="row gx-0 gx-md-5">
                <div class="col-12 col-md-9 my-auto report-desc ps-0 ps-md-5 py-5 py-md-0">

                    <h2 class="text-<?php echo esc_attr($text_color) ?>"><?php echo esc_html(the_title()) ?></h2>
                    <div class="fs-4 text-<?php echo esc_attr($text_color) ?>">
                        <p style="font-weight: 400;"><?php echo wp_kses_post($header_description) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>