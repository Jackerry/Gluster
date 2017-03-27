<!-- 
    setting_pools的逻辑部分
    var list_table_left = new Array();
    var list_table_middle = new Array();
    var list_table_right = new Array();
    三个数组分分别是 当前gluster活动节点列表、当前可用gluster服务器节点列表、网内主机列表 显示的内容

    调用updateTable(array,id) array是要填入table的数组，id是要修改的table的id 有gluster_activity_node_table、gluster_sever_node_table、
    innet_node_table对应左边中间、右边的table
    
-->

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
        function storageNodeCheck(index){

        }

        //网内主机裂变的全选按钮触发的事件
        function innetHostSelectAll(){

        }

        //网内主机裂变的自动加入按钮触发的事件
        function innetHostAutoAdd(){

        }

        // 自动探测 触发的函数
        function button_scan_ip(str)
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
                    list_table_right = JSON.parse(xmlhttp.responseText);
                    updateTable(list_table_right,"innet_node_table")
                    //
                }

            }
            xmlhttp.open("GET","../logic/ip_scan_result.php?q="+str,true);
            xmlhttp.send();
        }

        //下面辅助按钮 "手动" 触发的函数
        function button_manual(str){
           
        }

        //文件导入的还没写

</script>