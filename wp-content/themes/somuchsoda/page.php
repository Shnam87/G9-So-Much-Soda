<?php get_header(); ?>




<?php if (have_posts()) : while (have_posts()) : the_post(); ?>





<?php if (is_page('vara-butiker') || is_page('om-oss')) : ?>
        
        <div class="page-img-top-container">
        
        <?php the_post_thumbnail( 'large' ); ?>  
        </div>
<?php endif; ?>




<div class="page-content-wrapper">
<h1><?php the_title(); ?></h1>

<div class="page-content-div">
<?php the_content(); ?>
</article>
</div

<?php endwhile;
endif; ?>



<?php get_footer(); ?>