<?php require_once("./layout/header.php")?>
<?php if (isset($_POST["search"])){
  echo "student attendence";
}
?>
<h2>student attendence</h2>

<?php if(isset($_GET["present"])){
    $attendence_id=$_GET["present"];
    if(present_attendence($mysqli,$attendence_id)){
        header("Location:student_attendence.php?student_batch_id=$_GET[student_batch_id]");
    }
}
if(isset($_GET["leave"])){
    $attendence_id=$_GET["leave"];
    if(leave_attendence($mysqli,$attendence_id)){
        header("Location:student_attendence.php?student_batch_id=$_GET[student_batch_id]");
    }
}
if(isset($_GET["absent"])){
    $attendence_id=$_GET["absent"];
    if(absent_attendence_update($mysqli,$attendence_id)){
        header("Location:student_attendence.php?student_batch_id=$_GET[student_batch_id]");
    }
}
    
?>

<div class="card">
    <div class="card-body">
        <table  class="table table-border">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody>
                <?php $attendence_list =get_attendence_with_student_batch($mysqli,$_GET["student_batch_id"]);?>
                <?php $i = 1;?>
                <?php while ($attendence = $attendence_list->fetch_assoc()) { ?> 
                <tr>
                    <td><?=$i?></td>
                    <td><?= $attendence ["date"]?> </td>
                    <td><?php if($attendence['present'] == 1){?>
                            <p class="text-success">Present</p>
                        <?php } elseif($attendence['leave'] == 1){?>
                            <p class="text-warning">Leave</p>
                        <?php }else{?>
                                <p class="text-danger">Absent</p>
                        <?php }?>

                   </td>
                   <td>
                        <a href="./student_attendence.php?student_batch_id=<?= $_GET["student_batch_id"] ?>&present=<?= $attendence["attendence_id"] ?>" class="btn btn-success btn-sm">Present</a>
                        <a href="./student_attendence.php?student_batch_id=<?= $_GET["student_batch_id"] ?>&leave=<?= $attendence["attendence_id"] ?>" class="btn btn-warning btn-sm">Leave</a>
                        <a href="./student_attendence.php?student_batch_id=<?= $_GET["student_batch_id"] ?>&absent=<?= $attendence["attendence_id"] ?>" class="btn btn-danger btn-sm">Absent</a>
                    </td>
                </tr>

                <?php $i++;
            }?>
            </tbody>  
        </table >
    </div>
</div>

<?php require_once("./layout/footer.php")?>