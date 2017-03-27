<!-- 用于菜单栏 -->
<?php
	$menu_name = '顶层菜单';
	$menu_storage = 'menu_storage存储集群管理';
	$menu_volume = 'volume卷管理';
	$menu_user = 'user用户管理';
	$menu_geoReplication = 'geoReplication异地备份';
	$menu_monitor = 'monitor系统监控';
	$menu_troubleshooting = 'troubleshooting故障与恢复';
	$menu_initialInstallation = 'initialInstallation系统初始安装';
				
	$menu2_settingPools = 'settingPools集群配置';
	$menu2_deviceAndDirectory = 'deviceAndDirectory存储设备、目录管理';
	$menu2_manageVolume = 'manageVolume卷的配置';
	$menu2_addOrDeleteUser = 'addOrDeleteUser增加/删除用户';

?>

<!-- 第1个大菜单，存储集群管理 -->
<div class="panel panel-primary leftMenu">
	<div class="panel-heading" data-toggle="collapse" data-target="#menu_item_first_list_group" role="tab" >
		<h4 class="panel-title">
			<?php echo $menu_storage; ?>
			<span class="glyphicon glyphicon-chevron-down right"></span>
		</h4>
	</div>
	<div id="menu_item_first_list_group" class="panel-collapse collapse" role="tabpanel" aria-labelledby="collapseListGroupHeading2">
		<ul class="list-group">
			<!-- 第1个大菜单里的小菜单，集群配置 -->
			<li class="list-group-item">
					<a href="./setting_pools.php"><?php echo $menu2_settingPools; ?></a>
			</li>
			<!-- 第1个大菜单里的小菜单，存储设备、目录管理 -->
			<li class="list-group-item">
					<a href="./device_directory.php"><?php echo $menu2_deviceAndDirectory; ?></a>
			</li>
		</ul>
	</div>
</div>  

<!-- 第2个大菜单，卷管理 -->
<div class="panel panel-primary leftMenu">
	<div class="panel-heading" data-toggle="collapse" data-target="#menu_item_second_list_group" role="tab" >
		<h4 class="panel-title">
			<?php echo $menu_volume; ?>
			<span class="glyphicon glyphicon-chevron-down right"></span>
		</h4>
	</div>
	<div id="menu_item_second_list_group" class="panel-collapse collapse" role="tabpanel" aria-labelledby="collapseListGroupHeading2">
		<ul class="list-group">
			<!-- 第2个大菜单里的小菜单，卷的配置 -->
			<li class="list-group-item">
					<a href="./manage_volume.php"><?php echo $menu2_manageVolume; ?></a>
			</li>
		</ul>
	</div>
</div>  

<!-- 第3个大菜单，用户管理 -->
<div class="panel panel-primary leftMenu">
	<div class="panel-heading" data-toggle="collapse" data-target="#menu_item_third_list_group" role="tab" >
		<h4 class="panel-title">
			<?php echo $menu_user; ?>
			<span class="glyphicon glyphicon-chevron-down right"></span>
		</h4>
	</div>
	<div id="menu_item_third_list_group" class="panel-collapse collapse" role="tabpanel" aria-labelledby="collapseListGroupHeading2">
		<ul class="list-group">
			<!-- 第3个大菜单里的小菜单，增加/删除用户 -->
			<li class="list-group-item">
					<a href="./add_delete_user.php"><?php echo $menu2_addOrDeleteUser; ?></a>
			</li>
		</ul>
	</div>
</div>  

<!-- 第4个大菜单，异地备份 -->
<div class="panel panel-primary leftMenu">
	<div class="panel-heading" data-toggle="collapse" data-target="" role="tab" >
		<h4 class="panel-title">
			<a onclick="navigateTo('./geo-replication.php')" ><?php echo $menu_geoReplication; ?></a>
		</h4>
	</div>
</div> 

<!-- 第5个大菜单，系统监控 -->
<div class="panel panel-primary leftMenu">
	<div class="panel-heading" data-toggle="collapse" data-target="" role="tab" >
		<h4 class="panel-title">
			<a onclick="navigateTo('./system_monitor.php')" ><?php echo $menu_monitor; ?></a>
		</h4>
	</div>
</div> 


<!-- 第6个大菜单，故障与恢复 -->
<div class="panel panel-primary leftMenu">
	<div class="panel-heading" data-toggle="collapse" data-target="" role="tab" >
		<h4 class="panel-title">
			<a onclick="navigateTo('./troubleshooting.php')" ><?php echo $menu_troubleshooting; ?></a>
		</h4>
	</div>
</div> 

<!-- 第7个大菜单，系统初始安装 -->
<div class="panel panel-primary leftMenu">
	<div class="panel-heading" data-toggle="collapse" data-target="" role="tab" >
		<h4 class="panel-title">
			<a onclick="navigateTo('./initial_installation.php')"><?php echo $menu_initialInstallation; ?></a>
		</h4>
	</div>
</div> 
<script>
function navigateTo(pageUrl){
	window.location.href=pageUrl;
}
$(function(){
	$(".panel-heading").click(function(e){
		/*切换折叠指示图标*/
		$(this).find("span").toggleClass("glyphicon-chevron-down");
		$(this).find("span").toggleClass("glyphicon-chevron-up");
	});
});
</script>