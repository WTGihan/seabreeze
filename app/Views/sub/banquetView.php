<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="UTF-8">
	<link rel="icon" type="image/png" href="<?php echo BURL.'assets/img/basic/favicon.png'; ?>" />
	<title>SEA BREEZE HOTEL</title>

</head>
<style>

@keyframes fadeIn {
  0% {
    opacity:0;
  }
  100% {
    opacity:1;
  }
}

  .slideshow { 
    position:relative;
    width:100%; }
    
  .slideshow .track { 
    display:table; 
    width:100%;
    margin:0 auto;
    height:70vh; 
    text-align:center;
    overflow:hidden; }

  .isSlide { 
    height:100%; 
    position:relative;
    display:none; text-align:left; }

  .isSlide.active { 
    display:table-cell;
    vertical-align:top; 
    height:70vh; 
    width:auto; max-width:100%; 
    animation: fadeIn ease 0.4s; }

  .isSlide img { 
    display:block; 
    height:96%; max-width:100%; 
    width:auto; margin:0 auto; 
    z-index:0; }

  .btnPrevSlide, .btnNextSlide { 
    display:block; 
    position:absolute; top:50%;
    width:40px; height:40px; margin-top:-20px; 
    border-radius:50%; 
    padding:0; 
    min-width:0; }

  .btnNextSlide { right:5px; }
  .btnPrevSlide { left:5px; }

  .btnNextSlide i.material-icons,
  .btnPrevSlide i.material-icons {
    display: block;
    width: 40px;
    height: 40px;
    line-height: 40px;
    text-align: center; 
    left:0; }

  .pagination-dots { 
    display:table; 
    width:auto; 
    list-style:none; 
    padding:0; 
    margin:0 auto; 
    z-index:11; }

  .pagination-dots button { 
    display:table-cell; 
    width:20px; height:20px; }
    
  .btnDot {
    font-size:0; line-height:0; color:transparent;
    background:none; filter:none; border:none;
    display: block; width: 20px; height: 20px;  
    cursor: pointer; }

  .btnDot .dot {
    display:block;
    width:8px; height:8px; 
    margin:0 auto; 
    border-radius:50%;
    background-color: #fff; 

  .btnDot.active .dot { 
    background-color:#fff; }

  .btnDot:focus { 
    outline:0; }
</style>
<body>
	<?php 
	
		if(isset($errors) && !empty($errors)) {
			echo '<script>alert("Enter Data is invalid")</script>';
		}
		
		else {
			if(isset($msg2)) {
				echo '<script>alert("'.$msg2.'")</script>';
			}
			if(isset($roomAvailable['availability']) && $roomAvailable['availability'] == 0) {
				echo '<script>alert("Hall is Not Available")</script>'; 
			}
		}
				
	?>

	<?php include(VIEWS.'inc/header_navbar.php'); ?>

	<?php 

			switch ($id) {
				case '1':
	?>
		<div class="slidecontainer">
			<img class="image" src="<?php echo BURL.'assets/img/banquet/post1.jpg' ?>" alt="beach side city view">
		 	<div class="bottom-left">
		 		<h1>WHITE HORSE BANQUET HALL</h1>
		 	</div>
		</div>
		<div class="headImg">
			<div class="first">
			
			<p class="">Our halls provide lavish event space that can be set up to host a variety of private events from weddings to corporate events. Our furnished, air-conditioned halls with smooth lighting can host between 100 and 350 people depending on the setting you require. Seating could be set up for banquets, conferences, corporate events and more. In-house catering, staff and a whole host of other services and facilities ensure that your special event is memorable.</p>
			
			<div class="package">

				<img src="<?php echo BURL.'assets/img/banquet/sub1.jpg' ?>" alt="" class="packImg">
				<div class="price">
					<dl class="inline">
					<p class="head">Beautiful Banquet hall with an opulent setting, beautiful decorations, Experienced Catering service , ample parking, photo locations make the perfect venue for wedding ceremonies, Birthday parties, Get-togethers and more…</p>
						<dt>PACKAGE INCLUDES:</dt>
						<dd>Luxery Hall</dd>
						<dt>DAILY TIMES:</dt>
						<dd>Function start 9am daily</dd>
						<dt>SHEDULE:</dt>
						<dd>6 hrs long</dd>
						<dt>PRICES:</dt>
						<dd>25000  LKR</dd>
					</dl>
					<a class="btn" href="">BOOK NOW <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
				</div>
				
			</div>
			
				  
				    <div class="reviewQuote group">
				        <img src="<?php echo BURL.'assets/img/banquet/prof1.jpg' ?>">
				        <div class="quote-container">
				            <blockquote>
				                <p>Had my first ever banquet lesson here and it was incredible! We were recommended Freedom as the best banquet school in Weligama by our hostel and I see why- I got a one-to-one lesson for 2000 LKR and my teacher was patient, encouraging and gave me feedback on how to improve each time I didn't manage to stand up! ”</p>
				            </blockquote>  
				            <cite><span>Olivia Williams</span><br>
				                USA
				            </cite>
				        </div>
      
   					</div>
   				
					   <div class="slideshow containerSlideshow">

							<div class="track">

								<div class="slide isSlide active">
								<img src="<?php echo BURL.'assets/img/banquet/LunchDinner-A.jpg' ?>" alt="">
								</div>

								<div class="slide isSlide">
								<img src="<?php echo BURL.'assets/img/banquet/LunchDinner-B.jpg' ?>" alt="">   
								</div>

								<div class="slide isSlide">
								<img src="<?php echo BURL.'assets/img/banquet/LunchDinner-C.jpg' ?>" alt="">
								</div>

								<div class="slide isSlide">
								<img src="<?php echo BURL.'assets/img/banquet/LunchDinner-D.jpg' ?>" alt="">
								</div>

								<div class="slide isSlide">
								<img src="<?php echo BURL.'assets/img/banquet/LunchDinner-E.jpg' ?>" alt="">
								</div>

								<div class="slide isSlide">
								<img src="<?php echo BURL.'assets/img/banquet/LunchDinner-F.jpg' ?>" alt="">
								</div>      

							</div><!--end track-->

							<button type="button" class="btnPrevSlide collapse"><i class="fa fa-arrow-left" aria-hidden="true"></i></button>
							<button type="button" class="btnNextSlide collapse"><i class="fa fa-arrow-right" aria-hidden="true"></i></button>

							<div class="isPagination pagination-dots collapse"></div>


						</div><!--end slideshow-->
					</div>

			<div class="second">
				<?php include(VIEWS.'inc/banquet-catogery.php'); ?>

			</div>
			
		</div>

	<?php
					break;
				case '2':
	?>
	<div class="slidecontainer">
			<img class="image" src="<?php echo BURL.'assets/img/banquet/post2.jpg' ?>" alt="beach side city view">
		 	<div class="bottom-left">
		 		<h1>WHITE ELEPHANT BANQUET HALL</h1>
		 	</div>
		</div>
		<div class="headImg">
			<div class="first">
			
			<p class="">Our halls provide lavish event space that can be set up to host a variety of private events from weddings to corporate events. Our furnished, air-conditioned halls with smooth lighting can host between 100 and 350 people depending on the setting you require. Seating could be set up for banquets, conferences, corporate events and more. In-house catering, staff and a whole host of other services and facilities ensure that your special event is memorable.</p>
			
			<div class="package">
				<img src="<?php echo BURL.'assets/img/banquet/sub2.jpg' ?>" alt="" class="packImg">
				<div class="price">
					<dl class="inline">
					<p class="head">Beautiful Banquet hall with an opulent setting, beautiful decorations, Experienced Catering service , ample parking, photo locations make the perfect venue for wedding ceremonies, Birthday parties, Get-togethers and more…</p>
						<dt>PACKAGE INCLUDES:</dt>
						<dd>Luxery Hall</dd>
						<dt>DAILY TIMES:</dt>
						<dd>Function start 9am daily</dd>
						<dt>SHEDULE:</dt>
						<dd>6 hrs long</dd>
						<dt>PRICES:</dt>
						<dd>25000  LKR</dd>
					</dl>
					<a class="btn" href="">BOOK NOW <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
				</div>
				
			</div>

			<div id="kudo-wrap"> 
				  <div class="adj-layer">
				    <!-- <h1>Kudos</h1> -->
				    <div class="reviewQuote group">
				        <img src="<?php echo BURL.'assets/img/banquet/prof2.jpg' ?>">
				        <div class="quote-container">
				            <blockquote>
				                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce hendrerit justo augue, vitae lobortis sapien interdum ut. Phasellus condimentum leo ut sem pulvinar, in sodales erat feugiat. Pellentesque ac cursus odio. Lorem ipsum dolor sit amet, consectetur adipiscing elit. ”</p>
				            </blockquote>  
				            <cite><span>Jan Baby</span><br>
				                RMT<br>
				                TLC Medical Massage
				            </cite>
				        </div>
      
   					</div>
   				</div>
   			</div>
			   <div class="slideshow containerSlideshow">

<div class="track">

	<div class="slide isSlide active">
	<img src="<?php echo BURL.'assets/img/banquet/LunchDinner-A.jpg' ?>" alt="">
	</div>

	<div class="slide isSlide">
	<img src="<?php echo BURL.'assets/img/banquet/LunchDinner-B.jpg' ?>" alt="">   
	</div>

	<div class="slide isSlide">
	<img src="<?php echo BURL.'assets/img/banquet/LunchDinner-C.jpg' ?>" alt="">
	</div>

	<div class="slide isSlide">
	<img src="<?php echo BURL.'assets/img/banquet/LunchDinner-D.jpg' ?>" alt="">
	</div>

	<div class="slide isSlide">
	<img src="<?php echo BURL.'assets/img/banquet/LunchDinner-E.jpg' ?>" alt="">
	</div>

	<div class="slide isSlide">
	<img src="<?php echo BURL.'assets/img/banquet/LunchDinner-F.jpg' ?>" alt="">
	</div>      

</div><!--end track-->

<button type="button" class="btnPrevSlide collapse"><i class="fa fa-arrow-left" aria-hidden="true"></i></button>
<button type="button" class="btnNextSlide collapse"><i class="fa fa-arrow-right" aria-hidden="true"></i></button>

<div class="isPagination pagination-dots collapse"></div>


</div><!--end slideshow-->
			</div>
			<div class="second">
				<?php include(VIEWS.'inc/banquet-catogery.php'); ?>
			</div>
			
		</div>
	<?php
					break;
				case '3':
	?>
	<div class="slidecontainer">
			<img class="image" src="<?php echo BURL.'assets/img/banquet/post3.jpg' ?>" alt="beach side city view">
		 	<div class="bottom-left">
		 		<h1>WHITE LION BANQUET HALL</h1>
		 	</div>
		</div>
		<div class="headImg">
			<div class="first">
			
			<p class="">Our halls provide lavish event space that can be set up to host a variety of private events from weddings to corporate events. Our furnished, air-conditioned halls with smooth lighting can host between 100 and 350 people depending on the setting you require. Seating could be set up for banquets, conferences, corporate events and more. In-house catering, staff and a whole host of other services and facilities ensure that your special event is memorable.</p>
			
			<div class="package">

				<img src="<?php echo BURL.'assets/img/banquet/sub3.jpg' ?>" alt="" class="packImg">
				<div class="price">
					<dl class="inline">
					<p class="head">Beautiful Banquet hall with an opulent setting, beautiful decorations, Experienced Catering service , ample parking, photo locations make the perfect venue for wedding ceremonies, Birthday parties, Get-togethers and more…</p>
						<dt>PACKAGE INCLUDES:</dt>
						<dd>Luxery Hall</dd>
						<dt>DAILY TIMES:</dt>
						<dd>Function start 9am daily</dd>
						<dt>SHEDULE:</dt>
						<dd>6 hrs long</dd>
						<dt>PRICES:</dt>
						<dd>25000  LKR</dd>
					</dl>
					<a class="btn" href="">BOOK NOW <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
				</div>
				
			</div>

			<div id="kudo-wrap"> 
				  <div class="adj-layer">
				    <!-- <h1>Kudos</h1> -->
				    <div class="reviewQuote group">
				        <img src="<?php echo BURL.'assets/img/banquet/prof3.jpg' ?>">
				        <div class="quote-container">
				            <blockquote>
				                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce hendrerit justo augue, vitae lobortis sapien interdum ut. Phasellus condimentum leo ut sem pulvinar, in sodales erat feugiat. Pellentesque ac cursus odio. Lorem ipsum dolor sit amet, consectetur adipiscing elit. ”</p>
				            </blockquote>  
				            <cite><span>Jan Baby</span><br>
				                RMT<br>
				                TLC Medical Massage
				            </cite>
				        </div>
      
   					</div>
   				</div>
   			</div>
			   <div class="slideshow containerSlideshow">

<div class="track">

	<div class="slide isSlide active">
	<img src="<?php echo BURL.'assets/img/banquet/LunchDinner-A.jpg' ?>" alt="">
	</div>

	<div class="slide isSlide">
	<img src="<?php echo BURL.'assets/img/banquet/LunchDinner-B.jpg' ?>" alt="">   
	</div>

	<div class="slide isSlide">
	<img src="<?php echo BURL.'assets/img/banquet/LunchDinner-C.jpg' ?>" alt="">
	</div>

	<div class="slide isSlide">
	<img src="<?php echo BURL.'assets/img/banquet/LunchDinner-D.jpg' ?>" alt="">
	</div>

	<div class="slide isSlide">
	<img src="<?php echo BURL.'assets/img/banquet/LunchDinner-E.jpg' ?>" alt="">
	</div>

	<div class="slide isSlide">
	<img src="<?php echo BURL.'assets/img/banquet/LunchDinner-F.jpg' ?>" alt="">
	</div>      

</div><!--end track-->

<button type="button" class="btnPrevSlide collapse"><i class="fa fa-arrow-left" aria-hidden="true"></i></button>
<button type="button" class="btnNextSlide collapse"><i class="fa fa-arrow-right" aria-hidden="true"></i></button>

<div class="isPagination pagination-dots collapse"></div>


</div><!--end slideshow-->
			</div>
			<div class="second">
				<?php include(VIEWS.'inc/banquet-catogery.php'); ?>
			</div>
			
		</div>
	<?php
	
					break;
				default:
					# code...
					break;
			}
	
	?>
	<?php include(VIEWS.'inc/footer.php'); ?>

	
	<script type="text/javascript">
	window.onload = function () {
		const navbar= document.querySelector(".nav");
		// console.log(navbar);
		navbar.classList.toggle("sticky");
	};


	$(".containerSlideshow").each(createSlideshow);

function createSlideshow(i, elem) {

  var slideshow = $(elem);
  var count = slideshow.find(".isSlide").length;
  var pagination = slideshow.find(".isPagination");
  var backButton = slideshow.find(".btnPrevSlide");
  var nextButton = slideshow.find(".btnNextSlide");

  if (count > 1) {

    pagination.removeClass("collapse");
    backButton.removeClass("collapse");
    nextButton.removeClass("collapse");

    function gotoSlide(n) {
      slideshow.find(".isSlide").removeClass("active").fadeOut(500);
      pagination.find(".btnDot").removeClass("active");
      pagination.find(".btnDot").eq(n).addClass("active");
      slideshow.find(".isSlide").eq(n).addClass("active").fadeIn(500);
    }

    //create pagination dots

    for (var i = 0, len = count; i < len; i++) {
      pagination.append(
        '<button type="button" class="btnDot"><i class="dot"></i></button>'
      );
      pagination.find(".btnDot").eq(0).addClass("active");
    }

    //click function for dots
    $(".btnDot").click(function() {
      var dot = $(this).parent().index();
      gotoSlide(dot);
    });


    //back & next buttons
    backButton.click(function() {
      var prev = slideshow.find(".isSlide.active").index() - 1;
      gotoSlide(prev);
    });

    nextButton.click(function() {
      var next = slideshow.find(".isSlide.active").index() + 1;
      if (next == count) next = 0;
      gotoSlide(next);
    });

  }

}
	</script>
</body>
</html>