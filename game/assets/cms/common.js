function getObject(objName){
	var obj = document.getElementById(objName);
	return obj;
}

function setOperator(operatorVal){
	var obj = getObject("operator");
	if(obj != null){
		obj.value = operatorVal;
	}
}

function setParam1(paramVal){
	var obj = getObject("param1");
	if(obj != null){
		obj.value = paramVal;
	}
}

function setParam2(paramVal){
	var obj = getObject("param2");
	if(obj != null){
		obj.value = paramVal;
	}
}

function submit(objFormName)
{
	var obj  = getObject(objFormName);
	if(obj != null){
		obj.submit();
	}
}