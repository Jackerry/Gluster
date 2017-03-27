viewVariable = new Object();

 viewVariable.td_chosen = function(oldIndex,newIndex,idConstruct) {
	if(oldIndex!=null)
		document.getElementById(idConstruct(oldIndex)).className="";
	document.getElementById(idConstruct(newIndex)).className="chosen";
}

function updateTable(arr,id){
	var lineConstruct =  viewVariable.findConstructFun(id);
	if(lineConstruct ==null){
		console.log("lineConstruct Undefine");
		return false;
	}
	var tableHtml="";
	for(index in arr){
		tableHtml+=lineConstruct(index,arr[index]);
	}
	document.getElementById(id).innerHTML = tableHtml;
}

 viewVariable.findConstructFun = function(id){
	if(id=="gluster_activity_node_table") return viewVariable.gluster_activity_node_table;
	else if(id=="gluster_sever_node_table") return viewVariable.gluster_sever_node_table;
	else if(id="innet_node_table") return viewVariable.innet_node_table;
	else return null;
}