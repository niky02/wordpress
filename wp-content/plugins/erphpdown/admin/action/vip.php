<?php
require( dirname(__FILE__) . '/../../../../../wp-load.php' );
if(current_user_can('administrator')){
	global $wpdb;
	if($_POST['do']=='del'){
		$uid=$wpdb->escape(intval($_POST['uid']));
		$sql="update ".$wpdb->iceinfo." set userType=0,endTime='1000-01-01' where ice_user_id=".$uid;
		$a=$wpdb->query($sql);
		if($a){
			echo "success";
		}
	}elseif($_POST['do']=='edit'){
		$id=$wpdb->escape($_POST['id']);
		$new_date=$wpdb->escape($_POST['new_date']);
		$sql="update ".$wpdb->iceinfo." set endTime='".$new_date."' where ice_id=".$id;
		$a=$wpdb->query($sql);
		if($a){
			echo "success";
		}
	}elseif($_POST['do']=='type'){
		$ids=$wpdb->escape($_POST['ids']);
		$type=$wpdb->escape($_POST['type']);
		$price=$wpdb->escape($_POST['price']);
		$idarr = explode(',', $ids);
		if(count($idarr)){
			foreach ($idarr as $pid) {
				update_post_meta($pid,"member_down",$type);
				if($price != ''){
					update_post_meta($pid,"down_price",$price);
				}
			}
		}
		echo "success";
	}
}
