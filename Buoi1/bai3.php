// xử lý danh sách sinh viên

<?php

// danh sách sinh viên
$students = [
    [
        "name" => "Nguyen Van An",
        "age" => 20,
        "score" => 8.5
    ],
    [
        "name" => "Tran Thi Binh",
        "age" => 21,
        "score" => 6.5
    ],
    [
        "name" => "Le Van Cuong",
        "age" => 19,
        "score" => 4.5
    ],
    [
        "name" => "Pham Thi Dung",
        "age" => 20,
        "score" => 7.5
    ]
];

function findBestStudent($students){
    if (empty($students)) return null;
    $best = $students[0];
    foreach($students as $student){
        if ($student["score"] > $best["score"]){
            $best = $student;
        }
    }
    return $best;
}

function findWorstStudent($students) {
    if (empty($students)) return null;
    $worst = $students[0];
    foreach ($students as $student) {
        if ($student["score"] < $worst["score"]) {
            $worst = $student;
        }
    }
    return $worst;
}

function countPassedStudents($students) {
    $count = 0;
    foreach ($students as $student) {
        if ($student["score"] >= 5) {
            $count++;
        }
    }
    return $count;
}

function findStudentByName($students, $name) {
    $results = [];
    foreach ($students as $student) {
        // Sử dụng stripos để tìm kiếm không phân biệt hoa thường và tìm gần đúng
        if (stripos($student["name"], $name) !== false) {
            $results[] = $student;
        }
    }
    return $results;
}

$best = findBestStudent($students);
echo "Sinh viên điểm cao nhất: {$best['name']} ({$best['score']}) \n";

$worst = findWorstStudent($students);
echo "Sinh viên điểm thấp nhất: {$worst['name']} ({$worst['score']}) \n";

$passedCount = countPassedStudents($students);
echo "Số sinh viên đạt: $passedCount / " . count($students) . " \n";

$searchName = "Cuong";
$foundStudents = findStudentByName($students, $searchName);
echo "Kết quả tìm kiếm với từ khóa '{$searchName}': \n";
foreach ($foundStudents as $s) {
    echo "- {$s['name']} (Điểm: {$s['score']}) \n";
}
?>