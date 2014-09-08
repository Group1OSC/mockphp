<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
    <link href="<?php echo base_url(); ?>public/default/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/default/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/default/css/prettyPhoto.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/default/css/price-range.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/default/css/animate.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>public/default/css/main.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>public/default/css/responsive.css" rel="stylesheet">

	<link href="<?php echo base_url(); ?>public/default/css/jRating.jquery.css" rel="stylesheet"/>	

	
    	
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="<?php echo base_url(); ?>public/default/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url(); ?>public/default/<?php echo base_url(); ?>public/default/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url(); ?>public/default/<?php echo base_url(); ?>public/default/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url(); ?>public/default/<?php echo base_url(); ?>public/default/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo base_url(); ?>public/default/<?php echo base_url(); ?>public/default/images/ico/apple-touch-icon-57-precomposed.png">
	<!-- Color Box CSS -->
	<link media="screen" rel="stylesheet" type="text/css" href="http://localhost/mockphp/public/css/colorbox.css" />
	<!-- Style For the Subscription Box -->
	<link media="screen" rel="stylesheet" type="text/css" href="http://localhost/mockphp/public/css/popup.css" />
    <script language="javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="http://localhost/mockphp/public/javascript/colorbox.js"></script>
    <script>
	$("document").ready(function (){ 

		   // load the overlay
			
			if (document.cookie.indexOf('visited=true') == -1) {
				var fifteenDays = 1000*60*60*24*15;
				var expires = new Date((new Date()).valueOf() + fifteenDays);
				document.cookie = "visited=true;expires=" + expires.toUTCString();
				$.colorbox({width:"590px",inline:true, href:"#subscribe_popup"});
			}
			
		
	 });
	</script>
    <style>
        a.tooltip2 {outline:none; }
        a.tooltip2 strong {line-height:30px;}
        a.tooltip2:hover {text-decoration:none;} 
        a.tooltip2 span {
            z-index:10;display:none; padding:14px 20px;
            margin-top:20px; margin-left:-105px;
            width:240px; line-height:16px;
        }
        a.tooltip2:hover span{
            display:inline; position:absolute; color:#111;
            border:1px solid #DCA; background:#fffAF0;}
        .callout {z-index:20;position:absolute;top:30px;border:0;left:-12px;}
            
        /*CSS3 extras*/
        a.tooltip2 span
        {
            border-radius:4px;
            -moz-border-radius: 4px;
            -webkit-border-radius: 4px;
                
            -moz-box-shadow: 5px 5px 8px #CCC;
            -webkit-box-shadow: 5px 5px 8px #CCC;
            box-shadow: 5px 5px 8px #CCC;
        }
    </style>
	
</head><!--/head-->

<body>
	<!-- This contains the hidden content for inline calls for the subscribe box -->
	<div style='display:none'>
	    <div id='subscribe_popup' style='padding:10px 10px 10px 10px; margin-top:0px;'>
			<h2 class="box-title">Wellcome to Mobile Shop!</h2>
		
			<img src="http://localhost/mockphp/public/images/lightbox/bao anh.jpg"  height="320" width="520"/>
		</div>
	</div><!-- END subscribe popup-->
	
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="<?php echo base_url(); ?>default/home/index" class="active"><img src="<?php echo base_url(); ?>public/default/images/home/logo.png" alt="" /></a>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li>
                                <a href="<?php echo base_url()?>default/home/cart" class="tooltip2">
                                    Cart (<?php echo $this->cart->total_items();?>)
                                    <span>
                                        <table border=1px;>
                                            <tr>
                                                <td width="150px;">Name</td>
                                                <td width="50px;">Price</td>
                                            </tr>
                                            <?php $data = $this->cart->contents();
                                                $total_price=0;
                                                foreach ($data as $key => $value) {
                                                echo "<tr>"; 
                                                echo "<td >".$value['name']."</td>";
                                                echo "<td align='right'>"."$".number_format($value['price'])."x".$value['qty']."</td>"; 
                                                echo "</tr>";
                                                $total_price+=$value['price']*$value['qty'];
                                                }
                                                
                                                ?>
                                            <tr>
                                                <td><b> Total price</b></td>
                                                <td align='right'><b><?php echo "$".number_format($total_price,"0","",".");?></b></td>
                                            </tr>
                                            
                                        </table>
                                    </span>
                                </a>                     
                                </li>
       	                        <li><a href="<?php echo base_url(); ?>default/home/checkout"><i class="fa fa-crosshairs"></i> Checkout</a></li>

							
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
							<?php if(empty($get_treeview_menu)):?>
								<p>There is no category yet.</p>
							<?php else: ?>
								<?php echo $get_treeview_menu; ?>
							<?php endif; ?>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
							<input type="text" placeholder="Search"/>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	<?php  if($type_page != 'cart' && $type_page != 'checkout'): ?>
	<section>
	<div class="container">
		<div class="row">
	<?php endif;?>
	<?php
		if($type_page == 'index'){
			$this->load->view("templates/slide"); 
		}
		if($type_page != 'cart' && $type_page != 'checkout' && $type_page != 'detail'){
			$this->load->view("templates/sidebar"); 
		}
	?>