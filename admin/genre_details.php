<?php
require('header.php');
require ('admin_side_panel.php');
require_once '../database/connection.php';
$db= new DBConnection();
$con = $db->GetConnection();
$name='';
$description='';
$msg='';
if(isset($_GET['id']) && $_GET['id']!=''){
    $Id=$_GET['id'];

    $countSql="select count(*) from genres where Id='$Id'";
    $check = $con->query($countSql)->fetchColumn();
    if($check>0){
        $row=$con->query("select * from genres where Id='$Id'")->fetch();
        $Id = $row['Id'];
        $name = $row['Name'];
        $description = $row['Description'];
        $genres=$row['Id'];
    }else{
        header('location:genres.php');
        die();
    }
}

if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $description=$_POST['description'];
    $countSql="select count(*) from genres where Name='$name' and Description='$description'";
    $check  = $con->query($countSql)->fetchColumn();
    if($check>0){
        if(isset($_GET['id']) && $_GET['id']!=''){
            $res = "select * from genres where Name='$name' and Description='$description'";
            $getData=$con->query($res)->fetch();
            if($Id==$getData['id']){

            }else{
                $msg="Genres already exist";
            }
        }else{
            $msg="Genres already exist";
        }
    }   

    if($msg==''){
        if(isset($_GET['id']) && $_GET['id']!=''){
            $con->query("update genres set Name='$name', Description='$description' where Id='$Id'");
        }else{
            $con->query("insert into genres(Name, Description,Status) values('$name', '$description','enabled')");
        }
        header('location:genres.php');
        die();
    }
}
?>
    <div>
        <div>
            <div>
                <div>
                    <div>
                        <div><strong>Genres</strong><small> Form</small></div>
                        <form method="post">
                            <div>
                                <div>
                                    <label for="genres">Genres</label>
                                    <input type="text" name="name" placeholder="Enter genres name"  value="<?php echo $row['Name'];?>">
                                    <textarea name="description" placeholder="Enter a short description"> <?php echo $row['Description'] ?></textarea>
                                </div>
                                <button name="submit" type="submit" >
                                    <span>Submit</span>
                                </button>
                                <div><?php echo $msg?></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
require('footer.php');
?>