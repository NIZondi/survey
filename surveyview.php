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

// Initialize variables
$total_surveys = $avg_age = $max_age = $min_age = $pizza_percentage = $pasta_percentage = $pap_wors_percentage = $movies_count = $radio_count = $eat_out_count = $watch_tv_count = 0;

// Query to get total number of surveys
$total_surveys_query = "SELECT COUNT(*) AS total_surveys FROM survey_responses";
$total_surveys_result = $conn->query($total_surveys_query);
if ($total_surveys_result->num_rows > 0) {
    $total_surveys_row = $total_surveys_result->fetch_assoc();
    $total_surveys = $total_surveys_row['total_surveys'];
}

// Query to get average age, oldest person, and youngest person
$age_stats_query = "SELECT 
                      ROUND(AVG(YEAR(NOW()) - YEAR(dob))) AS avg_age,
                      MAX(YEAR(NOW()) - YEAR(dob)) AS max_age,
                      MIN(YEAR(NOW()) - YEAR(dob)) AS min_age
                    FROM personal_details";
$age_stats_result = $conn->query($age_stats_query);
if ($age_stats_result->num_rows > 0) {
    $age_stats_row = $age_stats_result->fetch_assoc();
    $avg_age = $age_stats_row['avg_age'];
    $max_age = $age_stats_row['max_age'];
    $min_age = $age_stats_row['min_age'];
}

// Query to calculate percentage of people who like each food
$food_percentage_query = "SELECT 
                            (SUM(CASE WHEN favorite_food LIKE '%Pizza%' THEN 1 ELSE 0 END) / COUNT(*)) * 100 AS pizza_percentage,
                            (SUM(CASE WHEN favorite_food LIKE '%Pasta%' THEN 1 ELSE 0 END) / COUNT(*)) * 100 AS pasta_percentage,
                            (SUM(CASE WHEN favorite_food LIKE '%Pap and Wors%' THEN 1 ELSE 0 END) / COUNT(*)) * 100 AS pap_wors_percentage
                          FROM survey_responses";
$food_percentage_result = $conn->query($food_percentage_query);
if ($food_percentage_result->num_rows > 0) {
    $food_percentage_row = $food_percentage_result->fetch_assoc();
    $pizza_percentage = round($food_percentage_row['pizza_percentage'], 1);
    $pasta_percentage = round($food_percentage_row['pasta_percentage'], 1);
    $pap_wors_percentage = round($food_percentage_row['pap_wors_percentage'], 1);
}

// Query to calculate total number of people who like each activity
$activity_count_query = "SELECT 
                          SUM(CASE WHEN movies_rating = 'Strongly Agree' THEN 1 ELSE 0 END) AS movies_count,
                          SUM(CASE WHEN radio_rating = 'Strongly Agree' THEN 1 ELSE 0 END) AS radio_count,
                          SUM(CASE WHEN eat_out_rating = 'Strongly Agree' THEN 1 ELSE 0 END) AS eat_out_count,
                          SUM(CASE WHEN watch_tv_rating = 'Strongly Agree' THEN 1 ELSE 0 END) AS watch_tv_count
                        FROM survey_responses";
$activity_count_result = $conn->query($activity_count_query);
if ($activity_count_result->num_rows > 0) {
    $activity_count_row = $activity_count_result->fetch_assoc();
    $movies_count = $activity_count_row['movies_count'];
    $radio_count = $activity_count_row['radio_count'];
    $eat_out_count = $activity_count_row['eat_out_count'];
    $watch_tv_count = $activity_count_row['watch_tv_count'];
}

// Close connection
$conn->close();


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Survey Results</title>
<style>
  body {
    /* Adding top padding to accommodate the fixed header */
    font-family: Arial, sans-serif;
    margin: 0;
  }

  .header {
    background-color: white;
    color: black;
    padding: 10px 5px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: fixed; /* Make the header fixed */
    width: 100%; /* Take the full width of the viewport */
    top: 0; /* Stick it to the top */
    z-index: 1000; /* Ensure it's above other content */
  }

  .header h2 {
    margin: 0;
    color: black;
    font-weight: bold;
    padding-left: 30px
  }

  .active-button {
    background-color: blue;
    color: blue; /* Change text color to white or a color that contrasts well with blue */
  }

  .header button {
    background-color: white;
    color: black;
    border: none;
    padding: 10px 20px;
    border: 0px;
    cursor: pointer;
  }

  .header button:hover {
    background-color: white;
  }

  h2 {
    text-align: center;
    margin-top: 80px; /* Add margin top to avoid overlapping with fixed header */
  }
  
  .results {
    display: flex;
    justify-content: space-between;
    margin-top: 100px; /* Adjusted margin top */
    padding: 0 100px; /* Added padding */
  }

  .results {
    display: flex;
    justify-content: space-between;
    margin-top: 100px; /* Adjust margin top to avoid overlapping with fixed header */
  }

  .statements p {
    margin-right: 10px;
  }

  .values p {
    margin-left: 10px;
  }
</style>
</head>
<body>

<div class="header">
  <h2>_Surveys</h2>
  <div>
    <button onclick="location.href='index.php'" style="margin-right: 10px;">FILL OUT SURVEY</button>
    <button onclick="location.href='surveyview.php'" <?php if(basename($_SERVER['PHP_SELF']) == 'surveyview.php') echo 'class="active-button"'; ?> style="margin-right: 10px;">VIEW SURVEY RESULTS</button>
  </div>
</div>

<h2>Survey Results</h2>

<div class="results">
  <div class="statements">
    <p>Total number of surveys:</p>
    <p>Average age:</p>
    <p>Oldest person who participated:</p>
    <p>Youngest person who participated:</p>
    <p>&nbsp;</p>
    <p>Percentage of people who like Pizza:</p>
    <p>Percentage of people who like Pasta:</p>
    <p>Percentage of people who like Pap and Wors:</p>
    <p>&nbsp;</p>
    <p>Total number of people who like to watch movies:</p>
    <p>Total number of people who like to listen to radio:</p>
    <p>Total number of people who like to eat out:</p>
    <p>Total number of people who like to watch TV:</p>
  </div>
  <div class="values">
    <p><?php echo $total_surveys; ?></p>
    <p><?php echo $avg_age; ?></p>
    <p><?php echo $max_age; ?></p>
    <p><?php echo $min_age; ?></p>
    <p>&nbsp;</p>
    <p><?php echo $pizza_percentage; ?>%</p>
    <p><?php echo $pasta_percentage; ?>%</p>
    <p><?php echo $pap_wors_percentage; ?>%</p>
    <p>&nbsp;</p>
    <p><?php echo $movies_count; ?></p>
    <p><?php echo $radio_count; ?></p>
    <p><?php echo $eat_out_count; ?></p>
    <p><?php echo $watch_tv_count; ?></p>
  </div>
</div>

</body>
</html>


