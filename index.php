<?php
/**
 * Created by PhpStorm.
 * User: Nate
 * Date: 2017-05-09
 * Time: 12:44 AM
 */
include 'header.php';

require_once 'dbConnect.php';
require_once 'Subscription/subscribeClass.php';
require_once 'Subscription/insertSub.php';
require_once 'validation.php';
require_once 'gmail.php';

//This is to send an email after user submits
global $userFirst, $userLast, $userCity, $userEmail, $fname, $lname,
       $email, $successMessage;

$mydi = new Dbconnect();
$pdoconn = $mydi->getDb();
$mySub = new DbSubscription();
$ins = new subscription();

//create a new instance of validation class
$val = new Validate();

if(isset($_POST['subscribe'])){
    //initialize user inputs into variables
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $email = $_POST['email'];

    //validate user information
    $userFirst = $val->text($fname);
    $userLast = $val->text($lname);
    $userEmail = $val->email($email);

    //$userValidate = $val;

    //create a new instance of the subscription class for setting user values
    //continue

    if($userFirst == "" && $userLast == "" && $userEmail == ""){

        $ins->setFname($fname);
        $ins->setLname($lname);
        $ins->setEmail($email);

        //create a new instance of the Dbsubscription class for inserting user values into the database


        $mySub->addSubscription($pdoconn,$ins);
    //Email function
        email($email, $fname);
        $successMessage = "Thank you " . $fname . " you have been added to our mailing list";

    }
}
?>
<!-- start main content -->
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- start post -->
                <article class="post list-post">
                    <div class="media">
                        <div class="media-left">
                            
                        </div>




    <?php

        $connN = new Dbconnect();
        $dbN = $connN->getDb();

        $queryN = 'SELECT * FROM content ORDER BY storyDate DESC limit 5';
        $statementN = $dbN->prepare($queryN);
        $statementN->execute();
        $articlesList = $statementN->fetchAll(PDO::FETCH_OBJ);

        foreach($articlesList as $a)
        {
            echo "<div class='post-content'>";
            echo "<p><img src='topStoryViewerImg.php?id={$a->contentID}' style='width:30%;float:right;margin-left:2%;margin-right:2%;'></p>";
            echo "<p><strong><a href='topStory/singlePage.php?id=" . "{$a->contentID}'>" . $a->storyTitle . "</a></strong></p>";
           
            echo "<p>By: " . $a->storyAuthorFirstName . " " . $a->storyAuthorLastName . "</p>";
            echo "<p>" . $a->storyDate . "</p>";
            echo "<p>" . $a->description . "</p>";
            echo "<p style='word-wrap:break-word;'><a href={$a->linkOutside} target='_blank'>" . $a->citation . "</a></p>";
            echo "</div>";
            echo "<br/>";
        }



        ?>





                       <!-- <div class="post-content">
                            <div class="post-header">
                                <h2><a href="">Beautiful Beach at Ohio </a> <span
                                        class="pull-right">Sep 16</span></h2>
                            </div>
                            <div class="entry-content">


                                <p>
                                </p>


                            </div> end of entry content div


                        </div> end of post comment div-->



                    </div>
                </article>
                <!-- end post -->
            </div>
            <div class="col-md-4">
                <aside class="widget news-letter"><!-- start single widget -->
                    <span><?php if(isset($successMessage)){echo $successMessage;} ?></span>
                    <h3 class="widget-title text-uppercase">Stay updated</h3>
                    <p>Subscribe to our weekly newsletter and stay up to date with the latest news in technology.</p>
                    <form method="post" action="#">
                        <input type="text" name="firstname" placeholder="Your firstname" value="<?php echo $fname; ?>">
                        <span class="errorMessage" style="color:red"><?php if($userFirst != ""){ echo $userFirst; } ?></span>
                        <input type="text" name="lastname" placeholder="Your lastname" value="<?php echo $lname; ?>">
                        <span class="errorMessage" style="color:red"><?php if($userLast != ""){ echo $userLast; } ?></span>
                        <input type="text" name="email" placeholder="Your e-mail" value="<?php echo $email; ?>">
                        <span class="errorMessage" style="color:red"><?php if($userEmail != ""){ echo $userEmail; } ?></span>
                        <input type="submit" value="Subscribe Now"
                               name="subscribe" class="text-uppercase text-center btn btn-subscribe">
                    </form>

                </aside><!-- end single widget -->
            </div>
            <?php
              include 'createAccountWidget.php';
            ?>

            <!--<div class="col-md-4">
                <aside class="widget news-letter">
                    <h3 class="widget-title text-uppercase">Create an account.</h3>
                    <p>Create an account to interact with other technology enthusiasts and post your own articles.</p>
                    <a href="http://nathanmante.com/News/Users/createaccount.php" id="link">Create an account.</a>
                </aside>
            </div>-->
        </div>
    </div>
</div>

<?php
include 'footer.php';
?>
