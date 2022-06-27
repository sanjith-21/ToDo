<?

$mysqli = mysqli_connect("mysql.selfmade.ninja", "sanjith_mysql", "Sanjith21", "sanjith_mysql_DB1");
if (!$mysqli) {
  die("Connection failed: " . mysqli_connect_error());
}
$comment="";
if(isset($_POST['submit'])){
  $todovalue=$_POST['todo'];
  if(empty($todovalue)){
    $comment="You must fill something!!";
  }else{
      $query="INSERT INTO todotable(data) VALUES ('$todovalue')";
      mysqli_query($mysqli, $query);
      header('location:index.php');
  }
}
  
//for deleting any task
  if (isset($_GET['del_task'])) {
      $id=$_GET['del_task'];
      mysqli_query($mysqli, "DELETE FROM todotable WHERE id=$id");
      header('location:index.php');
  }
 $fetched_result=mysqli_query($mysqli, "SELECT * FROM todotable");


?>
<!DOCTYPE html>
<html>
    <head>
    <title>TODO List</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div class="heading">
        <h2>To Do application</h2>
        </div>
     <form method="post" action="index.php" class="input_form">
      <? if(isset($comment)){ ?>
            <p><?  echo $comment ;?></p>

        <? } ?>
      <input type="text"  name="todo" class="task_input">
      <button type="submit" name="submit" id="add_btn" class="add_btn">Add Task</button>

</form>
<table>
<thead>
  <tr>
    <th>N</th>
    <th>Tasks</th>
    <th>Action</th>
  </tr>
</thead>
<tbody>
  <? $i=1;while($row=mysqli_fetch_array($fetched_result)){ ?>
  <tr>
    <td><? echo $i; ?></td>
    <td class="task"><? echo $row['data']; ?></td>
    <td class="delete"><a href="index.php?del_task=<? echo $row['id']; ?>">x</a></td>
  </tr>
  <?php $i++;} ?>
</tbody>
</table>
    </body>
</html>