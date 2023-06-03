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
  <script src="./asset/js/bootstrap.bundle.js"></script>
  <script src="./asset/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="asset/css/mobile-app.css">
  <link rel="stylesheet" href="asset/css/landing-related.css">
</head>

<body>
  <div class="modal modal-lg fade d-block show" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="true"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          <div class="location-select mt-3">
            <div class="button locate-btn mt-3">
              <button type="button" id="button-rounding" style="border-radius: 5px 0px 0px 5px;" class="active">Selection</button>
              <a href="location-map"><active><button type="button" id="button-rounding" style="border-radius: 0px 5px 5px 0px;">Maps</active></button></a>
            </div>
          </div>
          <div class="container">
            <div class="row">
              <div class="col-lg-5 col-md-12">
                <div class="location-select selection">
                  <div class="image-box mt-5">
                    <img src="./asset/images/loc-i.png"  style="height: 300px;">
                  </div>
                </div>
              </div>
              <div class="col-lg-7 col-md-12" id="accordion">
                <div class="location-warning text-center mb-3 mt-5">
                  <img src="asset/Images/exclamation.png" style="margin-right: 5px;">Enter location to search for billboards.
              </div>
              <select class="form-select" aria-label="Default select example">
                <option selected>Country</option>
                <option value="1">South Africa</option>
                <option value="2">Dubai</option>
              </select>
              <select class="form-select top" aria-label="Default select example">
                <option selected>State</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>

              <select class="form-select top" aria-label="Default select example">
                <option selected>Province</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>

              <select class="form-select top" aria-label="Default select example">
                <option selected>City</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>

              <select class="form-select top" aria-label="Default select example">
                <option selected>Suburb</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>

              <select class="form-select top" aria-label="Default select example">
                <option selected>Urban Area</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
                <div class="next-btn mt-1">
                  <a href=""><button type="button" class="button common-form-btn">Next<img src="asset/images/side-arrow.png"
                      height="10px" /></button></a>
                </div>
              </div>
            </div>
              <div class="modal-reverse-heading text-center mb-3">
                <h6 id="back-to-account1"><img src="asset/images/icon/double-reverse-arrow.png" class="advertiser-back-arrow">Back</h6>
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