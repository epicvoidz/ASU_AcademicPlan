<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

$allowed_courses = [
    'CS309', 'CS317', 'CS310', 'CS318', 
    'CS340', 'CS372', 'ITE327', 'CS414', 'CS417', 
    'CS451', 'CS452', 'CS415', 'CS472', 'ITE420', 'MA308', 'MA310', 'MA321', 'MA331', 'ITE305',
    'Elective1', 'Elective2', 'Elective3', 'Elective4', 'Elective5', 'UNV300', 'UNV400'
];

$csvData = [];
$useCSV = false;

$mysqli = new mysqli("localhost", "root", "", "cs_ite_ma_db", 3307);

if ($mysqli->connect_error) {
    $useCSV = true;
} else {
    $query = "SELECT * FROM cs_ite_ma_courses";
    $result = $mysqli->query($query);
    
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $csvData[] = $row;
        }
    } else {
        $useCSV = true;
    }
    $mysqli->close();
}

// Load CSV if fallback needed
if ($useCSV) {
    $dataFile = "cs_ite_ma_courses.csv";
    if (file_exists($dataFile)) {
        $rawData = array_map('str_getcsv', file($dataFile));
        array_shift($rawData); 
        $headers = array_shift($rawData); 
        $headers[0] = preg_replace('/^\xEF\xBB\xBF/', '', $headers[0]); 
        foreach ($rawData as $data) {
            if (count($data) === count($headers)) {
                $csvData[] = array_combine($headers, $data);
            }
        }
    } else {
        echo json_encode(['error' => 'Database failed and CSV file not found.']);
        exit;
    }
}

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
        } elseif (!empty($rowData[$semester])) {
            $classType = $rowData[$semester];
        } else {
            $classType = 'DL';
        }

        $results[] = [
            'courseNum'  => $courseNum,
            'courseName' => $rowData['courseName'],
            'classType'  => $classType,
            'Sum_Odd'    => $rowData['Sum_Odd'] ?? '',
            'Fall_Odd'   => $rowData['Fall_Odd'] ?? '',
            'Spr_Even'   => $rowData['Spr_Even'] ?? '',
            'Sum_Even'   => $rowData['Sum_Even'] ?? '',
            'Fall_Even'  => $rowData['Fall_Even'] ?? '',
            'Spr_Odd'    => $rowData['Spr_Odd'] ?? ''
        ];
    }

    echo json_encode($results);
    exit;
}
?>
