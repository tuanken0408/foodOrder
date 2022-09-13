<?php
/**
 * Created by PhpStorm.
 * User: buian
 * Date: 10/22/2017
 * Time: 3:47 PM
 */
include "model/m_admin.php";
include "../models/pager.php";
class C_admin{
    public function getTheLoaiAd(){
        $m_admin = new M_admin();
        $theloai = $m_admin->getTheLoaiAdmin();
        return array('theloai'=>$theloai);
    }
    public function getBaiVietAd(){
        $m_admin = new M_admin();
        $baiviet = $m_admin->getBaiVietAdmin();
        //phân trang bài viết admin
        $trang_hientai = (isset($_GET['page']))?$_GET['page']:1;
        $pagination = new pagination(count($baiviet),$trang_hientai,5,3);
        //hiển thị thanh phân trang
        $paginationHTML = $pagination->showPagination();
        $limit = $pagination->_nItemOnPage;
        $vitri = ($trang_hientai-1)*$limit;
        $baiviet = $m_admin->getBaiVietAdmin($vitri,$limit);
        return array('baiviet'=>$baiviet,'thanhphantrang'=>$paginationHTML);
    }
   public function addBaiVietAd($idLoaiTin,$TieuDe,$TieuDeKhongDau,$Hinh,$NoiDung,$TomTat){
        $m_admin = new M_admin();
        $them = $m_admin->addBaiVietAdmin($idLoaiTin,$TieuDe,$TieuDeKhongDau,$Hinh,$NoiDung,$TomTat);
       if ($them >0){
           $_SESSION['them_win']="Thêm thành công";
           header('location:?view=baiviet/ds');
           if (isset($_SESSION['error'])){
               unset($_SESSION['error']);
           }
       }else{
           $_SESSION['error'] = "Thêm ko thành công";
           header('location:?view=baiviet/them');
       }
    }
    public function editBaiviet($idLoaiTin,$TieuDe,$TieuDeKhongDau,$Hinh,$NoiDung,$TomTat){
        $m_admin = new M_admin();
        $sua = $m_admin->editBaiViet($idLoaiTin,$TieuDe,$TieuDeKhongDau,$Hinh,$NoiDung,$TomTat);
    }

    // MeNU
    public function addMenu($TieuDe,$TieuDeKhongDau,$MaMenu,$Hinh,$TomTat){
        $m_admin = new M_admin();
        $them = $m_admin->addMenuAdmin($TieuDe,$TieuDeKhongDau,$MaMenu,$Hinh,$TomTat);
        if ($them >0){
            $_SESSION['them_win']="Thêm thành công";
            header('location:?view=menu/ds');
            if (isset($_SESSION['error'])){
                unset($_SESSION['error']);
            }
        }else{
            $_SESSION['error'] = "Thêm ko thành công";
            header('location:?view=menu/them');
        }
    }
    public function getMenuAd(){
        $m_admin = new M_admin();
        $menu = $m_admin->getMenuAdmin();

        //phân trang bài viết admin
        $trang_hientai = (isset($_GET['page']))?$_GET['page']:1;
        $pagination = new pagination(count($menu),$trang_hientai,5,3);
        //hiển thị thanh phân trang
        $paginationHTML = $pagination->showPagination();
        $limit = $pagination->_nItemOnPage;
        $vitri = ($trang_hientai-1)*$limit;
        $menu = $m_admin->getMenuAdmin($vitri,$limit);
        return array('menu'=>$menu,'thanhphantrang'=>$paginationHTML);
    }
    public function editMenu($id,$TieuDe,$TieuDeKhongDau,$Hinh,$TomTat){
        $m_admin = new M_admin();
        $sua = $m_admin->editMenu($id,$TieuDe,$TieuDeKhongDau,$Hinh,$TomTat);
        if ($sua >0){
            $_SESSION['sua_win']="Sửa thành công";
            header('location:?view=menu/ds');
            if (isset($_SESSION['error'])){
                unset($_SESSION['error']);
            }
        }else{
            $_SESSION['error'] = "Sửa ko thành công";
            header('location:?view=menu/ds');
        }
    }


    public function getHinhh(){
        $m_admin = new M_admin();
        $Hinh = $m_admin->getHinh();
        return $Hinh;
    }
   public function getIDtoLoaitin(){
        $m_admin = new M_admin();
        $idLoaiTin = $m_admin->getIDtoLoaiTin();
        return array('idLoaiTin'=>$idLoaiTin);
   }
   public function getBaiVietbyID(){
        if (isset($_GET['id'])){
            $id = $_GET['id'];
            $m_admin = new M_admin();
            $listbyid = $m_admin->getBaiVietbyId($id);
            return array('listbyid'=>$listbyid);
        }
       return array('listbyid'=>'');
   }
    public function getMenubyID(){
        if (isset($_GET['id'])){
            $id = $_GET['id'];
            $m_admin = new M_admin();
            $menubyid = $m_admin->getMenubyId($id);
            return array('menubyid'=>$menubyid);
        }else{
            return array('menubyid'=>'');
        }
    }
    public function getUserOrder($date=0)
    {
        $m_admin = new M_admin();
        $user = $m_admin->getUserOrder($date);
        return array('user'=>$user);
    }
    public function confirmFinish(){
        $m_admin = new M_admin();
        $m_admin->confirmFinish();
    }

    public function stripUnicode($str){
        if(!$str) return false;
        $unicode = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd'=>'đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i'=>'í|ì|ỉ|ĩ|ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
        );
        foreach($unicode as $khongdau=>$codau){
            $arr = explode("|",$codau);
            $str = str_replace($arr,$khongdau,$str);
        }

        return $str;
    }
    public function changeTitle($str){
        $str = trim($str);
        if($str == '') return '';
        $str = str_replace("",'',$str);
        $str = str_replace("''",'',$str);
        $str = stripUnicode($str);
        $str = mb_convert_case($str,MB_CASE_TITLE,'utf-8');
        $str = str_replace('','-',$str);
        return $str;
    }


}
?>