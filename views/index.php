<?php
session_start();
include "controllers/c_tintuc.php";
$c_tintuc = new C_tintuc();
$chitietOrder = $c_tintuc->chitietOrder();

if(isset($_GET['view'])){
    include_once "view/".$_GET['view'].".php";
}
else{

}
?>
