<?php
class TwoController extends Controller {
function index() {

        $this->view("index");
    }
function member() {
 $this->model("login");
    $login =new login();
    $result = $login->showlimit();
    $result2=$this->member_con();
    $this->view("member",Array($result,$result2));
    }
function login() {

        $this->view("login");
    }
function logincheck(){
  $id = $_POST['id'];
  $pw = $_POST['pw'];
  $login=$this->model("login");
  $result = $login->logcheck($id);
if($id != null && $pw != null && $result[0]['username'] == $id && $result[0]['password'] == $pw){
        //將帳號寫入session，方便驗證使用者身份
        $_SESSION['username'] = $id;
        echo '登入成功!';
        header("location:/EasyMVC/Two/member");
}
else{
        echo '登入失敗!';
        header("location:/EasyMVC/Two/index");
}

header($a->islogin());
$this->view("login", $result);
}
function regist() {

        $this->view("register");
    }
function regist_finish(){
    include("accountClass.php");
     $account=new Account($_POST['id'],$_POST['pw'],$_POST['pw2'],$_POST['telephone'],$_POST['address'],$_POST['other']);
//判斷帳號密碼是否為空值
//確認密碼輸入的正確性
if($account->id != null && $account->pw != null && $account->pw2 != null && $account->pw == $account->pw2)
{
        $id = $account->id;
        $pw=$account->pw;
        $telephone=$account->telephone;
        $address=$account->address;
        $other=$account->other;
        //新增資料進資料庫語法
      
    $regist=$this->model("login");
    
    $checkError=$regist->regist_finish($id,$pw,$telephone,$address,$other);
    if($checkError){
        

                echo '新增成功!';
                header("location:/EasyMVC/Two/login");
        }
        else
        {
                echo '新增失敗!';
                 header("location:/EasyMVC/Two/login");
        }
}
else
{
        echo '資料填寫不正確,或資料不齊全,請重新填寫!';
         header("location:/EasyMVC/Two/regist");}
}
function logout(){
unset($_SESSION['username']);
echo '登出中......';  
header("location:/EasyMVC/Two/index");    
}
function update(){
$row = $this->update_default();
$this->view("update",$row);
}
function update_default(){
$id=$_SESSION['username'];
$update=$this->model("login");
$row=$update->updateClass($id);
return $row;
}
function update_finish(){
include("accountClass.php");
$account=new Account($_POST['id'],$_POST['pw'],$_POST['pw2'],$_POST['telephone'],$_POST['address'],$_POST['other']);
//紅色字體為判斷密碼是否填寫正確
if($_SESSION['username'] != null && $account->pw != null && $account->pw2 != null && $account->pw == $account->pw2)
{
    $id = $_SESSION['username'];
    $pw=$account->pw;
    $telephone=$account->telephone;
    $address=$account->address;
    $other=$account->other;
        //更新資料庫資料語法
        if(1)
        {
            // $updateMember=new updateMember();
             $updateMember=$this->model("login");
            $updateMember->update_finish($id,$pw,$telephone,$address,$other);
                echo '修改成功!';
                echo '<meta http-equiv=REFRESH CONTENT=1;url=/EasyMVC/Two/member>';
        }
        else
        {
                echo '修改失敗!';
                echo '<meta http-equiv=REFRESH CONTENT=1;url=/EasyMVC/Two/update>';
        }
}
else
{
        echo '修改失敗!';
        echo '<meta http-equiv=REFRESH CONTENT=1;url=/EasyMVC/Two/update>';
}    
}
function checksession(){
if($_SESSION['username'] != null)
{
        $id=$_SESSION['username'];
        $login=$this->model("login");
        $result=$login->checksession($id);
}
else
{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=1;url=/EasyMVC/Two/login>';
}$this->view("member", $result);
}
function hotPhotoShow(){
    $RecPhoto=$this->model("login");
    $result=$RecPhoto->hotPhotoShow();
    $this->view("mosthit", $result);
}
function member_con(){
//預設每頁筆數
$pageRow_records = 6;
//預設頁數
$num_pages = 1;

//若已經有翻頁，將頁數更新
if (isset($_GET['page'])) {
  $num_pages = $_GET['page'];
}
//本頁開始記錄筆數 = (頁數-1)*每頁記錄筆數
$startRow_records = ($num_pages -1) * $pageRow_records;

//未加限制顯示筆數的SQL敘述句
$member=$this->model("login");
$all_RecAlbum=$member->member_show();

//以加上限制顯示筆數的SQL敘述句查詢資料到 $RecAlbum 中
$RecAlbum=$member->showlimit($startRow_records,$pageRow_records);

//計算總筆數
$total_records=count($all_RecAlbum);

//計算總頁數=(總筆數/每頁筆數)後無條件進位。
$total_pages = ceil($total_records/$pageRow_records);
$result['total_pages']= $total_pages;
$result['num_pages']= $num_pages;
$result['total_records']=$total_records;
return $result;
}
function albumshow(){
$id=$_GET['id'];
//計算點閱數
if(isset($_GET["action"])&&($_GET["action"]=="hits")){	
	$counthit=$this->model("login");
	$counthit->counthit($id);
	header("Location:/EasyMVC/Two/albumphoto?id=".$id);
}
//顯示相簿資訊SQL敘述句
$albumShow=$this->model("login");
$result=$albumShow->showAlbum($id);
//計算照片總筆數
$total_records=count($result['RecPhoto']);
$result['total_records']=$total_records;
// var_dump($result);
// exit;
$this->view("albumshow",$result);


}
function albumphoto(){
$id=$_GET["id"];
//顯示照片
$albumphoto=$this->model("login");
$result=$albumphoto->photoShow($id);
$this->view("albumphoto",$result);
}
function memberMsg_con(){
$album_id=$_POST['id'];
$msg=$_POST['user_msg'];
$username=$_SESSION['username'];
$insertMsg=$this->model("login");
$insertMsg->insertMsg($album_id,$msg,$username);
echo "<meta http-equiv='refresh' content='0;url=/EasyMVC/Two/albumphoto?id={$_POST['id']}'>";
}
function admin(){
$result2=$this->member_con();
$showlimit=$this->model("login");
$result=$showlimit->showlimit();
//刪除相簿
if(isset($_GET["action"])&&($_GET["action"]=="delete")){	
//刪除所屬相片
$id=$_GET["id"];
$result=$this->model("login");
$delphoto=$result->delphoto($id);
for($i=0;$i<count($delphoto);$i++){
unlink("../photos/".$delphoto[$i]["ap_picurl"]);
}
//刪除相簿
$deleteAlbum=$this->model("login");
$deleteAlbum->delalbumFunc($id);
$deleteAlbum->delalbumphotoFunc($id);
//重新導向回到主畫面
	header("Location: /EasyMVC/Two/admin");
}
$this->view("admin", Array($result,$result2));

}
function adminadd(){
$this->view("adminadd");
if(isset($_POST["action"])&&($_POST["action"]=="add")){
$album_pid=$this->model("login");
$album_pid=$album_pid->addAlbum();
header("Location:/EasyMVC/Two/adminfix?id=".$album_pid);
}
}
function adminfix(){
    if(isset($_POST["action"])&&($_POST["action"]=="update")){
//重新導向回到本畫面
        $updatePhot=$this->model("login");
        $updatePhot->updatePhotoDetail();
        header("Location: ?id=".$_POST["album_id"]);
    }
$result=$this->fixShow_con();
$this->view("adminfix",$result);
}
function fixShow_con(){
$id=$_GET["id"];
//顯示相簿資訊
// $fixShow=new fixShow();
$fixShow=$this->model("login");
$RecAlbum=$fixShow->show($id);
//顯示照片
$fixShow=$this->model("login");
$RecPhoto=$fixShow->showPhoto($id);
//計算照片總筆數
$total_records = count($RecPhoto);
$result['RecAlbum']= $RecAlbum;
$result['RecPhoto']= $RecPhoto;
$result['total_records']=$total_records;
return $result;
}
}   


?>