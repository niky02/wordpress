<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;
date_default_timezone_set('Asia/Shanghai');
// Authentication
if ( ! current_user_can( 'manage_options' ) ) {
	return;
}
?>
<script type="text/javascript">
　　window.location.href="<?php echo admin_url('/users.php'); ?>";
</script>