<!-- 用于setting_pools.php集群配置中 手动 按钮的界面 -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">添加服务器节点网络地址</h4>
            </div>
            <form action="setting_pools.php" id="edit_ip_form" method="get">
                <div class="modal-body">
                    <div class="input-group">
                        <span class="input-group-addon">ip:</span>
                        <input class="form-control" type="text" id="edit_ip_text" name="edit_ip_1" value="" >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="submit" class="btn btn-primary" onclick="button_edit_ip()">确定</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>