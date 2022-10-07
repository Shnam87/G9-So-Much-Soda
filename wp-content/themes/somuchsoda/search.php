
<?php get_header('black'); ?>

<div class="search-field-again">
    <?php get_search_form(); ?>
</div>

<?php if (have_posts()) : ?>

    <div class="search-result">
        <h1>Result :</h1>

        <?php while (have_posts()) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <h2><a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a></h2>
                <?php the_excerpt(); ?>
                <h4><a href="<?php the_permalink(); ?>"> Read more ... </a></h4>
                <hr>

            </article>

        <?php endwhile; ?>

    </div>

<?php else : ?>

    <div class="no-result">

        <?php get_template_part('template-parts/no-results'); ?>

    </div>

<?php endif; ?>

<?php get_footer(); ?>