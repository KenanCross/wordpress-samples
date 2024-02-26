<?php

?>
<section>
    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                <h4 class="header-border text-uppercase mb-3">
                    <span class="border-layer">
                        <?php echo wp_kses_post($header); ?>
                    </span>
                </h4>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
            <?php foreach ($posts as $p) {
                if ($type === "videos") {
                    $date = gmdate("F j, Y", prepareContent($p, 'date', $type));
                } else {
                    $date = gmdate("F j, Y", strtotime(prepareContent($p, 'date', $type)));
                }
                if ($count === 0) {
            ?>
                    <div class="col mb-1">

                        <a href="<?php if ($type !== 'videos') : echo esc_url(preparecontent($p, 'link', $type));
                                    else : echo esc_url(preparecontent($p, 'video', $type));
                                    endif;  ?>" <?php if ($type === 'videos') : print('class="venobox" data-ratio="16x9" data-vbtype="video"');
                                                endif; ?> rel="bookmark" title="<?php echo esc_attr(preparecontent($p, 'title', $type)); ?>">
                            <img width="1000" height="600" src="<?php echo esc_url(preparecontent($p, 'thumbnail', $type)); ?>" class="img-fluid mt-1 mb-2 wp-post-image" alt="" decoding="async" loading="lazy">
                        </a>
                        <span class="text-muted smaller text-uppercase d-block" style="font-size:.7rem;">
                            <?php
                            if ($type !== 'videos') {
                                echo esc_html(preparecontent($p, 'category', $type)) . "&nbsp;●&nbsp;";
                            }
                            echo esc_html($date); ?>
                        </span>

                    </div>
                    <div class="col">
                        <a href="<?php if ($type !== 'videos') : echo esc_url(preparecontent($p, 'link', $type));
                                    else : echo esc_url(preparecontent($p, 'video', $type));
                                    endif;  ?>" <?php if ($type === 'videos') : print('class="venobox fs-3 fw-bolder d-inline-block mb-2" data-ratio="16x9" data-vbtype="video"');
                                                else : print('class="fs-3 fw-bolder d-inline-block mb-2"');
                                                endif; ?> title="<?php echo esc_attr(preparecontent($p, 'title', $type)); ?>">
                            <?php echo esc_html(preparecontent($p, 'title', $type)); ?>
                        </a>
                        <p>
                            <a href="<?php if ($type !== 'videos') : echo esc_url(preparecontent($p, 'link', $type));
                                        else : echo esc_url(preparecontent($p, 'video', $type));
                                        endif;  ?>" <?php if ($type === 'videos') : print('class="venobox text-dark" data-ratio="16x9" data-vbtype="video"');
                                                    else : print('class="text-dark"');
                                                    endif; ?> title="<?php echo esc_attr(preparecontent($p, 'title', $type)); ?>">
                                <?php echo wp_kses_post(preparecontent($p, 'excerpt', $type)); ?>
                            </a>
                        </p>
                    </div>
                    <?php
                    if ($number > 1) {
                        echo '<div class="col mb-4 border-start border-1 last-col">';
                    }
                } else {
                    ?>
                    <?php if ($count === 1 && $number > 1) {
                        echo '<ul class="list-group list-group-flush lh-normal">';
                    }
                    if ($count <= 4) {
                    ?>
                        <li class="list-group-item px-0">
                            <span class="text-muted smaller text-uppercase">
                                <?php
                                if ($type !== 'videos') {
                                    echo esc_html(preparecontent($p, 'category', $type)) . "&nbsp;●&nbsp;";
                                }

                                echo esc_html($date); ?>
                            </span><br>
                            <a href="<?php if ($type !== 'videos') : echo esc_url(preparecontent($p, 'link', $type));
                                        else : echo esc_url(preparecontent($p, 'video', $type));
                                        endif;  ?>" <?php if ($type === 'videos') : print('class="venobox" data-ratio="16x9" data-vbtype="video"');
                                                    endif; ?> title="<?php echo esc_attr(preparecontent($p, 'title', $type)); ?>">
                                <?php echo esc_html(preparecontent($p, 'title', $type)); ?>
                            </a>
                        </li>
                    <?php
                    }
                    ?>

                <?php
                }
                if (($number === $count + 1) || $count === 4) {
                    echo "</ul></div>";
                }

                if ($lastPost === $count + 1 && $number > 1) {
                    echo "</ul></div>";
                }

                if ($count <= 4) {
                    $count++;
                }
                ?>


            <?php } ?>
        </div>
    </div>
</section>