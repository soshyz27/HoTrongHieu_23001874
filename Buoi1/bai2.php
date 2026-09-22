// tách hàm

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

function calculateAverageScore($students){
    $total = 0;
    $count = count($students);
    if ($count == 0) return 0;

    foreach ($students as $student){
        $total += $student["score"];

    }
    return $total / $count;
}

function getRank($score){
    if ($score >= 8){
        return "Giỏi";
    } elseif (($score >= 6.5) ){
        return "Khá";
    }elseif ($score >= 5){
        return "Trung bình";
    } else{
        return "Yếu";
    }
}

function displayStudent($student){
    $rank = getRank($student["score"]);
    echo "Họ tên: {$student['name']} | Tuổi: {$student['age']} | Điểm: {$student['score']} | Xếp Loại: $rank \n" ;
}

foreach ($students as $student){
    displayStudent($student);
}

$avg = calculateAverageScore($students);
echo "\n Điểm trung bình chung \n" . number_format($avg, 2) . "\n";
?>
