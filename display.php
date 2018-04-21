<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		.dis_img{
			width: 40%;
			height: 40%;
			margin-left: 20%; 
			border: 1px solid black;
		}
		.dis_video{
			width: 40%;
			height: 40%;
			margin-left: 20%; 
			border: 1px solid black;
		}
		body{
			color: brown;
			font-size:20px;
		}
		.delete{
			color:brown;
			font-size:20px;
		}
	</style>
</head>
<body>

</body>
</html>
<?php

$dir_path="images/";
$img_expensions= array("jpeg","jpg","png","gif");
$vid_expensions=array("mp4","3gp","mov","mpeg","avi");
$c=1;
echo "<a href='index.php'>Add more files</a><br><hr>";
if(is_dir($dir_path))
{
	$files=scandir($dir_path);$a=count($files);

	for($i=0;$i<count($files);$i++)
	{	
		if($files[$i]!='.' && $files[$i]!='..')
		{
			 $file_ext = pathinfo($files[$i], PATHINFO_EXTENSION);
			echo "<div class='display_img'>
				($c)<br>
				File Name: $files[$i] <br><br>
				File extension : $file_ext<br><br>
				


			</div>"; $c++;
		if(in_array($file_ext, $img_expensions))
		{
			echo"<img src='$dir_path$files[$i]' class='dis_img'><br><br>";  

		}

		if(in_array($file_ext, $vid_expensions))
		{
			$videoPath = $dir_path.''.$files[$i];
			require_once 'config.php';
    $snippet = new Google_Service_YouTube_VideoSnippet();
    $snippet->setTitle("Test title");
    $snippet->setDescription("Test description");
    $snippet->setTags(array("tag1", "tag2"));

    // Numeric video category. See
    // https://developers.google.com/youtube/v3/docs/videoCategories/list 
    $snippet->setCategoryId("22");

    // Set the video's status to "public". Valid statuses are "public",
    // "private" and "unlisted".
    $status = new Google_Service_YouTube_VideoStatus();
    $status->privacyStatus = "public";

    // Associate the snippet and status objects with a new video resource.
    $video = new Google_Service_YouTube_Video();
    $video->setSnippet($snippet);
    $video->setStatus($status);

    // Specify the size of each chunk of data, in bytes. Set a higher value for
    // reliable connection as fewer chunks lead to faster uploads. Set a lower
    // value for better recovery on less reliable connections.
    $chunkSizeBytes = 1 * 1024 * 1024;

    // Setting the defer flag to true tells the client to return a request which can be called
    // with ->execute(); instead of making the API call immediately.
    $client->setDefer(true);

    // Create a request for the API's videos.insert method to create and upload the video.
    $insertRequest = $youtube->videos->insert("status,snippet", $video);

    // Create a MediaFileUpload object for resumable uploads.
    $media = new Google_Http_MediaFileUpload(
        $client,
        $insertRequest,
        'video/*',
        null,
        true,
        $chunkSizeBytes
    );
    $media->setFileSize(filesize($videoPath));


    // Read the media file and upload it chunk by chunk.
    $status = false;
    $handle = fopen($videoPath, "rb");
    while (!$status && !feof($handle)) {
      $chunk = fread($handle, $chunkSizeBytes);
      $status = $media->nextChunk($chunk);
    }

    fclose($handle);

    // If you want to make other calls after the file upload, set setDefer back to false
    $client->setDefer(true);




			echo"<video controls class='dis_vid'>
			<source src='$dir_path$files[$i]' type='video/mp4'>
			</video><br><br>";  

		}
		echo " <form method='post' action='	'>
		<input type='hidden' name='name' value='$files[$i]'>
		<input type='submit' name='delete_file' value='Delete This File' class='delete'> <hr><br></form>";
		}

	}
}
if(isset($_POST['delete_file']))
{
	$name=$_POST['name'];
	if(unlink($dir_path.''.$name))
	header('location: display.php');
}

$fi = new FilesystemIterator($dir_path, FilesystemIterator::SKIP_DOTS);
if(iterator_count($fi)==0){
	echo "No files to display.Add some";
	echo "<br><br><a href='index.php'>Go to main page</a>";
}

?>
