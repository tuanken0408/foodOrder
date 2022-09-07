<?php
session_start();
include "controllers/c_tintuc.php";
$c_tintuc = new C_tintuc();
$chitietOrder = $c_tintuc->chitietOrder();
$chitiet = $chitietOrder['chitietOrder'];
$HinhOrder = $c_tintuc->getHinhMenu();
$hinh = $HinhOrder['getHinhMenu'];
if(isset($_POST['sua'])){
    $HoTen = $_POST['hoten'];
    $SoLuong = $_POST['soluong'];
    $Mota = $_POST['mota'];
    $TongTien = $_POST['tongtien'];
    $id = trim($_GET['id']);
    $c_tintuc->updateOrder($id,$HoTen,$SoLuong,$TongTien,$Mota);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Anh Đức - Trang chủ</title>

    <!-- Bootstrap Core CSS -->
    <link href="public/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="public/css/shop-homepage.css" rel="stylesheet">
    <link href="public/css/my.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <![endif]-->

</head>

<body>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">CƠM TRƯA NGÂN LƯỢNG</a>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
<div class="space20"></div>
<div class="row main-left">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="col-md-4">
            <!--               <img src="http://localhost/foodorder2/public/image/menu/2a8f3c5ecab80fe656a9.jpg" class="img-responsive" alt="..." style="max-height: 600px; float: right">-->
            <!--               <img src="public/image/menu/--><?php //echo $image_menu->HinhMenu ?><!--" class="img-responsive" alt="..." style="max-height: 600px; float: right">-->
            <a href="#" id="pop">
                <img id="imageresource" src="public/image/menu/<?php echo $hinh->Hinh ?>" style="max-height: 600px; float: right">
            </a>

            <!-- Creates the bootstrap modal where the image will appear -->
            <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content" style="width: 620px">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        </div>
                        <div class="modal-body">
                            <img src="" id="imagepreview" style="max-height: 1000px;" >
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">X</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-5">
            <form method="post" action="#">
                <h2 style="font-weight: bold; color: red">ĐẶT CƠM NGÀY <?= date('d/m/Y'); ?></h2>
                <div class="form-group">
                    <label for="hoten">Họ và tên</label>
                    <input type="text" class="form-control" name="hoten" id="hoten" placeholder="Họ và Tên" value="<?= $chitiet->HoTen; ?>" required>
                </div>
                <div class="form-group">
                    <label for="soluong">Số suất đặt</label>
                    <input type="text" class="form-control" name="soluong" id="soluong" value="<?= $chitiet->SoLuong; ?>" required>
                </div>
                <div class="form-group">
                    <label for="soluong">Tổng tiền</label>
                    <p id="tongtien_display"></p>
                    <input type="hidden" class="form-control" name="tongtien" id="tongtien" value="<?= $chitiet->TongTien; ?>">
                </div>
                <div class="form-group">
                    <label for="mota">Ghi chú </label>
                    <textarea class="form-control" id="mota" name="mota" rows="9" value="<?= $chitiet->Mota; ?>"><?= $chitiet->Mota; ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="sua">Xác nhận</button>
            </form>
        </div>
        <div class="col-md-12" style="height: 50px"></div>
    </div>
    <div class="col-md-1"></div>
</div>
<hr>
<footer>
    <div class="row">
        <div class="col-md-12">
            <p>Ngân Lượng &copy; Ăn trưa 2022</p>
        </div>
    </div>
</footer>
<!-- end Footer -->
<!-- jQuery -->
<script src="public/js/jquery.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="public/js/bootstrap.min.js"></script>
<script src="public/js/my.js"></script>
<script>
    $(document).ready(function () {
        $("#btnSearch").click(function () {
            var keyword = $('#txtSearch').val();
            $.post("timkiem.php",{tukhoa:keyword},function (data) {
                $('#datasearch').html(data);
            })
        })

    })

    $('#soluong').keyup(function () {
        var soluong = $('#soluong').val();
        var data = soluong*30000;
        $('#tongtien').val(data);
        $('#tongtien_display').html(data.toLocaleString('vi-VN')+' đ');
    });

    $("#pop").on("click", function() {
        $('#imagepreview').attr('src', $('#imageresource').attr('src')); // here asign the image to the modal when the user click the enlarge link
        $('#imagemodal').modal('show'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
    });
</script>
</body>
</html>
