<?php
require_once '../../config/database.php';
require_once '../../classes/database.php';
require_once '../../classes/security.php';
require_once '../../classes/result.php';
require_once '../../classes/question.php';

Security::requireStudent();

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: dashboard.php"); 
    exit();
}

$resultId = (int)$_GET['id'];
$studentId = $_SESSION['user_id'];

$resultObj = new Result();
$resultData = $resultObj->getById($resultId, $studentId);

if (!$resultData) {
    die("Résultat introuvable ou accès non autorisé.");
}

$questionObj = new Question();
$questions = $questionObj->getAllByQuiz($resultData['quiz_id']);
$detailedAnswers = $_SESSION['last_quiz_details'] ?? [];
?>

<?php include '../includes/header.php'; ?>
<main class="max-w-4xl mx-auto p-6">
    <div class="bg-white shadow-lg rounded-lg p-8 mb-6 text-center">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Quiz Terminé !</h1>
        <p class="text-xl text-gray-600">Félicitations, vous avez terminé le quiz : <strong><?= htmlspecialchars($resultData['quiz_titre']) ?></strong></p>
        
        <div class="mt-6">
            <span class="text-5xl font-extrabold text-blue-600"><?= $resultData['score'] ?> / <?= $resultData['total_questions'] ?></span>
            <p class="text-gray-500 mt-2">Votre score final</p>
        </div>
    </div>

    <h2 class="text-2xl font-bold mb-4">Récapitulatif de vos réponses</h2>
    
    <?php foreach ($questions as $q): 
        $userAns = $detailedAnswers[$q['id']]['submitted'] ?? null;
        $correctAns = $q['correct_option'];
    ?>
        <div class="mb-4 p-4 border rounded-lg <?php echo ($userAns == $correctAns) ? 'bg-green-50 border-green-200' : 'bg-red-50 border-red-200'; ?>">
            <p class="font-semibold text-gray-800 mb-2"><?= htmlspecialchars($q['question']) ?></p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 text-sm">
                <p><strong>Votre réponse :</strong> 
                    <span class="<?= ($userAns == $correctAns) ? 'text-green-700' : 'text-red-700' ?>">
                        <?= $userAns ? htmlspecialchars($q['option'.$userAns]) : 'Aucune réponse' ?>
                    </span>
                </p>
                <p><strong>Réponse correcte :</strong> 
                    <span class="text-green-700 font-bold"><?= htmlspecialchars($q['option'.$correctAns]) ?></span>
                </p>
            </div>
        </div>
    <?php endforeach; ?>

    <div class="mt-8">
        <a href="dashboard.php" class="px-6 py-3 bg-gray-800 text-white rounded-lg hover:bg-gray-700">Retour au tableau de bord</a>
    </div>
</main>
<?php include '../includes/footer.php'; ?>