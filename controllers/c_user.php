<?php
session_start();
include 'models/m_user.php';

class C_user{
    public function dangkiTK($name,$email,$password)
    {
        $m_user = new M_user();
        $id_user = $m_user->dangki($name,$email,$password);
        if ($id_user>0){
            $_SESSION['success']="Đăng kí thành công";
            header('location:index.php');
            if (isset($_SESSION['error'])){
                unset($_SESSION['error']);
            }
        }else{
            $_SESSION['error'] = "Đăng kí không thành công";
            header('location:dangki.php');
        }
    }
    public function dangnhap($email,$password)
    {
        $m_user = new M_user();
        $user = $m_user->dangnhap($email,$password);
        if ($user == true){
            $_SESSION['user_name'] = $user->name;
            $_SESSION['id_user'] = $user->id;
            $_SESSION['role_user'] = $user->role;
            header('location:admin/');
            if (isset($_SESSION['user_error'])){
                unset($_SESSION['user_error']);
            }
            if(isset($_SESSION['chua_dang_nhap'])){
                unset($_SESSION['chua_dang_nhap']);
            }
        }
        else{
            $_SESSION['user_error'] = "Sai thông tin đăng nhập";
            header('location:dangnhap.php');
        }
    }
    public function dangxuat()
    {
        session_destroy();
        header('location:index.php');
    }
}
?>