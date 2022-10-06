<<<<<<< HEAD
<?php get_header(); ?>

<?php 
if (have_posts()) : 
  while (have_posts()) : the_post();
    get_template_part('template-parts/category-block');
  endwhile;
  wp_reset_postdata();
endif;
?>

<?php get_footer(); ?>
=======
<?php get_header();  ?>

<div>
  <div class="news-sub-title">

    <?php
    // Display the content of the static posts Page.
    // This is just an example using setup_postdata().

    $post = get_queried_object();
    setup_postdata($post);

    the_content();

    wp_reset_postdata();
    ?>

  </div>

  <div class="news-block-container">

    <?php
    if (have_posts()) :
      while (have_posts()) : the_post();

        get_template_part('template-parts/news');

      endwhile;
    endif;
    ?>

  </div>

  <?php get_footer(); 
>>>>>>> origin/shnam
