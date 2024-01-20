<?php

$connect = new PDO("mysql:host=localhost;dbname=u562528100_cateringdb", "u562528100_loreto", "Loreto2024!");

if (isset($_POST["rating_data"])) {
    $user_name = filter_var($_POST["user_name"], FILTER_SANITIZE_STRING);
    $rating_data = filter_var($_POST["rating_data"], FILTER_SANITIZE_NUMBER_INT);
    $user_review = filter_var($_POST["user_review"], FILTER_SANITIZE_STRING);

    $existingReviewQuery = "SELECT COUNT(*) FROM review WHERE user_name = :user_name";
    $existingReviewStatement = $connect->prepare($existingReviewQuery);
    $existingReviewStatement->execute([':user_name' => $user_name]);
    $existingReviewCount = $existingReviewStatement->fetchColumn();

    if ($existingReviewCount > 0) {
        echo "You have already submitted a review.";
    } else {
        $insertQuery = "INSERT INTO review (user_name, user_rating, user_review, datetime) 
                        VALUES (:user_name, :user_rating, :user_review, :datetime)";
        
        $insertStatement = $connect->prepare($insertQuery);

        $insertStatement->bindParam(':user_name', $user_name, PDO::PARAM_STR);
        $insertStatement->bindParam(':user_rating', $rating_data, PDO::PARAM_INT);
        $insertStatement->bindParam(':user_review', $user_review, PDO::PARAM_STR);
        $insertStatement->bindParam(':datetime', time(), PDO::PARAM_INT);

        if ($insertStatement->execute()) {
            echo "Your Review & Rating Successfully Submitted";
        } else {
            echo "Error submitting review.";
        }
    }
}

if (isset($_POST["action"])) {
	$average_rating = 0;
	$total_review = 0;
	$five_star_review = 0;
	$four_star_review = 0;
	$three_star_review = 0;
	$two_star_review = 0;
	$one_star_review = 0;
	$total_user_rating = 0;
	$review_content = array();


$query = "
	SELECT * FROM review 
	WHERE status = 0
	ORDER BY id DESC
	";

	$result = $connect->query($query, PDO::FETCH_ASSOC);

	foreach ($result as $row) {
		$review_content[] = array(
			'user_name'		=>	htmlspecialchars($row["user_name"]),
			'user_review'	=>	htmlspecialchars($row["user_review"]),
			'rating'		=>	htmlspecialchars($row["user_rating"]),
			'datetime' => date('l jS, F Y', $row["datetime"])
		);

		if ($row["user_rating"] == '5') {
			$five_star_review++;
		}

		if ($row["user_rating"] == '4') {
			$four_star_review++;
		}

		if ($row["user_rating"] == '3') {
			$three_star_review++;
		}

		if ($row["user_rating"] == '2') {
			$two_star_review++;
		}

		if ($row["user_rating"] == '1') {
			$one_star_review++;
		}

		$total_review++;

		$total_user_rating = $total_user_rating + $row["user_rating"];
	}

	$average_rating = $total_user_rating / $total_review;

	$output = array(
		'average_rating'	=>	number_format($average_rating, 1),
		'total_review'		=>	$total_review,
		'five_star_review'	=>	$five_star_review,
		'four_star_review'	=>	$four_star_review,
		'three_star_review'	=>	$three_star_review,
		'two_star_review'	=>	$two_star_review,
		'one_star_review'	=>	$one_star_review,
		'review_data'		=>	$review_content
	);

	echo json_encode($output);
}
