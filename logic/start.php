<?php
//初始start，用于设置初始的session等
session_start();

	//默认起始ip与结束ip
	$_SESSION['default_start_ip']="192.168.150.1";
	$_SESSION['default_end_ip']="192.168.150.2";

	//获取 网络设置 界面中起始ip和结束ip内容
	if(isset($_GET['start_ip_1'])){
		$start = $_GET['start_ip_1'];
		$end = $_GET['end_ip_1'];
		
		$_SESSION['start_ip'] = $start;
		$_SESSION['end_ip'] = $end;
		
	}
	
	
	//更新ip_list列表，即网内主机列表，若是列表中有ip，就刷新状态，若没有就添加（来源：自动探测，手动，文件导入）
	function update_ip_list($addr,$state){
		if($addr==null)
			return;
		if(isset($_SESSION['ip_list'])){
			$array=$_SESSION['ip_list'];
			for( $i=0; $i<count($array); $i++){
				if($array[$i][0]==$addr){
					$array[$i][1]=$state;
					$_SESSION['ip_list']=$array;
					return;
				}
			}
			array_push($_SESSION['ip_list'],array($addr,$state));
		}
		else{
			$_SESSION['ip_list']=array(array($addr,$state));
		}
	}	
	
	
	//更新gluster_list列表，即网内主机列表，若是列表中有ip，就刷新状态，若没有就添加（来源：网内主机列表内容）
	function update_gluster_list($addr,$state){
		if($addr==null)
			return;
		if(isset($_SESSION['gluster_list'])){
			$array=$_SESSION['gluster_list'];
			for( $i=0; $i<count($array); $i++){
				if($array[$i][0]==$addr){
					$array[$i][1]=$state;
					$_SESSION['gluster_list']=$array;
					return;
				}
			}
			array_push($_SESSION['gluster_list'],array($addr,$state));
		}
		else{
			$_SESSION['gluster_list']=array(array($addr,$state));
		}
	}
	
	//更新gluster_list列表，即网内主机列表，若是列表中有ip，就刷新状态，若没有就添加（来源：网内主机列表内容）
	function update_current_list($addr,$state){
		if($addr==null)
			return;
		if(isset($_SESSION['current_list'])){
			$array=$_SESSION['current_list'];
			for( $i=0; $i<count($array); $i++){
				if($array[$i][0]==$addr){
					$array[$i][1]=$state;
					$_SESSION['current_list']=$array;
					return;
				}
			}
			array_push($_SESSION['current_list'],array($addr,$state));
		}
		else{
			$_SESSION['current_list']=array(array($addr,$state));
		}
	}
	
	
	//如果$_SESSION['ip_list']为空，即从数据库中加载，一般第一次加载页面时使用
	if(!isset($_SESSION['ip_list'])){
		$dbhost = 'localhost:3306';  //mysql服务器主机地址
		$dbuser = 'zcp';      //mysql用户名
		$dbpass = '123456';//mysql用户名密码
		//连接数据库
		$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
		if(! $conn )
		{
			die('Could not connect: ' . mysqli_connect_errno($conn));
		}
		//echo 'Connected successfully';
		//进入gluster数据库
		$sql = 'USE gluster;';
		$retval = mysqli_query( $conn,$sql  );
		if(! $retval )
		{
		  die('failure: ' . mysqli_error($conn));
		}
		//从ip_list列表中读数据
		$sql = 'SELECT * FROM `ip_list`;';
		$retval = mysqli_query( $conn,$sql  );
		if(! $retval )
		{
		  die('failure: ' . mysqli_error($conn));
		}
		// 关联数组
		$row=mysqli_fetch_all($retval,MYSQLI_ASSOC);
		//echo count($row);
		for($i=0; $i<count($row); $i++)
			update_ip_list($row[$i]['ip'],$row[$i]['status']);	
			
		
		//从gluster_list列表中读数据
		$sql = 'SELECT * FROM `gluster_list`;';
		$retval = mysqli_query( $conn,$sql  );
		if(! $retval )
		{
		  die('failure: ' . mysqli_error($conn));
		}
		// 关联数组
		$row=mysqli_fetch_all($retval,MYSQLI_ASSOC);
		//echo count($row);
		for($i=0; $i<count($row); $i++)
			update_gluster_list($row[$i]['ip'],$row[$i]['status']);	
			
		//从current_list列表中读数据
		$sql = 'SELECT * FROM `current_list`;';
		$retval = mysqli_query( $conn,$sql  );
		if(! $retval )
		{
		  die('failure: ' . mysqli_error($conn));
		}
		// 关联数组
		$row=mysqli_fetch_all($retval,MYSQLI_ASSOC);
		//echo count($row);
		for($i=0; $i<count($row); $i++)
			update_current_list($row[$i]['ip'],$row[$i]['status']);		
		
		
			
		mysqli_close($conn);

	}
	
	
	
	
	
	//
	/*if(isset($_POST['edit_ip_1'])){
		echo $_POST['edit_ip_1'].",".$_SESSION['edit_ip_new'].'::';
		$edit_ip = $_POST['edit_ip_1'];
		$_SESSION['edit_ip'] = $edit_ip;	
		$_SESSION['edit_ip_new'] = "true";	
		echo $_POST['edit_ip_1'].",".$_SESSION['edit_ip_new'];
		//update_ip_list($edit_ip,"unknown");	
	}*/
	
	//有nmap工具的linux系统
	$_SESSION['nmap_ip']='192.168.150.76';//'172.30.103.194'
	
	
	$_SESSION['gluster_list']=array();
	array_push($_SESSION['gluster_list'],array("192.168.150.76","unknown"));
	array_push($_SESSION['gluster_list'],array("192.168.150.49","unknown"));
	array_push($_SESSION['gluster_list'],array("192.168.150.50","unknown"));
	
	$_SESSION['gluster_list_auth']=array();
	array_push($_SESSION['gluster_list_auth'],array("192.168.150.76","root","123456"));
	array_push($_SESSION['gluster_list_auth'],array("192.168.150.49","unknown","unknown"));
	array_push($_SESSION['gluster_list_auth'],array("192.168.150.50","root","123456"));
	
?>