<div class="cao_entry_header">
<?php edit_post_link('[编辑]'); ?>
<?php
  if ( ! is_page() ) {
  	cao_entry_header( [
  		'tag' => 'h1',
  		'link' => false,
  		'category' => true,
  		'date' => true,
  		'author' => true,
  	]);
  } else {
  	cao_entry_header( [
  		'tag' => 'h1',
  		'link' => false,
  		'category' => true,
  		'date' => true,
  		'author' => true,
  	]);
  }
  get_template_part( 'parts/entry-subheading' );
?>
</div>