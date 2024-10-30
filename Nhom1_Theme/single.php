<?php get_header() ?>

<h1>Trang Post - chi tiet</h1>
<?php 
    while(have_posts()){
        the_post();
        ?>
        <h2><?php the_title() ?></h2>
        <p><?php the_content() ?></p>
        <?php
    }
?>

<?php get_footer() ?>