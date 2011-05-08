<?php
if (function_exists('register_sidebar')):
    register_sidebar(array(
        'name' => 'Sidebar',
        'before_widget' => '', // Removes <li>
        'after_widget' => '', // Removes </li>
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));
endif;

add_theme_support('post-formats', array('link'));
?>