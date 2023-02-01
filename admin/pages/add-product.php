<?php
    if(!isset($_COOKIE['user_ad'])) header("location: http://localhost/ogranic/admin/login.php");

require("../controllers/products.php");
require("../controllers/categories.php");
date_default_timezone_set('Asia/Ho_Chi_Minh');
$conn = new DB_Category();
$categories = $conn->get_all_data('categories');
unset($conn);

ob_start();
    
    

if(isset($_GET['message'])) {
      if($_GET['message'] == 'success') {
        echo '<script type="text/javascript">swal("Yeah!","Thêm sản phẩm thành công","success");</script>';
      } else {
        echo '<script type="text/javascript">swal("Thất bại","Thêm sản phẩm thất bại","error");</script>';
      }
}



 $product = array();
 $product['status'] = 1;
 $product['product_date_add'] = date("Y-m-d H:i:s");
 $product['product_code'] = time();
 $product['product_unit'] = 'kg';
 if(isset($_POST['submit']) && !isset($_GET['act'])){
    if(isset($_POST['product_name'])) $product['product_name'] = mb_strtolower($_POST['product_name'], 'utf-8');
    if(isset($_POST['product_category'])) $product['product_category'] = strtolower($_POST['product_category']);
    if(isset($_POST['product_price'])) $product['product_price'] = $_POST['product_price'];
    if(isset($_POST['product_quantity'])) $product['product_quantity'] = $_POST['product_quantity'];
    if(isset($_POST['product_unit'])) $product['product_unit'] = $_POST['product_unit'];
    if(isset($_POST['product_tags'])) $product['product_tags'] = strtolower($_POST['product_tags']);
    if(isset($_POST['product_sub_description'])) $product['product_sub_description'] = strtolower($_POST['product_sub_description']);
    if(isset($_POST['product_description'])) $product['product_description'] = htmlspecialchars($_POST['product_description']);
    if(isset($_POST['product_permalink'])) $product['product_permalink'] = $_POST['product_permalink'];
    if(isset($_POST['product_expire'])) $product['product_expire'] = $_POST['product_expire'];
    if(isset($_POST['product_expire_unit'])) $product['product_expire_unit'] = $_POST['product_expire_unit'];

    print_r($_FILES['product_images']);
    $product_link =  $_FILES['product_images']['tmp_name'];

    $product['product_images'] =  get_url_img($product_link);

    echo $product['product_images'];


    echo "<pre>";
    print_r($product);
    echo "</pre>";


    $conn = new DB();
    $result = $conn->insert_data('products', $product);

    if($result) {

      header("location: ?page=add-product&message=success");
    } else header("location: ?page=add-product&message=error");

    
 }



 if(isset($_GET['act']) && isset($_GET['id'])){
    $id = $_GET['id'];
    $conn = new DB_1();
    $p = $conn->get_all_data('products', "product_code = {$id} AND status = 1");
    $conn->disconnect();
    unset($conn);
   
        if($p) {
            $product['id'] = $p[0]->get_id();
            $product['product_code'] = $p[0]->get_code();
            $product['product_name']= $p[0]->get_name();
            $product['product_category'] = $p[0]->get_category();
            $product['product_quantity'] = $p[0]->get_quantity();
            $product['product_unit'] = $p[0]->get_unit();
            $product['product_tags'] = $p[0]->get_tags();
            $product['product_sub_description'] = $p[0]->get_sub_description();
            $product['product_description'] = $p[0]->get_description();
            $product['product_permalink'] = $p[0]->get_permalink();
            $product['product_price'] = $p[0]->get_price();
            $product['product_images'] = $p[0]->get_image();
            $product['status'] = $p[0]->get_status();
            $product['product_date_add'] = $p[0]->get_date_add();
            $product['product_expire'] = $p[0]->get_expire();
            $product['product_expire_unit'] = $p[0]->get_expire_unit();
            

        }
    
 }


ob_flush();

?>



<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= isset($_GET['act']) ? 'Chỉnh sửa': 'Thêm mới' ?> sản phẩm
            </h6>
        </div>


        <div class="card-body">
            <div class="table-responsive">
                <form action="" class="tm-edit-product-form" method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <label for="pr_code">Mã sản phẩm</label>
                        <input disabled id="pr_code" name="product_code" type="text" class="form-control validate"
                            value="<?php display_value('product_code',$product);?>" />
                    </div>

                    <div class="form-group mb-3">
                        <label for="pr_name">Tên sản phẩm</label>
                        <input id="pr_name" name="product_name" type="text" class="form-control validate"
                            value="<?php display_value('product_name',$product);?>" required onkeyup="on_change()" />
                    </div>

                    <div class="form-group mb-3">
                        <label for="permalink">permalink</label>
                        <input id="permalink" name="product_permalink" type="text" readonly
                            value="<?php display_value('product_permalink',$product);?>" class="form-control validate"
                            required />
                    </div>

                    <div class="form-group mb-3">
                        <label for="category">Danh mục</label>
                        <select class="custom-select tm-select-accounts" id="category" name="product_category"
                            value="<?php display_value('product_category',$product);?>">
                            <option>-- Danh mục --</option>
                            <?php 
                                       if(isset($categories) && !empty($categories)){
                                         
                                          foreach($categories as $category){
                                            
                                   ?>

                            <option value="<?= $category->get_id();  ?>"
                                <?php if(isset($product['product_category']) &&  $category->get_id() == $product['product_category']) echo 'selected' ?>>
                                <?= ucfirst($category->get_name());  ?></option>

                            <?php } } ?>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="price">Giá</label>
                        <input id="price" name="product_price" type="text" class="form-control validate"
                            value="<?php display_value('product_price',$product);?>" required pattern='^\d+$' />
                    </div>

                    <div class="form-group mb-3">
                        <div class="row">
                            <div class="form-group mb-3 col-xs-12 col-sm-6">
                                <label for="pr_quantity">Số lượng</label>
                                <input id="pr_quantity" name="product_quantity" type="text"
                                    value="<?php display_value('product_quantity',$product);?>"
                                    class="form-control validate" required pattern='^\d+$' />
                            </div>
                            <div class="form-group mb-3 col-xs-12 col-sm-6">
                                <label for="unit">Đơn vị</label>
                                <select class="custom-select tm-select-accounts" id="product_unit"
                                    value="<?php display_value('product_unit',$product);?>" name="product_unit">
                                    <option selected>-- Đơn vị --</option>
                                    <option value="kg" <?php echo $product['product_unit'] == 'kg' ? 'selected': '' ?>>
                                        Kg
                                    </option>
                                    <option value="box"
                                        <?php echo $product['product_unit'] == 'box' ? 'selected': '' ?>>Hộp
                                    </option>
                                    <option value="bags"
                                        <?php echo $product['product_unit'] == 'bags' ? 'selected': '' ?>>Bao
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="form-group mb-3">
                        <div class="row">
                            <div class="form-group mb-3 col-xs-12 col-sm-6">
                                <label for="expire_date">Hạn sử dụng</label>
                                <input id="expire_date" name="product_expire" type="text" class="form-control validate"
                                    value="<?php display_value('product_expire',$product);?>" data-large-mode="true" />
                            </div>
                            <div class="form-group mb-3 col-xs-12 col-sm-6">
                                <label for="expire_date">Đơn vị</label>
                                <select class="custom-select tm-select-accounts" id="product_unit"
                                    value="<?php display_value('product_unit',$product);?>" name="product_unit">
                                    <option selected>-- Thời hạn --</option>
                                    <option value="month"
                                        <?php echo $product['product_expire_unit'] == 'month' ? 'selected': '' ?>>
                                        tháng
                                    </option>
                                    <option value="day"
                                        <?php echo $product['product_expire_unit'] == 'day' ? 'selected': '' ?>>ngày
                                    </option>
                                    <option value="year"
                                        <?php echo $product['product_expire_unit'] == 'year' ? 'selected': '' ?>>năm
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="tags">Tags</label>
                        <input id="tags" name="product_tags" type="text" class="form-control validate"
                            value="<?php display_value('product_tags',$product);?>" required />
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-12 mx-auto mb-4">
                        <div class="img-container ">
                            <input type="file" id="file-img" name="product_images" accept="image/*"
                                onchange="onChangeImg()">
                            <div id="display-image">
                                <?php if(isset($product['product_images'])){ ?>
                                <img src="<?= $product['product_images']; ?>">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group mb-3 mt-3">
                            <label for="description">Mô tả chi tiết sản phẩm</label>
                            <textarea id="description" class="form-control validate" rows="3" value="ádkjsaldkjasdlk"
                                name="product_description"></textarea>
                        </div>
                    </div>

                    <div class="col-12">
                        <button type="submit" name="submit" class="btn btn-primary btn-block text-uppercase">Thêm sản
                            phẩm</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>




<script src="https://cdn.tiny.cloud/1/p4pnuj31bfkg96ruzu2k0vznqz1u6gtyqbd147ez9s113cbs/tinymce/6/tinymce.min.js"
    referrerpolicy="origin"></script>
<script>
tinymce.init({
    selector: 'textarea#description',
    plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
    menubar: 'file edit view insert format tools table help',
    toolbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
    toolbar_sticky: true,
    autosave_ask_before_unload: true,
    autosave_interval: '30s',
    autosave_prefix: '{path}{query}-{id}-',
    autosave_restore_when_empty: false,
    autosave_retention: '2m',
    image_advtab: true,
    link_list: [{
            title: 'My page 1',
            value: 'https://www.codexworld.com'
        },
        {
            title: 'My page 2',
            value: 'http://www.codexqa.com'
        }
    ],
    image_list: [{
            title: 'My page 1',
            value: 'https://www.codexworld.com'
        },
        {
            title: 'My page 2',
            value: 'http://www.codexqa.com'
        }
    ],
    image_class_list: [{
            title: 'None',
            value: ''
        },
        {
            title: 'Some class',
            value: 'class-name'
        }
    ],
    importcss_append: true,
    file_picker_callback: (callback, value, meta) => {
        /* Provide file and text for the link dialog */
        if (meta.filetype === 'file') {
            callback('https://www.google.com/logos/google.jpg', {
                text: 'My text'
            });
        }

        /* Provide image and alt text for the image dialog */
        if (meta.filetype === 'image') {
            callback('https://www.google.com/logos/google.jpg', {
                alt: 'My alt text'
            });
        }

        /* Provide alternative source and posted for the media dialog */
        if (meta.filetype === 'media') {
            callback('movie.mp4', {
                source2: 'alt.ogg',
                poster: 'https://www.google.com/logos/google.jpg'
            });
        }
    },
    templates: [{
            title: 'New Table',
            description: 'creates a new table',
            content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>'
        },
        {
            title: 'Starting my story',
            description: 'A cure for writers block',
            content: 'Once upon a time...'
        },
        {
            title: 'New list with dates',
            description: 'New List with dates',
            content: '<div class="mceTmpl"><span class="cdate">cdate</span><br><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>'
        }
    ],
    template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
    template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
    height: 400,
    image_caption: true,
    quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
    noneditable_class: 'mceNonEditable',
    toolbar_mode: 'sliding',
    contextmenu: 'link image table',
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
});
</script>