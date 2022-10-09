<?php if ( is_page('start') || is_page('about-us') || is_page('contact') || is_page('our-stores')) : ?>
        <?php get_header('white'); ?>
<?php else : ?>
        <?php get_header(); ?>
<?php endif; ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <?php if (is_page('our-stores') || is_page('about-us') || is_page('start') || is_page('news') || is_page('contact')) : ?>
                        <div class="page-img-top-container">
                                <?php the_post_thumbnail('large'); ?>
                        </div>
                <?php endif; ?>

                <?php if (is_front_page() || is_page('our-stores')) : ?>
                        <div class="page-content-container">
                                <div class="page-content-div the-content">
                                        <?php the_content(); ?>
                                </div>
                        </div>

                <?php else : ?>
                        <div class="page-content-wrapper">
                                <?php /* if (!is_front_page() && !is_page('our-stores')) : */ ?>
                                <h1 class="page-title"><?php the_title(); ?></h1>

                                <div class="page-content-div the-content">
                                        <?php the_content(); ?>
                                </div>
                                <?php endif; ?>
                        </div>

                <?php endwhile; ?>

        <?php endif; ?>

<?php get_footer(); ?>