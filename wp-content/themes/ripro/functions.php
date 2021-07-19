<?php

/**
 * RiPro是一个优秀的主题，首页拖拽布局，高级筛选，自带会员生态系统，超全支付接口，你喜欢的样子我都有！
 * 正版唯一购买地址，全自动授权下载使用：https://ritheme.com/
 * 作者唯一QQ：200933220 （油条）
 * 承蒙您对本主题的喜爱，我们愿向小三一样，做大哥的女人，做大哥网站中最想日的一个。
 * 能理解使用盗版的人，但是不能接受传播盗版，本身主题没几个钱，主题自有支付体系和会员体系，盗版风险太高，鬼知道那些人乱动什么代码，无利不起早。
 * 开发者不易，感谢支持，更好的更用心的等你来调教
 */

defined('ABSPATH') || exit;

/**
 * check order OR coipon
 */

$ripro_global_db = array(
    'order_table_name'       => 'cao_order', //订单表
    'paylog_table_name'      => 'cao_paylog', //购买记录表
    'coupon_table_name'      => 'cao_coupon', //卡密表名称
    'balance_log_table_name' => 'cao_balance_log', //余额记录表
    'ref_log_table_name'     => 'cao_ref_log', //推广记录表
    'down_log_table_name'    => 'cao_down_log', //下载记录表
    'mpwx_log_table_name'    => 'cao_mpwx_log',  //微信公众号登录记录表
);

foreach ($ripro_global_db as $name => $db) {
    $$name = isset($table_prefix) ? ($table_prefix . $db) : ($wpdb->prefix . $db);
}

if (!function_exists('caozhuti_setup')):

    function caozhuti_setup() {
        $setupDb = new setupDb();
        $setupDb->install();

        add_theme_support('title-tag');

        add_theme_support('post-thumbnails');
        register_nav_menus(array(
            'menu-1' => '顶部主菜单',
        ));

        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));
        add_theme_support('editor-styles');
        add_theme_support('wp-block-styles');
        add_theme_support('customize-selective-refresh-widgets');
        add_filter('pre_option_link_manager_enabled', '__return_true');
        $init_pages = array(
            'pages/user.php'     => array('用户中心', 'user'),
            'pages/zhuanti.php'  => array('专题', 'zhuanti'),
            'pages/archives.php' => array('存档', 'archives'),
            'pages/tags.php'     => array('标签云', 'tags'),
        );
        foreach ($init_pages as $template => $item) {
            $one_page = array(
                'post_title'  => $item[0],
                'post_name'   => $item[1],
                'post_status' => 'publish',
                'post_type'   => 'page',
                'post_author' => 1,
            );
            ///////////S CACHE ////////////////
            if (CaoCache::is()) {
                $_the_cache_key  = 'ripro_functions_init_pages_' . $template;
                $_the_cache_data = CaoCache::get($_the_cache_key);
                if (false === $_the_cache_data) {
                    $_the_cache_data = get_page_by_title($item[0]); //缓存数据
                    CaoCache::set($_the_cache_key, $_the_cache_data);
                }
                $one_page_check = $_the_cache_data;
            } else {
                $one_page_check = get_page_by_title($item[0]);
            }
            ///////////S CACHE ////////////////

            if (!isset($one_page_check->ID)) {
                $one_page_id = wp_insert_post($one_page);
                update_post_meta($one_page_id, '_wp_page_template', $template);
            }
        }
    }
    add_action('after_setup_theme', 'caozhuti_setup');
endif;

/**
 * [Init_theme 激活主题跳转设置页面]
 * @Author   Dadong2g
 * @DateTime 2019-05-28T11:16:53+0800
 * @param    [type]                   $oldthemename [description]
 */
function Init_to_theme($oldthemename) {
    global $pagenow;
    if ('themes.php' == $pagenow && isset($_GET['activated'])) {
        wp_redirect(admin_url('/admin.php?page=csf-caozhuti#tab=%e4%b8%bb%e9%a2%98%e6%8e%88%e6%9d%83'));
        exit;
    }
}

add_action('after_switch_theme', 'Init_to_theme');

/**
 * [caozhuti_widgets_init Register widget area.]
 * @Author   Dadong2g
 * @DateTime 2019-05-28T23:47:36+0800
 * @return   [type]                   [description]
 */
function caozhuti_widgets_init() {
    $sidebars = array(
        'sidebar'    => '文章页侧栏',
        'off_canvas' => '全站侧栏菜单',
    );
    if (is_cao_site_list_blog() || true) {
        $sidebars['blog'] = '博客模式侧边栏';
    }
    foreach ($sidebars as $key => $value) {
        register_sidebar(array(
            'name'          => $value,
            'id'            => $key,
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h5 class="widget-title">',
            'after_title'   => '</h5>',
        ));
    }

}
add_action('widgets_init', 'caozhuti_widgets_init');

/**
 * [caozhuti_scripts 加载主题JS和CSS资源]
 * @Author   Dadong2g
 * @DateTime 2019-05-28T23:46:28+0800
 * @return   [type]                   [description]
 */
if (!function_exists('caozhuti_scripts')):
    function caozhuti_scripts() {
        $__f = get_template_directory_uri() . '/assets';
        $__v = _the_theme_version();
        if (!is_admin()) {

            // 禁用jquery和110n翻译
            wp_deregister_script('jquery');
            wp_deregister_script('l10n');
            //注册CSS引入CSS
            wp_enqueue_style('external', $__f . '/css/external.css', array(), $__v, 'all');
            wp_enqueue_style('sweetalert2', $__f . '/css/sweetalert2.min.css', array(), $__v, 'all');
            wp_enqueue_style('app', $__f . '/css/app.css', array(), $__v, 'all');
            wp_enqueue_style('diy', $__f . '/css/diy.css', array(), $__v, 'all');
            wp_enqueue_style('fancybox', $__f . '/css/jquery.fancybox.min.css', array(), $__v, 'all');

            // 引入JS
            wp_enqueue_script('jquery', $__f . '/js/jquery-2.2.4.min.js', '', '2.2.4', false);
            wp_enqueue_script('sweetalert2', $__f . '/js/plugins/sweetalert2.min.js', array(), $__v, false);
            wp_enqueue_script('plugins', $__f . '/js/plugins.js', array('jquery'), $__v, true);
            wp_enqueue_script('app', $__f . '/js/app.js', array('plugins'), $__v, true);
            wp_register_script('fancybox', $__f . '/js/plugins/jquery.fancybox.min.js', array('jquery'), $__v, true);
            wp_register_script('llqrcode', $__f . '/js/plugins/llqrcode.js', array('jquery'), '2.0.1', true);
            wp_register_script('captcha', 'https://ssl.captcha.qq.com/TCaptcha.js', array(), '', true);

            if (_cao('is_captcha_qq')) {
                wp_enqueue_script('captcha');
            }
            // llqrcode
            if (is_page_template('pages/user.php')) {
                wp_enqueue_script('llqrcode');
            }
            //jquery.fancybox.min.js
            if (is_singular() && _cao('is_fancybox_img', true)) {
                wp_enqueue_style('fancybox');
                wp_enqueue_script('fancybox');
            }
            if (is_singular() && comments_open() && get_option('thread_comments')) {
                wp_enqueue_script('comment-reply');
            }
            //脚本本地化
            wp_localize_script('app', 'caozhuti',
                array(
                    'site_name'        => get_bloginfo('name'),
                    'home_url'         => esc_url(home_url()),
                    'ajaxurl'          => esc_url(admin_url('admin-ajax.php')),
                    'is_singular'      => is_singular() ? 1 : 0,
                    'tencent_captcha'  => array('is' => _cao('is_captcha_qq', '0'), 'appid' => _cao('captcha_qq_appid', '')),
                    'infinite_load'    => '加载更多',
                    'infinite_loading' => '<i class="fa fa-spinner fa-spin"></i> 加载中...',
                    'site_notice'      => array('is' => _cao('is_site_notify', '0'), 'color' => _cao('site_notify_color', 'rgb(33, 150, 243)'), 'html' => '<div class="notify-content"><h3>' . _cao('site_notify_title', '') . '</h3><div>' . _cao('site_notify_desc', '') . '</div></div>'),
                    'pay_type_html'    => _cao_get_pay_type_html(),
                )
            );

        }
    }
    add_action('wp_enqueue_scripts', 'caozhuti_scripts');
endif;

// 管理页面CSS
function caoAdminScripts() {
    wp_enqueue_style('caoadmin', get_template_directory_uri() . '/assets/css/admin.css', array(), '', 'all');
}
add_action('admin_enqueue_scripts', 'caoAdminScripts');

$ripro_inc_dir   = get_template_directory();
$ripro_theme_uri = get_template_directory_uri();
$ripro_includes  = array(
    '/inc/codestar-framework/codestar-framework.php',
    '/inc/core-functions.php',
    '/inc/theme-functions.php',
    '/inc/core-ajax.php',
 //   'swoole',
 '/inc/class/core.class.7.3.php',
    '/inc/class/walker.class.php',
    '/vendor/autoload.php',
    '/inc/admin/init.php',
);

// Include files.
foreach ($ripro_includes as $file) {
    if ($file === 'swoole') {
        if (extension_loaded('swoole_loader')) {
            $php_v = substr(PHP_VERSION, 0, 3);
            require_once $ripro_inc_dir . '/inc/class/core.class.' . $php_v . '.php';
        } else {
            wp_safe_redirect($ripro_theme_uri . '/help/swoole-compiler-loader.php');die;
        }
    } else {
        require_once $ripro_inc_dir . $file;
    }
}



///////函数文件结束标记//////////