<?php

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data and encode special characters
    $surveyTitle = htmlspecialchars($_POST['survey_title']);
    $surveyDescription = htmlspecialchars($_POST['survey_description']);
    $questions = $_POST['questions'];
    $options = $_POST['options'];

    // Perform validations using regular expressions
    $errors = [];

    // Check if survey title is not empty and matches the pattern
    if (empty($surveyTitle) || !preg_match('/^\S+.*$/', $surveyTitle)) {
        $errors[] = 'Survey title is required and should start with a non-whitespace character.';
    }

    // Check if survey description is not empty and matches the pattern
    if (empty($surveyDescription) || !preg_match('/^\S+.*$/', $surveyDescription)) {
        $errors[] = 'Survey description is required and should start with a non-whitespace character.';
    }

    // Check if at least one question is provided
    if (empty($questions)) {
        $errors[] = 'Please provide at least one question.';
    }

    // Check if all questions have at least two options
    foreach ($questions as $questionIndex => $question) {
        // Encode special characters in the question
        $questions[$questionIndex] = htmlspecialchars($question);

        if (!is_array($options[$questionIndex])) {
            $errors[] = 'Invalid question options for question ' . ($questionIndex + 1) . '.';
            break;
        }

        foreach ($options[$questionIndex] as $optionIndex => $option) {
            // Encode special characters in the option
            $options[$questionIndex][$optionIndex] = htmlspecialchars($option);

            if (empty(trim($option)) || !preg_match('/^\S+.*$/', $option)) {
                $errors[] = 'Options must not be empty and should start with a non-whitespace character for question ' . ($questionIndex + 1) . '.';
                break;
            }
        }
    }

    // If there are any errors, display them
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p>Error: $error</p>";
        }
    } else {
        include '../admin/create_survey.php';

        $insert_survey = new Insert_survey($surveyTitle, $surveyDescription, $questions, $options);
        $insert_survey->createSurvey($surveyTitle, $surveyDescription, $questions, $options);

        include 'create_file.php';
        $creatForm = new CreatFile();
        $creatForm->createFile($surveyTitle, $surveyDescription);
    }
}




