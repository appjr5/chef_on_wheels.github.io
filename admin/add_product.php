<?php include('layout/dashboard.php'); ?>
  <script>
    // Function to preview image before uploading
    function previewImage(event) {
      var reader = new FileReader();
      reader.onload = function() {
        var imgPreview = document.getElementById('imgPreview');
        imgPreview.src = reader.result;
        imgPreview.style.display = 'block'; // Ensure the image preview is visible
      }
      reader.readAsDataURL(event.target.files[0]);
    }
  </script>
</head>
<body>
  <div class="container">
    <h2 class="mt-4 mb-4">Product Form</h2>
   <form action="backend/add_product.php" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="productName">Product Name:</label>
        <input type="text" class="form-control" id="productName" name="productName" required>
      </div>
      <div class="form-group">
        <label for="productDescription">Product Description:</label>
        <textarea class="form-control" id="productDescription" name="productDescription" rows="3" required></textarea>
      </div>
      <div class="form-group">
        <label for="price">Price:</label>
        <input type="number" class="form-control" id="price" name="price" required>
      </div>
      <div class="form-group">
        <label for="productType">Product Type:</label>
        <select class="form-control" id="productType" name="productType" required>
          <option value="">Select Type</option>
          <option value="food">Food</option>
          <option value="drink">Drink</option>
          <option value="dessert">Dessert</option>
          <!-- Add more options as needed -->
        </select>
      </div>
      <div class="form-group">
        <label for="productImage">Product Image:</label>
        <input type="file" class="form-control-file" id="productImage" name="productImage" accept="image/*" onchange="previewImage(event)" required>
        <img id="imgPreview" src="#" alt="Product Image Preview" class="mt-2" style="max-width: 200px; display: none;">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</body>
</div>
</div>
<?php include('layout/footer.php'); ?>
