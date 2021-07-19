<?php if (!defined('ABSPATH')) {
    die;
} // Cannot access directly.

/**
 * [管理后台选项配置]
 * @Author   源码园
 * @WebUrl   www.ymkuzhan.com 源码园
 */
$prefix = '_caozhuti_options';
$tips_6_2 = '';
$tips_6_3 = '';
$tips_6_4 = '';
$tips_6_5 = '';
$tips_6_6 = '';

//
// 首页: 子主题美化设置
//
CSF::createSection($prefix, array(
    'id' => 'child_home_fields',
    'title' => '子主题美化设置',
    'icon' => 'fa fa-cubes',
    'description' => '子主题美化设置',
));

//
// 首页设置: 布局设置
//
CSF::createSection($prefix, array(
    'parent' => 'child_home_fields',
    'title' => '——首页模块布局',
    'icon' => 'fa fa-home',
    'description' => '拖拽要启用的模块和排序',
    'fields' => array(
        array(
            'type' => 'notice',
            'style' => 'success',
            'content' => '注意，这里模块如果是比较旧的版本升级最新版后不现实新的模块，请重置【当前分区】重新布局拖拽一下，然后再模块参数设置具体参数即可，千万别手贱点击全部重置。',
        ),
        array(
            'id' => 'child_home_mode',
            'type' => 'sorter',
            'title' => '',
            'enabled_title' => '显示的模块',
            'disabled_title' => '隐藏',
            'default' => array(
                'enabled' => array(
                    'searchbanner' => '搜索条模块(子)',
                    'specialbox' => '专题模块(子)',
                    'notice' => '公告+统计模块(子)',
                    'classbox' => '四栏展示模块(子)',
                    'tabbox' => '选项切换模块(子)',
                    'catpost' => '分类CMS文章展模块',
                    'ulist' => '纯标题文章模块',
                    'activeuser' => '近期用户模块(子)',
                ),
                'disabled' => array(
                    'childbanner' => '幻灯片模块(子)',
                    'gridpost' => '网格文章展示模块',
                    'slider' => '幻灯片模块',
                    'codecdk' => '卡密发放模块',
                    'vip' => '会员介绍模块',
                    'lastpost' => '最新文章模块',
                ),
            ),
        ),
    ),
));
// 首页-近期用户模块（子）
CSF::createSection($prefix, array(
    'parent' => 'child_home_fields',
    'title' => '——近期用户模块(子)',
    'icon' => 'fa fa-home',
    'description' => '近期用户设置，请确认已在 「 <font color="red">首页设置-首页布局</font> 」 中显示！',
    'fields' => array(
        array(
            'id' => 'active_user_infos',
            'type' => 'fieldset',
            'title' => '用户信息',
            'fields' => array(
                array(
                    'id' => '_num',
                    'type' => 'text',
                    'title' => '显示数量',
                    'default' => 8,
                )
            ),
        ),
    ),
));

// 首页-搜索条模块
CSF::createSection($prefix, array(
    'parent' => 'child_home_fields',
    'title' => '——搜索条模块(子)',
    'icon' => 'fa fa-home',
    'description' => '搜索条设置，请确认已在 「 <font color="red">首页设置-首页布局</font> 」 中显示！',
    'fields' => array(
        array(
            'id' => 'search_banner_infos',
            'type' => 'fieldset',
            'title' => '搜索框',
            'fields' => array(
                array(
                    'id' => '_title_place',
                    'type' => 'text',
                    'title' => '输入框提示',
                    'default' => '海量资源每日更新，输入关键词搜索...',
                ),
                array(
                    'id' => '_title_one',
                    'type' => 'text',
                    'title' => '跳动主标题',
                    'default' => '源码园，建站神器',
                ),
                array(
                    'id' => '_title_two',
                    'type' => 'text',
                    'title' => '跳动副标题',
                    'default' => '2021年快乐.万象复苏',
                )
            ),
            'default' => array(
                '_title_place' => '海量资源每日更新，输入关键词搜索...',
                '_title_one' => '源码园，建站神器',
                '_title_two' => '2021年快乐.万象复苏',
            )
        ),
        //热门标签
        array(
            'id' => 'search_banner_tags',
            'type' => 'fieldset',
            'title' => '热门标签',
            'fields' => array(
                array(
                    'id' => 'search_banner_tags_infos',
                    'type' => 'group',
                    'fields' => array(
                        array(
                            'id' => '_title',
                            'type' => 'text',
                            'title' => '标签名称',
                            'default' => 'wordpress',
                        ),
                        array(
                            'id' => '_href',
                            'type' => 'text',
                            'title' => '链接地址',
                            'placeholder' => 'http://',
                            'default' => '#',
                        ),
                    )
                )
            ),
        ),
    ),
));

// 首页-幻灯片模块
CSF::createSection($prefix, array(
    'parent' => 'child_home_fields',
    'title' => '——幻灯片模块(子)',
    'icon' => 'fa fa-home',
    'description' => '幻灯片设置，请确认已在 「 <font color="red">首页设置-首页布局</font> 」 中显示！',
    'fields' => array(
        //右下角图标
        array(
            'id' => 'is_childbanner_rightbottom_icon',
            'type' => 'switcher',
            'title' => '是否显示轮播图右下角图标',
            'default' => true,
        ),
        array(
            'id' => 'childbanner_rightbottom_icon_info',
            'type' => 'fieldset',
            'title' => '轮播图右下角图标配置',
            'fields' => array(
                array(
                    'id' => '_img',
                    'type' => 'upload',
                    'default' => get_stylesheet_directory_uri() . '/assets/images/nesw_css_split.png',
                )
            ),
            'dependency' => array('is_childbanner_rightbottom_icon', '==', 'true'),
        ),
        //三合一幻灯片模块
        array(
            'id' => 'is_threeone_childbanner',
            'type' => 'switcher',
            'title' => '是否开启三合一幻灯片',
            'default' => true,
        ),
        array(
            'id' => 'threeone_childbanner',
            'type' => 'fieldset',
            'title' => '幻灯片左侧轮播配置',
            'fields' => array(
                array(
                    'id' => 'threeone_childbanner_info',
                    'type' => 'group',
                    'fields' => array(
                        array(
                            'id' => '_tag',
                            'type' => 'text',
                            'title' => '标签',
                            'default' => '活动',
                        ),
                        array(
                            'id' => '_title',
                            'type' => 'text',
                            'title' => '标题',
                            'default' => '源码园！',
                        ),
                        array(
                            'id' => '_img',
                            'type' => 'upload',
                            'title' => '上传幻灯片',
                            'library' => 'image',
                            'placeholder' => 'http://',
                            'default' => get_stylesheet_directory_uri() . '/assets/images/demobanner.png',
                        ),
                        array(
                            'id' => '_blank',
                            'type' => 'switcher',
                            'title' => '新窗口打开链接',
                            'label' => '',
                            'default' => true,
                        ),
                        array(
                            'id' => '_href',
                            'type' => 'text',
                            'title' => '链接地址',
                            'placeholder' => 'http://',
                            'default' => '#',
                        ),
                    )
                )
            ),
            'dependency' => array('is_threeone_childbanner', '==', 'true'),
        ),
        array(
            'id' => 'childbanner_rightup_info',
            'type' => 'fieldset',
            'title' => '幻灯片右侧推荐(上)',
            'fields' => array(
                array(
                    'id' => '_title',
                    'type' => 'text',
                    'title' => '标题',
                    'default' => '加入会员，畅快下载',
                ),
                array(
                    'id' => '_img',
                    'type' => 'upload',
                    'title' => '图片',
                    'library' => 'image',
                    'placeholder' => 'http://',
                    'default' => get_stylesheet_directory_uri() . '/assets/images/join_vip.jpg',
                ),
                array(
                    'id' => '_blank',
                    'type' => 'switcher',
                    'title' => '新窗口打开链接',
                    'label' => '',
                    'default' => true,
                ),
                array(
                    'id' => '_href',
                    'type' => 'text',
                    'title' => '链接地址',
                    'placeholder' => 'http://',
                    'default' => '#',
                ),
            ),
            'dependency' => array('is_threeone_childbanner', '==', 'true'),
        ),
        array(
            'id' => 'childbanner_rightlower_info',
            'type' => 'fieldset',
            'title' => '幻灯片右侧推荐(下)',
            'fields' => array(
                array(
                    'id' => '_title',
                    'type' => 'text',
                    'title' => '标题',
                    'default' => '侵权投诉，联系我们',
                ),
                array(
                    'id' => '_img',
                    'type' => 'upload',
                    'title' => '图片',
                    'library' => 'image',
                    'placeholder' => 'http://',
                    'default' => get_stylesheet_directory_uri() . '/assets/images/tousu.jpg',
                ),
                array(
                    'id' => '_href',
                    'type' => 'text',
                    'title' => '链接地址',
                    'placeholder' => 'http://',
                    'default' => '#',
                ),
            ),
            'dependency' => array('is_threeone_childbanner', '==', 'true'),
        ),
    ),
));

// 首页-四栏展示模块
CSF::createSection($prefix, array(
    'parent' => 'child_home_fields',
    'title' => '——四栏展示模块(子)',
    'icon' => 'fa fa-home',
    'description' => '四栏展示模块设置，请确认已在 「 <font color="red">首页设置-首页布局</font> 」 中显示！',
    'fields' => array(
        array(
            'id' => 'class_cloud_info',
            'type' => 'fieldset',
            'title' => '云服务器',
            'subtitle' => '最多可以添加8条数据',
            'fields' => array(
                array(
                    'id' => 'class_cloud_info_data',
                    'type' => 'group',
                    'max' => '8',
                    'fields' => array(
                        array(
                            'id' => '_title',
                            'type' => 'text',
                            'title' => '标题',
                            'default' => '阿里云',
                        ),
                        array(
                            'id' => '_img',
                            'type' => 'upload',
                            'title' => '图片',
                            'library' => 'image',
                            'placeholder' => 'http://',
                            'default' => get_stylesheet_directory_uri() . '/assets/images/aliyun.png',
                        ),
                        array(
                            'id' => '_blank',
                            'type' => 'switcher',
                            'title' => '新窗口打开链接',
                            'label' => '',
                            'default' => true,
                        ),
                        array(
                            'id' => '_href',
                            'type' => 'text',
                            'title' => '链接地址',
                            'placeholder' => 'http://',
                            'default' => '#',
                        ),
                    )
                )
            ),
        ),
        array(
            'id' => 'class_host_info',
            'type' => 'fieldset',
            'title' => '热门专栏',
            'subtitle' => '根据需要设置对应的条数',
            'fields' => array(
                array(
                    'id' => 'class_host_info_data',
                    'type' => 'group',
                    'fields' => array(
                        array(
                            'id' => '_title',
                            'type' => 'text',
                            'title' => '标题',
                            'default' => '',
                        ),
                        array(
                            'id' => '_blank',
                            'type' => 'switcher',
                            'title' => '新窗口打开链接',
                            'label' => '',
                            'default' => true,
                        ),
                        array(
                            'id' => '_href',
                            'type' => 'text',
                            'title' => '链接地址',
                            'placeholder' => 'http://',
                            'default' => '#',
                        ),
                    )
                )
            ),
        ),
        array(
            'id' => 'class_cms_info',
            'type' => 'fieldset',
            'title' => '专题模板',
            'subtitle' => '最多可以添加4条数据',
            'fields' => array(
                array(
                    'id' => 'class_cms_info_data',
                    'type' => 'group',
                    'fields' => array(
                        array(
                            'id' => '_title',
                            'type' => 'text',
                            'title' => '标题',
                            'default' => '',
                        ),
                        array(
                            'id' => '_icon',
                            'type' => 'text',
                            'title' => '图标',
                            'default' => 'fa fa-wordpress',
                            'desc' => '<a href="http://www.fontawesome.com.cn/faicons/">查看 </a>Font Awesome 图标',
                        ),
                        array(
                            'id' => '_blank',
                            'type' => 'switcher',
                            'title' => '新窗口打开链接',
                            'label' => '',
                            'default' => true,
                        ),
                        array(
                            'id' => '_href',
                            'type' => 'text',
                            'title' => '链接地址',
                            'placeholder' => 'http://',
                            'default' => '#',
                        ),
                    )
                )
            ),
        ),
        array(
            'id' => 'class_news_info',
            'type' => 'fieldset',
            'title' => '最新活动',
            'subtitle' => '最多可以添加4条数据',
            'fields' => array(
                array(
                    'id' => 'class_news_info_data',
                    'type' => 'group',
                    'fields' => array(
                        array(
                            'id' => '_title',
                            'type' => 'text',
                            'title' => '标题',
                            'default' => '源码园终身会员仅需98块',
                        ),
                        array(
                            'id' => '_tag',
                            'type' => 'text',
                            'title' => '标签',
                            'default' => '会员特卖',
                        ),
                        array(
                            'id' => '_blank',
                            'type' => 'switcher',
                            'title' => '新窗口打开链接',
                            'label' => '',
                            'default' => true,
                        ),
                        array(
                            'id' => '_href',
                            'type' => 'text',
                            'title' => '链接地址',
                            'placeholder' => 'http://',
                            'default' => '#',
                        ),
                    )
                )
            ),
        ),
    ),
));

//
// 首页-专题模块
//
CSF::createSection($prefix, array(
    'parent' => 'child_home_fields',
    'title' => '——推荐专题模块(子)',
    'icon' => 'fa fa-home',
    'description' => '推荐专题模块设置，请确认已在 「 <font color="red">首页设置-首页布局</font> 」 中显示！',
    'fields' => array(
        //推荐轮播模块
        array(
            'id' => 'is_host_rotation',
            'type' => 'switcher',
            'title' => '是否开启推荐轮播模块',
            'default' => true,
        ),
        array(
            'id' => 'host_rotation_infos',
            'type' => 'fieldset',
            'title' => '推荐轮播模块设置',
            'fields' => array(
                array(
                    'id' => 'data',
                    'type' => 'group',
                    'fields' => array(
                        array(
                            'id' => '_title',
                            'type' => 'text',
                            'title' => '标题',
                            'default' => '源码园，Ripro子主题促销！',
                        ),
                        array(
                            'id' => '_img',
                            'type' => 'upload',
                            'title' => '上传幻灯片',
                            'library' => 'image',
                            'placeholder' => 'http://',
                            'default' => get_stylesheet_directory_uri() . '/assets/images/tuij-child.png',
                        ),
                        array(
                            'id' => '_blank',
                            'type' => 'switcher',
                            'title' => '新窗口打开链接',
                            'label' => '',
                            'default' => true,
                        ),
                        array(
                            'id' => '_href',
                            'type' => 'text',
                            'title' => '链接地址',
                            'placeholder' => 'http://',
                            'default' => 'https://www.ymkuzhan.com',
                        ),
                    )
                )
            ),
            'dependency' => array('is_host_rotation', '==', 'true'),
        ),
    ),
));

//
// 首页-选项切换模块
//
CSF::createSection($prefix, array(
    'parent' => 'child_home_fields',
    'title' => '——选项切换模块(子)',
    'icon' => 'fa fa-home',
    'description' => '选项切换模块设置，请确认已在 「 <font color="red">首页设置-首页布局</font> 」 中显示！',
    'fields' => array(
        array(
            'id' => 'is_tab_style_one',
            'type' => 'switcher',
            'title' => '是否开启TAB样式（Ⅰ）',
            'default' => false,
        ),
        array(
            'id' => 'is_tab_style_two',
            'type' => 'switcher',
            'title' => '是否开启TAB样式（Ⅱ）',
            'default' => true,
        ),
        array(
            'id' => 'tab_style_two_host_info',
            'type' => 'fieldset',
            'title' => 'TAB样式2-推荐文章',
            'fields' => array(
                array(
                    'id' => '_title',
                    'type' => 'text',
                    'title' => '标题',
                    'default' => 'Ripro美化子主题上新啦！！',
                ),
                array(
                    'id' => '_blank',
                    'type' => 'switcher',
                    'title' => '新窗口打开链接',
                    'label' => '',
                    'default' => true,
                ),
                array(
                    'id' => '_href',
                    'type' => 'text',
                    'title' => '链接地址',
                    'placeholder' => 'http://',
                    'default' => 'http://www.ymkuzhan.com',
                ),
            ),
            'dependency' => array('is_tab_style_two', '==', 'true'),
        ),
        array(
            'id' => 'tab_style_two_update_info',
            'type' => 'fieldset',
            'title' => 'TAB样式2-网站更新',
            'fields' => array(
                array(
                    'id' => '_title',
                    'type' => 'text',
                    'title' => '标题',
                    'default' => 'Ripro美化子主题上新啦！！',
                ),
                array(
                    'id' => '_blank',
                    'type' => 'switcher',
                    'title' => '新窗口打开链接',
                    'label' => '',
                    'default' => true,
                ),
                array(
                    'id' => '_href',
                    'type' => 'text',
                    'title' => '链接地址',
                    'placeholder' => 'http://',
                    'default' => 'http://www.ymkuzhan.com',
                ),
            ),
            'dependency' => array('is_tab_style_two', '==', 'true'),
        ),
    ),
));

//
// 首页-文章列表设置
//
CSF::createSection($prefix, array(
    'parent' => 'child_home_fields',
    'title' => '——文章列表设置',
    'icon' => 'fa fa-home',
    'description' => '文章列表设置！',
    'fields' => array(
        array(
            'id' => 'is_article_list_down',
            'type' => 'switcher',
            'title' => '是否开启下载代替价格显示',
            'desc' => '设置了之后，列表页不会显示价格，价格位置会显示下载图标，只有在详情才会显示价格',
            'default' => false,
        ),
    ),
));
//
// 首页-文章内页设置
//
CSF::createSection($prefix, array(
    'parent' => 'child_home_fields',
    'title' => '——文章内页设置',
    'icon' => 'fa fa-home',
    'description' => '文章内页设置',
    'fields' => array(
        array(
            'id' => 'is_article_faq',
            'type' => 'switcher',
            'title' => '是否开启文章底部FAQ',
            'default' => true,
        ),
        array(
            'id' => 'article_faq_info',
            'type' => 'group',
            'title' => 'FAQ内容设置',
            'fields' => array(
                array(
                    'id' => '_title',
                    'type' => 'text',
                    'title' => '问题',
                    'default' => '',
                ),
                array(
                    'id' => '_answer',
                    'type' => 'textarea',
                    'title' => '答案',
                    'placeholder' => 'http://',
                    'default' => '#',
                ),
            ),
            'default' => array(
                0 => array(
                    '_title' => '免费下载或者VIP会员专享资源能否直接商用？',
                    '_answer' => '本站所有资源版权均属于原作者所有，这里所提供资源均只能用于参考学习用，请勿直接商用。若由于商用引起版权纠纷，一切责任均由使用者承担。更多说明请参考 VIP介绍。'
                )
            ),
            'dependency' => array('is_article_faq', '==', 'true'),
        ),
    ),
));

//
// 首页-全站浮动设置
//
CSF::createSection($prefix, array(
    'parent' => 'child_home_fields',
    'title' => '——全站浮动设置',
    'icon' => 'fa fa-home',
    'description' => '全站浮动设置',
    'fields' => array(
        array(
            'id' => 'is_sidebar_ripro_float',
            'type' => 'switcher',
            'title' => '是否开启RiPro原生浮动样式',
            'default' => false,
        ),
        array(
            'id' => 'is_sidebar_childripro_float',
            'type' => 'switcher',
            'title' => '是否开启美化浮动样式',
            'default' => true,
        ),
        array(
            'id' => 'user_favourable_img_info',
            'type' => 'fieldset',
            'title' => '会员特惠设置',
            'fields' => array(
                array(
                    'id' => '_img',
                    'type' => 'upload',
                    'title' => '图片',
                    'library' => 'image',
                    'placeholder' => 'http://',
                    'desc' => '内容为空则不显示',
                    'default' => get_stylesheet_directory_uri() . '/assets/images/zhaomu.png',
                ),
            ),
            'dependency' => array('is_sidebar_childripro_float', '==', 'true'),
        ),
        array(
            'id' => 'is_sidebar_childripro_sign',
            'type' => 'switcher',
            'title' => '是否开启签到的按钮',
            'default' => true,
            'dependency' => array('is_sidebar_childripro_float', '==', 'true'),
        ),
        array(
            'id' => 'is_sidebar_childripro_kefu',
            'type' => 'switcher',
            'title' => '是否开启客服按钮',
            'default' => true,
            'dependency' => array('is_sidebar_childripro_float', '==', 'true'),
        ),
        array(
            'id' => 'sidebar_childripro_kefu_info',
            'type' => 'fieldset',
            'title' => '客服设置（开启客服按钮后生效）',
            'fields' => array(
                array(
                    'type' => 'notice',
                    'style' => 'success',
                    'content' => 'QQ群官网申请群地址 <a target="_blank" href="https://qun.qq.com/join.html">立即申请</a><br><b>选择 网页代码 获取&lt;a target="_blank" href="//shang.qq.com/wpa/qunwpa?idkey=<font color="red">******************</font>"&gt; "中<font color="red">idkey</font>的内容</b>',
                ),
                array(
                    'id' => 'qq_kfqun',
                    'type' => 'text',
                    'title' => '右侧客服-官方QQ群',
                    'desc' => '输入您的QQ群地址，不设置则不显示。',
                ),
                array(
                    'id' => 'float_faq_url',
                    'type' => 'text',
                    'title' => '右侧客服-常见问题FAQ链接地址',
                    'desc' => '输入您要链接到的文章地址，不设置则不显示',
                ),
                array(
                    'id' => 'qq_kefu',
                    'type' => 'text',
                    'title' => '右侧客服-客服QQ按钮',
                    'desc' => '输入您的QQ，不设置则不显示',
                    'default' => '',
                ),
                array(
                    'id' => 'qq_kefu_desc',
                    'type' => 'text',
                    'title' => '右侧客服-文字说明',
                    'desc' => '设置您的文字说明，不设置则不显示',
                    'default' => '直接说出您的需求！<br>切记！带上资源连接与问题！',
                ),
                array(
                    'id' => 'qq_kefu_works_time',
                    'type' => 'text',
                    'title' => '右侧客服-工作时间',
                    'desc' => '设置您的工作时间 推荐格式 0:00-0:00，不设置则不显示',
                    'default' => '9:30-21:30',
                ),
            ),
            'dependency' => array('is_sidebar_childripro_float', '==', 'true'),
        ),
        array(
            'id' => 'update_sidebar_rili_url',
            'type' => 'fieldset',
            'title' => '更新日历链接地址',
            'fields' => array(
                array(
                    'id' => 'update_sidebar_rili_url_info',
                    'type' => 'text',
                    'title' => '右侧浮动-更新日历超链接',
                    'desc' => '输入一个要设置的超链接地址，不设置则不显示',
                    'default' => '/archives',
                ),
            ),
            'dependency' => array('is_sidebar_childripro_float', '==', 'true'),
        ),
        array(
            'id' => 'is_sidebar_childripro_float_blog',
            'type' => 'switcher',
            'title' => '是否显示切换博客模式的按钮',
            'default' => false,
            'dependency' => array('is_sidebar_childripro_float', '==', 'true'),
        ),
        array(
            'id' => 'is_sidebar_childripro_float_dark',
            'type' => 'switcher',
            'title' => '是否显示切换暗黑模式的按钮',
            'default' => false,
            'dependency' => array('is_sidebar_childripro_float', '==', 'true'),
        ),
        array(
            'id' => 'is_sidebar_childripro_float_full',
            'type' => 'switcher',
            'title' => '是否开启全屏按钮',
            'default' => true,
            'dependency' => array('is_sidebar_childripro_float', '==', 'true'),
        ),
        array(
            'id' => 'sidebar_childripro_float_tgzq',
            'type' => 'fieldset',
            'title' => '投稿赚钱链接地址',
            'fields' => array(
                array(
                    'id' => 'sidebar_childripro_float_tgzq_url',
                    'type' => 'text',
                    'title' => '右侧浮动-投稿赚钱超链接',
                    'desc' => '输入一个要设置的超链接地址，不设置则不显示',
                    'default' => '/user?action=write',
                ),
            ),
            'dependency' => array('is_sidebar_childripro_float', '==', 'true'),
        ),
        array(
            'id' => 'is_sidebar_childripro_float_wapqq',
            'type' => 'switcher',
            'title' => '是否开启手机端独立浮动客服',
            'default' => false,
            'desc' => 'QQ号码请在上方的“右侧客服-客服QQ按钮”中设置！<br><font color="red">注意和下面的“手机端全站浮动样式”只能选择一种保留</font>',
            'dependency' => array('is_sidebar_childripro_float', '==', 'true'),
        ),
        array(
            'id' => 'is_sidebar_childripro_float_wap1',
            'type' => 'switcher',
            'title' => '是否开启手机端全站底部浮动样式（Ⅰ）',
            'default' => true,
            'desc' => 'QQ号码请在上方的“右侧客服-客服QQ按钮”中设置！',
            'dependency' => array('is_sidebar_childripro_float', '==', 'true'),
        ),
    ),
));

//
// 首页-底部样式设置
//
CSF::createSection($prefix, array(
    'parent' => 'child_home_fields',
    'title' => '——主题底部设置',
    'icon' => 'fa fa-home',
    'description' => '子主题底部设置',
    'fields' => array(
        array(
            'id' => 'is_footer_wave',
            'type' => 'switcher',
            'title' => '是否开启全局底部波浪',
            'default' => true,
        ),
        array(
            'id' => 'is_footer_links',
            'type' => 'switcher',
            'title' => '是否开启全局底部友链',
            'default' => true,
        ),
        array(
            'id' => 'is_footer_autonomy_links',
            'type' => 'switcher',
            'title' => '是否开启自助申请友情链接',
            'default' => true,
        ),
        array(
            'id' => 'footer_autonomy_links_info',
            'type' => 'fieldset',
            'title' => '友链设置',
            'fields' => array(
                array(
                    'type' => 'notice',
                    'style' => 'success',
                    'content' => '请手动新建页面并选择模板为"自助申请友链"',
                ),
                array(
                    'id' => '_href',
                    'type' => 'text',
                    'title' => '页面地址',
                    'placeholder' => 'http://',
                    'default' => '/applylinks',
                ),
            ),
            'dependency' => array('is_footer_autonomy_links', '==', 'true'),
        ),
        array(
            'id' => 'is_footer_youshe',
            'type' => 'switcher',
            'title' => '是否开启仿优设底部',
            'default' => true,
        ),
        array(
            'id' => 'footer_youshe_info',
            'type' => 'fieldset',
            'title' => '仿优设底部样式设置',
            'fields' => array(
                array(
                    'id' => '_title',
                    'type' => 'text',
                    'title' => '大标题设置',
                    'default' => '「源码园」 www.ymkuzhan.com',
                ),
                array(
                    'id' => '_desc',
                    'type' => 'text',
                    'title' => '标题下方文字介绍',
                    'default' => '国内极具人气的网络源码资源交流学习平台</br>下载源码文章，学软件教程，找灵感素材，尽在「源码园」',
                ),
                array(
                    'id' => '_img',
                    'type' => 'upload',
                    'title' => '中间图片',
                    'library' => 'image',
                    'placeholder' => 'http://',
                    'default' => get_stylesheet_directory_uri() . '/assets/images/robot.png',
                ),
                array(
                    'type' => 'notice',
                    'style' => 'success',
                    'content' => '建议图片大小为 354 x 427 像素',
                ),
                array(
                    'id' => '_right_font_up',
                    'type' => 'text',
                    'title' => '右侧文字（上）',
                    'default' => '「源码园」 www.ymkuzhan.com',
                ),
                array(
                    'id' => '_right_font_lower',
                    'type' => 'text',
                    'title' => '右侧文字（下）',
                    'default' => 'http://www.ymkuzhan.com',
                ),
                array(
                    'id' => '_color',
                    'type' => 'color',
                    'title' => '背景颜色',
                    'default' => '#2096f3',
                ),
            ),
            'dependency' => array('is_footer_youshe', '==', 'true'),
        ),
        array(
            'id' => 'is_footer_search_bottom',
            'type' => 'switcher',
            'title' => '是否开启搜索框底部图标',
            'default' => true,
        ),
        array(
            'id' => 'footer_search_bottom_info',
            'type' => 'group',
            'title' => '底部搜索框底部图标',
            'fields' => array(
                array(
                    'id' => '_title',
                    'type' => 'text',
                    'title' => '标题',
                    'default' => '',
                ),
                array(
                    'id' => '_img',
                    'type' => 'upload',
                    'title' => '图标',
                    'library' => 'image',
                    'placeholder' => 'http://',
                    'default' => '',
                ),
            ),
            'default' => array(
                0 => array(
                    '_title' => 'wordpress',
                    '_img' => get_stylesheet_directory_uri() . '/assets/images/svg/wordpress.svg'
                ),
                1 => array(
                    '_title' => '腾讯云',
                    '_img' => get_stylesheet_directory_uri() . '/assets/images/svg/teng.svg'
                ),
                2 => array(
                    '_title' => '阿里云',
                    '_img' => get_stylesheet_directory_uri() . '/assets/images/svg/ali.svg'
                ),
                3 => array(
                    '_title' => '微信支付',
                    '_img' => get_stylesheet_directory_uri() . '/assets/images/svg/weixinpay.svg'
                ),
                4 => array(
                    '_title' => '支付宝',
                    '_img' => get_stylesheet_directory_uri() . '/assets/images/svg/alipay.svg'
                )
            ),
            'dependency' => array('is_footer_search_bottom', '==', 'true'),
        ),
        array(
            'id' => 'is_footer_youshe_statistics',
            'type' => 'switcher',
            'title' => '是否开启全局底部统计',
            'default' => true,
        ),
        array(
            'id' => 'web_start_date',
            'type' => 'date',
            'title' => '建站时间',
            'desc' => '用于统计本站运营时间',
            'default' => '01/01/2018',
            'dependency' => array('is_footer_youshe_statistics', '==', 'true'),
        ),
        array(
            'id' => 'web_resource_size',
            'type' => 'text',
            'title' => '资源大小(GB)',
            'desc' => '',
            'default' => '1000',
            'dependency' => array('is_footer_youshe_statistics', '==', 'true'),
        ),
        array(
            'id' => 'footer_youshe_statistics_info',
            'type' => 'fieldset',
            'title' => 'banner背景图块',
            'fields' => array(
                array(
                    'id' => '_img',
                    'type' => 'upload',
                    'title' => '背景图',
                    'library' => 'image',
                    'placeholder' => 'http://',
                    'default' => get_stylesheet_directory_uri() . '/assets/images/youshe_bg.jpg',
                ),
                array(
                    'id' => '_btn',
                    'type' => 'text',
                    'title' => '按钮1名称',
                    'default' => '加入VIP获取全站资源',
                ),
                array(
                    'id' => '_btn_url',
                    'type' => 'text',
                    'title' => '按钮1链接',
                    'placeholder' => 'http://',
                    'default' => 'http://www.ymkuzhan.com',
                ),
            ),
            'dependency' => array('is_footer_youshe', '==', 'true'),
        ),
        array(
            'id' => 'footer_state_text',
            'type' => 'textarea',
            'title' => '底部声明文字内容',
            'desc' => '自定义文字声明，内容为空则不显示',
            'default' => '源码园(www.ymkuzhan.com)是一家专门做精品素材的网站，以“共享创造价值”为理念，以“尊重原创”为准则。',
        ),
    ),
));

//
// 全局-广告设置
//
CSF::createSection($prefix, array(
    'parent' => 'child_home_fields',
    'title' => '——主题广告设置',
    'icon' => 'fa fa-home',
    'description' => '子主题新增广告设置，父主题广告设置不受影响',
    'fields' => array(
        array(
            'id' => 'is_child_tab_adv_top',
            'type' => 'switcher',
            'title' => '选项切换模块-顶部广告',
            'default' => false,
        ),
        array(
            'id' => 'child_tab_adv_top',
            'type' => 'fieldset',
            'title' => '广告代码',
            'fields' => array(
                array(
                    'id' => '_adv',
                    'type' => 'code_editor',
                    'title' => '',
                    'default' => '<a href="https://www.ymkuzhan.com/" target="_blank"><img src="' . get_stylesheet_directory_uri() . '/assets/images/child-ads.gif" style=" width: 100%; margin: 20px 0; text-align: center; "></a>',
                    'sanitize' => false,
                )
            ),
            'dependency' => array('is_child_tab_adv_top', '==', 'true'),
        ),
        array(
            'id' => 'is_child_tab_adv_lower',
            'type' => 'switcher',
            'title' => '选项切换模块-底部广告',
            'default' => false,
        ),
        array(
            'id' => 'child_tab_adv_lower',
            'type' => 'fieldset',
            'title' => '广告代码',
            'fields' => array(
                array(
                    'id' => '_adv',
                    'type' => 'code_editor',
                    'title' => '',
                    'default' => '<a href="https://www.ymkuzhan.com/" target="_blank"><img src="' . get_stylesheet_directory_uri() . '/assets/images/child-ads.gif" style=" width: 100%; margin: 20px 0; text-align: center; "></a>',
                    'sanitize' => false,
                )
            ),
            'dependency' => array('is_child_tab_adv_lower', '==', 'true'),
        ),
        array(
            'id' => 'is_child_article_adv_top',
            'type' => 'switcher',
            'title' => '内页文章介绍-顶部广告',
            'default' => false,
        ),
        array(
            'id' => 'child_article_adv_top',
            'type' => 'fieldset',
            'title' => '广告代码',
            'fields' => array(
                array(
                    'id' => '_adv',
                    'type' => 'code_editor',
                    'title' => '',
                    'default' => '<a href="https://www.ymkuzhan.com/" target="_blank"><img src="' . get_stylesheet_directory_uri() . '/assets/images/child-ads.gif" style=" width: 100%; margin: 20px 0; text-align: center; "></a>',
                    'sanitize' => false,
                )
            ),
            'dependency' => array('is_child_article_adv_top', '==', 'true'),
        ),
        array(
            'id' => 'is_child_article_adv_lower',
            'type' => 'switcher',
            'title' => '内页文章介绍-底部广告',
            'default' => false,
        ),
        array(
            'id' => 'child_article_adv_lower',
            'type' => 'fieldset',
            'title' => '广告代码',
            'fields' => array(
                array(
                    'id' => '_adv',
                    'type' => 'code_editor',
                    'title' => '',
                    'default' => '<a href="https://www.ymkuzhan.com/" target="_blank"><img src="' . get_stylesheet_directory_uri() . '/assets/images/child-ads.gif" style=" width: 100%; margin: 20px 0; text-align: center; "></a>',
                    'sanitize' => false,
                )
            ),
            'dependency' => array('is_child_article_adv_lower', '==', 'true'),
        ),
    ),
));


//
// 全局-更多设置
//
CSF::createSection($prefix, array(
    'parent' => 'child_home_fields',
    'title' => '——全站更多设置',
    'icon' => 'fa fa-home',
    'description' => '全站更多设置',
    'fields' => array(
        array(
            'id' => 'is_more_navbar_top',
            'type' => 'switcher',
            'title' => '是否显示顶部黑条',
            'default' => false,
        ),
        array(
            'id' => 'is_more_frosted_glass',
            'type' => 'switcher',
            'title' => '是否开启导航毛玻璃特效',
            'default' => false,
        ),
        array(
            'id' => 'is_more_logo_streamer',
            'type' => 'switcher',
            'title' => '是否显示LOGO流光特效',
            'default' => false,
        ),
        array(
            'id' => 'is_more_login_dropdown',
            'type' => 'switcher',
            'title' => '是否显示登陆下拉',
            'default' => true,
        ),
        array(
            'id' => 'more_login_dropdown_info',
            'type' => 'fieldset',
            'title' => '登陆下拉-文字设置',
            'fields' => array(
                array(
                    'id' => 'more_login_dropdown_info_list',
                    'type' => 'group',
                    'fields' => array(
                        array(
                            'id' => '_title',
                            'type' => 'text',
                            'title' => '下拉内容',
                            'default' => '会员折扣下载',
                        )
                    ),
                    'default' => array(
                        0 => array(
                            '_title' => '会员折扣下载',
                        )
                    ),
                )
            ),
            'dependency' => array('is_more_login_dropdown', '==', 'true'),
        ),
        array(
            'id' => 'more_goopen_vip_red',
            'type' => 'text',
            'title' => '立即开通上面红色标语',
            'desc' => '输入一个要设置的文字内容，不超过7个字，不设置则不显示',
            'default' => '开通会员抄底价',
        ),
        array(
            'id' => 'is_more_vip_icon',
            'type' => 'switcher',
            'title' => '是否显示资源文章角标',
            'default' => false,
        ),
        array(
            'id' => 'is_more_loginbottom_column',
            'type' => 'switcher',
            'title' => '是否显示页面底部登陆栏',
            'default' => true,
        ),
        array(
            'id' => 'more_loginbottom_column_info',
            'type' => 'fieldset',
            'title' => '页面底部登陆栏设置',
            'fields' => array(
                array(
                    'id' => '_tag',
                    'type' => 'text',
                    'title' => '关键词',
                    'default' => '开通VIP',
                ),
                array(
                    'id' => '_tag_href',
                    'type' => 'text',
                    'title' => '关键词跳转',
                    'default' => '#',
                ),
                array(
                    'id' => '_title',
                    'type' => 'text',
                    'title' => '标题',
                    'default' => '享更多特权，建议使用QQ登录',
                )
            ),
            'dependency' => array('is_more_loginbottom_column', '==', 'true'),
        ),
        array(
            'id' => 'is_activity_float_info',
            'type' => 'switcher',
            'title' => '是否显示活动消息悬浮',
            'default' => true,
        ),
        array(
            'id' => 'activity_float_info',
            'type' => 'fieldset',
            'title' => '促销活动',
            'fields' => array(
                array(
                    'id' => '_img',
                    'type' => 'upload',
                    'title' => '促销图片',
                    'default' => get_stylesheet_directory_uri() . '/assets/images/left-float.png',
                ),
                array(
                    'id' => '_href',
                    'type' => 'text',
                    'title' => '跳转地址',
                    'default' => '/index.php/svip',
                ),
            ),
            'dependency' => array('is_activity_float_info', '==', 'true'),
        ),
        array(
            'id' => 'is_more_down_barrage',
            'type' => 'switcher',
            'title' => '是否开启下载弹幕',
            'default' => false,
        ),
        array(
            'id' => 'is_more_article_wave',
            'type' => 'switcher',
            'title' => '是否开启内页波浪',
            'desc' => '栏目列表页/标签内页',
            'default' => false,
        ),
    ),
));