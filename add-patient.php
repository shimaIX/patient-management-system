<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h2>Add Patient</h2>
    <form method="POST">
        <label >Name</label>
        <input type="text" name="name" required>
        <label >Address</label>
        <input type="text" name="address" required>
        <button type="submit" name="add">Save</button>
    </form>

    <?php 
        include_once("database.php");

        if(isset($_POST['add'])) {
            $name = $_POST['name'];
            $address = $_POST['address'];

            $name_result = mysqli_query($mysqli, "SELECT name FROM tbl_patient WHERE name='$name'");

            $user_matched = mysqli_num_rows($name_result);

            if ($user_matched > 0) {
                echo "<br/><strong>Error: </strong> Patient already exists.";
            } else {
                $result   = mysqli_query($mysqli, "INSERT INTO tbl_patient(name, address) VALUES('$name','$address')");

                if (!$result) {
                    echo "Failed to add. Please try again." . mysqli_error($mysqli);
                } 
            }
        }
    ?>
</body>
</html>