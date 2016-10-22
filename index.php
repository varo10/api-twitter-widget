<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Create custom Twitter Widget using PHP by CodexWorld</title>
<link href='style.css' rel='stylesheet' type='text/css'>
</head>

<body>
  <div class='tweet-box'>
    <div class='tweets-widget'>
      <?php 
        require_once('request.php');
        $num = 3;
        $user1 = "varop10_alvaro";
        $user2 = "fcbarcelona";
        mostrarTweets($user1,$num);
        mostrarTweets($user2,$num);
       ?>
    </div>
  </div>
</body>
</html>
