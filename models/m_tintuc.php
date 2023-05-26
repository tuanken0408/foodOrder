<?php
/**
 * Created by PhpStorm.
 * User: buian
 * Date: 10/19/2017
 * Time: 8:48 AM
 */
include 'database.php';
class M_tintuc extends database{
    public function getSlide(){
        $sql = "SELECT *FROM slide";
        $this ->setQuery($sql);
        return $this->loadAllRows();
    }
    public function getMenu(){
        $sql = "SELECT tl.*,GROUP_CONCAT(DISTINCT lt.id,':',lt.Ten,':',lt.TenKhongDau) AS LoaiTin,
        tt.id as idTin, tt.TieuDe as TieuDeTin, tt.Hinh as HinhTin, tt.TomTat as TomTatTin, tt.TieuDeKhongDau as TieuDeTinKhongDau
        FROM theloai tl 
        INNER JOIN loaitin lt ON lt.idTheLoai = tl.id 
        INNER JOIN tintuc tt ON tt.idLoaiTin = lt.id
        GROUP BY tl.id" ;
        $this->setQuery($sql);
        return $this->loadAllRows();
    }

    public function getImageMenu(){
        $date = date('dmY');
        $sql = "SELECT  mn.Hinh as HinhMenu, mn.Status as HinhStatus  FROM menu mn  WHERE mn.MaMenu = '$date' " ;
        $this->setQuery($sql);
        return $this->loadRow(array($date));
    }
    public function getImageMenu2(){
        $date = date('dmY').'_2';
        $sql = "SELECT  mn.Hinh as HinhMenu  FROM menu mn  WHERE mn.MaMenu = '$date' " ;
        $this->setQuery($sql);
        return $this->loadRow(array($date));
    }

    public function getUserOrder($date){
        if ($date == 0){
            $date = date('dmY');
        }
        $sql = "SELECT  ou.* FROM order_user ou  WHERE ou.MaMenu = '$date'  AND ou.Status_od <> 4 ";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }

    public function getUserOrderUnpaid($date){
        if ($date == 0){
            $date = date('dmY');
        }
        $sql = "SELECT COUNT(*) AS count  FROM order_user  WHERE MaMenu = '$date'  AND Status_od <> 4 AND Status_od <> 2 AND Status_od <> 3";
        $this->setQuery($sql);
        return $this->loadRow();
    }
    public function getUserNameUnpaid(){
        $sql = "SELECT Hoten, TongTien, created_at  FROM order_user  WHERE Status_od = 5";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }

    public function getUserOrder2($date){
        if ($date == 0){
            $date = date('dmY').'_2';
        }
        $sql = "SELECT  ou.* FROM order_user_2 ou  WHERE ou.MaMenu = '$date' " ;
        $this->setQuery($sql);
        return $this->loadAllRows();
    }

    public function getTinTucByIdLoai($id_loaitin,$vitri=-1,$limit=-1)
    {
        $sql = "SELECT * FROM tintuc WHERE idLoaiTin = $id_loaitin ";

       // phân trang
        if($vitri>-1 && $limit >1){
            $sql.="limit $vitri,$limit";
        }
        $this->setQuery($sql);
        return $this->loadAllRows(array($id_loaitin));
    }

    public function getTitleById($id_loaitin)
    {
        $sql = "SELECT Ten FROM loaitin WHERE id = $id_loaitin";
        $this->setQuery($sql);
        return $this->loadRow(array($id_loaitin));
    }

    public function getChiTietTin($id){
        $sql = "SELECT *FROM tintuc WHERE id = $id";
        $this->setQuery($sql);
        return $this->loadRow(array($id));
    }
    public function getComment($id_tin){
        $sql = "SELECT *FROM comment WHERE idTinTuc = $id_tin";
        $this->setQuery($sql);
        return $this->loadAllRows(array($id_tin));
    }
    public function getRelatedNews($alias){
        $sql = "SELECT tt.*, lt.TenKhongDau AS TenKhongDau, lt.id AS idLoaitin 
                FROM tintuc tt INNER JOIN loaitin lt
                ON tt.idLoaiTin = lt.id WHERE lt.TenKhongDau= '$alias'
                LIMIT 0,5";
        $this->setQuery($sql);
        return $this->loadAllRows(array($alias));
    }
    public function getAliasLoaiTin($id_loaitin){
        $sql = "SELECT TenKhongDau FROM loaitin WHERE id = $id_loaitin";
        $this->setQuery($sql);
        return $this->loadRow(array($id_loaitin));
    }
    public function geTinNoiBat(){
        $sql = "SELECT tt.*, lt.TenKhongDau AS TenKhongDau, lt.id AS idLoaitin 
                FROM tintuc tt INNER JOIN loaitin lt
                ON tt.idLoaiTin = lt.id WHERE tt.NoiBat= 1
                LIMIT 0,5";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function addComment($id_user,$id_tin,$noidung){
        $sql = "INSERT INTO comment(idUser,idTinTuc,NoiDung) VALUES (?,?,?)";
        $this->setQuery($sql);
        return $this->execute(array($id_user,$id_tin,$noidung));
    }
    public function search($key){
        $sql = "SELECT tt.*,lt.TenKhongDau AS ten_khong_dau
                FROM tintuc tt INNER JOIN loaitin lt ON tt.idLoaitin =lt.id
                WHERE tt.TieuDe LIKE '%$key%' OR tt.TomTat LIKE '%$key%'";
        $this->setQuery($sql);
        return $this->loadAllRows(array($key));
    }

    // MENU ORDER
    public function addOrderMenu($HoTen,$SoLuong,$TongTien,$MoTa,$Status_od,$isVH){
        $MaMenu = date('dmY');
        $sql = "INSERT INTO order_user(HoTen,SoLuong,TongTien,MoTa,Status_od,MaMenu,isVH)
                VALUES ('$HoTen','$SoLuong','$TongTien','$MoTa','$Status_od', '$MaMenu', '$isVH')";
        $this->setQuery($sql);
        return $this->execute(array ($HoTen,$SoLuong,$TongTien,$MoTa,$Status_od,'$MaMenu','$isVH'));
    }
    public function addOrderMenu2($HoTen,$SoLuong,$TongTien,$MoTa,$Status_od){
        $MaMenu = date('dmY').'_2';
        $sql = "INSERT INTO order_user_2(HoTen,SoLuong,TongTien,MoTa,Status_od,MaMenu)
                VALUES ('$HoTen','$SoLuong','$TongTien','$MoTa','$Status_od', '$MaMenu')";
        $this->setQuery($sql);
        return $this->execute(array ($HoTen,$SoLuong,$TongTien,$MoTa,$Status_od,'$MaMenu'));
    }
    public function updateOrderUser($id,$HoTen,$SoLuong,$TongTien,$Mota,$isVH){
        $sql = "SELECT *FROM order_user WHERE  id = $id";
        if($id>-1){
            $sql = "UPDATE order_user SET HoTen='$HoTen',SoLuong='$SoLuong',
                                    TongTien='$TongTien',Mota='$Mota', isVH ='$isVH'
                                    WHERE  id = '$id'";
        }
        $this->setQuery($sql);
        return $this->execute(array($id,$HoTen,$SoLuong,$TongTien,$Mota,$isVH));
    }
    public function updateOrderUser2($id,$HoTen,$SoLuong,$TongTien,$Mota){
        $sql = "SELECT *FROM order_user_2 WHERE  id = $id";
        if($id>-1){
            $sql = "UPDATE order_user_2 SET HoTen='$HoTen',SoLuong='$SoLuong',
                                    TongTien='$TongTien',Mota='$Mota'
                                    WHERE  id = '$id'";
        }
        $this->setQuery($sql);
        return $this->execute(array($id,$HoTen,$SoLuong,$TongTien,$Mota));
    }
    public function getChiTietOrder($id){
        $sql = "SELECT *FROM order_user WHERE id = $id";
        $this->setQuery($sql);
        return $this->loadRow(array($id));
    }
    public function getChiTietOrder2($id){
        $sql = "SELECT *FROM order_user_2 WHERE id = $id";
        $this->setQuery($sql);
        return $this->loadRow(array($id));
    }

    public function getHinhMenu(){
        $MaMenu = date('dmY');
        $sql = "SELECT mn.Hinh
            FROM menu AS mn WHERE mn.MaMenu = '$MaMenu'";
        $this->setQuery($sql);
        return $this->loadRow(array());
    }
    public function getHinhMenu2(){
        $MaMenu = date('dmY').'_2';
        $sql = "SELECT mn.Hinh
            FROM menu AS mn WHERE mn.MaMenu = '$MaMenu'";
        $this->setQuery($sql);
        return $this->loadRow(array());
    }
        public function updateStatusCancel($id){
        $sql = "UPDATE order_user SET Status_od = 4 WHERE id = $id";
        $this->setQuery($sql);
        return $this->loadRow(array($id));
    }
    public function updateStatusCancel2($id){
        $sql = "UPDATE order_user_2 SET Status_od = 4 WHERE id = $id";
        $this->setQuery($sql);
        return $this->loadRow(array($id));
    }
    public function updateStatusSuccess($id){
        $sql = "UPDATE order_user SET Status_od = 3 WHERE id = $id";
        $this->setQuery($sql);
        return $this->loadRow(array($id));
    }
}
?>