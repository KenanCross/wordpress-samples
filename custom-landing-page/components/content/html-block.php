<?php

?>


<section>
    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                <h4 class="header-border text-uppercase mb-3">
                    <span class="border-layer">
                        <?php echo esc_html($header); ?>
                    </span>
                </h4>
            </div>
        </div>
        <div>
            <?php echo wp_kses_post($custom_html); ?>
        </div>
    </div>
</section>