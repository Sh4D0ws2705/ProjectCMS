<?php
require_once get_template_directory() . '/inc/class-custom-walker-nav-menu.php';

add_action(hook_name: "wp_enqueue_scripts", callback: "loadCSSandJS");

function loadCSSandJS(): void
{
    // -----------------------LOAD CSS-----------------------
    wp_enqueue_style('bootstrap_css', get_theme_file_uri("/css/bootstrap.min.css"));
    wp_enqueue_style('main_css', get_theme_file_uri("/css/style.css"));
    wp_enqueue_style('fa_font1', 'https://use.fontawesome.com/releases/v5.15.4/css/all.css');
    wp_enqueue_style('bootstrap_icon', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css');
    wp_enqueue_style('fa_font2', 'https://fonts.googleapis.com');
    wp_enqueue_style('fa_font3', 'https://fonts.gstatic.com');
    wp_enqueue_style('fa_font4', 'https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&family=Raleway:wght@600;800&display=swap');
    wp_enqueue_style('lightbox_css', get_theme_file_uri("/lib/lightbox/css/lightbox.min.css"));
    wp_enqueue_style('carousel_css', get_theme_file_uri("/lib/owlcarousel/assets/owl.carousel.min.css"));

    // -----------------------LOAD JS-----------------------
    wp_enqueue_script('js1', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js', [], '1.0', true);
    wp_enqueue_script('js2', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js', [], '1.0', true);
    wp_enqueue_script('js3', get_theme_file_uri('/lib/easing/easing.min.js'), [], '1.0', true);
    wp_enqueue_script('js4', get_theme_file_uri('/lib/waypoints/waypoints.min.js'), [], '1.0', true);
    wp_enqueue_script('js5', get_theme_file_uri('/lib/lightbox/js/lightbox.min.js'), [], '1.0', true);
    wp_enqueue_script('js6', get_theme_file_uri('/lib/owlcarousel/owl.carousel.min.js'), [], '1.0', true);

    // Template Javascript
    wp_enqueue_script('js7', get_theme_file_uri('/js/main.js'), [], '1.0', true);

    // Đảm bảo rằng đối tượng ajax_url đã được truyền vào JS
    wp_localize_script('js7', 'ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));
}

// -----------------ĐĂng kí menu
function register_menus()
{
    register_nav_menus(
        array(
            'menu-1' => esc_html__('Primary', 'Fruitables'),
            'top-menu' => esc_html__('Top Menu', 'Fruitables')

        )
    );
}
add_action('init', 'register_menus');

// -------------------Tính lượt view cho bài viết
function setpostview($postID)
{
    $count_key = 'views';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
function getpostviews($postID)
{
    $count_key = 'views';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}

//-------------ĐĂng ký template woocommerce
function my_custom_wc_theme_support()
{

    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}

add_action('after_setup_theme', 'my_custom_wc_theme_support');

// --------------------- tạo custom post type trên dashboard để thay đổi ảnh slider banner
function tao_custom_post_type()
{
    /*
     * Biến $label để chứa các text liên quan đến tên hiển thị của Post Type trong Admin
     */
    $label = array(
        'name' => 'Ảnh banner slider', //Tên post type dạng số nhiều
        'singular_name' => 'Ảnh banner slider' //Tên post type dạng số ít
    );

    /*
     * Biến $args là những tham số quan trọng trong Post Type
     */
    $args = array(
        'labels' => $label, //Gọi các label trong biến $label ở trên
        'description' => 'Ảnh banner slider', //Mô tả của post type
        'supports' => array(
            'title',
            'thumbnail',
        ), //Các tính năng được hỗ trợ trong post type 
        'hierarchical' => false, //Cho phép phân cấp, nếu là false thì post type này giống như Post, true thì giống như Page
        'public' => true, //Kích hoạt post type
        'show_ui' => true, //Hiển thị khung quản trị như Post/Page
        'show_in_menu' => true, //Hiển thị trên Admin Menu (tay trái)
        'show_in_nav_menus' => true, //Hiển thị trong Appearance -> Menus
        'show_in_admin_bar' => true, //Hiển thị trên thanh Admin bar màu đen.
        'menu_position' => 5, //Thứ tự vị trí hiển thị trong menu (tay trái)
        'menu_icon' => 'dashicons-format-image', //Đường dẫn tới icon sẽ hiển thị
        'can_export' => true, //Có thể export nội dung bằng Tools -> Export
        'has_archive' => true, //Cho phép lưu trữ (month, date, year)
        'exclude_from_search' => false, //Loại bỏ khỏi kết quả tìm kiếm
        'publicly_queryable' => true, //Hiển thị các tham số trong query, phải đặt true
        'capability_type' => 'post' //
    );

    register_post_type('slider', $args); //Tạo post type với slug tên là sanpham và các tham số trong biến $args ở trên

}
add_action('init', 'tao_custom_post_type');


// -------------------- tính ra phần trăm giảm giá của sản phẩm
function get_sale_percent($price, $salePrice)
{
    $sale = ($salePrice * 100) / $price;
    $percentSale = 100 % -$sale;
    return number_format($percentSale);
}

// ------------------- Ajax action cho thêm sản phẩm vào giỏ hàng
function add_to_cart_ajax_handler() {
    // Kiểm tra ID sản phẩm từ request
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

    // Kiểm tra nếu product_id hợp lệ
    if ($product_id <= 0) {
        wp_send_json_error(['message' => 'Sản phẩm không hợp lệ']);
        wp_die();
    }

    // Lấy thông tin sản phẩm
    $product = wc_get_product($product_id);
    if (!$product) {
        wp_send_json_error(['message' => 'Không tìm thấy sản phẩm']);
        wp_die();
    }

    // Thêm sản phẩm vào giỏ hàng
    $added = WC()->cart->add_to_cart($product_id, $quantity);

    // Kiểm tra nếu sản phẩm được thêm thành công
    ob_start(); // Bắt đầu bộ đệm đầu ra
    if ($added) {
        $product_name = $product->get_name(); // Lấy tên sản phẩm
        wc_print_notice(sprintf('Sản phẩm %s đã được thêm vào giỏ hàng.', $product_name), 'success');
    } else {
        wc_print_notice('Không thể thêm sản phẩm vào giỏ hàng.', 'error');
    }
    $notice_html = ob_get_clean(); // Lưu thông báo vào biến

    wp_send_json_success([
        'notice_html' => $notice_html, // Trả về HTML của thông báo để hiển thị
    ]);

    wp_die(); // Kết thúc AJAX
}

// Đăng ký action cho AJAX
add_action('wp_ajax_add_to_cart', 'add_to_cart_ajax_handler');
add_action('wp_ajax_nopriv_add_to_cart', 'add_to_cart_ajax_handler');
