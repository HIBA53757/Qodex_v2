<?php
require_once '../../classes/Security.php';
$csrfToken = Security::generateCSRFToken();
?>

<aside class="w-64 min-h-screen bg-white shadow-md fixed">
<div class="p-6 text-xl font-bold border-b">Qodex Student</div>
<nav class="mt-6">
<a href="dashboard.php" class="block px-6 py-3 hover:bg-gray-100">Dashboard</a>
<a href="categ-quiz-list.php" class="block px-6 py-3 hover:bg-gray-100">Explore</a>

<a href="results.php" class="block px-6 py-3 hover:bg-gray-100">Result</a>
<a href="../../pages/auth/logout.php?token=<?= $csrfToken ?>" class="block px-6 py-3 text-red-500 hover:bg-red-50">
    Logout
</a>
</nav>
</aside>
  
