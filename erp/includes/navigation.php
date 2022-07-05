  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
          <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item">
              <a href="home.php" class="nav-link">Home</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
              <a href="https://api.whatsapp.com/send?phone=8801917039169&text=Thanks%20for%20reaching%20me%20out,%20how%20may%20I%20help%20you%20?" class="nav-link">Contact Developer</a>
          </li>

          <li class="nav-item bg-primary" style="margin-left: 5px;">
              <a href="../" target="_blank" class="nav-link"><i class="far fa-eye"></i> Visit Website</a>
          </li>

          <li class="nav-item bg-info" style="margin-left: 5px;">
              <a href="pos" target="_blank" class="nav-link"><i class="fas fa-cash-register"></i> POS</a>
          </li>

          <li class="nav-item bg-danger" style="margin-left: 5px;">
              <a href="logout.php" class="nav-link"><i class="fas fa-sign-out-alt"></i> Logout</a>
          </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
          <!-- Notifications Dropdown Menu -->
          <li class="nav-item dropdown">
              <a class="nav-link" data-toggle="dropdown" href="#">
                  <i class="far fa-bell"></i>
                  <span class="badge badge-warning navbar-badge">
                      <?php echo count(getAllStockWarningProducts()); ?>
                  </span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                  <span id="stoctOutDiv" style="max-height: 675px; display: grid; overflow: scroll;">
                      <?php
                        $stockWarnings = getAllStockWarningProducts();
                        foreach ($stockWarnings as $stockWarning) {
                        ?>
                          <div class="dropdown-divider"></div>
                          <span class="dropdown-item">
                              <?php echo $stockWarning['ingredient_name'] . " " . $stockWarning['ingredient_amount'] . " left only"; ?>
                          </span>
                      <?php
                        }
                        ?>

                  </span>
              </div>
          </li>
      </ul>
  </nav>
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="home.php" class="brand-link">
          <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light"><?php echo $_SESSION["user_sub_branch_name"]; ?></span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <img src="images/<?php echo $_SESSION["user_photo"]; ?>" class="img-circle elevation-2" alt="User Image" style="max-height: 60px; width:auto;">
              </div>
              <div class="info">
                  <a href="#" class="d-block"><?php echo $_SESSION["user_full_name"]; ?></a>
              </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->


                  <li class="nav-item">
                      <a href="home.php" class="nav-link">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Home
                              <!-- <span class="right badge badge-danger">New</span> -->
                          </p>
                      </a>
                  </li>

                  <li class="nav-item has-treeview menu-open">

                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-home"></i>
                          <p>
                              Property Management
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="branch_management.php" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Branch Management</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="sub_branch_management.php" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Sub Branch Management</p>
                              </a>
                          </li>

                          <li class="nav-item">
                              <a href="user_management.php" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>User Management</p>
                              </a>
                          </li>

                          <li class="nav-item">
                              <a href="customer_management.php" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Customer Management</p>
                              </a>
                          </li>
                      </ul>
                  </li>

                  <li class="nav-item has-treeview menu-open">

                      <a href="#" class="nav-link">
                          <i class="nav-icon fab fa-product-hunt"></i>
                          <p>
                              Product Management
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="ingredients_category_management.php" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Ingredient Category </p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="ingredients_sub_category_management.php" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Ingredient Sub Category </p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="ingredients_management.php" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Ingredient Management</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="product_category_management.php" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Product Category </p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="product_sub_category_management.php" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Product Sub Category</p>
                              </a>
                          </li>

                          <li class="nav-item">
                              <a href="products.php" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Products</p>
                              </a>
                          </li>



                      </ul>
                  </li>
                  <li class="nav-item has-treeview menu-open">

                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-clipboard-list"></i>
                          <p>
                              Requisition
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="requisition_add.php" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Add Requisition</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="requisition_list.php" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>View Requisitions</p>
                              </a>
                          </li>
                      </ul>
                  </li>

                  <li class="nav-item has-treeview menu-open">

                      <a href="#" class="nav-link">
                          <i class="nav-icon far fa-handshake"></i>
                          <p>
                              Vendor
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="vendor_management.php" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Vendor Management</p>
                              </a>
                          </li>

                      </ul>
                  </li>

                  <li class="nav-item has-treeview menu-open">

                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-shopping-bag"></i>
                          <p>
                              Purchase Management
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="purchase_add.php" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Add Purchase</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="purchase_list.php" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>New Purchase Orders</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="purchase_complete_list.php" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Completed Purchase</p>
                              </a>
                          </li>
                      </ul>
                  </li>

                  <li class="nav-item">
                      <a href="guard_requisition_list.php" class="nav-link">
                          <i class="nav-icon fas fa-dungeon"></i>
                          <p>
                              Purchase Gate Check
                          </p>
                      </a>
                  </li>

                  <li class="nav-item">
                      <a href="stock_management.php" class="nav-link">
                          <i class="nav-icon fas fa-chart-bar"></i>
                          <p>
                              Stock
                              <!-- <span class="right badge badge-danger">New</span> -->
                          </p>
                      </a>
                  </li>

                  <?php

                    if ($_SESSION['user_type'] == 1 || $_SESSION['user_type'] == 6) {

                    ?>
                      <li class="nav-item has-treeview menu-open">

                          <a href="#" class="nav-link">
                              <i class="nav-icon fas fa-chart-line"></i>
                              <p>
                                  Expense Management
                                  <i class="right fas fa-angle-left"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                  <a href="expense_type_management.php" class="nav-link">
                                      <i class="nav-icon fa fa-chart-bar"></i>
                                      <p>
                                          Expense Type
                                          <!--<span class="right badge badge-danger">New</span>-->
                                      </p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="expense_management.php" class="nav-link">
                                      <i class="nav-icon fa fa-chart-pie"></i>
                                      <p>Expense Management</p>
                                  </a>
                              </li>
                          </ul>
                      </li>
                  <?php

                    }
                    ?>
                  <li class="nav-item">
                      <a href="order_distribution.php" class="nav-link">
                          <i class="nav-icon fas fa-list-alt"></i>
                          <p>
                              Order Distribution
                              <span class="right badge badge-danger" id="commonOrderSign" style="visibility: hidden;">New</span>
                          </p>
                      </a>
                  </li>

                  <li class="nav-item">
                      <a href="order_management.php" class="nav-link">
                          <i class="nav-icon fas fa-list-alt"></i>
                          <p>
                              Order Management
                              <span class="right badge badge-danger" id="newOrderSign" style="visibility: hidden;">New</span>
                          </p>
                      </a>
                  </li>





                  <li class="nav-item">
                      <a href="cooking_management.php" class="nav-link">
                          <i class="nav-icon fas fa-list-alt"></i>
                          <p>
                              Cooking Progress
                              <!--<span class="right badge badge-danger">New</span>-->
                          </p>
                      </a>
                  </li>

                  <li class="nav-item">
                      <a href="delivery_management.php" class="nav-link">
                          <i class="nav-icon fas fa-list-alt"></i>
                          <p>
                              Delivery Progress
                              <!--<span class="right badge badge-danger">New</span>-->
                          </p>
                      </a>
                  </li>


                  <?php

                    if ($_SESSION['user_type'] == 1 || $_SESSION['user_type'] == 6) {

                    ?>
                      <li class="nav-item">
                          <a href="previous_orders.php" class="nav-link">
                              <i class="nav-icon fas fa-list-alt"></i>
                              <p>
                                  Previous Orders
                              </p>
                          </a>
                      </li>
                  <?php

                    }
                    ?>




                  <li class="nav-item has-treeview menu-open">

                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-trash-alt"></i>
                          <p>
                              Waste Management
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="waste_management.php" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Add Waste</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="waste_list.php" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Wasted Ingredients</p>
                              </a>
                          </li>
                      </ul>
                  </li>



                  <li class="nav-item has-treeview menu-open">

                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-chart-line"></i>
                          <p>
                              Report Management
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="sales_report_management.php" class="nav-link">
                                  <i class="nav-icon fa fa-chart-bar"></i>
                                  <p>
                                      Items Sales Report
                                      <!--<span class="right badge badge-danger">New</span>-->
                                  </p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="purchase_report_management.php" class="nav-link">
                                  <i class="nav-icon fa fa-chart-pie"></i>
                                  <p>Purchase Report</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="daily_report_management.php" class="nav-link">
                                  <i class="nav-icon fa fa-chart-pie"></i>
                                  <p>Daily Report</p>
                              </a>
                          </li>
                      </ul>
                  </li>




              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>