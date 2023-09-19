<?php require APPROOT . '/views/inc/header.php'; ?>
<?php if(!empty($_SESSION['Message'])) : ?>
  <p class="alert alert-success"><?php echo $_SESSION['Message']; $_SESSION['Message'] = null; ?></p>
<?php endif ?>
<section class="login-container ">
  <div class="row">
    <div class="col col-12 login-form-col">
    <h2 class="text-center mb-3 mt-3 pt-3">LOGIN</h2>
    <?php if (!empty($data['empty_field_err'])): ?>
      <span class="text-danger"><?php echo $data['empty_field_err'] ?></span>
<?php endif; ?>
    <div class="form-container">
    <form action="<?php echo URLROOT; ?>/users/login" method="post">
      <div class="form-group">
        <label for="loginMethod">Username /Email</label>
      <input name="loginMethod" type="text" value="<?php echo $data['loginMethod'];?>" placeholder="Username/Email" id="loginMethod" class="form-control">
      </div>
     
      <div class="form-group">
        <label for="password">Password</label>
      <input name="password" type="password" value="<?php echo $data['password'];?>" placeholder="Password" id="password" class="form-control">
      </div>
      
      <div class="row">
                        <div class="col">
                        <input type="submit" value="Login" class="btn btn-success btn-block">
                        </div>
                        <div class="col text-center">
                            <a href="<?php echo URLROOT; ?>/users/register"  class="btn redirect-link"> Create an account | Register </a>
                        </div>
                    </div>
      
  </form>
  </div>
    </div>
  </div>
  </section>
  
<?php require APPROOT . '/views/inc/footer.php'; ?>