<?php
/**
 * Template name: 友情链接(Link)
 * Description:   www.ymkuzhan.com 源码园
 * Author   源码园
 */
get_header();
?>
<div class="container">
    <ul class="plinks">
        <?php
        wp_list_bookmarks(array(
            'show_description' => true,
            'show_name' => true,
            'orderby' => 'rating',
            'title_before' => '<h2><i class="fa fa-chain-broken"></i> ',
            'title_after' => '</h2>',
            'order' => 'DESC'
        ));
        ?>
    </ul>
</div>
<?php get_footer(); ?>
