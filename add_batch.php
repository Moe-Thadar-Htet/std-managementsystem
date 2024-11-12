<?php require_once ("./layout/header.php") ?>
<?php if (isset($_POST["search"])){
  echo "add batch list";
}
?>
<?php 
   
    $batch_name=$batch_name_err="";
    $start=$start_err="";
    $end=$end_err="";
    $fees=$fees_err="";
    $description=$description_err="";
    $teacher_id=$teacher_id_err="";
    $class_id=$class_id_err="";
    $invalid="";
    $check_invalid=true;

    if (isset($_GET["batch_id"])) {
        $batch_id = $_GET["batch_id"];
        $batch = get_batch_id($mysqli, $batch_id);
        $batch_name= $batch["batch_name"];
        $start= $batch["start_date"];
        $end= $batch["end_date"];
        $fees= $batch["fees"];
        $description= $batch["description"];
        $teacher_id= $batch["teacher_id"];
        $class_id = $batch["class_id"];
    }


if(isset($_POST['batch_name'])){
    $batch_name= $_POST['batch_name'];
    $start= $_POST['start'];
    $end= $_POST['end'];
    $fees= $_POST['fees'];
    $description= $_POST['description'];
    $teacher_id= $_POST['teacher_id'];
    $class_id = isset($_POST['class_id']) ? $_POST['class_id'] : "";

    if($batch_name ===""){
        $batch_name_err="batch name can not be blank!";
        $check_invalid=false;
    }
    if($start ===""){
        $start_err="Start Date can not be blank!";
        $check_invalid=false;
    }
    if($end ===""){
        $end_err ="End Datecan not be blank!";
        $check_invalid=false;
    }
    if($fees ===""){
        $fees_err="Fees can not be blank!";
        $check_invalid=false;
    }
    if($description ===""){
        $description_err="Description can not be blank!";
        $check_invalid=false;
    }
  
    if($teacher_id ===""){
        $teacher_id_err="Teacher_id can not be blank!";
        $check_invalid=false;
    }
  
    if($class_id ===""){
        $class_id_err="Class_id can not be blank!";
        $check_invalid=false;
    }
  
    if($check_invalid){
        if (isset($_GET["batch_id"])) {
            if(update_batch($mysqli, $batch_id, $batch_name, $start, $end, $fees, $description, $teacher_id, $class_id)){
                header("location:batch_list.php");
            }else{
                $invalid = true;
            }
        }else{
            if(add_batch($mysqli, $batch_name, $start, $end, $fees, $description, $teacher_id, $class_id)){
                header("location:batch_list.php");
             }else{
                 var_dump($mysqli->error);
                 $invalid=true;
             }

        }

    }
      
} 
?>

<?php if (isset($_GET["batch_id"])) {
    echo "<h2>Update Batch</h2>";
} else {
    echo "<h2>Batch Registeration</h2>";
}
?>

<div class="card">
    <div class="card-body">
        <div class="card col-4">
            <div class="card-body">
                <form method="post">
                    <?php if($invalid){?>
                        <div class="alert alert-danger">
                        <?php if((isset($_GET["batch_id"]))){
                          echo "Batch can not be update!";
                        } else {
                            echo "Batch can't be register!";

                        }
                        ?>
                            
                    </div>
                    
                    <?php }?>

                    <div class="form-group my-3">
                        <label for="batch_name" class="form-label">Batch Name</label>
                        <input type="text" name="batch_name" class="form-control" id="batch_name" value="<?= $batch_name ?>">
                        <div class="text-danger" style="font-size:12px;"><?= $batch_name_err ?></div>
                    </div>

                    <div class="row">
                        <div class="form-group my-3 col-6">
                            <label for="start" class="form-label">Start Date</label>
                            <input type="date" name="start" class="form-control" id="start" value="<?= $start ?>">
                            <div class="text-danger" style="font-size:12px;"><?= $start_err?></div>
                        </div>
                        <div class="form-group my-3 col-6">
                            <label for="end" class="form-label">End Date</label>
                            <input type="date" name="end" class="form-control" id="end" value="<?= $end ?>">
                            <div class="text-danger" style="font-size:12px;"><?= $end_err?></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group my-3 col-6">
                            <label for="class_id" class="form-label">Class</label>
                            <select name="class_id" class="form-select" id="class_id">
                                <option value="" readonly >Select Class</option>
                                <?php $class_list= get_all_class($mysqli)?>
                                <?php while($class = $class_list->fetch_assoc()){?>
                                <option value="<?= $class["class_id"] ?>" <?php if($class["class_id"] === $class_id){
                                    echo "selected";
                                    }?>><?= $class["class_name"]?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group my-3 col-6">
                            <label for="teacher_id" class="form-label">Teacher</label>
                            <select name="teacher_id" class="form-select" id="teacher_id">
                                <option value="">Teacher</option>
                                <?php $teacher_list= get_all_teacher($mysqli);
                                // var_dump( $teacher_list->fetch_assoc())?>
                                <?php while($teacher = $teacher_list->fetch_assoc()){?>
                                <option value="<?= $teacher["teacher_id"] ?>" <?php if($teacher["teacher_id"] === $teacher_id){
                                    echo "selected";
                                    }?>><?= $teacher["teacher_name"]?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group my-3">
                        <label for="fees" class="form-label">Fees</label>
                        <input type="number" name="fees" class="form-control" id="fees" value="<?= $fees ?>">
                        <div class="text-danger" style="font-size:12px;"><?= $fees_err?></div>
                    </div>
                    <div class="form-group my-3">
                        <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control" style="height: 120px"><?= $description ?></textarea>
                        <div class="text-danger" style="font-size:12px;"><?= $description_err?></div>
                    </div>
                    <button class="btn btn-primary" type="submit">Submit</button>
                    
                </form>
            </div>
        </div>    
    </div>
</div>
<?php require_once ("./layout/footer.php") ?>