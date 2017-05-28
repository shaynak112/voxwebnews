<?php
require_once('../dbConnect.php');
require_once('../header.php');
?>


<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-offset-1">
            <article class="post single-post">
            
<h1>Search Through Archives</h1>

<br/>
<br/>




<div class='row' id='searchRow'>

  <div id="searchImgsWrapper" class='col-md-12'>

  <div class='col-md-3' id='userImgSearchCategory'>
    <form id="searchCategoryForm" class="form-horizontal" action="" method="post">
      <label class="control-label" id="searchImgCategory">Search by Category: </label>
      <input type="text" class="form-control" name="searchImgCategory" id="searchImgCategory"/>
      <input type="submit" class="btn btn-primary" id="categoryImgSearch" name="categoryImgSearch" value="Search" />
    </form>
  </div>

  <div class='col-md-3' id='userImgSearchAuthor'>
    <form id="searchAuthorForm" class="form-horizontal" action="" method="post">
      <label class="control-label" id="searchImgAuthor">Search by Author: </label>
      <input type="text" class="form-control" name="searchImgAuthor" id="searchImgAuthor"/>
      <input type="submit" class="btn btn-primary" id="authorImgSearch" name="authorImgSearch" value="Search" />
    </form>
  </div>

  <div class='col-md-3' id='userImgSearchTitle'>
    <form id="searchTitleForm" class="form-horizontal" action="" method="post">
      <label class="control-label" id="searchImgTitle">Search by Title: </label>
      <input type="text" class="form-control" name="searchImgTitle" id="searchImgTitle"/>
      <input type="submit" class="btn btn-primary" id="titleImgSearch" name="titleImgSearch" value="Search" />
    </form>
  </div>

  </div>

</div><!--end row for searches forms-->

<div class='row' id='searchResults'>

<div class='col-md-12' id='searchResultColumn'>
<?php

        if(isset($_POST['categoryImgSearch']))
          {
             $dbconn = new Dbconnect;
            $db = $dbconn->getDb();
             $searchCat = $_POST['searchImgCategory'];
             $query = "SELECT * FROM userimages WHERE category LIKE '%$searchCat%' ORDER BY dateSubmitted DESC";
            $statement = $db->prepare($query);
            $statement->bindValue(':%$searchCat%', '%$searchCat%', PDO::PARAM_STR);
            $statement->execute();
           

            
           echo "<br/>";
           echo "<h2 style='margin-left:2%;'> Category Search Term: " . $searchCat;
            echo "</h2>";
            echo "<br/>";

          echo "<div class='row'>";

            $increment = 0;

          if (!$statement->rowCount() == 0)
            {
              while ($results = $statement->fetch())
              {
                  if($increment%4==0)
                  {
                    echo "</div>";
                    echo "<div class='row'>";
                    echo "<div class='col-md-3' style='left:2%;margin-bottom:30px;'>";
                    echo "<img src='imageViewer.php?id=" . $results['imageID'] . "' style='width:80%;'>";
                    echo "<div><strong>" . $results['title'] . "</strong></div>";
                    echo "<div>By: " . $results['author'] . "</div>";
                    echo "<div>Date: " . $results['dateSubmitted'] . "</div>";
                    echo "<div>Image ID: " . $results['imageID']  . "</div> </div>";
                    $increment++; 
                  }
                  else if(!$increment%4==0)
                  {
                    echo "<div class='col-md-3' style='margin-bottom:50px;'>";
                  echo "<img src='imageViewer.php?id=" . $results['imageID'] . "' style='width:80%;'>";
                  echo "<div><strong>" . $results['title'] . "</strong></div>";
                    echo "<div>By: " . $results['author'] . "</div>";
                    echo "<div>Date: " . $results['dateSubmitted'] . "</div>";
                    echo "<div>Image ID: " . $results['imageID']  . "</div> </div>";
                    $increment++; 
                  }  
                  else
                  {
                    echo "No results";
                    break;

                  }
                             
              }
            }
            else
            {
              echo "<div style='margin-left:15%;font-size:1.5em;'><strong>";
              echo "Sorry, no results, try narrowing down your search.";
              echo "</strong></div>";
              echo "<br/>";
              echo "<br/>";
            }
          }


          if(isset($_POST['authorImgSearch']))
          {
             $dbconn = new Dbconnect;
            $db = $dbconn->getDb();
             $searchAuth = $_POST['searchImgAuthor'];
             $query = "SELECT * FROM userimages WHERE author LIKE '%$searchAuth%' ORDER BY dateSubmitted DESC";
            $statement = $db->prepare($query);
            $statement->bindValue(':%$searchAuth%', '%$searchAuth%', PDO::PARAM_STR);
            $statement->execute();


            echo "<br/>";
           echo "<h2 style='margin-left:2%;'> Author Search Term: " . $searchAuth;
            echo "</h2>";
            echo "<br/>";

          echo "<div class='row'>";

            $increment = 0;

          if (!$statement->rowCount() == 0)
            {
              while ($results = $statement->fetch())
              {
                  if($increment%4==0)
                  {
                    echo "</div>";
                    echo "<div class='row'>";
                    echo "<div class='col-md-3' style='left:2%;margin-bottom:30px;'>";
                    echo "<img src='imageViewer.php?id=" . $results['imageID'] . "' style='width:80%;'>";
                    echo "<div><strong>" . $results['title'] . "</strong></div>";
                    echo "<div>Date: " . $results['dateSubmitted'] . "</div>";
                    echo "<div>Category: " . $results['category'] . "</div>";
                    echo "<div>Image ID: " . $results['imageID']  . "</div> </div>";
                    $increment++; 
                  }
                  else if(!$increment%4==0)
                  {
                    echo "<div class='col-md-3' style='margin-bottom:50px;'>";
                  echo "<img src='imageViewer.php?id=" . $results['imageID'] . "' style='width:80%;'>";
                  echo "<div><strong>" . $results['title'] . "</strong></div>";
                    echo "<div>Date: " . $results['dateSubmitted'] . "</div>";
                    echo "<div>Category: " . $results['category'] . "</div>";
                    echo "<div>Image ID: " . $results['imageID']  . "</div> </div>";
                    $increment++; 
                  }  
                  else
                  {
                    echo "No results";
                    break;

                  }
                             
              }
            }
            else
            {
              echo "<div style='margin-left:15%;font-size:1.5em;'><strong>";
              echo "Sorry, no results, try narrowing down your search.";
              echo "</strong></div>";
              echo "<br/>";
              echo "<br/>";
            }
          }


          if(isset($_POST['titleImgSearch']))
          {
             $dbconn = new Dbconnect;
             $db = $dbconn->getDb();
             $searchTitle = $_POST['searchImgTitle'];
             $query = "SELECT * FROM userimages WHERE title LIKE '%$searchTitle%' ORDER BY dateSubmitted DESC ";
            $statement = $db->prepare($query);
            $statement->bindValue(':%$searchTitle%', '%$searchTitle%', PDO::PARAM_STR);
            $statement->execute();

          echo "<br/>";
           echo "<h2 style='margin-left:2%;'> Title Search Term: " . $searchTitle;
            echo "</h2>";
            echo "<br/>";

          echo "<div class='row'>";

            $increment = 0;

          if (!$statement->rowCount() == 0)
            {
              while ($results = $statement->fetch())
              {
                  if($increment%4==0)
                  {
                    echo "</div>";
                    echo "<div class='row'>";
                    echo "<div class='col-md-3' style='left:2%;margin-bottom:30px;'>";
                    echo "<img src='imageViewer.php?id=" . $results['imageID'] . "' style='width:80%;'>";
                    echo "<div><strong>By: " . $results['author'] . "</strong></div>";
                    echo "<div>Date: " . $results['dateSubmitted'] . "</div>";
                    echo "<div>Category: " . $results['category'] . "</div>";
                    echo "<div>Image ID: " . $results['imageID']  . "</div> </div>";
                    $increment++; 
                  }
                  else if(!$increment%4==0)
                  {
                    echo "<div class='col-md-3' style='margin-bottom:50px;'>";
                  echo "<img src='imageViewer.php?id=" . $results['imageID'] . "' style='width:80%;'>";
                  echo "<div><strong>By: " . $results['author'] . "</strong></div>";
                    echo "<div>Date: " . $results['dateSubmitted'] . "</div>";
                    echo "<div>Category: " . $results['category'] . "</div>";
                    echo "<div>Image ID: " . $results['imageID']  . "</div> </div>";
                    $increment++; 
                  }  
                  else
                  {
                    echo "No results";
                    break;

                  }
                             
              }
            }
            else
            {
              echo "<div style='margin-left:15%;font-size:1.5em;'><strong>";
              echo "Sorry, no results, try narrowing down your search.";
              echo "</strong></div>";
              echo "<br/>";
              echo "<br/>";
            }
            
          }
          

?>

</div><!--end search result column-->

</div> <!--end searchResultsRow-->
<br/>
<br/>
<br/>
<div style='margin-left:5%;'>
  <div>
  Return to <a href="userImagesHome.php">Weekly Photos Page</a>.
  </div>
  <div>
  Or check out the <a href="userImagesMonthly.php">photos from the past month</a>.
  </div>
</div>
  <br/>

</div>
</div>



</article>

<br/>


<div class='row' id='navImgs'>
<div class='col-md-8 col-offset-2' id='navImgsDiv'>


</div>
</div>

</div>
</div>
</div>
</div>

<?php
require_once('../footer.php');
?>
