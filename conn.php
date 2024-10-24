<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "parker");
if(!$conn){
    die ("connection failed".mysqli_connect_error());
}

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $errors = [];

    // Validate required fields
    // $required_fields = ['name', 'email', 'phone', 'gender', 'username', 'password', 'address'];
    // foreach ($required_fields as $field) {
    //     if (empty($_POST[$field])) {
    //         $errors[$field] = ucfirst($field) . " is required";
    //     }
    // }

    // Validate name
    // if (!empty($_POST["name"]) && !preg_match("/^[a-zA-Z\s]+$/", $_POST["name"])) {
    //     $errors['name'] = "Name must contain only alphabetic characters and spaces";
    // }

    // Validate email
    // if (!empty($_POST["email"]) && !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    //     $errors['email'] = "Email is not valid";
    // }

    // Validate phone
    // if (!empty($_POST["phone"]) && !preg_match('/^[6-9][0-9]{9}$/', $_POST["phone"])) {
    //     $errors['phone'] = "Phone number must be 10 digits long and start with 6, 7, 8, or 9";
    // }

    // Validate date of birth
    // if (!empty($_POST["dob"]) && !DateTime::createFromFormat('Y-m-d', $_POST["dob"])) {
    //     $errors['dob'] = "Date of Birth is not valid";
    // } elseif (!empty($_POST["dob"])) {
    //     $dob = new DateTime($_POST["dob"]);
    //     $now = new DateTime();
    //     $age = $now->diff($dob)->y;
    //     if ($age < 18) {
    //         $errors['dob'] = "You must be at least 18 years old";
    //     }
    // }

    // Validate gender
    // $valid_genders = ['male', 'female', 'other'];
    // if (!empty($_POST["gender"]) && !in_array($_POST["gender"], $valid_genders)) {
    //     $errors['gender'] = "Gender is not valid";
    // }

    // Validate username
    // if (!empty($_POST["username"]) && strlen($_POST["username"]) < 6) {
    //     $errors['username'] = "Username must be at least 6 characters long";
    // }

    // Validate password
    // if (!empty($POST["password"]) && !preg_match('/^(?=.[a-z])(?=.[A-Z])(?=.\d)(?=.[\W])[a-zA-Z\d\W_]{8,}$/', $_POST["password"])) {
    //     $errors['password'] = "Password must be at least 8 characters long, contain both upper and lower case letters, include at least one number, and one special character";
    // }

    // Validate address
    // if (!empty($_POST["address"]) && empty($_POST["address"])) {
    //     $errors['address'] = "Address is required";
    // }

    // Check if there are any errors
    // if (!empty($errors)) {
    //     // Store errors in session and redirect to signup page
    //     $_SESSION['errors'] = $errors;
    //     header('Location: sign.php');
    //     exit;
    // }

    // Proceed with form submission logic if validation passes
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    // $dob = $_POST["dob"];
    $gender = $_POST["gender"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $address = $_POST["address"];

    // Here you would typically save the data to the database
    // For demonstration, we'll just return a success message
    // header('Content-Type: application/json');
    // echo json_encode(['message' => 'Form submitted successfully', 'data' => compact('name', 'email', 'phone', 'dob', 'gender', 'username', 'password', 'address')]);


    $set = "INSERT INTO sign (name, email ,phone, gender, username, password, address ) VALUES ('$name', '$email',  '$phone', '$gender', '$username', '".hash('sha256',$password)."','$address')"; 

    // echo "INSERT INTO sign (name, email ,phone, gender, username, password, address ) VALUES ('$name', '$email',  '$phone', '$gender', '$username', '".hash('sha256',$password)."','$address')";



            if(mysqli_query($conn, $set)){
                $_SESSION['msg'] = "New record created successfully";
                echo "<script>window.location='sign.php'</script>";
            } else{
                $_SESSION['msg'] = "Error: " . $set . "<br>" . mysqli_error($conn);
                echo "<script>window.location='sign.php'</script>";
            }
// }
?>