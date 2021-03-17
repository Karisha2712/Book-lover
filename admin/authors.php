<?php
require('header.php');
require ('admin_side_panel.php');
require_once '../database/connection.php';
$db= new DBConnection();
$con = $db->GetConnection();
if(isset($_GET['type']) && $_GET['type']!=''){

    $type=$_GET['type'];
    if($type=='status'){
        $operation=$_GET['operation'];
        $id=$_GET['id'];
        if($operation=='enabled'){
            $status='enabled';

        }else{
            $status='disabled';
        }
        $update_status_sql="update authors set Status='$status' where Id='$id'";
        $con->query($update_status_sql);
    }

    if($type=='delete'){
        $id=$_GET['id'];
        $delete_sql="delete from authors where Id='$id'";
        $con->query($delete_sql)->fetch();
    }
}

$sql="select * from authors order by Id asc";
$res=$con->query($sql);
?>
    <div>
        <div>
            <div>
                <div>
                    <div>
                        <div>
                            <h4>Authors </h4>
                            <h4><a href="authors_details.php">Add Author</a> </h4>
                        </div>
                        <div>
                            <table>
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Id</th>
                                    <th>First name</th>
                                    <th>Last name</th>
                                    <th>Middle name</th>
                                    <th>Photo</th>
                                    <th>Biografy</th>
                                    <th>Date birth</th>
                                    <th>Date death</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $i=0;

                                foreach ($con->query($sql) as $row){
                                    $i++;
                                    ?>
                                    <tr>
                                        <td><?php echo $i?></td>
                                        <td><?php echo $row['Id']?></td>
                                        <td><?php echo $row['FirstName']?></td>
                                        <td><?php echo $row['LastName']?></td>
                                        <td><?php echo $row['MiddleName']?></td>
                                        <td><?php echo $row['Photo']?></td>
                                        <td><?php echo $row['Biografy']?></td>
                                        <td><?php echo $row['DateBirth']?></td>
                                        <td><?php echo $row['DateDeath']?></td>
                                        <td>
                                            <?php
                                            if($row['Status']=='enabled'){
                                                echo "<span><a href='?type=status&operation=disabled&id=".$row['Id']."'>Enable</a></span>&nbsp;";
                                            }else{
                                                echo "<span><a href='?type=status&operation=enabled&id=".$row['Id']."'>Disable</a></span>&nbsp;";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            echo "<span><a href='authors_details.php?id=".$row['Id']."'>Edit</a></span>&nbsp;";
                                            ?>
                                        </td>
                                        <td>
                                            <?php

                                            echo "<span><a href='?type=delete&id=".$row['Id']."'>Delete</a></span>";

                                            ?>
                                        </td>
                                    </>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
require('footer.php');
?>