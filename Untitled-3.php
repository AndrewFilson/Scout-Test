<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Form Test 1</title>
</head>
<body>
<?php 
if (isset($_POST['firstName']))
{
	echo "Welcome, ";
	echo $_POST['firstName'] . " " . $_POST['lastName'];
	echo "<br/>";
}
?>

<form name="form1" method="post" action="">
  <p><label for="firstname">First Name:</label>		
    <input name="firstName" type="text" required id="firstName" maxlength="30">
  </p>
  <p>
    <label for="lastName">Last Name:</label>
    <input name="lastName" type="text" required="required" id="lastName" maxlength="30">
  </p>
  <p>
    <label for="streetAddress">Street Address:</label>
    <input type="text" name="streetAddress" id="streetAddress">
  </p>
  <p>
    <label for="city">City:</label>
    <input type="text" name="city" id="city">
  </p>
  <p>
    <label for="zipCode">Zip Code:</label>
    <input type="number" name="zipCode" id="zipCode">
  </p>
  <p>
    <label for="birthDate">Birth Date:</label>
    <input name="birthDate" type="date" required="required" id="birthDate" min="2012-01-01" value="2012-01-01">
  </p>
  <p>
    <input type="submit" name="submit" id="submit" value="Submit">
  </p>
</form>
</body>
</html>