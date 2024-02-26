<?php
/*
    Card Content Block for output to screen


*/

?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h6 class="header-border text-uppercase mb-3">
                <span class="border-layer">
                    <?php echo wp_kses_post($header); ?>
                </span>
            </h6>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-2 row-cols-md-3">
        <!-- Card 1 -->
        <?php foreach ($posts as $p) {
            if ($number - 1 >= $count) :
        ?>
                <div class="col mb-4">
                    <div class="card text-bg-dark text-white h-100 border border-3 rounded-0">
                        <a href="<?php if ($type !== 'videos') : echo esc_url(preparecontent($p, 'link', $type));
                                    else : echo esc_url(preparecontent($p, 'video', $type));
                                    endif;  ?>" <?php if ($type === 'videos') : print('class="venobox" data-ratio="16x9" data-vbtype="video"');
                                                endif; ?>>
                            <img src="<?php echo esc_url(preparecontent($p, 'thumbnail', $type)) ?>" class="card-img-top object-fit-cover" alt="...">
                        </a>
                        <div class="card-body">
                            <a href="<?php if ($type !== 'videos') : echo esc_url(preparecontent($p, 'link', $type));
                                        else : echo esc_url(preparecontent($p, 'video', $type));
                                        endif;  ?>" <?php if ($type === 'videos') : print('class="text-white venobox" data-ratio="16x9" data-vbtype="video"');
                                                    else : print('class="text-white"');
                                                    endif; ?>>
                                <h5 class="card-title">
                                    <?php
                                    if ($type === 'videos' || get_post_format($p->ID) === 'video') {
                                        echo wp_kses_post($vidIcon);
                                    }
                                    echo esc_html(preparecontent($p, 'title', $type));
                                    ?>
                                </h5>
                            </a>
                            <p class="card-text">
                                <?php echo wp_kses_post(preparecontent($p, 'excerpt', $type));
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
        <?php $count++;
            endif;
        } ?>
    </div>
</div>