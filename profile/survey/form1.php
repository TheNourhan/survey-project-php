
        <?php 
        session_start();
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>programming languages</title>
            <link rel="stylesheet" href="form.css">
            </head>
            <body>

                <?php
                    include "../../login-system/classes/conn.php";
                    include "../user/display_survey.php";

                    $url = $_SERVER['PHP_SELF'];

                    $parsedUrl = parse_url($url);

                    if (isset($parsedUrl['path'])) {
                        $path = $parsedUrl['path'];
                        $pathSegments = explode('/', $path);

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
                    $_SESSION['numOfSurvey'] = $num-1;


                    $surveyDisplay = new SurveyDisplay();
                    $surveyDisplay->displaySurvey(0);

                    
                ?>
        </body>
        </html>
        