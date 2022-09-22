<?php
if(isset($_GET['view']) && $_GET['view'] == 'order/sua'){
    include_once "views/".$_GET['view'].".php";
}else{
session_start();
include "controllers/c_tintuc.php";
$c_tintuc = new C_tintuc();
$noi_dung = $c_tintuc->index();
$slide = $noi_dung['slide'];
$menu = $noi_dung['menu'];
$image_menu = $noi_dung['image'];

if ($image_menu->HinhStatus == 1){
    $chot = true;
}else{
    $chot = false;
}

$hienthi = 4;
//    UPDATE `order_user` SET `Status_od`=2 WHERE `Status_od`=3 AND `MaMenu`= '14092022'
//    UPDATE `order_user` SET `Status_od`=5 WHERE `Status_od`=1 AND `MaMenu`= '14092022'

$staus = array(
        1 => "Đang đặt",
        2 => "Đã hoàn tất thanh toán",
        3 => "Đã chuyển khoản, chờ xác nhận",
        4 => "Đã hủy",
        5 => "Chưa thanh toán",
);

if (isset($_GET['cancel'])){
    $chitietOrder = $c_tintuc->Cancel();
}else if (isset($_GET['success_ck'])){
    $success = $c_tintuc->Success();
}
if(isset($_POST['them'])){
    $HoTen = $_POST['hoten'];
    $SoLuong = $_POST['soluong'];
    $TongTien = $_POST['tongtien'];
    $MoTa = $_POST['mota'];
    $Staus = 1;

    $created_at= strtotime(date_default_timezone_set('Asia/Ho_Chi_Minh'));
    $created_at = date_create($created_at);
    $created_at = date_format($created_at,'Y-m-d H:i:s');
    $c_tintuc->addOrder($HoTen,$SoLuong,$TongTien,$MoTa,$Staus);
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

    <title> Đặt cơm - Ngân Lượng</title>
    <link rel="icon" type="image/x-icon" href="public/image/favicon.ico">
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

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


            <ul class="nav navbar-nav pull-right">
                <?php
                if (isset($_SESSION['user_name'])){
                    ?>
                    <li>
                        <a href="https://noithatlonghuyen.com/DatCom/admin/">
                            <span class ="glyphicon glyphicon-user"></span>
                            <?php echo $_SESSION['user_name'] ?>
                        </a>
                    </li>
                    <li>
                        <a href="dangxuat.php">Đăng xuất</a>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
    <div class="space20"></div>
    <div class="row main-left">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <?php
            if (isset($_SESSION['user_error']) && isset($_GET['success']) ){
                echo '<div class="alert alert-danger">'.$_SESSION['user_error'].'</div>';
            }
            if (isset($_SESSION['them_win']) && isset($_GET['success'])){
                echo '<div class="alert alert-success">'.$_SESSION['them_win'].'</div>';
            }
            if (isset($_SESSION['sua_win']) && isset($_GET['success'])){
                echo '<div class="alert alert-success">'.$_SESSION['sua_win'].'</div>';
            }

            if (isset($_SESSION['sua_win'])){
                unset($_SESSION['sua_win']);
            }
            ?>
            <div class="col-md-4">
                <!--               <img src="http://localhost/foodorder2/public/image/menu/2a8f3c5ecab80fe656a9.jpg" class="img-responsive" alt="..." style="max-height: 600px; float: right">-->
                <!--               <img src="public/image/menu/--><?php //echo $image_menu->HinhMenu ?><!--" class="img-responsive" alt="..." style="max-height: 600px; float: right">-->
                <a href="#" id="pop">
                    <img id="imageresource" src="public/image/menu/<?php echo $image_menu->HinhMenu ?>" style="max-height: 600px; float: right">
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
                    <h2 style="font-weight: bold; color: red">ĐẶT CƠM NGÀY <?= date('d/m/Y'); ?> (<span id="demo_timer">10h30</span>)</h2>
                    <blockquote class="font12">
                        <h5 class="mrtop0 bold blueFont"><i class="glyphicon glyphicon-info-sign"></i> Lưu ý:</h5>
                        <h5>- Văn minh lịch sự, không sửa hàng của đồng nghiệp.</h5>
                        <h5>- Thời hạn đăng ký đến 10h40 hằng ngày.</h5>
                        <h5><strong style="color: red;">STK Nhận tiền: 19036581222012 - Tech - BUI ANH DUC or <a
                                        href="#" id="pop2" data-src="public/image/QR.jpg" >Quét mã QR</a></strong></h5>

<!--                        <a href="#" id="pop">-->
<!--                            <img id="imageresource" src="public/image/menu/--><?php //echo $image_menu->HinhMenu ?><!--" style="max-height: 600px; float: right">-->
<!--                        </a>-->
<!---->
                        <!-- Creates the bootstrap modal where the image will appear -->
                        <div class="modal fade" id="imagemodal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content" style="width: 550px">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="" id="priview2" style="max-height: 1000px;" >
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">X</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </blockquote>
                    <div class="form-group">
                        <label for="hoten">Họ và tên</label>
                        <input type="text" class="form-control" name="hoten" id="hoten" placeholder="Họ và Tên" required>
                    </div>
                    <div class="form-group">
                        <label for="soluong">Số suất đặt</label>
                        <input type="text" class="form-control" name="soluong" id="soluong" required>
                    </div>
                    <div class="form-group">
                        <label for="soluong">Tổng tiền</label>
                        <p id="tongtien_display" style="color: red; font-weight: bold"></p>
                        <input type="hidden" class="form-control" name="tongtien" id="tongtien" >
                    </div>
                    <div class="form-group">
                        <label for="mota">Ghi chú </label>
                        <textarea class="form-control" id="mota" name="mota" rows="7" placeholder="đầy đủ thì ko cần ghi gì"></textarea>
                    </div>
                    <!--                   <div class="form-group">-->
                    <!--                       <label for="soluong">Bonus</label>-->
                    <!--                       <input type="text" class="form-control" name="bonus" id="bonus" placeholder="1">-->
                    <!--                   </div>-->
                    <?php if ($chot){ ?>
                        <button class="btn btn-primary" disabled>Đã chốt cơm</button>

                    <?php }else{ ?>
                        <button type="submit" class="btn btn-primary" name="them">Xác nhận</button>

                    <?php } ?>
                    <a href="#list_user" class="btn btn-success">Danh sách order hôm nay</a>
                </form>
            </div>
            <div class="col-md-12" style="height: 50px"></div>
            <div style="clear:both">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <?php
                    $date_arr = array();
                    for ($i = 0; $i<$hienthi; $i++ ){
                        $key = date('dmY', strtotime('-'.$i.' days'));
                        $date_arr[$key] = date('d/m/Y', strtotime('-'.$i.' days'));
                    }
//                    $date_arr['07092022'] = '07/09/2022';
                    foreach ($date_arr as $drk => $drv ){ ?>
                        <li class="nav-item <?php if ($drk == date('dmY')){ echo 'active';} ?>">
                            <a class="nav-link" id="<?= $drk ?>-tab" data-toggle="tab" href="#<?= $drk ?>" role="tab" aria-controls="<?= $drk ?>" aria-selected="true"><?= $drv; ?><?php if($drk == '20092022'){echo ' <span style="color:red; font-weight: bold;">(3)</span>';} ?></a>
                        </li>
                    <?php }
                    ?>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <?php
                    $tt = 1;
                    foreach ($date_arr as $drk => $drv ){
                        $noi_dung_user = $c_tintuc->index2($drk);
                        $user = $noi_dung_user['user']; ?>
                        <div class="tab-pane <?php if ($drk == date('dmY')){ echo 'active';} ?>" id="<?= $drk ?>" role="tabpanel" aria-labelledby="<?= $drk ?>-tab">
                            <table class="table table-bordered" >
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Họ Tên</th>
                                    <th scope="col">Số suất đặt</th>
                                    <th scope="col">Ghi chú</th>
                                    <th scope="col">Tổng tiền</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Thao tác</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $t = 1;
                                $t_TongTien = 0;
                                $t_SoLuong = 0;
                                if (count($user) > 0){
                                    foreach ($user as $u){  ?>
                                        <tr>
                                            <th scope="row"><?= $t ?></th>
                                            <td><?= $u->HoTen; ?></td>
                                            <td><?= $u->SoLuong; ?></td>
                                            <td><?= $u->Mota; ?></td>
                                            <td><?= number_format($u->TongTien, 0, '.', ','); ?> đ</td>
                                            <td>

<!--                                                1 => "Đang đặt",-->
<!--                                                2 => "Đã hoàn tất thanh toán",-->
<!--                                                3 => "Đã chuyển khoản, chờ xác nhận",-->
<!--                                                4 => "Đã hủy",-->
<!--                                                5 => "Chưa thanh toán",-->
                                                <?php if ($chot && $tt == 1){ ?>
                                                    <span class="label label-default">Đã chốt cơm</span>
                                                <?php } ?>
                                                <?php if ($u->Status_od == 1): ?>
                                                    <span class="label label-primary"><?= $staus[$u->Status_od]; ?></span>
                                                <?php elseif ($u->Status_od == 4): ?>
                                                    <span class="label label-danger"><?= $staus[$u->Status_od]; ?></span>
                                                <?php elseif ($u->Status_od == 3): ?>
                                                    <span class="label label-warning"><?= $staus[$u->Status_od]; ?></span>
                                                <?php elseif ($u->Status_od == 2): ?>
                                                    <span class="label label-success"><?= $staus[$u->Status_od]; ?></span>
                                                <?php elseif ($u->Status_od == 5): ?>
                                                    <span class="label label-danger"><?= $staus[$u->Status_od]; ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($u->Status_od == 1 && !$chot){ ?>
                                                    <a href="?view=order/sua&id=<?php echo $u->id?>" class="label label-primary">Sửa</a>
                                                <?php } ?>

                                                <?php if ($u->Status_od == 4 && !$chot): ?>
                                                    <a href="index.php" class="label label-primary">Đặt lại</a>
                                                <?php elseif ($u->Status_od == 1 && !$chot): ?>
                                                    <a  class="label label-danger" title="Hủy ko đặt nữa" Onclick="confirm_delete('<?= $u->HoTen; ?>','<?= $u->id; ?>')">Hủy</a>
                                                <?php endif; ?>


                                                <?php if ($u->Status_od == 3): ?>
                                                    <!--ẩn button hủy-->
                                                <?php elseif ($u->Status_od == 1 || $u->Status_od == 5): ?>
                                                    <a class="label label-warning" title="Ai đã chuyển khoản cho em thì submit button này để e check" Onclick="confirm_success('<?= $u->HoTen; ?>','<?= $u->id; ?>')">Tôi đã chuyển tiền</a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <?php $t+=1; $t_TongTien = $t_TongTien + $u->TongTien; $t_SoLuong = $t_SoLuong + $u->SoLuong; } ?>
                                    <tr>
                                        <td></td>
                                        <td><strong>Tổng số suất</strong></td>
                                        <td><strong><?= $t_SoLuong; ?></strong></td>
                                        <td><strong>Tổng tiền</strong></td>
                                        <td><strong><?= number_format($t_TongTien, 0, '.', ','); ?> đ</strong></td>
                                    </tr>
                                <?php }else{ ?>
                                    <tr><td colspan="7">Không có dữ liệu của ngày này</td></tr>
                                <?php }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    <?php $tt+=1; }
                    ?>
                </div>
            </div>
            <div id="list_user" class="col-md-12" style="height: 50px"></div>
        </div>
        <div class="col-md-1"></div>
    </div>

<!-- Footer -->
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
    function confirm_delete(name, id){
        if(confirm("Bạn là" + " " +name+ "? " + "Bạn có muốn hủy suất cơm này không ?") === true){
            window.location.href = '?cancel='+id;
            return true;
        }else{
            return false;
        }
    }
    function confirm_success(name,id){
        if(confirm("Bạn là" + " " +name+ "? " + "Bạn đã chuyển khoản cho Đức BA rồi đúng không ?") === true){
            window.location.href = '?success_ck='+id;
            return true;
        }else{
            return false;
        }
    }
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
    $("#pop2").on("click", function() {
        $('#priview2').attr('src', $('#pop2').attr('data-src')); // here asign the image to the modal when the user click the enlarge link
        $('#imagemodal2').modal('show'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
    });
</script>
</body>

</html>
<?php }

