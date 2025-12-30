<?php include '../includes/header.php'; ?>
<?php include '../includes/sidebar.php'; ?>


<main class="ml-64 p-8">
<h1 class="text-2xl font-bold mb-6">My Quizzes</h1>


<table class="w-full bg-white rounded shadow">
<thead class="bg-gray-100">
<tr>
<th class="p-3 text-left">Quiz</th>
<th class="p-3">Category</th>
<th class="p-3">Action</th>
</tr>
</thead>
<tbody>
<tr class="border-t">
<td class="p-3">PHP Basics</td>
<td class="p-3 text-center">PHP</td>
<td class="p-3 text-center">
<a href="quiz_take.php" class="px-4 py-1 bg-blue-600 text-white rounded">Start</a>
</td>
</tr>
</tbody>
</table>
</main>


<?php include '../includes/footer.php'; ?>