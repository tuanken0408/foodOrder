<?php
if(isset($_POST['them'])){
    $TieuDe = $_POST['TieuDe'];
    $TieuDeKhongDau = $_POST['TieuDeKhongDau'];
    $TomTat = $_POST['TomTat'];
    $MaMenu = $_POST['MaMenu'];
    $Hinh ='';
    if ($_FILES['Hinh']['name']!=''){
        $Hinh = $_FILES['Hinh']['name'];
        move_uploaded_file($_FILES['Hinh']['tmp_name'],'../public/image/menu/'.$Hinh);
    }else{
        $Hinh='';
    }
    $created_at= strtotime(date_default_timezone_set('Asia/Ho_Chi_Minh'));
    $created_at = date_create($created_at);
    $created_at = date_format($created_at,'Y-m-d H:i:s');
    $c_admin->addMenu($TieuDe,$TieuDeKhongDau,$MaMenu,$Hinh,$TomTat);
}

?>
<div class="content">
    <h2>THÊM MỚI ThỰC ĐƠN</h2>
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="inputName" class="col-sm-2 control-label">Tiêu đề</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputName" placeholder="Tiêu đề" name="TieuDe">
            </div>
        </div>
        <div class="form-group">
            <label for="inputName" class="col-sm-2 control-label">Tóm Tắt</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputName" placeholder="Mô tả" name="TomTat">
            </div>
        </div>
        <div class="form-group">
            <label for="inputName" class="col-sm-2 control-label">Tiêu Đề Không Dấu</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputName" placeholder="Mô tả" name="TieuDeKhongDau">
            </div>
        </div>
        <div class="form-group">
            <label for="inputName" class="col-sm-2 control-label">Mã menu</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputName" placeholder="Mô tả" name="MaMenu" value="<?= date('dmY'); ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="inputName" class="col-sm-2 control-label">Ảnh</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="anh" placeholder="Ảnh" name="Hinh">
              <!--  <img src="../images2/ --><?php //echo isset($anh)? $anh: 'noimg.png'?><!--" alt=""> -->
            </div>
        </div>
        <div class="form-group">
            <label for="inputName" class="col-sm-2 control-label">Ngày đặt/ Ngày tạo</label>
            <div class="col-sm-10">
                <?php echo date('d/m/Y - H:i:s')?>
            </div>
        </div>
        

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default" name="them">Thêm mới thực đơn</button>
                <button type="reset" class="btn btn-primary" >Nhập lại</button>
                <button type="reset" class="btn btn-success"><a href="?view=baiviet/ds">Quay lại</a></button>
            </div>
        </div>

    </form>

</div>
