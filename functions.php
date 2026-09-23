<?php
function getlastid() {
    include 'config.php';
    $sql = "select * from users order by id desc limit 1";
    $result = $con->query($sql);
    if ($result->rowCount() > 0)
    {
        while ($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            return $row['id'];
        }
    }
}
function deleteuser($id) {
    include 'config.php';
    $sql = "delete from users where id=$id";
    if($con->exec($sql))
    {
        echo "<script>alert('deleted');</script>";
    }
    else
    {
        echo "<script>alert('not deleted');</script>";
    }
}
function getuser($id) {
    include 'config.php';
    $sql = "select * from users where id=$id";
    $result = $con->query($sql);
    if ($result->rowCount() > 0)
    {
        while ($rowg = $result->fetch(PDO::FETCH_ASSOC))
        {
            return $rowg;
        }
    }
}