<?php


if (isset($_POST['submit'])) {
    
include '../../login-system/classes/conn.php';
include '../user/get_answers.php';
// Instantiate the SurveyAnswer class
$surveyAnswer = new SurveyAnswer();
session_start();
// Process the form submission
$surveyAnswer->processFormSubmission();
}
