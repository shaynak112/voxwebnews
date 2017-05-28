<?php


 include '../header.php';
 include '../dbConnect.php';

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
                            <h2>Search Through The Articles</h2>
                        </div>
                        <div class="entry-content">

                            <form id="searchArticleForm" class="form-horizontal" action="" method="post">
                                <label id="searchInput">Search: </label>
                                <input type="text" name="searchInput" id="SearchInput"/>
                                <input type="submit" id="submitSearch" name="submitSearch" value="Search" />
                            </form>

                            <?php
                                if(isset($_POST['submitSearch']))
                                {
                                    $dbconn = new Dbconnect;
                                    $db = $dbconn->getDb();
                                    $search = $_POST['searchInput'];
                                    $query = "SELECT * FROM content WHERE article LIKE '%$search%' ORDER BY storyDate DESC";
                                    $statement = $db->prepare($query);
                                    $statement->bindValue(':%$search%', '%$search%', PDO::PARAM_STR);
                                    $statement->execute();


                                    if (!$statement->rowCount() == 0)
                                    {
                                        echo "<br/>";
                                        while ($results = $statement->fetch())
                                        {
                                            echo "<div>";
                                            echo "<a href='singlePage.php?id=" . $results['contentID'] . "'><strong>" . $results['storyTitle'] . "</strong> by " . $results['storyAuthorFirstName'] . " " . $results['storyAuthorLastName'] . "</a>";
                                            echo "</div>";
                                            echo "<br/>";
                                        }

                                    }
                                    else
                                    {
                                        echo "No results.";
                                    }
                                }

                            ?>

                            <div>
                            <a href='topStory.php'>Back to all stories</a>
                            </div>




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
?>
