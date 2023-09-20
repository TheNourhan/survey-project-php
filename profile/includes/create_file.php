<?php
//include '../../login-system/classes/conn.php';

class CreatFile extends DB_connect{

    public function numOfSurveyRow(){
        $conn = $this->connect();

        // Retrieve the number of rows in the "survey" table
        $sql = 'SELECT COUNT(*) AS row_count FROM survey';
        $stmt = $conn->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $rowCount = $result['row_count'];

        $conn = null;

        return $rowCount;
    }

    public function createFile($surveyTitle, $surveyDescription){
        $num = $this->numOfSurveyRow();

        $connDB = $this->connect();

        $stmt = $connDB->prepare("SELECT survey_id FROM survey WHERE survey_name = :survey_name");
        $stmt->bindParam(":survey_name", $surveyTitle);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        echo "pre";
        var_dump($result);
        echo "pre";
        // Generate the file name
        $fileName = 'form' . $num . '.php'; 

        // Set the survey folder path
        $surveyFolder = '../survey/';
        
        // Create the file and write content to it
        $fileContent = '
        <?php 
        session_start();
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>'. $surveyTitle .'</title>
            <link rel="stylesheet" href="form.css">
            </head>
            <body>

                <?php
                    include "../../login-system/classes/conn.php";
                    include "../user/display_survey.php";

                    $url = $_SERVER['."'PHP_SELF'".'];

                    $parsedUrl = parse_url($url);

                    if (isset($parsedUrl['."'path'".'])) {
                        $path = $parsedUrl['."'path'".'];
                        $pathSegments = explode('."'/'".', $path);

                        // Remove empty segments (e.g., leading and trailing slashes)
                        $pathSegments = array_filter($pathSegments);

                        // Loop through the path segments
                        foreach ($pathSegments as $segment) {
                            // Check if the segment has at least 5 characters
                            if (strlen($segment) >= 5) {
                                $num = $segment[4];
                            }
                        }
                    }
                    $_SESSION['."'numOfSurvey'".'] = $num-1;


                    $surveyDisplay = new SurveyDisplay();
                    $surveyDisplay->displaySurvey('. ($num-1) .');
                ?>
        </body>
        </html>
        ';
        file_put_contents($surveyFolder . $fileName, $fileContent);

        $surveyFolder = './survey/';

        // Update user-profile.html with the link to the new survey form
        $profileFileName = '../user-profile.php';
        $profileContent = file_get_contents($profileFileName);
        $surveyLink = $surveyFolder . $fileName;
        $updatedContent = str_replace('</here>',"
            <div id=\"$result[0]\">
                <li>
                    <a href=\"$surveyLink\">$surveyTitle</a>
                    <p>$surveyDescription</p>
                </li>
            </div>
            </here>", $profileContent);
        file_put_contents($profileFileName, $updatedContent);
        $surveyFolder = '../survey/';
        $surveyLink = $surveyFolder . $fileName;

        // Redirect the user to the new survey form
        header("Location: $surveyLink");
        exit;
    }
}
