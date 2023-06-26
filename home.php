<?php
    $db_localhost="localhost";
    $db_username="root";
    $db_password="";
    $db_name="phpboard";
    $db_link = new mySqli($db_localhost,$db_username,$db_password,$db_name);
    if($db_link->connect_error !== ""){
        $db_link->query("SET NAME 'utf8'");
    };
    /*****************讀取留言板******************/
    $toSqlGetData = "SELECT * FROM board ORDER BY boardid DESC";
    $totalData = $db_link->query( $toSqlGetData );
    $totalData_Num = $totalData->num_rows;
    $nowPage = 1;
    if(isset($_GET["page"])){
        $nowPage = $_GET["page"];
    };
    $showRow = 3;
    $totalPage = ceil($totalData_Num/$showRow);
    $getStartRow = ($nowPage - 1) *$showRow;
    $toSqlGetData_limit = $toSqlGetData." LIMIT {$getStartRow},{$showRow}";
    $limitData = $db_link->query($toSqlGetData_limit);
    /*****************檢測是否有登入******************/
    session_start();
    $isLogin = false;
    if(!isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"] == "") ){        
    }else{
        $isLogin =  true;
    };
    /*****************登入測試帳號密碼******************/
    if(isset($_POST["loggin"])){
        //echo "有登入資訊送來"; 
        $toSqlGetAdmin = "SELECT * FROM admin";
        $admin = $db_link->query( $toSqlGetAdmin);
        $admin = $admin->fetch_assoc();        
        if(($admin["username"] == $_POST["user"]) && ($admin["passwd"] == $_POST["pw"])){
            //echo "登入成功";
            $_SESSION["loginMember"] = $_POST["user"];
            header("Location: home.php");
        }else{
            //echo "登入失敗";
        };
    };
    /*****************登出******************/
    if(isset($_GET["loginout"])){
        unset($_SESSION["loginMember"]);
        header("Location: home.php");
    };
    /*****************刪除資料******************/
    if(isset($_GET["delete"])){
        echo "刪除資料";
        echo $_GET["delete"];
        $id = $_GET["delete"];
        $toSqlDel = "DELETE FROM board WHERE boardid={$id}";
        $stmt = $db_link->query($toSqlDel);
       
        header("Location: home.php?page={$nowPage}");
    };
    /*****************更新資料******************/
    if(isset($_POST["update"])){             
        $id = $_POST["update"];
        $toSqlUpdate = "UPDATE board SET boardname=?,boardsubject=?,boardcontent=? WHERE boardid={$id}";
        $stmt = $db_link->prepare($toSqlUpdate);
        $stmt->bind_param("sss",
            $_POST["boardname"],
            $_POST["boardsubject"],
            $_POST["boardcontent"]
        );
        $stmt->execute();
        $stmt->close();
        header("Location: home.php?page={$nowPage}");
    };
    /*****************新增資料******************/
    if(isset($_POST["add"])){
        echo "新增資料";
        $toSqlAdd = "INSERT INTO board (boardname,boardsubject,boardcontent,boardsex,boardweb,boardmail,boardtime) VALUES (?,?,?,?,?,?,NOW())";
        $stmt = $db_link->prepare($toSqlAdd);
        $stmt->bind_param("ssssss",
            $_POST["boardname"],
            $_POST["boardsubject"],
            $_POST["boardcontent"],
            $_POST["boardsex"],
            $_POST["boardweb"],
            $_POST["boardmail"]
        );
        $stmt->execute();
        $stmt->close();
        header("Location: home.php");
    };
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * { box-sizing:border-box;margin:0;padding:0; list-style:none;}
        main {margin:0 auto; width: 80%; max-width:800px;}
        .msgBoard { }
        .msgBoard_msg { margin-bottom:20px; padding-bottom:10px; border-bottom:1px solid #dedede;}    
        .btnPage { display:flex;}
        .btnPage > div {display:inline-block; width:50%;}
        #editBoard { display:none; padding:20px; border:1px solid black;}
        #editBoard.on { display:block;}
        #editBoard h3 {font-size:20px; font-weight:bold;}
        #addBoard { display:block; padding:20px; border:1px solid black;}
        #addBoard h3 {font-size:20px; font-weight:bold;}
    </style>
</head>
<body>
    <main>
        <ul class="msgBoard">
        <?php while($i = $limitData->fetch_assoc()){ ?>
            <li class="msgBoard_msg">
                <p>姓名：<?php echo $i["boardname"]; ?></p>
                <p>標題：<?php echo $i["boardsubject"]; ?></p>
                <p>內容：<?php echo $i["boardcontent"]; ?></p>
                <p>時間：<?php echo $i["boardtime"]; ?></p>
                <?php if($isLogin == true) { ?>
                    <a href="?page=<?php echo $nowPage; ?>&delete=<?php  echo $i["boardid"]; ?>">刪除</a>
                <?php } ?>
                <?php if($isLogin == true){ ?>
                    <a href="javascript:void(0)" onclick="hello(<?php echo $i['boardid']; ?>,this)"
                    data-temp="<?php echo $i["boardname"].",".$i["boardsubject"].",".$i["boardcontent"]; ?>">更新</a>
                <?php } ?>
            </li>
        <?php } ?>
        </ul>
        <nav class="btnPage">
            <div>
                <?php if( $nowPage > 1){ ?>
                    <a href="?page=<?php echo $nowPage - 1; ?>">上一頁</a>
                <?php } ?>
            </div>
            <div>
                <?php if( $nowPage <$totalPage ){ ?>
                    <a href="?page=<?php echo $nowPage + 1; ?>">下一頁</a>
                <?php } ?>
            </div>            
        </nav>
        <div>
            <?php if($isLogin == false){ ?>
                <form action="" method="post">
                    <input type="hidden" name="loggin">
                    <p>帳號：<input type="text" name="user"></p>
                    <p>密碼：<input type="text" name="pw"></p>
                    <input type="submit" value="登入">
                    <small>帳號/密碼：admin/admin <br></small>
                    <small>登入後，可以刪除或者修改留言。</small>
                </form>
                <br><br>
            <?php } ?>
            <?php if($isLogin == true){ ?>
                <br><br>
                <div id="editBoard">
                    <p><h3>編輯</h3></p>
                    <form action="" method="post">
                        <input type="hidden" name="update" id="update" value="00">
                        <p>姓名：<input type="text" name="boardname" id="boardname" value=""></p>
                        <p>標題：<input type="text" name="boardsubject" id="boardsubject" value=""></p>
                        <p>內容：<input type="text" name="boardcontent" id="boardcontent" value=""></p>
                        
                        <input type="submit" value="送出">
                </form>
                </div>
            <?php } ?>
            <div id="addBoard">
                    <p><h3>新增留言</h3></p>
                    <form action="" method="post">
                        <input type="hidden" name="add" >
                        <p>姓名：<input type="text" name="boardname" value=""></p>
                        <p>標題：<input type="text" name="boardsubject"  value=""></p>
                        <p>內容：<input type="text" name="boardcontent" value=""></p>
                        <p>性別：<input type="radio" name="boardsex" value="男" checked>男生/
                        <input type="radio" name="boardsex" value="女">女生
                        </p>
                        <p>個人網站：<input type="text" name="boardweb" value=""></p>
                        <p>電子信箱：<input type="text" name="boardmail" value=""></p>
                        <input type="submit" value="送出">
                </form>
                </div>
            <?php if($isLogin == true){ ?>
                <a href="?loginout">登出</a>
            <?php } ?>
        </div>
    </main> 
    <script>
        function hello(num,$this){            
            document.querySelector("#update").value = num ;
            let temp = $this.dataset.temp.split(",");          
            document.querySelector("#boardname").value = temp[0];
            document.querySelector("#boardsubject").value = temp[1];
            document.querySelector("#boardcontent").value = temp[2];  
            document.querySelector("#editBoard").classList.add("on");            
        };
    </script>
</body>
</html>