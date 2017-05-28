<?php
require_once('../dbConnect.php');
require_once('../header.php');
?>

<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-offset-1">
                <!-- start post -->
                <article class="post single-post">

<h1 style='margin-left:2%;'>Weekly Submitted Images Slide Show</h1>


<div class='row'>

<?php

  //set up database query
    $dbconn = new Dbconnect;
    $db = $dbconn->getDb();
    $query = 'SELECT * FROM userimages ORDER BY dateSubmitted DESC';
    $statement = $db->prepare($query);
    $statement->execute();
    $userimages = $statement->fetchAll(PDO::FETCH_OBJ);

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

      echo "<div id='userImagesSSDiv' class='col-md-10 col-offset-1';>";
      //only show images if they were submitted within the past week
      if($daysDiff<8)
      {
        echo "<div class='slides col-md-10 col-offset-1'>";
        echo "<p style='font-size:1.5em;'>" . $userimages->title . "</p>";
        echo "<p><img id='slidesImg' src='imageViewer.php?id={$userimages->imageID}' style='height:500px;' /></p>";
        echo "<div style='font-size:1em;'>Submitted by: " . $userimages->author . "  on: " .  $userimages->dateSubmitted . "</div>";
        echo "<div style='font-size:1em;'>Image ID: " . $userimages->imageID  . "</div>";
        echo "<br/>";
        echo "</div>";
      }

      echo "</div>";
    }
  ?>


</div>
<div style='margin-left:5%;'>
<div>You can view the <a href="userImagesMonthly.php">photos from the past month here</a>.</div>
<div>You can check out the <a href="userImagesArchiveSearch.php">archived photos</a> or log in to submit a photo yourself!</div>
<br/>
<br/>
</div>
</div><!--userImagesViewWrapperMain-->



</div>



</article>
</div>
</div>
</div>

</div><!--userImagesWrapper-->
<script type='text/javascript' src="userImagesScript.js"></script>

      
    
<?php
require_once('../footer.php');
?>



