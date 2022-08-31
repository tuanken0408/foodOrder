<?php
include 'controllers/c_tintuc.php';
$c_tintuc = new C_tintuc();
if (isset($_POST['tukhoa'])){
    $key = $_POST['tukhoa'];
    $tintuc = $c_tintuc->timkiem($key);

        ?>
    <div>Tìm thấy <strong><?php echo count($tintuc)?></strong> nội dung cho <strong><?php echo $key?></strong></div>
        <div class="panel panel-default">

                <?php
                foreach ($tintuc as $tin) {
                    ?>
                    <div class="row-item row">
                        <div class="col-md-3">

                            <a href="chitiet.php?loai_tin=<?php echo $tin->ten_khong_dau ?>&id_tin=<?php echo $tin->id ?>">
                                <br>
                                <img width="200px" height="200px" class="img-responsive"
                                     src="public/image/tintuc/<?php echo $tin->Hinh ?>" alt="">
                            </a>
                        </div>

                        <div class="col-md-9">
                            <h3><?php echo $tin->TieuDe ?></h3>
                            <p><?php echo $tin->TomTat ?></p>
                            <a class="btn btn-primary"
                               href="chitiet.php?loai_tin=<?php echo $tin->ten_khong_dau ?>&id_tin=<?php echo $tin->id ?>">Xem chi tiết<span class="glyphicon glyphicon-chevron-right"></span></a>
                        </div>
                        <div class="break"></div>
                    </div>
                    <?php
                }
                ?>
            </div>

    <?php
    }


?>