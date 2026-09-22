// bài 1: làm quen biến, mảng, vòng lặp
<?php
// danh sách sinh viên
$student = [
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

$totalScore = 0;
$count = count($student);

foreach ($student as $s){
    echo "Họ tên: " . $s["name"] . " - Tuổi: " . $s["age"] . " - Điểm: " . $s["score"] . "\n";
    $totalScore += $s["score"];
}

// tính và in điểm trung bình
if ($count > 0) {
    $averageScore = $totalScore / $count;
    echo "\n>Điểm trung bình của lớp: </> " . number_format($averageScore, 2) . "\n";

}

?>