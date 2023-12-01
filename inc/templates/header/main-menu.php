<?php
$menu = wp_nav_menu(
    array(
        'theme_location' => 'main-menu',
        'container' => false,
        'menu_class' => 'menu',
        'echo' =>false,
        'walker' => new paradoxFrontendWalker(),
    )
);
?>

<nav class="site-navigation paradox-navigation" role="navigation">
    <?php 
        if(has_nav_menu('main-menu')){
            echo wp_kses_post($menu);
        }
    ?>
</nav>

