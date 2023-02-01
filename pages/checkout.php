 <?php

ob_start();
if(!isset($_COOKIE['user'])) header("location: ?page=login"); 

// print_r($_SESSION['cart']);
// print_r($_COOKIE['user']);
$total = 0;
if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){   
    foreach($_SESSION['cart'] as $p)  {
        $total += $p['quantity'] * $p['p_price'];
    }
}


$order  = array();
$order['username'] = $_COOKIE['user']['username'];
$order['email'] = $_COOKIE['user']['email'];
$order['total'] = $total;
$order['order_date'] = date('Y-m-d H:m:s');

$order['order_status'] = 'pending';



if(isset($_POST['checkout'])){
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";

    if(isset($_POST['order_address'])) $order['order_address'] = $_POST['order_address'];
    if(isset($_POST['phone'])) $order['order_phone'] = $_POST['phone'];
    
    $conn = new DB();
    $id = $conn->insert_data('orders', $order);
    if($id) {
        $productJson = json_encode($_SESSION['cart'],JSON_UNESCAPED_UNICODE);
        $order_detail = array( 'order_id'=> $id, 'products'=> $productJson);

        if($conn->insert_data('order_detail',$order_detail)){
            unset($_SESSION['cart']);
            header("location: ?page=cart&mess=success");

        }
    }

   
}


// print_r($order);
// $encodedArray = json_encode($_SESSION['cart']);
// echo $encodedArray;


ob_flush();

?>









 <!-- Checkout Section Begin -->
 <section class="checkout spad">
     <div class="container">

         <div class="checkout__form">
             <h4>Chi tiết đơn hàng</h4>
             <form action="?page=checkout" method="POST">
                 <div class="row">
                     <div class="col-lg-8 col-md-6">
                         <div class="row">
                             <div class="col-lg-6">
                                 <div class="checkout__input">
                                     <p>Tên<span>*</span></p>
                                     <input type="text" name="f_name" value="<?= $_COOKIE['user']['first_name']; ?>"
                                         required>
                                 </div>
                             </div>
                             <div class="col-lg-6">
                                 <div class="checkout__input">
                                     <p>Họ<span>*</span></p>
                                     <input type="text" name="l_name" value="<?= $_COOKIE['user']['last_name']; ?>"
                                         required>
                                 </div>
                             </div>
                         </div>
                         <div class="row">
                             <div class="col-lg-6">
                                 <div class="checkout__input">
                                     <p>Số điện thoại<span>*</span></p>
                                     <input type="text" name="phone" required pattern="(84|0[3|5|7|8|9])+([0-9]{8})\b">
                                 </div>
                             </div>
                             <div class="col-lg-6">
                                 <div class="checkout__input">
                                     <p>Email<span>*</span></p>
                                     <input type="text" name="email" value="<?= $_COOKIE['user']['email']; ?>" required>
                                 </div>
                             </div>
                         </div>

                         <div class="checkout__input">
                             <p>Địa chỉ<span>*</span></p>
                             <select class="form-control form-select-sm mb-5" id="city" name="city"
                                 aria-label=".form-select-sm">
                                 <option value="" selected>Chọn tỉnh thành</option>
                             </select>
                             <!-- end địa chỉ -->
                         </div>
                         <div class="checkout__input">
                             <select class="form-control form-select-sm mb-5" id="district" aria-label=".form-select-sm"
                                 name="district">
                                 <option value="" selected>Chọn quận huyện</option>
                             </select>
                         </div>
                         <div class="checkout__input">
                             <select class="form-control form-select-sm" name="ward" id="ward"
                                 aria-label=".form-select-sm">
                                 <option value="" selected>Chọn phường xã</option>
                             </select>

                         </div>




                         <div class="checkout__input mb-5">
                             <p>Địa chỉ cụ thể<span>*</span></p>
                             <input id="or_address" name="order_address" type="text" class="form-control validate"
                                 value="<?php if(isset($order['order_address'])) echo $order['order_address'];?>"
                                 required />
                         </div>


                     </div>



                     <div class="col-lg-4 col-md-6">
                         <div class="checkout__order">
                             <h4>Sản phẩm</h4>
                             <div class="checkout__order__products">Tên <span>Tổng</span></div>
                             <ul>
                                 <?php 
                                      
                                        if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){   
                                            foreach($_SESSION['cart'] as $p)  {
                                     ?>
                                 <li><?= $p['p_name']; ?><span><?=  $p['quantity'] * $p['p_price']; ?></span></li>
                                 <?php } } ?>
                             </ul>
                             <!-- <div class="checkout__order__subtotal">Subtotal <span>$750.99</span></div> -->
                             <div class="checkout__order__total">Total <span>
                                     <?= $total; ?>

                                 </span></div>

                             <button type="submit" name="checkout" class="site-btn">Đặt hàng</button>
                         </div>
                     </div>
                 </div>
             </form>
         </div>
     </div>
 </section>
 <!-- Checkout Section End -->










 <!-- js chọn tỉnh phường -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
 <script>
var citis = document.getElementById("city");
var districts = document.getElementById("district");
var wards = document.getElementById("ward");


var Parameter = {
    url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json",
    method: "GET",
    responseType: "application/json",
};
var promise = axios(Parameter);
promise.then(function(result) {
    renderCity(result.data);

});



function renderCity(data) {
    for (const x of data) {
        citis.options[citis.options.length] = new Option(x.Name, x.Id);
    }
    citis.onchange = function() {
        district.length = 1;
        ward.length = 1;
        if (this.value != "") {
            const result = data.filter(n => n.Id === this.value);
            // console.log(result[0].Name);
            // text = result[0].Name;
            var or_address = document.getElementById("or_address");
            or_address.value = result[0].Name;
            for (const k of result[0].Districts) {
                district.options[district.options.length] = new Option(k.Name, k.Id);
            }
        }
    };
    district.onchange = function() {
        ward.length = 1;
        const dataCity = data.filter((n) => n.Id === citis.value);

        if (this.value != "") {
            // const dataWards = dataCity[0].Districts.filter(n => n.Id === this.value)[0].Wards;
            const dataWards = dataCity[0].Districts.filter(n => n.Id === this.value);
            var or_address = document.getElementById("or_address");
            or_address.value += `, ${dataWards[0].Name}`;
            for (const w of dataWards[0].Wards) {
                wards.options[wards.options.length] = new Option(w.Name, w.Id);
            }
        }

    };

    wards.onchange = function() {
        var e = document.getElementById("ward");
        var value = e.value;
        var text = e.options[e.selectedIndex].text;
        var or_address = document.getElementById("or_address");
        or_address.value += `, ${text}`;
    }





}
 </script>