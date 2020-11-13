<?php require_once 'controllers/authController.php'; ?>

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

    <title>Login</title>
  </head>
  <body>
    <div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
          <h1 class="mt-5">Welcome to Appledore!</h1>
          <p>Sign In to be able to get information about all users!</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 offset-md-4 form-div">
          <form action="login.php" method="post">
            <h3 class="text-center">Login</h3>

            <?php if(count($errors) > 0): ?>
              <div class="alert alert-danger">
                <?php foreach($errors as $error): ?>
                  <li><?php echo $error; ?></li>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>

            <div class="form-group">
              <label for="email">Email</label>
              <input
                type="text"
                name="email"
                value="<?php echo $email; ?>"
                class="form-control form-control-lg"
              />
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input
                type="password"
                name="password"
                class="form-control form-control-lg"
              />
            </div>
            <div class="form-group">
              <button
                type="submit"
                name="login-btn"
                class="btn btn-primary btn-block btn-lg"
              >
                Log In
              </button>
            </div>

            <p class="text-center">
              Not yet a member?<a href="signup.php"> Sign Up</a>
            </p>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
