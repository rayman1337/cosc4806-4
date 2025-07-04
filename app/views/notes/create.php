<?php require_once '../app/views/templates/header.php'; ?>

<h2>Create Reminder</h2>
<form method="POST" action="">
    <label>Subject:</label><br>
    <input type="text" name="subject" required><br><br>
    <button type="submit">Save</button>
</form>

<?php require_once '../app/views/templates/footer.php'; ?>
