function showPages(name) { //初始化属性
	this.name = name;      //对象名称
	this.page = 1;         //当前页数
	this.pageCount = 1;    //总页数
	this.argName = 'page'; //参数名
	this.showTimes = 1;    //打印次数
}

showPages.prototype.getPage = function(){ //丛url获得当前页数,如果变量重复只获取最后一个
	var args = location.search;
	var reg = new RegExp('[\?&]?' + this.argName + '=([^&]*)[&$]?', 'gi');
	var chk = args.match(reg);
	this.page = RegExp.$1;
}

showPages.prototype.checkPages = function(){ //进行当前页数和总页数的验证
	if (isNaN(parseInt(this.page))) this.page = 1;
	if (isNaN(parseInt(this.pageCount))) this.pageCount = 1;
	if (this.page < 1) this.page = 1;
	if (this.pageCount < 1) this.pageCount = 1;
	if (this.page > this.pageCount) this.page = this.pageCount;
	this.page = parseInt(this.page);
	this.pageCount = parseInt(this.pageCount);
}
showPages.prototype.createHtml = function(baseUrl){ //生成html代码
	var strHtml = '', prevPage = this.page - 1, nextPage = this.page + 1;
	//strHtml += '<span class="count">当前页: ' + this.page + ' / ' + this.pageCount + '</span>';
	//strHtml += '&nbsp;&nbsp;';
	
	strHtml += '<span class="number">';
	if (prevPage < 1) {
		strHtml += '<span title="第一页">«</span>';
		strHtml += '&nbsp;&nbsp;';
		strHtml += '<span title="上一页">‹</span>';
		strHtml += '&nbsp;&nbsp;';
	} else {
		strHtml += '<span title="第一页"><a href="' + baseUrl + '1">«</a></span>';
		strHtml += '&nbsp;&nbsp;';
		strHtml += '<span title="上一页"><a href="' + baseUrl + prevPage + ');">‹</a></span>';
		strHtml += '&nbsp;&nbsp;';
	}
	if (this.page != 1) {
		strHtml += '<span title="第1页"><a href="' + baseUrl + '1" class="pageitem">1</a></span>';
		strHtml += '&nbsp;&nbsp;';
	}
	
	if (this.page >= 5) {
		strHtml += '<span>...</span>';
		strHtml += '&nbsp;&nbsp;';
	}
	
	if (this.pageCount > this.page + 2) {
		var endPage = this.page + 2;
	} else {
		var endPage = this.pageCount;
	}
	
	for (var i = this.page - 2; i <= endPage; i++) {
		if (i > 0) {
			if (i == this.page) {
				strHtml += '<span  class="pageitem_active" title="第' + i + '页">' + i + '</span>';
				strHtml += '&nbsp;&nbsp;';
			} else {
				if (i != 1 && i != this.pageCount) {
					strHtml += '<span title="第' + i + '页"><a class="pageitem" href="' + baseUrl + i + '">' + i + '</a></span>';
					strHtml += '&nbsp;&nbsp;';
				}
			}
		}
	}
	//strHtml += '&nbsp;&nbsp;';
	if (this.page + 3 < this.pageCount) {
		strHtml += '<span>...</span>';
		strHtml += '&nbsp;&nbsp;';
	}

	if (this.page != this.pageCount) { 
		strHtml += '<span title="第' + this.pageCount + '页"><a class="pageitem" href="' + baseUrl + this.pageCount + '">' + this.pageCount + '</a></span>';
		strHtml += '&nbsp;&nbsp;';
	}

	if (nextPage > this.pageCount) {
		strHtml += '<span title="下一页">›</span>';
		strHtml += '&nbsp;&nbsp;';
		strHtml += '<span title="最后一页">»</span>';
	} else {
		strHtml += '<span title="下一页"><a href="' + baseUrl + nextPage + '">›</a></span>';
		strHtml += '&nbsp;&nbsp;';
		strHtml += '<span title="最后一页"><a href="' + baseUrl + this.pageCount + '">»</a></span>';
	}
	strHtml += '</span><br />';
	return strHtml;
}

showPages.prototype.createBaseUrl = function () { //生成页面跳转url
	var url = location.protocol + '//' + location.host + location.pathname;
	var args = location.search;
	var reg = new RegExp('([\?&]?)' + this.argName + '=[^&]*[&$]?', 'gi');
	args = args.replace(reg,'$1');
	if (args == '' || args == null) {
		args += '?' + this.argName + '=';
	} else if (args.substr(args.length - 1,1) == '?' || args.substr(args.length - 1,1) == '&') {
			args += this.argName + '=';
	} else {
			args += '&' + this.argName + '=';
	}
	console.log(url + args);
	return url + args;
}

showPages.prototype.createUrl = function (page) { //生成页面跳转url
	if (isNaN(parseInt(page))) page = 1;
	if (page < 1) page = 1;
	if (page > this.pageCount) page = this.pageCount;
	var url = location.protocol + '//' + location.host + location.pathname;
	var args = location.search;
	var reg = new RegExp('([\?&]?)' + this.argName + '=[^&]*[&$]?', 'gi');
	args = args.replace(reg,'$1');
	if (args == '' || args == null) {
		args += '?' + this.argName + '=' + page;
	} else if (args.substr(args.length - 1,1) == '?' || args.substr(args.length - 1,1) == '&') {
			args += this.argName + '=' + page;
	} else {
			args += '&' + this.argName + '=' + page;
	}
	return url + args;
}
showPages.prototype.toPage = function(page){ //页面跳转
	var turnTo = 1;
	if (typeof(page) == 'object') {
		turnTo = page.options[page.selectedIndex].value;
	} else {
		turnTo = page;
	}
	self.location.href = this.createUrl(turnTo);
}

showPages.prototype.printHtml = function(baseUrl){ //显示html代码
	
	this.getPage();
	this.checkPages();
	this.showTimes += 1;
	document.write('<div id="pages_' + this.name + '_' + this.showTimes + '" class="pages"></div>');
	
	document.getElementById('pages_' + this.name + '_' + this.showTimes).innerHTML = this.createHtml(baseUrl);
	
}

showPages.prototype.formatInputPage = function(e){ //限定输入页数格式
	var ie = navigator.appName=="Microsoft Internet Explorer"?true:false;
	if(!ie) var key = e.which;
	else var key = event.keyCode;
	if (key == 8 || key == 46 || (key >= 48 && key <= 57)) return true;
	return false;
}