<?php
// display survey in user profile
class SurveyDisplay extends DB_connect
{
    public function displaySurvey($numOfSurvey)
    {
        try {
            $connDB = $this->connect();

            // Fetch the survey details
            $surveyData = $this->getSurveyDetails($connDB, $numOfSurvey);

            // Display survey title and description
            echo "<h2>" . $surveyData['survey_name'] . "</h2>";
            echo "<p>" . $surveyData['description'] . "</p>";

            // Fetch questions and options for the survey
            $questionsData = $this->getSurveyQuestions($connDB, $surveyData['survey_id']);

            // Display form and questions
            echo '<form method="post" action="'.$_SERVER['PHP_SELF'].'" id="form_label">';
            foreach ($questionsData as $question) {
                echo '<div class="question-container">';
                echo "<h3>" . $question['questions_body'] . "</h3>";
                $this->displayQuestionOptions($connDB, $question['question_id']);
                echo '</div">';
            }
            echo "<br>";
            echo "<input type='submit' name='submit' value='Submit'>";
            echo "</form>";
    
        } catch (PDOException $e) {
            echo "Database query error: " . $e->getMessage();
        }
    }

    private function getSurveyDetails($connDB, $numOfSurvey)
    {
        $surveyQuery = "SELECT * FROM survey LIMIT 1 OFFSET $numOfSurvey";
        $surveyResult = $connDB->query($surveyQuery);
        return $surveyResult->fetch(PDO::FETCH_ASSOC);
    }

    private function getSurveyQuestions($connDB, $surveyId)
    {
        $questionsQuery = "SELECT * FROM survey_questions WHERE survey_id = :survey_id";
        $questionsStmt = $connDB->prepare($questionsQuery);
        $questionsStmt->bindParam(":survey_id", $surveyId);
        $questionsStmt->execute();
        return $questionsStmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function displayQuestionOptions($connDB, $questionId)
    {
        $optionsQuery = "SELECT * FROM options WHERE question_id = :question_id";
        $optionsStmt = $connDB->prepare($optionsQuery);
        $optionsStmt->bindParam(":question_id", $questionId);
        $optionsStmt->execute();
        $optionsData = $optionsStmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($optionsData as $option) {
            echo "<label>";
            echo "<input type='radio' name='question_" . $questionId . "' value='" . $option['option_id'] . "'>";
            echo $option['option_text'];
            echo "</label>";
            echo "<br>";
        }
    }



}



if (isset($_POST['submit'])) {
                
    //include '../../login-system/classes/conn.php';
    //include '../user/get_answers.php';
    include 'get_answers.php';
    // Instantiate the SurveyAnswer class
    $surveyAnswer = new SurveyAnswer();
    //session_start();
    // Process the form submission
    $surveyAnswer->processFormSubmission();
}