<?php
class Custom_Walker_Nav_Menu extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = null) {
        $output .= '<ul class="dropdown-menu">';
    }

    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $class_names = join(' ', array_filter($item->classes));
        $class_names = ' class="' . esc_attr($class_names) . '"';

        $output .= '<li' . $class_names . '>';
        $output .= '<a class="nav-item nav-link" href="' . esc_attr($item->url) . '">' . esc_html($item->title) . '</a>';
    }
}
