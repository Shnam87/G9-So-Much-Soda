<div class="prod-cat-container">
    <div class="prod-cat-content">
        <h1 class="prod-cat-h1"><?php echo get_field('heading'); ?></h1>
        <p class="prod-cat-text"><?php echo get_field('subheading'); ?></p>
    </div>
    <div class="prod-cat-list-container">



<?php
    // verify that this is a product category page
if ( is_product_category() ){
    global $wp_query;

    // get the query object
    $cat = $wp_query->get_queried_object();

    // get the thumbnail id using the queried category term_id
    $thumbnail_id = get_term_meta($value->term_id, 'thumbnail_id', true); 

    // get the image URL
    $image = wp_get_attachment_url( $thumbnail_id ); 

    

    // print the IMG HTML
    echo "<img src='{$image}' alt='' width='762' height='365' />";
}

?>


        <?php 
        $categories = get_field('categories');
        //var_dump($categories);
        ?>

        <?php if( $categories ): ?>
            <?php foreach( $categories as $category ): ?>
                <div class="prod-cat-list-item">
                    <img class="prod-cat-item-img" src="<?php echo esc_html( $category->thumbnail); ?>" alt="">
                    <h1 class="prod-cat-item-h1"><?php echo esc_html( $category->name ); ?></h1>
                    <p class="prod-cat-item-p"><?php echo esc_html( $category->description ); ?></p>
                    <a class="prod-cat-item-link" href="<?php echo esc_url( get_term_link( $category ) ); ?>">View '<?php echo esc_html( $category->name ); ?>'</a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>