<?php
function mostrarTweets($user,$num){
//Path to TwitterOAuth library
require_once("twitteroauth/twitteroauth.php");

//Configuration
$twitterID = (isset($_REQUEST['varop10_alvaro']) && !empty($_REQUEST['varop10_alvaro']))?$_REQUEST['varop10_alvaro']:$user;
$tweetNum = $num;
$consumerKey = "QcpddClN12kJ4l7UWeWdHZQv5";
$consumerSecret = "Vh8jR7bTe7VYQz5KqpofbhveEOucMylDb5QsNEXLGTsSQEWIOe";
$accessToken = "3168949561-CvkXSeuSjAqieIpJbKdsUmaoa0LUTMohmWgyhRP";
$accessTokenSecret = "NAJoa9Rqznrx2sW8eQawautc4xdG6DCszdaUIYXelra39"; 
if($twitterID && $consumerKey && $consumerSecret && $accessToken && $accessTokenSecret) {
      //Authentication with twitter
      $twitterConnection = new TwitterOAuth(
          $consumerKey,
          $consumerSecret,
          $accessToken,
          $accessTokenSecret
      );
      //Get user timeline feeds
      $twitterData = $twitterConnection->get(
          'statuses/user_timeline',
          array(
              'screen_name'     => $twitterID,
              'count'           => $tweetNum,
              'exclude_replies' => false
          )
      );

 echo   "<ul class='tweet-list'>";
            if(!empty($twitterData)) {
                foreach($twitterData as $tweet):
                  $latestTweet = $tweet->text;
                  $latestTweet = preg_replace('/http:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '<a href="http://$1" target="_blank">http://$1</a>', $latestTweet);
                  $latestTweet = preg_replace('/@([a-z0-9_]+)/i', '<a class="tweet-author" href="http://twitter.com/$1" target="_blank">@$1</a>', $latestTweet);
                  $tweetTime = date("D M d H:i:s",strtotime($tweet->created_at));
            
         echo "<li class='tweet-wrapper'>
                <div class='tweet-thumb'>
                  <span class='had-thumb'><a href=".$tweet->user->url." title=".$tweet->user->name."><img alt='' src=".$tweet->user->profile_image_url."></a></span>
                </div>
                <div class='tweet-content'>
                    <h3 class='title' title=".$tweet->text.">".$latestTweet."</h3>
                    <span class='meta'>".$tweetTime." - <span><span class='dsq-postid' rel='8286 http://www.techandall.com/?p=8286'>".$tweet->favorite_count." Favorite</span></span></span>
                </div>
            </li>";
                endforeach; 
            }else{
                echo '<li class="tweet-wrapper">Tweets not found for the given username.</li>'; 
            }
     echo "</ul>";
}else{
      echo 'Authentication failed, please try again.';
}
}
?>