<?php
if(isset($_POST["submit"])){
    $producto         = $_POST["producto"];
    $precio           = $_POST["precio"];
    $descripcion      = $_POST["description"];
    $categoria        = $_POST["categoria_id"];
    $talla            = $_POST["talla_id"];

    require_once 'conexion.php';
    require_once 'funciones.php';

    $array = array($conexion, $producto, $descripcion, $precio, $talla,$categoria);
    if(isEmptyInput($array)){
        header("location: ../pages/produPrueba.php");
        exit();
        //echo "hola1";
    }

    $noti_id = crearProducto($conexion, $producto,  $descripcion, $precio, $talla,$categoria);

    // if($noti_id > 0){
    //     header("location: ../pages/produPrueba.php");
    //     exit();
    //     //echo "se inserto";
    // } else {
    //     header("location: ../pages/produPrueba.php");
    //     exit();
    //     //echo "hola333";
    // }
        
    if($noti_id>0){
        if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {
         
            $img_name     = $_FILES["imagen"]["name"];
            $file_tmp_name = $_FILES["imagen"]["tmp_name"];
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc= strtolower($img_ex);
            $allowed_exs = array("jpg", "jpeg", "png");

            
            if(in_array($img_ex_lc, $allowed_exs)){
                $new_img_name="IMG-" . $noti_id.'.'.$img_ex_lc;
                $img_upload_path= '../assets/img/'.$new_img_name;
                move_uploaded_file($file_tmp_name, $img_upload_path);

                $sql= "UPDATE catalogo SET ruta = '$new_img_name' WHERE catalogo_id = '$noti_id' " ;
                mysqli_query($conexion, $sql);
            }
            else{
                //header("location: ../../src/cursos/cursos_form.php?error=errorImg");
                echo "no se cargo la imagen";
                exit();
            }
            
            header("location: ../pages/venderPrueba.php");
            exit();
            
             
        }else{
            echo "no se carga la imagen";
        }
    }else{
        //header("../../src/cursos/cursos_form.php?error=errorC");
        echo "segundo if no entró";
        exit();
    }



}else{
    //echo "PPPPP";
}
