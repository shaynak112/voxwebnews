<?php
require_once('../../dbConnect.php');
?>



<?php

		$dbconn = new Dbconnect;
	    $db = $dbconn->getDb();

		$query = 'SELECT * FROM chat INNER JOIN users ON chat.msgUserID = users.id ORDER BY msgDate DESC';
	    $statement = $db->prepare($query);
	    $statement->execute();
	    $chatmessages = $statement->fetchAll(PDO::FETCH_OBJ);

	    foreach($chatmessages as $c)
	    {

	    	echo "<ul class='chat'>";
	    	echo "<li class='left clearfix'>";
	    	//echo "<img class='img-circle' src=' . $c->photoLink . '>";
	    	//echo "</span>";
	    	echo "<div class='chat-body clearfix'>";
	    	echo "<div class='header'>";
			echo "<strong class='primary-font'>" . $c->msgUsername . "</strong>";
			echo "<small class='pull-right text-muted'><span class='glyphicon glyphicon-time'></span>" . $c->msgDate . "</small>";
			echo "</div>";
			echo "<p>" . $c->msgMessage . "</p>";
            echo "</div>";
			echo "</li>";
			echo "</ul>";






		}

		$dbconn=null;



?>

<!--<script type='text/javascript' src="chat.js"></script> -->
