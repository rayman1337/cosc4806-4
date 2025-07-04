<?php require_once 'app/views/templates/header.php'; ?>

<h2>Edit Reminder</h2>
<form method="POST" action="">
    <label>Subject:</label><br>
    <input type="text" name="subject" value="<?= htmlspecialchars($data['note']['subject']) ?>" required><br><br>
    <label><input type="checkbox" name="completed" <?= $data['note']['completed'] ? 'checked' : '' ?>> Completed</label><br><br>
    <button type="submit">Update</button>
</form>

<?php require_once 'app/views/templates/footer.php'; ?>
