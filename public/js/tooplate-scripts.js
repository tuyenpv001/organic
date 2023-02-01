

function on_change() {
  // if(document.querySelector('#pr_name')) {
  //   document.querySelector('#pr_name').addEventListner('input', function(e){
  //     console.log(e.target.value);
  //   })
  // }
  const input = document.querySelector('#pr_name');
  const permalink = document.querySelector('#permalink');
  let text = '';
  input.addEventListener('keyup', function(e){
      // console.log(e.keyCode);
      text = e.target.value;
      text = text.trim().toLowerCase();
      text = removeVietnameseTones(text);
      text = text.replace(/\s+/g, ' ');
      text = text.replace(/\s/g, '-');

      permalink.value = text;
  })

}





function removeVietnameseTones(str) {
    str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a"); 
    str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e"); 
    str = str.replace(/ì|í|ị|ỉ|ĩ/g,"i"); 
    str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o"); 
    str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u"); 
    str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y"); 
    str = str.replace(/đ/g,"d");
    // str = str.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g, "A");
    // str = str.replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g, "E");
    // str = str.replace(/Ì|Í|Ị|Ỉ|Ĩ/g, "I");
    // str = str.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g, "O");
    // str = str.replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g, "U");
    // str = str.replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g, "Y");
    // str = str.replace(/Đ/g, "D");
    // Some system encode vietnamese combining accent as individual utf-8 characters
    // Một vài bộ encode coi các dấu mũ, dấu chữ như một kí tự riêng biệt nên thêm hai dòng này
    str = str.replace(/\u0300|\u0301|\u0303|\u0309|\u0323/g, ""); // ̀ ́ ̃ ̉ ̣  huyền, sắc, ngã, hỏi, nặng
    str = str.replace(/\u02C6|\u0306|\u031B/g, ""); // ˆ ̆ ̛  Â, Ê, Ă, Ơ, Ư
    // Remove extra spaces
    // Bỏ các khoảng trắng liền nhau
    str = str.replace(/ + /g," ");
    str = str.trim();
    // Remove punctuations
    // Bỏ dấu câu, kí tự đặc biệt
    str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'|\"|\&|\#|\[|\]|~|\$|_|`|-|{|}|\||\\/g," ");
    return str;
}


function onChangeImg() {

  const inputFile = document.querySelector('#file-img');

  const reader = new FileReader();
  reader.addEventListener("load", () => {
    const uploaded_image = reader.result;
    document.querySelector("#display-image").style.backgroundImage = `url(${uploaded_image})`;
  });
  reader.readAsDataURL(inputFile.files[0]);
}




$( document ).ready(function() {
    var btnDel = $('.delete');
    var popupContainer = $('.popup-container');
    var btnClose = $('#btn-cancel');
    var btnOk = $('#btn-ok');
    btnDel.click(function(e){
      var id = $(this).attr('data-id');
      showPopup(popupContainer);

      btnOk.click(function() {

        $.ajax({
          url: '../ajax/update_product.php',
          method:'POST',
          data: {"id": id},
          dataType: 'json',
          success: function(mess){
            if(mess.status){
                hidePopup(popupContainer);
               swal({title:"Thành công",text:"Sản phẩm đã được xóa!",icon:"success"});
                setTimeout(function(){location.reload();},1000)
            }
              
            // location.reload(); 
          },
        })
      })



    })

    btnClose.click(function(){
      hidePopup(popupContainer);
    })



    var searchText =  $('#search-product');

    searchText.keyup(function(e){
      onChange(e);
    });




    // Select option
    
    if($('#select-product')) {
      var selectBtn = $('#select-product');

      selectBtn.change(function(){
        console.log(selectBtn.val());
        var id = selectBtn.val();
        $.ajax({
          url: '../ajax/get_product.php',
          method:'POST',
          data: {"id": id},
          dataType: 'json',
          success: function(data){
            var mainList =  $('#main-list');
            var li = `
               <li class="row align-items-center">
              <div class="col-2">
                  <img src="${data.product_images}" style="width: 75px;">
              </div>
              <div class="col-4">${data.product_name}</div>
              <div class="col-2">${data.product_price}</div>
              <div class="col-2">
                 
                  <input type="number" min="0" max="${data.product_quantity}"
                      step="0.25" value="" class="form-control" name="product_quantity[]"
                      data-id="<?php //$p['product_id']; ?>" pattern="[+-]?([0-9]*[.])?[0-9]+">
              </div>
              <div class="col-1">${data.status}</div>
              <div class="col-1"><a  class="delete" data-id="${data.product_id}"><i class="fa-regular fa-trash-can"></i></a> </div></div>
              <input type="hidden" value="${data.product_id}" name="products[]">
            </li>
            
            `
            mainList.append(li);
          },
        })
      })  

  }



  if($('.detail')){
    var detail = $('.detail');
    var order_detail = $('#order_detail');
    var btnClose = $('#btn-close');
    btnClose.click(function(){order_detail.removeClass('display');})
    detail.click(function(){
      var id = $(this).attr('data-id');
      order_detail.addClass('display');
    
      $.ajax({
        url: '../ajax/get_order.php',
        method:'POST',
        data: {"id": id},
        dataType: 'json',
        success: function(data){
          console.log(data);
          var mainList =  $('#mainList');
          var li = ``;

          for(var p of data){
            console.log(p);
              li += `<li class="row">
                <div class="col-2"><img src="${p.p_img}" alt="" width="75px"></div>
                <div class="col-4">${p.p_name}</div>
                <div class="col-2">${p.p_price}</div>
                <div class="col-2">${p.quantity}</div>
            </li>`;
          }
          mainList.html(li);
        },
      })

    })
  }


});

function showPopup(popupContainer) {
  popupContainer.removeClass('hide');
   popupContainer.addClass('show');
}
function hidePopup(popupContainer) {
   popupContainer.addClass('hide');
    popupContainer.removeClass('show');
}


function onChange(e) {
  console.log(e.target.value);
  var listProduct = $('#list-product');
  var liItem = '';
  var text = e.target.value.trim();


   $.ajax({
          url: '../ajax/search_product.php',
          method:'POST',
          data: {"text": text},
          dataType: 'json',
          success: function(mess){
            console.log(mess)
            for(var p of mess) {
              liItem += `
                    <li class="row align-items-center table-item">
                        <div class="col-1"><input type="checkbox" name=""></div>
                        <div class="col-1">${p.product_code}</div>
                        <div class="col-1">
                          <img src="${p.product_images}" style="width: 75px;">
                        </div>
                        <div class="col-4">${p.product_name}</div>
                        <div class="col-1">${p.product_price}</div>
                        <div class="col-1">${p.product_quantity}</div>
                        <div class="col-1">${p.status}</div>
                        <div class="col-2 d-flex justify-content-center">
                          <a href="?page=add-product&act=edit&id=${p.product_code}" class="mx-2"><i class="fa-regular fa-pen-to-square"></i></a>
                          <a  class="delete" data-id="${p.product_id}"><i class="fa-regular fa-trash-can"></i></a> </div>
                      </li>
              `;

            }

            listProduct.html(liItem);

          },
    })
}