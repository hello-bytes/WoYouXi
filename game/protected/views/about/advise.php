<?php if(count($_POST) > 0){ ?>
<p>您的内容已提交，如有必要，我们会第一时间联系您，再次感谢您!</p>
<?php }else{ ?>
<span>您好，欢迎您给我们提出使用中遇到的问题或建议！留下联系方式，将有机会获得精美礼品！</span>
<br/><br/>
<form name="adviseform" id="adviseform" method="post" action="">
<table width="680" border="0" align="center" cellpadding="0" cellspacing="0">
 <tbody>
 	<tr>
 		<td height="130" valign="top"><strong>描述*：<strong></td>
 		<td valign="top" class="t_g"><textarea class="gametext" id="advisedesc" name="advisedesc" cols="60" rows="6"></textarea><br></td>
 	</tr>
 	<tr>
 		<td>联系方式：</td>
 		<td><input name="contact" id="contact" type="text" class="input_upload" value="">请以联系方式+账号的方式提交，比如QQ:42322</td>
 	</tr>
 	<tr>
	                <td height="60" align="center">&nbsp;</td>
	                <td height="60" align="left">
		                <input type="submit" name="button2" class="btn_upload" value="上  传" id="buttonUpload" >
		            </td>
                </tr>
 </tbody>
 </table>
</form>
<?php } ?>
