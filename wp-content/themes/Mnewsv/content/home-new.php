<?php global $salong; ?>

<section class="content" id="scroll">
    <section class="content_left">
        <!--标题-->
        <section class="home_title">
            <section class="title">
                <h3><?php echo $salong['home_new_title']; ?></h3>
                <?php if(get_today_post_count() && $salong['switch_today_post_count']){ ?>
                <span><?php echo sprintf(__('今日更新<b>%s</b>篇','salong'),get_today_post_count()); ?></span>
                <?php } ?>
            </section>
            <section class="button">
                <a href="<?php echo get_page_link(get_page_id_from_template('template-post.php')); ?>" title="<?php _e( '查看更多', 'salong' ); ?>" <?php echo new_open_link(); ?>><?php echo _e('更多','salong').svg_more(); ?></a>
            </section>
        </section>
        <!--标题end-->
        <ul class="ajaxposts">
            <?php $paged=( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;$args=array( 'post_type'=> 'post','ignore_sticky_posts' => 1,'category__not_in'=> $salong[ 'exclude_new_cat'],'paged' => $paged );$temp_wp_query = $wp_query;$wp_query = null;$wp_query = new WP_Query( $args );if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();?>
            <li class="ajaxpost">
                <?php get_template_part( 'content/list', 'post'); ?>
            </li>
            <?php endwhile;endif; ?>
            <!-- 分页 -->
            <?php posts_pagination(); ?>
            <?php wp_reset_query(); $wp_query=null; $wp_query=$temp_wp_query;?>
        </ul>
    </section>
    <!--边栏-->
    <?php salong_sidebar(1); ?>
</section>
