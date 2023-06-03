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
    <link rel="stylesheet" href="asset/css/common.css">
    <link rel="stylesheet" href="asset/css/landing-related.css">
</head>
<body>
    <div class="modal modal-lg fade d-block show" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="true"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="location-select mb-3 mt-3">
                        <div class="button locate-btn">
                            <a href="location-selection"><active><button type="button" id="button-rounding" style="border-radius: 5px 0px 0px 5px;">Selection</active></button></a>
                            <button type="button" id="button-rounding" style="border-radius: 0px 5px 5px 0px;" class="active">Maps</button>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 col-md-12 mt-3">
                                <div class="location-select">
                                    <div class="image-box">
                                        <img src="./asset/images/location-select-map.png" style="width: 100%;height: 280px;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 location-select mt-3" id="location-select">
                                <div class="location-warning text-center mt-3 pt-1">
                                    <img src="asset/Images/exclamation.png" style="margin-right: 5px;">Enter location to search for billboards.
                                </div>
                                <div class="text-area">
                                    <span><img src="./asset/images/loc.svg" height="34px" width="29px"></span>
                                    <input type="text" style="border-bottom: 2px solid #3C4F76 !important;" placeholder="Enter search location">
                                </div>
                                <small>OR</small>
                                <div class="autodetect">
                                    <button type="button" class="button common-btn-border">AUTO DETECT MY LOCATION</button>
                                </div>
                                <div class="next-btn mt-3">
                                    <button type="button" class="button common-form-btn">Next<img src="asset/images/side-arrow.png" width="40% !important" height="10px" /></button>
                                </div> 
                            </div>
                        </div>
                        <!-- <div class="location-select">
                            <div class="image-box">
                                <img src="./asset/images/location-select-map.png" style="width: 100%;height: 280px;">
                            </div>
                            <div class="button">
                                <button type="button" id="button-rounding" style="border-radius: 5px 0px 0px 5px;" class="active">Maps</button>
                                <a href="./4_1-location-select.html" target="_blank">  <active><button type="button" id="button-rounding" style="border-radius: 0px 5px 5px 0px;">Selection</active></button></a>
                            </div>
                            <div class="location-warning text-center mb-5 mt-3">
                                <img src="asset/Images/exclamation.png" style="margin-right: 5px;">Enter location to search for billboards.
                            </div>
                            <div class="text-area">
                                <span><img src="./asset/images/loc.svg" height="34px" width="29px"></span>
                                <input type="text" style="border-bottom: 2px solid #3C4F76 !important;" placeholder="Enter search location">
                            </div>
                            <small>OR</small>
                            <div class="autodetect">
                                <button type="button" class="button common-btn-border">AUTO DETECT MY LOCATION</button>
                            </div>
                            <div class="next-btn">
                                <a href="./5-campaign-select.html"><button type="button" class="button common-form-btn">Next<img src="asset/images/side-arrow.png" width="40% !important" height="10px" /></button></a>
                            </div>
                            <div class="modal-reverse-heading text-center mb-3">
                                <h6 id="back-to-account1"><img src="asset/images/icon/double-reverse-arrow.png" class="advertiser-back-arrow">Back</h6>
                            </div>
                        </div> -->
                        <div class="modal-reverse-heading text-center mb-3">
                            <h6 id="back-to-account1"><img src="asset/images/icon/double-reverse-arrow.png" class="advertiser-back-arrow">Back</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>

</body>

</html>