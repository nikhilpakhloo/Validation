<?php
include "connectivity.php";
$name = $_COOKIE['name'];
$password = $_COOKIE['password'];

// Use the retrieved values as needed
// echo "Name: " . $name . "<br>";
// echo "Password: " . $password;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $password = $_POST['password'];

    if (empty($name) || empty($password)) {

        echo "<script src=\"https://cdn.jsdelivr.net/npm/sweetalert2@11\"></script>";
        echo "<script>
            // Show a SweetAlert alert
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please enter both username and password.',
                confirmButtonText: 'OK'
            }).then(function() {
                window.location.href = 'signin.php';
            });
        </script>";
        exit;
    }

    $query = "SELECT * FROM users WHERE name = '$name'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            $hashedpassword = $row['password'];

            if (md5($password) === $hashedpassword) {
                echo "<script src=\"https://cdn.jsdelivr.net/npm/sweetalert2@11\"></script>";
                echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'loggedin Successfully',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location.href = 'home.php';
                    });
                </script>";

                exit;
            } else {
                echo "<script src=\"https://cdn.jsdelivr.net/npm/sweetalert2@11\"></script>";
                echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Wrong Password',
                   
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href = 'login.php';
                });
            </script>";
                exit;
            }
        } else {
            echo "<script src=\"https://cdn.jsdelivr.net/npm/sweetalert2@11\"></script>";
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Wrong Username',
                
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                window.location.href = 'login.php';
            });
        </script>";
            exit;
        }
    } else {
        echo "<script src=\"https://cdn.jsdelivr.net/npm/sweetalert2@11\"></script>";
        echo "<script>
    Swal.fire({
        icon: 'error',
        title: 'Error Occurred',
        text: 'Something went wrong. " . mysqli_error($conn) . "',
        showConfirmButton: false,
        timer: 1500
    }).then(function() {
        window.location.href = 'login.php';
    });
</script>";
        exit;
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>


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
            height: 40%;
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

        .link {
            float: right;
            cursor: pointer;
        }
    </style>
    <script src="https://kit.fontawesome.com/c4254e24a8.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <form method="POST" action="login.php" id="formData" onsubmit="return signedin()">
            <i class="fa-solid fa-user-secret"></i>

            <div class="input-group">
                <label for="contact-name">Username</label>
                <input type="text" placeholder="Enter your username" name="name" id="contact-name"
                    value="<?php echo $name ?>">
                <span id="name-error"></span>
            </div>

            <div class="input-group">
                <label for="contact-password">Password</label>
                <input type="password" placeholder="Enter password" name="password" id="contact-phone"
                    value="<?php echo $password ?>">
                <span id="password-error"></span>
            </div>
            <button type="submit">Sign in</button>
            <span id="submit-error"></span>
            <a href="logup.php" class="link">New User? Register here.</a>
        </form>
    </div>
    <script>
        function signedin(event) {
            event.preventDefault();
            var username = document.getElementById("contact-name").value;
            var password = document.getElementById("contact-phone").value;
            if (username.trim() === '' || password.trim() === '') {
                document.getElementById("submit-error").textContent = "Please enter both username and password.";
                return;
            }
            document.getElementById("submit-error").textContent = "";
            document.getElementById("formData").submit();
        }


    </script>


</body>

</html>