<?php
date_default_timezone_set('Asia/Shanghai');
require_once('../../../wp-config.php');
if(!is_user_logged_in())
{
	showMsg('请先登录系统');
}

$user_info=wp_get_current_user();
$filename=$_GET['filename'];
$md5key=$_GET['md5key'];
$times=$_GET['times'];
$session_name=$_GET['session_name'];

$filename = esc_sql($filename);
$md5key = esc_sql($md5key);
$times = esc_sql($times);
$session_name = esc_sql($session_name);

if($_GET['id']){
	$pid = esc_sql($_GET['id']);
	$ppost = get_post($pid);
	if(!$ppost) wp_die('资源错误！');
	$g=(int)get_post_meta($pid,'down_times',true);
	if(!$g)$g=0;
	update_post_meta($pid,'down_times',$g+1);
	$memberDown=get_post_meta($pid, 'member_down',TRUE);
	$price = get_post_meta($pid, 'down_price',TRUE);
	$userType=getUsreMemberType();

	if(!$price && $memberDown != 4){
		$erphp_reg_times  = get_option('erphp_reg_times');
		if(!$userType && $erphp_reg_times > 0){
			if( checkDownLog($user_info->ID,$pid,$erphp_reg_times,erphpGetIP()) ){

			}else{
				wp_die("普通用户每天只能下载".$erphp_reg_times."个免费资源！");
			}
		}
		addDownLog($user_info->ID,$pid,erphpGetIP());
	}else{
		if($memberDown == 3 || $memberDown == 4 || $memberDown == 6 || $memberDown == 7){
			
			if($userType){
				
				$erphp_life_times    = get_option('erphp_life_times');
				$erphp_year_times    = get_option('erphp_year_times');
				$erphp_quarter_times = get_option('erphp_quarter_times');
				$erphp_month_times  = get_option('erphp_month_times');

				if($userType == 7 && $erphp_month_times > 0){
					if( checkDownLog($user_info->ID,$pid,$erphp_month_times,erphpGetIP()) ){

					}else{
						wp_die("包月VIP用户每天只能免费下载".$erphp_month_times."个VIP资源！");
					}
				}elseif($userType == 8 && $erphp_quarter_times > 0){
					if( checkDownLog($user_info->ID,$pid,$erphp_quarter_times,erphpGetIP()) ){

					}else{
						wp_die("包季VIP用户每天只能免费下载".$erphp_quarter_times."个VIP资源！");
					}
				}elseif($userType == 9 && $erphp_year_times > 0){
					if( checkDownLog($user_info->ID,$pid,$erphp_year_times,erphpGetIP()) ){

					}else{
						wp_die("包年VIP用户每天只能免费下载".$erphp_year_times."个VIP资源！");
					}
				}elseif($userType == 10 && $erphp_life_times > 0){
					if( checkDownLog($user_info->ID,$pid,$erphp_life_times,erphpGetIP()) ){

					}else{
						wp_die("终身VIP用户每天只能免费下载".$erphp_life_times."个VIP资源！");
					}
				}

				addDownLog($user_info->ID,$pid,erphpGetIP());
				
			}
		}
	}
}else{
	wp_die('资源错误！');
}

if(abs(time()-$times) < 100)
{
	$md5my=md5($user_info->ID.'erphpdown'.$filename.$times.get_option('erphpdown_downkey'));
	if($md5key==$md5my)
	{
		$file = erphpdown_unlock_url($session_name,get_option('erphpdown_downkey'));
		if(substr($file,0,7) == 'http://' || substr($file,0,8) == 'https://' || substr($file,0,10) == 'thunder://' || substr($file,0,7) == 'magnet:' || substr($file,0,5) == 'ed2k:' || substr($file,0,4) == 'ftp:')
		{
			$info=erphpdown_download_file($file);
		}
		else
		{
			$filearr = explode(',',$file);
			$arrlength = count($filearr);
			if($arrlength == 1){
				$info=erphpdown_download_file(ABSPATH.'/'.$file);
			}elseif($arrlength >= 2){
				if(substr($filearr[1],0,7) == 'http://' || substr($filearr[1],0,8) == 'https://' || substr($filearr[1],0,10) == 'thunder://' || substr($filearr[1],0,7) == 'magnet:' || substr($filearr[1],0,5) == 'ed2k:' || substr($filearr[1],0,4) == 'ftp:'){
					$info=erphpdown_download_file($filearr[1]);
				}else{
					$info=erphpdown_download_file(ABSPATH.'/'.$filearr[1]);
				}
			}
		}
		if(!$info)
		{
			showMsg('出错了，请联系管理员提供下载！');
			exit;
		}
	}
}
exit('404 not found');
?>
