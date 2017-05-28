<?php
include('../../dbConnect.php');
include('../../header.php');

?>



<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
            

<div id="userChatContainer" class="post" style='width:90%;'>


<?php
$todayDate = getdate();

	echo "<h2 style='margin-left:5%;'>Join the conversation, Today Is " . $todayDate["weekday"] . " " . $todayDate["month"] . " " . $todayDate["mday"] . ", " . $todayDate["year"] . "</h2>";

?>

<br/>

    <div class='container' style="height:250px;">
        <div class='row'>
            <div class='col-md-8'>
                <div class='panel panel-primary'>
                    <div class='panel-heading'>
                        <span class='glyphicon glyphicon-comment'></span> Chat
                    </div>
                    <div id="chatbox" style="height:400px; width:95%; margin-left:5%; margin-right:5%; overflow-y:scroll; overflow-x:hidden;">
                        <div class='panel-body' id="chat-body">
                            <?php
                                include('chat.php');
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>	<!--chatbox-->

<br/><br/>

<div id="chatForm" style='width:60%;margin-left:5%;'>
	<form method="post" class="form-horizontal" action="">
		
		<label class="control-label" for="chatMsgForm">Message:</label>
		<input class="form-control" type="text" name="chatMsgForm" id="chatMsgForm" />
		<br/>

		<input style="background-color:#f26367;"class="btn btn-primary" type="submit" name="submit" value="Send Message" />

	</form>
	<br/>
	<br/>

</div><!--end chat form-->

<?php
	if(isset($_POST['submit']))
	{

		$dbconn = new Dbconnect;
	    $db = $dbconn->getDb();
	    
	    $todayTime = date('H:i:s');
		$userID = $_SESSION['userId'];
		$username = $_SESSION['userName'];
		$chatMsg = $_POST['chatMsgForm'];

		try{
		$query = "INSERT INTO chat (msgUserID, msgUsername, msgMessage) VALUES (:userID, :username, :chatMsg)";

    	$statement = $db->prepare($query);
    	$statement->bindValue(':userID', $userID, PDO::PARAM_INT);
      	$statement->bindValue(':username', $username, PDO::PARAM_STR);
      	$statement->bindValue(':chatMsg', $chatMsg, PDO::PARAM_STR);
      	//$statement->bindValue(':todayTime', $todayTime, PDO::PARAM_STR);
    	$statement->execute();
    }catch(PDOException $e){
    	echo $e->getMessage();
    	//$dbconn=null;
    }
	}

?>




</div><!--end container-->

</div>
</div>
</div>
</div>


<script type='text/javascript' src="chat.js"></script>
<?php
     include('../../footer.php');
?>