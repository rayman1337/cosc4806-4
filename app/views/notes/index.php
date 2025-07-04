<?php require_once '../app/views/templates/header.php'; ?>

<h2>My Reminders</h2>
<a href="/notes/create">+ Add Reminder</a>
<ul>
<?php foreach ($data['notes'] as $note): ?>
    <li>
        <strong><?= htmlspecialchars($note['subject']) ?></strong>
        [<?= $note['completed'] ? 'Completed' : 'Pending' ?>]
        <a href="/notes/edit/<?= $note['id'] ?>">Edit</a>
        <a href="/notes/delete/<?= $note['id'] ?>" onclick="return confirm('Delete this note?')">Delete</a>
    </li>
<?php endforeach; ?>
</ul>

<?php require_once '../app/views/templates/footer.php'; ?>
