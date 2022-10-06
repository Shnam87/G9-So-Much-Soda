</main>

</div>
<footer id="footer" role="contentinfo">

    <div class="footer-menu">

        <div class="right-footer-menu">
            <?php
            $locations = get_nav_menu_locations();
            $menu = wp_get_nav_menu_object($locations['right_footer_menu']);
            echo '<h3 class="footer-menu-title">' . wp_kses_post($menu->name) . '</h3>';
            ?>
            <?php wp_nav_menu(array('theme_location' => 'right_footer_menu')); ?>
        </div>

        <div class="left-footer-menu">
            <?php
            $locations = get_nav_menu_locations();
            $menu = wp_get_nav_menu_object($locations['left_footer_menu']);
            echo '<h3 class="footer-menu-title">' . wp_kses_post($menu->name) . '</h3>';
            ?>
            <?php wp_nav_menu(array('theme_location' => 'left_footer_menu')); ?>
        </div>

        <div>
            
        </div>

        <div class="store-logo">
            <?php the_custom_logo(); ?>
        </div>

    </div>

</footer>

<?php wp_footer(); ?>
</body>

</html>

