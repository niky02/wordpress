<?php
/*
mobantu.com
qq 82708210
*/
if ( !defined('ABSPATH') ) {exit;}
add_action( 'admin_menu', 'ice_create_down_box' );
add_action( 'save_post', 'ice_save_down_data' );
function ice_create_down_box() {
	$erphp_post_types = get_option('erphp_post_types');
	$args = array(
		'public'   => true,
	);
	$post_types = get_post_types($args);
	foreach ( $post_types  as $post_type ) {
		if($erphp_post_types){
			if(in_array($post_type,$erphp_post_types)) add_meta_box( 'erphpdown-postmeta-box','ErphpDown属性', 'ice_post_erphpdown_info', $post_type, 'normal', 'high' );
		}
	}
	
}
function ice_down_post_boxes() {
	$meta_boxes = array(
		array(
			"name"             => "start_down",
			"title"            => "收费类型",
			"desc"             => "",
			"type"             => "erphpcheckbox",
			"capability"       => "manage_options"
		),
		array(
			"name"             => "member_down",
			"title"            => "VIP模式",
			"desc"             => "（说明：VIP专享指只有VIP用户可下载或查看，普通用户无权购买下载或查看，此类型不需要设置价格）",
			"type"             => "radio",
			'options' => array(
				'1' => '原价',
	            '4' => 'VIP专享',
	            '3' => 'VIP免费',
	            '2' => 'VIP5折',
	            '5' => 'VIP8折',
	            '6' => '年费VIP免费',
	            '7' => '终身VIP免费'
	        ),
	        'default' => '1',
			"capability"       => "manage_options"
		),
		array(
			"name"             => "down_price",
			"title"            => "收费价格",
			"desc"             => "（说明：为空或者为0则免费下载。除了VIP专享，其他VIP模式均需要设置价格，否则视为免费）",
			"type"             => "number",
			"capability"       => "manage_options"
		),
		array(
			"name"             => "down_url",
			"title"            => "下载地址",
			"desc"             => "（收费查看类型不用填写。说明：一行一个，可以支持多个地址，可外链以及内链。地址格式可为以下任意一种：<br>/wp-content/uploads/moban-tu.zip<br>https://pan.baidu.com/test<br>百度网盘,https://pan.baidu.com/test,提取码：2587<br>百度网盘,https://pan.baidu.com/test<br>需要说明的是，3与4格式用英文半角逗号隔开，名称,下载地址,提取码或解压密码）",
			"type"             => "textarea",
			"capability"       => "manage_options"
		),
		array(
			"name"             => "hidden_content",
			"title"            => "隐藏内容",
			"desc"             => "（选填。说明：纯文本内容，一般填提取码或者解压密码。）",
			"type"             => "text",
			"capability"       => "manage_options"
		),
		array(
			"name"             => "down_days",
			"title"            => "过期天数",
			"desc"             => "（选填。说明：留空则表示一次购买永久下载，设置一个数字比如30，则表示购买30天后得重新购买）",
			"type"             => "number",
			"capability"       => "manage_options"
		),
		array(
			"name"             => "down_recommend",
			"title"            => "推荐",
			"desc"             => "（选填。说明：字段名为down_recommend，推荐表示其值为1）<br><br /><span style='float:right;font-size:12px'>技术支持：mobantu.com</span>",
			"type"             => "checkbox",
			"capability"       => "manage_options"
		),
	);
	return apply_filters( 'ali_post_boxes', $meta_boxes );
}
function ice_post_erphpdown_info() {
	global $post;
	$meta_boxes = ice_down_post_boxes(); 
	?>
	<table class="form-table">
		<?php 
		foreach ( $meta_boxes as $meta ) :
			$value = get_post_meta( $post->ID, $meta['name'], true );
			if ( $meta['type'] == 'text' )
				ice_show_text_input( $meta, $value );
			elseif ( $meta['type'] == 'number' )
				ice_show_number_input( $meta, $value );
			elseif ( $meta['type'] == 'textarea' )
				ice_show_textarea( $meta, $value );
			elseif ( $meta['type'] == 'checkbox' )
				ice_show_checkbox( $meta, $value );
			elseif ( $meta['type'] == 'erphpcheckbox' )
				ice_show_erphpcheckbox( $meta, $value );
			elseif ($meta['type'] == 'radio')
				erphpdown_show_radio( $meta, $value );
		endforeach; 
		?>
	</table>
	<?php
}

function erphpdown_show_radio( $args = array(), $value = false ) {
	extract( $args ); ?>
	<tr>
		<th style="width:10%;">
			<label for="<?php echo $name; ?>"><?php echo $title; ?></label>
		</th>
		<td>
			<?php
				$i=1;
	            foreach ($options as $key => $option) {
	            	if(!$value) $value=$default;
	                echo '<input type="radio" name="'.$name.'" id="'.$name.$i.'" value="'. esc_attr( $key ) . '" '. checked( $value, $key, false) .' /><label for="'.$name.$i.'">' . esc_html( $option ) . '</label>&nbsp;&nbsp;&nbsp;&nbsp;';
	                $i ++;
	            }
            ?>
			<input type="hidden" name="<?php echo $name; ?>_input_name" id="<?php echo $name; ?>_input_name" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
			<br />
			<p class="description"><?php echo $desc; ?></p>
		</td>
	</tr>
	<?php
}


function ice_show_text_input( $args = array(), $value = false ) {
	extract( $args ); ?>
	<tr>
		<th style="width:10%;">
			<label for="<?php echo $name; ?>"><?php echo $title; ?></label>
		</th>
		<td>
			<input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php echo esc_html( $value, 1 ); ?>" style="width: 90%;max-width: 600px;" />
			<input type="hidden" name="<?php echo $name; ?>_input_name" id="<?php echo $name; ?>_input_name" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
			<br />
			<p class="description"><?php echo $desc; ?></p>
		</td>
	</tr>
	<?php
}
function ice_show_number_input( $args = array(), $value = false ) {
	extract( $args ); ?>
	<tr>
		<th style="width:10%;">
			<label for="<?php echo $name; ?>"><?php echo $title; ?></label>
		</th>
		<td>
			<input type="number" min="0" step="0.01" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php echo esc_html( $value, 1 ); ?>" style="width: 100px;" />
			<input type="hidden" name="<?php echo $name; ?>_input_name" id="<?php echo $name; ?>_input_name" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
			<br />
			<p class="description"><?php echo $desc; ?></p>
		</td>
	</tr>
	<?php
}
function ice_show_textarea( $args = array(), $value = false ) {
	extract( $args ); ?>
	<tr>
		<th style="width:10%;">
			<label for="<?php echo $name; ?>"><?php echo $title; ?></label>
		</th>
		<td>
			<textarea name="<?php echo $name; ?>" id="<?php echo $name; ?>" cols="60" rows="4" tabindex="30" style="width: 97%;"><?php echo esc_html( $value, 1 ); ?></textarea>
			<input type="hidden" name="<?php echo $name; ?>_input_name" id="<?php echo $name; ?>_input_name" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
			<br />
			<p class="description"><?php echo $desc; ?></p>		</td>
		</tr>
		<?php
	}
	function ice_show_checkbox( $args = array(), $value = false ) {
		extract( $args ); ?>
		<tr>
		<th style="width:10%;">
			<label for="<?php echo $name; ?>"><?php echo $title; ?></label>		</th>
			<td>
				<input type="checkbox" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="1"
				<?php if ( htmlentities( $value, 1 ) == '1' ) echo ' checked="checked"'; ?>
				style="width: auto;" />&nbsp;启用<?php echo $title; ?>
				<input type="hidden" name="<?php echo $name; ?>_input_name" id="<?php echo $name; ?>_input_name" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
				<p class="description"><?php echo $desc; ?></p>

			</td>
		</tr>
	<?php }
	function ice_show_erphpcheckbox( $args = array(), $value = false ) {
		extract( $args ); ?>
		<tr>
			<th style="width:10%;">
				<label for="<?php echo $name; ?>"><?php echo $title; ?></label>		
			</th>
			<td>
				<?php 
				global $post;
				$value1 = get_post_meta( $post->ID, 'start_down', true );
				$value2 = get_post_meta( $post->ID, 'start_see', true );
				$value3 = get_post_meta( $post->ID, 'start_see2', true );
				$value5 = get_post_meta( $post->ID, 'start_down2', true );
				?>
				<input type="radio" name="start_down" checked value="4" />不启用&nbsp;
				<input type="radio" name="start_down" <?php if($value1 == 'yes') echo 'checked'?> value="1" />下载 &nbsp;
				<input type="radio" name="start_down" <?php if($value5 == 'yes') echo 'checked'?> value="5" />免登录下载 &nbsp;
				<?php if(!erphp_check_mobantu_theme()){?>
				<input type="radio" name="start_down" <?php if($value2 == 'yes') echo 'checked'?> value="2" />查看全部 &nbsp;
				<input type="radio" name="start_down" <?php if($value3 == 'yes') echo 'checked'?> value="3" />查看部分（短代码 [erphpdown]隐藏内容[/erphpdown]）&nbsp;
				<?php }?>

				<input type="hidden" name="erphpdown" value="1">
				<input type="hidden" name="start_down_input_name" id="start_down_input_name" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
				<input type="hidden" name="start_down2_input_name" id="start_down2_input_name" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
				<?php if(!erphp_check_mobantu_theme()){?>
				<input type="hidden" name="start_see_input_name" id="start_see_input_name" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
				<input type="hidden" name="start_see2_input_name" id="start_see2_input_name" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
				<?php }?>
				<p class="description"><?php echo $desc; ?></p>

			</td>
		</tr>
	<?php }
	function ice_save_down_data( $post_id ) {

		$meta_boxes = array_merge( ice_down_post_boxes() );
		foreach ( $meta_boxes as $meta_box ) :
			if($meta_box['type'] == 'erphpcheckbox'){

				if ( !wp_verify_nonce( $_POST['start_down_input_name'], plugin_basename( __FILE__ ) ) || !wp_verify_nonce( $_POST['start_see_input_name'], plugin_basename( __FILE__ ) ) || !wp_verify_nonce( $_POST['start_see2_input_name'], plugin_basename( __FILE__ ) ) || !wp_verify_nonce( $_POST['start_down2_input_name'], plugin_basename( __FILE__ ) ))
					return $post_id;
				if ( 'page' == $_POST['post_type'] && !current_user_can( 'edit_page', $post_id ) )
					return $post_id;
				elseif ( 'post' == $_POST['post_type'] && !current_user_can( 'edit_post', $post_id ) )
					return $post_id;

				$data = stripslashes( $_POST['start_down'] );
				$data1 = '';$data2='';$data3='';$data5='';
				if($data == '1') $data1 = 'yes';
				if($data == '2') $data2 = 'yes';
				if($data == '3') $data3 = 'yes';
				if($data == '5') $data5 = 'yes';
				update_post_meta( $post_id, 'start_down', $data1 );
				update_post_meta( $post_id, 'start_see', $data2 );
				update_post_meta( $post_id, 'start_see2', $data3 );
				update_post_meta( $post_id, 'start_down2', $data5 );
			}else{
				if ( !wp_verify_nonce( $_POST[$meta_box['name'] . '_input_name'], plugin_basename( __FILE__ ) ) )
					return $post_id;
				if ( 'page' == $_POST['post_type'] && !current_user_can( 'edit_page', $post_id ) )
					return $post_id;
				elseif ( 'post' == $_POST['post_type'] && !current_user_can( 'edit_post', $post_id ) )
					return $post_id;

				$data = stripslashes( $_POST[$meta_box['name']] );
				if ( get_post_meta( $post_id, $meta_box['name'] ) == '' )
					add_post_meta( $post_id, $meta_box['name'], $data, true );
				elseif ( $data != get_post_meta( $post_id, $meta_box['name'], true ) )
					update_post_meta( $post_id, $meta_box['name'], $data );
				elseif ( $data == '' )
					delete_post_meta( $post_id, $meta_box['name'], get_post_meta( $post_id, $meta_box['name'], true ) );
			}


		endforeach;
	}