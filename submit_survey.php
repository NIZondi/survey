<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "survey_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form data is received
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $full_name = $_POST["full-name"];
    $email = $_POST["email"];
    $dob = $_POST["dob"];
    $contact_number = $_POST["contact-number"];
    $favorite_food = isset($_POST["favorite-food"]) ? implode(", ", $_POST["favorite-food"]) : "";
    $other_food = isset($_POST["other-food"]) ? $_POST["other-food"] : "";
    $movies_rating = $_POST["movies"];
    $radio_rating = $_POST["radio"];
    $eat_out_rating = $_POST["eat-out"];
    $watch_tv_rating = $_POST["watch-tv"];

    // Calculate age
    $dobDate = new DateTime($dob);
    $today = new DateTime();
    $age = $today->diff($dobDate)->y;

    // Check if age is within acceptable range
    if ($age >= 5 && $age <= 120) {
        // Age is within acceptable range, proceed with inserting data into the database

        // Prepare SQL statement to insert personal details
        $stmt_personal_details = $conn->prepare("INSERT INTO personal_details (full_name, email, dob, contact_number) VALUES (?, ?, ?, ?)");
        $stmt_personal_details->bind_param("ssss", $full_name, $email, $dob, $contact_number);
        $stmt_personal_details->execute();

        if ($stmt_personal_details->affected_rows > 0) {
            // Retrieve the auto-generated ID of the inserted record
            $respondent_id = $conn->insert_id;

            // Prepare SQL statement to insert survey responses
            $stmt_survey_responses = $conn->prepare("INSERT INTO survey_responses (respondent_id, favorite_food, other_food, movies_rating, radio_rating, eat_out_rating, watch_tv_rating) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt_survey_responses->bind_param("issssss", $respondent_id, $favorite_food, $other_food, $movies_rating, $radio_rating, $eat_out_rating, $watch_tv_rating);
            $stmt_survey_responses->execute();

            if ($stmt_survey_responses->affected_rows > 0) {
                echo "success"; // Successfully saved survey data
            } else {
                echo "Error: Unable to save survey responses.";
            }

            $stmt_survey_responses->close();
        } else {
            echo "Error: Unable to save personal details.";
        }

        $stmt_personal_details->close();
    } else {
        echo "Error: Age must be between 5 and 120 years.";
    }
} else {
    // If not a POST request, return error
    echo "Error: No data received.";
}

$conn->close();
?>
