<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <a href="search-patient.php">Return</a>
    <?php 
    include_once("database.php");

    $patient = ['name' => '', 'address' => ''];
    $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

    if ($id > 0 && $_SERVER['REQUEST_METHOD'] === 'GET') {
        $stmt = $mysqli->prepare("SELECT * FROM tbl_patient WHERE patient_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $patient = $result->fetch_assoc();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
        $id = (int) $_POST['id'];
        $name = $_POST['name'];
        $address = $_POST['address'];

        $stmt = $mysqli->prepare("UPDATE tbl_patient SET name = ?, address = ? WHERE patient_id = ?");
        $stmt->bind_param("ssi", $name, $address, $id);
        $stmt->execute();

        header("Location: index.php");
        exit;
    }
    ?>
        <h2>Edit Patient</h2>
        <form method="post">
            <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
            <label>Name:</label><br>
            <input type="text" name="name" value="<?= htmlspecialchars($patient['name'] ?? '') ?>"><br><br>
            <label>Address:</label><br>
            <textarea name="address"><?= htmlspecialchars($patient['address'] ?? '') ?></textarea><br><br>
            <button type="submit" name="update">Update</button>
        </form>
</body>
</html>