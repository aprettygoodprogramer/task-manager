
function get_hashed_password($username) {
    // Connect to the database
    $conn = new mysqli($servername, $username, $password, $dbname);
  
    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
  
    // Get the result
    $result = $stmt->get_result();
  
    // Check if the username exists
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      return $row['password'];
    } else {
      return null;
    }
  
    // Close the connection
    $stmt->close();
    $conn->close();
  }
  
  function check_password($username, $password) {
    // Get the hashed password from the database
    $hashed_password = get_hashed_password($username);
  
    // Verify the password
    if (password_verify($password, $hashed_password)) {
      return true;
    } else {
      return false;
    }
  }
