
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
    
	<title>@yield('title', 'Titulo por defecto')</title>
    
    <link rel="stylesheet" href="/css/normalize.css">
	<link rel="stylesheet" href="/css/framework.css">
	<link rel="stylesheet" href="/admin/css/adminlte.min.css">
	<link rel="stylesheet" href="/css/style.css">
	<link rel="stylesheet" href="/css/responsive.css">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>



	{{-- SweetAlert2 --}}
	<link rel="stylesheet" href="/admin/plugins/sweetalert2/sweetalert2.min.css">

	{{-- STYLE ADICIONALES --}}
	@stack('style')
</head>
<body>

	@include('public.partials._navegacion')

	@yield('content')

	@include('public.partials._footer')
	
	{{-- SweetAlert --}}
	<script src="/admin/plugins/sweetalert2/sweetalert2.min.js"></script>

	@include('admin.partials._messageSession')
	
	{{-- SCRIPTS ADICIONALES --}}
	@stack('script')

</body>
</html>