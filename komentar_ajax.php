<?php

include_once 'database.php';



if(!isset($_SESSION['user'])){
   die("gaboleh");
}


if($_POST['type']=="insert"){
   
    $angka = $_SESSION['user'];

    $komentar = mysqli_real_escape_string($conn,$_POST['isi_komentar']);
    $query = mysqli_query($conn,"INSERT INTO komentar (id_user,isi_komentar) VALUES($angka,'$komentar')");
    
    if($query){
        $last_id = mysqli_insert_id($conn);
       echo " <p class='komentar_text' id='komentar_".$last_id."'>". $komentar ."</p> 
       <button type='button' class='hapus_komentar' data-id='".$last_id."'>hapus</button>
       <button type='button' class='edit_komentar' data-id='".$last_id.">edit</button>
     
   ";
    }else{
        echo'error';
    }
    
}



if($_POST['type']=="delete"){
    
    $id =$_POST['id'];
    

    $query = mysqli_query($conn,"DELETE FROM komentar WHERE id=$id");
    
    if($query){
       echo "1";
    }else{
        echo'2';
    }
    
}



if($_POST['type']=="edit"){
    
    $id =$_POST['id_komentar'];
    $isi =$_POST['isi_komentar'];

    $query = mysqli_query($conn,"UPDATE komentar SET isi_komentar='$isi' WHERE id=$id");
    




    if($query){
       echo "1";
    }else{
    var_dump($isi);

    }
    
}