<?php

add_action(hook_name: "wp_enqueue_scripts", callback: "loadCSSandJS");

function loadCSSandJS(): void{
    // -----------------------LOAD CSS-----------------------

    // Customized Bootstrap Stylesheet
    wp_enqueue_style(handle: 'bootstrap_css', src: get_theme_file_uri("/css/bootstrap.min.css"));
    
    // Template Stylesheet
    wp_enqueue_style(handle: 'main_css', src: get_theme_file_uri("/css/style.css"));

    // Icon Font Stylesheet
    wp_enqueue_style(handle: 'fa_font1', src: 'https://use.fontawesome.com/releases/v5.15.4/css/all.css');
    wp_enqueue_style(handle: 'bootstrap_icon', src: 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css');

    // Google Web Fonts
    wp_enqueue_style(handle: 'fa_font2', src: 'https://fonts.googleapis.com');
    wp_enqueue_style(handle: 'fa_font3', src: 'https://fonts.gstatic.com');
    wp_enqueue_style(handle: 'fa_font4', src: 'https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap');

    // Libraries Stylesheet
    wp_enqueue_style(handle: 'lightbox_css', src: get_theme_file_uri("/lib/lightbox/css/lightbox.min.css"));
    wp_enqueue_style(handle: 'carousel_css', src: get_theme_file_uri("/lib/owlcarousel/assets/owl.carousel.min.css"));

    // -----------------------LOAD JS-----------------------

    // JavaScript Libraries
    wp_enqueue_script('js1', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js', [], '1.0', true);
    wp_enqueue_script('js2', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js', [], '1.0', true);
    wp_enqueue_script('js3', get_theme_file_uri(file: '/lib/easing/easing.min.js'), [], '1.0', true);
    wp_enqueue_script('js4', get_theme_file_uri(file: '/lib/waypoints/waypoints.min.js'), [], '1.0', true);
    wp_enqueue_script('js5', get_theme_file_uri(file: '/lib/lightbox/js/lightbox.min.js'), [], '1.0', true);
    wp_enqueue_script('js6', get_theme_file_uri(file: '/lib/owlcarousel/owl.carousel.min.js'), [], '1.0', true);

    // Template Javascript
    wp_enqueue_script('js7', get_theme_file_uri(file: '/js/main.js'), [], '1.0', true);
}
?>