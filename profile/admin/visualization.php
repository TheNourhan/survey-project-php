<?php
    session_start();
    if (!isset($_SESSION["admin"])) {
        header("location: /survey/index.php?error=none");
        exit();
    }


if (isset($_POST['visualization'])) {
    $surveyId = $_POST['survey_id'];
    
    include '../../login-system/classes/conn.php';
    require_once 'control-panal.php';

    $a = new ControlPanal();

    // Fetch survey results by age
    $ageResults = $a->SurveyResultsByAge($surveyId);
    $ageData = json_encode($ageResults);

    // Fetch survey results by education level
    $eduLevelResults = $a->SurveyResultsByEduLevel($surveyId);
    $eduLevelData = json_encode($eduLevelResults);

    // Fetch survey results by country
    $countryResults = $a->SurveyResultsByCountry($surveyId);
    $countryData = json_encode($countryResults);

    // Fetch survey results by gender
    $genderResults = $a->SurveyResultsByGender($surveyId);
    $genderData = json_encode($genderResults);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Visualization</title>
    <link rel="stylesheet" href="../../style.css"/>
</head>
<body>

    <h1>Visualization survey results</h1>
    <div id="agePlot" style="width: 100%; max-width: 700px;"></div>
    <div id="eduLevelPlot" style="width: 100%; max-width: 700px;"></div>
    <div id="countryPlot" style="width: 100%; max-width: 700px;"></div>
    <div id="genderPlot" style="width: 100%; max-width: 700px;"></div>

    
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <script>
        // Age plot
        var ageData = JSON.parse('<?php echo $ageData; ?>');

        var agePlotData = [{
            x: ageData.map(data => data.users_age),
            y: ageData.map(data => data.percentage),
            type: 'bar'
        }];

        var ageLayout = {
            title: 'Survey Results by Age',
            xaxis: {
                title: 'Age'
            },
            yaxis: {
                title: 'Percentage'
            }
        };

        Plotly.newPlot('agePlot', agePlotData, ageLayout);

        // Education level plot
        var eduLevelData = JSON.parse('<?php echo $eduLevelData; ?>');

        var eduLevelPlotData = [{
            x: eduLevelData.map(data => data.users_eduLevel),
            y: eduLevelData.map(data => data.percentage),
            type: 'bar'
        }];

        var eduLevelLayout = {
            title: 'Survey Results by Education Level',
            xaxis: {
                title: 'Education Level'
            },
            yaxis: {
                title: 'Percentage'
            }
        };

        Plotly.newPlot('eduLevelPlot', eduLevelPlotData, eduLevelLayout);

        // Country plot
        var countryData = JSON.parse('<?php echo $countryData; ?>');

        var countryPlotData = [{
            x: countryData.map(data => data.users_country),
            y: countryData.map(data => data.percentage),
            type: 'bar'
        }];

        var countryLayout = {
            title: 'Survey Results by Country',
            xaxis: {
                title: 'Country'
            },
            yaxis: {
                title: 'Percentage'
            }
        };

        Plotly.newPlot('countryPlot', countryPlotData, countryLayout);

        // Gender plot
        var genderData = JSON.parse('<?php echo $genderData; ?>');

        var genderPlotData = [{
            x: genderData.map(data => data.users_gender),
            y: genderData.map(data => data.percentage),
            type: 'bar'
        }];

        var genderLayout = {
            title: 'Survey Results by Gender',
            xaxis: {
                title: 'Gender'
            },
            yaxis: {
                title: 'Percentage'
            }
        };

        Plotly.newPlot('genderPlot', genderPlotData, genderLayout);
    </script>
</body>
</html>
