<?php require_once ("./layout/header.php") ?>

<?php if (isset($_POST["search"])){
  echo "add student batch";
}
?>
<!-- <?php
if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];
    $student_batch_id = get_student_batch_from_student_id($mysqli,$student_id);
}
    if(!$student_batch_id === ""){
        delete_attendence_with_student_batch_id($mysqli,$student_batch_id);
         header("Location:student_batch_list.php");
    }
?>
                     -->
                
<?php 
$student_id=$student_id_err="";
$validation_message="";


if(isset($_POST['student_id'])){ 
    $student_id= $_POST['student_id'];

    if($student_id ===""){
        $student_id_err="student name can not be blank!";

    }

    if ($student_id_err ==="") {
        if (add_student_batch($mysqli, $student_id, $_GET["batch_id"])) {
          header("Location:student_batch_list.php?batch_id=$_GET[batch_id]&class=$_GET[class]");
        } else {
            $validation_message = "Internal server Error";
        }
    }
}
   ?>

<?php if (isset($_GET["student_id"])) {
    echo "<h2>Update student</h2>";
} else {
    echo "<h2>Student Registeration</h2>";
}
?>

<div class="card">
    <div class="card-body">
        <div class="card col-4">
            <div class="card-body">
            <form method="post">
            <?php if ($validation_message) { ?>
                <div class="alert alert-danger">
                    <?= $validation_message ?>
                </div>
                <?php } ?>
            <div class="form-group my-3">
                <label for="student_id" class="form-label">Student Name</label>
                <select name="student_id" id="student_id" class="form-select">
                    <option value="" selected>Select Student</option>
                    <?php $student_list= get_all_student_without($mysqli,$_GET["batch_id"])?>
                    <?php  while($student = $student_list->fetch_assoc()){?>
                        <option value="<?= $student["student_id"]?>"
                        <?php if($student["student_id"]=== $student_id){
                            echo "selected";
                        }
                        ?>><?= $student["student_name"]?></option>

                        <?php }?>


                </select>
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
            
        </form>
            </div>
        </div>
            
    </div>
</div>
<?php require_once ("./layout/footer.php") ?>