<?php
include '../../login-system/classes/conn.php';
include 'control-panal.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $surveyId = $_POST['survey_id'];
    $surveyName = $_POST['survey_name'];
    $description = $_POST['description'];

    $updateSurvey = new ControlPanal();
    $updateSurvey->updateSurveyDetails($surveyId, $surveyName, $description);

    header("location: /survey/profile/admin-profile.php?error=none");
}

if(isset($_POST['delete_survey'])){
    $surveyId = $_POST['survey_id'];

    $deleteSurvey = new ControlPanal();
    $deleteSurvey->deleteSurvey($surveyId);

    header("location: /survey/profile/admin/update_survey_view.php?error=none");
}