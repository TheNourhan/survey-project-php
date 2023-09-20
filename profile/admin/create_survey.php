<?php
include '../../login-system/classes/conn.php';

// Store in database
class Insert_survey extends DB_connect{

    private $surveyTitle;
    private $surveyDescription;
    private $questions;
    private $options;

    public function __construct($surveyTitle, $surveyDescription, $questions, $options) {
        $this->surveyTitle = $surveyTitle;
        $this->surveyDescription = $surveyDescription;
        $this->questions =$questions;
        $this->options = $options;
    }

    public function createSurvey($surveyTitle, $surveyDescription, $questions, $options) {
        // Store the survey details in the database
        $surveyId = $this->storeSurveyDetails($surveyTitle, $surveyDescription);
    
        // Store the questions and options in the database
        $this->storeQuestionsAndOptions($surveyId, $questions, $options);
    }

    public function storeSurveyDetails($surveyTitle, $surveyDescription){
        $connDB=$this->connect();
        $sql="INSERT INTO survey(survey_name, description) VALUES (:survey_name, :description)";
        $stmt=$connDB->prepare($sql);
        $stmt->bindParam(":survey_name", $surveyTitle);
        $stmt->bindParam(":description", $surveyDescription);
        $stmt->execute();

        // Retrieve the generated survey ID
         return $connDB->lastInsertId();
    }

    public function storeQuestionsAndOptions($surveyId, $questions, $options) {
        for ($i = 0; $i < count($questions); $i++){
          $connDB=$this->connect(); 

          $stmt =  $connDB->prepare("INSERT INTO survey_questions (survey_id, questions_body) VALUES (:survey_id, :questions_body)");
          $stmt->bindParam(":survey_id", $surveyId);
          $stmt->bindParam(":questions_body", $questions[$i]);
          $stmt->execute();
    
          $questionId =  $connDB->lastInsertId();
          for ($j = 0; $j < count($options[$i]); $j++) {
            $stmt = $connDB->prepare("INSERT INTO options (question_id, option_text) VALUES (:question_id, :option_text)");
            $stmt->bindParam(":question_id", $questionId);
            $stmt->bindParam(":option_text", $options[$i][$j]);
            $stmt->execute();
          }
        }
    }
}
