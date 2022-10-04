<div class="start-cta-block">
    <h1 class="start-cta-h1"><?php the_field('heading'); ?></h1>
    <p class="start-cta-p"><?php the_field('subheading'); ?></p>

    <?php 
    $link = get_field('button_link');
    if( $link ): 
        $link_url = $link['url'];
        $link_title = $link['title'];
        $link_target = $link['target'] ? $link['target'] : '_self';
        ?>
        <a class="start-cta-btn" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
    <?php endif; ?>
</div>