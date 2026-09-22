<?php
class Student{
    public $name;
    public $age;
    public $score;

    public function __construct($name, $age, $score){
        $this->name = $name;
        $this->age = $age;
        $this->score = $score;
    }

    public function getRank() {
        if ($this->score >= 8) {
            return "Giỏi";
        } elseif ($this->score >= 6.5) {
            return "Khá";
        } elseif ($this->score >= 5) {
            return "Trung bình";
        } else {
            return "Yếu";
        }
    }

    public function isPassed() {
        return $this->score >= 5;
    }

    // Phương thức hiển thị thông tin sinh viên
    public function display() {
        $rank = $this->getRank();
        $status = $this->isPassed() ? "Đạt" : "Trượt";
        echo "Họ tên: {$this->name} | Tuổi: {$this->age} | Điểm: {$this->score} | Xếp loại: $rank | Trạng thái: $status \n";
    }
}

$studentList = [
    new Student("Nguyen Van An", 20, 8.5),
    new Student("Tran Thi Binh", 21, 6.5),
    new Student("Le Van Cuong", 19, 4.5),
    new Student("Pham Thi Dung", 20, 7.5)
];

echo "Danh sách sinh viên: \n";
foreach ($studentList as $student) {
    $student->display();
}

$bestStudent = $studentList[0];
foreach ($studentList as $student) {
    if ($student->score > $bestStudent->score) {
        $bestStudent = $student;
    }
}
echo "Sinh viên có điểm cao nhất: {$bestStudent->name} ({$bestStudent->score}) \n";

$passedCount = 0;
foreach ($studentList as $student) {
    if ($student->isPassed()) {
        $passedCount++;
    }
}
echo "Số sinh viên đạt: $passedCount \n";

$totalScore = 0;
foreach ($studentList as $student) {
    $totalScore += $student->score;
}
$classAverage = count($studentList) > 0 ? $totalScore / count($studentList) : 0;
echo "Điểm trung bình của lớp: " . number_format($classAverage, 2) . " \n";
?>