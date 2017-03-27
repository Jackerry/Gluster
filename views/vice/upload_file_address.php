<!-- 用于setting_pools.php集群配置中 手动 按钮的界面 -->
<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">添加服务器节点网络地址</h4>
            </div>
            <form action="../logic/upload_file.php" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="input-group">
                        <input type="file" name="file" id="file">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="submit" class="btn btn-primary" onClick="return FileUpload();">提交</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>