<?php
session_start();
include 'controllers/c_tintuc.php';
$c_tintuc = new C_tintuc();
$tin = $c_tintuc->chitietTin();
$chitietTin = $tin['chitietTin'];
$comment = $tin['comment'];
$relatednews = $tin['relatednews'];
$tinnoibat = $tin['tinnoibat'];

if (isset($_POST['binhluan'])){
    if(isset($_SESSION['id_user'])){
        $id_user = $_SESSION['id_user'];
        $id_tin = $_POST['id_tin'];
        $noidung = $_POST['noidung'];
        $comment = $c_tintuc->themBinhluan($id_user,$id_tin,$noidung);
    }else{
        $_SESSION['chua_dang_nhap']="Vui lòng đăng nhập để bình luận";
    }


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

    <title>Anh Đức - Chi tiết</title>

    <!-- Bootstrap Core CSS -->
    <link href="public/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="public/css/shop-homepage.css" rel="stylesheet">
    <link href="public/css/my.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.public/js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<!-- Navigation -->
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
            <a class="navbar-brand" href="index.php"> Tin Tức</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="#">Giới thiệu</a>
                </li>
                <li>
                    <a href="#">Liên hệ</a>
                </li>
            </ul>

            <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>

            <ul class="nav navbar-nav pull-right">
                <?php
                if (isset($_SESSION['user_name'])){
                    ?>
                    <li>
                        <a>
                            <span class ="glyphicon glyphicon-user"></span>
                            <?php echo $_SESSION['user_name'] ?>
                        </a>
                    </li>
                    <li>
                        <a href="dangxuat.php">Đăng xuất</a>
                    </li>
                    <?php
                }else{
                    ?>
                    <li>
                        <a href="dangki.php">Đăng ký</a>
                    </li>
                    <li>
                        <a href="dangnhap.php">Đăng nhập</a>
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

<!-- Page Content -->
<div class="container">
    <div class="row">

        <!-- Blog Post Content Column -->
        <div class="col-lg-9">

            <!-- Blog Post -->

            <!-- Title -->
            <h1><?php echo $chitietTin->TieuDe ?></h1>

            <!-- Author -->
            <p class="lead">
                by <a href="#">Admin : CR</a>
            </p>

            <!-- Preview Image -->
            <img class="img-responsive" src="public/image/tintuc/<?php echo $chitietTin->Hinh ?>" alt="">

            <!-- Date/Time -->
            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $chitietTin->created_at ?></p>
            <hr>

            <!-- Post Content -->
            <p class="lead"><?php echo $chitietTin->TomTat?></p>
            <p><?php echo $chitietTin->NoiDung?></p>
            <hr>

            <!-- Blog Comments -->
            <?php
            if(isset($_SESSION['chua_dang_nhap'])){
                echo "<div class='alert alert-danger'>.$_SESSION[chua_dang_nhap].</div>";
            }
            ?>

            <!-- Comments Form -->
            <div class="well">
                <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
                <form role="form" method="post" action="#">
                    <input type="hidden" name="id_tin" value="<?php echo $chitietTin->id?>">
                    <div class="form-group">
                        <textarea class="form-control" rows="3" name="noidung"></textarea>
                    </div>
                    <button type="submit" name="binhluan" class="btn btn-primary">Gửi</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->

            <!-- Comment -->
            <?php
            foreach ($comment as $cmt){
                ?>
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="ảnh" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Tên USER
                            <small><?php echo $cmt->created_at ?></small>
                        </h4>
                        <?php echo $cmt->NoiDung ?>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>



        <!-- Blog Sidebar Widgets Column -->
        <div class="col-md-3">

            <div class="panel panel-default">
                <div class="panel-heading"><b>Tin liên quan</b></div>
                <div class="panel-body">
                <?php
                foreach ($relatednews as $related){
                    ?>
                    <!-- item -->
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-5">
                            <a href="chitiet.php?loai_tin=<?php echo $related->TenKhongDau?>&alias=<?php echo $related->TieuDeKhongDau?>&id_tin=<?php echo $related->id ?>">
                                <img class="img-responsive" src="public/image/tintuc/<?php echo $related->Hinh ?>" alt="">
                            </a>
                        </div>
                        <div class="col-md-7">
                            <a href="chitiet.php?loai_tin=<?php echo $related->TenKhongDau?>&alias=<?php echo $related->TieuDeKhongDau?>&id_tin=<?php echo $related->id ?>"><b><?php echo $related->TieuDe?></b></a>
                        </div>
<!--                        <p>--><?php //echo $related->TomTat?><!--</p>-->
                        <div class="break"></div>
                    </div>
                    <!-- end item -->
                    <?php
                }
                ?>



                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading"><b>Tin nổi bật</b></div>
                <div class="panel-body">
                <?php
                foreach ($tinnoibat as $noibat){
                    ?>
                    <!-- item -->
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-5">
                            <a href="chitiet.php?loai_tin=<?php echo $noibat->TenKhongDau?>&alias=<?php echo $noibat->TieuDeKhongDau?>&id_tin=<?php echo $noibat->id ?>">
                                <img class="img-responsive" src="public/image/tintuc/<?php echo $noibat->Hinh?>" alt="">
                            </a>
                        </div>
                        <div class="col-md-7">
                            <a href="chitiet.php?loai_tin=<?php echo $noibat->TenKhongDau?>&alias=<?php echo $noibat->TieuDeKhongDau?>&id_tin=<?php echo $noibat->id ?>"><b><?php echo $noibat->TieuDe?></b></a>
                        </div>
                        <div class="break"></div>
                    </div>
                    <!-- end item -->

                    <?php
                }
                ?>


                </div>
            </div>

        </div>

    </div>
    <!-- /.row -->
</div>
<!-- end Page Content -->

<!-- Footer -->
<hr>
<footer>
    <div class="row">
        <div class="col-md-12">
            <p>Copyright &copy; Your Website 2014</p>
        </div>
    </div>
</footer>
<!-- end Footer -->
<!-- jQuery -->
<script src="public/js/jquery.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="public/js/bootstrap.min.js"></script>
<script src="public/js/my.js"></script>

</body>

</html>
