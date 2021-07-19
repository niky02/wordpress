<?php
/**
 * @Author   源码园
 * @WebUrl   www.ymkuzhan.com 源码园
 */
?>
<div class="section">
    <div class="container">
        <div class="seanggwrap">
            <div class="seangg comfff wow fadeInUp">
                <?php if (wp_is_mobile()) { ?>
                    <div class="seanggspan"><i class="fa fa-volume-up"></i><span>公告</span></div>
                <?php } else { ?>
                    <div class="seanggspan"><i class="fa fa-volume-up"></i><span>平台公告</span></div>
                <?php } ?>
                <b></b>
                <div class="seanggc"><!--[diy=seanggc]-->
                    <div class="announce-wrap" id="rolltxt">
                        <ul class="announce-list line" style="margin-top: -30px;">
                            <?php
                            $args = array(
                                'post_type' => 'kuaixun',
                                'post_status' => 'publish',
                                'showposts' => '3',
                            );
                            ///////////S CACHE ////////////////
                            if (CaoCache::is()) {
                                $_the_cache_notice_key = 'ripro_child_index_notices_key';
                                $_the_cache_notice_data = CaoCache::get($_the_cache_notice_key);
                                if (false === $_the_cache_notice_data) {
                                    $_the_cache_notice_data = new WP_Query($args); //缓存数据
                                    CaoCache::set($_the_cache_notice_key, $_the_cache_notice_data);
                                }
                                $the_notice_query = $_the_cache_notice_data;
                            } else {
                                echo 1111;$args;
                                $the_notice_query = new WP_Query($args); //原始输出
                            }
                            ///////////S CACHE ////////////////
                            ?>
                            <?php if ($the_notice_query->have_posts()) : ?>
                                <?php while ($the_notice_query->have_posts()) : $the_notice_query->the_post(); ?>
                                    <li><a href="<?php echo esc_url(get_permalink()); ?>"
                                           target="_blank"><?php the_title(); ?><span><?php the_time('Y.n.j'); ?></span></a>
                                    </li>
                                <?php endwhile; ?>
                                <?php wp_reset_postdata(); ?>
                            <?php else : ?>
                                <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <!--[/diy]--></div>
                <div class="clear"></div>
            </div>

            <!--统计 start-->
            <div class="seanchart">
                <ul>
                    <!--[diy=seanchart]-->
                    <div id="portal_block_396_content" class="dxb_bc">
                        <li class="seanchart1"><i class="fa fa-history"></i>
                            <div class="seanchartdiv"><span>今日发布</span>
                                <div class="clear"></div>
                                <em><?php get_today_post_count(); ?></em></div>
                            <div class="clear"></div>
                        </li>
                        <li class="seanchart2"><i class="fa fa-clock-o"></i>
                            <div class="seanchartdiv"><span>本周发布</span>
                                <div class="clear"></div>
                                <em><?php get_week_post_count(); ?></em></div>
                            <div class="clear"></div>
                        </li>
                        <li class="seanchart3"><i class="fa fa-dot-circle-o"></i>
                            <div class="seanchartdiv"><span>资源总数</span>
                                <div class="clear"></div>
                                <em><?php get_all_post_count(); ?></em></div>
                            <div class="clear"></div>
                        </li>


                    </div>
                    <!--[/diy]-->
                    <div class="clear"></div>
                </ul>
            </div>
            <!--统计 end-->
            <div class="clear"></div>
        </div>
    </div>
</div>