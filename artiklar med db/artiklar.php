<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
  
  <link rel="stylesheet" href="css/master.css">
  
  <meta charset="utf-8">
  <title></title>
</head>
<body>
  
  <?php
  session_start();

  $_SESSION['user']=session_id();
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  require_once('cart.php');
  require_once('dbcon.php');
  
  echo'<button id="cartbutton"> cart </button>';
  echo'<div id="cart" style="display:none; position:absolute; width:400px; left:300px; top:100px; z-index:10; color:grey; background-color:white; padding:100px;border: 2px solid;">';
  
  cart();
  echo'</div>';
  
  $db=new dbcon();
  $stmt=$db->pdo->query('select * from artiklar');
  $stmt->execute();
  $artiklar=$stmt->fetchAll();
  
  echo"<div class=\"container \">\n";
  $counter =0;
  foreach ($artiklar as $artikel) {
    
    if ($counter%3==0){
      echo "<div class=\"row\">";
      
    }
    
echo <<<ARTIKEL
    
    <div class="card" style="width: 18rem;">
    <img class="card-img-top" src="bilder/{$artikel['bild']}" alt="Card image cap">
    <div class="card-body">
    <h5 class="card-title">{$artikel['rubrik']}</h5>
    <p class="card-text">{$artikel['beskrivning']}</p>
    <p class="card-text">pris: {$artikel['pris']} kr</p>
    
    <form action="addtocart.php" metod="get">
    <input type="hidden" name="artikel_id" value="{$artikel['art_pk']}">
    <input class="btn btn-primary" type="submit" value="Köp">
    <select name="antal" id="select">
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    </select>
    </form>    
    </div>
    </div>
    
    
ARTIKEL;
    
    
    $counter++;
    if ($counter%3==0){
      echo "</div>";
      
    }
  }
  
  
  echo"</div>";
  
  ?>
  
  
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
  <script type="text/javascript">
  
  
  $("#cartbutton").click(function() {
    
    $('#cart').toggle();
  });
  
  
  
  $(".delete").click(function(){
    
      $.get( "deleteone.php", { cartartikel_pk: this.id } )
      .done(function( data ) {
        alert( "Data Loaded: " + data );
      });
  
  });
  
  
  
  
</script>



</body>
</html>
