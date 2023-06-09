<?php
include "connectivity.php";
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        .container {
            width: 100%;
            height: 100vh;
            background: #141a34;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container form {
            width: 90%;
            height: 70%;
            max-width: 1000px;
            padding: 50px 30px 20px;
            background: #fff;
            border-radius: 4px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.5);
            position: relative;
        }

        .fa-user-secret {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #fff;
            font-size: 26px;
            padding: 20px;
            border-radius: 50%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        .input-group {
            width: 100%;
            display: flex;
            align-items: center;
            margin: 10px 0;
            position: relative;
        }

        .input-group label {
            flex-basis: 28%;
            margin-bottom: 30px;
        }

        .input-group input {
            flex-basis: 68%;
            background: transparent;
            border: 0;
            outline: 0;
            padding: 10px 0;
            border-bottom: 1px solid #999;
            color: #333;
            font-size: 16px;
            margin-bottom: 40px;
        }

        ::placeholder {
            font-size: 14px;
        }

        form button {
            background: #141a34;
            color: #fff;
            border-radius: 4px;
            border: 1px solid rgba(255, 255, 255, 0.7);
            padding: 10px 40px;
            outline: 0;
            cursor: pointer;
            display: block;
            margin: 30px auto 10px;
        }

        .input-group span {
            position: absolute;
            bottom: 12px;
            margin-bottom: 11px;
            margin-right: 20px;
            right: 17px;
            font-size: 14px;
            color: red;
        }

        #submit-error {
            color: red;
            font-size: 20px;
            text-align: center;
        }

        .input-group span i {
            color: seagreen;
            margin-bottom: 40px;
        }
        .link{
            float: right;
            cursor: pointer;
        }
    </style>

    <script src="https://kit.fontawesome.com/c4254e24a8.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <form method="POST" action="insert.php" id="formData" onsubmit="return validateForm()">
            <i class="fa-solid fa-user-secret"></i>

            <div class="input-group">
                <label for="contact-name">Full Name</label>
                <input type="text" placeholder="Enter your name" name="name" id="contact-name">
                <span id="name-error"></span>
            </div>

            <div class="input-group">
                <label for="contact-phone">Phone No.</label>
                <input type="tel" placeholder="123 456 7890" name="phone" id="contact-phone">
                <span id="phone-error"></span>
            </div>

            <div class="input-group">
                <label for="contact-email">Email Id</label>
                <input type="email" placeholder="Enter Email" name="email" id="contact-email">
                <span id="email-error"></span>
            </div>

            <div class="input-group">
                <label for="contact-password">Password</label>
                <input type="password" placeholder="Enter Password" name="password" id="contact-password">
                <span id="password-error"></span>
            </div>

            <div class="input-group">
                <label for="contact-confirm-password">Confirm Password</label>
                <input type="password" placeholder="Confirm Password" id="contact-confirm-password">
                <span id="confirm-password-error"></span>
            </div>

            <button type="submit">Sign up</button>
            <span id="submit-error"></span>
            <a href="login.php" class="link">Already have an account? Sign in</a>
        </form>
    </div>
    <script>
        window.addEventListener('DOMContentLoaded', function () {
            var nameInput = document.getElementById('contact-name');
            var phoneInput = document.getElementById('contact-phone');
            var emailInput = document.getElementById('contact-email');
            var passwordInput = document.getElementById('contact-password');
            var confirmPasswordInput = document.getElementById('contact-confirm-password');

            nameInput.addEventListener('keyup', validateName);
            phoneInput.addEventListener('keyup', validatePhone);
            emailInput.addEventListener('keyup', validateEmail);
            passwordInput.addEventListener('keyup', validatePassword);
            confirmPasswordInput.addEventListener('keyup', validateConfirmPassword);
        });

        function validateName() {
            var nameInput = document.getElementById('contact-name');
            var nameError = document.getElementById('name-error');
       

            if (nameInput.value.trim() === '') {
                nameError.innerHTML = "Name is required";
                return false;
            } if (!nameInput.value.match(/^[A-Za-z]+\s+[A-Za-z]+$/)) {
                nameError.innerHTML = 'Write full Name';
                return false;
            }
            else {
                nameError.innerHTML = '<i class="fa fa-check-circle-o" aria-hidden="true"></i>';
                return true;
            }
        }

        function validatePhone() {
            var phoneInput = document.getElementById('contact-phone');
            var phoneError = document.getElementById('phone-error');
            var phonePattern = /^[0-9]{10}$/;

            if (phoneInput.value.trim() === '') {
                phoneError.innerHTML = "Phone number is required";
                return false;
            } else if (!phonePattern.test(phoneInput.value)) {
                phoneError.innerHTML = 'Phone number should be 10 digits';
                return false;
            } else {
                phoneError.innerHTML = '<i class="fa fa-check-circle-o" aria-hidden="true"></i>';
                return true;
            }
        }

        function validateEmail() {
            var emailInput = document.getElementById('contact-email');
            var emailError = document.getElementById('email-error');
            var emailPattern = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;

            if (emailInput.value.trim() === '') {
                emailError.innerHTML = "Email is required";
                return false;
            } else if (!emailPattern.test(emailInput.value)) {
                emailError.innerHTML = "Enter a valid email address";
                return false;
            } else {
                emailError.innerHTML = '<i class="fa fa-check-circle-o" aria-hidden="true"></i>';
                return true;
            }
        }

        function validatePassword() {
            var passwordInput = document.getElementById('contact-password');
            var passwordError = document.getElementById('password-error');
            var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{6,20}$/;

            if (passwordInput.value.trim() === '') {
                passwordError.innerHTML = "Password is required";
                return false;
            } else if (passwordInput.value.length < 6) {
                passwordError.innerHTML = "Password should be at least 6 characters";
                return false;
            } else if (passwordInput.value.length > 20) {
                passwordError.innerHTML = "Password should be less than 20 characters";
                return false;
            } else if (!passwordPattern.test(passwordInput.value)) {
                passwordError.innerHTML = "Password should contain at least one lowercase letter, one uppercase letter, one digit, one special character, and be 6-20 characters long";
                return false;
            } else {
                passwordError.innerHTML = '<i class="fa fa-check-circle-o" aria-hidden="true"></i>';
                return true;
            }
        }

        function validateConfirmPassword() {
            var passwordInput = document.getElementById('contact-password');
            var confirmPasswordInput = document.getElementById('contact-confirm-password');
            var confirmPasswordError = document.getElementById('confirm-password-error');

            if (confirmPasswordInput.value.trim() === '') {
                confirmPasswordError.innerHTML = "Confirm Password is required";
                return false;
            } else if (confirmPasswordInput.value !== passwordInput.value) {
                confirmPasswordError.innerHTML = 'Passwords do not match';
                return false;
            } else {
                confirmPasswordError.innerHTML = '<i class="fa fa-check-circle-o" aria-hidden="true"></i>';
                return true;
            }
        }

        function validateForm() {
            var isValid = true;

            isValid = isValid && validateName();
            isValid = isValid && validatePhone();
            isValid = isValid && validateEmail();
            isValid = isValid && validatePassword();
            isValid = isValid && validateConfirmPassword();

            if (!isValid) {
                var submitError = document.getElementById('submit-error');
                submitError.style.display = "block";
                submitError.innerHTML = "Please fill out the form correctly.";
                setTimeout(function () {
                    submitError.style.display = "none";
                }, 3000);
            }

            return isValid;
        }
    </script>



</body>

</html>


