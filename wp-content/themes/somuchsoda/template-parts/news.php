<div class="news-container">
	<h1>Nyheter</h1>
	<div class="news-posts-container">
		<?php
		$the_query = new WP_Query(array(
			'posts_per_page' => 4,
		));
		?>
		
		<?php if ($the_query->have_posts()) : ?>
			<?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
			
					<div class="news-post-wrapper">
						<a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail(); ?></a>
						<a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
						<p class="post-date"> <?php echo get_the_date( get_option('date_format') ); ?></p>
						<?php the_excerpt(); ?>
					</div>
				
			<?php endwhile;
		endif; ?>
	</div>

	
</div>