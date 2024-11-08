<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Merchant-Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php
  session_start();
  if (!isset($_SESSION["email"])) {
    header("location:../index.php");
  }

  include("./navbar.php");
  include("engine.php");
  ?>
</head>

<body>

  <div class="container">

    <?php include("sidebar.php"); ?>

    <div class="tab-content">
      <div id="home" class="tab-pane fade in active">
        <center>
          <h3>Owner Profile</h3>
        </center>
        <div class="container">
          <?php
          include("../config/config.php");
          $u_email = $_SESSION["email"];

          $sql = "SELECT * from merchant where email='$u_email'";
          $result = mysqli_query($db, $sql);

          if (mysqli_num_rows($result) > 0) {
            while ($rows = mysqli_fetch_assoc($result)) {

              ?>
              <div class="card">
                <img src="../<?php echo $rows['profile']; ?>" alt="John" style="height:200px; width: 100%" />
                <h1><?php echo $rows['name']; ?></h1>
                <p class="title"><?php echo $rows['email']; ?></p>
                <p><b>Phone No.: </b><?php echo $rows['mobile']; ?></p>
                <p><b>Address: </b><?php echo $rows['address']; ?></p>

                <!-- Trigger the modal with a button -->
                <p>
                  <button type="button" class="btn btn-lg" data-toggle="modal" data-target="#myModal">Update
                    Profile</button>
                </p>
                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                  <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Update Profile</h4>
                      </div>
                      <div class="modal-body">

                        <form method="POST">
                          <div class="form-group">
                            <label>Image:</label><br>
                            <img src="../<?php echo $rows['profile']; ?>" id="output_image" / height="100px" readonly>
                          </div>
                          <div class="form-group">
                            <label for="full_name">Full Name:</label>
                            <input type="hidden" value="<?php echo $rows['id']; ?>" name="owner_id">
                            <input type="text" class="form-control" id="full_name" value="<?php echo $rows['name']; ?>"
                              name="full_name">
                          </div>
                          <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" value="<?php echo $rows['email']; ?>"
                              name="email" readonly>
                          </div>
                          <div class="form-group">
                            <label for="phone_no">Phone No.:</label>
                            <input type="text" class="form-control" id="phone_no" value="<?php echo $rows['mobile']; ?>"
                              name="phone_no">
                          </div>
                          <div class="form-group">
                            <label for="address">Address:</label>
                            <input type="text" class="form-control" id="address" value="<?php echo $rows['address']; ?>"
                              name="address">
                          </div>
                          <hr>
                          <center><button id="submit" name="owner_update" class="btn btn-primary btn-block">Update</button>
                          </center><br>

                        </form>


                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
              <?php
            }
          }
          ?>
        </div>
      </div>
      <div id="menu1" class="tab-pane fade">
        <center>
          <h3>Add Product</h3>
        </center>
        <div class="container">
          <form method="POST" enctype="multipart/form-data">
            <div class="row">
              <div class="mx-5">
                <div class="form-group">
                  <label for="product_name">Product Name:</label>
                  <input type="text" class="form-control" id="product_name" placeholder="Enter Product Name"
                    name="product_name" required>
                </div>

                <div class="form-group">
                  <label for="category">Category:</label>
                  <select class="form-control" name="category" required>
                    <option value="">--Select Category--</option>
                    <option value="Electronics">Electronics</option>
                    <option value="Fashion">Fashion</option>
                    <option value="Home & Garden">Home & Garden</option>
                    <option value="Health & Beauty">Health & Beauty</option>
                    <option value="Sports">Sports</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="brand">Brand:</label>
                  <input type="text" class="form-control" id="brand" placeholder="Enter Brand Name" name="brand"
                    required>
                </div>

                <div class="form-group">
                  <label for="price">Price:</label>
                  <input type="number" class="form-control" id="price" placeholder="Enter Price" name="price" required>
                </div>

                <div class="form-group">
                  <label for="quantity">Quantity:</label>
                  <input type="number" class="form-control" id="quantity" placeholder="Enter Quantity" name="quantity"
                    required>
                </div>

                <div class="form-group">
                  <label for="description">Product Description:</label>
                  <textarea class="form-control" id="description" placeholder="Enter Product Description"
                    name="description" required></textarea>
                </div>

                <div class="form-group">
                  <label><b>Photos:</b></label>
                  <input type="file" name="product_image" class="form-control" required accept="image/*" multiple />
                  <!-- <button type="button" id="add" name="add" class="btn btn-success col-lg-12">Add More Images</button> -->
                </div>

                <hr>
                <div class="form-group">
                  <input type="submit" class="btn btn-primary btn-lg col-lg-12" value="Add Product" name="add_product">
                </div>
              </div>
            </div>
          </form>

          <br><br>
        </div>
      </div>

      <div id="menu2" class="tab-pane fade">
        <center>
          <h3>View Product</h3>
        </center>
        <div class="container-fluid">
          <input type="text" id="myInput" onkeyup="viewProperty()" placeholder="Search..." title="Type in a name">
          <div style="overflow-x:auto;">
            <table id="myTable">
              <tr class="header">
                <th>Id.</th>
                <th>Name</th>
                <th>Price</th>
                <th>Image</th>
                <th>Category</th>
                <th>Brand</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Update</th>
                <th>Delete</th>
              </tr>
              <?php
              $u_email = $_SESSION['email'];
              $sql1 = "SELECT * from merchant where email='$u_email'";
              $result1 = mysqli_query($db, $sql1);

              if (mysqli_num_rows($result1) > 0) {
                while ($rowss = mysqli_fetch_assoc($result1)) {
                  $owner_id = $rowss['id'];

                  $sql = "SELECT * from product where merchant='$owner_id'";
                  $result = mysqli_query($db, $sql);

                  if (mysqli_num_rows($result) > 0) {
                    while ($rows = mysqli_fetch_assoc($result)) {
                      ?>
                      <tr>
                        <td><?php echo $rows['id']; ?></td>
                        <td><?php echo $rows['name']; ?></td>
                        <td><?php echo $rows['price']; ?></td>
                        <td><img src="<?php echo $rows['image']; ?>" alt="<?php echo $rows['name']; ?>" width="50px"></td>
                        <td><?php echo $rows['category']; ?></td>
                        <td><?php echo $rows['brand']; ?></td>
                        <td><?php echo $rows['description']; ?></td>
                        <td><?php echo $rows['quantity']; ?></td>
                        <td>
                          <button type="button" class="btn btn-lg" data-toggle="modal" data-target="#myModalUpdate"
                            data-id="<?php echo $rows['id']; ?>" data-name="<?php echo $rows['name']; ?>"
                            data-price="<?php echo $rows['price']; ?>" data-image="<?php echo $rows['image']; ?>"
                            data-category="<?php echo $rows['category']; ?>" data-brand="<?php echo $rows['brand']; ?>"
                            data-description="<?php echo $rows['description']; ?>"
                            data-quantity="<?php echo $rows['quantity']; ?>">
                            Edit
                          </button>
                        </td>
                        <td>
                          <button type="button" class="btn btn-lg btn-danger" data-toggle="modal" data-target="#myModalDelete"
                            data-id="<?php echo $rows['id']; ?>">
                            Delete
                          </button>
                        </td>
                      </tr>
                      <?php
                    }
                  }
                }
              }
              ?>
            </table>

            <!-- Update Modal -->
            <div class="modal fade" id="myModalUpdate" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update Product</h4>
                  </div>
                  <div class="modal-body">
                    <form method="POST" action="">
                      <input type="hidden" name="product_id" id="product_id">
                      <div class="form-group">
                        <label for="product_name">Name:</label>
                        <input type="text" class="form-control" id="product_name" name="product_name">
                      </div>
                      <div class="form-group">
                        <label for="product_price">Price:</label>
                        <input type="text" class="form-control" id="product_price" name="product_price">
                      </div>
                      <div class="form-group">
                        <label for="product_image">Image:</label>
                        <input type="text" class="form-control" id="product_image" name="product_image" readonly>
                      </div>
                      <div class="form-group">
                        <label for="product_category">Category:</label>
                        <select class="form-control" name="product_category">
                          <option value="">--Select Category--</option>
                          <option value="Electronics">Electronics</option>
                          <option value="Fashion">Fashion</option>
                          <option value="Home & Garden">Home & Garden</option>
                          <option value="Health & Beauty">Health & Beauty</option>
                          <option value="Sports">Sports</option>
                        </select>
                        <!-- <input type="text" class="form-control" id="product_category" name="product_category"> -->
                      </div>
                      <div class="form-group">
                        <label for="product_brand">Brand:</label>
                        <input type="text" class="form-control" id="product_brand" name="product_brand">
                      </div>
                      <div class="form-group">
                        <label for="product_description">Description:</label>
                        <textarea class="form-control" id="product_description" name="product_description"></textarea>
                      </div>
                      <div class="form-group">
                        <label for="product_quantity">Quantity:</label>
                        <input type="number" class="form-control" id="product_quantity" name="product_quantity">
                      </div>
                      <hr>
                      <center><button type="submit" name="update_product"
                          class="btn btn-primary btn-block">Update</button></center><br>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Delete Confirmation Modal -->
            <div class="modal fade" id="myModalDelete" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Confirm Deletion</h4>
                  </div>
                  <div class="modal-body">
                    <p>Are you sure you want to delete this product?</p>
                  </div>
                  <div class="modal-footer">
                    <form method="POST" action="">
                      <input type="hidden" name="delete_product_id" id="delete_product_id">
                      <button type="submit" name="confirm_delete" class="btn btn-danger">Yes, Delete</button>
                    </form>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>

      <div id="menu4" class="tab-pane fade">
        <center>
          <h3>Messages</h3>
        </center>
      </div>
      <div id="menu6" class="tab-pane fade">
        <center>
          <h3>Booked Product</h3>
        </center>
        <div class="container-fluid">
          <input type="text" id="myInput" onkeyup="viewProperty()" placeholder="Search..." title="Type in a name">
          <div style="overflow-x:auto;">
            <table id="myTable">
              <tr class="header">
                <th>Id.</th>
                <th>Name</th>
                <th>Price</th>
                <th>Image</th>
                <th>Category</th>
                <th>Brand</th>
                <th>Description</th>
                <th>Quantity</th>
              </tr>
              <?php
              $u_email = $_SESSION['email'];
              $sql1 = "SELECT * from merchant where email='$u_email'";
              $result1 = mysqli_query($db, $sql1);

              if (mysqli_num_rows($result1) > 0) {
                while ($rowss = mysqli_fetch_assoc($result1)) {
                  $owner_id = $rowss['id'];

                  $sql = "SELECT * from product where merchant='$owner_id' and booked>0";
                  $result = mysqli_query($db, $sql);

                  if (mysqli_num_rows($result) > 0) {
                    while ($rows = mysqli_fetch_assoc($result)) {
                      ?>
                      <tr>
                        <td><?php echo $rows['id']; ?></td>
                        <td><?php echo $rows['name']; ?></td>
                        <td><?php echo $rows['price']; ?></td>
                        <td><img src="<?php echo $rows['image']; ?>" alt="<?php echo $rows['name']; ?>" width="50px"></td>
                        <td><?php echo $rows['category']; ?></td>
                        <td><?php echo $rows['brand']; ?></td>
                        <td><?php echo $rows['description']; ?></td>
                        <td><?php echo $rows['quantity']; ?></td>
                      </tr>
                      <?php
                    }
                  }
                }
              }
              ?>
            </table>
          </div>
        </div>
      </div>

      <div id="menu3" class="tab-pane fade">
        <center>
          <h3>Update Product</h3>
        </center>
        <div class="container-fluid">
          <input type="text" id="myInput" onkeyup="viewProperty()" placeholder="Search..." title="Type in a name">
          <div style="overflow-x:auto;">
            <table id="myTable">
              <tr class="header">
                <th>Id.</th>
                <th>Name</th>
                <th>Price</th>
                <th>Image</th>
                <th>Category</th>
                <th>Brand</th>
                <th>Description</th>
                <th>Quantity</th>
              </tr>
              <?php
              $u_email = $_SESSION['email'];
              $sql1 = "SELECT * from merchant where email='$u_email'";
              $result1 = mysqli_query($db, $sql1);

              if (mysqli_num_rows($result1) > 0) {
                while ($rowss = mysqli_fetch_assoc($result1)) {
                  $owner_id = $rowss['id'];

                  $sql = "SELECT * from product where merchant='$owner_id' and quantity<=0";
                  $result = mysqli_query($db, $sql);

                  if (mysqli_num_rows($result) > 0) {
                    while ($rows = mysqli_fetch_assoc($result)) {
                      ?>
                      <tr>
                        <td><?php echo $rows['id']; ?></td>
                        <td><?php echo $rows['name']; ?></td>
                        <td><?php echo $rows['price']; ?></td>
                        <td><img src="<?php echo $rows['image']; ?>" alt="<?php echo $rows['name']; ?>" width="50px"></td>
                        <td><?php echo $rows['category']; ?></td>
                        <td><?php echo $rows['brand']; ?></td>
                        <td><?php echo $rows['description']; ?></td>
                        <td><?php echo $rows['quantity']; ?></td>
                      </tr>
                      <?php
                    }
                  }
                }
              }
              ?>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    $('#myModalUpdate').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); // Button that triggered the modal
      var id = button.data('id');
      var name = button.data('name');
      var price = button.data('price');
      var image = button.data('image');
      var category = button.data('category');
      var brand = button.data('brand');
      var description = button.data('description');
      var quantity = button.data('quantity');

      // Update the modal's content
      var modal = $(this);
      modal.find('#product_id').val(id);
      modal.find('#product_name').val(name);
      modal.find('#product_price').val(price);
      modal.find('#product_image').val(image);
      modal.find('#product_category').val(category);
      modal.find('#product_brand').val(brand);
      modal.find('#product_description').val(description);
      modal.find('#product_quantity').val(quantity);
    });
    $('#myModalDelete').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); // Button that triggered the modal
      var id = button.data('id'); // Get product ID
      var modal = $(this);
      modal.find('#delete_product_id').val(id); // Set the ID in the hidden input
    });
  </script>
</body>

</html>