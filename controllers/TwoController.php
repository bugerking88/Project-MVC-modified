<?php
class TwoController extends Controller {
    function index() {
        $this->view("index");
    }
    function member() {
        $login=$this->model("login");
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
        $login->logcheck($_POST)?header("location:/EasyMVC/Two/member"):header("location:/EasyMVC/Two/index");
    }
    function regist() {
        $this->view("register");
        }
    function regist_finish(){
        require_once("accountClass.php");
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
            $regist->regist_finish($id,$pw,$telephone,$address,$other);
            header("location:/EasyMVC/Two/login");
        }
        else
        {
           header("location:/EasyMVC/Two/regist");}
        }
    function logout(){
        $result=$this->model("login");
        $result->logout();
        header("location:/EasyMVC/Two/index");    
    }
    function update($data=NULL){
        $row = $this->update_default();
        $this->view("errorMessage",$data);
        $this->view("update",$row);
    }
    function update_default(){
        $update=$this->model("login");
        $row=$update->updateClass($id);
        return $row;
}
    function update_finish(){
        $account = $this ->model("memberManager",$_POST);
        $account->update_finish()?
        header("location:/EasyMVC/Two/member"):header("location:/EasyMVC/Two/update/false");        
    }
    function checksession(){
        $findSession=$this->model("login");
        $id=$findSession->writeSession();
        if($id != null)
        {
            $login=$this->model("login");
            $result=$login->checksession($id);
        }
        else
        {
            header("Location: /EasyMVC/Two/login");
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
        $findSession=$this->model("login");
        $username=$findSession->writeSession();
        $insertMsg=$this->model("login");
        $insertMsg->insertMsg($album_id,$msg,$username);
        header("Location:/EasyMVC/Two/albumphoto?id=".$_POST['id']);
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
        }$this->view("admin", Array($result,$result2));
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