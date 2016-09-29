<?php


$isPost = false;
$username = "";
if(array_key_exists("username", $_POST)){
	$username = $_POST['username'];
}

function getLoginErrorInfo()
{
	global $loginErrorCode;
	echo $loginErrorCode;
	 
	if(count($_POST) == 0 ) return "";
	if($loginErrorCode == null ) return "";
	
	if($loginErrorCode == 1) return "登陆失败，请检查用户名或密码！";
	if($loginErrorCode == 2) return "验证码填写不正确!";
	if($loginErrorCode == 3) return "您还不是管理员!无法登陆管理员控制中心";
	if($loginErrorCode == 4) return "未知错误!";
	return "";
}

?>


<script type="text/javascript" src="/game/assets/cms/md5.js"></script>
<script type="text/javascript">
	function reloadVerifyCode(){
		var obj = document.getElementById("checkcode_img");
		if(obj != null){
			obj.src = "/game/verification-code.php?" + Math.random();
		}
	}

	function checkParam(){
		var objCheckCode = document.getElementById("checkcode");
		var objUserName = document.getElementById("username");
		var objPassword = document.getElementById("password");
		var objError = document.getElementById("error");

		var password = objPassword.value.trim();
		var username = objUserName.value.trim();

		var namepwd = false;
		if(objUserName != null && objPassword != null){
			if(username != "" && password != ""){
				namepwd = true;
			}else{
				var errorInfo = "";
				if(username == ""){
					errorInfo += "账号";
				}
				if(password == 0){
					if(errorInfo == ""){
						errorInfo += "密码";
					}else{
						errorInfo += "与密码";
					}
				}
				if(errorInfo != ""){
					errorInfo += "不能为空";
				}
				objError.innerText = errorInfo;
				objError.style.display = "block";
			}
		}

		if(namepwd){
			if(objCheckCode != null && objCheckCode.value.trim() != ""){
				var objHide = document.getElementById("hidepwd");
				if(objHide != null){
					objHide.value = hex_md5(objPassword.value);
				}
				return true;
			}else{
				objError.innerText = "验证码不能为空";
				objError.style.display = "block";
			}
		}
		return false;
	}
</script>
<style type="text/css">
.register_li
{
list-style:none;
font-size:16px;
height:35px;
line-height:35px;
}

.login_center_middle
{
	margin:0px auto;
	margin-top:5em;
	width:400px;
}

.login_box
{
	border:1px solid #ccc;
	background:#fff;
	margin:1em 0em;
	box-shadow:1px 1px 0px #fff;
	-webkit-box-shadow:1px 1px 0px #fff;
}

.block-heading
{
	color:#505050;
	background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #dddddd), color-stop(1, #fafafa));
	display: block;
	padding-left: 1em;
	border-top: 1px solid #fff;
	outline: none;
	border-bottom: 1px solid #a6a6a6;
	border-left: none;
	margin-bottom: 0px;
	text-shadow: none;
	text-transform: none;
	font-weight: bold;
	font-size: .85em;
	line-height: 3em;
	margin: 0 0 10px;
}

.block-body
{
margin: 1em;
min-height: .25em;
}

</style>


<form method="post">
<div id="login_center_middle" class="login_center_middle">
	<div class="login_box">
		<p class="block-heading">登陆到 我游戏</p>
		<div class="block-body">
			<label class="login_label">用户名：</label>
            <input name="username" id="username" type="text" class="login_edit"></input>
            <label class="login_label">密码：</label>
            <input type="password" name="password" id="password" class="login_edit"></input>
            <div>
            	<label class="login_label">验证码：</label>
            	<input name="checkcode" id="checkcode" type="text" style="width:100px" class="login_edit"></input>
            	<img id="checkcode_img" onclick="reloadVerifyCode();" style="cursor:pointer;left:60px;top:0px;" src="/game/verification-code.php" alt="验证码"></img>
            </div>
            <label name="error" id="error" style="color:#f00" class="login_label">
            <?php if($loginErrorCode == 1) echo "登陆失败，请检查用户名或密码！"; ?>
			<?php if($loginErrorCode == 2) echo "验证码填写不正确!";?>
			<?php if($loginErrorCode == 3) echo "您还不是管理员!无法登陆管理员控制中心";?>
			<?php if($loginErrorCode == 4) echo "未知错误!";?>
            </label>
            <input type="hidden" id="hidepwd" name="hidepwd" style="" value="" ></input>
            <input type="submit" class="login_submit_button" onclick="return checkParam();" value="登陆">
            <div style="clear:both;"></div>
		</div>
</div>
</form>
	