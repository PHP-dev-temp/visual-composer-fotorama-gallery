<section class="custom-slider">
    <div class="section-container">
        <?php if ($show_title): ?>
        <div class="row header">
            <div class="col-md-9 title"><h1><?php the_title() ?></h1></div>
            <?php if ($show_social_buttons): ?>
                <div class="col-md-3 social"><?php echo do_shortcode('[ssba-buttons]'); ?></div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        <?php if ($show_gallery): ?>
            <?php $id='image gallery'; ?>
            <div id="<?php echo $id ?>" class="slider-container">
                <div class="fotorama"
                     data-nav="thumbs"
                     data-thumbheight="80px"
                     data-thumbwidth="120px"
                     data-width="100%"
                     data-ratio="800/540">
                    <?php
                        foreach($sliders as $img_id){
                            $image_big = wp_get_attachment_image_src($img_id, "full")[0];
                            $image_small = wp_get_attachment_image($img_id);
                            ?>
                            <a href="<?php echo $image_big; ?>"><?php echo $image_small; ?></a>
                    <?php } ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
