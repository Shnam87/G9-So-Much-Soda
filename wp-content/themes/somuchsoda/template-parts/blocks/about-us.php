<div class="about-us">
    <div>
        <?php if (get_field('about_us_image')) : ?>
            <img src="<?php the_field('about_us_image'); ?>" />
        <?php endif; ?>
    </div>

    <div class="block-text">
        <?php the_field('about_us_text'); ?>
    </div>

</div>