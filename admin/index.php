<?php
ob_start();
session_start();
include "../models/database.php";
include "controller/c_admin.php";
$c_admin = new C_admin();
$noidung = $c_admin->getTheLoaiAd();
$theloai = $noidung['theloai'];
$noidung2 = $c_admin->getBaiVietAd();
$baiviet = $noidung2['baiviet'];
//print_r($baiviet);
$thanhphantrang = $noidung2['thanhphantrang'];
$noidung3 = $c_admin->getIDtoLoaitin();
$idLoaiTin = $noidung3['idLoaiTin'];
$noidung4 = $c_admin->getBaiVietbyID();
$list = $noidung4['listbyid'];
$noidung6 = $c_admin->getMenubyID();
$menubyid = $noidung6['menubyid'];

$noidung7 = $c_admin->getMenubyMaMenu();
$menubymamenu = $noidung7['menubymamenu'];

$noidung5 = $c_admin->getMenuAd();
$menu = $noidung5['menu'];

if (isset($_GET['confirm_finish'])){
    $c_admin->confirmFinish();
}
if (isset($_GET['confirm_finish_cancel'])){
    $c_admin->confirmFinishCancel();
}

if (isset($_GET['hienthi'])){
    $hienthi = $_GET['hienthi'];
}else{
    $hienthi = 15;
}

$staus = array(
    1 => "Đang đặt",
    2 => "Đã hoàn tất thanh toán",
    3 => "Đã chuyển khoản, chờ xác nhận",
    4 => "Đã hủy",
    5 => "Chưa thanh toán",
);

//print_r($list);


if (!isset( $_SESSION['id_user'])){
    header('location:../dangnhap.php');
}else{
    if (isset($_SESSION['role_user'])){
        $role = $_SESSION['role_user'];
        if ($role == '0'){
            echo "Bạn không đủ quyền truy cập vào trang này<br/>";
            echo "<a href='../index.php'>Về trang chủ</a>";
            exit();
        }
    }
}

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>ANHDUC - Admin</title>

    <!-- Bootstrap -->
    <link href="../public/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/adminstyle.css">
    <script src="ckeditor/ckeditor.js" type="text/javascript"></script>

    <script src="../public/js/jquery.js">sss</script>
    <script src="../public/js/bootstrap.min.js"></script>
    <script src="../public/js/my.js"></script>
    <style>
        @media (max-width: 480px) {
            .mobile-min-h {
                min-height: unset;
            }
        }

    </style>
</head>
<body>
<div class="content">
    <div><h3>Chào <?php echo $_SESSION['user_name'] ?> đến với trang Admin <a href="https://noithatlonghuyen.com/DatCom">B</a></h3> </div>
    <nav class="navbar navbar-default container col-md-2 mobile-min-h">
        <div class="row">
            <div class="container-fluid">

                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">MENU</a>
                </div>

            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <!--<li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>-->
                    <li>
                        <?php if ($menubymamenu->Status == 1){ ?>
                            <a href="?view=menu/ds&confirm_finish_cancel=<?=date('dmY')?>" >Admin Hủy Chốt cơm hôm nay <?php echo date('d - m - Y') ?></a>
                        <?php }else{ ?>
                            <a href="?view=menu/ds&confirm_finish=<?=date('dmY')?>" >Admin Chốt cơm hôm nay <?php echo date('d - m - Y') ?></a>
                        <?php } ?>
                    </li>
                    <li class="">
                        <a href="?view=menu/ds">Menu Đồ ăn</a>
                    </li>
                    <li class="">
                        <a href="?view=order/ds">Danh sách Order</a>
                    </li>
<!--                    <li class="">-->
<!--                        <a href="?view=theloai/ds">Thể loại</a>-->
<!--                    </li>-->
<!---->
<!--                    <li class="">-->
<!--                        <a href="?view=baiviet/ds">Tin tức</a>-->
<!--                    </li>-->
                    <li class="">
                        <a href="../dangxuat.php">Đăng Xuất</a>
                    </li>

                </ul>

            </div><!-- /.navbar-collapse -->
        </div>

    </nav>
    <div class="col-md-10">
        <?php
        if(isset($_GET['view'])){
            include_once "view/".$_GET['view'].".php";
        }
        else{

        }
        ?>
    </div>
</div>
<script>
    $('a.nav-link[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var targetId = e.target.getAttribute('href');
        history.replaceState(null, null, targetId);
    });
    var hash = window.location.hash;
    if (hash) {
        $('a.nav-link[href="' + hash + '"]').tab('show');
    }

    function confirm_finish(){
        if(confirm("Chốt cơm hôm nay") === true){
            window.location.href = '?view=menu/ds&confirm_finish=1';
            return true;
        }else{
            return false;
        }
    }
</script>
</body>
</html>