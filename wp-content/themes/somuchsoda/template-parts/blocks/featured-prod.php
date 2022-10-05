<div class="feat-prod-container">
    <div class="feat-prod-img">
        <?php if( get_field('image') ): ?>
            <img class="feat-prod-img" src="<?php the_field('image'); ?>" />
        <?php endif; ?>
    </div>
    <div class="feat-prod-text">
        <p class="feat-prod-p-small p-small-1"><?php echo the_field('root'); ?></p>
        <h1 class="feat-prod-h1"><?php the_field('heading'); ?></h1>
        <p class="feat-prod-p-small p-small-2"><?php the_field('price_from'); ?> &#8212; <?php the_field('price_up_to'); ?>  <?php the_field('currency'); ?></p>
        <p class="feat-prod-p"><?php the_field('subheading'); ?></p>
        <?php get_template_part('template-parts/link'); ?>
    </div>
</div>