    <!--Footer Area -->
    <footer class="footer-area section-padding-2">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                    <div class="footer-widget mr-4">
                        <div class="footer-logo">
                            <a href="#"><img src="assets/images/logo.png" alt=""></a>
                        </div>
                        <p>Lakeshore Hotel (Open 24/7)<br>House: 46, Road: 41, Gulshan 2, Dhaka 1212</p>
                        <p>Chefs Table Courtside, Madani <br>Ave, Dhaka 1212</p>
                        <h3>Hotline: +8801300290494</h3>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                    <div class="footer-widget footer-nav">
                        <h3>Information</h3>
                        <ul>
                            <li><a href="termsandconditions.php">Terms & Conditions</a></li>
                            <li><a href="termsandconditions.php">Product Information</a></li>
                            <li><a href="termsandconditions.php">Legal Information</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                    <div class="footer-widget footer-nav">
                        <h3>Customer Service</h3>
                        <ul>
                            <li><a href="index.php#location">Contact us</a></li>
                            <li><a href="sitemap.xml">Site Map</a></li>
                            <li><a href="index.php#location">Webmail</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                    <div class="footer-widget footer-nav">
                        <!--<h3>Our Payment Partner</h3>-->
                        <!--<ul>-->
                        <!--    <li><a href="#">Specials</a></li>-->
                        <!--    <li><a href="#">Coupons</a></li>-->
                        <!--</ul>-->
                        <img src="assets/images/payment.png">
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--/Footer Area-->

    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6">
                    <div class="copy-text">
                        <p>&copy; Kona Cafe 2021. All rights reserved</p>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6">
                    <div class="social">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/jquery-migrate.js"></script>
    <script src="assets/js/jquery-ui.js"></script>

    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/scrollUp.min.js"></script>
    <script src="assets/js/cartsidebar.js"></script>

    <script src="assets/js/script.js"></script>

    <script>


        function updateCartQuantity(productId, productSizeId, productOptionIds, productAddonIds, subCategoryAddonIds, productQuantity){
            //var productQuantity = $('#quantity'+productId).val();

            $.ajax({
                    method: "post",
                    url: 'erp/ajaxfunctions.php',
                    data: {
                        funName: "updateCartQuantity",
                        productId: productId,
                        productSizeId: productSizeId,
                        productOptionIds: productOptionIds,
                        productAddonIds: productAddonIds,
                        subCategoryAddonIds: subCategoryAddonIds,
                        productQuantity: productQuantity,
                        updateFrom: "direct"
                    }
                })
                .done(function(response) {
                    getTotalProductOnCart();
                    $('#miniCartDetails').html(response);
                });
        }


        function removeSingleCartItem(productId, productSizeId, productOptionIds, productAddonIds, subCategoryAddonIds) {
            $.ajax({
                    method: "post",
                    url: 'erp/ajaxfunctions.php',
                    data: {
                        funName: "deleteSingleItemFromCart",
                        productId: productId,
                        productSizeId: productSizeId,
                        productOptionIds: productOptionIds,
                        productAddonIds: productAddonIds,
                        subCategoryAddonIds: subCategoryAddonIds
                    }
                })
                .done(function(response) {
                    getTotalProductOnCart();
                    $('#miniCartDetails').html(response);
                });
        }

        function getTotalProductOnCart() {
            $.ajax({
                    method: "post",
                    url: 'erp/ajaxfunctions.php',
                    data: {
                        funName: "getTotalProductOnCart"
                    }
                })
                .done(function(response) {
                    $('#totalCartProductsView').html(response);
                });
        }


        function reloadLocation() {
            location.reload();
        }
    </script>