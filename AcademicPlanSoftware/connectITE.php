
<?php 
// Enable error reporting for development
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set response header to JSON
header('Content-Type: application/json');

// UNUSED: Full semester ordering logic from earlier version
/*
$selectedSemester = isset($_GET['semester']) ? $_GET['semester'] : 'SumOdd';

if ($selectedSemester == 'SumOdd') {
    $semesterOrder = ["Sum_Odd", "Fall_Odd", "Spr_Even", "Sum_Even", "Fall_Even", "Spr_Odd"];
} elseif ($selectedSemester == 'FallOdd') {
    $semesterOrder = ["Fall_Odd", "Spr_Even", "Sum_Even", "Fall_Even", "Spr_Odd", "Sum_Odd"];
} elseif ($selectedSemester == 'SprEven') {
    $semesterOrder = ["Spr_Even", "Sum_Even", "Fall_Even", "Spr_Odd", "Sum_Odd", "Fall_Odd"];
} elseif ($selectedSemester == 'SumEven') {
    $semesterOrder = ["Sum_Even", "Fall_Even", "Spr_Odd", "Sum_Odd", "Fall_Odd", "Spr_Even"];
}
*/

// UNUSED fallback semester order
/*
if (!isset($semesterOrder)) {
    $semesterOrder = ["Sum_Odd", "Fall_Odd", "Spr_Even", "Sum_Even", "Fall_Even", "Spr_Odd"];
}
*/

// UNUSED: selectedCourses from GET — not used in current frontend
/*
$selectedCourses = isset($_GET['selectedCourses']) ? explode(',', $_GET['selectedCourses']) : [];
*/

// Connect to MySQL database
$mysqli = new mysqli("localhost", "root", "", "cs_ite_ma_db", 3307);
if ($mysqli->connect_error) {
    echo json_encode(['error' => 'Database connection failed: ' . $mysqli->connect_error]);
    exit;
}

// Query all course rows
$query = "SELECT * FROM cs_ite_ma_courses";
$result = $mysqli->query($query);
if (!$result) {
    echo json_encode(['error' => 'Query failed: ' . $mysqli->error]);
    exit;
}

// Load course data into an array
$csvData = [];
while ($row = $result->fetch_assoc()) {
    $csvData[] = $row;
}

// List of allowed course codes
$allowed_courses = [
    'CS307', 'CS309', 'CS310', 'CS317', 'CS318', 'CS372',
    'CS380', 'CS385', 'MA308', 'ITE313', 'ITE315',
    'ITE321', 'ITE327', 'ITE350', 'ITE441', 'ITE450',
    'ITE451', 'ITE452', 'UNV300', 'UNV400', 'Elective1', 
    'Elective2', 'Elective3', 'Elective4', 'Elective5',
];

// Handle the AJAX request from the frontend
if (isset($_GET['allCourses'])) {
    $semester = $_GET['semester'] ?? 'Sum_Odd';
    $results = [];

    foreach ($csvData as $rowData) {
        if (!isset($rowData['courseNum'])) continue;

        $courseNum = trim(explode("/", $rowData['courseNum'])[0]);
        if (!in_array($courseNum, $allowed_courses)) continue;

        $classType = '';
        if (!empty($rowData['classType'])) {
            $classType = $rowData['classType'];
        } elseif (!empty($rowData['Sum_Odd'])) {
            $classType = $rowData['Sum_Odd'];
        } else {
            $classType = 'DL';
        }

        $results[] = [
            'courseNum'  => $courseNum,
            'courseName' => $rowData['courseName'],
            'classType'  => $classType,
            'Sum_Odd'    => $rowData['Sum_Odd'],
            'Fall_Odd'   => $rowData['Fall_Odd'],
            'Spr_Even'   => $rowData['Spr_Even'],
            'Sum_Even'   => $rowData['Sum_Even'],
            'Fall_Even'  => $rowData['Fall_Even'],
            'Spr_Odd'    => $rowData['Spr_Odd']
        ];
    }

    echo json_encode($results);
    exit;
}

// UNUSED: prerequisite checking logic (handled client-side)
/*
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

function getNextSemester($current) {
    global $semesterOrder;
    $index = array_search($current, $semesterOrder);
    if ($index !== false && $index + 1 < count($semesterOrder)) {
        return $semesterOrder[$index + 1];
    }

    if (strpos($current, '_') === false) return null;
    list($season, $indicator) = explode('_', $current);
    $seasons = ["Sum", "Fall", "Spr"];
    $currentSeasonIndex = array_search($season, $seasons);
    if ($currentSeasonIndex === false) return null;

    if ($season === "Spr") {
        $nextSeason = "Sum";
        $nextIndicator = ($indicator === "Odd") ? "Even" : "Odd";
    } else {
        $nextSeason = $seasons[$currentSeasonIndex + 1];
        $nextIndicator = $indicator;
    }
    return $nextSeason . "_" . $nextIndicator;
}

foreach ($csvData as $rowData) {
    if (!isset($rowData['courseNum'])) continue;

    $courseNum = trim(explode("/", $rowData['courseNum'])[0]);

    if (!in_array($courseNum, $allowed_courses)) continue;

    if (isset($prerequisites[$courseNum])) {
        foreach ($prerequisites[$courseNum] as $needed) {
            if (!in_array($needed, $selectedCourses)) {
                continue 2;
            }
        }
    }

    if (isset($rowData[$semester])) {
        if ($courseNum === 'CS452' 
            && strpos($semester, 'Sum_') === 0 
            && strtoupper(trim($rowData[$semester])) !== 'BL') {
            continue;
        }

        $results[] = [
            'courseNum'  => $courseNum,
            'courseName' => $rowData['courseName'],
            'classType'  => $rowData[$semester]
        ];
    } else {
        $results[] = [
            'courseNum'  => $courseNum,
            'courseName' => $rowData['courseName'],
            'classType'  => ''
        ];
    }
}

echo json_encode($results);
*/
?>
