<?php
/**
 * Created by PhpStorm.
 * User: Nate
 * Date: 2017-05-11
 * Time: 8:19 PM
 */

 include '../header.php';
 include '../dbConnect.php';

?>


<?php

    $dbconn = new Dbconnect;
    $db = $dbconn->getDb();
    
    $id = $_GET['id'];
    $query = 'SELECT * FROM content WHERE contentID = ' . $id;
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $singleArticle = $statement->fetch();


?>


<!-- start main content -->
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- start post -->
                <article class="post single-post">

                    <div class="post-content">
                        <div class="post-header">
                            <h2>
                            <?php echo "<img src='topStoryViewerImg.php?id=" . $singleArticle['contentID'] . "' style='width:40%;display:inline-block;margin-left:1%;margin-right:1%;float:right;'>"; ?>

                                <?php echo $singleArticle['storyTitle']; ?>
                            </h2>
                        </div>
                        <div>
                            
                            <div>
                                <?php echo "By: " . $singleArticle['storyAuthorFirstName'] . " " . $singleArticle['storyAuthorLastName'] ?>
                            </div>

                            <div>
                                <?php echo $singleArticle['storyDate']; ?>
                            </div>

                                <br/>


                        </div>
                        
                        <div class="entry-content">
                            <?php echo $singleArticle['article']; ?>
                        </div>

                        <div>
                            <?php echo "<a target='_blank' href=" . $singleArticle['linkOutside'] . ">" . $singleArticle['citation'] . "</a>"; ?>
                        </div>

    
                    </div>


                </article>
                <!-- end post -->

            </div>
            <div class="col-md-4">
                <!-- start sidebar -->
                <div class="sidebar">

                    <aside class="widget p-post-widget">
                        <?php
                            include '../sideLatestArticles.php';
                        ?>
                    </aside>
                   



                </div>
                <!-- end sidebar -->
            
            </div>
        </div>
    </div>
</div>



<?php
include '../footer.php';
