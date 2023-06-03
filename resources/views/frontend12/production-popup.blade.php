<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>billboard</title>
    <link href="./asset/css/header.css" rel="stylesheet">
    <link href="./asset/css/form.css" rel="stylesheet">
    <link href="./asset/css/browser.css" rel="stylesheet"/>
    <link href="./asset/css/bootstrap.min.css" rel="stylesheet" />
    <link href="./asset/css/home.css" rel="stylesheet" />
    <link href="./asset/css/user-account.css" rel="stylesheet" />
    <link href="./asset/css/common.css" rel="stylesheet" />
    <link href="./asset/css/mobile-app.css" rel="stylesheet" />
    <link href="./asset/css/responsive.css" rel="stylesheet" />
    <link rel="stylesheet" href="./asset/css/landing-related.css">
    <link rel="stylesheet" href="./asset/css/registration-popup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="./asset/js/bootstrap.min.js"></script>
    <script src="./asset/js/bootstrap.bundle.js"></script>
    <script src="./asset/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>
<body>
    <div class="modal fade modal-lg" id="production">
        <div class="modal-dialog">
          <div class="modal-content" id="upload-modal">
      
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title" style="font-weight: 600;">Production</h4>
            </div>
      
            <!-- Modal body -->
            <div class="modal-body identity">
              <div class="login-identity-container">
                <div class="row">
                    <div class="col-md-6 text-center">
                        <div class="form-check mb-5">
                            <input class="form-check-input" type="radio" name="flexRadioDefault2" id="flexRadioDefault2">
                            <label class="form-check-label" for="flexRadioDefault2">I print creatives for billboards</label>
                        </div>
                        <img src="./asset/images/production1.png" class="mt-3">
                    </div>
                    <div class="col-md-6 text-center">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault2" id="flexRadioDefault2">
                            <label class="form-check-label" for="flexRadioDefault2">I flight creatives on billboards.</label>
                        </div>
                        <img src="./asset/images/production2.png"  class="mt-3">
                    </div>
                </div>
                <div class="row mt-3">
                  <div class="col-md-6 text-center">
                    <p>A printer will provide printing service to advertisers.</p>
                  </div>
                  <div class="col-md-6 text-center">
                    <p>A flighter will provide flighting service to advertisers.</p>
                  </div>
                </div>
              </div>
            </div>
      
              <div class="join-modal-footer">
                <div class="row mt-3 mb-3">
                  <div class="col-md-12 text-center btn-wrap">
                    <button type="button" class="button common-form-btn">Next</button></a>                            
                  </div>
                </div>
                <div class="row btn-sign-wrap mb-3">
                  <div class="col-md-12">
                    <div class="modal-reverse-heading">
                      <h6><img src="./asset/images/icon/double-reverse-arrow.png">Back</h6>
                    </div>
                  </div>
                </div>
              </div>
      
          </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $("#production").modal('show');
        });
    </script>
</body>
</html>