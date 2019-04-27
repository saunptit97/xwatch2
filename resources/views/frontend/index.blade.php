<!DOCTYPE html>
<html lang="en">
<head>
	<title>Home</title>
	@include('frontend.header.header')
</head>
<body class="animsition">

	<!-- Header -->
	@include('frontend.header.menu')
	@yield('content')
	
	@include('frontend.footer.footer-content')

	@include('frontend.footer.footer')
</body>
</html>
