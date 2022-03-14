 
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
 
    <title>CP</title>
    <style>

    sup{
  color:#FF0000;
}

        .error {
            color: #FF0000;
        }


        body{
            font-family:  Copperplate, Papyrus, fantasy;
            background-color:#CE4F33;
            background-image: url('g1.jpg');
            background-repeat: repeat-x ;
            background-color:#0099ff;
             background-size: cover;
        }
        .button {
  border: none;
  color: black;
  border-radius: 2px;
  padding: 5px 7px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 12px;
  margin: 4px 2px;
  cursor: pointer;
}


    </style>
  </head>



  <body>
  <?php 
include './navb.php';
?>

  <b>
   <div class="container" style="background-color:rgba(206, 79, 51, 0.7);">
    

     
        <div class="card" style="background-color:rgba(206, 79, 51, 0.5);">
        <div class="card-body" style="background-color:rgba(206, 79, 51, 0.5);">
        
        <h1 align="center" style="font-family:  Copperplate, Papyrus, fantasy;background-color:#CE4F33;">Your blog has been posted</H1>
           <a href="createpost.php"> <button > Go Back </button>
</div>
</div>
   
 
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
 
   
  </body>
</html>

 <?
    header('Location: details1.php?Post_id='.$Post_id );
    ?>