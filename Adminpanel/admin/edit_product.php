<?php
include('includes/header.php');

$id = $_GET['id'];

$table = 'products';

$where = 'id = ' . $id;

$product = $obj->getSingle($table, $where);
// print_r($product);


?>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Add Products</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><small>Product Details</small></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />

                        <form class="form-horizontal form-label-left" action="/admin/edit_product_action.php"
                            method="POST" enctype="multipart/form-data">

                            <input type="hidden" name="id" value="<?= $id ?>">
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Product Name <span
                                        class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="text" name="name" class="form-control" value="<?= $product['name'] ?>">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Cost Price <span
                                        class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="text" name="cprice" class="form-control" value="<?= $product['cost_price'] ?>">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Sale Price <span
                                        class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="text" name="sprice" class="form-control" value="<?= $product['sale_price'] ?>">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Description <span
                                        class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <textarea name="description" id="" class="form-control"><?= $product['description'] ?></textarea>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="image">Image</label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="file" name="image" id="image" class="form-control"
                                        accept=".jpg, .png, .jpeg">
                                    <span class="text-danger" id="imageError">Image format: jpg, png, jpeg only</span>
                                    <br>
                                    <img src="/admin/<?= $product['image'] ?>" alt="" width="250">
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <button class="btn btn-primary" type="button">Cancel</button>
                                    <button class="btn btn-primary" type="reset">Reset</button>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
<?php include('includes/footer.php'); ?>