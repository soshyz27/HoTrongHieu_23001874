// quản lý vé xem phim

<?php

class Movie{
    public $id;
    public $title;
    public $price;
    public $totalSeats;
    public $availableSeats;

    public function __construct($id, $title, $price, $totalSeats){
        $this->id = $id;
        $this->title = $title;
        $this->price = $price;
        $this->totalSeats = $totalSeats;
        $this->availableSeats = $totalSeats;
    }

    public function bookTicket($quantity){
        if($quantity <= 0){
            echo "Số vé phải > 0! \n";
            return false;
        }elseif($quantity > $this->availableSeats){
            echo "Số vé lớn hơn số ghế còn lại! \n";
            return false;
        }else{
            $this->availableSeats -= $quantity;
            echo "Đặt vé thành công! \n";
            return true;
        }

    }

    public function cancelTicket($quantity){
        if($quantity <= 0){
            echo "Số vé phải > 0! \n";
            return false;
        }else if($this->getSoldSeats() < $quantity){
            echo "Số vé hủy lớn hơn số vé đã đặt! \n";
            return false;
        }else{
            $this->availableSeats += $quantity;
            echo "Hủy vé thành công! \n";
            return true;
        }
    }

    public function getSoldSeats(){
        return $this->totalSeats - $this->availableSeats;
    }

    public function getRevenue(){
        return $this->getSoldSeats() * $this->price;
    }

    public function displayInfo(){
        echo "Mã phim: " . $this->id . " | Tên phim: " . $this->title . " | giá vé: " . $this->price . " | tổng số ghế: " . $this->totalSeats . " | số ghế còn lại: " . $this->availableSeats . " | số vé đã bán: " . $this->getSoldSeats() . " | doanh thu: " . $this->getRevenue() . "\n";
    }

}


function findMovieById($movies, $id){
    if (empty($movies)) {
        echo "Danh sách phim rỗng! \n";
        return null;
    } 
    foreach($movies as $movie){
        if($movie->id == $id){
            return $movie;
        }
    }
    echo "Không tìm thấy phim có mã: $id \n";
    return null;
}

function getTotalRevenue($movies){
    if (empty($movies)) {
        echo "Danh sách phim rỗng! \n";
        return 0;
    } 

    $totalRevenue = 0;
    foreach($movies  as $movie){
        $totalRevenue += $movie->getRevenue();
    }
    return $totalRevenue;
}

function getBestSellingMovie($movies){
    if (empty($movies)) {
        echo "Danh sách phim rỗng! \n";
        return null;
    } 

    $best = null;
    foreach($movies as $movie){
        if($best == null || $movie->get_SoldSeats() > $best->getSoldSeats()){
            $best = $movie;
        }
    }
    return $best;
}

// data movie

$movie1 = new Movie(1, "Avengers", 100000, 100);
$movie2 = new Movie(2, "Avatar", 120000, 80);
$movie3 = new Movie(3, "BatMan", 90000, 120);

$movies = [$movie1, $movie2, $movie3];

foreach($movies as $movie){
    $movie->displayInfo();
}

echo "đặt 10 vé phim Avengers \n" ;
$movie1->bookTicket(10);
$movie1->displayInfo();

echo "đặt 15 vé phim Avatar \n" ;
$movie2->bookTicket(15);
$movie2->displayInfo();

echo "đặt -5 vé phim BatMan \n" ;
$movie3->bookTicket(-5);

echo "đặt 100 vé phim Avengers \n" ;
$movie1->bookTicket(100);

echo "hủy 20 vé phim Avatar \n" ;
$movie2->cancelTicket(20);
$movie2->displayInfo();

echo "hủy 0 vé phim Avengers \n" ;
$movie1->cancelTicket(0);

echo "hủy 5 vé phim Avengers \n" ;
$movie1->cancelTicket(5);

echo "Tìm phim Tây du ký, mã phim: 4 \n" ;
$movie = findMovieById($movies, 4);


?>
