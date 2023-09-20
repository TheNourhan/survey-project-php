<?php
 
class ControlPanal extends DB_connect {
    public function ListOfSurvey(){
        // Fetch the list of surveys from the database
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT survey_id, survey_name FROM survey");
        $stmt->execute();
        $surveys = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Display the list of surveys
        echo '<h3>List of Surveys</h3>';

        if (empty($surveys)) {
            echo '<p>No surveys found.</p>';
        } else {
            echo '<form method="POST" action="'.$_SERVER['PHP_SELF'].'">';
            echo '<select name="survey_id">';
            echo '<option value="">Select a survey</option>';
            foreach ($surveys as $survey) {
                echo '<option value="' . $survey['survey_id'] . '">' . $survey['survey_name'] . '</option>';
            }
            echo '</select>';

            echo '<button type="submit" name="submit">View Survey</button>';
            echo '</form>';
        }

    }

    public function ViewSurveyResults($survey_id){
        // Fetch the survey details from the database
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT * FROM survey WHERE survey_id = :survey_id");
        $stmt->bindParam(':survey_id', $survey_id);
        $stmt->execute();
        $survey = $stmt->fetch(PDO::FETCH_ASSOC);

        // Fetch the survey questions and their options from the database
        $stmt = $conn->prepare("SELECT q.questions_body, o.option_text, o.selection_ratio
                                FROM survey_questions q
                                INNER JOIN options o ON q.question_id = o.question_id
                                WHERE q.survey_id = :survey_id");
        $stmt->bindParam(':survey_id', $survey_id);
        $stmt->execute();
        $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Fetch the count of participants
        $participantCountQuery = "SELECT COUNT(DISTINCT usere_id) AS participant_count FROM survey_answers WHERE survey_id = :survey_id";
        $participantCountStmt = $conn->prepare($participantCountQuery);
        $participantCountStmt->bindParam(':survey_id', $survey_id);
        $participantCountStmt->execute();
        $participantCount = $participantCountStmt->fetchColumn();
        // Display the survey results
        echo '<div class="survey-results-container">';
        echo '<h3>Survey Results: </h3>';
        echo '<p>Number of participants: ' . $participantCount . '</p>';

        if (empty($questions)) {
            echo '<p>No survey results found.</p>';
        } else {
            echo '<table>';
            echo '<tr><th>Question</th><th>Option</th><th>Selection Ratio</th><th>Selection Percentage</th></tr>';
            foreach ($questions as $question) {
                echo '<tr>';
                echo '<td>' . $question['questions_body'] . '</td>';
                echo '<td>' . $question['option_text'] . '</td>';
                echo '<td>' . $question['selection_ratio'] . '</td>';

                // Calculate the selection percentage for the current option
                $selectionPercentage = ($participantCount !== 0) ? ($question['selection_ratio'] / $participantCount) * 100 : 0;
                echo '<td>' . $selectionPercentage . '%</td>';

                echo '</tr>';
            }
            echo '</table>';
        }
        
        
    }

    public function ViewSurveyResultsByAge($survey_id){
        // Fetch the survey details from the database
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT * FROM survey WHERE survey_id = :survey_id");
        $stmt->bindParam(':survey_id', $survey_id);
        $stmt->execute();
        $survey = $stmt->fetch(PDO::FETCH_ASSOC);

        // Fetch the survey results by age
        $stmt = $conn->prepare("SELECT u.users_age, COUNT(sa.answer_id) AS selection_count
                                FROM survey_questions q
                                INNER JOIN options o ON q.question_id = o.question_id
                                INNER JOIN survey_answers sa ON sa.option_id = o.option_id
                                INNER JOIN users u ON sa.usere_id = u.usere_id
                                WHERE q.survey_id = :survey_id
                                GROUP BY u.users_age");
        $stmt->bindParam(':survey_id', $survey_id);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Calculate the total number of participants
        $participantCount = array_sum(array_column($results, 'selection_count'));

        // Display the survey results
        echo '<h3> Survey Results by Age: </h3>';

        if (empty($results)) {
            echo '<p>No survey results found.</p>';
        } else {
            echo '<table>';
            echo '<tr><th>Age</th><th>Total Participants</th><th>Percentage</th></tr>';
            foreach ($results as $result) {
                echo '<tr>';
                echo '<td>' . $result['users_age'] . '</td>';
                echo '<td>' . $result['selection_count'] . '</td>';

                // Calculate the percentage of participants for the current age group
                $percentage = ($result['selection_count'] / $participantCount) * 100;
                echo '<td>' . $percentage . '%</td>';

                echo '</tr>';
            }
            echo '</table>';
        }
    }

    public function SurveyResultsByAge($survey_id){
        // Fetch the survey details from the database
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT * FROM survey WHERE survey_id = :survey_id");
        $stmt->bindParam(':survey_id', $survey_id);
        $stmt->execute();
        $survey = $stmt->fetch(PDO::FETCH_ASSOC);

        // Fetch the survey results by age
        $stmt = $conn->prepare("SELECT u.users_age, COUNT(sa.answer_id) AS selection_count
                                FROM survey_questions q
                                INNER JOIN options o ON q.question_id = o.question_id
                                INNER JOIN survey_answers sa ON sa.option_id = o.option_id
                                INNER JOIN users u ON sa.usere_id = u.usere_id
                                WHERE q.survey_id = :survey_id
                                GROUP BY u.users_age");
        $stmt->bindParam(':survey_id', $survey_id);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Calculate the total number of participants
        $participantCount = array_sum(array_column($results, 'selection_count'));

        // Combine the age and percentage data
        $agePercentageData = [];
        foreach ($results as $result) {
            $agePercentageData[] = [
                'users_age' => $result['users_age'],
                'percentage' => ($result['selection_count'] / $participantCount) * 100
            ];
        }

        return $agePercentageData;
    }

    public function ViewSurveyResultsByEduLevel($survey_id){
        // Fetch the survey details from the database
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT * FROM survey WHERE survey_id = :survey_id");
        $stmt->bindParam(':survey_id', $survey_id);
        $stmt->execute();
        $survey = $stmt->fetch(PDO::FETCH_ASSOC);

        // Fetch the education level, participant count, and selection ratio from the database
        $stmt = $conn->prepare("SELECT u.users_eduLevel, COUNT(DISTINCT sa.usere_id) AS participant_count, SUM(o.selection_ratio) AS total_selection_ratio
                                FROM survey_answers sa
                                INNER JOIN options o ON sa.option_id = o.option_id
                                INNER JOIN users u ON sa.usere_id = u.usere_id
                                WHERE sa.survey_id = :survey_id
                                GROUP BY u.users_eduLevel");
        $stmt->bindParam(':survey_id', $survey_id);
        $stmt->execute();
        $eduLevels = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Calculate the total number of participants
        $totalParticipants = array_sum(array_column($eduLevels, 'participant_count'));

        // Display the survey results by education level
        echo '<h3>Survey Results by Education Level:</h3>';

        if (empty($eduLevels)) {
            echo '<p>No survey results found.</p>';
        } else {
            echo '<table>';
            echo '<tr><th>Education Level</th><th>Number of Participants</th><th>Percentage</th></tr>';
            foreach ($eduLevels as $eduLevel) {
                echo '<tr>';
                echo '<td>' . $eduLevel['users_eduLevel'] . '</td>';
                echo '<td>' . $eduLevel['participant_count'] . '</td>';

                // Calculate the percentage of participants for the current education level
                $percentage = ($eduLevel['participant_count'] / $totalParticipants) * 100;
                echo '<td>' . $percentage . '%</td>';

                echo '</tr>';
            }
            echo '</table>';
        }
    }

    public function SurveyResultsByEduLevel($survey_id){
        // Fetch the survey details from the database
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT * FROM survey WHERE survey_id = :survey_id");
        $stmt->bindParam(':survey_id', $survey_id);
        $stmt->execute();
        $survey = $stmt->fetch(PDO::FETCH_ASSOC);

        // Fetch the education level, participant count, and selection ratio from the database
        $stmt = $conn->prepare("SELECT u.users_eduLevel, COUNT(DISTINCT sa.usere_id) AS participant_count, SUM(o.selection_ratio) AS total_selection_ratio
                                FROM survey_answers sa
                                INNER JOIN options o ON sa.option_id = o.option_id
                                INNER JOIN users u ON sa.usere_id = u.usere_id
                                WHERE sa.survey_id = :survey_id
                                GROUP BY u.users_eduLevel");
        $stmt->bindParam(':survey_id', $survey_id);
        $stmt->execute();
        $eduLevels = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Calculate the total number of participants
        $totalParticipants = array_sum(array_column($eduLevels, 'participant_count'));

        // Combine the education level and percentage data
        $eduLevelPercentageData = [];
        if (!empty($eduLevels)) {
            foreach ($eduLevels as $eduLevel) {
                $percentage = ($eduLevel['participant_count'] / $totalParticipants) * 100;
                $eduLevelPercentageData[] = [
                    'users_eduLevel' => $eduLevel['users_eduLevel'],
                    'percentage' => $percentage
                ];
            }
        }

        return $eduLevelPercentageData;
    }

    public function ViewSurveyResultsByCountry($survey_id){
        // Fetch the survey details from the database
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT * FROM survey WHERE survey_id = :survey_id");
        $stmt->bindParam(':survey_id', $survey_id);
        $stmt->execute();
        $survey = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Fetch the survey results by country
        $stmt = $conn->prepare("SELECT u.users_country, COUNT(DISTINCT sa.usere_id) AS participant_count
                                FROM survey_questions q
                                INNER JOIN options o ON q.question_id = o.question_id
                                INNER JOIN survey_answers sa ON sa.option_id = o.option_id
                                INNER JOIN users u ON sa.usere_id = u.usere_id
                                WHERE q.survey_id = :survey_id
                                GROUP BY u.users_country");
        $stmt->bindParam(':survey_id', $survey_id);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // Calculate the total participants
        $totalParticipants = array_sum(array_column($results, 'participant_count'));
    
        // Display the survey results
        echo '<h3>Survey Results by Country:</h3>';
    
        if (empty($results)) {
            echo '<p>No survey results found.</p>';
        } else {
            echo '<table>';
            echo '<tr><th>Country</th><th>Total Participants</th><th>Percentage</th></tr>';
            foreach ($results as $result) {
                echo '<tr>';
                echo '<td>' . $result['users_country'] . '</td>';
                echo '<td>' . $result['participant_count'] . '</td>';
    
                // Calculate the percentage of participants for the current country
                $percentage = ($result['participant_count'] / $totalParticipants) * 100;
                echo '<td>' . $percentage . '%</td>';
    
                echo '</tr>';
            }
            echo '</table>';
        }
        echo '</div>';
    }

    public function SurveyResultsByCountry($survey_id){
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT u.users_country, COUNT(DISTINCT sa.usere_id) AS participant_count, SUM(o.selection_ratio) AS total_selection_ratio
                                FROM survey_answers sa
                                INNER JOIN options o ON sa.option_id = o.option_id
                                INNER JOIN users u ON sa.usere_id = u.usere_id
                                WHERE sa.survey_id = :survey_id
                                GROUP BY u.users_country");
        $stmt->bindParam(':survey_id', $survey_id);
        $stmt->execute();
        $countryResults = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $totalParticipants = array_sum(array_column($countryResults, 'participant_count'));

        $countryPercentageData = [];
        foreach ($countryResults as $result) {
            $countryPercentageData[] = [
                'users_country' => $result['users_country'],
                'percentage' => ($result['participant_count'] / $totalParticipants) * 100
            ];
        }

        return $countryPercentageData;
    }
    
    public function viewSurveyResultsByGender($survey_id){
        // Fetch the survey details from the database
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT COUNT(DISTINCT u.usere_id) AS participant_count, u.users_gender
                                FROM survey_answers sa
                                INNER JOIN users u ON sa.usere_id = u.usere_id
                                WHERE sa.survey_id = :survey_id AND u.users_gender IS NOT NULL
                                GROUP BY u.users_gender");
        $stmt->bindParam(':survey_id', $survey_id);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Fetch the count of participants
        $participantCountQuery = "SELECT COUNT(DISTINCT usere_id) AS total_participant_count
                                FROM survey_answers
                                WHERE survey_id = :survey_id";
        $participantCountStmt = $conn->prepare($participantCountQuery);
        $participantCountStmt->bindParam(':survey_id', $survey_id);
        $participantCountStmt->execute();
        $totalParticipantCount = $participantCountStmt->fetchColumn();

        // Display the survey results
        echo '<h3>Survey Results by Gender:</h3>';

        if (empty($results)) {
            echo '<p>No survey results found.</p>';
        } else {
            echo '<table>';
            echo '<tr><th>Gender</th><th>Number of Participants</th><th>Percentage</th></tr>';
            foreach ($results as $result) {
                $percentage = ($result['participant_count'] / $totalParticipantCount) * 100;
                echo '<tr>';
                echo '<td>' . $result['users_gender'] . '</td>';
                echo '<td>' . $result['participant_count'] . '</td>';
                echo '<td>' . $percentage . '%</td>';
                echo '</tr>';
            }
            echo '</table>';
        }
    }

    public function SurveyResultsByGender($survey_id){
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT u.users_gender, COUNT(DISTINCT sa.usere_id) AS participant_count, SUM(o.selection_ratio) AS total_selection_ratio
                                FROM survey_answers sa
                                INNER JOIN options o ON sa.option_id = o.option_id
                                INNER JOIN users u ON sa.usere_id = u.usere_id
                                WHERE sa.survey_id = :survey_id
                                GROUP BY u.users_gender");
        $stmt->bindParam(':survey_id', $survey_id);
        $stmt->execute();
        $genderResults = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $totalParticipants = array_sum(array_column($genderResults, 'participant_count'));

        $genderPercentageData = [];
        foreach ($genderResults as $result) {
            $genderPercentageData[] = [
                'users_gender' => $result['users_gender'],
                'percentage' => ($result['participant_count'] / $totalParticipants) * 100
            ];
        }

        return $genderPercentageData;
    }

    public function DisplaySurveyResults() {
        // Call the ListOfSurvey function to display the survey form
        $this->ListOfSurvey();
    
        if (isset($_POST['submit']) && $_POST['survey_id'] != "") {
            $survey_id = $_POST['survey_id'];

            echo '
                <div class="button-container">
                    <form method="POST" action="results_survey.php">
                        <input type="hidden" name="survey_id" value="' . $survey_id . '">
                        <button type="submit" name="export">Export Results</button>
                    </form>
                    
                    <form method="POST" action="visualization.php">
                        <input type="hidden" name="survey_id" value="' . $survey_id . '">
                        <button type="submit" name="visualization">Visualization</button>
                    </form>
                </div>
            ';
    
            // Call the ViewSurveyResults function to display the survey results
            $this->ViewSurveyResults($survey_id);
            $this->ViewSurveyResultsByAge($survey_id);
            $this->ViewSurveyResultsByEduLevel($survey_id);
            $this->viewSurveyResultsByGender($survey_id);
            $this->ViewSurveyResultsByCountry($survey_id);
        }
    }

    public function exportSurveyResultsToExcel($survey_id){
        // Fetch the survey details from the database
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT * FROM survey WHERE survey_id = :survey_id");
        $stmt->bindParam(':survey_id', $survey_id);
        $stmt->execute();
        $survey = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Fetch the survey questions and their options from the database
        $stmt = $conn->prepare("SELECT q.questions_body, o.option_text, o.selection_ratio
                            FROM survey_questions q
                            INNER JOIN options o ON q.question_id = o.question_id
                            WHERE q.survey_id = :survey_id");
        $stmt->bindParam(':survey_id', $survey_id);
        $stmt->execute();
        $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // Fetch the count of participants
        $participantCountQuery = "SELECT COUNT(DISTINCT usere_id) AS participant_count FROM survey_answers WHERE survey_id = :survey_id";
        $participantCountStmt = $conn->prepare($participantCountQuery);
        $participantCountStmt->bindParam(':survey_id', $survey_id);
        $participantCountStmt->execute();
        $participantCount = $participantCountStmt->fetchColumn();
    
        // Set the TSV file path
        $filePath = 'survey_results.tsv';
    
        // Open the file in write mode
        $file = fopen($filePath, 'w');
    
        // Write the survey details to the file
        fwrite($file, "Survey Results:\t" . $survey['survey_name'] . "\n");
        fwrite($file, "Number of participants:\t" . $participantCount . "\n");
        fwrite($file, "\n"); // Empty row
    
        // Write the column headers to the file
        fwrite($file, "Question\tOption\tSelection Ratio\tSelection Percentage\n");
    
        // Write the survey results to the file
        foreach ($questions as $question) {
            // Calculate the selection percentage for the current option
            $selectionPercentage = ($participantCount !== 0) ? ($question['selection_ratio'] / $participantCount) * 100 : 0;
    
            // Format the row data and write it to the file
            $rowData = $question['questions_body'] . "\t" . $question['option_text'] . "\t" . $question['selection_ratio'] . "\t" . $selectionPercentage . '%';
            fwrite($file, $rowData . "\n");
        }
    
        // Close the file
        fclose($file);
    
        // Download the file
        if (file_exists($filePath)) {
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filePath));
            readfile($filePath);
            exit;
        } else {
            echo 'Error: Failed to create the TSV file.';
        }
    }

    public function downloadExcelFile(){
        if (isset($_POST['export'])) {

            // Get the survey ID from the form
            $surveyId = $_POST['survey_id'];

            // Call the exportSurveyResultsToExcel function and get the file path
            $filePath = $this->exportSurveyResultsToExcel($surveyId);

            // Check if the file path is not empty and the file exists
            if (!empty($filePath) && file_exists($filePath)) {
                // Set the appropriate headers for file download
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename=' . basename($filePath));
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($filePath));

                // Read and output the file contents
                readfile($filePath);
                exit;
            } else {
                echo "File not found.";
            }
        }
    }
    
    public function displaySurveysList() {
        
        $this->ListOfSurvey();

        // Check if the form is submitted
        if (isset($_POST['submit'])) {
            $surveyId = $_POST['survey_id'];
            $this->displaySurveyDetails($surveyId);
        }

    }

    public function displaySurveyDetails($surveyId) {
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT survey_name, description FROM survey WHERE survey_id = :survey_id");
        $stmt->bindParam(":survey_id", $surveyId);
        $stmt->execute();
        $surveyDetails = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (!$surveyDetails) {
            echo '<p>Survey not found.</p>';
            return;
        }
    
        echo '<h3>Survey Details</h3>';
        echo '<form method="POST" action="update_center.php">';
        echo '<input type="hidden" name="survey_id" value="' . $surveyId . '">';
    
        // Display survey name
        echo '<label for="survey_name">Survey Name:</label>';
        echo '<input type="text" name="survey_name" id="survey_name" value="' . $surveyDetails['survey_name'] . '">';
        echo "<br>";
        // Display survey description
        echo '<label for="description">Description:</label>';
        echo '<textarea name="description" id="description">' . $surveyDetails['description'] . '</textarea>';
        echo "<br>";
        echo "<br>";
        echo '<button type="submit" name="update_survey">Update Survey</button>';
        echo "<br>";
        echo "<br>";
        echo '<button type="submit" id="delete_survey" name="delete_survey">Delete Survey</button>';
        echo '</form>';
    }

    public function updateSurveyDetails($surveyId, $surveyName, $description) {
        $connDB = $this->connect();
        $stmt = $connDB->prepare("UPDATE survey SET survey_name = :survey_name, description = :description WHERE survey_id = :survey_id");
        $stmt->bindParam(":survey_name", $surveyName);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":survey_id", $surveyId);
        $stmt->execute();
    
        echo '<p>Survey details updated successfully.</p>';
    }
    
    public function deleteSurvey($surveyId){
        $connDB = $this->connect();

        // Delete survey answers
        $stmt = $connDB->prepare("DELETE FROM survey_answers WHERE option_id IN (SELECT option_id FROM options WHERE question_id IN (SELECT question_id FROM survey_questions WHERE survey_id = :survey_id))");
        $stmt->bindParam(":survey_id", $surveyId);
        $stmt->execute();

        // Delete survey options
        $stmt = $connDB->prepare("DELETE FROM options WHERE question_id IN (SELECT question_id FROM survey_questions WHERE survey_id = :survey_id)");
        $stmt->bindParam(":survey_id", $surveyId);
        $stmt->execute();

        // Delete survey questions
        $stmt = $connDB->prepare("DELETE FROM survey_questions WHERE survey_id = :survey_id");
        $stmt->bindParam(":survey_id", $surveyId);
        $stmt->execute();

        // Delete survey
        $stmt = $connDB->prepare("DELETE FROM survey WHERE survey_id = :survey_id");
        $stmt->bindParam(":survey_id", $surveyId);
        $stmt->execute();
    
        echo "<p>Survey and associated data deleted successfully.</p>";
    }
}