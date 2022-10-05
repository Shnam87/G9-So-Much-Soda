<div class="stores-container">
    <h1 class="stores-page-title">
        <?php the_title();?>
    </h1>
    <div class="stores-listed-stores">
        <?php 
        // $number = get_field('number_of_stores');
        $args = array(
            'post_type' => 'stores',
            'post_status' => 'publish',
            // 'posts_per_page' => $number,
        );
        $loop = new WP_Query($args);
        ?>

        <?php if ( $loop->have_posts()) : ?>
            <?php while ($loop->have_posts()) : $loop->the_post(); ?>
                <?php get_template_part('template-parts/listed-stores'); ?>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        <?php endif; ?> 
    </div>
</div>