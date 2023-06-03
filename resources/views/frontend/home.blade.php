<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>billboard</title>
       
    @include('frontend.layout.links')
</head>
<body>
    <div class="wrapper userAccountWrap">
        <!-- HEADER PART BY BOOTSTRAP -->
        <nav class="navbar navbar-expand-lg navbar-light shadow-none">
          <div class="container-fluid">
              <div class="header-left-side" style="display: flex;">
                  <button class="navbar-toggler navbar-toggler-right collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                      <i class="fa-solid fa-bars"></i></button>
                  <a class="navbar-brand" href="#"><div class="logo"><img src="./asset/images/client/logo.png"></div></a>
                  <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                      <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">About Us</a>
                      </li>
                       <li class="nav-item">
                        <a class="nav-link" href="#">Our Services</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Contact Us</a>
                      </li>
                    </ul>
                    </div>
              </div>
                  <div class="header-right-side">
                    <ul class="navbar-nav-list">
                      <li>
                        <a class="nav-link" href="./user-account.html" target="blank"><img src="./asset/images/client/landing-header-vector.png"></a>
                      </li>
                      <li >
                        <a href="login"><button class="landing-join-btn">Log in</button></a>
                      </li>
                    </ul>
                    
                  </div>
       
          </div>
      </nav>
      <!-- END -->
      
      <div class="landing-banner-wrap">
        <div class="container-banner">
            <img src="./asset/images/pngegg (3) 1 copy 2.png">
            <div class="text-block">
                <h1>BILLBOARDs</h1>
                <h4>Ease your advertising with us!</h4>
                <div class="ms-5 mt-3">
                    <button type="button" class="landing-join-btn" id="jonBtn" style="cursor: pointer;">Join Us</button>
                </div>
              </div>
        </div>
      </div>

      <div class="landing-services-wrap mb-5">
        <div class="container">
            <div class="services-container pt-5">
                <h2 class="text-center">What we Provide?</h2>
                <p class="text-center mt-3">Our service connects media owners, advertisers, agencies and production on one platform, simplifying the advertising process. Benefit from a variety of options, insights and data to improve ROI and campaign efficiency.</p>
                <div class="row pt-5 mt-3">
                    <div class="col-md-3 text-center">
                        <h4>Advertisers</h4>
                    </div>
                    <div class="col-md-3 text-center">
                        <h4>Agencies</h4>
                    </div>
                    <div class="col-md-3 text-center">
                        <h4>Media Owners</h4>
                    </div>
                    <div class="col-md-3 text-center">
                        <h4>Production</h4>
                    </div>
                </div>
                <div class="services-circles-btn mt-3 mb-5">
                  <button class="green-circle-btn"></button>
                  <button class="red-circle-btn"></button>
                  <button class="blue-circle-btn"></button>
                  <button class="yellow-circle-btn"></button>
                </div>
                <div class="row mt-3 provider-details">
                  <div class="col-md-3 text-center">
                      <p>Browse and Book advertising opportunities.</p>
                  </div>
                  <div class="col-md-3 text-center">
                      <p>Make bookings in real-time & streamline processes
                        with clients.</p>
                  </div>
                  <div class="col-md-3 text-center">
                      <p>List your billboards and 
                        track bookings.</p>
                  </div>
                  <div class="col-md-3 text-center">
                      <p>List and manage
                        <br>printing & flighting.</p>
                  </div>
                </div>
            </div>
        </div>
      </div>

      <div class="explore-landing-billboards mb-5">
        <div class="container">
          <div class="services-container pt-5">
            <h2 class="text-center">Explore Billboards</h2>
            <div class="row pt-5">
              <div class="col-md-4">
                <div class="card">
                  <img src="./asset/images/explore-billboards.png" class="card-img-top">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <h6>Roadside</h6>
                      </div>
                      <div class="col-md-6 text-end">
                        <span>Show All</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card">
                  <img src="./asset/images/explore-billboards2.png" class="card-img-top">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <h6>Street Furniture</h6>
                      </div>
                      <div class="col-md-6 text-end">
                        <span>Show All</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card">
                  <img src="./asset/images/explore-billboards3.png" class="card-img-top">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <h6>Indoor</h6>
                      </div>
                      <div class="col-md-6 text-end">
                        <span>Show All</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <footer>
        <div class="footer">
          Owned by Billboard App Company Name
          <br>
          © 2022 Billboard, All Rights Reserved.
        </div>
      </footer>
<!-- JOIN US -->
      <div class="modal  modal-lg" id="joinModel">
        <div class="modal-dialog">
        
          <div class="modal-content" id="upload-modal">
      
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title" style="font-weight: 600;">Who are you?</h4>
            </div>
            <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            <!-- Modal body -->
            <div class="modal-body identity">
              <div class="login-identity-container">
                <div class="row">
                    <div class="col-md-3 text-center" style="cursor: pointer;">
                      <h5>
                        I am the
                        <br>
                        Advertiser
                      </h5>
                      <a href=""><img src="./asset/images/Advertising-Transparent 1.png" class="mt-3"></a>
                    </div>
                    <div class="col-md-3 text-center" style="cursor: pointer;">
                      <h5>
                        I represent
                        <br>
                        an Agency
                      </h5>
                      <a href=""><img src="./asset/images/Advertising-PNG-File 1.png"  class="mt-5" style="height: 120px;"></a>
                    </div>
                    <div class="col-md-3 text-center" style="cursor: pointer;">
                      <h5>
                        I am a
                        <br>
                        Media Owner
                      </h5>
                      <a href="sign-up-mediaowner"><img src="./asset/images/Capa_1.png"  class="mt-3"></a>
                    </div>
                    <div class="col-md-3 text-center" style="cursor: pointer;">
                      <h5>
                        I provide
                        <br>
                        Production Services
                      </h5>
                      <a href="production-popup"><img src="./asset/images/Layer 2.png"  class="mt-5" style="height: 150px;"></a>
                    </div>
                </div>
                <div class="row mt-3">
                  <div class="col-md-3 text-center">
                    <p>Book billboards and manage your ad campaigns.</p>
                  </div>
                  <div class="col-md-3 text-center">
                    <p>Book billboards and manage client processes.</p>
                  </div>
                  <div class="col-md-3 text-center">
                    <p>List your billboards and manage data.</p>
                  </div>
                  <div class="col-md-3 text-center">
                    <p>List your services for public access.</p>
                  </div>
                </div>
              </div>
            </div>
      
            <!-- Modal footer -->
              <div class="join-modal-footer">
                <div class="row mt-5 mb-1">
                  <div class="col-md-12 text-center">
                    <h6>Already have an account?<span> Log in.</span></h6>
                  </div>
                </div>
                <div class="row btn-sign-wrap" style="margin-bottom: 2rem;">
                  <div class="col-md-3">
                    <div class="modal-reverse-heading">
                      <h6><img src="./asset/images/icon/double-reverse-arrow.png">Back</h6>
                    </div>
                  </div>
                  <div class="col-md-9">
                    <h6 style="padding-left: 33px;">Are you a sub-user of a team?<span> Click Here.</span></h6>
                  </div>
                </div>
              </div>
      
          </div>
        </div>
      </div>
    </div>
  <!-- STEP 1 -->
    <div class="modal modal-lg fade d-block" id="mediaOwner">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container" id="modal-container">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="create-account d-flex align-items-center">
                                    <div class="form-wrap">
                                        <div class="title">    
                                            <h6 class="mb-3"><em class="mb-3 form-font-wrap">Create Account</em>I am a Media Owner</h6>
                                            <span class="mb-3">Step 1</span>
                                            <small>Company Details</small>
                                        </div>
                                        <ul>
                                            <li>
                                                <label><img src="./asset/images/icon/🦆 icon _company_.png">Company Name</label>
                                                <input type="number" placeholder="XYZ Media Pvt. Ltd." />
                                            </li>
                                            
                                            <li>
                                                <label><img src="./asset/images/icon/🦆 icon _app registration_.png"/>Registration Number</label>
                                                <input type="email" placeholder="QSBJBSJBS13234" />
                                            </li> 
                                            <li>
                                                <label><img src="./asset/images/icon/🦆 icon _receipt tax_.svg"/>VAT / GST Number</label>
                                                <input type="email" placeholder="QSBJBSJBS13234" />
                                            </li> 
                                            
                                            <li>
                                                <div class="btn-wrap">
                                                    <a href="sign-up-step2"> <button type="button" class="button common-form-btn">Next<img src="asset/images/arrow.png" /></button></a>                            
                                                </div>
                                                <div class="row mt-1 btn-sign-wrap">
                                                    <div class="col-md-7">
                                                        <div class="modal-reverse-heading">
                                                            <h6><img src="./asset/images/icon/double-reverse-arrow.png">Back</h6>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5 text-end">
                                                        <p>Already have an account? <a href="login"> Goto to Login</a></p>
                                                    </div>
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
    
<!-- scripts -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
      $('#joinBtn').click(function(){
        alert('h');
        $('#joinModel').fadeIn();
      });
    });
  </script> 

	
</body>
</html>
</body>
</html>