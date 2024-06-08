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
    <h2 class="mt-4 mb-4">User Form</h2>
   <form action="../add_user.php" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="name">User Name:</label>
        <input type="text" class="form-control" id="name" name="name" required>
      </div>
      <div class="form-group">
        <label for="email">User email:</label>
        <input type="text" class="form-control" id="email" name="email"  required>
      </div>
      <div class="form-group">
        <label for="phone">phone:</label>
        <input type="number" class="form-control" id="phone" name="phone" required>
      </div>
      <div class="form-group">
        <label for="phone">zip code:</label>
        <input type="number" class="form-control" id="zip_code" name="zip_code" required>
      </div>
      <div class="form-group">
        <label for="role">Role:</label>
        <select class="form-control" id="role" name="role" required>
          <option value="">Select Type</option>
          <option value="admin">admin</option>
          <option value="delivery">delivery</option>
          <option value="cook">cook</option>
          <!-- Add more options as needed -->
        </select>
      </div>
      <div class="form-group">
        <label for="UserImage">staff Image:</label>
        <input type="file" class="form-control-file" id="UserImage" name="UserImage" accept="image/*" onchange="previewImage(event)" required>
        <img id="imgPreview" src="#" alt="User Image Preview" class="mt-2" style="max-width: 200px; display: none;">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</body>
</div>
</div>
<?php include('layout/footer.php'); ?>
