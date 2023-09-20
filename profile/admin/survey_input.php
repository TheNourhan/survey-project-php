<?php
    session_start();
    if (!isset($_SESSION["admin"])) {
        header("location: /survey/index.php?error=none");
        exit();
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Survey</title>
    <link rel="stylesheet" href="create_survey.css">
    
</head>
<body>

    <h1>Create Survey</h1>

    <form method="POST" action="../includes/center-admin.php">
        <label for="survey_title">Survey Title:</label>
        <input type="text" id="survey_title" name="survey_title" required=""><br>

        <label for="survey_description">Survey Description:</label>
        <textarea id="survey_description" name="survey_description" rows="4" required=""></textarea><br>

        <h2>Questions:</h2>
        <div id="questions_container">
            <div class="question">
                <label for="question1">Question 1:</label>
                <input type="text" id="question1" name="questions[]" required=""><br>
                <label for="option1_1">Option 1:</label>
                <input type="text" id="option1_1" name="options[0][]" required="">
                <label for="option1_2">Option 2:</label>
                <input type="text" id="option1_2" name="options[0][]" required="">
                <label for="option1_3">Option 3:</label>
                <input type="text" id="option1_3" name="options[0][]" required="">
                <label for="option1_4">Option 4:</label>
                <input type="text" id="option1_4" name="options[0][]" required="">
            </div>
        </div>

        <button type="button" onclick="addQuestion()">Add Question</button>

        <input type="submit" value="Create Survey">
    </form>

    <script>
        let questionCount = 0;

        function addQuestion() {
            questionCount++;

            const questionDiv = document.createElement('div');
            questionDiv.classList.add('question');

            const questionLabel = document.createElement('label');
            questionLabel.textContent = 'Question ' + questionCount + ':';
            questionDiv.appendChild(questionLabel);

            const questionInput = document.createElement('input');
            questionInput.type = 'text';
            questionInput.name = 'questions[]';
            questionInput.required = true;
            questionDiv.appendChild(questionInput);

            for (let i = 1; i <= 4; i++) {
                const optionLabel = document.createElement('label');
                optionLabel.textContent = 'Option ' + i + ':';
                questionDiv.appendChild(optionLabel);

                const optionInput = document.createElement('input');
                optionInput.type = 'text';
                optionInput.name = 'options[' + questionCount + '][]';
                optionInput.required = true;
                questionDiv.appendChild(optionInput);
            }

            document.getElementById('questions_container').appendChild(questionDiv);
        }
    </script>
</body>
</html>


