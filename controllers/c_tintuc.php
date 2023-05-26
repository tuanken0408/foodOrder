<?php
/**
 * Created by PhpStorm.
 * User: buian
 * Date: 10/19/2017
 * Time: 8:47 AM
 */
include 'models/m_tintuc.php';
include 'models/pager.php';
class C_tintuc{

    public function index()
        //dành cho trang chủ
    {
        $m_tintuc = new M_tintuc();
        $slide = $m_tintuc->getSlide();
        $menu = $m_tintuc->getMenu();
        $image = $m_tintuc->getImageMenu();
        return array('slide'=>$slide,'menu'=>$menu,'image'=>$image);
    }
    public function index4()
        //dành cho trang chủ
    {
        $m_tintuc = new M_tintuc();
        $slide = $m_tintuc->getSlide();
        $menu = $m_tintuc->getMenu();
        $image = $m_tintuc->getImageMenu2();
        return array('slide'=>$slide,'menu'=>$menu,'image'=>$image);
    }
    public function index2($date=0)
    {
        $m_tintuc = new M_tintuc();
        $user = $m_tintuc->getUserOrder($date);
        $userUnPaid = $m_tintuc->getUserOrderUnpaid($date);
        $userNameUnPaid = $m_tintuc->getUserNameUnpaid();
        return array('user'=>$user,'userUnPaid'=>$userUnPaid,'userNameUnPaid'=>$userNameUnPaid);
    }
    public function index3($date=0)
    {
        $m_tintuc = new M_tintuc();
        $user = $m_tintuc->getUserOrder2($date);
        return array('user'=>$user);
    }
    public function loaitin(){
        $id_loai = $_GET['id_loai'];
        $m_tintuc = new M_tintuc();

        $alias = $m_tintuc->getAliasLoaiTin($id_loai);
        $danhmuctin = $m_tintuc->getTinTucByIdLoai($id_loai);
        //phân trang
        $trang_hientai = (isset($_GET['page']))?$_GET['page']:1;
        $pagination = new pagination(count($danhmuctin),$trang_hientai,5,5);
        //hiển thị thanh phân trang
        $paginationHTML = $pagination->showPagination();
        $limit = $pagination->_nItemOnPage;
        $vitri = ($trang_hientai-1)*$limit;
        $danhmuctin = $m_tintuc->getTinTucByIdLoai($id_loai,$vitri,$limit);


        $menu = $m_tintuc->getMenu();
        $title = $m_tintuc->getTitleById($id_loai);
        return array('danhmuctin'=>$danhmuctin,'menu'=>$menu,'title'=>$title,'thanhphantrang'=>$paginationHTML,'alias'=>$alias);
    }
    public function chitietTin(){
        $id_tin = $_GET['id_tin'];
        $alias = $_GET['loai_tin'];
        $m_tintuc = new M_tintuc();
        $chitietTin = $m_tintuc->getChiTietTin($id_tin);
        $comment = $m_tintuc->getComment($id_tin);
        $relatednews = $m_tintuc->getRelatedNews($alias);
        $tinnoibat = $m_tintuc->geTinNoiBat();
        return array('chitietTin'=>$chitietTin,'comment'=>$comment,'relatednews'=>$relatednews,'tinnoibat'=>$tinnoibat);
    }
    public function themBinhluan($id_user,$id_tin,$noidung){
        $m_tintuc = new M_tintuc();
        $binhluan = $m_tintuc->addComment($id_user,$id_tin,$noidung);
        header('location:'.$_SERVER['HTTP_REFERER']);
    }

    public function timkiem($key){
        $m_tintuc = new M_tintuc();
        $tin =$m_tintuc->search($key);
        return $tin;
    }
    public function addOrder($HoTen,$SoLuong,$TongTien,$MoTa,$Status,$isVH){
        $m_tintuc = new M_tintuc();
        $check = $m_tintuc->getImageMenu();
        if($check->HinhStatus == 1){
            $_SESSION['user_error'] = "Đã chốt cơm rùi, bạn quá đen";
            header('location:?success=notok');
            unset($_SESSION['them_win']);
        }else{
            $them = $m_tintuc->addOrderMenu($HoTen,$SoLuong,$TongTien,$MoTa,$Status,$isVH);
            if ($them >0){
                $_SESSION['them_win']="Thêm thành công";
                unset($_SESSION['user_error']);
                header('location:?success=ok');
            }else{
                $_SESSION['error'] = "Thêm ko thành công";
                header('location:?success=notok');
            }
        }


    }
    public function addOrder2($HoTen,$SoLuong,$TongTien,$MoTa,$Status){
        $m_tintuc = new M_tintuc();
        $them = $m_tintuc->addOrderMenu2($HoTen,$SoLuong,$TongTien,$MoTa,$Status);
        if ($them >0){
            $_SESSION['them_win']="Thêm thành công";
            header('location:?success=ok');
        }else{
            $_SESSION['error'] = "Thêm ko thành công";
            header('location:?success=notok');
        }
    }
    public function editOrder($id,$TieuDe,$TieuDeKhongDau,$Hinh,$TomTat){
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
    public function chitietOrder(){
        $id_order = $_GET['id'];
        $m_tintuc = new M_tintuc();
        $chitietOrder = $m_tintuc->getChiTietOrder($id_order);
        return array('chitietOrder'=>$chitietOrder);
    }
    public function chitietOrder2(){
        $id_order = $_GET['id'];
        $m_tintuc = new M_tintuc();
        $chitietOrder = $m_tintuc->getChiTietOrder2($id_order);
        return array('chitietOrder'=>$chitietOrder);
    }
    public function getHinhMenu(){
        $m_tintuc = new M_tintuc();
        $chitietOrder = $m_tintuc->getHinhMenu();
        return array('getHinhMenu'=>$chitietOrder);
    }
    public function getHinhMenu2(){
        $m_tintuc = new M_tintuc();
        $chitietOrder = $m_tintuc->getHinhMenu2();
        return array('getHinhMenu'=>$chitietOrder);
    }
    public function Cancel(){
        $id_order = $_GET['cancel'];
        $m_tintuc = new M_tintuc();
        $check = $m_tintuc->getImageMenu();
        if($check->HinhStatus == 1){
            $_SESSION['user_error'] = "Đã chốt cơm rùi, bạn ko hủy đc nhé, bạn đen lắm";
            header('location:?success=notok');
            unset($_SESSION['them_win']);
        }else{
            $StatusOrder = $m_tintuc->updateStatusCancel($id_order);
            return array('StatusOrder'=>$StatusOrder);
        }
    }
    public function Cancel2(){
        $id_order = $_GET['cancel'];
        $m_tintuc = new M_tintuc();
        $StatusOrder = $m_tintuc->updateStatusCancel2($id_order);
        return array('StatusOrder'=>$StatusOrder);
    }
    public function Success(){
        $id_order = $_GET['success_ck'];
        $m_tintuc = new M_tintuc();
        $chitietOrder = $m_tintuc->getChiTietOrder($id_order);
        if ($chitietOrder->Status_od != 2){
            $StatusSuccess = $m_tintuc->updateStatusSuccess($id_order);
            return array('StatusSuccess'=>$StatusSuccess);
        }
    }
    public function updateOrder($id,$HoTen,$SoLuong,$TongTien,$Mota,$isVH){
        $m_tintuc = new M_tintuc();
        $check = $m_tintuc->getImageMenu();
        if($check->HinhStatus == 1){
            $_SESSION['user_error'] = "Đã chốt cơm rùi, bạn ko sửa được nữa, bạn quá đen";
            header('location:?success=notok');
            unset($_SESSION['them_win']);
        }else{
            $sua = $m_tintuc->updateOrderUser($id,$HoTen,$SoLuong,$TongTien,$Mota,$isVH);
            if (isset($_SESSION['them_win'])){
                unset($_SESSION['them_win']);
            }
            if ($sua >0){
                $_SESSION['sua_win']="Sửa thành công";
                header('location:?success=ok');
                if (isset($_SESSION['error'])){
                    unset($_SESSION['error']);
                }
            }else{
                $_SESSION['error'] = "Sửa ko thành công";
                header('ocation:?success=notok');
            }
        }
    }
    public function updateOrder2($id,$HoTen,$SoLuong,$TongTien,$Mota){
        $m_tintuc = new M_tintuc();
        $sua = $m_tintuc->updateOrderUser2($id,$HoTen,$SoLuong,$TongTien,$Mota);
        if (isset($_SESSION['them_win'])){
            unset($_SESSION['them_win']);
        }
        if ($sua >0){
            $_SESSION['sua_win']="Sửa thành công";
            header('location:?success=ok');
            if (isset($_SESSION['error'])){
                unset($_SESSION['error']);
            }
        }else{
            $_SESSION['error'] = "Sửa ko thành công";
            header('ocation:?success=notok');
        }
    }



}

?>