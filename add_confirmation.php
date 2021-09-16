<?php

if ( !isset($_POST['title']) || empty($_POST['title']) ) {
	// Missing required fields.
	$error = "Please fill out all required fields.";

} else {
	// All required fields provided.
	$host="303.itpwebdev.com";
	$user="yuzhilu_db_user";
	$pass="xwO=o04f3i#M";
	$db="yuzhilu_dvd_db";

	$mysqli = new mysqli($host, $user, $pass, $db);
	if ( $mysqli->errno ) {
		echo $mysqli->error;
		exit();
	}
	$mysqli->set_charset('utf8');

	if ( isset($_POST['release_date']) && !empty($_POST['release_date']) ) {
		$release_date = $_POST['release_date'];
	} else {
		$release_date = NULL;
	}	

	if ( isset($_POST['label_id']) && !empty($_POST['label_id']) ) {
		$label_id = $_POST['label_id'];
	} else {
		$label_id = NULL;
	}

	if ( isset($_POST['sound_id']) && !empty($_POST['sound_id']) ) {
		$sound_id = $_POST['sound_id'];
	} else {
		$sound_id = NULL;
	}

	if ( isset($_POST['genre_id']) && !empty($_POST['genre_id']) ) {
		$genre_id = $_POST['genre_id'];
	} else {
		$genre_id = NULL;
	}

	if ( isset($_POST['rating_id']) && !empty($_POST['rating_id']) ) {
		$rating_id = $_POST['rating_id'];
	} else {
		$rating_id = NULL;
	}

	if ( isset($_POST['format_id']) && !empty($_POST['format_id']) ) {
		$format_id = $_POST['format_id'];
	} else {
		$format_id = NULL;
	}

	if ( isset($_POST['award']) && !empty($_POST['award']) ) {
		$award = $_POST['award'];
	} else {
		$award = NULL;
	}	

	$sql_prepared = "INSERT INTO dvd_titles (title, release_date, award, label_id, sound_id, genre_id, rating_id, format_id) 
	VALUES(?,?,?,?,?,?,?,?)";
	$statement = $mysqli->prepare($sql_prepared);
		
	$statement->bind_param("sssiiiii", $_POST["title"], $release_date, $award, $label_id, $sound_id, $genre_id, $rating_id, $format_id);

	$executed = $statement->execute();
	// execute() will return false if there's an error
	if(!$executed) {
		echo $mysqli->error;
	}

	// $results = $mysqli->query($sql);
	// if ( !$results ) {
	// 	echo $mysqli->error;
	// 	exit();
	// }
	$statement->close();
	$mysqli->close();

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Confirmation | DVD Database</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item"><a href="add_form.php">Add</a></li>
		<li class="breadcrumb-item active">Confirmation</li>
	</ol>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">Add a DVD</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">
		<div class="row mt-4">
			<div class="col-12">

			<?php if ( isset($error) && !empty($error) ) : ?>

				<div class="text-danger font-italic"><?php echo $error; ?></div>

			<?php else : ?>

				<div class="text-success">
					<span class="font-italic"><?php echo $_POST['title']; ?></span> was successfully added.
				</div>

			<?php endif; ?>

			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="add_form.php" role="button" class="btn btn-primary">Back to Add Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->
</body>
</html>