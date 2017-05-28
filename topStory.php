<?php
require_once('../dbConnect.php');
require_once('../header.php');

?>



<!-- start main content -->
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- start post -->
                <article class="post single-post">
                    <div class="post-content">

<div class="row">
<div class="col-lg-12">
<h1 style='margin-left:5%;'>Articles</h1>
<div style='margin-left:5%;'><a href="searchArticles.php">Search through the articles?</a></div>
<br/>
</div>
</div>



<?php
  //set up database query

    $dbconn = new Dbconnect;
    $db = $dbconn->getDb();
  	$query = 'SELECT * FROM content ORDER BY storyDate DESC';
  	$statement = $db->prepare($query);
  	$statement->execute();
  	$topstories = $statement->fetchAll(PDO::FETCH_OBJ);
    $increment = 1;
    
?>



<div class="row"><!--first three articles-->

  <?php
   foreach($topstories as $topstories)
    if($increment <= 3)
      {
        echo "<div class='col-md-4' style='vertical-align:top;margin-bottom:2px;'>";
        echo "<a href='singlePage.php?id=" . "{$topstories->contentID}' style='text-decoration:none;'><h2 style='color:#de615e;'>" . $topstories->storyTitle . "</h2>";
        echo "<div><img src='topStoryViewerImg.php?id={$topstories->contentID}' style='width:70%;margin-left:10%;top:0px;display:inline-block;margin-top:0px;'></div></a>";
        echo "<br/>";
        echo "<div> Author: " . $topstories->storyAuthorFirstName . " " . $topstories->storyAuthorLastName . "</div>";
        echo "<div> Date: " . $topstories->storyDate . "</div>";
        echo "<br/>";
        echo "<div>" . $topstories->description . "</div>";
        echo "<div style='word-wrap:break-word;'><a href={$topstories->citation} target='_blank'>" . $topstories->citation . "</a></div>";
        echo "</div>";
        $increment++;
      }
      else if ($increment = 4)
      {
        //echo "</div>";
      }
      else
      {
        break;
      }

  ?>
  </div>

<br/>
<br/>
<br/>

<?php
  //set up database query

    $dbconn1 = new Dbconnect;
    $db1 = $dbconn1->getDb();
    $query1 = 'SELECT * FROM content ORDER BY storyDate DESC';
    $statement1 = $db1->prepare($query1);
    $statement1->execute();
    $topstories1 = $statement1->fetchAll(PDO::FETCH_OBJ);
    $increment = 0;
    
?>

<div class="row"><!--starting row for articles 4 to end-->
<?php
  foreach($topstories1 as $topstories)
  {
    if($increment%4==0)
      {
        echo "</div>";
        echo "<div class='row' style='vertical-align:bottom;bottom:0;margin-bottom:0;border-bottom:solid 2px;'>";
        echo "<div class='col-md-3' style='bottom:0;margin-bottom:0;'>";
        echo "<a href='singlePage.php?id=" . "{$topstories->contentID}' class='contentTitle'><h4>" . $topstories->storyTitle . "</h4>";
       echo "<p><img src='topStoryViewerImg.php?id={$topstories->contentID}' class='topTenStoryImg' style='width:80%;margin-left:10%;bottom:0;margin-bottom:0;'></p></a>";
        echo "</div>";
        $increment++;
      }
      else if (!$increment%4==0)
      {
        echo "<div class='col-md-3' style='bottom:0;margin-bottom:0;'>";
        echo "<a href='singlePage.php?id=" . "{$topstories->contentID}' class='contentTitle'><h4>" . $topstories->storyTitle . "</h4>";
       echo "<p><img src='topStoryViewerImg.php?id={$topstories->contentID}' class='topTenStoryImg' style='width:80%;margin-left:10%;bottom:0;margin-bottom:0;'></p></a>";
        echo "</div>";
        $increment++;
      } 
      else
      {
        break;
      } 
  }



?>


</div>


</div>
</article>
</div>
</div>
</div>
</div>

<br/>
<br/>



<?php
require_once('../footer.php');
?>