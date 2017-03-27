<!-- 用于存储设备、目录管理 界面 -->
<?php include '../logic/start.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<?php include './vice/public_css_js.php'; ?>
	<title>集群配置</title>
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
                <div class="inner_box">
                    <div class="left_box">
                        <div class="text">
                            <text>当前可用gluster服务器节点列表</text>
                        </div>

                        <div class="card">
                            <div class="cardLine">a line</div>
                            <div class="cardLine">a line</div>
                            <div class="cardLine">a line</div>
                            <div class="cardLine">a line</div>
                        </div>

                    </div>
                    <div class="right_box">
                        <div class="text">
                            <text>输出目录列表</text>
                        </div>

                        <div class="card">
                            <div class="cardLine">a line</div>
                            <div class="cardLine">a line</div>
                            <div class="cardLine">a line</div>
                            <div class="cardLine">a line</div>
                        </div>
                    </div>
                </div>
                <div class="inner_box bottom_box">
                    <button class="button">察看/修改目录表</button>
                    <button class="button">察看/修改设备表</button>
                </div>
            </div>
		</div>
	</main>
	<!-- 引入页脚 -->
	<?php include './vice/footer.php'; ?>
</body>
</html>