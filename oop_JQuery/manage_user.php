<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="js/jquery-3.6.0.min.js"></script>
</head>
<body>
    <form íd="f">
        <div id="msg"></div>

        <div>
            Role <br>
            <select id="cmbRole">
                <?php
                $db=new mysqli("localhost","root","","test");
                $result=$db->query("select id,name from roles");
                while(list($id,$name)=$result->fetch_row()){
                    echo "<option value='$id'>$name</option>";
                }
                ?>
            </select>
        </div>
        <div>User Name<br>
            <input type="text" name="txtUsername" id="txtUsername">
    </div>
    <div>Password<br>
            <input type="password" name="txtPassword" id="txtPassword">
    </div>
    <div>
            <input type="button" name="btnSave" value="Save" id="btnSave">
    </div>

    </form>
<div id="table"></div>


<script>

    $(function(){

        loadUsers();

        $("#btnSave").on("click",function(){
            let role_id=$("#cmbRole").val();
            let username=$("#txtUsername").val();
            let password=$("#txtPassword").val();

            $.ajax({

                url:"user_api.php",
                type:"POST",
                data:{"cmd":"save","cmbRole":role_id,"txtUsername":username,"txtPassword":password},
                success:function(res){
                    $("#msg").html(res);
                    loadUsers();
                }

            });


        });
        
function loadUsers(){

$.ajax({
    url:'user_api.php',
    type:'POST',
    data:{"cmd":"view"},
    success:function(res){

        $("#table").html(res);
    }
});
}


    });
    
</script>
    
</body>
</html>