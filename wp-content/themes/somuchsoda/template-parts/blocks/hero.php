<div class="heroBlock">

    <?php
    $image = get_field('image');
    ?>

    <?php if ($image) : ?>
        <?php echo wp_get_attachment_image($image['id'], 'large') ?>


        <?php if( get_field('show_title') ) : ?>

            <div class="heroBlock-content">
                <h1 class="<?php the_field('title_color'); ?>"><?php echo get_the_title(); ?></h1>
            </div>
    
        <?php endif; ?> 


    
    <?php endif; ?> 



  

</div>


