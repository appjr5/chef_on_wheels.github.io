<?php include('layout/dashboard.php'); ?>
<!-- Content -->

<?php
// Check if the success parameter is set in the query string
if (isset($_GET['success'])) {
    echo '<div class="alert alert-success" role="alert">' . htmlspecialchars($_GET['success']) . '</div>';
}

// Check if the error parameter is set in the query string
if (isset($_GET['error'])) {
    echo '<div class="alert alert-danger" role="alert">' . htmlspecialchars($_GET['error']) . '</div>';
}
?>

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
            <th>Visibility</th>
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
            <td>' . $row['visibility'] . '</td>
            <td>
                <div class="btn-group" role="group">
                    <a class="btn btn-primary" href="actions/visibility.php?product_id=' . $row['product_id'] . '">Toggle Visibility</a>
                    <a class="btn btn-danger" href="#" onclick="confirmDelete(' . $row['product_id'] . ')">Delete</a>
                </div>
            </td>
        </tr>';
        }
        ?>
        <!-- Add more rows for additional users -->
    </tbody>
</table>

<script>
function confirmDelete(productId) {
    if (confirm('Are you sure you want to delete this product?')) {
        window.location.href = 'actions/delete.php?product_id=' + productId;
    }
}
</script>

<?php include('layout/footer.php'); ?>
