<div class="prod-cat-container">
    <div class="prod-cat-content">
        <h1 class="prod-cat-h1"><?php get_field('heading'); ?></h1>
        <p class="prod-cat-text"><?php get_field('subheading'); ?></p>
    </div>
    <div class="prod-cat-list-container">
        <?php 
        $categories = get_field('categories');
        //var_dump($categories);
        if( $categories ): ?>
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