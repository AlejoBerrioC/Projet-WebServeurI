<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/styleQuizList.css">
    <script src="../../public/js/jsQuizList.js"></script>
    <title>Quiz List</title>
</head>
<body>
    <div class="my-container">
        <div class="table-title">
            <h1>Manage Quizes</h1>
            <button type="button" onclick="creationQuiz()">Add New Quiz</button>
        </div>
        <div class="quiz-list">
            <table id="idTable-quiz">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Release Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Quiz 1</td>
                        <td>Test</td>
                        <td>2024-11-24</td>
                        <td><button type="button">Edit</button></td>
                    </tr>
                    <tr>
                        <td>Quiz 2</td>
                        <td>Test 2</td>
                        <td>2024-11-24</td>
                        <td><button type="button">Edit</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>