<footer class="footer">
  <div class="container">
    <p class="text-muted">
      Copyright 2019. 
      <a class="pull-right" href="privacy.php">Privacy Policy</a>
    </p>
  </div>
</footer>

<!-- modal for message -->
<div id="myFirstLogin" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <b>Attention</b>
      </div>
      <div class="modal-body">
        <p id="messageAction">You must be login first.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- modal for form login level customer -->
<div id="myCustomerLogin" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <b>Login account customer</b>
      </div>
      <div class="modal-body">
        <form class="form-vertical" action="/<?= $BASEAPP;?>/config/logincustomer.php" method="post">
          <div class="form-group">
            <label>Username</label>
            <input class="form-control" type="text" name="username" value="" placeholder="username" required />
          </div>
          <div class="form-group">
            <label>Password</label>
            <input class="form-control" type="password" name="password" value="" placeholder="password" required />
          </div>
          <div class="form-group">
            <input class="btn btn-success" type="submit" name="submit" value="LOGIN" />
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
          <div class="form-group">
            <a href="/<?= $BASEAPP;?>/forgotpassword.php" style="text-decoration: none;">Forgot password?</a>
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

<!-- modal for form login level admin -->
<div id="myAdminLogin" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <b>Login account admin</b>
      </div>
      <div class="modal-body">
        <form class="form-vertical" action="/<?= $BASEAPP;?>/config/loginadmin.php" method="post">
          <div class="form-group">
            <label>Username</label>
            <input class="form-control" type="text" name="username" value="" placeholder="username" required />
          </div>
          <div class="form-group">
            <label>Password</label>
            <input class="form-control" type="password" name="password" value="" placeholder="password" required />
          </div>
          <div class="form-group">
            <input class="btn btn-success" type="submit" name="submit" value="LOGIN" />
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
          <div class="form-group">
            <a href="/<?= $BASEAPP;?>/forgotpassword.php" style="text-decoration: none;">Forgot password?</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- modal for form registration new user level customer -->
<div id="myFormRegistration" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <b>Please fill below</b>
      </div>
      <div class="modal-body">
        <form class="form-vertical" action="/<?= $BASEAPP;?>/config/registration.php" method="post">
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
          <!-- <div class="form-group">
            <label>Extension</label>
            <input class="form-control" type="text" name="extension" value="" placeholder="extension" required />
          </div> -->
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
          <div class="form-group">
            <input id="btnRegister" class="btn btn-success" type="submit" name="submit" value="REGISTER" />
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- modal for form confirmation deactive customer -->
<div id="myModalConfirmDeactive" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <b>Confirmation</b>
      </div>
      <div class="modal-body">
        <p id="lblConfirmDeactive"></p>
      </div>
      <div class="modal-footer">
        <a id="hrefConfirmDeactive" href="#" class="btn btn-success">Yes Deactive</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="assets/js/vendor/jquery.min.js"><\/script>')</script>
<script src="dist/js/bootstrap.min.js"></script>

<script src="assets/js/ie10-viewport-bug-workaround.js"></script>
<script type="text/javascript">
  // get base url from address bar
  var baseUrlOrigin = window.location.origin;

  $(function(){
    var urlParams = new URLSearchParams(window.location.search);

    // to display a popup with query message
    // ex index.php?message=xxxxxx
    // xxxxxx mean is the message
    if(urlParams.has('message')) {
      console.log(urlParams.get('message'));
      $('#messageAction').html(urlParams.get('message'));
      $('#myFirstLogin').modal('show');
    }

    // by default button register and update password hidden
    $('#btnRegister').hide();
    $('#btnUpdateRegister').hide();
    
    // for form update password update password field disabled
    // you must be filled in current password
    $('#updatePassword').attr('disabled', true);
    $('#updateConfirmPassword').attr('disabled', true);

    // for searching integrated with elasticsearch
    $('#btnApply').on('click', function() {
      var statusLogin = $('#statusLogin').val();
      var keywords = $('#txt_keywords').val();
      var price = $('#txt_price').val();
      var bedroom = $('#txt_bedroom').val();
      var bathroom = $('#txt_bathroom').val();
      var furnished = $('input[name=furnished]:checked').val();
      var petFriendly = $('input[name=pet_friendly]:checked').val();

      var formData = {
        keywords: keywords, price: price, bedroom: bedroom, 
        bathroom: bathroom, furnished: furnished, petFriendly: petFriendly
      };

      // access ajax for get result for elasticsearch after that 
      // we rendered to html
      $.ajax({
        url: baseUrlOrigin+'/<?= $BASEAPP;?>/api/indexmulti.php',
        type: 'GET',
        data: formData,
        success: function(result) {
          var jsonParse = JSON.parse(result);
          var html = "";
          for (var i = 0; i < jsonParse.hits.total; i++) {
            var element = jsonParse.hits.hits[i]._source;
            var expImg = element.main_image.split(',');
            html +='<div class="col-sm-6 col-md-3">';
              html +='<div class="thumbnail">';
                html +='<img src="/<?= $BASEAPP;?>/img/'+expImg[0]+'" alt="Title">';
                html +='<div class="caption">';
                  html +='<h3>'+element.property_title+'</h3>';
                  html +='<p>';
                    html +='<b>Price : </b> '+element.price+'<br>';
                    html +='<b>Size : </b> '+element.size+'<br>';
                    html +='<b>Phone : </b> '+element.owner_phone+'<br>';
                  html +='</p>';
                  html +='<p>';
                    html +='<a href="/<?= $BASEAPP;?>/moreproperties.php?id='+element.id+'" class="btn btn-primary" role="button">More</a>&nbsp;';
                    if(statusLogin == 'true') {
                      html +='<a href="/<?= $BASEAPP;?>/config/addfavorite.php?item='+element.id+'" class="btn btn-default" role="button">Favorite</a>';
                    } else {
                      html +='<a href="#" data-toggle="modal" data-target="#myFirstLogin" class="btn btn-default" role="button">Favorite</a>';
                    }
                  html +='</p>';
                html +='</div>';
              html +='</div>';
            html +='</div>';
          }
          $('#searchResult').html(html);
          $('#searchResultCount').html('Result '+jsonParse.hits.total);
        }
      })
    })

    // at register if password not match with confirm password
    // button register not showing, vice versa
    $('#regConfirmPassword').on('keyup', function(){
      var pass = $('#regPassword').val();
      if(pass == $(this).val()){
        $('#btnRegister').show();
      } else {
        $('#btnRegister').hide();
      }
    })

    // this action for process check password before you update the password
    $('#currentPassword').on('keyup', function() {
      var curr = $(this).val();
      $.ajax({
        url: baseUrlOrigin+'/<?= $BASEAPP;?>/api/checkpass.php',
        type: 'POST',
        data: 'pass='+curr,
        success: function(result) {
          if(result) {
            $('#updatePassword').removeAttr('disabled');
            $('#updateConfirmPassword').removeAttr('disabled');
          } else {
            $('#updatePassword').attr('disabled', true);
            $('#updateConfirmPassword').attr('disabled', true);
          }
        }
      })
    })

    // modal for action deactive account user customer
    $('#btnDeactiveAccount').on('click', function(e) {
      e.preventDefault();
      $('#lblConfirmDeactive').html('Are you sure to deactive this account?');
      $('#hrefConfirmDeactive').attr('href', '/<?= $BASEAPP;?>/config/deactive.php?action=yes');
      $('#myModalConfirmDeactive').modal('show');
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
        if(response.hasOwnProperty('email') && response.hasOwnProperty('name')) {
          // process for sign in with facebook
          $.ajax({
            url: baseUrl+'/<?= $BASEAPP;?>/api/login.php',
            data: 'name='+response.name+'&email='+response.email,
            type: 'POST',
            success: function(res) {
              window.location.reload();
            }
          })
        } else {
          console.log('ERROR: ', response);          
        }
      });
    });
  }
</script>
