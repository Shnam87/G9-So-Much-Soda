<div class="text-image-block">
<div class="text-image-box text-image-box-2">
        <?php if( get_field('image') ): ?>
            <img class="text-image-img" src="<?php the_field('image'); ?>" />
        <?php endif; ?>
    </div>
    <div class="text-image-box text-image-box-1">
        <p class="text-image-p-small"><?php the_field('root'); ?></p>
        <h1 class="text-image-h1"><?php the_field('heading'); ?></h1>
        <p class="text-image-p"><?php the_field('subheading'); ?></p>
        <?php 
            $link = get_field('button_link');
            if( $link ): 
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self';
                ?>
                <a class="text-image-btn" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
        <?php endif; ?>
    </div>  
</div>