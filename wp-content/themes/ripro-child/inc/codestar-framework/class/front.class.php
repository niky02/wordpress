<?php
new downLoadFront();

/**
 * @package    WPMES
 * @author     WPMES
 */
class downLoadFront
{

    public $post_id = 0;

    public function __construct()
    {
        add_action('wp_head', array($this, 'wp_head_dl'), 70);
        add_action('wp_footer', array($this, 'wp_foot_dl'), 70);
    }

    public function wp_head_dl()
    {
        $post_id = get_the_ID();
        if (is_single()) {
            echo "<link rel='stylesheet' id='wbs-style-dlipp-css'  href='" . get_stylesheet_directory_uri() . "/assets/css/riprodl.css' type='text/css' media='all' />";
            echo "<link rel='stylesheet' id='aliicon'  href='//at.alicdn.com/t/font_839916_ncuu4bimmbp.css?ver=5.4-alpha-46770' type='text/css' media='all' />";
            echo "<link rel='stylesheet' id='wbs-style-dlipp-css'  href='" . get_stylesheet_directory_uri() . "/assets/css/prism.css' type='text/css' media='all' />";
        }
    }

    public function wp_foot_dl()
    {
        $post_id = get_the_ID();
        if (is_single()) {
            echo "<script type='text/javascript' src='https://cdn.staticfile.org/twitter-bootstrap/4.4.1/js/bootstrap.min.js'></script>";
            echo "<script type='text/javascript' src='" . get_stylesheet_directory_uri() . "/assets/js/riprodl.js'></script>";
            echo "<script type='text/javascript' src='" . get_stylesheet_directory_uri() . "/assets/js/prism.js'></script>";

        }
    }
}


