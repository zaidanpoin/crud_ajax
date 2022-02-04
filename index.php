<?php 

include_once 'database.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="jquery.js"></script>
    <style>
        * {
            font-family: 15px;
            font-family: sans-serif;
        }

        body {
            width: 80%;
            margin: 10% auto;
        }

        button{
            background-color:red;
            color:white;
            border:none;
        }
    </style>
    <title>Document</title>
</head>

<body>

    <h1>artikel saya</h1>
    <p>ini artikel saya</p>

    <textarea name="textarea_komentar" id="textarea_komentar" cols="30" rows="10"></textarea>
    <input type="submit" name="submit_komen" id="submit_komen">
 
<h1></h1>
    <div id="komentar-wraper">
      
        <?php 

            $query = mysqli_query($conn,"SELECT * FROM komentar  ORDER BY id DESC");
            ?>
           <?php  foreach ($query as $data) {?>
          
           <p class="komentar_text" id="komentar_<?= $data['id']; ?>"data-id="<?= $data['id'];?>" ><?= $data['isi_komentar']; ?>       
            </p>    
            <button type="button" class="hapus_komentar" data-id="<?= $data['id']; ?>">hapus</button>
            <button type="button" class="edit_komentar" data-id="<?= $data['id']; ?>">edit</button>
     
        
            <?php } ?>
    </div>
</body>

<script>
    
    $('#submit_komen').on('click', function() {
        var isi = $('#textarea_komentar').val();
        var isi2=  $('#textarea_komentar').val();
        if(isi ===""){
            alert('masukin dulu ngab');
        }else{
            $.ajax({
            type: "POST",
            url: "komentar_ajax.php",
            data: {
                isi_komentar: isi,type:"insert"
            },
            success: function(data) {
                console.log(data);
                   
               

                if(data =="gaboleh"){
                    alert('login dulu say');
                }else{
                    $("#komentar-wraper").prepend("<p>"+data+"</p>");  
                }
              
                isi2 = $('#textarea_komentar').val("");
                
             
            }


        });

   
        }

        
   

      
    })


    $(document).on('click','.hapus_komentar', function() {
        // var isi = $('#textarea_komentar').val();
        // var isi2=  $('#textarea_komentar').val();

        var id = $(this).attr('data-id');



     
       
            $.ajax({
            type: "POST",
            url: "komentar_ajax.php",
            data: {
                id: id,type :"delete"
            },
            success: function(data) {
                console.log(data);
                   
               

                if(data =="gaboleh"){
                    alert('login dulu say');
                }else if(data =="1"){
                    $("#komentar_"+id).fadeOut();  
                }
              
       
                
             
            }


        });
    });






    $(document).on('click','.komentar_text',function() {
        var id = $(this).attr('data-id');
        var isi1 = $('#komentar_'+id).text();
      
        var textbox= $(document.createElement('textarea')).attr('id','textarea_'+id).val(isi1);
        $(this).replaceWith(textbox);
        
    });


    
    $(document).on('click','.edit_komentar', function() {
        var id = $(this).attr('data-id');
        var isi= $('#textarea_'+id).val();
      
        var text= $(document.createElement('p')).attr({'id':'textarea_'+id,'class':'komentar_text','data-id':id}).text(isi);
        $('#textarea_'+id).replaceWith(text);



    

        $.ajax({
            type: "POST",
            url: "komentar_ajax.php",
            data: {
                isi_komentar:isi,id_komentar:id,type :"edit" 
            },
            success: function(data) {
                console.log(data);
                   
               

                if(data =="gaboleh"){
                    alert('login dulu say');
                }else if(data =="1"){
                    $('#textarea_'+id).replaceWith(text);
                }
              
       
                
             
            }


        });
    



    });

 


</script>

</html>