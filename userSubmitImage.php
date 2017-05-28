<?php
include('../../dbConnect.php');
include('../../header.php');
include('../../validation.php');
?>


<!-- start main content -->
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div id="containerUserSubmissionPage" style='width:80%;margin-left:5%;margin-right:5%;'>

                    <h1>User Image Submission</h1>

<p>View all images <a href="http://nathanmante.com/News/userImages/userImagesHome.php">here</a>.</p>

<div id="column1userImgSubmit" style='width:45%;display:inline-block;vertical-align:top;'>
  <div id="containerImageSubmissionForm">

<h2>Submit Your Image</h2>

  <!--form to submit images-->
    <form name="userSubImage" class="form-horizontal" enctype="multipart/form-data" method="post" action="">

      <div>
      <label class="control-label" for="userSubmissionTitle">User Submission Title: </label>
      <input class="form-control" id="userSubmissionTitle" type="text" name="userSubmissionTitle"/>
      </div>

      <div>
      <label class="control-label" for="userSubmissionCat">Search Term: </label>
      <input class="form-control" id="userSubmissionCat" type="text" name="userSubmissionCat"/>
      </div>
      

      <div>
      
      <label class="control-label" for="userImageImg">Image: </label>
      <input class="form-control" type="file" name="userImageImg" id="userImageImg" />
      </div>

      <br/>


      <input class="btn btn-primary" type="submit" value="Submit Your Photo" name="submitImg" id="submitImg" />


    </form>
  </div>

  <div id="containerImageSubmissionAction">

    <?php

    //on submission of form
    if(isset($_POST["submitImg"]))
    {
        //database connection
        $conn = new Dbconnect;
        $db = $conn->getDb();

        $val = new Validate();
          
        $currentDate = date("Y-m-d");
        $imgUserID = $_SESSION['userId'];
        $imgTitle = $_POST['userSubmissionTitle'];
        $imgAuthor = $_SESSION['userName'];
        $imgCategory = $_POST['userSubmissionCat'];

        //validate
        $valTitle = $val->text($imgTitle);
        $valCategory = $val->text($imgCategory);

    //get information about image
      $type = pathinfo($_FILES["userImageImg"]["tmp_name"],PATHINFO_EXTENSION);
      $image = file_get_contents($_FILES["userImageImg"]["tmp_name"]);

    //database query
        $query = "INSERT INTO userimages (userID, title, author, image, type, dateSubmitted, category) VALUES (:imgUserID, :imgTitle, :imgAuthor, :image, :type, :currentDate, :imgCategory)";

      $statement = $db->prepare($query);

      $statement->bindValue(':imgUserID', $imgUserID, PDO::PARAM_INT);

      $statement->bindValue(':imgTitle', $imgTitle, PDO::PARAM_STR);
      $statement->bindValue(':imgAuthor', $imgAuthor, PDO::PARAM_STR);
      $statement->bindValue(':currentDate', $currentDate, PDO::PARAM_STR);
      $statement->bindValue(':imgCategory', $imgCategory, PDO::PARAM_STR);


      $statement->bindValue(':type', $type, PDO::PARAM_LOB);
      $statement->bindValue(':image', $image, PDO::PARAM_LOB);

      $statement->execute();

      echo "Thank you, {$imgAuthor}, your image has been submitted.";

      $conn=null;
    }
    ?>


  </div> <!--end containerImageSubmissionAction div -->



</div><!--column1userImgSubmit-->

<div id="column2userImgSubmit" style='width:45%;display:inline-block;vertical-align:top;'>




  <div id="containerDeleteImgForm">

    <h2>Delete An Image</h2>

    <!--form to delete images-->
    <form class="form-horizontal" name="userDeleteImg" enctype="multipart/form-data" method="post" action="">


      <div>
      <label class="control-label" for="userDeleteImgID">ID of Image to Delete: </label>
      <input class="form-control" id="userDeleteImgID" type="text" name="userDeleteImgID"/>
      </div>

      <br/>

      <input class="btn btn-secondary" type="submit" value="Delete Your Photo" name="DeleteUserImg" id="DeleteUserImg" />

    </form>


  </div> <!--end for containterDeleteImgForm-->

<div id='containerDeleteAction'>

<?php

 if(isset($_POST["DeleteUserImg"]))
    {
        //database connection
        $conn2 = new Dbconnect;
        $db2 = $conn2->getDb();

        //get info from form
        $userDeleteID = $_SESSION['userId'];
        $userDeleteImgID = $_POST['userDeleteImgID'];

        //db query
        $query2 = "DELETE FROM userimages WHERE imageID=$userDeleteImgID";

      //prepare and bind values 
      $statement2 = $db2->prepare($query2);

      $statement2->bindValue(':userDeleteImgID', $userDeleteImgID, PDO::PARAM_INT);

      $statement2->bindValue(':userDeleteID', $userDeleteID, PDO::PARAM_INT);


      $statement2->execute();

      echo "Thank you";

      $conn2=null;
    }
    ?>


  </div> <!--end containerDeleteAction div-->

  <div id='containerUpdateForm'>

  <h2>Update A Title</h2>

  <form name="userUpdateTitle" enctype="multipart/form-data" method="post" action="">



    <div>
    <label class="control-label" for="userUpdateImgID">ID of Image to Update: </label>
    <input class="form-control" id="userUpdateImgID" type="text" name="userUpdateImgID"/>
    </div>

    <div>
    <label class="control-label" for="userUpdateImgTitle">New Title: </label>
    <input class="form-control" id="userUpdateImgTitle" type="text" name="userUpdateImgTitle"/>
    </div>

    <br/>

    <input class="btn btn-seondary" type="submit" value="Update Image Title" name="UpdateUserImg" id="UpdateUserImg" />

</form>



</div> <!--end updatecontainerform div-->

<div id='containerArticleUpdateAction'>


<?php

//on submission of update form
    if(isset($_POST["UpdateUserImg"]))
    {
        //database connection
        $conn3 = new Dbconnect;
        $db3 = $conn3->getDb();

        
        $userUpdateID = $_SESSION['userId'];
        $userUpdateImgID = $_POST['userUpdateImgID'];
        $userUpdateImgTitle = $_POST['userUpdateImgTitle'];

    //database query
      $query3 = "UPDATE userimages SET title='$userUpdateImgTitle' WHERE imageID=$userUpdateImgID";

      $statement3 = $db3->prepare($query3);
      $statement3->execute();
      echo "Thank you, updated.";

      $conn3=null;
    }
    ?>

</div> <!--containerArticleUpdateAction-->


</div><!--column2userImgSubmit-->


  </div><!--end containerUserSubmissionPage div-->
           
            </div><!--End of col-lg-12-->
        </div><!--End of row-->
    </div><!--End of container-->
</div><!--End of main-content-->
                
     <?php
     include('../../footer.php');
     ?>


    