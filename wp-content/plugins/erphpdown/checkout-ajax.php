<?php
header("Content-type:text/html;character=utf-8");
date_default_timezone_set('Asia/Shanghai');
require_once('../../../wp-config.php');
$error = 0;$msg='';$link='';$jump=0;
if(!is_user_logged_in()){
	$error = 1;$msg='请先登录系统';
}
$postid=isset($_GET['postid']) && is_numeric($_GET['postid']) ?intval($_GET['postid']) :false;
$postid = $wpdb->escape($postid);
if($postid){
	$days=get_post_meta($postid, 'down_days', true);
	$user_info=wp_get_current_user();
	$hasdown_info=$wpdb->get_row("select * from ".$wpdb->icealipay." where ice_post='".$postid."' and ice_success=1 and ice_user_id=".$user_info->ID." order by ice_time desc");
	if($days > 0){
		$lastDownDate = date('Y-m-d H:i:s',strtotime('+'.$days.' day',strtotime($hasdown_info->ice_time)));
		$nowDate = date('Y-m-d H:i:s');
		if(strtotime($nowDate) > strtotime($lastDownDate)){
			$hasdown_info = null;
		}
	}
	if($hasdown_info){
		$error = 1;$msg='请勿重复购买';
	}
	$data=get_post_meta($postid, 'down_url', true);
	$price=get_post_meta($postid, 'down_price', true);
	$memberDown=get_post_meta($postid, 'member_down',TRUE);
	$hidden=get_post_meta($postid, 'hidden_content', true);
	$start_down=get_post_meta($postid, 'start_down', true);
	$start_see=get_post_meta($postid, 'start_see', true);
	$start_see2=get_post_meta($postid, 'start_see2', true);
	if($price==FALSE)
	{
		$error = 1;$msg='商品价格错误';
	}
	
	$okMoney=erphpGetUserOkMoney();
	$userType=getUsreMemberType();
	if($memberDown==4 && $userType==false)
	{
		$error = 1;$msg='您暂无权购买';
	}
	if($userType && $memberDown==2)
	{
		$price=sprintf("%.2f",$price*0.5);
	}
	if($userType && $memberDown==5)
	{
		$price=sprintf("%.2f",$price*0.8);
	}
	if($okMoney >= $price && $okMoney > 0 && $price > 0 && !$error)
	{
		if(erphpSetUserMoneyXiaoFei($price))
		{
			$subject   = get_post($postid)->post_title;
			$postUserId=get_post($postid)->post_author;
			
			if($start_down || $start_see || $start_see2)
			{
				$result=erphpAddDownload($subject, $postid, $price,1, $data, $postUserId);
				if($result)
				{
					$ice_ali_money_author = get_option('ice_ali_money_author');
					if($ice_ali_money_author){
						addUserMoney($postUserId,$price*$ice_ali_money_author/100);
					}else{
						addUserMoney($postUserId,$price);
					}
					$RefMoney=$wpdb->get_row("select * from ".$wpdb->users." where ID=".$user_info->ID);
					if($RefMoney->father_id > 0 && erphpdod() > 0){
						addUserMoney($RefMoney->father_id,$price*get_option('ice_ali_money_ref')*0.01);
					}
					if($start_down)
					{
						$jump = 1;
                        $link = constant("erphpdown") . 'download.php?url=' . $result;
					}
					elseif($start_see || $start_see2)
					{
						$jump = 2;
					}
				}
				else
				{
					$wpdb->query("update $wpdb->iceinfo set ice_get_money=ice_get_money-".$price ." where ice_user_id=".$user_info->ID);
					$error = 1;$msg='系统错误';
				}
			}
		}
		else 
		{
			$error = 1;$msg='系统错误';
		}
	}
	else 
	{
		$error = 1;$msg='余额不足完成此次交易';
	}
}

$arr=array(
    "error"=>$error, 
    "msg"=>$msg,
    "jump"=>$jump,
    "link"=>$link
); 
$jarr=json_encode($arr); 
echo $jarr;