<?php global $salong;?>
<div class="share">
    <span><?php _e('分享：','salong'); ?></span>
    <a href="#weixin_qr" title="<?php _e('分享到微信','salong'); ?>" class="weixin"><?php echo svg_wechat(); ?></a>
    <a target="_blank" onClick='window.open("http://service.weibo.com/share/share.php?url=<?php the_permalink() ?>&amp;title=【<?php the_title(); ?>】<?php if (has_excerpt()) { ?><?php echo strip_tags(get_the_excerpt()); ?><?php } else{ echo strip_tags(wp_trim_words(get_the_content(),66)); } ?>&nbsp;@<?php bloginfo('name'); ?>&amp;appkey=<?php echo $salong['weibo_key']; ?>&amp;pic=<?php if(get_post_meta($post->ID, " thumb ", true)) { echo $bd_img; }else if( has_post_thumbnail() ){ echo $timthumb[0]; } else if($n > 1){ echo $strResult[1][0]; } else { echo $default_img; } ?>&amp;searchPic=true")' title="<?php _e('分享到新浪微博','salong'); ?>" class="weibo"><?php echo svg_sina(); ?></a>
    <a target="_blank" onClick='window.open("http://connect.qq.com/widget/shareqq/index.html?url=<?php the_permalink() ?>&title=<?php the_title(); ?>&desc=&summary=<?php if (has_excerpt()) { ?><?php echo wp_trim_words(get_the_excerpt(),116); ?><?php } else{ echo wp_trim_words(get_the_content(),116); } ?>&site=<?php echo bloginfo('name'); ?>")' title="<?php _e('分享到QQ好友','salong'); ?>" class="qq"><?php echo svg_qq(); ?></a>
    <a target="_blank" onClick='window.open("https://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=<?php the_permalink() ?>&title=<?php the_title(); ?>&desc=<?php if (has_excerpt()) { ?><?php echo strip_tags(get_the_excerpt()); ?><?php } else{ echo strip_tags(wp_trim_words(get_the_content(),66)); } ?>&summary=&site=<?php echo get_home_url(); ?>")' title="<?php _e('分享到QQ空间','salong'); ?>" class="qqzone"><?php echo svg_qqzone(); ?></a>
</div>