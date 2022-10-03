<div class="start-cta-block">
 <h1 class="start-cta-h1"><?php the_field('heading'); ?></h1>
 <p class="start-cta-p"><?php the_field('subheading'); ?></p>

 <?php
 if(get_field('include_button')){ ?>
     <a class="start-cta-btn" target="_blank" href=""><?php the_field('button_name'); ?></a>
 <?php 
 } 
 ?>
</div>