<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>billboard</title>
    <link href="./asset/css/bootstrap.min.css" rel="stylesheet" />
    <link href="./asset/css/modal.css" rel="stylesheet" />
    <link href="./asset/css/popup.css" rel="stylesheet" />
    <script src="./asset/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="asset/css/mobile-app.css">
    <link rel="stylesheet" href="asset/css/landing-related.css">
</head>

<body>
    <div class="modal modal-m fade d-block show" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="true"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <div class="account-verification">
                            <h1>Account Verification</h1>
                            <em>With OTP</em>
                            
                        </div>
                        <div class="box-container">
                            <div class="call-box1">
                                <img src="./asset/images/🦆 icon _whitetelephone phone mobile cellphone_.svg">
                                <p>selected</p>
                            </div></a>
                            <a href="./otp-message.html"><div class="mail-box">
                                <img src="./asset/images/🦆 icon _bemail_.svg">
                                
                            </div></a>
                        </div>
                        <div class="sent-otp">
                            <button type="button"> Send OTP</button></div>
                        <form  method="post">
                        <div class="otp-send">
                            <h2>OTP Sent !</h2>
                            <p>Please enter the 4 digit OTP sent to your Mobile Number.</p>
                            <div class="input-box">
                                <input type="text" name ="otpkey1" id="otpkey1" required /><input type="text" name ="otpkey2" id="otpkey2" required /><input type="text" name ="otpkey13" id="otpkey3" required /><input type="text" name ="otpkey4" id="otpkey4" required />
                                <em>Didn’t Receive OTP? <small>Send Again</small></em>
                            </div>
                            <div class="btn-wrap pt-3">
                                <a href="./location-selection.html" ><button type="button" class="button common-form-btn">Submit</button></a>
    
                            </div>
                            <div class="modal-reverse-heading text-center mt-3" >
                                <h6><img src="asset/images/icon/double-reverse-arrow.png">Back</h6>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-backdrop fade show"></div>

</body>

</html>