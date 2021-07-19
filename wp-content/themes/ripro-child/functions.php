<?php
/**
 * title 子主题函数
 * Description   www.ymkuzhan.com 源码园
 * Author   源码园
 */
//后台设置
require_once plugin_dir_path(__FILE__) . '/inc/codestar-framework/codestar-framework.php';
//文章简码优化排版
require_once get_stylesheet_directory() . '/inc/shortcodes/shortcodes.php';
require_once get_stylesheet_directory() . '/inc/shortcodes/shortcodespanel.php';
require_once get_stylesheet_directory() . '/inc/theme-functions.php';

//底部登陆栏-社交登录按钮
function _the_child_open_oauth_login_btn()
{
    if (_cao('is_oauth_qq') || _cao('is_oauth_weixin') || _cao('is_oauth_mpweixin') || _cao('is_oauth_weibo')) {
        $oauthArr = array('qq', 'weixin', 'mpweixin', 'weibo');
        $oauthArrValue = array(
            'qq' => 'QQ登录',
            'weixin' => '微信登录',
            'weibo' => '微博登录',
        );
        $rurl = home_url(add_query_arg(array()));
        foreach ($oauthArr as $value) {
            if (_cao('is_oauth_' . $value)) {
                if ($value != 'mpweixin') {
                    echo '<span class="wic_slogin_line"></span>
            <div class="wic_slogin_' . $value . '">
                <a href="' . esc_url(home_url('/oauth/' . $value . '?rurl=' . $rurl)) . '"
                                          class="qqbutton" rel="nofollow"><i class="fa fa-' . $value . '"></i>' . $oauthArrValue[$value] . '</a>
            </div>';
                }
            }
        }
    }
}

//文章内页面包屑导航
function zy_breadcrumbs()
{
    if ((is_single() && !_cao('is_archive_crumbs') && !is_attachment()) || is_attachment()) {
        return '当前位置：<a href="' . get_bloginfo('url') . '">' . get_bloginfo('name') . '</a> <small>></small> <a href="' . esc_url(get_permalink()) . '">' . get_the_title() . '</a>';
    } else {
        return false;
    }
}

//vip-theme-tag
function vip_article_tag()
{
    global $post;
    $post_ID = $post->ID;
    if (get_post_meta($post_ID, 'cao_price', true) == 0) {
        echo '<div class="vip-theme-tag"><span class="free-tag"></span></div>';
    } else {
        echo '<div class="vip-theme-tag"><span class="vip-tag"></span></div>';
    }
}

//文章类型标识
function articleType()
{
    global $post;
    $post_ID = $post->ID;
    $cao_is_article_type = get_post_meta($post_ID, 'cao_is_article_type', true);
    $cao_article_type_info = get_post_meta($post_ID, 'cao_article_type_info', true);
    if ($cao_is_article_type) {
        $bac = 'background: ' . $cao_article_type_info['_color'] . ' 0%);';
        echo '<div class="free-theme-tag-list"><p style="' . $bac . '">' . $cao_article_type_info['_tag'] . '</p></div>';
    }
}

//提示文章更新
function articleUpdateTips()
{
    global $post;
    $post_ID = $post->ID;
    $cao_article_tips = get_post_meta($post_ID, 'cao_article_tips', true);
    if ($cao_article_tips && !wp_is_mobile()) {
        echo '<div class="tips-theme-tag">' . $cao_article_tips . '</div>';
    }
}

//演示标识-演示链接
function demoMark()
{
    global $post;
    $post_ID = $post->ID;
    $cao_demourl = get_post_meta($post_ID, 'cao_demourl', true);
    $cao_is_demo_url = get_post_meta($post_ID, 'cao_is_demo_url', true);
    $cao_demo_url = get_post_meta($post_ID, 'cao_demo_url', true);
    $cao_is_demo_img = get_post_meta($post_ID, 'cao_is_demo_img', true);
    $goName = '';
    $goUrl = '';
    if ($cao_demourl) {
        $goName = ' 演示';
        $goUrl = $cao_demourl;
    } else if ($cao_is_demo_url) {
        $goName = ' 演示';
        $goUrl = $cao_demo_url;
    } else if ($cao_is_demo_img == true) {
        $goName = ' 演示';
        $goUrl = '/demo?post_id=' . $post_ID;
    }
    if ($goName) {
        echo '<a target="_blank" class="demo-theme-tag" href="' . $goUrl . '"><i class="fa fa-television"></i>' . $goName . '</a>';
    }
}

//文章阅读预计时间
function count_words_read_time()
{
    global $post;
    $text_num = mb_strlen(preg_replace("/\\s/", "", html_entity_decode(strip_tags($post->post_content))), "UTF-8");
    $read_time = ceil($text_num / 400);
    $output .= "本文共" . $text_num . "个字，预计阅读时间需要" . $read_time . "分钟";
    return $output;
}

//弹幕-下载订单数据(缓存)
function get_paylogs_cache()
{
    ///////////S CACHE ////////////////
    if (CaoCache::is()) {
        $_the_cache_key = 'ripro_child_get_paylogs_cache_key';
        $count_cache = CaoCache::get($_the_cache_key);
        if (false === $count_cache) {
            $count_cache = get_paylogs();
            CaoCache::set($_the_cache_key, $count_cache);
        }
        $data = $count_cache;
    } else {
        $data = get_paylogs();
    }
    ///////////S CACHE ////////////////
    echo $data;
}

//弹幕-下载订单数据
function get_paylogs()
{
    global $wpdb, $paylog_table_name, $down_log_table_name;
    //$list = $wpdb->get_results("SELECT * FROM $paylog_table_name WHERE status =1 ORDER BY create_time DESC limit 18");
    $list = $wpdb->get_results("SELECT * FROM $down_log_table_name ORDER BY id DESC limit 15");
    $barrages = array();
    foreach ($list as $value) {
        $user_id = $value->user_id;
        $post_id = $value->down_id;
        $info = substr_replace(get_user_by('id', $user_id)->user_login, '**', '2') . " 刚刚下载了 " . mb_substr(get_the_title($post_id), 0, 8);
        $img = _get_user_avatar_url('user', get_the_author_meta('ID', $user_id));
        $href = get_permalink($post_id);
        $new = array(
            'info' => $info,
            'img' => $img,
            'href' => $href,
            'speed' => 15,
            'color' => '#fff',
            'bottom' => 85,
            'close' => false
        );
        array_push($barrages, $new);
    };
    //$mode = 1;
    return json_encode($barrages);
//    if ($mode === 1) {
//        return json_encode($barrages[array_rand($barrages)]);
//    } elseif ($mode === 2) {
//        return json_encode($barrages);
//    }
}

//检测文章是否是永久会员
function _get_post_cao_is_boosvip()
{
    global $post;
    $post_ID = $post->ID;
    if (get_post_meta($post_ID, 'cao_price', true) == 0) {
        if (_cao('is_article_list_down')) {
            return '免费';
        } else {
            return '';
        }
    }
    if (get_post_meta($post_ID, 'cao_is_boosvip', true)) {
        return '终身VIP免费';
    }
    if (get_post_meta($post_ID, 'cao_vip_rate', true) == 0) {
        return 'VIP免费';
    }
    $cao_vip_rate = get_post_meta($post_ID, 'cao_vip_rate', true) * 10;
    return 'VIP ' . $cao_vip_rate . '折';
}

//每日更新的文章数量
function get_today_post_count()
{
    $today = getdate();
    ///////////S CACHE ////////////////
    if (CaoCache::is()) {
        $_the_cache_key = 'ripro_child_today_posts_count_key';
        $count_cache = CaoCache::get($_the_cache_key);
        if (false === $count_cache) {
            $query = new WP_Query('year=' . $today["year"] . '&monthnum=' . $today["mon"] . '&day=' . $today["mday"]);
            $count_cache = $query->found_posts;
            CaoCache::set($_the_cache_key, $count_cache);
        }
        $count = $count_cache;
    } else {
        $query = new WP_Query('year=' . $today["year"] . '&monthnum=' . $today["mon"] . '&day=' . $today["mday"]);
        $count = $query->found_posts;
    }
    ///////////S CACHE ////////////////
    echo $count;
}

// 每周更新的文章数量
function get_week_post_count()
{
    $date_query = array(
        array(
            'after' => '1 week ago'
        )
    );
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'date_query' => $date_query,
        'no_found_rows' => true,
        'suppress_filters' => true,
        'fields' => 'ids',
        'posts_per_page' => -1
    );
    ///////////S CACHE ////////////////
    if (CaoCache::is()) {
        $_the_cache_key = 'ripro_child_week_posts_count_key';
        $count_cache = CaoCache::get($_the_cache_key);
        if (false === $count_cache) {
            $query = new WP_Query($args);
            $count_cache = $query->post_count;
            CaoCache::set($_the_cache_key, $count_cache);
        }
        $count = $count_cache;
    } else {
        $query = new WP_Query($args);
        $count = $query->post_count;
    }
    ///////////S CACHE ////////////////
    echo $count;
}

//资源总数
function get_all_post_count()
{
    ///////////S CACHE ////////////////
    if (CaoCache::is()) {
        $_the_cache_key = 'ripro_child_all_posts_count_key';
        $count_cache = CaoCache::get($_the_cache_key);
        if (false === $count_cache) {
            $count_cache = wp_count_posts()->publish;
            CaoCache::set($_the_cache_key, $count_cache);
        }
        $count = $count_cache;
    } else {
        $count = wp_count_posts()->publish;
    }
    ///////////S CACHE ////////////////
    echo $count;
}

//用户总数
function get_all_users_count()
{
    global $wpdb;
    ///////////S CACHE ////////////////
    if (CaoCache::is()) {
        $_the_cache_key = 'ripro_child_all_users_count_key';
        $count_cache = CaoCache::get($_the_cache_key);
        if (false === $count_cache) {
            $count_cache = $wpdb->get_var("SELECT COUNT(ID) FROM $wpdb->users");
            CaoCache::set($_the_cache_key, $count_cache);
        }
        $count = $count_cache;
    } else {
        $count = $wpdb->get_var("SELECT COUNT(ID) FROM $wpdb->users");
    }
    ///////////S CACHE ////////////////
    echo $count;

}

//自动为文章添加已使用过的标签
function array2object($array)
{ // 数组转对象
    if (is_array($array)) {
        $obj = new StdClass();
        foreach ($array as $key => $val) {
            $obj->$key = $val;
        }
    } else {
        $obj = $array;
    }
    return $obj;
}

function object2array($object)
{ // 对象转数组
    if (is_object($object)) {
        foreach ($object as $key => $value) {
            $array[$key] = $value;
        }
    } else {
        $array = $object;
    }
    return $array;
}

//获取最近注册用户-缓存
function active_users_cache()
{
    ///////////S CACHE ////////////////
    if (CaoCache::is()) {
        $_the_cache_key = 'ripro_active_user_list_child';
        $_the_cache_data = CaoCache::get($_the_cache_key);
        if (false === $_the_cache_data) {
            $_the_cache_data = active_users(); //缓存数据
            CaoCache::set($_the_cache_key, $_the_cache_data);
        }
        $active_users_cache = $_the_cache_data;
    } else {
        $active_users_cache = active_users();
    }
    ///////////S CACHE ////////////////
    echo $active_users_cache;
}

//获取最近注册用户
function active_users()
{
    global $wpdb, $down_log_table_name;
    $active_user_infos = _cao('active_user_infos');
    // start
    $limit = $active_user_infos['_num'];
    $output = '';
    //查询用户
    $arg = array(
        'meta_key' => 'cao_balance',
        'meta_query' => array(),
        'orderby' => 'ID',
        'order' => 'DESC',
        'number' => $limit,
        'count_total' => false,
    );
    $users = get_users($arg); //原始输出
    if (!empty($users)) {
        foreach ($users as $key => $search_user) {
            $CaoUser = new CaoUser($search_user->ID);
            $down_counts = $wpdb->get_var("SELECT count(*) counts FROM $down_log_table_name where user_id={$search_user->ID} limit 1");
            $comment_counts = $wpdb->get_var("SELECT count(*) FROM {$wpdb->comments} WHERE `comment_approved`='1' and `user_id`='{$search_user->ID}' LIMIT 1");
            $output .= '<li>';
            $output .= '<div class="item box b2-radius">';
            $output .= '<article class="warp">';
            $output .= '<div class="ava">' . get_avatar($search_user->ID) . '</div>';
            $output .= '<div class="info">';
            $output .= '<div class="name">';
            $output .= '<a>' . $search_user->display_name . '</a>';
            $output .= '<em class="vip">' . $CaoUser->vip_name() . '用户</em>';
            $output .= '</div>';
            $output .= '<div class="count"><span>下载：<b>' . $down_counts . '</b></span><span>评论：<b>' . $comment_counts . '</b></span></div>';
            $output .= '</div>';
            $output .= '</article>';
            $output .= '</div>';
            $output .= '</li>';
        }
    }
    return '<ul>' . $output . '</ul>';
}

//价格搜索-链接替换
function preg_replace_link($str)
{
    return preg_replace('/\/page\/(.*)\?/', '?', $str);
}