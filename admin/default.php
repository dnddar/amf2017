<?php
require_once('include.php');

$lang = $_SESSION["lang"];
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
<?php
require_once("meta.php");
?>
<script type="text/javascript">

$( document ).ready(function() {
	
})

</script>
</head>

<body>
<div id="mask"></div>
<div class="wrap"> 
  <!--header start-->
  <?php
	require_once("header.php");
  ?>
  <!--header end--> 
  
  <!--admin_content start-->
  
  <div class="admin_content">
    <div class="cont_r" id="admin_ct">
      <p class='default'>
        <?=$mid?>
        您好,<br>
        現在時間是<span class='notice'>
        <?=date( 'Y/m/d Ag:i' )?>
        </span><br>
        歡迎使用本系統<br>
        <br>
        請點選上方目錄選擇您想進行的操作</p>
    </div>
    <!--cont_r end--> 
  </div>
  <!--admin_content end--> 
</div>
<?php
require_once("footer.php"); 
?>
<!--wrap end-->
</body>
