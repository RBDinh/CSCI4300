<?php session_start(); ?>


    <div class="container">
      <div class="result">
		<?php
			//session_start();
			$appid = $_SESSION['appid'];
			$totalScore = 0;
			
			$url = 'http://store.steampowered.com/api/appdetails?appids=' . $appid;
			$obj = file_get_contents($url);
			$jsonOBJ = json_decode($obj, true);
			
			$photo = $jsonOBJ[$appid]['data']['header_image'];
			$photoData = base64_encode(file_get_contents($photo));
			echo '<img src="data:image/jpeg;base64,'.$photoData.'">';
			echo "<br/>";
			
			print "Player count:";
			$url = 'http://api.steampowered.com/ISteamUserStats/GetNumberOfCurrentPlayers/v1/?key=399505D4223F7E09B7DB1DAACAD9A22F&format=json&appid=' . $appid;	
			$obj = file_get_contents($url);
			$jsonOBJ = json_decode($obj, true);
			$aPlayers = $jsonOBJ['response']['player_count']; 
			print $aPlayers;
			echo "<br/>";
			if($genre[0]['id'] == 2){
				if($aPlayers > 650){
					$totalScore = 20;
				}
				else{
					$totalScore = $aPlayers/650 * 10 + 10;
				}
			}
			
			else{
				if($aPlayers > 650){
					$totalScore = 20;
				}
				else{
					$totalScore = $aPlayers/650 * 20;
				}
			}
			$url = 'http://store.steampowered.com/api/appdetails?appids=' . $appid;
			$obj = file_get_contents($url);
			$jsonOBJ = json_decode($obj, true);
			
			
			print 'System Requirements: <br/>';
			print $jsonOBJ[$appid]['data']['pc_requirements']['minimum'];
			echo "<br/>";
			
			if(strcasecmp($_POST['answer'], 'yes') == 0){
				$totalScore += 10;
			}	
			
			else if(strcasecmp($_POST['answer'], 'no') == 0){
				$totalScore += 0;
			}
			
			else if(strcasecmp($_POST['answer'], 'IDK') == 0){
				$totalScore += 7;
			}
			if(strcasecmp($jsonOBJ[$appid]['data']['is_free'], false) == 0){
				print 'Initial Price: $';
				$price = $jsonOBJ[$appid]['data']['price_overview']['initial'];
				$price = $price/100;
				print $price;
				echo "<br/>";
				
				print 'Current Discount: ';
				$price = $jsonOBJ[$appid]['data']['price_overview']['discount_percent'];
				print $price;
				print '%';
				echo "<br/>";
				
				print 'Final Price: $';
				$price = $jsonOBJ[$appid]['data']['price_overview']['final'];
				$price = $price/100;
				print $price;
				echo "<br/>";
			}
			else{
				print 'This Game is Free!';
				print "<br/>";
				$price = 0;
			}
			$totalScore += (59.99 - $price)/59.99 * 20;
			print 'Is it Early Access? ';
			$price = $jsonOBJ[$appid]['data']['genres'];
			$isEarlyAccess = 0;
			if($price[count($price)-1]['description'] == "Early Access" ){
					print "Yes.";
					$isEarlyAccess = 1;
					$totalScore -= 15;
			}
			else{
				print "No.";
				echo "<br/>";
				print 'MetaCritic Rating: ';
				if(isset($jsonOBJ[$appid]['data']['metacritic']['score'])){
					$rating = $jsonOBJ[$appid]['data']['metacritic']['score'];
					print $rating;
					$totalScore += $rating/100 * 25; 
				}
				else{
					echo "N/A";
					$totalScore += 14;
				}
				
			}
			echo "<br/>";
			print "Recommendations: ";
			$recommendations = $jsonOBJ[$appid]['data']['recommendations']['total'];
			print $recommendations;
			if($aPlayers > $recommendations){
				$totalScore += 15; 
			}
			
			else{
				$totalScore += ($aPlayers/$recommendations) * 15;
			}
			echo "<br/>";
			
			print 'Is it Single Player? ';
			$genre = $jsonOBJ[$appid]['data']['categories'];
			$multiplayer = 1;
			//print $genre[0]['id'];
			if($genre[0]['id'] == 2){
				print ' Yes';
				$multiplayer = 0;
			}
			else{
				print ' No';
			}
			echo "<br/>";
			print 'Year Published: ';
			$date = $jsonOBJ[$appid]['data']['release_date']['date'];
			print $date;
			$tempDate = explode(" ", $date);
			if((2012 - $tempDate[2]) > 0 && $multiplayer == 1){
				$totalScore += ((100 - ((2012 - $tempDate[2]) * 5)))/100 * 10; 
			}
			
			else{
				$totalScore += 20;
			}
			echo "<br/>";
			
			echo "Final Score: ";
			echo $totalScore;
			echo "<br/>";
			if($totalScore >= 75){
				print "Based on the data presented to us, we of Team A recommend that you purchase this game!";
				echo "<img class='answer' src='./yes.jpg'></img>";
			}
			
			else if($totalScore >= 70){
				print "Based on the data presented to us, we of Team A recommend that you do more research towards the purchase <br/>";
				print "of this game. While it may seem appealing, we implore you to take the time to further find smaller <br/>";
				print "details in this title that will help solidify your purchase of this game";
				echo "<img class='answer' src='./maybe.jpg'></img>";
			}
			
			else if($totalScore < 70){
				print "Based on the data presented to us, we of Team A recommend that you do not purchase this game.";
				echo "<img class='answer' src='./no.jpg'></img>";
			}
		?>
            </div>

      
    </div> <!-- /container -->
      

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>

