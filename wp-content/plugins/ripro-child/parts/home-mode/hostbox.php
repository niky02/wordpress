<?php
/**
 * @Author   源码园
 * @WebUrl   www.ymkuzhan.com 源码园
 */
$sidebar = 'none';
$column_classes = cao_column_classes($sidebar);
//置顶轮播商品模块
$is_host_rotation = _cao('is_host_rotation');
$host_rotation_infos = _cao('host_rotation_infos');
//置顶文章
$args['post__in'] = get_option('sticky_posts');
$args['caller_get_posts'] = 0;
///////////S CACHE ////////////////
if (CaoCache::is()) {
    $_the_cache_key = 'ripro_child_host_box_list';
    $_the_cache_data = CaoCache::get($_the_cache_key);
    if (false === $_the_cache_data) {
        $_the_cache_data = new WP_Query($args); //缓存数据
        CaoCache::set($_the_cache_key, $_the_cache_data);
    }
    $psots_host_data = $_the_cache_data;
} else {
    $psots_host_data = new WP_Query($args); //原始输出
}
///////////S CACHE ////////////////
?>
<?php if (_cao('is_mobele_list') && wp_is_mobile()) {?>
    <div class="section">
        <div class="row">
            <div class="<?php echo esc_attr($column_classes[0]); ?>">
                <div class="content-area">
                    <main class="site-main widget_tabcontent  ct">
                        <link rel="stylesheet" id="wp-block-library-css"
                              href="//at.alicdn.com/t/font_1631810_4drehjsmfd.css" type="text/css"
                              media="all">
                        <?php if (is_home()) : ?>
                        <div class="container child-container">
                            <div class="cl pos">
                                <ul class="h-screen">
                                    <span class="title">Hi&nbsp;&nbsp;&nbsp;热门推荐</span>
                                </ul>
                            </div>
                        </div>
                        <div class="container">
                            <?php endif; ?>
                        </div>
                        <?php if ($psots_host_data->have_posts()) : ?>
                            <ul class="hide-code show">
                                <div class="container">
                                    <div class="row posts-wrapper">
                                        <?php while ($psots_host_data->have_posts()) : $psots_host_data->the_post();
                                            get_template_part('parts/template-parts/content', _cao('latest_layout', 'list'));
                                        endwhile; ?>
                                    </div>
                                </div>
                            </ul>
                        <?php else : ?>
                            <?php get_template_part('parts/template-parts/content', 'none'); ?>
                        <?php endif; ?>
                    </main>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php
    wp_reset_postdata();
    echo ob_get_clean(); ?>
<?php }else{ ?>
<div class="section">
    <div class="container child-container">
        <div class="cl pos">
            <ul class="h-screen">
                <span class="title">Hi&nbsp;&nbsp;&nbsp;热门推荐</span>
                &nbsp;&nbsp;<span class="desc" id="hitokotoT">渐行渐远渐无书，水阔鱼沉何处问。</span>
                <script src="https://v1.hitokoto.cn/?encode=js&amp;select=%23hitokotoT" defer=""></script>
            </ul>
        </div>
        <div class="module category-boxes child-boxes owl child-boxes-host">
            <?php while ($psots_host_data->have_posts()) : $psots_host_data->the_post();
                get_template_part('parts/template-parts/li-content', _cao('latest_layout', 'list'));
            endwhile; ?>
        </div>
    </div>
</div>
<?php }?>

