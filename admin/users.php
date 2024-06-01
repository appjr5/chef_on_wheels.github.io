<?php include('layout/dashboard.php'); ?>
<!-- Content -->

          <h2>User Table</h2>
          <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
                        include_once('../config.php');
                        
                        $sql='SELECT * FROM users';

                        $result=mysqli_query($conn,$sql);
                        
                        $row=mysqli_fetch_all($result,MYSQLI_ASSOC);

                        foreach($row as $rows){
                          echo '<tr>
                            <td>'.$rows['user_id'].'</td>
                            <td>'.$rows['name'].'</td>
                            <td>'.$rows['email'].'</td>
                            <td>'.$rows['role'].'</td>
                            <td>
                        <div class="btn-group" role="group">
                            <a class="btn btn-primary" href="#">Edit</a>
                            <a class="btn btn-danger" href="actions/delete.php?user_id=' . $rows['user_id'] . '">Delete</a>
                        </div>
                        </td>
                              </div>
                            </td>
                          </tr>';
                        }
              ?>
              <!-- Add more rows for additional users -->
            </tbody>
          </table>
        
  <!-- Bootstrap JS (Optional) -->
 

<?php include('layout/footer.php'); ?>