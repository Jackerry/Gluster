<?php include '../logic/start.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<?php include './vice/public_css_js.php'; ?>
	<title>集群配置</title>
	<link rel="stylesheet" type="text/css" href="css/style_setting_pools.css">

	<?php include '../logic/setting_pools.php'; ?>
</head>
<body>
	<!-- 引入页头 -->
	<?php include './vice/header.php'; ?>
	<!-- 中间部分 -->
	<main>
		<div class="mainContainer">
			<!-- 左边菜单 -->
			<div class="container-left">
				<?php include './vice/menu.php'; ?>
			</div>
			<!-- 右边内容 -->
			<div class="container-right">
				<br>
				<div id="settingPools_div_first">
			        <input  type="text" id="start_ip" disabled="disabled" value="<?php if(isset($_SESSION['start_ip'])){echo $_SESSION['start_ip'];}?>" />
			   		<input  type="text" id="end_ip" disabled="disabled" value="<?php	if(isset($_SESSION['end_ip'])){echo $_SESSION['end_ip'];}?>
			        " />
			        <button class="button" id="btn"  data-toggle="modal" data-target="#myModal">网络设置</button>
			        <!-- 模态框（Modal） -->
			        <?php include './vice/internet_address.php'; ?>
			        <hr class="settingPools_hr">
					<!-- 第2行，节点列表内容 -->
					<div id="settingPools_div_list">
					<table>
					<tr><td>
					
					当前gluster活动节点列表
					<div id="settingPools_div_list_table">
						<table id="gluster_activity_node_table">
							<script type="text/javascript">
								viewVariable.activity_index = null;
								viewVariable.setActivityIndex = function(index,value){
									viewVariable.td_chosen(viewVariable.activity_index,index,(i)=>{return "activity_"+i;}) 
									viewVariable.activity_index = index;
								}
								viewVariable.gluster_activity_node_table = (index,value)=>{return '<tr><td id="activity_'+index+'" onclick="viewVariable.setActivityIndex('+index+')">'+value.ip+'&nbsp;'+value.state+'</td></tr>'}
							</script>
						</table>
					</div>
					<input type="button"  class="button" value="删除" onclick="if(viewVariable.activity_index!=null)deleteActivityNode(viewVariable.activity_index,viewVariable.activity_value)">
					
					</td><td>
					
					当前可用gluster服务器节点列表
					<div  id="settingPools_div_list_table">
						<table id="gluster_sever_node_table">
							<script type="text/javascript">
								viewVariable.sever_node_chosen = null;
								viewVariable.setSeverNodeChosen=function(index){
									viewVariable.td_chosen(viewVariable.sever_node_chosen,index,(i)=>{return "sever_node_"+i;}) 
									viewVariable.sever_node_chosen=index; 
								}
								viewVariable.gluster_sever_node_table = (index,value)=>{return '<tr><td id="sever_node_'+index+'" onclick="viewVariable.setSeverNodeChosen('+index+')">'+value.ip +'&nbsp;'+value.state +'</td></tr>';}
							</script>
						</table>
					</div>
					<input type="button" class="button" value="存储节点验证" onclick="if(viewVariable.sever_node_chosen!=null)storageNodeCheck(sever_node_chosen)">
					
					</td><td>
					
					网内主机列表
					<div  id="settingPools_div_list_table">
						<table id="innet_node_table">
							<script type="text/javascript">
								viewVariable.innet_node_chosen = null;
								viewVariable.setInnetNodeChosen=function (index){
									viewVariable.td_chosen(viewVariable.innet_node_chosen,index,(i)=>{return "innet_node_"+i;}) 
									viewVariable.innet_node_chosen=index; 
								}
								viewVariable.innet_node_table=(index,value)=>{return '<tr><td id="innet_node_'+index+'" onclick="viewVariable.setInnetNodeChosen('+index+')">'+value.ip+'&nbsp;'+value.state+'</td></tr>';}
							</script>
						</table>
							</div>
							<input type="button" class="button" value="全选" onclick="innetHostSelectAll()">
							<input type="button" class="button" value="自动加入" onclick="innetHostAutoAdd()">
							</td></tr>
						</table>
					</div>
					
				
				<!-- 第3行，其他辅助按钮内容 -->
					<div id="settingPools_div_last"> 
					<div id="settingPools_div_last_table">
						<table>
							<tr><td id="settingPools_last_table"><input class="button" type="button" value="自动探测" onclick="button_scan_ip()"></td></tr>
							<tr><td id="settingPools_last_table"><input class="button" type="button" value="手动" onclick="button_manual()"></td></tr>
							<tr><td id="settingPools_last_table"><input class="button" type="button" value="文件导入" onclick=""></td></tr>
						</table>
					</div>
				</div>			
								
			</div>
		</div>
	</main>
	<!-- 引入页脚 -->
	<?php include './vice/footer.php'; ?>
</body>
</html>