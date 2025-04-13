<?php
require 'connect.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['selectedCourses'])) {
        $selectedCourses = $_POST['selectedCourses'];

        $semesters = array_chunk($selectedCourses, 5); 

        $csvCourses = [];
        if (file_exists($csvFilePath)) {
            if (($handle = fopen($csvFilePath, 'r')) !== false) {
                while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                    if (!empty($row[0]) && !in_array($row[0], $selectedCourses) && strtolower($row[0]) !== 'coursenum') {
                        $csvCourses[] = $row[0]; 
                    }
                }
                fclose($handle);
            }
        }

        while (count($semesters) < 6 && !empty($csvCourses)) {
            $semesters[] = array_splice($csvCourses, 0, 5); 
        }

        echo "<!DOCTYPE html>";
        echo "<html lang='en'>";
        echo "<head>";
        echo "  <meta charset='UTF-8' />";
        echo "  <title>Your 6-Semester Course Plan</title>";
        echo "  <link href='https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap' rel='stylesheet' />";
        echo "  <style>
                    body {
                        font-family: 'Roboto', Arial, sans-serif;
                        margin: 0; 
                        padding: 20px;
                        background: #f9f9f9;
                        text-align: center;
                    }
                    .header {
                        padding: 10px;
                        text-align: center;
                        background: #092a6d;
                        color: white;
                    }
                    .header h1 {
                        font-size: 3em;
                        margin: 0.5em 0;
                    }
                    .main {
                        max-width: 1200px;
                        margin: 0 auto;
                        padding: 20px;
                        text-align: left;
                    }
                    .semester {
                        background: white;
                        border-radius: 5px;
                        padding: 20px;
                        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
                        margin-bottom: 20px;
                    }
                    .semester h2 {
                        margin-top: 0;
                        color: #092a6d;
                    }
                    .course-line {
                        margin: 8px 0;
                        font-size: 1.1em;
                    }
                    .footer {
                        text-align: center;
                        padding: 20px;
                        background: #f2f2f2;
                        margin-top: 20px;
                    }
                </style>";
        echo "</head>";
        echo "<body>";
        echo "  <header class='header'>";
        echo "      <h1>Your 6-Semester Course Plan</h1>";
        echo "  </header>";
        echo "  <main class='main'>";
        echo "      <p>The courses you selected are scheduled below, with <strong>5 per semester</strong>. Additional courses are auto-filled from available courses.</p>";

        $semesterNumber = 1;
        foreach ($semesters as $semesterCourses) {
            echo "<div class='semester'>";
            echo "  <h2>Semester $semesterNumber</h2>";
            foreach ($semesterCourses as $course) {
                echo "  <div class='course-line'>" . htmlspecialchars($course) . "</div>";
            }
            echo "</div>";
            $semesterNumber++;
        }

        echo "  </main>";
        echo "  <footer class='footer'>";
        echo "      <p>&copy; 2025 Computer Science Department</p>";
        echo "  </footer>";
        echo "</body></html>";
    } else {
        echo "<p>No courses were selected. <a href='CSCourseList_SumOddStart.html'>Go back</a> and choose some courses.</p>";
    }
} else {
    echo "<p>Invalid request. Please use the form from the previous page.</p>";
}
?>
