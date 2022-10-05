<div class="featured-prod-container">
    <?php //get_field('featured_product'); ?>
    <?php 

$product_id = iconic_get_product_id_by_sku('your-sku');
var_dump($product_id);


    
    // $featured_product = get_field('featured_product');

    // if($featured_product): ?>

    <?php // endif; ?>
    <?php var_dump(get_field('featured_product')); ?>
    <?php //echo get_field('featured_product', $post->ID); ?>

        <?php
    $featured_product = get_field('featured_product');
    if( $featured_product ): ?>
        <h1><?php echo esc_html( $featured_product->post_title ); ?></h1>
        <p><?php echo esc_html( $featured_product->get_regular_price );?></p>
        <p><?php echo esc_html( $featured_product->post_excerpt );?></p>
    <?php endif; ?>

    <div>
        <?php 
            $link = get_field('button_link');
            if( $link ): 
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self';
                ?>
                <a class="text-image-btn" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
        <?php endif; ?>
    </div>


    





</div>