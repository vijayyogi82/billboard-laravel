<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>billboard</title>
  <link href="./asset/css/bootstrap.min.css" rel="stylesheet" />
  <link href="./asset/css/modal.css" rel="stylesheet" />
  <link href="./asset/css/popup.css" rel="stylesheet"/>
  <script src="./asset/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="asset/css/responsive.css">
  <link rel="stylesheet" href="asset/css/mobile-app.css">
  <link rel="stylesheet" href="asset/css/User-login.css">
  <link rel="stylesheet" href="asset/css/common.css">
  <link rel="stylesheet" href="asset/css/all.css">
  <link rel="stylesheet" href="asset/css/registration.css">
  <link rel="stylesheet" href="asset/css/landing-related.css">
</head>

<body>
  <div class="modal fade show" id="enterLoginCode" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" id="integrate-enter-login-modal-content">
        <div class="modal-header">
          <h5 class="modal-title center" id="staticBackdropLabel">SUB USER LOGIN</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="sub-header">
          <h5 class="sub-header-first-row text-center">Please enter login code.</h5>
          <h5 class="sub-header-second-row text-center ">(provided by your Super User)</h5>
        </div>
        <div class="modal-body">
          <div class="row pt-1 pb-1 registration-type">
            <label class="differentiate-label"><img src="asset/images/exclamation.png">Only Applicable for people registering under another user. If you are not affiliated to any super user, please go back.</label>
          </div>
            <form>
                <div class="mb-3 mt-3">
                    <label for="formGroupExampleInput" class="form-label"><img src="asset/Images/user-name.png" class="login-user">Name</label>
                    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Enter your full name">
                </div>
                <div class="mb-4 mt-5">
                    <label for="formGroupExampleInput2" class="form-label"><img src="asset/Images/user-code.png" class="login-user">Code</label>
                    <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Enter Code given by your Super User">
                </div>
            </form>
        </div>
        <div class="modal-footer text-center">
          <button type="button" id="selectNext" class="button common-form-btn">Next<img src="asset/images/icon/single-arrow.svg" height="10px"/></button>
        </div>
        <div class="modal-reverse-heading">
        <h6 id="back-to-previous"><img src="asset/images/icon/double-reverse-arrow.png" class="login-reverse" >Back</h6>
        </div>
      </div>
    </div>
  </div>


  <script src="asset/Js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="asset/Js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function(){
        $("#enterLoginCode").modal('show');
    });
</script>

</body>
</html>