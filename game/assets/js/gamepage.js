function biggerGame(width,height){
	var objWrap = getElement("woyouxi_game_wrap");
	var objContent = getElement("woyouxi_game_content");
	var obj = getElement("woyouxi_game");
	var objFloat = getElement("woyouxi_game_right");
	
	if(obj != null){
		obj.width = "978px";
		objContent.style.width = "978px";
		
		var objHeight = 978 * height / width;
		obj.height = objHeight  + "px";
		objContent.style.height = obj.height;
		
		objWrap.style.width = "980px";
		objWrap.style.height = (objHeight + 20) + "px";
		
		if(objFloat != undefined && objFloat != null){
			objFloat.style.display = "none";
		}
	}
}

function smallerGame(width,height){
	var objWrap = getElement("woyouxi_game_wrap");
	var objContent = getElement("woyouxi_game_content");
	var obj = getElement("woyouxi_game");
	var objFloat = getElement("woyouxi_game_right");
	if(obj != null){
		
		obj.width = "640px";
		objContent.style.width = "640px";
		
		var objHeight = 640 * height / width;
		obj.height = objHeight  + "px";
		objContent.style.height = obj.height;
		
		objWrap.style.width = "670px";
		objWrap.style.height = (objHeight + 20) + "px";
		
		if(objFloat != undefined && objFloat != null){
			objFloat.style.display = "block";
		}
	}
}


function replay(){
	var obj = getElement("woyouxi_game");
	if(obj != null){
		var html = obj.innerHTML;
		obj.innerHTML = html;
	}
}

function copyToClipboard(txt) {
    if (window.clipboardData) {
        window.clipboardData.clearData();
        window.clipboardData.setData("Text", txt);
    } else if (navigator.userAgent.indexOf("Opera") != -1) {
    	window.location = txt;
    } else if (window.netscape){
        try {
        	netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
        } catch (e) {
                alert("您的firefox安全限制限制您进行剪贴板操作，请在新窗口的地址栏里输入'about:config'然后找到'signed.applets.codebase_principal_support'设置为true'");
                return false;
        }
        var clip = Components.classes["@mozilla.org/widget/clipboard;1"].createInstance(Components.interfaces.nsIClipboard);
        if (!clip) return false;
        var trans = Components.classes["@mozilla.org/widget/transferable;1"].createInstance(Components.interfaces.nsITransferable);
        if (!trans) return false;
        trans.addDataFlavor('text/unicode');
        var str = new Object();
        var len = new Object();
        var str = Components.classes["@mozilla.org/supports-string;1"].createInstance(Components.interfaces.nsISupportsString);
        var copytext = txt;
        str.data = copytext;
        trans.setTransferData("text/unicode", str, copytext.length * 2);
        var clipid = Components.interfaces.nsIClipboard;
        if (!clip) return false;
        clip.setData(trans, null, clipid.kGlobalClipboard);
    }
}