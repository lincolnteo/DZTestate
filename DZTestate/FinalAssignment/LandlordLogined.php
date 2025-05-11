<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION["username"]) || !isset($_SESSION["is_landlord"]) || $_SESSION["is_landlord"] != 1) {
  echo "Only landlords can access this page.";
  exit();
}

// Establish database connection
$con = mysqli_connect("localhost", "root", "", "dzt_db");
if (!$con) {
  echo "Connection failed: " . mysqli_connect_error();
  exit();
}

// Check if landlord_id is set in the session
if (!isset($_SESSION["landlord_id"]) || empty($_SESSION["landlord_id"])) {
  echo "Error: Landlord ID is not set. Please log in again.";
  exit();
}

// Debugging: Print the landlord ID (remove this in production)
echo "Debug: Landlord ID is " . $_SESSION["landlord_id"];

// Handle Delete Request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_property"])) {
  $property_id = intval($_POST["property_id"]);
  $stmt = $con->prepare("DELETE FROM properties WHERE ID = ?");
  $stmt->bind_param("i", $property_id);
  if ($stmt->execute()) {
    echo "<script>alert('Property deleted successfully!'); window.location.href = 'LandlordLogined.php';</script>";
  } else {
    echo "Error deleting property: " . $stmt->error;
  }
  $stmt->close();
}

// Handle Update Request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_property"])) {
  $property_id = intval($_POST["property_id"]);
  $beds = intval($_POST["beds"]);
  $rental_months = htmlspecialchars($_POST["rental_months"]);
  $rental_price = floatval($_POST["rental_price"]);

  $stmt = $con->prepare("UPDATE properties SET Beds = ?, RentalMonths = ?, RentalPrice = ? WHERE ID = ?");
  $stmt->bind_param("issi", $beds, $rental_months, $rental_price, $property_id);
  if ($stmt->execute()) {
    echo "<script>alert('Property updated successfully!'); window.location.href = 'LandlordLogined.php';</script>";
  } else {
    echo "Error updating property: " . $stmt->error;
  }
  $stmt->close();
}

// Fetch landlord's properties
$landlord_id = $_SESSION["landlord_id"];
$properties = mysqli_query($con, "SELECT * FROM properties WHERE LandlordID = $landlord_id");
if (!$properties) {
  echo "Error fetching properties: " . mysqli_error($con);
  exit();
}
?>
<html lang="en">

<head>
  <title>Landlord</title> <!---->
  <link rel="stylesheet" href="Signup.css">
</head>
<style>
  /*set the form no display*/
  body #PasswordResetForm {
    display: none;
  }

  body #addPropertyForm {
    display: none;
  }
</style>

<body>
  <!--a header with our logo and a navigation: griffith college logo, three links -->
  <div class="header1">
    <!--logo-->
    <img src="images/logo.png" alt="Logo" class="logo">
    <div class="footer">
      <!--griffith college logo-->
      <a href="https://www.griffith.ie/"><img src="images/GriffithLogo.jpg" height="100" alt="griffithlogo" class="griffithlogo"></a><!--griffith logo with website-->
      <ul><!--navigation-->
        <li><a href="">About Us</a></li> <!--link to another page to description of us-->
        <li><a href="mailto:longkaiz0324@gmail.com">Contact Us</a></li><!--send email to me-->
        <li><a href="Home.php">Back to Home</a></li><!--back to Home page-->
      </ul>
    </div>
  </div>
  <!--after click the button show the form-->
  <button type="button" id="resetTenant" onclick="document.getElementById('PasswordResetForm').style.display = 'block';
        ">Reset Landlord Password</button>

  <div id="PasswordResetForm">
    <form method="POST" name="f1">
      <h3>Password Reset:</h3>
      <table border="1">
        <!--enter name, existed password, new password, and confirm new password-->
        <tr>
          <td>Enter user name: </td>
          <td><input type="text" name="username"></td>
        </tr>
        <tr>
          <td>Enter current password:</td>
          <td><input type="password" name="currentPassword"></td>
        </tr>
        <tr>
          <td>Enter new password:</td>
          <td><input type="password" name="newPassword"></td>
        </tr>
        <tr>
          <td>Confirm new password:</td>
          <td><input type="password" name="confirmNewPassword"></td>
        </tr>
        <tr>
          <td><input type="submit" value="reset" id="reset" onclick="f1.action='ResetLandLordPassword.php'"></td>
        </tr>
      </table>
    </form>
  </div>
  <script>
    // JavaScript to toggle the visibility of the Add Property form
    function toggleAddPropertyForm() {
      const form = document.getElementById('addPropertyForm');
      form.style.display = form.style.display === 'none' ? 'block' : 'none';
    }
  </script>
  <!--once click the button then display the testimonial function-->
  <button type="button" id="PropertyList" onclick="toggleAddPropertyForm()">Add Your Property</button>

  <!-- Add Property Form -->
  <div id="addPropertyForm">
    <form action="Propertylisting.php" method="POST">
      <h3>Add Your Property</h3>
      <label for="beds">Number of Bedrooms:</label>
      <select id="beds" name="beds" required>
        <option value="1">1 Bedroom</option>
        <option value="2">2 Bedrooms</option>
        <option value="3">3 Bedrooms</option>
        <option value="4">4+ Bedrooms</option>
      </select>
      <br>
      <label for="rental_months">Tenancy Length:</label>
      <select id="rental_months" name="rental_months" required>
        <option value="short-term">Short-term</option>
        <option value="long-term">Long-term</option>
      </select>
      <br>
      <label for="rentalPrice">Rental Price (€):</label>
      <input type="number" id="rental_price" name="rental_price" min="500" max="2000" required>
      <br>
      <button type="submit">Submit Property</button>
    </form>
  </div>
  <div>
    <h2>Your Property Listings</h2>
    <table border="1">
      <tr>
        <th>Property ID</th>
        <th>Bedrooms</th>
        <th>Tenancy Length</th>
        <th>Rental Price (€)</th>
        <th>Actions</th>
      </tr>
      <?php
      $landlord_id = $_SESSION["landlord_id"];
      $properties = mysqli_query($con, "SELECT * FROM properties WHERE LandlordID = $landlord_id");
      if (!$properties) {
        echo "Error fetching properties: " . mysqli_error($con);
        exit();
      }
      while ($property = mysqli_fetch_assoc($properties)) { ?>
        <tr>
          <td><?php echo htmlspecialchars($property["ID"]); ?></td>
          <td><?php echo htmlspecialchars($property["Beds"]); ?></td>
          <td><?php
              // Adjust the condition to match the exact database values
              if (strtolower($property["RentalMonths"]) == "short" || strtolower($property["RentalMonths"]) == "short-term") {
                echo "Short-term";
              } else {
                echo "Long-term";
              }
              ?></td>
          <td><?php echo htmlspecialchars($property["RentalPrice"]); ?></td>
          <td>
            <!-- Update Button -->
            <form action="LandlordLogined.php" method="POST" style="display:inline;">
              <input type="hidden" name="property_id" value="<?php echo $property["ID"]; ?>">
              <label for="beds">Beds:</label>
              <select name="beds" required>
                <option value="1" <?php echo $property["Beds"] == 1 ? "selected" : ""; ?>>1</option>
                <option value="2" <?php echo $property["Beds"] == 2 ? "selected" : ""; ?>>2</option>
                <option value="3" <?php echo $property["Beds"] == 3 ? "selected" : ""; ?>>3</option>
                <option value="4" <?php echo $property["Beds"] == 4 ? "selected" : ""; ?>>4+</option>
              </select>
              <label for="rental_months">Tenancy:</label>
              <select name="rental_months" required>
                <option value="Short-Term" <?php echo $property["RentalMonths"] == "short" ? "selected" : ""; ?>>Short-term</option>
                <option value="Long-Term" <?php echo $property["RentalMonths"] == "long" ? "selected" : ""; ?>>Long-term</option>
              </select>
              <label for="rental_price">Price (€):</label>
              <input type="number" name="rental_price" min="500" max="2000" value="<?php echo $property["RentalPrice"]; ?>" required>
              <button type="submit" name="update_property">Update</button>
            </form>
            <!-- Delete Button -->
            <form action="LandlordLogined.php" method="POST" style="display:inline;">
              <input type="hidden" name="property_id" value="<?php echo $property["ID"]; ?>">
              <button type="submit" name="delete_property" onclick="return confirm('Are you sure you want to delete this property?');">Delete</button>
            </form>
          </td>
        </tr>
      <?php } ?>
  </div>
  </table>
  <!--Log out function-->
  <form action="LogoutAsLandlord.php" method="POST">
    <input type="submit" id= "logoutButton"value="Logout">
  </form>

</body>

</html>