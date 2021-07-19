<?php
/**
author: www.mobantu.com
QQ: 82708210
email: 82708210@qq.com
*/
if ( !defined('ABSPATH') ) {exit;}
function erphpdown_content_show($content){
	$content2 = $content;
	$start_down=get_post_meta(get_the_ID(), 'start_down', true);
	$start_down2=get_post_meta(get_the_ID(), 'start_down2', true);
	$start_see=get_post_meta(get_the_ID(), 'start_see', true);
	$start_see2=get_post_meta(get_the_ID(), 'start_see2', true);

	if(is_singular()){
		$days=get_post_meta(get_the_ID(), 'down_days', true);
		$price=get_post_meta(get_the_ID(), 'down_price', true);
		$url=get_post_meta(get_the_ID(), 'down_url', true);
		$memberDown=get_post_meta(get_the_ID(), 'member_down',TRUE);
		$hidden=get_post_meta(get_the_ID(), 'hidden_content', true);
		$userType=getUsreMemberType();
		$down_info = null;
		
		$erphp_url_front_vip = get_bloginfo('wpurl').'/wp-admin/admin.php?page=erphpdown/admin/erphp-update-vip.php';
		if(get_option('erphp_url_front_vip')){
			$erphp_url_front_vip = get_option('erphp_url_front_vip');
		}
		$erphp_url_front_login = wp_login_url();
		if(get_option('erphp_url_front_login')){
			$erphp_url_front_login = get_option('erphp_url_front_login');
		}
		
		if($start_down2){
			$content.='<div class="erphpdown" id="erphpdown">';
			
			$user_id = is_user_logged_in() ? wp_get_current_user()->ID : 0;
			$wppay = new EPD(get_the_ID(), $user_id);
			if($wppay->isWppayPaid() || !$price){
				$downList=explode("\r\n",$url);
				foreach ($downList as $k=>$v){
					$filepath = $downList[$k];
					if($filepath){
						$filearr = explode(',',$filepath);
						$arrlength = count($filearr);
						if($arrlength == 1){
							$downMsg.="<div class='erphpdown-item'>文件".($k+1)."地址<a href='".$filepath."' target='_blank' class='erphpdown-down'>点击下载</a></div>";
						}elseif($arrlength == 2){
							$downMsg.="<div class='erphpdown-item'>".$filearr[0]."<a href='".$filearr[1]."' target='_blank' class='erphpdown-down'>点击下载</a></div>";
						}elseif($arrlength == 3){
							$downMsg.="<div class='erphpdown-item'>".$filearr[0]."<a href='".$filearr[1]."' target='_blank' class='erphpdown-down'>点击下载</a>（".$filearr[2]."）</div>";
						}
					}
				}
				$content .= $downMsg;
				$content.='<span class="epdvip">已购买</span>';
			}else{
				$content .= '您需要先支付<span class="erphpdown-price">'.$price.'</span>元才能下载此资源！<a href="javascript:;" class="erphp-wppay-loader erphpdown-buy" data-post="'.get_the_ID().'">立即支付</a>';	
			}
			
			if(get_option('ice_tips')) $content.='<div class="erphpdown-tips">'.get_option('ice_tips').'</div>';
			$content.='</div>';

		}elseif($start_down){
			$content.='<div class="erphpdown" id="erphpdown">';
			if(is_user_logged_in()){
				if($price){
					if($memberDown != 4)
						$content.='此资源下载价格为<span class="erphpdown-price">'.$price.'</span>'.get_option("ice_name_alipay");
				}else{
					if($memberDown != 4)
						$content.='恭喜，此资源为免费资源';
				}

				if($price || $memberDown == 4){
					global $wpdb;
					$user_info=wp_get_current_user();
					$down_info=$wpdb->get_row("select * from ".$wpdb->icealipay." where ice_post='".get_the_ID()."' and ice_success=1 and ice_user_id=".$user_info->ID." order by ice_time desc");
					if($days > 0){
						$lastDownDate = date('Y-m-d H:i:s',strtotime('+'.$days.' day',strtotime($down_info->ice_time)));
						$nowDate = date('Y-m-d H:i:s');
						if(strtotime($nowDate) > strtotime($lastDownDate)){
							$down_info = null;
						}
					}

					if($memberDown > 1){
						$vipText = '<a href="'.$erphp_url_front_vip.'" target="_blank" class="erphpdown-vip">升级VIP</a>';
						if($userType){
							$vipText = '';
						}
						if($memberDown==3 && $down_info==null){
							$content.='（VIP免费'.$vipText.'）';
						}elseif ($memberDown==2 && $down_info==null){
							$content.='（VIP 5折'.$vipText.'）';
						}elseif ($memberDown==5 && $down_info==null){
							$content.='（VIP 8折'.$vipText.'）';
						}elseif ($memberDown==6 && $down_info==null){
							if($userType < 9){
								$vipText = '<a href="'.$erphp_url_front_vip.'" target="_blank" class="erphpdown-vip">升级年费VIP</a>';
							}
							$content.='（年费VIP免费'.$vipText.'）';
						}elseif ($memberDown==7 && $down_info==null){
							if($userType < 10){
								$vipText = '<a href="'.$erphp_url_front_vip.'" target="_blank" class="erphpdown-vip">升级终身VIP</a>';
							}
							$content.='（终身VIP免费'.$vipText.'）';
						}elseif ($memberDown==4){
							if($userType){
								$content.='恭喜，此资源仅限VIP下载';
							}
						}
					}

					if($memberDown==4 && $userType==FALSE){
						$content.='抱歉，此资源仅限VIP下载<a href="'.$erphp_url_front_vip.'" class="erphpdown-vip">升级VIP</a>';
					}else{
						
						if($userType && $memberDown > 1)
						{
							//$msg='下载地址：&nbsp;';
							if($memberDown==3 || $memberDown==4)
							{
								//$msg.='您是VIP用户，可以免费下载此资源！';
								$content.="<a href=".constant("erphpdown").'download.php?postid='.get_the_ID()." class='erphpdown-down erphpdown-down-layui'>立即下载</a>";
							}
							elseif ($memberDown==2 && $down_info==null)
							{
								//$msg.='您是VIP用户，可以5折（价格为：'.($price*0.5).get_option('ice_name_alipay').'）购买下载此资源！';
								$content.='<a class="erphpdown-iframe erphpdown-buy" href='.constant("erphpdown").'icealipay-pay-center.php?postid='.get_the_ID().' target="_blank">立即购买</a>';
							}
							elseif ($memberDown==5 && $down_info==null)
							{
								//$msg.='您是VIP用户，可以8折（价格为：'.($price*0.8).get_option('ice_name_alipay').'）购买下载此资源！';
								$content.='<a class="erphpdown-iframe erphpdown-buy" href='.constant("erphpdown").'icealipay-pay-center.php?postid='.get_the_ID().' target="_blank">立即购买</a>';
							}
							elseif ($memberDown==6 && $down_info==null)
							{
								if($userType == 9){
									//$msg.='您是包年VIP用户，可以免费下载此资源！';
									$content.="<a href=".constant("erphpdown").'download.php?postid='.get_the_ID()." class='erphpdown-down erphpdown-down-layui'>立即下载</a>";
										
								}elseif($userType == 10){
									//$msg.='您是终身VIP用户，可以免费下载此资源！';
									$content.="<a href=".constant("erphpdown").'download.php?postid='.get_the_ID()." class='erphpdown-down erphpdown-down-layui'>立即下载</a>";
										
								}else{
									//$msg.='您是VIP用户，原价购买下载此资源！（年费VIP用户免费）';
									$content.='<a class="erphpdown-iframe erphpdown-buy" href='.constant("erphpdown").'icealipay-pay-center.php?postid='.get_the_ID().' target="_blank">立即购买</a>';
								}
							}
							elseif ($memberDown==7 && $down_info==null)
							{
								if($userType == 10){
									//$msg.='您是终身VIP用户，可以免费下载此资源！';
									$content.="<a href=".constant("erphpdown").'download.php?postid='.get_the_ID()." class='erphpdown-down erphpdown-down-layui'>立即下载</a>";
										
								}else{
									//$msg.='您是VIP用户，原价购买下载此资源！（终身VIP用户免费）';
									$content.='<a class="erphpdown-iframe erphpdown-buy" href='.constant("erphpdown").'icealipay-pay-center.php?postid='.get_the_ID().' target="_blank">立即购买</a>';
								}
							}
							elseif($down_info)
							{
								$content.='<a href='.constant("erphpdown").'download.php?url='.$down_info->ice_url.' class="erphpdown-down erphpdown-down-layui">立即下载</a>';
							}
						}
						else {
							if($down_info && $down_info->ice_price > 0){
								$content.='<a href='.constant("erphpdown").'download.php?url='.$down_info->ice_url.' class="erphpdown-down erphpdown-down-layui">立即下载</a>';
							}else{
								$content.='<a class="erphpdown-iframe erphpdown-buy" href='.constant("erphpdown").'icealipay-pay-center.php?postid='.get_the_ID().' target="_blank">立即购买</a>';
							}
						}
					}
					
				}else{
					$content.='<a href="'.constant("erphpdown").'download.php?postid='.get_the_ID().'" class="erphpdown-down erphpdown-down-layui">立即下载</a>';
				}
				
				if($down_info){
					$content.='<span class="epdvip">已购买</span>';
				}elseif($userType){
					if($userType == 9){
						$content.='<span class="epdvip">年费VIP用户</span>';
					}elseif($userType == 10){
						$content.='<span class="epdvip">终身VIP用户</span>';
					}else{
						$content.='<span class="epdvip">VIP用户</span>';
					}
					
				}
				
			}
			else {
				if($memberDown == 4){
					$content.='抱歉，此资源仅限VIP下载，请先<a href="'.$erphp_url_front_login.'" target="_blank" class="erphp-login-must">登录</a>';
				}else{
					if($price){
						$content.='此资源下载价格为<span class="erphpdown-price">'.$price.'</span>'.get_option('ice_name_alipay').'，请先<a href="'.$erphp_url_front_login.'" target="_blank" class="erphp-login-must">登录</a>';
					}else{
						$content.='恭喜，此资源为免费资源，请先<a href="'.$erphp_url_front_login.'" target="_blank" class="erphp-login-must">登录</a>';
					}
				}
				
			}
			
			if(get_option('ice_tips')) $content.='<div class="erphpdown-tips">'.get_option('ice_tips').'</div>';
			$content.='</div>';
			
		}elseif($start_see){
			
			if(is_user_logged_in()){
				global $wpdb;
				$user_info=wp_get_current_user();
				$down_info=$wpdb->get_row("select * from ".$wpdb->icealipay." where ice_post='".get_the_ID()."' and ice_success=1 and ice_user_id=".$user_info->ID." order by ice_time desc");
				if($days > 0){
					$lastDownDate = date('Y-m-d H:i:s',strtotime('+'.$days.' day',strtotime($down_info->ice_time)));
					$nowDate = date('Y-m-d H:i:s');
					if(strtotime($nowDate) > strtotime($lastDownDate)){
						$down_info = null;
					}
				}
				if( ($userType && ($memberDown==3 || $memberDown==4)) || ($down_info && $down_info->ice_price > 0) || ($memberDown==6 && $userType >= 9) || ($memberDown==7 && $userType == 10) || (!$price && $memberDown!=4)){
					return $content;
				}else{
				
					$content2='<div class="erphpdown" id="erphpdown">';
					if($price){
						if($memberDown != 4)
							$content2.='此内容查看价格为<span class="erphpdown-price">'.$price.'</span>'.get_option('ice_name_alipay');
					}
					
					
					if($memberDown > 1)
					{
						$vipText = '<a href="'.$erphp_url_front_vip.'" target="_blank" class="erphpdown-vip">升级VIP</a>';
						if($userType){
							$vipText = '';
						}
						if($memberDown==3 && $down_info==null){
							$content2.='（VIP免费'.$vipText.'）';
						}elseif ($memberDown==2 && $down_info==null){
							$content2.='（VIP 5折'.$vipText.'）';
						}elseif ($memberDown==5 && $down_info==null){
							$content2.='（VIP 8折'.$vipText.'）';
						}elseif ($memberDown==6 && $down_info==null){
							if($userType < 9){
								$vipText = '<a href="'.$erphp_url_front_vip.'" target="_blank" class="erphpdown-vip">升级年费VIP</a>';
							}
							$content2.='（年费VIP免费'.$vipText.'）';
						}elseif ($memberDown==7 && $down_info==null){
							if($userType < 10){
								$vipText = '<a href="'.$erphp_url_front_vip.'" target="_blank" class="erphpdown-vip">升级终身VIP</a>';
							}
							$content2.='（终身VIP免费'.$vipText.'）';
						}elseif ($memberDown==4){
							if($userType){
								
							}
						}
					}
					
					if($memberDown==4 && $userType==FALSE)
					{
						$content2.='抱歉，此内容对限VIP查看<a href="'.$erphp_url_front_vip.'" target="_blank" class="erphpdown-vip">升级VIP</a>';
					}
					else 
					{
						if($userType && $memberDown > 1)
						{
							if ($memberDown==2 && $down_info==null)
							{
								//$msg.='您是VIP用户，可以5折（价格为：'.($price*0.5).get_option('ice_name_alipay').'）购买查看此内容！';
								$content2.='<a class="erphpdown-iframe erphpdown-buy" href='.constant("erphpdown").'icealipay-pay-center.php?postid='.get_the_ID().' target="_blank" >立即购买</a>';
							}
							elseif ($memberDown==5 && $down_info==null)
							{
								//$msg.='您是VIP用户，可以8折（价格为：'.($price*0.8).get_option('ice_name_alipay').'）购买查看此内容！';
								$content2.='<a class="erphpdown-iframe erphpdown-buy"  href='.constant("erphpdown").'icealipay-pay-center.php?postid='.get_the_ID().' target="_blank" >立即购买</a>';
							}
							elseif ($memberDown==6 && $down_info==null)
							{
								if($userType < 9){
									//$msg.='您是VIP用户，原价购买查看此内容！（包年VIP用户免费查看）';
									$content2.='<a class="erphpdown-iframe erphpdown-buy"  href='.constant("erphpdown").'icealipay-pay-center.php?postid='.get_the_ID().' target="_blank" >立即购买</a>';
								}
							}
							elseif ($memberDown==7 && $down_info==null)
							{
								if($userType < 10){
									//$msg.='您是VIP用户，原价购买查看此内容！（终身VIP用户免费查看）';
									$content2.='<a class="erphpdown-iframe erphpdown-buy"  href='.constant("erphpdown").'icealipay-pay-center.php?postid='.get_the_ID().' target="_blank" >立即购买</a>';
								}
							}
						}
						else 
						{
							if($down_info  && $down_info->ice_price > 0){
								
							}else {
								$content2.='<a class="erphpdown-iframe erphpdown-buy" href='.constant("erphpdown").'icealipay-pay-center.php?postid='.get_the_ID().'>立即购买</a>';
							}
						}
					}
				}
				if($down_info){
					$content2.='<span class="epdvip">已购买</span>';
				}elseif($userType){
					if($userType == 9){
						$content2.='<span class="epdvip">年费VIP用户</span>';
					}elseif($userType == 10){
						$content2.='<span class="epdvip">终身VIP用户</span>';
					}else{
						$content2.='<span class="epdvip">VIP用户</span>';
					}
					
				}	
			}else{
				$content2='<div class="erphpdown" id="erphpdown">';
				
				if($memberDown == 4){
					$content2.='抱歉，此内容对限VIP查看，请先<a href="'.$erphp_url_front_login.'" target="_blank" class="erphp-login-must">登录</a>';
				}else{
					if($price){
						$content2.='此内容查看价格为<span class="erphpdown-price">'.$price.'</span>'.get_option('ice_name_alipay').'，请先<a href="'.$erphp_url_front_login.'" target="_blank" class="erphp-login-must">登录</a>';
					}
				}
				
			}
			if(get_option('ice_tips')) $content2.='<div class="erphpdown-tips">'.get_option('ice_tips').'</div>';
			$content2.='</div>';
			return $content2;
			
		}elseif($start_see2){

			if(is_user_logged_in()){
				global $wpdb;
				$user_info=wp_get_current_user();
				$down_info=$wpdb->get_row("select * from ".$wpdb->icealipay." where ice_post='".get_the_ID()."' and ice_success=1 and ice_user_id=".$user_info->ID." order by ice_time desc");
				if($days > 0){
					$lastDownDate = date('Y-m-d H:i:s',strtotime('+'.$days.' day',strtotime($down_info->ice_time)));
					$nowDate = date('Y-m-d H:i:s');
					if(strtotime($nowDate) > strtotime($lastDownDate)){
						$down_info = null;
					}
				}
				if( (($memberDown==3 || $memberDown==4) && $userType) || ($down_info && $down_info->ice_price > 0) || ($memberDown==6 && $userType >= 9) || ($memberDown==7 && $userType == 10) || (!$price && $memberDown!=4)){
					//
				}else{
					$content.='<div class="erphpdown" id="erphpdown">';
					if($price){
						if($memberDown != 4)
							$content.='以上隐藏内容查看价格为<span class="erphpdown-price">'.$price.'</span>'.get_option('ice_name_alipay');
					}
					
					if($memberDown > 1)
					{
						$vipText = '<a href="'.$erphp_url_front_vip.'" target="_blank" class="erphpdown-vip">升级VIP</a>';
						if($userType){
							$vipText = '';
						}
						if($memberDown==3 && $down_info==null){
							$content.='（VIP免费'.$vipText.'）';
						}elseif ($memberDown==2 && $down_info==null){
							$content.='（VIP 5折'.$vipText.'）';
						}elseif ($memberDown==5 && $down_info==null){
							$content.='（VIP 8折'.$vipText.'）';
						}elseif ($memberDown==6 && $down_info==null){
							if($userType < 9){
								$vipText = '<a href="'.$erphp_url_front_vip.'" target="_blank" class="erphpdown-vip">升级年费VIP</a>';
							}
							$content.='（年费VIP免费'.$vipText.'）';
						}elseif ($memberDown==7 && $down_info==null){
							if($userType < 10){
								$vipText = '<a href="'.$erphp_url_front_vip.'" target="_blank" class="erphpdown-vip">升级终身VIP</a>';
							}
							$content.='（终身VIP免费'.$vipText.'）';
						}elseif ($memberDown==4){
							if($userType){
								
							}
						}
					}

					if($memberDown==4 && $userType==FALSE){
						$content.='抱歉，以上隐藏内容仅限VIP查看<a href="'.$erphp_url_front_vip.'" target="_blank" class="erphpdown-vip">升级VIP</a>';
					}
					else 
					{
						
						if($userType && $memberDown > 1)
						{
							if ($memberDown==2 && $down_info==null)
							{
								//$msg.='您是VIP用户，可以5折（价格为：'.($price*0.5).get_option('ice_name_alipay').'）购买查看此内容！';
								$content.='<a class="erphpdown-iframe erphpdown-buy" href='.constant("erphpdown").'icealipay-pay-center.php?postid='.get_the_ID().' target="_blank" >立即购买</a>';
							}
							elseif ($memberDown==5 && $down_info==null)
							{
								//$msg.='您是VIP用户，可以8折（价格为：'.($price*0.8).get_option('ice_name_alipay').'）购买查看此内容！';
								$content.='<a class="erphpdown-iframe erphpdown-buy"  href='.constant("erphpdown").'icealipay-pay-center.php?postid='.get_the_ID().' target="_blank" >立即购买</a>';
							}
							elseif ($memberDown==6 && $down_info==null)
							{
								if($userType < 9){
									//$msg.='您是VIP用户，原价购买查看此内容！（包年VIP用户免费查看）';
									$content.='<a class="erphpdown-iframe erphpdown-buy"  href='.constant("erphpdown").'icealipay-pay-center.php?postid='.get_the_ID().' target="_blank" >立即购买</a>';
								}
							}
							elseif ($memberDown==7 && $down_info==null)
							{
								if($userType < 10){
									//$msg.='您是VIP用户，原价购买查看此内容！（终身VIP用户免费查看）';
									$content.='<a class="erphpdown-iframe erphpdown-buy"  href='.constant("erphpdown").'icealipay-pay-center.php?postid='.get_the_ID().' target="_blank" >立即购买</a>';
								}
							}
							
						}
						else 
						{
							$content.='<a class="erphpdown-iframe erphpdown-buy" href='.constant("erphpdown").'icealipay-pay-center.php?postid='.get_the_ID().' target="_blank">立即购买</a>';
						}
					}

					if($down_info){
						$content.='<span class="epdvip">已购买</span>';
					}elseif($userType){
						if($userType == 9){
							$content.='<span class="epdvip">年费VIP用户</span>';
						}elseif($userType == 10){
							$content.='<span class="epdvip">终身VIP用户</span>';
						}else{
							$content.='<span class="epdvip">VIP用户</span>';
						}
						
					}

					if(get_option('ice_tips')) $content.='<div class="erphpdown-tips">'.get_option('ice_tips').'</div>';
					$content.='</div>';
				
				}
				
			}
			else {

				$content.='<div class="erphpdown" id="erphpdown">';
				if($memberDown == 4){
					$content.='抱歉，以上隐藏内容仅限VIP查看，请先<a href="'.$erphp_url_front_login.'" target="_blank" class="erphp-login-must">登录</a>';
				}else{
					if($price){
						$content.='以上隐藏内容查看价格为<span class="erphpdown-price">'.$price.'</span>'.get_option('ice_name_alipay').'，请先<a href="'.$erphp_url_front_login.'" target="_blank" class="erphp-login-must">登录</a>';
					}
				}
				
				if(get_option('ice_tips')) $content.='<div class="erphpdown-tips">'.get_option('ice_tips').'</div>';
				$content.='</div>';
				
			}

		}
		
	}else{
		if($start_see){
			return '';
		}
	}
	
	return $content;
}

if(!erphp_check_mobantu_theme()){
	add_action('the_content','erphpdown_content_show');
}

