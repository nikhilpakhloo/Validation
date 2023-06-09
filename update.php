<?php
include "connectivity.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize user input

    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Update user credentials in the database
    $sql = "UPDATE users SET name='$name', password='$password' WHERE id='$id'"; // Modify this query based on your table structure
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Update the 'updated_date' column with the current date and time
        $currentDateTime = date('Y-m-d H:i:s');
        $updateDateSql = "UPDATE users SET updated_date='$currentDateTime' WHERE id='$id'"; // Modify this query based on your table structure
        mysqli_query($conn, $updateDateSql);

        // Display a success message with a fancy alert
        echo "<script src=\"https://cdn.jsdelivr.net/npm/sweetalert2@11\"></script>";
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Credentials Updated Successfully',
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                window.location.href = 'signin.php';
            });
        </script>";
    } else {
        // Display an error message with a fancy alert
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
                window.location.href = 'signin.php';
            });
        </script>";
    }
}
?>
