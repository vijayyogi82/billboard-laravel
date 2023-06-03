<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="utf-8" />
		<title>Login</title>
		<meta name="description" content="Login" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<link href="{{asset('assets/css/pages/login/login-15883.css?v=7.2.9')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/plugins/global/plugins.bundle5883.css?v=7.2.9')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/plugins/custom/prismjs/prismjs.bundle5883.css?v=7.2.9')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/css/style.bundle5883.css?v=7.2.9')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/css/themes/layout/header/base/light5883.css?v=7.2.9')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/css/themes/layout/header/menu/light5883.css?v=7.2.9')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/css/themes/layout/brand/dark5883.css?v=7.2.9')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/css/themes/layout/aside/dark5883.css?v=7.2.9')}}" rel="stylesheet" type="text/css" />
	</head>
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
		<div class="d-flex flex-column flex-root">
			<div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
				<div class="login-aside d-flex flex-column flex-row-auto" style="background-color: #F2C98A;">
					<div class="d-flex flex-column-auto flex-column pt-lg-40 pt-15">
						<a href="#" class="text-center mb-10">
							<img src="{{asset('assets/media/logos/logo-letter-1.png')}}" class="max-h-70px" alt="" />
						</a>
						<h3 class="font-weight-bolder text-center font-size-h4 font-size-h1-lg" style="color: #986923;">Discover Amazing Billboard 
						<br />with great build tools</h3>
					</div>
					<div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center" style="background-image: url(https://preview.keenthemes.com/metronic/theme/html/demo1/dist/assets/media/svg/illustrations/login-visual-1.svg)"></div>
				</div>
				<div class="login-content flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7 mx-auto">
					<div class="d-flex flex-column-fluid flex-center">
						<div class="login-form login-signin">
						<x-auth-validation-errors class="mb-4" :errors="$errors" />	
						<form method="POST"  class="form" id="kt_login_signin_form" action="{{ route('login') }}">	
								@csrf
								<div class="pb-13 pt-lg-0 pt-5">
									<h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Welcome to Billboard</h3>
									<span class="text-muted font-weight-bold font-size-h4">New Here? 
									<a href="javascript:;" id="kt_login_signup" class="text-primary font-weight-bolder">Create an Account</a></span>
								</div>
								<div class="form-group">
									<label class="font-size-h6 font-weight-bolder text-dark">Email</label>
									<input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg" id="email" type="email" name="email" autocomplete="off" />
								</div>
								<div class="form-group">
									<div class="d-flex justify-content-between mt-n5">
										<label class="font-size-h6 font-weight-bolder text-dark pt-5">Password</label>
										<a href="javascript:;" class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5" id="kt_login_forgot">Forgot Password ?</a>
									</div>
									<input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg" id="password" type="password" name="password" autocomplete="off" />
								</div>
								<div class="pb-lg-0 pb-5">
									<button type="submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3">Sign In</button>
								</div>
							</form>
						</div>
						<div class="login-form login-signup">
							<form class="form" id="kt_login_signup_form" method="POST" action="{{ route('register') }}">
							@csrf
								<div class="pb-13 pt-lg-0 pt-5">
									<h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Sign Up</h3>
									<p class="text-muted font-weight-bold font-size-h4">Enter your details to create your account</p>
								</div>
								<div class="form-group">
									<input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" placeholder="Fullname" id="name" type="text" name="name" :value="old('name')" autocomplete="off" />
								</div>
								<div class="form-group">
									<input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" id="email" placeholder="Email" type="email" name="email" :value="old('email')" autocomplete="off" />
								</div>
								<div class="form-group">
									<input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" type="password" placeholder="Password" name="password" id="password" autocomplete="off" />
								</div>
								<div class="form-group">
									<input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" type="password" placeholder="Confirm password" name="password_confirmation" id="password_confirmation" autocomplete="off" />
								</div>
								<div class="form-group">
									<label class="checkbox mb-0">
										<input type="checkbox" name="agree" />
										<span></span>
										<div class="ml-2">I Agree the 
										<a href="#">terms and conditions</a>.</div>
									</label>
								</div>
								<div class="form-group d-flex flex-wrap pb-lg-0 pb-3">
									<button type="submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-4">Submit</button>
									<button type="button" id="kt_login_signup_cancel" class="btn btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3">Cancel</button>
								</div>
							</form>
						</div>
						<div class="login-form login-forgot">
							<form class="form" novalidate="novalidate" id="kt_login_forgot_form">
								<div class="pb-13 pt-lg-0 pt-5">
									<h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Forgotten Password ?</h3>
									<p class="text-muted font-weight-bold font-size-h4">Enter your email to reset your password</p>
								</div>
								<div class="form-group">
									<input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" type="email" placeholder="Email" name="email" autocomplete="off" />
								</div>
								<div class="form-group d-flex flex-wrap pb-lg-0">
									<button type="button" id="kt_login_forgot_submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-4">Submit</button>
									<button type="button" id="kt_login_forgot_cancel" class="btn btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3">Cancel</button>
								</div>
							</form>
						</div>
					</div>
					<div class="d-flex justify-content-lg-start justify-content-center align-items-end py-7 py-lg-0">
						<div class="text-dark-50 font-size-lg font-weight-bolder mr-10">
							<span class="mr-1">2022©</span>
							<a href="http://keenthemes.com/metronic" target="_blank" class="text-dark-75 text-hover-primary">Billboard</a>
						</div>
						<a href="#" class="text-primary font-weight-bolder font-size-lg">Terms</a>
						<a href="#" class="text-primary ml-5 font-weight-bolder font-size-lg">Plans</a>
						<a href="#" class="text-primary ml-5 font-weight-bolder font-size-lg">Contact Us</a>
					</div>
				</div>
			</div>
		</div>
		<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
		<script src="{{asset('assets/plugins/global/plugins.bundle5883.js?v=7.2.9')}}"></script>
		<script src="{{asset('assets/plugins/custom/prismjs/prismjs.bundle5883.js?v=7.2.9')}}"></script>
		<script src="{{asset('assets/js/scripts.bundle5883.js?v=7.2.9')}}"></script>
		<script src="{{asset('assets/js/pages/custom/login/login-general5883.js?v=7.2.9')}}"></script>
	</body>
</html>