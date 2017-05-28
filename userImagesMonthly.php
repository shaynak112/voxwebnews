<?php
require_once('../dbConnect.php');
require_once('../header.php');
?>



<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- start post -->
                <article class="post single-post">
                    <div class="post-content">

<h1>Current Month Images</h1>

</div>


<?php
  //set up database query
    $dbconn = new Dbconnect;
    $db = $dbconn->getDb();
    $query = 'SELECT * FROM userimages ORDER BY dateSubmitted DESC';
    $statement = $db->prepare($query);
    $statement->execute();
    $userimages = $statement->fetchAll(PDO::FETCH_OBJ);
?>

<div id="userImagesArchiveWrapper">
<div class='row'>

<?php


$increment = 0;


  //foreach to go through the array
  foreach($userimages as $userimages)
    {

      //get today's date and determine the difference
      $today = date("Y-m-d");
      $submitted =  $userimages->dateSubmitted;

      $todayStr = strtotime($today);
      $submittedStr = strtotime($submitted);

      $secondsDiff = $todayStr - $submittedStr;
      $daysDiff = floor($secondsDiff / (24*60*60));

      if($daysDiff>31)
      {
        break;
      }
      else if($increment%4==0)
      {
        echo "</div>";
        echo "<div class='row'>";
        echo "<div class='col-md-3' style='left:2%;margin-bottom:30px;'>";
        echo "<img src='imageViewer.php?id={$userimages->imageID}' style='width:80%;'>";
        echo "<div><strong>" . $userimages->title . "</strong></div>";
        echo "<div>By: " . $userimages->author . "</div>";
        echo "<div>Date: " . $userimages->dateSubmitted . "</div>";
        echo "<div>Image ID: " . $userimages->imageID  . "</div> </div>";
      }
      else
      {
        echo "<div class='col-md-3' style='margin-bottom:50px;'>";
        echo "<img src='imageViewer.php?id={$userimages->imageID}' style='width:80%;'>";
        echo "<div><strong>" . $userimages->title . "</strong></div>";
        echo "<div>By: " . $userimages->author . "</div>";
        echo "<div>Date: " . $userimages->dateSubmitted . "</div>";
        echo "<div>Image ID: " . $userimages->imageID  . "</div> </div>";
      }  
      
      $increment++;            
    }
  ?>
  

</div>



<div>
Return to <a href="userImagesHome.php">Weekly Photos Page</a>.
</div>    
<div>
Check out the <a href="userImagesArchiveSearch.php">Complete Photo Archive</a>.
</div>




</div>




</article>



</div>

<?php
  include '../createAccountWidget.php';
?>

</div>
</div>
</div>

<?php
require_once('../footer.php');
?>
