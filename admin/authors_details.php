<?php
require('header.php');
require ('admin_side_panel.php');
require_once '../database/connection.php';
$db= new DBConnection();
$con = $db->GetConnection();
$name='';
$lastname='';
$middleName='';
$photo = '';
$biografy = '';
$dateBirth = '';
$dateDeath= '';
$description='';
$msg='';
if(isset($_GET['id']) && $_GET['id']!=''){
    $Id=$_GET['id'];

    $countSql="select count(*) from authors where Id='$Id'";
    $check = $con->query($countSql)->fetchColumn();
    if($check>0){
        $row=$con->query("select * from authors where Id='$Id'")->fetch();
        $Id = $row['Id'];
        $name = $row['FirstName'];
        $lastname = $row['LastName'];
        $middleName = $row['MiddleName'];
        $photo = $row['Photo'];
        $biografy = $row['Biografy'];
        $dateBirth = $row['DateBirth'];
        $dateDeath = $row['DateDeath'];
    }else{
        header('location:authors.php');
        die();
    }
}

if(isset($_POST['submit'])){
    $Id=0;
    $name = $_POST['name'];
    $lastname = $_POST['lastName'];
    $middleName = $_POST['middleName'];
    $photo = $_POST['photo'];
    $biografy = $_POST['biografy'];
    $dateBirth = $_POST['dateBirth'];
    $dateDeath = $_POST['dateDeath'];
    $countSql="select count(*) from authors where FirstName='$name' and LastName='$lastname' and MiddleName = '$middleName' and DateBirth = '$dateBirth'";
    $check  = $con->query($countSql)->fetchColumn();
    if($check>0){
        if(isset($_GET['id']) && $_GET['id']!=''){
            $res = "select * from authors where FirstName='$name' and LastName='$lastname' and MiddleName = '$middleName' and DateBirth = '$dateBirth'";
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
            $con->query("update authors set FirstName='$name', LastName='$lastname', MiddleName = '$middleName', DateBirth = '$dateBirth', 
                   Photo =  '$photo', Biografy='$biografy', DateDeath='$dateDeath' where Id='$Id'");
        }else{
            $con->query("insert into authors(FirstName, LastName, MiddleName, Photo, Biografy, DateBirth, DateDeath,) values('$name', 
                                                                                                    '$lastname',
            '$middleName', '$photo', '$biografy', '$dateDeath', '$dateBirth' '$description','enabled')");
        }
        header('location:authors.php');
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
                                    <label for="authors">Genres</label>
                                    <input type="text" name="name" placeholder="Enter authors name"  value="<?php echo $row['FirstName'];?>">
                                    <input type="text" name="lastName" placeholder="Enter authors last name"  value="<?php echo $row['LastName'];?>">
                                    <input type="text" name="middleName" placeholder="Enter authors middle name"  value="<?php echo $row['MiddleName'];?>">
                                    <input type="file" name="photo" placeholder="Load photo of author">
                                    <textarea name="biografy" placeholder="Enter authors biography"> <?php echo $row['Biografy'] ?></textarea>
                                    <input type="date" name="dateBirth" value="<?php echo $row['DateBirth'] ?>">
                                    <input type="date" name="dateDeath" value="<?php echo $row['DateDeath'] ?>">
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