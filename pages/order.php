<div class="container_fluid bg-light">
	<div class="container">
		<div class="title d-flex align-items-center justify-content-between">
				<div class="title-container">
					<h2 class="title--main">
						Đặt hàng
					</h2>
				</div>
				
			
	
				<div class="path-container">
					<p class="path">Trang chủ/ Đặt hàng</p>
				</div>
		</div>
	</div>
</div>


<section id="login" class="mt-60">

	<div class="container d-flex justify-content-center">
		<div class="row w-100">
			<div class="col-md-7">
				 <form action="" class="tm-edit-product-form" method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-5">
                        <label for="pr_code">Mã đơn hàng</label>
                        <input disabled id="pr_code" name="product_code" type="text" class="form-control validate"
                            value="" />
                    </div>
                    <div class="form-group mb-5">
                        <div class="row">
                            <div class="form-group col-xs-12 col-sm-6">
                                <label for="pr_name">Tên</label>
		                        <input id="pr_name" name="product_name" type="text" class="form-control validate"
		                            value="" required/>
                            </div>
                            <div class="form-group col-xs-12 col-sm-6">
                             	<label for="permalink">Họ</label>
		                        <input id="permalink" name="product_permalink" type="text"
		                            value="" class="form-control validate"
		                            required />
                            </div>
                        </div>
                    </div>
                      <div class="form-group mb-5">
                        <label for="pr_code">Số điện thoại</label>
                        <input id="pr_code" name="product_code" type="text" class="form-control validate"
                            value="" />
                    </div>

                    <!-- Chọn địa chỉ -->

                    <div class="form-group mb-5">
                     	<select class="form-control form-select-sm mb-5" id="city" aria-label=".form-select-sm">
						<option value="" selected>Chọn tỉnh thành</option>           
						</select>
						          
						<select class="form-control form-select-sm mb-5" id="district" aria-label=".form-select-sm">
						<option value="" selected>Chọn quận huyện</option>
						</select>

						<select class="form-control form-select-sm" id="ward" aria-label=".form-select-sm">
						<option value="" selected>Chọn phường xã</option>
						</select>

                    </div>
                    <!-- end địa chỉ -->
                      <div class="form-group mb-5">
                        <label for="pr_code">Địa chỉ cụ thể</label>
                        <input id="pr_code" name="product_code" type="text" class="form-control validate"
                            value="" />
                    </div>


                 
                    <div class="">
                        <button type="submit" name="order" class="btn btn-primary btn-block text-uppercase">Đặt hàng</button>
                    </div>
                </form>
			</div>
			<div class="col-md-5">
				
			</div>
		</div>
	</div>

</section>






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
promise.then(function (result) {
  renderCity(result.data);
});

function renderCity(data) {
  for (const x of data) {
    citis.options[citis.options.length] = new Option(x.Name, x.Id);
  }
  citis.onchange = function () {
    district.length = 1;
    ward.length = 1;
    if(this.value != ""){
      const result = data.filter(n => n.Id === this.value);

      for (const k of result[0].Districts) {
        district.options[district.options.length] = new Option(k.Name, k.Id);
      }
    }
  };
  district.onchange = function () {
    ward.length = 1;
    const dataCity = data.filter((n) => n.Id === citis.value);
    if (this.value != "") {
      const dataWards = dataCity[0].Districts.filter(n => n.Id === this.value)[0].Wards;

      for (const w of dataWards) {
        wards.options[wards.options.length] = new Option(w.Name, w.Id);
      }
    }
  };
}
</script>