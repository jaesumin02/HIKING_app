<?php
require_once 'config.php';
$stmt = $pdo->query("SELECT * FROM trails ORDER BY id DESC");
$trails = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hiking Trail Directory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2> Hiking Trail Directory</h2>
            <a href="create.php" class="btn btn-success">+ Add Trail</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Trail Name</th>
                            <th>Location</th>
                            <th>Difficulty</th>
                            <th>Length (km)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($trails) > 0): ?>
                            <?php foreach ($trails as $trail): ?>
                                <tr>
                                    <td><?= $trail['id']; ?></td>
                                    <td><strong><?= htmlspecialchars($trail['name']); ?></strong></td>
                                    <td><?= htmlspecialchars($trail['location']); ?></td>
                                    <td>
                                        <span class="badge bg-<?php 
                                            echo $trail['difficulty'] == 'Easy' ? 'success' : ($trail['difficulty'] == 'Moderate' ? 'warning text-dark' : 'danger'); 
                                        ?>">
                                            <?= htmlspecialchars($trail['difficulty']); ?>
                                        </span>
                                    </td>
                                    <td><?= $trail['length_km']; ?> km</td>
                                    <td>
                                        <a href="update.php?id=<?= $trail['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                        <a href="delete.php?id=<?= $trail['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this trail?');">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted">No hiking trails found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>