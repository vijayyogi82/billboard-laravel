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
    <link rel="stylesheet" href="asset/css/registration.css">
    <link rel="stylesheet" href="asset/css/landing-related.css">
</head>

<body>
    <div class="modal modal-lg fade d-block show" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="true"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container" id="modal-full-container">
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <img src="./asset/images/Rectangle16.png" class="user-login-col-img">
                            </div>
                            <div class="col-md-8 col-sm-12">
                                <div class="login-form d-flex align-items-center">
                                    <div class="form-wrap">
                                        <div class="title">
                                            <h1 style="margin-top: 45px;">Welcome</h1>
                                            <p>Please login to your account</p>
                                        </div>
                                        <ul>
                                            <li>
                                                <label><img src="./asset/images/phone.svg"/>Mobile Number</label>
                                                <div class="row">
                                                    <div class="col-2 country-code">
                                                        <h6>+91</h6>
                                                    </div>
                                                    <div class="col-10 input-country-code">
                                                    <input type="number" placeholder="9999999999" />
                                                    </div>
                                                </div>
                                            </li>
                                            <li><span>OR</span></li>
                                            <li>
                                                <label><img src="./asset/images/email.svg"/>E-Mail Address</label>
                                                <input type="email" placeholder="Billboard_user@gmail.com" />
                                            </li>
                                            <li><span>OR</span></li>
                                            <div class="user-login-code" style="height: 42px;">
                                                <a href="sub-login"><button type="button" class="button common-form-btn sent-otp" id="btn-common-form">Enter Login Code</button></a>
                                            </div>
                                            <div class="row pt-1 pb-1 ps-3 pe-3 registration-type">
                                                <label class="differentiate-label"><img src="asset/images/exclamation.png">Login code is generated by your Super User. 
                                                    This is only for users who are part of a team.</label>
                                            </div>
                                            <li>
                                                <div class="btn-wrap">
                                                    <a href="otp-message" ><button type="button" class="button common-form-btn sent-otp">Next<img src="asset/images/icon/single-arrow.svg" style="width: 13px;"/></a></button>
                                                    <p>Don’t have an account?</p>
                                                    <a href="sign-up-mediaowner">Create Account</a>
                                                </div>
                                            </li>                                       
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
</body>

</html>