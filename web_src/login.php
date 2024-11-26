<?PHP
include("head.php");
?>
<body>
    <?PHP
    include("header.php");
    include("navbar1.php");
    ?>
      <div id="intro" class="section-text col d-flex justify-content-center align-items-center" style="height: 900;">
        <div class="white-box text-center" style="background-color: white; padding: 70px; width: 500px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
          <div class="container mt-5">
            <h2 class="text-center">Login:</h2>

            <form action="../data_src/api/user/login.php" method="POST">
              <div class="mb-3">
                <label for="username" class="form-label"><strong>Username</strong></label>
                <input type="text" class="form-control" id="username" name="username" required>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label"><strong>Password</strong></label>
                <input type="password" class="form-control" id="password" name="password" required>
              </div>
              <button type="submit" class="btn btn-primary">Login</button>
            </form>
            <br><br><br>
            <p>New user? 
              <a href="../data_src/api/user/create.php">
                  <button type="button">Create an Account</button>
              </a>
          </p>
          </div>
        </div>
      </div>
    
</body>

<?PHP
include("footer.php");
?>