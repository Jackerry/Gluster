<!-- 
    setting_pools的逻辑部分
    var list_table_left = new Array();
    var list_table_middle = new Array();
    var list_table_right = new Array();
    三个数组分分别是 当前gluster活动节点列表、当前可用gluster服务器节点列表、网内主机列表 显示的内容

    调用updateTable(array,id) array是要填入table的数组，id是要修改的table的id 有gluster_activity_node_table、gluster_sever_node_table、
    innet_node_table对应左边中间、右边的table
    
-->
<script type="text/javascript" src="jquery.js"></script> <!-- 用于文件上传 -->
<script type="text/javascript" src="ajaxfileupload.js"></script> <!-- 用于文件上传 -->
<script>
        //通过修改这三个数组的值来达到修改界面显示的效果
        var list_table_left = [];
        var list_table_middle = [];
        var list_table_right = [];

        //删除活动节点触发的函数，index为选中的节点对应数组的下标,前面已有判断，只有选中某一ip才会触发此函数
        function deleteActivityNode(index){
            console.log(index)
        }

        //储存节点验证按钮触发的事件，index为选中的节点对应数组的下标,前面已有判断，只有选中某一ip才会触发此函数
		//$_SESSION['gluster_ip']中，每个ip有3种状态，版本信息、no、unknown，为unknown的需要进行判断
        function storageNodeCheck(){
			
			document.getElementById("gluster_sever_node_table").innerHTML="正在验证中......";
			if (window.XMLHttpRequest)
            {
                // IE7+, Firefox, Chrome, Opera, Safari 浏览器执行的代码
                xmlhttp2=new XMLHttpRequest();
            }
            else
            {	
                //IE6, IE5 浏览器执行的代码
                xmlhttp2=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp2.onreadystatechange=function()
            {
                if (xmlhttp2.readyState==4 && xmlhttp2.status==200){}
				else{document.getElementById("gluster_sever_node_table").innerHTML=xmlhttp2.responseText;return;}

            }
            xmlhttp2.open("GET","../logic/check_result.php",true);
            xmlhttp2.send();
			
			
			
			document.getElementById("gluster_sever_node_table").innerHTML="正在验证中......";
			reflash_gluster_list();				

        }
		
		//刷新 当前可用gluster服务器节点列表 内容，从gluster_list_result.php中读取
		function reflash_gluster_list()
		{
			if (window.XMLHttpRequest)
            {
                // IE7+, Firefox, Chrome, Opera, Safari 浏览器执行的代码
                xmlhttp=new XMLHttpRequest();
            }
            else
            {	
                //IE6, IE5 浏览器执行的代码
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
                if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
					//从gluster_list_result.php文件中读取所输出的json格式内容，并转换成对象，赋给list_table_middle；updateTable是直接更新 当前可用gluster服务器节点列表 内容
                    list_table_middle = JSON.parse(xmlhttp.responseText);
                    updateTable(list_table_middle,"gluster_sever_node_table")
                    document.getElementById("ip_list_count").innerHTML=list_table_middle.length;
                }

            }
            xmlhttp.open("GET","../logic/gluster_list_result.php",true);
            xmlhttp.send();				
			
		}

        //网内主机列表的全部加入按钮触发的事件
        function innetHostAllAdd(){

        }

        //网内主机列表的自动加入按钮触发的事件
        function innetHostAutoAdd(){

        }

        // 自动探测 触发的函数
        function button_scan_ip()
        {
			document.getElementById("innet_node_table").innerHTML="正在探测中......";
			
			//运行db_empty_list.php页面，清空数据库中的表的内容
			if (window.XMLHttpRequest)
            {
                // IE7+, Firefox, Chrome, Opera, Safari 浏览器执行的代码
                xmlhttp2=new XMLHttpRequest();
            }
            else
            {	
                //IE6, IE5 浏览器执行的代码
                xmlhttp2=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp2.onreadystatechange=function()
            {
                if (xmlhttp2.readyState==4 && xmlhttp2.status==200){}
				else{document.getElementById("innet_node_table").innerHTML='db_empty_list.php';return;}

            }
            xmlhttp2.open("GET","../logic/db/db_empty_list.php",true);
            xmlhttp2.send();
						
			
			//运行nmap_result.php页面，查找ip
			if (window.XMLHttpRequest)
            {
                // IE7+, Firefox, Chrome, Opera, Safari 浏览器执行的代码
                xmlhttp2=new XMLHttpRequest();
            }
            else
            {	
                //IE6, IE5 浏览器执行的代码
                xmlhttp2=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp2.onreadystatechange=function()
            {
                if (xmlhttp2.readyState==4 && xmlhttp2.status==200){}
				else{document.getElementById("innet_node_table").innerHTML='nmap_result.php';return;}

            }
            xmlhttp2.open("GET","../logic/nmap_result.php",true);
            xmlhttp2.send();
			
			//将ip_list的内容放入数据库ip_list表中，原来数据库表中的内容清空
			reflash_db_ip_list();
			
			document.getElementById("innet_node_table").innerHTML="正在探测中......";
			reflash_ip_list();
        }

        //网内主机列表的自动加入按钮触发的事件
        function innetHostAutoAdd(){

        }
		
		//将ip_list的内容放入数据库ip_list表中，原来数据库表中的内容清空
		function reflash_db_ip_list(){
			
			//运行db/db_reflash_ip_list.php页面，清空数据库中ip_list表，插入新的数据
			if (window.XMLHttpRequest)
            {
                // IE7+, Firefox, Chrome, Opera, Safari 浏览器执行的代码
                xmlhttp3=new XMLHttpRequest();
            }
            else
            {	
                //IE6, IE5 浏览器执行的代码
                xmlhttp3=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp3.onreadystatechange=function()
            {
                if (xmlhttp3.readyState==4 && xmlhttp3.status==200){}
				else{document.getElementById("innet_node_table").innerHTML="db_reflash_ip_list.php";return;}

            }
            xmlhttp3.open("GET","../logic/db/db_reflash_ip_list.php",true);
            xmlhttp3.send();			
		}

        // 手动 界面中 确定 按钮 触发的函数
        function button_edit_ip()
        {
			str=document.getElementById("edit_ip_text").value;
			if (window.XMLHttpRequest)
            {
                // IE7+, Firefox, Chrome, Opera, Safari 浏览器执行的代码
                xmlhttp2=new XMLHttpRequest();
            }
            else
            {	
                //IE6, IE5 浏览器执行的代码
                xmlhttp2=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp2.onreadystatechange=function()
            {
                if (xmlhttp2.readyState==4 && xmlhttp2.status==200){}
				else{error_scan=xmlhttp2.responseText;document.getElementById("innet_node_table").innerHTML=error_scan;}

            }
            xmlhttp2.open("GET","../logic/edit_ip_nmap.php?edit_ip="+str,true);
            xmlhttp2.send();
					
			document.getElementById("innet_node_table").innerHTML="正在添加中......";
			reflash_ip_list();
			
        }

		//刷新 网内主机列表 内容，从ip_scan_result.php中读取
		function reflash_ip_list()
		{
			if (window.XMLHttpRequest)
            {
                // IE7+, Firefox, Chrome, Opera, Safari 浏览器执行的代码
                xmlhttp=new XMLHttpRequest();
            }
            else
            {	
                //IE6, IE5 浏览器执行的代码
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
                if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
					//从ip_scan_result.php文件中读取所输出的json格式内容，并转换成对象，赋给list_table_right；updateTable是直接更新 网内主机列表 内容
                    list_table_right = JSON.parse(xmlhttp.responseText);
                    updateTable(list_table_right,"innet_node_table")
                    document.getElementById("ip_list_count").innerHTML=list_table_right.length;
                }

            }
            xmlhttp.open("GET","../logic/ip_list_result.php",true);
            xmlhttp.send();	
					
			
		}

		//文件上传界面中 确定 按钮 触发的函数
        function FileUpload()
		{
			/*if (window.XMLHttpRequest)
            {
                // IE7+, Firefox, Chrome, Opera, Safari 浏览器执行的代码
                xmlhttp=new XMLHttpRequest();
            }
            else
            {	
                //IE6, IE5 浏览器执行的代码
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
                if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                }

            }
            xmlhttp.open("GET","../logic/upload_file.php",true);
            xmlhttp.send();	
			
			//将ip_list的内容放入数据库ip_list表中，原来数据库表中的内容清空
			reflash_db_ip_list();*/
			document.getElementById("ip_list_count").innerHTML="正在添加中......";
		} 

        //文件导入的还没写

</script>