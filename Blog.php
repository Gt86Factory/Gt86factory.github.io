<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr"> 
   <head> 
      <title>Blog</title> 
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
      <link rel="stylesheet" type="text/css" href="style.css">
      <script type="text/javascript" src="jquery-3.2.1.min.js"></script>
   </head> 
<body> 
   <h2>Blog</h2> 
   <hr /> 
   <?php 
   $connect = mysqli_connect("127.0.0.1", "root", "", "blog"); 
 
   /* Vérification de la connexion */ 
   if (!$connect) { 
      echo "Échec de la connexion : ".mysqli_connect_error(); 
      exit(); 
   } 
 
   $requete = "SELECT * FROM article ORDER BY Date"; 
   if ($resultat = mysqli_query($connect,$requete)) { 
      date_default_timezone_set('Europe/Paris'); 
      /* fetch le tableau associatif */ 
      while ($ligne = mysqli_fetch_assoc($resultat)) { 
         $dt_debut = date_create_from_format('Y-m-d H:i:s', $ligne['Date']); 
         echo "<h3>".$ligne['Titre']."</h3>"; 
         echo "<h4>Le ".$dt_debut->format('d/m/Y H:i:s')."</h4>"; 
         echo "<div style='width:400px'>".$ligne['Commentaire']." </div>"; 
         if ($ligne['Photo'] != "") { 
            echo "<img src='photos/".$ligne['Photo']."' width='200px' height='200px'/>";
         } 
         echo "<a href='formulaireDelete.php?id=".$ligne['Id']."'><input type=submit value=Delete></a>";
         echo "<a href='formulaireEdit.php?id=".$ligne['Id']."'><input type=submit value=Edit></a>";
         ?>       
         <?php
         echo "<hr />";   

      } 
   } 
   ?> 
<div class="demo-container">
    <form action=" " id="frmComment" method="post">
      <div class="row">
        <label> Name: </label> <span id="name-info"></span><input class="form-field" id="name"
          type="text" name="user"> 
      </div>
      <div class="row">
        <label for="mesg"> Message : <span id="message-info"></span></label>
        <textarea class="form-field" id="message" name="message" rows="4"></textarea>
        
      </div>
      <div class="row">
        <input type="hidden" name="add" value="post" />
        <button type="submit" name="submit" id="submit" class="btn-add-comment">Add Comment</button>
        <img src="LoaderIcon.gif" id="loader" />
      </div>
    </form>
<?php
include_once 'db.php';

$sql_sel = "SELECT * FROM tbl_user_comments ORDER BY id DESC";
$result = $conn->query($sql_sel);
$count = $result->num_rows;

    if($count > 0) {
?>
        <div id="comment-count">
        <span id="count-number"><?php echo $count;?></span> Comment(s)
        </div>
<?php } ?>
    <div id="response">
<?php
while ($row = $result->fetch_array(MYSQLI_ASSOC)) // using prepared staement
{
?>
      <div id="comment"  class="comment-row"><?php echo $row['id'];?></div>
        <div class="comment-user"><?php echo $row['username'];?></div>
        <div class="comment-msg" id="msgdiv"><?php echo $row['id'];?><?php echo $row['message'];?></div>
        <div class="delete" name="delete" id="delete"<?php echo $row['id'];?>
          onclick="deletecomment(<?php echo $row['id'];?>)">Delete</div>
      </div>
<?php 
}
?>
    </div>
  </div>

  <script type="text/javascript"></script>
  <script>

    function deletecomment(id) {

       if(confirm("Are you sure you want to delete this comment?")) {

            $.ajax({
            url: "comment-delete.php",
            type: "POST",
            data: 'comment_id='+id,
            success: function(data){
                if (data)
                {
                    $("#comment-"+id).remove();
                    if($("#count-number").length > 0) {
                        var currentCount = parseInt($("#count-number").text());
                        var newCount = currentCount - 1;
                        $("#count-number").text(newCount)
                    }
                }
            }
           });
        }
     }

  $(document).ready(function() {

        $("#frmComment").on("submit", function(e) {
            $(".error").text("");
            $('#name-info').removeClass("error");
            $('#message-info').removeClass("error");
            e.preventDefault();
            var name = $('#name').val();
            var message = $('#message').val();
            
            if(name == ""){
                $('#name-info').addClass("error");
            }
            if(message == ""){
                $('#message-info').addClass("error");
            }
            $(".error").text("required");
            if(name && message){
                  $("#loader").show();
                $("#submit").hide();
                $.ajax({
                
                 type:'POST',
                 url: 'comment-add.php',
                 data: $(this).serialize(),
                 success:function(response)
                    {
            $("#frmComment input").val("");
            $("#frmComment textarea").val("");
                      $('#response').prepend(response);

                         if($("#count-number").length > 0) {
                             var currentCount = parseInt($("#count-number").text());
                             var newCount = currentCount + 1;
                             $("#count-number").text(newCount)
                         }
                         $("#loader").hide();
                    $("#submit").show();
                     }
                  });
      }
    });
     });
    </script>
   <br /> 
</div>
   <a href="formulaireAjout.php">retour à la page d'insertion</a>
</body> 
</html>