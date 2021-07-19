<?php
//error_reporting(E_ERROR);
require_once('../../../../../../wp-config.php');
header("Content-Type: text/html;charset=utf-8");
date_default_timezone_set('Asia/Shanghai');
require_once "../lib/WxPay.Api.php";
require_once "WxPay.NativePay.php";
//require_once 'log.php';

$price   = isset($_GET['ice_money']) && is_numeric($_GET['ice_money']) ?$_GET['ice_money'] :0;
$price = $wpdb->escape($price);
$erphpdown_min_price    = get_option('erphpdown_min_price');
if($erphpdown_min_price > 0){
	if($price < $erphpdown_min_price){
		wp_die('您最低需充值'.$erphpdown_min_price.'元');
	}
}
if($price && is_user_logged_in()){

	global $wpdb;
	$subject = get_bloginfo('name').'充值订单['.get_the_author_meta( 'user_login', wp_get_current_user()->ID ).']';  
	$out_trade_no = date("ymdhis").mt_rand(100,999).mt_rand(100,999).mt_rand(100,999);	
	$time = date('Y-m-d H:i:s');
	if(!empty($price)){
		$user_Info   = wp_get_current_user();
		$sql="INSERT INTO $wpdb->icemoney (ice_money,ice_num,ice_user_id,ice_time,ice_success,ice_note,ice_success_time,ice_alipay)
		VALUES ('$price','$out_trade_no','".$user_Info->ID."','".date("Y-m-d H:i:s")."',0,'0','".date("Y-m-d H:i:s")."','')";
		$a=$wpdb->query($sql);
		if(!$a){
			wp_die('系统发生错误，请稍后重试!');
		}else{
			$money_info=$wpdb->get_row("select * from ".$wpdb->icemoney." where ice_num='".$out_trade_no."'");
		}
	}else{
		wp_die('请输入您要充值的金额');
	}


	//模式一
	/**
	 * 流程：
	 * 1、组装包含支付信息的url，生成二维码
	 * 2、用户扫描二维码，进行支付
	 * 3、确定支付之后，微信服务器会回调预先配置的回调地址，在【微信开放平台-微信支付-支付配置】中进行配置
	 * 4、在接到回调通知之后，用户进行统一下单支付，并返回支付信息以完成支付（见：native_notify.php）
	 * 5、支付完成之后，微信服务器会通知支付成功
	 * 6、在支付成功通知中需要查单确认是否真正支付成功（见：notify.php）
	 */
	$notify = new NativePay();
	//$url1 = $notify->GetPrePayUrl($out_trade_no);
	
	//模式二
	/**
	 * 流程：
	 * 1、调用统一下单，取得code_url，生成二维码
	 * 2、用户扫描二维码，进行支付
	 * 3、支付完成之后，微信服务器会通知支付成功
	 * 4、在支付成功通知中需要查单确认是否真正支付成功（见：notify.php）
	 */
	$input = new WxPayUnifiedOrder();
	$input->SetBody($subject);
	$input->SetAttach("ERPHP");
	$input->SetOut_trade_no($out_trade_no);
	$input->SetTotal_fee($price*100);
	$input->SetTime_start(date("YmdHis"));
	//$input->SetTime_expire(date("YmdHis", time() + 600));
	$input->SetGoods_tag("MBT");
	$input->SetNotify_url(constant("erphpdown").'payment/weixin/example/notify.php');
	$input->SetTrade_type("NATIVE");
	$input->SetProduct_id($out_trade_no);
	$result = $notify->GetPayUrl($input);
	$url2 = $result["code_url"];
?>

<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1" /> 
    <title>微信支付</title>
</head>
<body style="background:#333 url(<?php echo constant("erphpdown");?>static/images/wxbg.png) top center; text-align:center; width:100%; margin:auto;">
	<div style="width:250px; margin:25px auto auto auto; text-align:center; background:#DDD; padding:20px 20px 40px 20px;border-radius: 6px; ">
    <h1 style="font-size:20px; line-height:50px; font-family:'Microsoft YaHei'; font-weight:normal; border-bottom:1px dotted #666; color: #333">微信扫码支付 <b style="color:#F00"><?php echo $price?></b> 元</h1>
	<img alt="扫码支付" src="<?php echo constant("erphpdown");?>payment/weixin/example/qrcode.php?data=<?php echo urlencode($url2);?>" style="width:200px;height:200px;"/>
    <p>支付完成后请等待5秒左右</p>
    </div>
    <script src="<?php echo ERPHPDOWN_URL;?>/static/jquery-1.7.min.js"></script>
	<script>
		setOrder = setInterval(function() {
			$.ajax({  
	            type: 'POST',  
	            url: '<?php echo ERPHPDOWN_URL;?>/admin/action/order.php',  
	            data: {
	            	do: 'checkOrder',
	            	order: '<?php echo $money_info->ice_id;?>'
	            },  
	            dataType: 'text',
	            success: function(data){  
	                if( $.trim(data) == '1' ){
	                    clearInterval(setOrder);
	                    alert('充值成功！');
	                    <?php if(get_option('erphp_url_front_success')){?>
	                    location.href="<?php echo get_option('erphp_url_front_success');?>";
	                    <?php }else{?>
	                    window.close();
	                	<?php }?>
	                }  
	            },
	            error: function(XMLHttpRequest, textStatus, errorThrown){
	            	//alert(errorThrown);
	            }
	        });

		}, 5000);
	</script>
</body>
</html>

<?php }?>