<?php
global $product;
?>

<div class="rounded position-relative best-seller-item">
    <div class="best-sell-fruite-img border-bottom-0 rounded-top">
        <a href="<?php the_permalink(); ?>">
            <?php echo get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'img-fluid')); ?>
        </a>
    </div>
    <!-- check xem sp nào giảm giá -->
    <?php if ($product->is_on_sale()) { ?>
        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 15px;">Giảm
            <?php echo get_sale_percent($product->get_regular_price(), $product->get_sale_price()); ?>%
        </div>
    <?php } ?>
    <div class="p-4 border border-secondary border-top-0 rounded-bottom">
        <a href="<?php the_permalink(); ?>" class="h5 best-sell-title"><?php the_title(); ?></a>
        <div class="d-flex justify-content-between flex-lg-wrap best-sell-price">
            <p class="best-sel-price text-danger fs-5 fw-bold mb-0 py-2"><?php echo $product->get_price_html(); ?></p>
            <a href="#" class="btn add-to-cart-ajax border border-secondary rounded-pill px-3 text-primary"
                data-product-id="<?php the_ID(); ?>">
                <i class="fa fa-shopping-bag me-2 text-primary"></i> Thêm vào giỏ hàng
            </a>
        </div>
    </div>
</div>