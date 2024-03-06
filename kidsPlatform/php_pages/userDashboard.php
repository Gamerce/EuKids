<?php 
	session_start();

	if (!isset($_SESSION['username'])) {
		header("location:login.php");
	}elseif ($_SESSION['usertype'] == 'admin') {
		header("location:login.php");
	}
	
	include 'configConn.php';
	
	if (isset($_GET['unique_id'])) {
	    $userIdLikes = $_SESSION['userId'];
	    $uniqueId = $_GET['unique_id'];
	    
	    $sql1 = "SELECT * FROM user_likes WHERE user_id = '$userIdLikes' AND unique_id = '$uniqueId'";
	    
	    $result1 = mysqli_query($conn,$sql1);
	    
	    $row = mysqli_fetch_array($result1);
	    
	    if ($row == NULL) {
	        $sql = "INSERT INTO user_likes(user_id,unique_id) VALUES('$userIdLikes','$uniqueId')";
	        
	    }else {
	        $sql = "DELETE FROM user_likes WHERE user_id = '$userIdLikes' AND unique_id = '$uniqueId' ";
	    }
	    
	    $query = mysqli_query($conn, $sql);
	    
	    
	    
	}

	
	
	$sql = "SELECT * FROM games LIMIT 10";
	
	$result = mysqli_query($conn, $sql);
	
	

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    
    <link rel="stylesheet" href="../css_pages/userDashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="navbar">
    	<div class="navbar-container">
    		<div class="logo-container">
    			<h1 class="logo">Kids Platform</h1>
    		</div>
    		
    		<div class="menu-container">
    			<div class="menu-container">
    			<ul class="menu-list">
					<li class="menu-list-item"><a href="../php_pages/about.php">ABOUT</a></li>
					<li class="menu-list-item"><a href="#contact">CONTACT</a></li>
					<li class="menu-list-item"><a href="logout.php">LOGOUT</a></li>
				</ul>
    			</div>
    		</div>
    		
    		<div class="profile-container">
    			<img class="profile-picture" alt="" src="">
    			
    			<div class="profile-text-container">
    				<span class="profile-text"><?php echo "<h2 class='text-success'>".$_SESSION['username']."</h2>"?></span>
    			<a href="../backend/getLogin.php">Get all from User Login</a> <br>
    			</div>
    			<div class="toggle">
    				<i class="fa-solid fa-moon toggle-icon"></i>
    				<i class="fa-solid fa-sun toggle-icon"></i>
    				<div class="toggle-ball"></div>
    			</div>
    		</div>
		</div>
    </div>
    <div class="sidebar">
    	<a href="Search" class="side-icon fa-solid fa-magnifying-glass"></a>
		<a href="#games" class="side-icon fa-solid fa-gamepad"></a>
		<a href="#videos" class="side-icon fa-solid fa-video"></a>
		<a href="#audiobooks" class="side-icon fa-solid fa-headphones"></a>
		<a href="../php_pages/userLikes.php?user_id=<?php echo $_SESSION['userId']?>" class="fa-solid fa-heart heart-sidebar-icon"></a>
    </div>
    
    <div class="container">
		<div class="content-container">
			<div class="featured-content" id="games"
				style = "background: linear-gradient(to bottom, rgba(0,0,0,0),#151515), url('../images/BlueEyedKitty.png')  ;"
			>
				
				<h2 class="featured-title">Blue Eyed Kitty</h2>
				<p class="featured-description">	Blue eyed kitty is a creative game for the 3-12 year olds with a focus on storytelling.
					It is a unique experience where the player help the kitty though the story using the tablet or smartphone as a window into the game universe.
					The game is developed in close cooperation with Kongo Interactive.
					View more games and app projects we have worked with.</p>
					<a href="https://play.google.com/store/apps/details?id=com.Gamerce.Mis&hl=en_US" target="_blank">
						<button class="featured-button-googleplay"><i class="fa-brands fa-google-play"></i>Google Play</button>
						
					</a>
					<a href="https://apps.apple.com/dk/app/the-blue-eyed-kitty/id1586819472" target="_blank">
						<button class="featured-button-apple"><i class="fa-brands fa-apple"></i>App Store</button>
						
					</a>
			</div>
			
			<div class="game-list-container">
				<h1 class="game-list-tittle" >GAMES</h1>
					<div class="game-list-wrapper">
					
						<div class="game-list">
						<?php 
				                $rowNumber = 1;
				                while ($info = $result ->fetch_assoc()) {
				          
				        ?>
							<div class="game-list-item">
								<img class="game-list-item-img" alt="" src="../images/card1.png">
								<span class="game-list-item-tittle"><?php echo "{$info['name']}"; ?></span>
								<p class="game-list-item-desc"><?php echo "{$info['description']}"; ?></p>
								<button class="game-list-item-button">Play</button>
								<?php echo "<a class='game-list-item-heart' href= 'userDashboard.php?unique_id={$info['unique_content_id']}'><i class='fa-solid fa-heart heart'></i></a>";?>
								
							</div>
							<?php 
				                    $rowNumber++;
				                }
				            ?>
							
						</div>
						<i class="fa-solid fa-chevron-right arrow"></i>
						<i class="fa-solid fa-chevron-left arrowLeft"></i>
						
					</div>
			
			</div>
			
			<div class="featured-content" id="videos"
				style = "background: linear-gradient(to bottom, rgba(0,0,0,0),#151515), url('../images/top2.png');"
			>
				
				<h2 class="featured-title" >Blue Eyed Kitty</h2>
				<p class="featured-description">	Blue eyed kitty is a creative game for the 3-12 year olds with a focus on storytelling.
					It is a unique experience where the player help the kitty though the story using the tablet or smartphone as a window into the game universe.
					The game is developed in close cooperation with Kongo Interactive.
					View more games and app projects we have worked with.</p>
					<a href="https://play.google.com/store/apps/details?id=com.Gamerce.Mis&hl=en_US" target="_blank">
						<button class="featured-button-googleplay"><i class="fa-brands fa-google-play"></i>Google Play</button>
						
					</a>
					<a href="https://apps.apple.com/dk/app/the-blue-eyed-kitty/id1586819472" target="_blank">
						<button class="featured-button-apple"><i class="fa-brands fa-apple"></i>App Store</button>
						
					</a>
			</div>
			
			
			<div class="game-list-container">
				<h1 class="game-list-tittle" >VIDEOS</h1>
					<div class="game-list-wrapper">
						<div class="game-list video-list">
							<div class="game-list-item">						
								 <video class="game-list-item-img" controlList="nodownload" oncontextmenu="return false;" loop autoplay muted playsinline>
        							<source src="../videos/102659-001-DAN_RKPS.mp4#t=,24" type="video/mp4" />
      							 </video>
								<span class="game-list-item-tittle">Video1</span>
								<p class="game-list-item-desc">It is a unique experience where the player help the kitty though the story using the</p>
								<a href="../php_pages/login.php">
								<button class="game-list-item-button">Watch</button>
								</a>
								<button class="game-list-item-heart"><i class="fa-solid fa-heart heart"></i></button>
								
							</div>
							<div class="game-list-item">
								 <video class="game-list-item-img" controlList="nodownload" oncontextmenu="return false;" autoplay muted playsinline >
        							<source src="../videos/102659-001-DAN_RKPS.mp4#t=60,85" type="video/mp4" />
      							 </video>
								<span class="game-list-item-tittle">Video2</span>
								<p class="game-list-item-desc">It is a unique experience where the player help the kitty though the story using the</p>
								<a href="../php_pages/login.php">
								<button class="game-list-item-button">Watch</button>
								</a>
								<button class="game-list-item-heart"><i class="fa-solid fa-heart heart"></i></button>
								
							</div>
							<div class="game-list-item">
								 <video class="game-list-item-img" oncontextmenu="return false;" autoplay muted playsinline >
        							<source src="../videos/102659-001-DAN_RKPS.mp4#t=100,125" type="video/mp4" />
      							 </video>
								<span class="game-list-item-tittle">Video3</span>
								<p class="game-list-item-desc">It is a unique experience where the player help the kitty though the story using the</p>
								<a href="../php_pages/login.php">
								<button class="game-list-item-button">Watch</button>
								</a>
								<button class="game-list-item-heart"><i class="fa-solid fa-heart heart"></i></button>
								
							</div>
							<div class="game-list-item">
								 <video class="game-list-item-img" oncontextmenu="return false;" autoplay muted playsinline >
        							<source src="../videos/102659-001-DAN_RKPS.mp4#t=150,175" type="video/mp4" />
      							 </video>
								<span class="game-list-item-tittle">Video4</span>
								<p class="game-list-item-desc">It is a unique experience where the player help the kitty though the story using the</p>
								<a href="../php_pages/login.php">
								<button class="game-list-item-button">Watch</button>
								</a>
								<button class="game-list-item-heart"><i class="fa-solid fa-heart heart"></i></button>
								
							</div>
							<div class="game-list-item">
								 <video class="game-list-item-img" oncontextmenu="return false;" autoplay muted playsinline >
        							<source src="../videos/102659-001-DAN_RKPS.mp4#t=180,200" type="video/mp4" />
      							 </video>
								<span class="game-list-item-tittle">Video5</span>
								<p class="game-list-item-desc">It is a unique experience where the player help the kitty though the story using the</p>
								<a href="../php_pages/login.php">
								<button class="game-list-item-button">Watch</button>
								</a>
								<button class="game-list-item-heart"><i class="fa-solid fa-heart heart"></i></button>
								
							</div>
							<div class="game-list-item">
								 <video class="game-list-item-img" oncontextmenu="return false;" autoplay muted playsinline >
        							<source src="../videos/102659-001-DAN_RKPS.mp4#t=210,235" type="video/mp4" />
      							 </video>
								<span class="game-list-item-tittle">Video6</span>
								<p class="game-list-item-desc">It is a unique experience where the player help the kitty though the story using the</p>
								<a href="../php_pages/login.php">
								<button class="game-list-item-button">Watch</button>
								</a>
								<button class="game-list-item-heart"><i class="fa-solid fa-heart heart"></i></button>
								
							</div>
						</div>
						<i class="fa-solid fa-chevron-right arrow arrowVideo"></i>
						<i class="fa-solid fa-chevron-left arrowLeftVideo arrowLeft"></i>
					</div>
			
			</div>
			
			<div class="featured-content" id="audiobooks"
				style = "background: linear-gradient(to bottom, rgba(0,0,0,0),#151515), url('../images/top1.png')  ;"
			>
				
				<h2 class="featured-title">Blue Eyed Kitty</h2>
				<p class="featured-description">	Blue eyed kitty is a creative game for the 3-12 year olds with a focus on storytelling.
					It is a unique experience where the player help the kitty though the story using the tablet or smartphone as a window into the game universe.
					The game is developed in close cooperation with Kongo Interactive.
					View more games and app projects we have worked with.</p>
					<a href="https://play.google.com/store/apps/details?id=com.Gamerce.Mis&hl=en_US" target="_blank">
						<button class="featured-button-googleplay"><i class="fa-brands fa-google-play"></i>Google Play</button>
						
					</a>
					<a href="https://apps.apple.com/dk/app/the-blue-eyed-kitty/id1586819472" target="_blank">
						<button class="featured-button-apple"><i class="fa-brands fa-apple"></i>App Store</button>
						
					</a>
			</div>
			
			<div class="game-list-container">
				<h1 class="game-list-tittle" >Audiobooks</h1>
					<div class="game-list-wrapper">
						<div class="game-list audio-list">
							<div class="game-list-item">
								<img class="game-list-item-img" alt="" src="../images/card1.png">
								<span class="game-list-item-tittle">Audiobook1</span>
								<p class="game-list-item-desc">It is a unique experience where the player help the kitty though the story using the</p>
								<button class="game-list-item-button">Listen</button>
								<button class="game-list-item-heart"><i class="fa-solid fa-heart heart"></i></button>
							</div>
							<div class="game-list-item">
								<img class="game-list-item-img" alt="" src="../images/card1.png">
								<span class="game-list-item-tittle">Audiobook2</span>
								<p class="game-list-item-desc">It is a unique experience where the player help the kitty though the story using </p>
								<button class="game-list-item-button">Listen</button>
								<button class="game-list-item-heart"><i class="fa-solid fa-heart heart"></i></button>
							</div>
							<div class="game-list-item">
								<img class="game-list-item-img" alt="" src="../images/card1.png">
								<span class="game-list-item-tittle">Audiobook3</span>
								<p class="game-list-item-desc">It is a unique experience where the player help the kitty though the story </p>
								<button class="game-list-item-button">Listen</button>
								<button class="game-list-item-heart"><i class="fa-solid fa-heart heart"></i></button>
							</div>
							<div class="game-list-item">
								<img class="game-list-item-img" alt="" src="../images/card1.png">
								<span class="game-list-item-tittle">Audiobook4</span>
								<p class="game-list-item-desc">It is a unique experience where the player help the kitty though the story using the tablet</p>
								<button class="game-list-item-button">Listen</button>
								<button class="game-list-item-heart"><i class="fa-solid fa-heart heart"></i></button>
							</div>
							<div class="game-list-item">
								<img class="game-list-item-img" alt="" src="../images/card1.png">
								<span class="game-list-item-tittle">Audiobook5</span>
								<p class="game-list-item-desc">It is a unique experience where the player help the kitty though the story using the tablet or </p>
								<button class="game-list-item-button">Listen</button>
								<button class="game-list-item-heart"><i class="fa-solid fa-heart heart"></i></button>
							</div>
							<div class="game-list-item">
								<img class="game-list-item-img" alt="" src="../images/card1.png">
								<span class="game-list-item-tittle">Audiobook6</span>
								<p class="game-list-item-desc">It is a unique experience where the player help the kitty though the story using the tabl</p>
								<button class="game-list-item-button" >Listen</button>
								<button class="game-list-item-heart"><i class="fa-solid fa-heart heart"></i></button>
							</div>
						</div>
						<i class="fa-solid fa-chevron-right arrowAudio arrow"></i>
						<i class="fa-solid fa-chevron-left arrowLeftAudio arrowLeft"></i>
					</div>
			
			</div>
			
		</div>
	</div>
	
	<footer>
		<div class="footer-container">
			<div class="logo-footer-container">
				<h1 class="logo-footer" id="contact">Gamerce</h1>
			</div>
			
			<div class="footer-contact" >
				<p class="footer-contact-text">Ravnsborg Tværgade 1B | 2200 Copenhagen | Denmark</p> <br> 
				<p class="footer-contact-text">CVR: 38762796 | info@gamerce.net</p>
			</div>
		</div>
	</footer>
	<script src="../js/slider.js"></script>
</body>
</html>