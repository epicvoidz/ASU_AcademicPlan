<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

// List of allowed course codes
$allowed_courses = [
    'CS307', 'CS309', 'CS310', 'CS317', 'CS318', 'CS372',
    'CS380', 'CS385', 'MA308', 'ITE313', 'ITE315',
    'ITE321', 'ITE327', 'ITE350', 'ITE441', 'ITE450',
    'ITE451', 'ITE452', 'UNV300', 'UNV400', 'Elective1', 
    'Elective2', 'Elective3', 'Elective4', 'Elective5',
];
$csvData = []; 

$mysqli = new mysqli("localhost", "root", "", "cs_ite_ma_db", 3307);

if ($mysqli->connect_error) {
    // fallback to CSV
    if (($handle = fopen("cs_ite_ma_courses.csv", "r")) !== FALSE) {
        $headers = fgetcsv($handle); 
        while (($data = fgetcsv($handle)) !== FALSE) {
            $csvData[] = array_combine($headers, $data);
        }
        fclose($handle);
    } else {
        echo json_encode(['error' => 'Database connection failed and CSV fallback file not found.']);
        exit;
    }
} else {
    $query = "SELECT * FROM cs_ite_ma_courses";
    $result = $mysqli->query($query);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $csvData[] = $row;
        }
    } else {
        if (($handle = fopen("cs_ite_ma_courses.csv", "r")) !== FALSE) {
            $headers = fgetcsv($handle); 
            while (($data = fgetcsv($handle)) !== FALSE) {
                $csvData[] = array_combine($headers, $data);
            }
            fclose($handle);
        } else {
            echo json_encode(['error' => 'Query failed and CSV fallback file not found.']);
            exit;
        }
    }

    $mysqli->close();
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
?>
