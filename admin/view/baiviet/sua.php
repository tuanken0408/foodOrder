<?php
if(isset($_POST['sua'])){
    $idLoaiTin = $_POST['idLoaiTin'];
    $TieuDe = $_POST['TieuDe'];
    $TieuDeKhongDau = $_POST['TieuDeKhongDau'];
    $TomTat = $_POST['TomTat'];
    $NoiDung = htmlentities($_POST['NoiDung']);
    $Hinh ='';
    if ($_FILES['Hinh']['name']!=''){
        $Hinh = $_FILES['Hinh']['name'];
        move_uploaded_file($_FILES['Hinh']['tmp_name'],'../public/image/tintuc/'.$Hinh);
    }else{
        $Hinh->Hinh;
    }
    $created_at= strtotime(date_default_timezone_set('Asia/Ho_Chi_Minh'));
    $created_at = date_create($created_at);
    $created_at = date_format($created_at,'Y-m-d H:i:s');
    $c_admin->editBaiviet($idLoaiTin,$TieuDe,$TieuDeKhongDau,$Hinh,$NoiDung,$TomTat);
}

?>
<div class="content">
    <h2>SỬA BÀI VIẾT</h2>
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="inputName" class="col-sm-2 control-label">Loại Tin</label>
            <div class="col-sm-10">
                <select class="form-control" name="idLoaiTin">
                    <option value="">---Chọn Loại Tin---</option>
                    <?php foreach ($idLoaiTin as $lt ) {
                        $sl =  ($lt->id==$Ten)? 'selected' :'' ;
                        ?>
                        <option <?php echo $sl?>value="<?php echo $lt->id?>"><?php echo $lt->Ten?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="inputName" class="col-sm-2 control-label">Tiêu đề</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputName" placeholder="Tiêu đề" name="TieuDe"
                       value="<?php echo $list->TieuDe ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="inputName" class="col-sm-2 control-label">Tóm Tắt</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputName" placeholder="Mô tả" name="TomTat"
                value="<?php echo $list->TomTat ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="inputName" class="col-sm-2 control-label">Tiêu Đề Không Dấu</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputName" placeholder="Mô tả" name="TieuDeKhongDau"
                value="<?php echo $list->TieuDeKhongDau?>">
            </div>
        </div>
        <div class="form-group">
            <label for="inputName" class="col-sm-2 control-label">Nội dung</label>
            <div class="col-sm-10">
                <textarea name="NoiDung" id="NoiDung"><?php echo $list->NoiDung?></textarea>
                <script>CKEDITOR.replace('NoiDung')</script>
            </div>
        </div>
        <div class="form-group">
            <label for="inputName" class="col-sm-2 control-label">Ảnh</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="anh" placeholder="Ảnh" name="Hinh">
                  <img src="../public/images/tintuc/<?php echo ($list->Hinh !='')? $list->Hinh:'000_Was3710642.jpg'?>" height="200" width="200" alt="">
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
                <button type="submit" class="btn btn-default" name="sua">Sửa bài viết</button>
                <button type="reset" class="btn btn-primary" >Nhập lại</button>
                <button type="reset" class="btn btn-success"><a href="?view=baiviet/ds">Quay lại</a></button>
            </div>
        </div>

    </form>

</div>
