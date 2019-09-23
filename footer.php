<footer class="footer">
  <div class="container">
    <p class="text-muted">
      Copyright 2019. All Right Reserved. 
      <a class="pull-right" href="privacy.php">Privacy Policy</a>
    </p>
  </div>
</footer>

<div id="myCustomerLogin" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <b>Login account customer</b>
      </div>
      <div class="modal-body">
        <form class="form-vertical" action="/eflats3/config/logincustomer.php" method="post">
          <div class="form-group">
            <label>Username</label>
            <input class="form-control" type="text" name="username" value="" placeholder="username" required />
          </div>
          <div class="form-group">
            <label>Password</label>
            <input class="form-control" type="password" name="password" value="" placeholder="password" required />
          </div>
          <div class="form-group">
            <input class="btn btn-block btn-success" type="submit" name="submit" value="LOGIN" />
          </div>
          <div class="form-group">
            <a href="/eflats3/forgotpassword.php" style="text-decoration: none;">Forgot password?</a>
          </div>

          <fb:login-button 
            scope="public_profile,email"
            onlogin="checkLoginState();">
          </fb:login-button>

        </form>
      </div>
    </div>
  </div>
</div>

<div id="myAdminLogin" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <b>Login account admin</b>
      </div>
      <div class="modal-body">
        <form class="form-vertical" action="/eflats3/config/loginadmin.php" method="post">
          <div class="form-group">
            <label>Username</label>
            <input class="form-control" type="text" name="username" value="" placeholder="username" required />
          </div>
          <div class="form-group">
            <label>Password</label>
            <input class="form-control" type="password" name="password" value="" placeholder="password" required />
          </div>
          <div class="form-group">
            <input class="btn btn-block btn-success" type="submit" name="submit" value="LOGIN" />
          </div>
          <div class="form-group">
            <a href="/eflats3/forgotpassword.php" style="text-decoration: none;">Forgot password?</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div id="myFormRegistration" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <b>Please fill below</b>
      </div>
      <div class="modal-body">
        <form class="form-vertical" action="/eflats3/config/registration.php" method="post">
          <div class="form-group">
            <label>Email</label>
            <input class="form-control" type="text" name="email" value="" placeholder="email" required />
          </div>
          <div class="form-group">
            <label>First Name</label>
            <input class="form-control" type="text" name="firstname" value="" placeholder="firstname" required />
          </div>
          <div class="form-group">
            <label>Last Name</label>
            <input class="form-control" type="text" name="lastname" value="" placeholder="lastname" required />
          </div>
          <div class="form-group">
            <label>Extension</label>
            <input class="form-control" type="text" name="extension" value="" placeholder="extension" required />
          </div>
          <div class="form-group">
            <label>Username</label>
            <input class="form-control" type="text" name="username" value="" placeholder="username" required />
          </div>
          <div class="form-group">
            <label>Password</label>
            <input id="regPassword" class="form-control" type="password" name="password" value="" placeholder="password" required />
          </div>
          <div class="form-group">
            <label>Confirm Password</label>
            <input id="regConfirmPassword" class="form-control" type="password" name="confirmPassword" value="" placeholder="confirm password" required />
          </div>
          <div id="btnRegister" class="form-group">
            <input class="btn btn-block btn-success" type="submit" name="submit" value="REGISTER" />
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div id="myForgotPassword" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <b>Enter your email</b>
      </div>
      <div class="modal-body">
        <form class="form-vertical" action="" method="post">
          <div class="form-group">
            <label>Email</label>
            <input class="form-control" type="text" name="email" value="" placeholder="email" required />
          </div>
          <div class="form-group">
            <input class="btn btn-block btn-success" type="submit" name="submit" value="SEND" />
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="assets/js/vendor/jquery.min.js"><\/script>')</script>
<script src="dist/js/bootstrap.min.js"></script>

<script src="assets/js/ie10-viewport-bug-workaround.js"></script>
<script type="text/javascript">
  var baseUrlOrigin = window.location.origin;

  $(function(){
    $('#btnRegister').hide();
    $('#btnUpdateRegister').hide();

    $('#txtSearching').on('keydown', function(e) {
      if(e.key == 'Enter') {
        var keyword = $(this).val();
        $.ajax({
          url: baseUrlOrigin+'/eflats3/api/indexsearch.php',
          type: 'POST',
          data: 'keyword='+keyword,
          success: function(result) {
            var html = "<h4>You Search: '"+keyword+"'</h4>";
            var jsonParse = JSON.parse(result);
            jsonParse.result.forEach( function(element, index) {
              html += '<div class="row">';
                html +='<div class="col-sm-6 col-md-3">';
                    html +='<div class="thumbnail">';
                      html +='<img src="/eflats3/img/'+element.main_image+'" alt="Title">';
                      html +='<div class="caption">';
                        html +='<h3>'+element.property_title+'</h3>';
                        html +='<p>';
                          html +='<b>Price : </b> '+element.price+'<br>';
                          html +='<b>Size : </b> '+element.size+'<br>';
                          html +='<b>Phone : </b> '+element.owner_phone+'<br>';
                        html +='</p>';
                        html +='<p>';
                          html +='<a href="#" class="btn btn-primary" role="button">More</a>&nbsp;';
                            html +='<a href="/eflats3/config/addfavorite.php?item='+element.id+'" class="btn btn-default" role="button">Favorite</a>';
                        html +='</p>';
                      html +='</div>';
                    html +='</div>';
              html += '</div>';
            });
            $('#resultSearch').html(html);
          }
        })
      }
    });

    $('#regConfirmPassword').on('keyup', function(){
      var pass = $('#regPassword').val();
      if(pass == $(this).val()){
        $('#btnRegister').show();
      } else {
        $('#btnRegister').hide();
      }
    })
    $('#updateConfirmPassword').on('keyup', function(){
      var pass = $('#updatePassword').val();
      if(pass == $(this).val()){
        $('#btnUpdateRegister').show();
      } else {
        $('#btnUpdateRegister').hide();
      }
    })

    $('#btnDeactiveAccount').on('click', function(e) {
      e.preventDefault();
      var konfirm = confirm('Are you sure to deactive this account?');
      if(konfirm) {
        alert('Account has been deactive.');
        location.href = '/eflats3/config/deactive.php?action=yes';
      } else {
        alert('Action Canceled.');
      }
    })
  })
</script>

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '716185372140309',
      cookie     : true,
      xfbml      : true,
      version    : 'v4.0'
    });
      
    FB.AppEvents.logPageView();   
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));

  var baseUrl = window.location.origin;

  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      FB.api('/me', {fields: 'name,email' }, function(response) {
        $.ajax({
          url: baseUrl+'/eflats3/api/login.php',
          data: 'name='+response.name+'&email='+response.email,
          type: 'POST',
          success: function(res) {
            // console.log(res)
            window.location.reload();
          }
        })
      });
    });
  }
</script>
