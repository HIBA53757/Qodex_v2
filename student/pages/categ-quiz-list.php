<?php

require_once '../../config/database.php'; 

require_once '../../classes/database.php';

$pdo = Database::getInstance()->getConnection();

$sql = "
SELECT 
    c.id AS category_id,
    c.nom AS category_name,
    c.description AS category_description,
    COUNT(q.id) AS quiz_count
FROM categories c
LEFT JOIN quiz q 
    ON q.categorie_id = c.id AND q.is_active = 1
GROUP BY c.id
ORDER BY c.nom
";
$categories = $pdo->query($sql)->fetchAll();


$sqlQuizzes = "
SELECT 
    q.id AS quiz_id,
    q.titre AS quiz_title,
    q.description AS quiz_description,
    q.categorie_id,
    COUNT(questions.id) AS total_questions
FROM quiz q
LEFT JOIN questions 
    ON questions.quiz_id = q.id
WHERE q.is_active = 1
GROUP BY q.id
ORDER BY q.titre
";
$quizzes = $pdo->query($sqlQuizzes)->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/sidebar.php'; ?>

<div class="ml-64 bg-gray-50 min-h-screen pb-12">

    <div class="bg-gradient-to-r from-green-600 to-teal-600 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <h1 class="text-3xl font-bold mb-2">Bibliothèque de Quiz</h1>
            <p class="text-green-100 opacity-90">Explorez les catégories et testez vos connaissances.</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">

     
        <div class="mb-10">
            <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                <span class="w-2 h-8 bg-teal-500 rounded-full mr-3"></span>
                Catégories disponibles
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php foreach ($categories as $cat): ?>
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 hover:border-teal-400 transition-all cursor-pointer group">
                    <div class="h-2 bg-blue-500 rounded-t-xl"></div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <i class="fas fa-folder text-2xl text-blue-500"></i>
                            <span class="text-xs font-semibold bg-blue-50 text-blue-600 px-2 py-1 rounded">
                                <?= $cat['quiz_count'] ?> Quiz
                            </span>
                        </div>
                        <h3 class="font-bold text-gray-800 group-hover:text-teal-600"><?= htmlspecialchars($cat['category_name']) ?></h3>
                        <p class="text-sm text-gray-500 mt-2"><?= htmlspecialchars($cat['category_description']) ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div>
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-800 flex items-center">
                    <span class="w-2 h-8 bg-green-500 rounded-full mr-3"></span>
                    Quiz Actifs
                </h2>
            </div>

            <div class="space-y-4">
               <?php foreach ($quizzes as $quiz): ?>
<div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex flex-col md:flex-row md:items-center justify-between hover:shadow-md transition-shadow">
    <div class="flex items-center space-x-4">
        <div class="bg-green-100 text-green-600 p-3 rounded-lg">
            <i class="fas fa-terminal"></i>
        </div>
        <div>
            <h4 class="font-bold text-gray-800"><?= htmlspecialchars($quiz['quiz_title']) ?></h4>
            <div class="flex items-center space-x-4 mt-1 text-xs text-gray-500">
                <span class="flex items-center">
                    <i class="far fa-folder mr-1"></i>
                    <?php 
                    $catName = array_filter($categories, fn($c) => $c['category_id'] == $quiz['categorie_id']);
                    echo htmlspecialchars(reset($catName)['category_name'] ?? ''); 
                    ?>
                </span>
                <span class="flex items-center"><i class="far fa-clock mr-1"></i> 15 min</span>
                <span class="flex items-center"><i class="far fa-question-circle mr-1"></i> <?= $quiz['total_questions'] ?> Questions</span>
            </div>
        </div>
    </div>
    <div class="mt-4 md:mt-0 flex items-center space-x-3">
        <a href="take-quiz.php?id=<?= $quiz['quiz_id'] ?>" class="px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition transform hover:scale-105 active:scale-95 text-sm">
            Commencer le quiz
        </a>
    </div>
</div>
<?php endforeach; ?>

            </div>
        </div>

    </div>
</div>

<?php include '../includes/footer.php'; ?>
