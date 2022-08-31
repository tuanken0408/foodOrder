<?php
/**
 * Created by PhpStorm.
 * User: buian
 * Date: 10/22/2017
 * Time: 4:10 PM
 */
include_once '../models/database.php';
class M_admin extends database{
    public function getTheLoaiAdmin(){
        $sql = "SELECT lt.id,lt.Ten,lt.TenKhongDau, tl.Ten AS tencha
                FROM loaitin AS lt INNER JOIN theloai AS tl
                ON tl.id = lt.idTheLoai";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function addTheLoaiAdmin($id){
        $sql ="INSERT INTO loaitin(ten,ghichu,chuyenmuc) VALUE ('$ten','$ghichu','$chuyenmuc')";
    }

    public function getBaiVietAdmin($vitri=-1,$limit=-1){
         $sql = "SELECT tt.id,tt.TieuDe,tt.TieuDeKhongDau,tt.TomTat,tt.NoiDung,tt.Hinh,lt.Ten AS TenLoaiTin,tl.Ten AS TenTheLoai 
            FROM tintuc AS tt
            INNER JOIN loaitin AS lt ON lt.id=tt.idLoaiTin
            INNER JOIN theloai AS tl ON tl.id = lt.idTheLoai
            ";

            if($vitri>-1 && $limit >-1){
            $sql.="limit $vitri,$limit";
        }
            $this->setQuery($sql);
            return $this->loadAllRows();   
    }
    public function addBaiVietAdmin($idLoaiTin,$TieuDe,$TieuDeKhongDau,$Hinh,$NoiDung,$TomTat){
         $sql = "INSERT INTO tintuc(idLoaiTin,TieuDe,TieuDeKhongDau,Hinh,NoiDung,TomTat)
                VALUES ('$idLoaiTin','$TieuDe','$TieuDeKhongDau','$Hinh','$NoiDung','$TomTat')";
            $this->setQuery($sql);
            return $this->execute(array ($idLoaiTin,$TieuDe,$TieuDeKhongDau,$Hinh,$NoiDung,$TomTat));
    }

    // MENU ORDER
    public function addMenuAdmin($TieuDe,$TieuDeKhongDau,$MaMenu,$Hinh,$TomTat){
        $sql = "INSERT INTO menu(TieuDe,TieuDeKhongDau,MaMenu,Hinh,TomTat)
                VALUES ('$TieuDe','$TieuDeKhongDau','$MaMenu','$Hinh','$TomTat')";
        $this->setQuery($sql);
        return $this->execute(array ($TieuDe,$TieuDeKhongDau,$MaMenu,$Hinh,$TomTat));
    }
    public function getMenuAdmin($vitri=-1,$limit=-1){
        $sql = "SELECT mn.id,mn.TieuDe,mn.TieuDeKhongDau,mn.TomTat,mn.Hinh
            FROM menu AS mn ";

        if($vitri>-1 && $limit >-1){
            $sql.="limit $vitri,$limit";
        }
        $this->setQuery($sql);
        return $this->loadAllRows();
    }


    public function getIDtoLoaiTin(){
        $sql = "SELECT * FROM loaitin";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function editBaiViet($id,$idLoaiTin,$TieuDe,$TieuDeKhongDau,$Hinh,$NoiDung,$TomTat){
        $sql = "SELECT *FROM tintuc WHERE  id = $id";
        if($id>-1){
            $sql = "UPDATE tintuc SET idLoaiTin='$idLoaiTin',TieuDe='$TieuDe',TieuDeKhongDau='$TieuDeKhongDau',
                                    Hinh='$Hinh',NoiDung='$NoiDung',TomTat='$TomTat'
                                    WHERE  id = $id";
        }
        $this->setQuery($sql);
        return $this->execute($idLoaiTin,$TieuDe,$TieuDeKhongDau,$Hinh,$NoiDung,$TomTat);
    }
    public function editMenu($id,$TieuDe,$TieuDeKhongDau,$Hinh,$TomTat){
        $sql = "SELECT *FROM menu WHERE  id = $id";
        if($id>-1){
            $sql = "UPDATE menu SET TieuDe='$TieuDe',TieuDeKhongDau='$TieuDeKhongDau',
                                    Hinh='$Hinh',TomTat='$TomTat'
                                    WHERE  id = '$id'";
        }
        $this->setQuery($sql);
        return $this->execute(array($TieuDe,$TieuDeKhongDau,$Hinh,$TomTat));
    }
    public function getHinh(){
        $sql = "SELECT Hinh FROM tintuc WHERE id ={$_GET['id']}";
        $this->setQuery($sql);
        return $this->loadRow();
    }
    public function getBaiVietbyId($id){
        $sql = "SELECT tt.id,tt.TieuDe,tt.TieuDeKhongDau,tt.TomTat,tt.NoiDung,tt.Hinh,lt.Ten AS TenLoaiTin,tl.Ten AS TenTheLoai 
            FROM tintuc AS tt
            INNER JOIN loaitin AS lt ON lt.id=tt.idLoaiTin
            INNER JOIN theloai AS tl ON tl.id = lt.idTheLoai
              
            ";
        $this->setQuery($sql);
        return $this->loadRow(array($id));
    }
    public function getMenubyId($id){
        $sql = "SELECT tt.id,tt.TieuDe,tt.TieuDeKhongDau,tt.TomTat,tt.Hinh FROM menu AS tt WHERE id = '$id'";
        $this->setQuery($sql);
        return $this->loadRow(array($id));
    }

}
?>