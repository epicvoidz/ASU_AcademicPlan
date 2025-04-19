<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

$allowed_courses = [
    'CS307', 'CS309', 'CS310', 'CS317', 'CS318', 'CS372',
    'CS380', 'CS385', 'MA308', 'ITE313', 'ITE315',
    'ITE321', 'ITE327', 'ITE350', 'ITE441', 'ITE450',
    'ITE451', 'ITE452', 'UNV300', 'UNV400', 'Elective1', 
    'Elective2', 'Elective3', 'Elective4', 'Elective5',
];

$allCourses = isset($_GET['allCourses']);  
$semester = isset($_GET['semester']) ? $_GET['semester'] : 'Sum_Odd';
$selectedCourses = isset($_GET['selectedCourses']) ? explode(',', $_GET['selectedCourses']) : [];

$results = [];
$csvData = [];
$useCSV = false;

// Try connecting to DB with failsafe
try {
    $mysqli = new mysqli("localhost", "root", "", "cs_ite_ma_db", 3307);
    if ($mysqli->connect_errno) {
        $useCSV = true;
    } else {
        $query = "SELECT * FROM cs_ite_ma_courses";
        $result = $mysqli->query($query);
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $csvData[] = $row;
            }
        } else {
            $useCSV = true;
        }
        $mysqli->close();
    }
} catch (Exception $e) {
    $useCSV = true;
}

// Fallback to CSV
if ($useCSV || count($csvData) === 0) {
    $dataFile = 'CS_ITE_MA_Courses.csv';

    if (!file_exists($dataFile)) {
        echo json_encode(['error' => 'CSV file not found.']);
        exit;
    }

    $rawData = array_map('str_getcsv', file($dataFile));
    array_shift($rawData);
    $headers = array_shift($rawData); 
    $headers[0] = preg_replace('/^\xEF\xBB\xBF/', '', $headers[0]); 
    $csvData = $rawData;
    $headers[0] = preg_replace('/^\xEF\xBB\xBF/', '', $headers[0]);

    if ($allCourses) {
        foreach ($csvData as $row) {
            $rowData = array_combine($headers, $row);
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
}

// If DB worked and allCourses is set
if ($allCourses) {
    foreach ($csvData as $rowData) {
        if (!isset($rowData['courseNum'])) continue;

        $courseNum = trim(explode("/", $rowData['courseNum'])[0]);
        if (!in_array($courseNum, $allowed_courses)) continue;

        $classType = '';
        if (!empty($rowData['classType'])) {
            $classType = $rowData['classType'];
        } elseif (!empty($rowData[$semester])) {
            $classType = $rowData[$semester];
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
?>
