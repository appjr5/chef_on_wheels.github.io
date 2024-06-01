<?php include('layout/dashboard.php'); ?>
<!-- Content -->
<div class="col-md-9">
    <div class="content">
        <h2>User Table</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Type</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once('../config.php');

                $sql = 'SELECT * FROM product';

                $result = mysqli_query($conn, $sql);

                $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

                foreach ($rows as $row) {
                    echo '<tr>
                    <td>' . $row['product_id'] . '</td>
                    <td>' . $row['product_name'] . '</td>
                    <td><img src="upload/' . $row['product_image'] . '" alt="Product Image" style="max-width: 50px; border-radius: 50%;"></td>
                    <td>' . $row['product_description'] . '</td>
                    <td>' . $row['product_type'] . '</td>
                    <td>' . $row['price'] . '</td>
                    <td>
                        <div class="btn-group" role="group">
                            <a class="btn btn-primary" href="#">Edit</a>
                            <a class="btn btn-danger" href="actions/delete.php?product_id=' . $row['product_id'] . '">Delete</a>
                        </div>
                    </td>
                </tr>';
                }
                ?>
                <!-- Add more rows for additional users -->
            </tbody>
        </table>
    </div>
</div>
<!-- Bootstrap JS (Optional) -->

<?php include('layout/footer.php'); ?>
