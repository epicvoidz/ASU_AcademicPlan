<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

// Database connection settings
$servername = "localhost";
$username   = "root";
$password   = "CS4522025"; // Use your actual MySQL password
$dbname     = "catalog";

try {
    // Establish PDO connection
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", 
                   $username, 
                   $password,
                   [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    // Handle URL parameters
    $allCourses = isset($_GET['allCourses']);
    $semester   = isset($_GET['semester']) ? $_GET['semester'] : 'Sum_Odd';
    $selectedCourses = isset($_GET['selectedCourses']) ? explode(',', $_GET['selectedCourses']) : [];

    // Define allowed courses
    $allowed_courses = [
        'CS305', 'CS309', 'CS317', 'CS310', 'CS318', 
        'CS340', 'CS372', 'ITE327', 'CS414', 'CS417', 
        'CS451', 'CS452', 'CS415', 'CS472'
    ];

    $results = [];

    // Ensure placeholders count matches the number of parameters
    if (!empty($allowed_courses)) {
        $placeholders = implode(',', array_fill(0, count($allowed_courses), '?'));
    } else {
        echo json_encode(["error" => "No allowed courses found."]);
        exit;
    }

    // If allCourses parameter is set, fetch all courses
    if ($allCourses) {
        $query = "SELECT * FROM cs_ite_catalog WHERE courseNum IN ($placeholders) OR courseNum LIKE ?";
        
        // Prepare and execute the statement, appending 'CS309%' separately
        $stmt = $pdo->prepare($query);
        $params = array_merge($allowed_courses, ['CS309%']);
        $stmt->execute($params); 

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($rows as $row) {
            $courseNum = trim($row['courseNum']);

            // Normalize variations of CS309 to "CS309"
            if (strpos($courseNum, 'CS309') !== false) {
                $courseNum = 'CS309';
            }

            // Use the semester column for classType if available; otherwise, default to "DL"
            $classType = !empty($row[$semester]) ? $row[$semester] : 'DL';

            $results[] = [
                'courseNum'  => $courseNum,
                'courseName' => $row['courseName'],
                'classType'  => $classType
            ];
        }

        echo json_encode($results);
        exit;
    }

    // Detailed logic: prerequisites and semester checking

    // Prerequisite definitions
    $prerequisites = [
        "CS318" => ["CS317"],
        "CS372" => ["CS318"],
        "ITE327" => ["CS317"],
        "CS340" => ["CS309", "CS318"],
        "CS414" => ["CS372"],
        "CS417" => ["CS372"],
        "CS451" => ["CS372"],
        "CS472" => ["CS372"],
        "CS415" => ["CS340", "CS372"],
        "CS452" => ["CS414", "CS415", "CS451", "CS472"]
    ];

    // Semester ordering for planning
    $semesterOrder = ["Sum_Odd", "Fall_Odd", "Spr_Even", "Sum_Even", "Fall_Even", "Spr_Odd"];
    function getNextSemester($current) {
        global $semesterOrder;
        $index = array_search($current, $semesterOrder);
        return ($index !== false && $index + 1 < count($semesterOrder)) ? $semesterOrder[$index + 1] : null;
    }

    // Fetch courses with detailed logic using the same query as above
    $query = "SELECT * FROM cs_ite_catalog WHERE courseNum IN ($placeholders) OR courseNum LIKE ?";
$params = array_merge($allowed_courses, ['CS309%']);

error_log("DEBUG SQL QUERY: " . $query);
error_log("DEBUG PARAMETERS: " . json_encode($params));

$stmt = $pdo->prepare($query);
$stmt->execute($params);

$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);


    foreach ($rows as $row) {
        $courseNum = trim($row['courseNum']);

        // Normalize any variation of CS309 to "CS309"
        if (strpos($courseNum, 'CS309') !== false) {
            $courseNum = 'CS309';
        }

        // Skip courses not in allowed_courses (except CS309)
        if (!in_array($courseNum, $allowed_courses) && $courseNum !== 'CS309') {
            continue;
        }

        // Check prerequisites if defined
        if (isset($prerequisites[$courseNum])) {
            foreach ($prerequisites[$courseNum] as $needed) {
                if (!in_array($needed, $selectedCourses)) {
                    continue 2;
                }
            }
        }

        // Check availability in the selected semester
        if (!empty($row[$semester]) && strtolower($row[$semester]) !== 'null') {
            if ($courseNum === 'CS452' && strpos($semester, 'Sum_') === 0 && strtoupper(trim($row[$semester])) !== 'BL') {
                // Skip CS452 in summer unless its class type is BL
            } else {
                $results[] = [
                    'courseNum'  => $courseNum,
                    'courseName' => $row['courseName'],
                    'classType'  => $row[$semester]
                ];
                continue;
            }
        }

        // If not available in the current semester, check the next available semester
        $nextSemester = getNextSemester($semester);
        while ($nextSemester) {
            if (!empty($row[$nextSemester]) && strtolower($row[$nextSemester]) !== 'null') {
                $results[] = [
                    'courseNum'  => $courseNum,
                    'courseName' => $row['courseName'],
                    'classType'  => $row[$nextSemester]
                ];
                break;
            }
            $nextSemester = getNextSemester($nextSemester);
        }
    }

    // Return the final results as JSON
    echo json_encode($results);

} catch (PDOException $e) {
    echo json_encode(["error" => "Connection failed: " . $e->getMessage()]);
}
?>
