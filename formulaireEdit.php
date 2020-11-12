<!DOCTYPE html>
<head>
    <title>Blog</title> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
</head>
<body>

<?php

$connect = mysqli_connect("127.0.0.1", "root", "", "blog"); 

$id = $_GET['id']; // get id through query string

$qry = mysqli_query($connect,"select * from article where id='$id'"); // select query

$data = mysqli_fetch_array($qry); // fetch data

if(isset($_POST['update'])) // when click on Update button
{
    $Date = $_POST['Date'];
    $Titre = $_POST['Titre'];
    $Commentaire = $_POST['Commentaire'];
    $Photo = $_POST['Photo'];
	
    $edit = mysqli_query($connect,"update article set Date='$Date', Titre='$Titre' , Commentaire='$Commentaire' , Photo ='$Photo' where id='$id'");
	
    if($edit)
    {
        mysqli_close($connect); // Close connection
        header("location:Blog.php"); // redirects to all records page
        exit();
    }
    else
    {
        echo mysqli_error();
        header("location:blog.php"); // redirects to all records page
    }    	
}
?>

<h3>Update Data</h3>

<form method="POST">
  <input type="text" name="Date" value="<?php echo $data['Date'] ?>" placeholder="Enter Date" Required>
  <input type="text" name="Titre" value="<?php echo $data['Titre'] ?>" placeholder="Enter Titre" Required>
  <input type="text" name="Commentaire" value="<?php echo $data['Commentaire'] ?>" placeholder="Enter Commentaire" Required>
  <input type="file" name="Photo" value="<?php echo $data['Photo'] ?>" placeholder="Enter Photo" Required>
  <input type="submit" name="update" value="Update">
</form>
<a href="Blog.php">retour à la page des articles</a> 
</body>
</html>