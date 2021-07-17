<?php 
    function showMsg($msg, $pid=0){
?>




    <html lang="zh-CN">
        <head>
            <meta charset="UTF-8" />
            <link rel="stylesheet" href="<?php echo constant("erphpdown"); ?>static/erphpdown.css" type="text/css" />
            <title>文件下载 - <?php echo get_the_title($pid);?> - <?php bloginfo('name');?></title>
        </head>
        <body class="erphpdown-body">
        	<div id="erphpdown-download">
                <!-- 以下内容不要动 -->
        		<div class="msg"><?php echo $msg;?></div>
                <!-- 以上内容不要动 -->
            </div>
        </body>
    </html>




<?php 
    exit;
}
