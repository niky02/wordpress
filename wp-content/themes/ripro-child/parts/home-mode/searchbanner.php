<?php
/**
 * @Author   源码园
 * @WebUrl   www.ymkuzhan.com 源码园
 */
$search_banner_infos = _cao('search_banner_infos');
$search_banner_tags = _cao('search_banner_tags');
$title_place = $search_banner_infos['_title_place'];
$title_one = $search_banner_infos['_title_one'];
$title_two = $search_banner_infos['_title_two'];
?>
<div class="section pt-0 pb-0">
    <div class="row">
        <div id="billboard" class="billboard">
            <div class="banner-top"></div>
            <div class="home-filter--content">
                <div class="newIndex-search newIndex-layout">
                    <div class="container">
                        <h3 class="focusbox-title dynamic-title"
                            data-init="<?php echo $title_one; ?>"
                            data-two="<?php echo $title_two; ?>"><?php echo $title_one; ?></h3>
                        <form class="mb-0" method="get" autocomplete="off" action="/">
                            <div class="form-box search-properties">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-5 col-md-8">
                                        <div class="form-group mb-0">
                                            <input type="text" class="home_search_input" name="s"
                                                   placeholder="<?php echo $title_place; ?>">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-7 col-md-4">
                                        <input type="submit" value="搜索" class="btn btn--block">
                                        <div class="mfl right-but">
                                            <a rel="nofollow" href="/index.php/user?action=write" target="_blank">投稿赚钱</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="home-search-results"></div>
                            </div>
                        </form>
                        <div class="rmbq">
                            <div>
                                <i class="src ri-price-tag-3-line"></i> 热门标签：
                                <?php foreach ($search_banner_tags['search_banner_tags_infos'] as $key => $item) { ?>
                                    <a title="<?php echo $item['_title']; ?>" href="<?php echo $item['_href']; ?>"
                                       target="_blank"><?php echo $item['_title']; ?></a>
                                <?php } ?>
                                <a title="更多标签+" href="/index.php/tags" target="_blank">更多+</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>