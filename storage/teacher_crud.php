<?php 

function add_teacher($mysqli,$teacher_name,$teacher_email,$exp)
{
    $sql = "INSERT INTO `teacher`(`teacher_name`, `teacher_email`, `exp`) VALUES ('$teacher_name','$teacher_email','$exp')";
    return $mysqli-> query($sql);
}

function get_all_teacher($mysqli)
{
    $sql = "SELECT * FROM `teacher`";
    return $mysqli->query($sql);
}

function get_teacher_id($mysqli,$teacher_id)
{
    $sql = "SELECT * FROM `teacher` WHERE teacher_id=$teacher_id";
    $result = $mysqli-> query($sql);
    return  $result->fetch_assoc();
}

function update_teacher($mysqli,$teacher_id,$teacher_name,$teacher_email,$exp)
{
    $sql = "UPDATE `teacher` SET `teacher_name`='$teacher_name', `teacher_email`='$teacher_email', `exp`='$exp' WHERE `teacher_id`='$teacher_id'";
    return  $mysqli-> query($sql);
}

function delete_teacher($mysqli,$teacher_id)
{
    $sql = "DELETE FROM `teacher`WHERE `teacher_id`='$teacher_id'";
    return $mysqli-> query($sql);
}

?>