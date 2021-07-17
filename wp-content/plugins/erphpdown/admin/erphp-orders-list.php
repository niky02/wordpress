<?php
if ( !defined('ABSPATH') ) {exit;}
if(!is_user_logged_in())
{
	exit;
}
//统计数据
$total_trade   = $wpdb->get_var("SELECT COUNT(ice_id) FROM $wpdb->icealipay WHERE ice_success>0");
$total_money   = $wpdb->get_var("SELECT SUM(ice_price) FROM $wpdb->icealipay WHERE ice_success>0");

//分页计算
/////////////////////////////////////////////////www.mobantu.com   82708210@qq.com
$ice_perpage = 20;
$pages = ceil($total_trade / $ice_perpage);
$page=isset($_GET['paged']) ?intval($_GET['paged']) :1;
$offset = $ice_perpage*($page-1);
$list = $wpdb->get_results("SELECT * FROM $wpdb->icealipay where ice_success=1 order by ice_time DESC limit $offset,$ice_perpage");
?>
<div class="wrap">
	<h2>所有订单统计</h2>
	<p><?php printf(('共<strong>%s</strong>.'), $total_money); ?></p>
	<table class="wp-list-table widefat fixed striped posts">
		<thead>
			<tr>
				<th width="8%">用户ID</th>
				<th width="8%">订单号</th>
				<th width="25%">商品名称</th>
				<th width="5%">价格</th>
				<th width="15%">交易时间</th>	
			</tr>
		</thead>
		<tbody>
			<?php
			if($list) {
				foreach($list as $value)
				{
					echo "<tr>\n";
					echo "<td>".get_the_author_meta( 'user_login', $value->ice_user_id )."</td>";
					echo "<td>$value->ice_num</td>";
					echo "<td><a target=_blank href='".get_permalink($value->ice_post)."'>$value->ice_title</a></td>\n";
					echo "<td>$value->ice_price</td>\n";
					echo "<td>$value->ice_time</td>\n";
					echo "</tr>";
				}
			}
			else
			{
				echo '<tr><td colspan="5" align="center"><strong>没有交易记录</strong></td></tr>';
			}
			?>
		</tbody>
	</table>
	<?php echo erphp_admin_pagenavi($total_trade,$ice_perpage);?>

</div>
