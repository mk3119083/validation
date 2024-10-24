<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #00c6ff, #0072ff);
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 15;
        }
        .form-container {
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        .form-container h2 {
            text-align: center;
            color: #0072ff;
            margin-bottom: 20px;
        }
        .form-container input[type="text"], 
        .form-container input[type="email"],
        .form-container input[type="tel"],
        .form-container input[type="password"],
        .form-container input[type="date"],
        .form-container select {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .form-container input[type="checkbox"] {
            margin-right: 10px;
        }
        .form-container .btn {
            background: linear-gradient(to right, #00c6ff, #0072ff);
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            width: 100%;
            cursor: pointer;
            font-size: 16px;
        }
        .form-container .btn:hover {
            background: linear-gradient(to right, #0072ff, #00c6ff);
        }
        .form-container p {
            text-align: center;
            margin-top: 10px;
        }
        .form-container p a {
            color: #0072ff;
            text-decoration: none;
        }
        .form-container p a:hover {
            text-decoration: underline;
        }
        .error {
            color: red;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Registration Form</h2>
        <?php
        session_start();
        if (isset($_SESSION['errors'])) {
            echo '<div class="error">';
            foreach ($_SESSION['errors'] as $error) {
                echo '<p>' . $error . '</p>';
            }
            echo '</div>';
            unset($_SESSION['errors']);
        }
        // print seccessfull message
        if (isset($_SESSION['msg'])) {
            echo '<div class="msg">';
            echo '<p>' . $_SESSION['msg'] . '</p>';
            echo '</div>';
            unset($_SESSION['msg']);
        }
        ?>
        <form action="conn.php" method="POST">
            <input type="text" name="name" placeholder="Name" >
            <span class="error" id="nameError"></span><br>

            <input type="email" name="email" placeholder="Email address" >
            <span class="error" id="emailError"></span><br>

            <input type="tel" name="phone" placeholder="Phone" >
            <span class="error" id="phoneError"></span><br>

            <!-- <input type="date" name="dob" placeholder="Date of Birth" >
            <span class="error" id="dobError"></span><br> -->

            <select id="gender" name="gender" >
                <option value="">Select</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>
            <span class="error" id="genderError"></span><br>

            <input type="text" name="username" placeholder="Username" >
            <span class="error" id="usernameError"></span><br>

            <input type="password" name="password" placeholder="Password" >
            <span class="error" id="passwordError"></span><br>

            <input type="text" name="address" placeholder="Address" >
            <span class="error" id="addressError"></span><br>

            <button type="submit" class="btn">Create Account</button>
        </form>
        <p>Already have an account? <a href="#">Sign in</a></p>
    </div>


    <script>
        
        function validateForm(event) {
            event.preventDefault();
            let isValid = true;
            const form = document.forms[0];
            const errors = {};

            // Validate name
            const name = form["name"].value;
            if (!name.match(/^[a-zA-Z\s]+$/) || name.length < 6) {
                errors['name'] = "Name must be at least 6 characters long and contain only alphabetic characters and spaces";
                isValid = false;
            }

            // Validate email
            const email = form["email"].value;
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                errors['email'] = "Email is not valid";
                isValid = false;
            }

            // Validate phone
            const phone = form["phone"].value;
            if (!phone.match(/^[6-9][0-9]{9}$/)) {
                errors['phone'] = "Phone number must be 10 digits long and start with 6, 7, 8, or 9";
                isValid = false;
            }

            // Validate date of birth
            // const dob = new Date(form["dob"].value);
            // const now = new Date();
            // const age = now.getFullYear() - dob.getFullYear();
            // if (age < 18 || isNaN(age)) {
            //     errors['dob'] = "You must be at least 18 years old";
            //     isValid = false;
            // }

            // Validate gender
            const gender = form["gender"].value;
            if (!["male", "female", "other"].includes(gender)) {
                errors['gender'] = "Gender is not valid";
                isValid = false;
            }

            // Validate username
            const username = form["username"].value;
            if (username.length < 6) {
                errors['username'] = "Username must be at least 6 characters long";
                isValid = false;
            }

            // Validate password
            const password = form["password"].value;
            const passwordPattern = /^(?=.[a-z])(?=.[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
            if (!passwordPattern.test(password)) {
                errors['password'] = "Password must be at least 8 characters long, contain both upper and lower case letters, and include at least one number";
                isValid = false;
            }

            // Validate address
            const address = form["address"].value;
            if (address.trim() === "") {
                errors['address'] = "Address is required";
                isValid = false;
            }

            // Display errors
            document.querySelectorAll('.error').forEach(el => el.innerText = '');
            for (const [key, value] of Object.entries(errors)) {
                document.getElementById($keyError).innerText = value;
            }

            if (isValid) {
                form.submit();
            }
        }
    </script>
    
</script>    
</body>
</html>