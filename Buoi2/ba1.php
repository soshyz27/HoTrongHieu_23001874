// giỏ hàng mua sắm

<?php

class CartItem{
    public $name;
    public $price;
    public $quantity;

    public function __construct($name, $price, $quantity){
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
    }

    public function getName(){
        return $this->name;
    }

    public function getPrice(){
        return $this->price;
    }

    public function getQuantity(){
        return $this->quantity;
    }

    public function getTotal(){
        return $this->price * $this->quantity;
    }

    public function displayItem(){
        echo "Sản phẩm: " . $this->name . " | đơn giá: " . $this->price . " | số lượng: " . $this->quantity . "\n";
    }
}

class ShoppingCart{
    private $items = [];

    public function addItem($item){
        if ($item->getPrice() <= 0){
            echo "lỗi giá! \n";
            $item->displayItem();
            return;
        }

        if ($item->getQuantity() <= 0){
            echo "Lỗi số lượng! \n";
            $item->displayItem();
            return;
        }

        $this->items[] = $item;
        echo "Đã thêm sản phẩm! \n";
        $item->displayItem();
    }

    public function removeItem($name){
        $found = false;
        foreach($this->items as $index => $item){
            if($item->getName() == $name){
                unset($this->items[$index]);
                $this->items = array_values($this->items);
                echo "Đã xóa sản phẩm" . $name . "! \n";
                $found = true;
                break;

            }
        }

        if(!$found){
            echo "Không tìm thấy sản phẩm!";
        }
    }

    public function calculateTotal(){
        if (empty($this->items)){
            echo "Bạn chưa có sản phẩm nào trong giỏ hàng, hãy mua hàng!";
            return 0;
        }
        $total = 0;
        foreach($this->items as $item){
            $total += $item->getTotal();
        }
        return $total;
    }

    public function displayCart(){
        if (empty($this->items)){
            echo "Giỏ hàng trống!";
        } else{
            $total = 0;
            foreach($this->items as $item){
                echo "Tên sản phẩm: " . $item->getName() . " | giá: " . $item->getPrice() . " | số lượng: " . $item->getQuantity() . " | thành tiền: " . $item->getTotal() . "\n";
                $total += $item->getTotal();
            }
            echo "Tổng tiền: " . $this->calculateTotal() . "\n";
        }
    }
}

$cart = new ShoppingCart();

$item1 = new CartItem("áo phông", 150000, 2);
$item2 = new CartItem("quần kaki", 300000, 2);
$item3 = new CartItem("áo sơ mi", 220000, 2);
$item4 = new CartItem("quần jean", 350000, 1);

$invalidPriceItem = new CartItem("Áo khoác lỗi giá", -50000, 2);
$invalidQtyItem = new CartItem("Tất chân lỗi SL", 20000, 0);

$cart->addItem($item1);
$cart->addItem($item2);
$cart->addItem($item3);
$cart->addItem($item4);

$cart->addItem($invalidPriceItem);
$cart->addItem($invalidQtyItem);

echo "Hiển thị giỏ hàng: \n";
$cart->displayCart();

echo "Xóa sản phẩm quần jean: \n";
$cart->removeItem("quần jean");
echo "Giỏ hàng: \n";
$cart->displayCart();
?>