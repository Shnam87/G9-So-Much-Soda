
<div class="news">
	<div><?php the_post_thumbnail('medium') ?></div>
	<div class="news-info">
	<a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a>
	<?php the_excerpt(); ?>
	<a href="<?php the_permalink(); ?>"> Read more ... </a>
	</div>
</div>
