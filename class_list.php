<?php require_once("./layout/header.php")?>

<?php if (isset($_POST["search"])){
    echo "class list";
}

?>

<?php if (isset($_GET["delete_id"])) {
    $class_id = $_GET["delete_id"];
    if(!delete_class($mysqli,$class_id)){
        echo "Can't delete the class";
    }

   
}?>

<h2>Class List</h2> 
<div class="card">
    <div class="card-header d-flex justify-content-end">
        <a href="./add_class.php" class="btn btn-secondary btm-sm ">Add New Class</a>
    </div>
    <div class="card-body">
        <table  class="table table-border">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Class Name</th>
                    <th>Description</th>
                    <th>Action</th>  
                </tr>
            </thead>
            <tbody>
                <?php $class_list= get_all_class($mysqli);?>
                <?php $i=1;?>
                <?php while($class=$class_list->fetch_assoc()){?>
                <tr>
                    <td><?= $i?></td>
                    <td><?= $class["class_name"]?></td>
                    <td>
                        <?= substr($class["description"],0,60) ?>
                        <?php if(strlen($class["description"])>100){
                            echo "...";
                        }?>
                    </td>
                    <td>
                    <a class="btn btn-sm btn-primary" href="./add_class.php?class_id=<?= $class["class_id"] ?>"><i class="bi bi-pen"></i></a>
                    <button class="btn btn-sm btn-danger ms-2 confirmDelete" data-id="<?= $class["class_id"] ?>" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
                <?php $i++; } ?>
              
            </tbody>
        </table >
    </div>
</div>

 <div class="modal fade "  id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModallabel">Are you sure!</h1>
                <div class="btn-close" data-bs-dismiss="modal"></div>
            </div>
            <div class="modal-body">
                Do you want to delete this class?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="deleted">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
    let deleteId = undefined;
    let confirmBtn = document.querySelectorAll(".confirmDelete");
    let deleted = document.querySelector("#deleted");
    confirmBtn.forEach(element=>{
        element.addEventListener("click",()=>{
            deleteId = element.getAttribute('data-id')
            console.log(deleteId);
    })
});
deleted.addEventListener("click",()=>{
    location.replace("./class_list.php?delete_id="+deleteId);
})
</script>
<?php require_once("./layout/footer.php")?>