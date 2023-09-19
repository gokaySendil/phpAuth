<?php require APPROOT . '/views/inc/header.php'; ?>

  <section class="register-container ">
  <div class="row">
    <div class="col col-12  ">
    <h2 class="text-center mb-3 mt-3 pt-3">REGISTER</h2>
    <?php if (!empty($data['empty_field_err'])): ?>
      <span class="text-danger"><?php echo $data['empty_field_err'] ?></span>
<?php endif; ?>
    <div class="form-container">
    <form action="<?php echo URLROOT; ?>/users/register" method="post">
      <div class="form-group">
        <label for="username">Username</label>
      <input name="username" type="text" value="<?php echo $data['username'];?>" placeholder="Username" id="username" class="form-control">
      </div>
      <div class="form-group">
        <label for="email">Email</label>
      <input name="email" type="email" value="<?php echo $data['email'];?>" placeholder="Email" id="email" class="form-control">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
      <input name="password" type="password" value="<?php echo $data['password'];?>" placeholder="Password" id="password" class="form-control">
      </div>
      <div class="form-group">
        <label for="register-password-confrim">Confrim Password</label>
      <input name="register-password-confrim" type="password" value="<?php echo $data['register-password-confrim'];?>" placeholder="Confirm Password" id="register-password-confrim" class="form-control">
      </div>
      
      <div class="row">
                        <div class="col">
                        <input type="submit" value="Register" class="btn btn-success btn-block">
                        </div>
                        <div class="col">
                            <a href="<?php echo URLROOT; ?>/users/login"  class="btn redirect-link"> Have an account? Login </a>
                        </div>
                    </div>
      
  </form>
  </div>
    </div>
    
  </div>
  </section>
<?php require APPROOT . '/views/inc/footer.php'; ?>