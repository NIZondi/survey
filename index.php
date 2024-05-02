<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Survey App</title>
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
  }
  .header {
    color: black;
    padding: 10px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .header h2 {
    margin: 0;
    font-weight: bold;
  }
  /* Change the color of the checkbox */
input[type=checkbox]:checked::before { background-color: #007bff; }

  .header button {
    border: 0px;
    background-color: white;
  }
  .container {
    padding: 20px;
  }
  .container h2 {
    padding-left: 30px;
  }
  .survey-form {
    max-width: 400px;
    margin: auto;
    padding-left: 0px;
  }
  .active-button {
    background-color: #007bff;
    color: #007bff;
  }
  .form-group {
    margin-bottom: 20px;
    padding-left: 40px;
    padding-right: 80px;
  }
  .form-group label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
  }
  .form-group input[type="text"],
  .form-group input[type="email"],
  .form-group input[type="date"],
  .form-group input[type="tel"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #007bff;
    border-radius: 4px;
    box-sizing: border-box;
  }
  .form-group button {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
    margin: 0 auto; 
    display: block;
  }
  .form-group button:hover {
    background-color: grey;
  }
  .other-food {
    display: none;
  }
  input[type="radio"]:checked + label::before {
   border-color: #007bff; 
  }
  .food-option {
    display: inline-block;
    margin-bottom: 10px;
  }
  .food-option label {
    display: inline-block;
    margin-right: 10px;
  }
  
  /* Responsive styles */
  @media only screen and (max-width: 600px) {
    .survey-form {
      max-width: 100%;
      padding: 20px;
    }
    .form-group {
      width: 100%;
      margin-bottom: 15px;
    }
    .form-group label {
      width: 100%;
      margin-bottom: 5px;
    }
    .form-group input[type="text"],
    .form-group input[type="email"],
    .form-group input[type="date"],
    .form-group input[type="tel"] {
      width: 100%;
    }
    .table-container {
      overflow-x: auto;
    }
  }
  .table-container {
    width: 100%;
    overflow-x: auto;
  }
  table {
    width: 100%;
    border-collapse: collapse;
  }
  th, td {
    border: 1px solid #007bff;
    padding: 8px;
    text-align: left;
  }
  th {  
    border: 1px solid black;         
    background-color: grey;
  }
</style>
</head>
<body>

<div class="header">
  <h2>_Surveys</h2>
  <div>
    <button onclick="location.href='index.php'" class="active-button" style="margin-right: 10px;">FILL OUT SURVEY</button>
    <button onclick="location.href='surveyview.php'" style="margin-right: 10px;">VIEW SURVEY RESULTS</button>
  </div>
</div>

<div class="container">
  <h2>Personal Details:</h2>
  <form class="survey-form" id="surveyForm" method="post" onsubmit="return validateForm()">
    <div class="form-group">
      <label for="full-name">Full Name:</label>
      <input type="text" id="full-name" name="full-name" required>
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>
    </div>
    <div class="form-group">
      <label for="dob">Date of Birth:</label>
      <input type="date" id="dob" name="dob" required>
    </div>
    <div class="form-group">
      <label for="contact-number">Contact Number:</label>
      <input type="tel" id="contact-number" name="contact-number" required>
    </div>
 </div>
    <div class="form-group">
      <label for="favorite-food" style="display: inline-block;">What is your favorite food?</label>
      <div class="food-option" style="display: inline-block; margin-left: 10px;">
        <input type="checkbox" id="pizza" name="favorite-food[]" value="Pizza">
        <label for="pizza">Pizza</label>
      </div>
      <div class="food-option" style="display: inline-block; margin-left: 10px;">
        <input type="checkbox" id="pasta" name="favorite-food[]" value="Pasta">
        <label for="pasta">Pasta</label>
      </div>
      <div class="food-option" style="display: inline-block; margin-left: 10px;">
        <input type="checkbox" id="pap-wors" name="favorite-food[]" value="Pap and Wors">
        <label for="pap-wors">Pap and Wors</label>
      </div>
      <div class="food-option" style="display: inline-block; margin-left: 10px;">
        <input type="checkbox" id="other" name="favorite-food[]" value="Other" onclick="toggleOtherFoodInput()">
        <label for="other">Other</label>
      </div>
      <input type="text" id="other-food" name="other-food" class="other-food" placeholder="Please specify" style="display: none;">
    </div>
    <div class="form-group">
      <label>Please rate your level of agreement on a scale from 1 to 5, with 1 being 'Strongly Agree' and 5 being 'Strongly Disagree':</label>
      <div class="table-container">
        <table>
          <tr>
            <th></th>
            <th>Strongly Agree</th>
            <th>Agree</th>
            <th>Neutral</th>
            <th>Disagree</th>
            <th>Strongly Disagree</th>
          </tr>
          <tr>
            <td>I like to watch movies</td>
            <td><input type="radio" name="movies" value="Strongly Agree"></td>
            <td><input type="radio" name="movies" value="Agree"></td>
            <td><input type="radio" name="movies" value="Neutral"></td>
            <td><input type="radio" name="movies" value="Disagree"></td>
            <td><input type="radio" name="movies" value="Strongly Disagree"></td>
          </tr>
          <tr>
            <td>I like to listen to radio</td>
            <td><input type="radio" name="radio" value="Strongly Agree"></td>
            <td><input type="radio" name="radio" value="Agree"></td>
            <td><input type="radio" name="radio" value="Neutral"></td>
            <td><input type="radio" name="radio" value="Disagree"></td>
            <td><input type="radio" name="radio" value="Strongly Disagree"></td>
          </tr>
          <tr>
            <td>I like to eat out</td>
            <td><input type="radio" name="eat-out" value="Strongly Agree"></td>
            <td><input type="radio" name="eat-out" value="Agree"></td>
            <td><input type="radio" name="eat-out" value="Neutral"></td>
            <td><input type="radio" name="eat-out" value="Disagree"></td>
            <td><input type="radio" name="eat-out" value="Strongly Disagree"></td>
          </tr>
          <tr>
            <td>I like to watch TV</td>
            <td><input type="radio" name="watch-tv" value="Strongly Agree"></td>
            <td><input type="radio" name="watch-tv" value="Agree"></td>
            <td><input type="radio" name="watch-tv" value="Neutral"></td>
            <td><input type="radio" name="watch-tv" value="Disagree"></td>
            <td><input type="radio" name="watch-tv" value="Strongly Disagree"></td>
          </tr>
        </table>
      </div>
    </div>
    <div class="form-group">
      <button type="submit">Submit</button>
    </div>
  </form>


<script>
function toggleOtherFoodInput() {
  var otherFoodInput = document.getElementById("other-food");
  otherFoodInput.style.display = document.getElementById("other").checked ? "inline-block" : "none";
}

function validateForm() {
  var dob = document.getElementById("dob").value;
  var dobDate = new Date(dob);
  var today = new Date();
  var age = today.getFullYear() - dobDate.getFullYear();
  var monthDiff = today.getMonth() - dobDate.getMonth();
  if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dobDate.getDate())) {
    age--;
  }
  if (age < 5 || age > 120) {
    alert("Age must be between 5 and 120 years.");
    return false; // Prevent form submission
  }
  return true; // Allow form submission
}

// Event listener for form submission
document.querySelector('.survey-form').addEventListener('submit', function(event) {
  event.preventDefault(); // Prevent default form submission

  // Create a FormData object from the form
  var formData = new FormData(this);

  // Send form data to the PHP script using fetch API
  fetch('submit_survey.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.text())
  .then(data => {
    if (data === 'success') {
      alert('Data was submitted.'); // Show success message
      location.reload(); // Reload the page after submitting
    } else {
      alert('Error: Unable to submit data.'); // Show error message
    }
  })
  .catch(error => {
    console.error('Error:', error);
    alert('An unexpected error occurred. Please try again later.');
  });
});
</script>

</body>
</html>
