<?php include '../includes/header.php'; ?>
<?php include '../includes/sidebar.php'; ?>
<?php require_once '../../classes/Database.php'; ?>
<?php require_once '../../classes/Security.php'; ?>


  <div class="ml-64">
        <div id="studentDashboard" class="student-section">
            <div class="bg-gradient-to-r from-green-600 to-teal-600 text-white">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                    <h1 class="text-4xl font-bold mb-4">Espace Étudiant</h1>
                    <p class="text-xl text-green-100 mb-6">Passez des quiz et suivez votre progression</p>
                </div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                    <div onclick="showStudentSection('categoryQuizzes', 'HTML/CSS')" class="bg-white rounded-xl shadow-md hover:shadow-xl transition duration-300 overflow-hidden group cursor-pointer">
                        <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-6 text-white">
                            <i class="fas fa-code text-4xl mb-3"></i>
                            <h3 class="text-xl font-bold">MES CATEGORIES</h3>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-600 mb-4">Consulter nos catégories</p>
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-500"><i class="fas fa-clipboard-list mr-2"></i>. quiz</span>
                                <a href="categ-quiz-list.php" class="text-green-600 font-semibold group-hover:translate-x-2 transition-transform" >Explorer →</a> 
                            </div>
                        </div>
                    </div>

                    <div onclick="showStudentSection('categoryQuizzes', 'JavaScript')" class="bg-white rounded-xl shadow-md hover:shadow-xl transition duration-300 overflow-hidden group cursor-pointer">
                        <div class="bg-gradient-to-br from-purple-500 to-purple-600 p-6 text-white">
                            <i class="fas fa-laptop-code text-4xl mb-3"></i>
                            <h3 class="text-xl font-bold">MES QUIZ</h3>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-600 mb-4">Découvrez nos quiz</p>
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-500"><i class="fas fa-clipboard-list mr-2"></i>. categorie</span>
                                <a href="categ-quiz-list.php" class="text-purple-600 font-semibold group-hover:translate-x-2 transition-transform">Explorer →</a>
                            </div>
                        </div>
                    </div>

                    <div onclick="showStudentSection('categoryQuizzes', 'PHP/MySQL')" class="bg-white rounded-xl shadow-md hover:shadow-xl transition duration-300 overflow-hidden group cursor-pointer">
                        <div class="bg-gradient-to-br from-green-500 to-green-600 p-6 text-white">
                            <i class="fas fa-database text-4xl mb-3"></i>
                            <h3 class="text-xl font-bold">MON HISTORIQUE</h3>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-600 mb-4">Consulter mon historique</p>
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-500"><i class="fas fa-clipboard-list mr-2"></i>. quiz</span>
                                <a href="" class="text-green-600 font-semibold group-hover:translate-x-2 transition-transform">Explorer →</a>
                            </div>
                        </div>
                    </div>

                    <div onclick="showStudentSection('studentResults')" class="bg-white rounded-xl shadow-md hover:shadow-xl transition duration-300 overflow-hidden group cursor-pointer">
                        <div class="bg-gradient-to-br from-orange-500 to-orange-600 p-6 text-white">
                            <i class="fas fa-chart-line text-4xl mb-3"></i>
                            <h3 class="text-xl font-bold">Mes Résultats</h3>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-600 mb-4">Consultez vos performances</p>
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-500"><i class="fas fa-trophy mr-2"></i>24 tentatives</span>
                                <a href="mes_resultats.php" class="text-orange-600 font-semibold group-hover:translate-x-2 transition-transform">Explorer →</a>
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>
<?php include '../includes/footer.php'; ?>