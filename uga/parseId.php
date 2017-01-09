 <?php
            //session_start();
			$_SESSION['appid'] = $_POST['id'];
			$appid = $_POST['id'];
			$url = 'http://store.steampowered.com/api/appdetails?appids=' . $appid;
			$obj = file_get_contents($url);
			$jsonOBJ = json_decode($obj, true);
			if(isset($jsonOBJ[$appid]['data'])){
				print '<strong>';
				print $jsonOBJ[$appid]['data']['name'];
				print '</strong>';
				print '<br/>';
				print 'System Requirements: <br/>';
				print $jsonOBJ[$appid]['data']['pc_requirements']['minimum'];
				echo "<br/>";
			}
			
			else{
				print "AppID not valid, Please input a valid ID.";
				print "<br/>";
				die();
			}
			?>