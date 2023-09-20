<?php
    
class SurveyAnswer extends DB_connect{

    public function storeAnswer($surveyId, $questionId, $userId, $optionId)
    {
        try {
            $connDB = $this->connect();

            // Check if the user has already answered the question
            $checkAnswerQuery = "SELECT answer_id FROM survey_answers WHERE survey_id = :survey_id AND question_id = :question_id AND usere_id = :usere_id";
            $checkAnswerStmt = $connDB->prepare($checkAnswerQuery);
            $checkAnswerStmt->bindParam(":survey_id", $surveyId);
            $checkAnswerStmt->bindParam(":question_id", $questionId);
            $checkAnswerStmt->bindParam(":usere_id", $userId);
            $checkAnswerStmt->execute();

            if ($checkAnswerStmt->rowCount() > 0) {
                // User has already answered the question, update the existing answer
                $updateQuery = "UPDATE survey_answers SET option_id = :option_id WHERE survey_id = :survey_id AND question_id = :question_id AND usere_id = :usere_id";
                $updateStmt = $connDB->prepare($updateQuery);
                $updateStmt->bindParam(":survey_id", $surveyId);
                $updateStmt->bindParam(":question_id", $questionId);
                $updateStmt->bindParam(":usere_id", $userId);
                $updateStmt->bindParam(":option_id", $optionId);
                $updateStmt->execute();
            } else {
                // User has not answered the question, insert a new answer
                $insertQuery = "INSERT INTO survey_answers (survey_id, question_id, usere_id, option_id) VALUES (:survey_id, :question_id, :usere_id, :option_id)";
                $insertStmt = $connDB->prepare($insertQuery);
                $insertStmt->bindParam(":survey_id", $surveyId);
                $insertStmt->bindParam(":question_id", $questionId);
                $insertStmt->bindParam(":usere_id", $userId);
                $insertStmt->bindParam(":option_id", $optionId);
                $insertStmt->execute();
            }
        } catch (PDOException $e) {
            echo "Database query error: " . $e->getMessage();
        }
    }

    public function processFormSubmission(){
       // if (isset($_POST['submit'])) {
            // Get the user ID from the session or database
            $userId = $_SESSION["userid"]; // Replace with your own logic to retrieve the user ID
            $numOfSurvey = $_SESSION["numOfSurvey"];
    
            // Instantiate the SurveyAnswer class
            $surveyAnswer = new SurveyAnswer();
    
            // Fetch survey details from the database
            $connDB = $this->connect();
            $surveyQuery = "SELECT * FROM survey LIMIT 1 OFFSET $numOfSurvey";
            $surveyResult = $connDB->query($surveyQuery);
            $surveyData = $surveyResult->fetch(PDO::FETCH_ASSOC);
    
            // Fetch questions and options from the database
            $questionsQuery = "SELECT * FROM survey_questions WHERE survey_id = :survey_id";
            $questionsStmt = $connDB->prepare($questionsQuery);
            $questionsStmt->bindParam(":survey_id", $surveyData['survey_id']);
            $questionsStmt->execute();
            $questionsData = $questionsStmt->fetchAll(PDO::FETCH_ASSOC);
    
            // Create an array to store the answered questions and options
            $answeredQuestions = array();
            $c=1;
            foreach ($questionsData as $question) {
                $questionId = $question['question_id'];
    
                // Check if the question ID exists in the $_POST array
                if (isset($_POST['question_' . $questionId])) {
                    $optionId = $_POST['question_' . $questionId];
                    $surveyAnswer->storeAnswer($surveyData['survey_id'], $questionId, $userId, $optionId);
    
                    // Fetch the question text from the database
                    $questionText = $question['questions_body'];
    
                    // Fetch the selected option text from the database
                    $optionsQuery = "SELECT option_text FROM options WHERE option_id = :option_id";
                    $optionsStmt = $connDB->prepare($optionsQuery);
                    $optionsStmt->bindParam(":option_id", $optionId);
                    $optionsStmt->execute();
                    $optionText = $optionsStmt->fetchColumn();
    
                    // Add the answered question and option to the array
                    $answeredQuestions[] = "Question $c: $questionText, Option: $optionText";
                    $_SESSION['answeredQuestions'] = $answeredQuestions;

                    // Update the option selection ratio
                    $surveyAnswer->updateOptionSelectionRatio($optionId);

                    $c++;
                }else{
                    echo "No answer provided for question ID: " . $questionId . "<br>";
                }
            }
            //header("location: ../user/download_answers.php?error=none");
            header("location: ../user/download_answers.php?error=none");
        //}
    }

    public function downloadAnswers($answeredQuestions){
         // Write the answered questions to the file
         $filePath = "your_answers.txt";
         $fileContent = implode("\n", $answeredQuestions);
         file_put_contents($filePath, $fileContent);
 
         // Allow the user to download the file
         if (file_exists($filePath)) {
             header('Content-Description: File Transfer');
             header('Content-Type: application/octet-stream');
             header('Content-Disposition: attachment; filename=' . basename($filePath));
             header('Expires: 0');
             header('Cache-Control: must-revalidate');
             header('Pragma: public');
             header('Content-Length: ' . filesize($filePath));
             readfile($filePath);
             exit;
         } else {
             echo "File not found.";
         }
    }

    public function updateOptionSelectionRatio($optionId) {
        try {
            $connDB = $this->connect();

            $updateRatioQuery = "UPDATE options SET selection_ratio = selection_ratio + 1 WHERE option_id = :option_id";
            $updateRatioStmt = $connDB->prepare($updateRatioQuery);
            $updateRatioStmt->bindParam(":option_id", $optionId);
            $updateRatioStmt->execute();
        } catch (PDOException $e) {
            echo "Database query error: " . $e->getMessage();
        }
    }
}


