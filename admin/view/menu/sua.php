<?php
if(isset($_POST['sua'])){
    $TieuDe = $_POST['TieuDe'];
    $TieuDeKhongDau = $_POST['TieuDeKhongDau'];
    $TomTat = $_POST['TomTat'];
    $id = trim($_POST['ID']);
    $Hinh ='';
    if ($_FILES['Hinh']['name']!=''){
        $Hinh = $_FILES['Hinh']['name'];
        move_uploaded_file($_FILES['Hinh']['tmp_name'],'../public/image/menu/'.$Hinh);
    }else{
        $Hinh->Hinh;
    }
    $created_at= strtotime(date_default_timezone_set('Asia/Ho_Chi_Minh'));
    $created_at = date_create($created_at);
    $created_at = date_format($created_at,'Y-m-d H:i:s');
    $c_admin->editMenu($id,$TieuDe,$TieuDeKhongDau,$Hinh,$TomTat);
}
var_dump($menubyid->Hinh);
?>
<div class="content">
    <h2>SỬA THỰC ĐơN</h2>
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        <input type="hidden" class="form-control" id="ID" placeholder="Tiêu đề" name="ID" value="<?php echo $menubyid->id ?>">
        <div class="form-group">
            <label for="inputName" class="col-sm-2 control-label">Tiêu đề</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputName" placeholder="Tiêu đề" name="TieuDe"
                       value="<?php echo $menubyid->TieuDe ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="inputName" class="col-sm-2 control-label">Tóm Tắt</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputName" placeholder="Mô tả" name="TomTat"
                value="<?php echo $menubyid->TomTat ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="inputName" class="col-sm-2 control-label">Tiêu Đề Không Dấu</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputName" placeholder="Mô tả" name="TieuDeKhongDau"
                value="<?php echo $menubyid->TieuDeKhongDau?>">
            </div>
        </div>

        <div class="form-group">
            <label for="inputName" class="col-sm-2 control-label">Ảnh</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="anh" placeholder="Ảnh" name="Hinh" v">
<!--                  <img src="../public/image/menu/--><?php //echo ($menubyid->Hinh !='')? $menubyid->Hinh:'000_Was3710642.jpg'?><!--" height="800" width="300" alt="">-->
                *Nhập lại hình ảnh
            </div>
        </div>
        <div class="form-group">
            <label for="inputName" class="col-sm-2 control-label">Ngày sửa bài</label>
            <div class="col-sm-10">
                <?php echo date('d/m/Y - H:i:s')?>
            </div>
        </div>


        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default" name="sua">Sửa thực đơn</button>
                <button type="reset" class="btn btn-primary" >Nhập lại</button>
                <button type="reset" class="btn btn-success"><a href="?view=baiviet/ds">Quay lại</a></button>
            </div>
        </div>

    </form>

</div>
