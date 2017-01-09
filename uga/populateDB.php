<?php
    $server = "localhost";
    $username = "root";
    $password = "J71f9051184!";
    $db = "steam";
    $conn = new mysqli($server,$username,$password,$db);
    if($conn->connect_error)
    {
            exit("Connection Failed " .$conn->connect_error);
    }
    $start = $_POST["st"];
    doRequest($start,$conn);
   function doRequest($st,$conn)
   {
        $urlTest = 'http://api.steampowered.com/ISteamApps/GetAppList/v0001/';
            $objTest = file_get_contents($urlTest);
            $jsonOBJTest = json_decode($objTest, true);
            $timet = 0;
            //echo $jsonOBJTest['applist']['apps']['app'][0]['appid'];
            $ch = curl_init();
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                //print $jsonOBJTest['applist']['apps']['app'][$i]['appid'];
                $appid = $jsonOBJTest['applist']['apps']['app'][$st]['appid'];
                $url = 'http://store.steampowered.com/api/appdetails?appids=' . $appid;
                curl_setopt($ch,CURLOPT_URL,$url);
                $time1 = microtime(true);
                $obj = curl_exec($ch);
                $jsonOBJ = json_decode($obj, true);
                
                if(($jsonOBJ[$appid]['success'] == true)){
                    if($jsonOBJ[$appid]['data']['type'] == 'game')
                    {
                        $title =  $jsonOBJ[$appid]['data']['name'];
                        echo $title;
                        echo " : ".$appid;
                        echo ",".$st;
                        $sql = "INSERT INTO games(appID,title) VALUES('$appid','$title');";
                        $conn->query($sql);
                    }
                    else
                    {
                    echo "null,".$st;
                    }    
                }
                else
                {
                    echo "null,".$st;
                }
    //echo "Total Time: ".$timet;
   }
    //$sql = "INSERT INTO games(appid,name) VALUES('$appid','$name')";
    //$conn->query($sql);
    $conn->close();
?>