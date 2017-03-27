<!-- 用于setting_pools.php集群配置中 网络设置 按钮的界面 -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">服务器节点网络地址范围</h4>
            </div>
            <form action="setting_pools.php" method="get">
                <div class="modal-body">
                    <div class="input-group">
                        <span class="input-group-addon">start</span>
                        <input class="form-control" type="text" id="start_ip_text" name="start_ip_1" value="<?php if(isset($_SESSION['start_ip'])){echo $_SESSION['start_ip'];}else echo $_SESSION['default_start_ip'];?>" >
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-addon">end</span>
                        <input class="form-control" type="text" id="end_ip_text" name="end_ip_1" value="<?php if(isset($_SESSION['end_ip'])){echo $_SESSION['end_ip'];}else echo $_SESSION['default_start_ip'];?>" >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="submit" class="btn btn-primary">确定</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>