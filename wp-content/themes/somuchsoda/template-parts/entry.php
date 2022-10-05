<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="page-container">
        <div class="page-wrapper">
            <div class="page-info">
                <h4><?php the_time(get_option('date_format')); ?></h4>
                <h1><?php the_title(); ?></h1>
            </div>

            <div class="page-content">
                <?php the_content(); ?>
            </div>
        </div>
    </div>

</div>