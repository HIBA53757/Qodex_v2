<?php
require_once '../../config/database.php';
require_once '../../classes/database.php';
require_once '../../classes/security.php';
require_once '../../classes/result.php';


Security::requireStudent();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $quizId = (int)$_POST['quiz_id'];
    $studentId = $_SESSION['user_id'];
    $studentAnswers = $_POST['answers'] ?? [];
    $db = Database::getInstance();
    $pdo = $db->getConnection();

    $stmt = $pdo->prepare("SELECT id, correct_option FROM questions WHERE quiz_id = ?");
    $stmt->execute([$quizId]);
    $questions = $stmt->fetchAll();

    $totalQuestions = count($questions);
    $score = 0;
    $detailedResults = [];

    foreach ($questions as $q) {
        $qId = $q['id'];
        $correct = (int)$q['correct_option'];
        $submitted = isset($studentAnswers[$qId]) ? (int)$studentAnswers[$qId] : null;

        if ($submitted === $correct) {
            $score++;
        }

        $detailedResults[$qId] = [
            'submitted' => $submitted,
            'correct' => $correct
        ];
    }

    $resultObj = new Result();
    $resultId = $resultObj->save($quizId, $studentId, $score, $totalQuestions);

    if ($resultId) {
        
        $_SESSION['last_quiz_details'] = $detailedResults;
        
        header("Location: results.php?id=" . $resultId);
        exit();
    } else {
        die("Erreur lors de l'enregistrement du résultat.");
    }

    $resultId = $resultObj->save($quizId, $studentId, $score, $totalQuestions);

    if ($resultId) {
        $_SESSION['last_quiz_details'] = $detailedResults;
        
        $url = "http://localhost/Qodex_v2/student/pages/results.php?id=" . $resultId;
        
        header("Location: " . $url);
        exit();
    } else {
        die("Erreur lors de l'enregistrement du résultat.");
    }
}
