<?php if ( is_page('cart') || is_page('my-account') || is_page('checkout')) : ?>
        <?php get_header('black'); ?>
<?php else : ?>
        <?php get_header(); ?>
<?php endif; ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <?php if (is_page('our-stores') || is_page('about-us') || is_page('start')) : ?>
                        <div class="page-img-top-container">
                                <?php the_post_thumbnail('large'); ?>
                        </div>
                <?php endif; ?>
                <div class="page-content-wrapper">
                        <h1 class="page-title"><?php the_title(); ?></h1>
                        <div class="page-content-div the-content">
                                <?php the_content(); ?>
                        </div>
                </div <?php endwhile;
        endif; ?> <?php get_footer(); ?>