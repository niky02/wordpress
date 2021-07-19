<?php global $salong,$post;
if($salong['switch_new_open_link']){
    $new_open_link = 'target="_blank"';
}
$taxonomy = get_post_taxonomies();
$tag_name = $taxonomy['1'];
?>
<section class="tag_share">
    <!-- 关键词 -->
    <div class="tags">
        <?php
        $tags = get_the_terms( $post->ID, $taxonomy[1]);
        if(!empty($tags)){
            echo svg_tag();
            foreach($tags as $tag){
                echo '<a href="'.get_tag_link($tag).'" title="'.$tag->name.'" '.$new_open_link.'>'.$tag->name.'('.$tag->count.')</a>';
            }
        }
        ?>
    </div>
    <!--分享-->
    <?php get_template_part( 'content/share', 'btn'); ?>
</section>