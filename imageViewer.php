<?php
require_once('../dbConnect.php');

//if imageID is 0, quit program
$imageID = (int) isset($_GET['id']) ? $_GET['id'] : 0;
if ($imageID === 0)
{
	die("Invalid image id");
}

    $dbconn = new Dbconnect;
    $db = $dbconn->getDb();
//DB query
$query = 'SELECT image, type FROM userimages WHERE imageID = ' . $imageID;

$statement = $db->prepare($query);
$statement->execute();
$userimages = $statement->fetchAll(PDO::FETCH_OBJ);

//for each image, use the image and type to make the BLOB viewable
if (count($userimages) > 0)
{
 	$userImage = $userimages[0];

	header("Content-type: image/type");
	echo $userImage->image;
	exit(0);
}