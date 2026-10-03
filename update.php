<?php
require_once 'config.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: read.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM trails WHERE id = ?");
$stmt->execute([$id]);
$trail = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$trail) {
    die("Trail not found.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $location = trim($_POST['location']);
    $difficulty = $_POST['difficulty'];
    $length_km = $_POST['length_km'];
    $description = trim($_POST['description']);

    if (!empty($name) && !empty($location) && !empty($difficulty) && !empty($length_km)) {
        $stmt = $pdo->prepare("UPDATE trails SET name = ?, location = ?, difficulty = ?, length_km = ?, description = ? WHERE id = ?");
        $stmt->execute([$name, $location, $difficulty, $length_km, $description, $id]);
        header('Location: read.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Trail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container my-5" style="max-width: 600px;">
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="card-title mb-4">Edit Hiking Trail</h3>
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Trail Name</label>
                        <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($trail['name']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Location</label>
                        <input type="text" name="location" class="form-control" value="<?= htmlspecialchars($trail['location']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Difficulty</label>
                        <select name="difficulty" class="form-select" required>
                            <option value="Easy" <?= $trail['difficulty'] == 'Easy' ? 'selected' : ''; ?>>Easy</option>
                            <option value="Moderate" <?= $trail['difficulty'] == 'Moderate' ? 'selected' : ''; ?>>Moderate</option>
                            <option value="Difficult" <?= $trail['difficulty'] == 'Difficult' ? 'selected' : ''; ?>>Difficult</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Length (km)</label>
                        <input type="number" step="0.01" name="length_km" class="form-control" value="<?= $trail['length_km']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($trail['description']); ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Update Trail</button>
                    <a href="read.php" class="btn btn-secondary w-100 mt-2">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>