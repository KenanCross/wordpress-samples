<?php

?>
<section>
    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                <h4 class="header-border text-uppercase mb-3">
                    <span class="border-layer"><?php echo wp_kses_post($header); ?></span>
                </h4>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 report-thumb">
                    <?php

                    foreach ($posts as $p) {
                        if ($number - 1 >= $count) :
                    ?>
                            <div class="col text-center mb-3 lh-normal">
                                <?php if ($type !== 'videos') { ?>
                                    <a href="<?php echo esc_url(preparecontent($p, 'link', $type)); ?>">
                                    <?php } ?>
                                    <img src="<?php echo esc_url(preparecontent($p, 'thumbnail', $type)); ?>" <?php if ($type === 'videos') :
                                                                                                                    print('class="img-thumbnail mb-2 venobox" data-ratio="16x9" data-vbtype="video" data-href="' . esc_url(preparecontent($p, 'video', $type)) . '"');
                                                                                                                else :
                                                                                                                    print('class="img-thumbnail mb-2"');
                                                                                                                endif; ?> />
                                    <?php if ($type !== 'videos') { ?>
                                    </a>
                                <?php } ?>
                                <br>
                                <a href="<?php echo esc_url(preparecontent($p, 'link', $type)); ?>">
                                    <b>
                                        <?php echo esc_html(preparecontent($p, 'title', $type)); ?>
                                    </b>
                                </a>
                            </div>
                    <?php
                            $count++;
                        endif;
                    } ?>
                </div>
            </div>
        </div>
    </div>
</section>