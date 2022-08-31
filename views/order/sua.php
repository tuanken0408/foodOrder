<?php


if(isset($_POST['sua'])){
    $HoTen = $_POST['HoTen'];
    $SoLuong = $_POST['SoLuong'];
    $Mota = $_POST['Mota'];
    $TongTien = $_POST['TongTien'];
    $id = trim($_POST['id']);

    $c_tintuc>editOrder($id,$HoTen,$SoLuong,$Mota);
}
?>
div class="row main-left">
<div class="col-md-1"></div>
<div class="col-md-10">
    <form method="post" action="#">
        <h2 style="font-weight: bold; color: red">ĐẶT CƠM NGÀY <?= date('d/m/Y'); ?></h2>
        <div class="form-group">
            <label for="hoten">Họ và tên</label>
            <input type="text" class="form-control" name="hoten" id="hoten" placeholder="Họ và Tên" value="<?= $chitietOrder->HoTen; ?>">
        </div>
        <div class="form-group">
            <label for="soluong">Số suất đặt</label>
            <input type="text" class="form-control" name="soluong" id="soluong" required>
        </div>
        <div class="form-group">
            <label for="soluong">Tổng tiền</label>
            <p id="tongtien_display"></p>
            <input type="hidden" class="form-control" name="tongtien" id="tongtien" >
        </div>
        <div class="form-group">
            <label for="mota">Ghi chú </label>
            <textarea class="form-control" id="mota" name="mota" rows="9" placeholder="đầy đủ thì ko cần ghi gì"></textarea>
        </div>
        <button type="submit" class="btn btn-primary" name="them">Xác nhận</button>
    </form>
    <div class="col-md-12" style="height: 50px"></div>
</div>
<div class="col-md-1"></div>
</div>
