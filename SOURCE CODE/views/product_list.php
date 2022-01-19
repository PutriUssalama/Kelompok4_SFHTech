<!DOCTYPE html>
<html lang="id">
  <head>
    <!-- Basic Page Needs
    ================================================== -->
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Petgroomingsoq - Products</title>
    <meta name="description" content="Petgroomingsoq - Solusi Peliharaan Anda!">
    <meta name="keywords" content="animals, business, cats, dogs, ecommerce, modern, pet care, pet services, pet shop, pet sitting, pets, shelter animals, store, veterinary">
    <meta name="author" content="Ubaii ID"> 
	
	<!-- ==============================================
	Favicons
	=============================================== -->
	<link rel="shortcut icon" href="../assets/images/favicon.ico">
	
	<!-- ==============================================
	CSS VENDOR
	=============================================== -->
	<link rel="stylesheet" type="text/css" href="../assets/css/vendor/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="../assets/css/vendor/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/vendor/owl.carousel.min.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/vendor/owl.theme.default.min.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/vendor/magnific-popup.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/vendor/animate.min.css">
	
	<!-- ==============================================
	Custom Stylesheet
	=============================================== -->
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css" />
	
    <script src="../assets/js/vendor/modernizr.min.js"></script>

</head>

<body>

	<!-- LOAD PAGE -->
	<div class="animationload">
		<div class="loader"></div>
	</div>
	
	<!-- BACK TO TOP SECTION -->
	<a href="#0" class="cd-top cd-is-visible cd-fade-out">Top</a>

	<!-- HEADER -->
    <div class="header header-1">

		<!-- TOP BAR -->
    	<div class="topbar d-none d-md-block">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-sm-6 col-md-6">
						<p class="mb-0">Selamat datang di Petgroomingsoq, Solusi peliharaan anda dalam 1 aplikasi!</p>
					</div>

					<div class="col-sm-6 col-md-6">
						<div class="sosmed-icon d-inline-flex pull-right">
							<a href="#"><i class="fa fa-facebook"></i></a> 
							<a href="#"><i class="fa fa-twitter"></i></a> 
							<a href="#"><i class="fa fa-instagram"></i></a> 
							<a href="#"><i class="fa fa-pinterest"></i></a> 
						</div>
					</div>

					
				</div>
			</div>
		</div>

		<!-- MIDDLE BAR -->
		<div class="middlebar d-none d-sm-block">
			<div class="container">
			
			</div>
		</div>

		<!-- NAVBAR SECTION -->
		<div class="navbar-main">
			<div class="container">
			    <nav id="navbar-example" class="navbar navbar-expand-lg">
			        <a class="navbar-brand" href="/">
						<img src="../assets/images/logo.png" alt="" />
					</a>
			        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
			            <span class="navbar-toggler-icon"></span>
			        </button>
			        <div class="collapse navbar-collapse" id="navbarNavDropdown">
			            <ul class="navbar-nav">
			            	<li class="nav-item dropdown dmenu">
			                    <a class="nav-link" href="/" role="button">
						          Beranda
						        </a>
			                </li>
			                <li class="nav-item dropdown dmenu">
			                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						        	Jasa
						        </a>
			                    <div class="dropdown-menu">
			                    	<a class="dropdown-item" href="/petshop">Cari Toko Perlengkapan Hewan</a>
									<a class="dropdown-item" href="/product">Produk</a>
									<a class="dropdown-item" href="/doctor">Cari dokter hewan</a>
									<a class="dropdown-item" href="/login">Buat konsultasi</a>
							    </div>
			                </li>
			                <li class="nav-item">
			                    <a class="nav-link" href="javascript:void(0)" id="contactus">Kontak Kami</a>
			                </li>
			            </ul>
			            <a href="/login" class="btn btn-secondary btn-nav btn-rect ml-auto">Masuk</a>
			        </div>
			    </nav> <!-- -->

			</div>
		</div>

    </div>

	<!-- BANNER -->
	<div class="section banner-page" data-background="../assets/images/banner1.jpg">
		<div class="content-wrap pos-relative">
			<div class="d-flex justify-content-center bd-highlight mb-2">
				<div class="title-page">Produk kami</div>
			</div>
			<p class="text-center text-white">Beli perlengkapan peliharaan.</p>
		</div>
	</div>

	<!-- BREADCRUMB -->
	<div class="section bg-breadcrumb">
		<div class="content-wrap py-0 pos-relative">
			<div class="container">
			    <nav aria-label="breadcrumb">
				  <ol class="breadcrumb ">
				    <li class="breadcrumb-item"><a href="/">Beranda</a></li>
				    <li class="breadcrumb-item active" aria-current="page">Produk</li>
				  </ol>
				</nav>					
			</div>
		</div>
	</div>

	<!-- CONTENT -->
	<div id="class" class="">
		<div class="content-wrap">
			<div class="container">

				<div class="row">
					<div class="col-12 col-sm-9 col-md-9">

						<div class="row">
							<div class="col-sm-12 col-md-12">
								<p class="title-heading text-secondary mb-5">
									Produk
								</p>
							</div>
						</div>					
						<div class="row">
                            <?php
                                $sqlStatement = "SELECT * FROM tb_product WHERE product_status = 'Tampilkan' ORDER BY product_id DESC LIMIT 500";
                                $runStatement = $conn->query($sqlStatement);
                                $dataStatement = $runStatement->fetchAll();
                                foreach($dataStatement as $row){
                            ?>
							<div class="col-sm-4 col-md-4">
								<div class="rs-shop-box mb-5">
									<div class="media">
                                        <a href="/product/<?php echo $row['product_id']; ?>" class="price"><img src="../assets/images/product_image/<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_name']; ?>" class="img-fluid"></a>
									</div>
									<div class="body-text">
										<h4 class="title"><a href="/product/<?php echo $row['product_id']; ?>"><?php echo $row['product_name']; ?></a></h4>
										<div class="meta">
											<span class="price">Rp.<?php echo $row['product_price']; ?>0</span>
										</div>
									</div>
								</div>
							</div>
                            <?php } ?>
						</div>
						<!-- end shop -->
					</div>					

				</div>

			</div>
		</div>
	</div>

	<!-- FOOTER SECTION -->
	<div class="footer bg-overlay-secondary" data-background="../assets/images/banner2.jpg">
		<div class="content-wrap">
			<div class="container">
				
				<div class="row">
					<div class="col-sm-6 col-md-4">
						<div class="footer-item">
							<img src="../assets/images/logo_w.png" alt="logo bottom" class="logo-bottom">
							<div class="spacer-20"></div>
							<p>Petgroomingsoq adalah salon sekaligus toko Peralatan anjing dan kucing. Service kami sangat diminati oleh mereka yang menginginkan privasi & kenyamanan salon exclusive tanpa harus meninggalkan rumah. Kualitas kerja dan service kami terjamin dengan harga terjangkau.</p>
							<div class="spacer-20"></div>
							<img src="../assets/images/payment.png" alt="">
						</div>
					</div>

					<div class="col-sm-6 col-md-4">
						<div class="footer-item">
							<div class="footer-title">
								Bantuan dan Pertanyaan
							</div>
							<p>Bantuan dan Pertanyaan kami buka selama 24jam!</p>
						</div>
					</div>
					
					<div class="col-sm-6 col-md-4">
						<div class="footer-item">
							<div class="footer-title">
								Kontak Kami
							</div>
							<p>Hubungi kami terkait pertanyaan kalian melalui kontak kami dibawah ini</p>
							<ul class="list-info">
								<li>
									<div class="info-icon text-primary">
										<span class="fa fa-map-marker"></span>
									</div>
									<div class="info-text">Jalan jendral sudirman</div> 
								</li>
								<li>
									<div class="info-icon text-primary">
										<span class="fa fa-phone"></span>
									</div>
									<div class="info-text">(62) 812-4746-4479</div>
								</li>
								<li>
									<div class="info-icon text-primary">
										<span class="fa fa-envelope"></span>
									</div>
									<div class="info-text">petgroomingsoq@gmail.com</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="fcopy">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 col-md-6">
						<p class="ftex">&copy; 2022 Petgroomingsoq. All Rights Reserved. Designed By <span class="text-primary">Rometheme</span></p> 
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="sosmed-icon d-inline-flex float-right">
							<a href="#"><i class="fa fa-facebook"></i></a> 
							<a href="#"><i class="fa fa-twitter"></i></a> 
							<a href="#"><i class="fa fa-instagram"></i></a> 
							<a href="#"><i class="fa fa-pinterest"></i></a> 
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
	
	<!-- JS VENDOR -->
	<script src="../assets/js/vendor/jquery.min.js"></script>
	<script src="../assets/js/vendor/bootstrap.min.js"></script>
	<script src="../assets/js/vendor/owl.carousel.js"></script>
	<script src="../assets/js/vendor/jquery.magnific-popup.min.js"></script>

	<!-- SENDMAIL -->
	<script src="../assets/js/vendor/validator.min.js"></script>
	<script src="../assets/js/vendor/form-scripts.js"></script>

	<script src="../assets/js/script.js"></script>

</body>
</html>