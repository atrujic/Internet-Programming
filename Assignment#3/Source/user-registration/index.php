<?php 
  require_once 'controllers/authController.php'; 
  require_once 'controllers/userController.php';
  // redirect to login page if user is not logged in
  if(!isset($_SESSION['id'])) {
    header('location: login.php');
    exit();
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- BOOTSTRAP CSS CDN -->
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="style.css">

    <title>Home</title>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-4 offset-md-4 form-div text-center">
          <?php if(isset($_SESSION['message'])): ?>
            <div class="alert <?php echo $_SESSION['alert-class']; ?>">
              <?php 
                echo $_SESSION['message']; 
                unset($_SESSION['message']);
                unset($_SESSION['alert-class']);
                ?>
            </div>
          <?php endif; ?>

          <h3>Welcome, <?php echo $_SESSION['name']; ?></h3>

          <a href="index.php?logout=1" class="btn btn-sm bg-light text-danger text-decoration-none">Logout</a>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 offset-md-4 text-center">
            <form action="index.php" method="get">
              <div class="form-group">
                <button
                  type="submit"
                  name="getUsers-btn"
                  class="btn btn-primary btn-lg"
                >
                  Get Users
                </button>
              </div>
            </form>
        </div>
      </div>
      <?php if(count($users) > 0): ?>
        <div class="row">
          <div class="col-md-6 offset-md-3 mt-5">
            <table class="table table-dark">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach($users as $user): ?>
                <tr>
                  <th scope="row"><?php echo $user->id; ?></th>
                  <td><?php echo $user->name; ?></td>
                  <td><?php echo $user->email; ?></td>
              </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </body>
</html>
