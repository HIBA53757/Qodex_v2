<?php


require_once '../../config/database.php';  
require_once '../../classes/database.php';  


if (!isset($_GET['id'])) {
    die('Quiz invalide.');
}
$quizId = (int) $_GET['id'];

$pdo = Database::getInstance()->getConnection();

$stmt = $pdo->prepare("SELECT * FROM quiz WHERE id = ? AND is_active = 1");
$stmt->execute([$quizId]);
$quiz = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$quiz) {
    die('Quiz non disponible.');
}
$stmt = $pdo->prepare("SELECT * FROM questions WHERE quiz_id = ?");
$stmt->execute([$quizId]);
$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($questions) === 0) {
    die('Aucune question dans ce quiz.');
}

?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/sidebar.php'; ?>

<main class="ml-64 p-6">

    <h1 class="text-2xl font-bold mb-4"><?= htmlspecialchars($quiz['titre']) ?></h1>
    <p class="mb-6"><?= htmlspecialchars($quiz['description']) ?></p>

    <form method="POST" action="submit-quiz.php">
        <?php foreach ($questions as $index => $q): ?>
            <div class="mb-6 p-4 border rounded">
                <h3 class="font-semibold mb-2">Question <?= $index + 1 ?></h3>
                <p class="mb-3"><?= htmlspecialchars($q['question']) ?></p>

                <?php for ($i = 1; $i <= 4; $i++): ?>
                    <label class="block mb-1">
                        <input type="radio" name="answers[<?= $q['id'] ?>]" value="<?= $i ?>">
                        <?= htmlspecialchars($q['option'.$i]) ?>
                    </label>
                <?php endfor; ?>
            </div>
        <?php endforeach; ?>

        <input type="hidden" name="quiz_id" value="<?= $quizId ?>">

        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Soumettre le quiz</button>
    </form>

</main>

<?php include '../includes/footer.php'; ?>
