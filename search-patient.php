<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php 
    include_once("database.php");

    $search = '';
    if (isset($_GET['search'])) {
        $search = $mysqli->real_escape_string($_GET['search']);
        $query = "SELECT * FROM tbl_patient WHERE name LIKE '%$search%'";
    } else {
        $query = "SELECT * FROM tbl_patient";
    }
    
    $result = $mysqli->query($query);
    ?>

    <h2>Patient List</h2>

    <form method="get">
        <input type="text" name="search" placeholder="Search by name" value="<?= htmlspecialchars($search) ?>">
        <button type="submit">Search</button>
        <a href="index.php">Reset</a>
    </form>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>Actions</th>
        </tr>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['patient_id']) ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['address']) ?></td>
                    <td class="actions">
                        <a href="edit-patient.php?id=<?= $row['patient_id'] ?>">Edit</a>
                        <a href="delete-patient.php?id=<?= $row['patient_id'] ?>" onclick="return confirm('Are you sure?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="4" style="text-align:center;">No patients found.</td>
            </tr>
        <?php endif; ?>
</table>
</body>
</html>