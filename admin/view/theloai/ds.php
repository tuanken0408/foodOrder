<?php
/**
 * Created by PhpStorm.
 * User: buian
 * Date: 10/22/2017
 * Time: 1:49 PM
 */
?>
<div class="noidung">
    <h2>Danh sách thể loại</h2>
    <a href="?view=theloai/them" class="btn btn-primary">Thêm mới thể loại</a>
    <table class="table table-bordered">
        <tr>
            <td>STT</td>
            <td>Loại Tin</td>
            <td>Tên Không Dấu</td>
            <td>Thể Loại Tin </td>
            <td>Tác vụ</td>
        </tr>
        <?php
        $stt=1;
        foreach ($theloai as $tl){
            ?>
            <tr>
                <td><?php echo $stt ?></td>
                <td><?php echo $tl->Ten ?></td>
                <td><?php echo $tl->TenKhongDau ?></td>
                <td><?php echo $tl->tencha?></td>
                <td>
                    <a href="?view=theloai/sua&id= <?php echo $tl ->id?>" class="btn btn-primary">Sửa</a>
                    <a href="?view=theloai/ds&id= <?php echo $tl ->id?>" class="btn btn-danger">Xóa</a>
                </td>
            </tr>
            <?php $stt ++; }?>
    </table>
</div>

