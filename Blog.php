<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr"> 
   <head> 
      <title>Blog</title> 
      <meta charset="utf-8">  
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" href="bodystyle.css">
      <link rel="stylesheet" type="text/css" href="style.css">
      <link rel="stylesheet" type="text/css" href=".\bootstrap.css">
       <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>    
      <script type="text/javascript"  src= "bootstrap.js"></script>
   </head> 
<body style="background-color:#ebe7e0;">
    <div class="container-fluid">

  <nav class="navbar navbar-expand-lg navbar-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
  <a id="icon" href="Blog.php"><i class="fa fa-archive" aria-hidden="true" alt="Acceuil"></i>Acceuil</a>
      </li>
      <li class="nav-item active">
  <a id="icon" href="formulaireAjout.php"><i class="fa fa-plus-circle" aria-hidden="true" alt="Nouveau Article"></i>Nouveau Article</a>
      </li>
      <li class="nav-item active">
  <a id="icon" href="#frmComment"><i class="fa fa-arrow-circle-down" aria-hidden="true" alt="Bas de page"></i>Commentaire</a>
      </li>
      <li class="nav-item active">
  <a id="icon" href="#bas"><i class="fa fa-arrow-circle-down" aria-hidden="true" alt="Bas de page"></i>Bas de page</a>
      </li>
    </ul>  
</div>
</nav>
   <svg width='100%' height='200'>
  <filter id='money'>
    <feMorphology in='SourceGraphic' operator='dilate' radius='2' result='expand'/>

    <feOffset in='expand' dx='1' dy='1' result='shadow_1'/>
    <feOffset in='expand' dx='2' dy='2' result='shadow_2'/>
    <feOffset in='expand' dx='3' dy='3' result='shadow_3'/>
    <feOffset in='expand' dx='4' dy='4' result='shadow_4'/>
    <feOffset in='expand' dx='5' dy='5' result='shadow_5'/>
    <feOffset in='expand' dx='6' dy='6' result='shadow_6'/>
    <feOffset in='expand' dx='7' dy='7' result='shadow_7'/>

    <feMerge result='shadow'>
      <feMergeNode in='expand'/>
      <feMergeNode in='shadow_1'/>
      <feMergeNode in='shadow_2'/>
      <feMergeNode in='shadow_3'/>
      <feMergeNode in='shadow_4'/>
      <feMergeNode in='shadow_5'/>
      <feMergeNode in='shadow_6'/>
      <feMergeNode in='shadow_7'/>
    </feMerge>

    <feFlood flood-color='#ebe7e0'/>
    <feComposite in2='shadow' operator='in' result='shadow'/>

    <feMorphology in='shadow' operator='dilate' radius='1' result='border'/>
    <feFlood flood-color='#35322a' result='border_color'/>
    <feComposite in2='border' operator='in' result='border'/>

    <feOffset in='border' dx='1' dy='1' result='secondShadow_1'/>
    <feOffset in='border' dx='2' dy='2' result='secondShadow_2'/>
    <feOffset in='border' dx='3' dy='3' result='secondShadow_3'/>
    <feOffset in='border' dx='4' dy='4' result='secondShadow_4'/>
    <feOffset in='border' dx='5' dy='5' result='secondShadow_5'/>
    <feOffset in='border' dx='6' dy='6' result='secondShadow_6'/>
    <feOffset in='border' dx='7' dy='7' result='secondShadow_7'/>
    <feOffset in='border' dx='8' dy='8' result='secondShadow_8'/>
    <feOffset in='border' dx='9' dy='9' result='secondShadow_9'/>
    <feOffset in='border' dx='10' dy='10' result='secondShadow_10'/>
    <feOffset in='border' dx='11' dy='11' result='secondShadow_11'/>

    <feMerge result='secondShadow'>
      <feMergeNode in='border'/>
      <feMergeNode in='secondShadow_1'/>
      <feMergeNode in='secondShadow_2'/>
      <feMergeNode in='secondShadow_3'/>
      <feMergeNode in='secondShadow_4'/>
      <feMergeNode in='secondShadow_5'/>
      <feMergeNode in='secondShadow_6'/>
      <feMergeNode in='secondShadow_7'/>
      <feMergeNode in='secondShadow_8'/>
      <feMergeNode in='secondShadow_9'/>
      <feMergeNode in='secondShadow_10'/>
      <feMergeNode in='secondShadow_11'/>
    </feMerge>

    <feImage x='0' y='0' width='100%' height='200' xlink:href='https://s3-us-west-2.amazonaws.com/s.cdpn.io/78779/stripes.svg'/>
    <feComposite in2='secondShadow' operator='in' result='secondShadow'/>

    <feMerge>
      <feMergeNode in='secondShadow'/>
      <feMergeNode in='border'/>
      <feMergeNode in='shadow'/>
      <feMergeNode in='SourceGraphic'/>
    </feMerge>
  </filter>

  <text dominant-baseline='middle' text-anchor='middle' x='50%' y='50%'>
  SHIT POSTING !!!
  </text>
</svg>

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
         if ($ligne['Photo'] != "") { 
            echo "<img src='photos/".$ligne['Photo']."' width='500px' height='500px'/>";
             echo "<div id='text'>".$ligne['Commentaire']." </div>"; 
         }  
         
         ?>
         <div id="bouton">
          <?php
         echo "<a href='formulaireDelete.php?id=".$ligne['id']."'><input type=submit value=Delete></a>";
         echo "<a href='formulaireEdit.php?id=".$ligne['id']."'><input type=submit value=Edit></a>";
         ?>
         </div>       
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
    <div id="bas"></div>
   <br /> 
</div>
</body> 
</html>