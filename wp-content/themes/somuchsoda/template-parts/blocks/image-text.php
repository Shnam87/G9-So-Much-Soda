<div class="text-image-block">
<div class="text-image-box text-image-box-2">
        <?php if( get_field('image') ): ?>
            <img class="text-image-img" src="<?php the_field('image'); ?>" />
        <?php endif; ?>
    </div>
    <div class="text-image-box text-image-box-1">
        <p class="text-image-p-small"><?php the_field('root'); ?></p>
        <h1 class="text-image-h1"><?php the_field('heading'); ?></h1>
        <p class="text-image-p"><?php the_field('subheading'); ?></p>
        <?php get_template_part('template-parts/link'); ?>
    </div>  
</div>