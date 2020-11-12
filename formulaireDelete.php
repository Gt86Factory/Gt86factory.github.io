<!DOCTYPE html>
<head>
   	<title>Blog</title> 
      <meta http-equiv="Content-Type" content="text/html; 
charset=utf-8" /> 
</head>
<body>

<?php

$connect = mysqli_connect("127.0.0.1", "root", "", "blog"); 

$id = $_GET['id']; // get id through query string

$del = mysqli_query($connect,"delete from article where id ='$id' "); // delete query

if($del)
{
    mysqli_close($connect); // Close connection
    header("location:Blog.php"); // redirects to all records page
    echo "<a href='Blog.php?'>retour à la page des articles</a>";
    exit;
   
}
else
{
    echo "Echec"; // display error message if not delete
    header("location:Blog.php"); // redirects to all records page
}
?>
</body>
</html>