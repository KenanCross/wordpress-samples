<?php
/*
    Default Content Block for output to screen
*/
?>
<section>
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
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">
            <?php

            foreach ($posts as $p) {
                if ($number - 1 >= $count) :
                    if ($count <= 3) { ?>
                        <div class="col mb-4">
                            <a href="<?php if ($type !== 'videos') : echo esc_url(preparecontent($p, 'link', $type));
                                        else : echo esc_url(preparecontent($p, 'video', $type));
                                        endif;  ?>" <?php if ($type === 'videos') : print('class="venobox" data-ratio="16x9" data-vbtype="video"');
                                                    endif; ?> rel="bookmark" title="<?php echo esc_attr(preparecontent($p, 'title', $type)); ?>">
                                <img width="1000" height="600" src="<?php echo esc_url(preparecontent($p, 'thumbnail', $type)); ?>" class="img-fluid mb-2 wp-post-image" alt="" decoding="async" loading="lazy">
                            </a>
                            <span class="smaller text-muted">
                                <?php echo esc_html(preparecontent($p, 'category', $type)); ?>
                            </span>
                            <br>
                            <a href="<?php if ($type !== 'videos') : echo esc_url(preparecontent($p, 'link', $type));
                                        else : echo esc_url(preparecontent($p, 'video', $type));
                                        endif;  ?>" <?php if ($type === 'videos') : print('class="venobox fs-5 fw-bolder" data-ratio="16x9" data-vbtype="video"');
                                                    else : print('class="fs-5 fw-bolder"');
                                                    endif; ?> title="<?php echo esc_attr(preparecontent($p, 'title', $type)); ?>">
                                <?php if (has_post_format('video')) { ?>
                                    <i style="padding-right: 5px;font-size: 12px;" class="bi bi-play-circle" aria-hidden="true"></i>
                                <?php } ?>
                                <?php if (has_post_format('audio')) { ?>
                                    <i style="padding-right: 5px;font-size: 12px;" class="bi bi-mic" aria-hidden="true"></i>
                                <?php } ?>
                                <?php echo wp_kses_post((preparecontent($p, 'title', $type))); ?>
                            </a>
                            <br>
                        </div>

                    <?php $count++;
                    } else {
                        if ($count === 4 && $number > 4) {
                            echo '</div><div class="row row-cols-1 row-cols-md-3 row-cols-lg-6 g-3 mb-3">';
                        }
                    ?>
                        <div class="col">
                            <span class="smaller text-muted">
                                <?php echo esc_html(preparecontent($p, 'category', $type)); ?>
                            </span>
                            <br>
                            <a href="<?php if ($type !== 'videos') : echo esc_url(preparecontent($p, 'link', $type));
                                        else : echo esc_url(preparecontent($p, 'video', $type));
                                        endif;  ?>" <?php if ($type === 'videos') : print('class="venobox" data-ratio="16x9" data-vbtype="video"');
                                                    endif; ?> title="<?php echo esc_attr(preparecontent($p, 'title', $type)); ?>">
                                <?php if (has_post_format('video')) { ?>
                                    <i style="padding-right: 5px;font-size: 12px;" class="bi bi-play-circle" aria-hidden="true"></i>
                                <?php } ?>
                                <?php if (has_post_format('audio')) { ?>
                                    <i style="padding-right: 5px;font-size: 12px;" class="bi bi-mic" aria-hidden="true"></i>
                                <?php } ?>
                                <?php echo wp_kses_post(preparecontent($p, 'title', $type)); ?>
                            </a>
                        </div>
                    <?php $count++;
                    } ?>
            <?php
                endif;
            }
            if ($lastPost === $count - 1 || $number === $count) {
                echo '</div>';
            }
            ?>
        </div>
    </div>
</section>