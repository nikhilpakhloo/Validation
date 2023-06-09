<?php
include "connectivity.php";
?>

<?php
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];
$hashedpassword = md5($password);

setcookie("name",$name, time() + (60*1), "/");
setcookie("password",$password, time() + (60*1), "/");






$sql = "INSERT INTO `users` (`name`, `phone`, `email`, `password`, `created`) VALUES ('$name', '$phone', '$email', '$hashedpassword', CURRENT_TIMESTAMP);;";

if (mysqli_query($conn, $sql)) {
   
    echo "<script src=\"https://cdn.jsdelivr.net/npm/sweetalert2@11\"></script>";
    echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Registered Successfully',
            showConfirmButton: false,
            timer: 1500
        }).then(function() {
            window.location.href = 'login.php';
        });
    </script>";


} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    echo "<script src=\"https://cdn.jsdelivr.net/npm/sweetalert2@11\"></script>";
    echo "<script>
    Swal.fire({
        icon: 'error',
        title: 'Error Occurred',
        text: 'An error occurred. Please try again.',
        showConfirmButton: false,
        timer: 1500
    }).then(function() {
        window.location.href = 'logup.php';
    });
</script>";
}

?>