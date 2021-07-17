<?php
/**
 * @Author   源码园
 * @WebUrl   www.ymkuzhan.com 源码园
 */
//推荐轮播模块
$is_host_rotation = _cao('is_host_rotation');
$host_rotation_infos = _cao('host_rotation_infos');
?>
    <div class="section bgcolor-fff">
        <div class="container child-container-special">
            <div class="module category-boxes child-boxes owl-special owl">
                <?php foreach ($host_rotation_infos['data'] as $item) : ?>
                    <div class="category-box">
                        <div class="entry-thumbnails">
                            <div class="big thumbnail">
                                <!--                            <h3 class="entry-title">-->
                                <?php //echo $item['_title']; ?><!--</h3>-->
                                <img class="lazyload" data-src="<?php echo $item['_img']; ?>">
                            </div>
                        </div>
                        <a<?php echo $item['_blank'] ? ' target="_blank"' : ''; ?> class="u-permalink"
                                                                                   href="<?php echo esc_url($item['_href']); ?>"></a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php //get_template_part('parts/home-mode/tagsbox');?>

