<?php
require_once('../../dbConnect.php');

	$conn = new Dbconnect;
    $db = $conn->getDb();

//if imageID is 0, quit program
$imageId = (int) isset($_GET['id']) ? $_GET['id'] : 0;
if ($imageId === 0)
{
	die("Invalid image id");
}

//DB query
$query = 'SELECT image, type FROM userimages WHERE imageID = ' . $imageId;

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

?>