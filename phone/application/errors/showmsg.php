<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    
    <?php if(!empty($link)){?>
	<meta http-equiv="refresh" content="<?php echo $second;?>;URL=<?php echo $link[0]['link_url'];?>" />
	<?php }?>
	
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Show Masages</title>

    <link href="<?php echo BOOT_RES;?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo BOOT_RES;?>font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo BOOT_RES;?>css/animate.css" rel="stylesheet">
    <link href="<?php echo BOOT_RES;?>css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">


    <div class="middle-box text-center animated fadeInDown">

        <h2 class="font-bold">提示信息！</h2>

        <div class="error-desc">
            <?php echo $msg;?> 
            <br/>
            
            <?php 
			if(!empty($link)){ 
				foreach($link as $key=>$val){
			?>
		    <a href="<?php echo $val['link_url'];?>"  class="btn btn-primary m-t"> <?php echo $val['link_name'];?></a> &nbsp;
		    <?php }}else{?>
		    <a href="javascript:void(0);" onClick="history.back(-1);"  class="btn btn-primary m-t">返回上一页</a>
		   <?php }?>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script type="text/javascript">
var second = <?php  echo $second;?>;
function second_url(){
	if(second < 1){
		<?php if(empty($link)){ echo "history.back(-1);";}?>
	}
	second--;
}
setTimeout('second_url()', 5000);
</script>

</body>

</html>

