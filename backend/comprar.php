<?php
if( isset($_POST['func']) && $_POST['func'] !=''){
    // $cur_id = $_POST['id'];
    //echo $ids[1];
    //
    $ids = json_decode($_POST['id'], true);
    require_once 'conexion.php';
    // $sql = "DELETE FROM Capitulos WHERE Cap_Id = '$id' ";
    // $result = mysqli_query($conn, $sql);
    // $result = 1;
    //$sql ="DELETE FROM catalogo WHERE catalogo_id = ?";

    // $stmt = mysqli_stmt_init($conexion);
    // foreach ($ids as $id) {
    //     $stmt->bind_param("i", $id); 
    //     $stmt->execute();
    // }

    // $stmt->close();
    // $conn->close();
    foreach ($ids as $id) {
        $id = intval($id); // sanitize
        $sql = "DELETE FROM catalogo WHERE catalogo_id = $id";
        mysqli_query($conexion, $sql);
    }
    
    echo $ids[1];
}