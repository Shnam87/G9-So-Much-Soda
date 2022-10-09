<?php get_header(); ?>

<div class="page-content-wrapper">

    <h1 class="page-title">

        <?php the_title(); ?>

    </h1>

    <div class="the-content">

        <div class="search-field">
            <?php get_search_form(); ?>
        </div>

    </div>
</div>

<?php get_footer();
