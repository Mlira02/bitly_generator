<?php

// This is a utility to take a URL, add some UTM codes and provide a shortened link.


 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 3.2//EN">
<html>

<head>
	<title>ARD link shortener</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable = no" />


  <script type="text/javascript" language="Javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" />
  <link rel="stylesheet" href="http://www.alumni.northwestern.edu/s/1479/02-naa/16/css/vendor.css">
  <link rel="stylesheet" href="http://www.alumni.northwestern.edu/s/1479/02-naa/16/css/style.css">
  <link rel="stylesheet" href="style.css">

</head>
<body>
  <h1>ARD link shortener</h1>

  <p class="p-intro">
    Thank you for using UTM codes! They help us track and measure the effectiveness of our marketing efforts.
  </p>

<?php 

  if(isset($_POST['url'])) {
    $domain = $_POST["domain"];
    $source = str_replace('imodules', 'iModules',strtolower($_POST["utm_source"]));
    $medium = strtolower($_POST["utm_medium"]); // So that referral and other stuff doesn't get capped
    $campaign = $_POST["utm_campaign"];
    $content = $_POST["utm_content"];
    $shortenFacebook = $_POST["source-facebook"] == "yes";
    $shortenTwitter = $_POST["source-twitter"] == "yes";
    $shortenInstagram = $_POST["source-instagram"] == "yes";
    $shortenImodules = $_POST["source-imodules"] == "yes";
    $shortenLinkedin = $_POST["source-linkedin"] == "yes";
    $shortenWeChat = $_POST["source-wechat"] == "yes";
    $shortenWhatsApp = $_POST["source-whatsapp"] == "yes";
    $shortenLine = $_POST["source-line"] == "yes";
    $shortenKakaoTalk = $_POST["source-kakaotalk"] == "yes";
    $shortenNone = $_POST["source-none"] == "yes";
    $customOther = false;
    $url = $_POST["url"];
    if (strpos($url, 'http') === false) {
      $url = 'http://' . $url;
    }
    $originalUrl = $url;
  }

 ?>

  <div id="bitly-outer">
  
  <div id="bitly-form">
    <form action="" method="post" name="bitly">
    <div class="input-row">
      <label for="utm-url">Destination URL:</label>
      <input type="text" size="1" name="url" id="utm-url placeholder="Destination URL" autofocus="autofocus" value="<?php echo $originalUrl; ?>">

    </div>

    <div class="input-row" id="row-campaign">
      <label for="utm-campaign">Campaign:</label>
      <input type="text" size="1" name="utm_campaign" id="utm-campaign" value="<?php echo $campaign; ?>">
      <p class="utm-note">Typical campaign values: <code>Purple Pride Worldwide</code>, <code>2017 Reunion</code>, <code>Undergraduate Commencement Message</code>, <code>9-25-17 Purple Line</code>.</p>
    </div>

    
    <p>Select which links, if any, you would like to have shortened into a branded link. (If not selected, a bit.ly link will still be provided.)</p>

    <div class="input-row" id="row-sources">
      <label for="source-facebook"><input type="checkbox" value="yes" id="source-facebook" name="source-facebook"> Facebook</label>
      <label for="source-twitter"><input type="checkbox" value="yes" id="source-twitter" name="source-twitter"> Twitter</label>
      <label for="source-instagram"><input type="checkbox" value="yes" id="source-instagram" name="source-instagram"> Instagram</label>
      <label for="source-linkedin"><input type="checkbox" value="yes" id="source-linkedin" name="source-linkedin"> Linkedin</label>
      <label for="source-wechat"><input type="checkbox" value="yes" id="source-wechat" name="source-wechat"> WeChat</label>
      <label for="source-whatsapp"><input type="checkbox" value="yes" id="source-whatsapp" name="source-whatsapp"> WhatsApp</label>
      <label for="source-line"><input type="checkbox" value="yes" id="source-line" name="source-line"> LINE</label>
      <label for="source-kakaotalk"><input type="checkbox" value="yes" id="source-kakaotalk" name="source-kakaotalk"> KakaoTalk</label>
      <label for="source-imodules"><input type="checkbox" value="yes" id="source-imodules" name="source-imodules" > iModules Email</label>
      <label for="source-none"><input type="checkbox" value="yes" id="source-none" name="source-none" > No UTM</label>
    
    </div>
    <div id="choice-branded" style="display: none;">
    <p>Which branded link would you like to use?</p>
    <div class="input-row" id="row-domain">
      <label for="domain-wewill"><input type="radio" name="domain" value="wewill" id="domain-wewill" <?php if ($domain == '' || $domain == 'wewill') {echo 'checked';} ?>>wewill.nu</label>
      <label for="domain-giving"><input type="radio" name="domain" value="giving" id="domain-giving" <?php if ($domain == '' || $domain == 'giving') {echo 'checked';} ?>>giving.nu</label>
      <label for="domain-NAA"><input type="radio" name="domain" value="NAA" id="domain-NAA" <?php if ($domain == 'NAA') {echo 'checked';} ?>>alum.nu</label> 
    </div>  
    </div>
    <input type="submit" id="utm-submit" class="btn btn-large margin-bottom-20" value="Shrtn!">

    <div class="input-row input-row-optional">
      <h3>Optional values</h3>
      <label for="utm-source">Source: <p class="utm-note">
        <strong>Typical source values:<br><code>iModules email</code>, <code>northwestern.edu</code>, <code>postcard</code></strong> </p></label>
      <input type="text" size="1" name="utm_source" id="utm-source" value="<?php echo $source; ?>">
      
    </div>

    <div class="input-row input-row-optional">
      <label for="utm-medium">Medium: <p class="utm-note">
        <strong>Typical medium values:</strong><br><code>referral</code>, <code>print</code>, <code>email</code></p>
</label>
      <input type="text" size="1" name="utm_medium" id="utm-medium" value="<?php echo $medium; ?>">
      
      <p class="utm-note">
        Source and medium are only required if you need a UTM beyond basic Facebook, Twitter, Instagram, and email. If you intend to use the URL in a <em>Northwestern Magazine</em> ad, for example, use a source of <code>Northwestern Magazine</code>, medium of <code>print</code>, campaign of <code>Nov 2017 Northwestern Magazine ad</code>. 
      </p>
    </div>
    <div class="input-row input-row-optional">
      <label for="utm-content">Content:</label>
      <input type="text" size="1" name="utm_content" id="utm-content" value="<?php echo $content; ?>">
      <p class="utm-note">
        Use content if you need to further specify the source of a click. Potential values would be <code>Tuesday morning Tweet</code>, <code>Image link</code>, or <code>text link</code>.
      </p>
    </div>

    
    </form>
  </div><!-- /#bitly-form -->
  
  

  <div id="bitly-results">
    

<?php

if(isset($_POST['url'])) {

  if (strpos($url, '?') > 0) {
    $url .= '&utm_campaign=' . rawurlencode($campaign) . '&';
  }
  else {
    $url .= '?utm_campaign=' .  rawurlencode($campaign) . '&';
  }

  if ($content) {
    $url = $url . 'utm_content=' . rawurlencode($content) . '&';
  }
  
  $twitterUrl = $url . 'utm_medium=referral&utm_source=t.co';
  $fbUrl = $url . 'utm_medium=referral&utm_source=facebook.com';
  $instagramUrl = $url . 'utm_medium=referral&utm_source=instagram.com';
  $linkedinUrl = $url . 'utm_medium=referral&utm_source=linkedin.com';
  $weChatUrl = $url . 'utm_medium=referral&utm_source=web.wechat.com';
  $whatsAppUrl = $url . 'utm_medium=referral&utm_source=whatsapp';
  $lineUrl = $url . 'utm_medium=referral&utm_source=line';
  $kakaoTalkUrl = $url . 'utm_medium=referral&utm_source=kakaotalk';
  $emailUrl = $url . 'utm_medium=email&utm_source=iModules%20email';

  if ($medium == 'email') {
    $emailUrl = $url . 'utm_medium=email&utm_source=' . rawurlencode($source);
  }

  if ($source && $medium && $medium != 'email') {
    $customOther = true;
    $otherUrl = $url . 'utm_medium=' . rawurlencode($medium) . '&utm_source=' . rawurlencode($source);
  }

  $shortTwitter = getBitly($twitterUrl, ($shortenTwitter ? $domain : "none"));
  $shortFB = getBitly($fbUrl, ($shortenFacebook ? $domain : "none"));
  $shortInstagram = getBitly($instagramUrl, ($shortenInstagram ? $domain : "none"));
  $shortLinkedin = getBitly($linkedinUrl, ($shortenLinkedin ? $domain : "none"));
  $shortWeChat = getBitly($weChatUrl, ($shortenWeChat ? $domain : "none"));
  $shortWhatsApp = getBitly($whatsAppUrl, ($shortenWhatsApp ? $domain : "none"));
  $shortLine = getBitly($lineUrl, ($shortenLine ? $domain : "none"));
  $shortKakaoTalk = getBitly($kakaoTalkUrl, ($shortenKakaoTalk ? $domain : "none"));
  $shortEmail = getBitly($emailUrl, ($shortenImodules ? $domain : "none"));
  $shortGeneric = getBitly($originalUrl, ($shortenNone ? $domain : "none"));

  echo '<div class="result-row"><div class="result-label"><i class="fa fa-twitter"></i>Twitter:';
  echo '<button onclick="copyToClipboard(\'#twitterlink\')" class="btn btn-small btn-copy">Copy</button>';
  echo '</div><div class="result-short">';
  echo '<a href="' . $shortTwitter . '" id="twitterlink">' . $shortTwitter . '</a>';
  echo '<div class="result-long">' . str_replace('&', '<wbr>&', str_replace('/', '<wbr>/', $twitterUrl)) . '</div></div></div>';

  echo '<div class="result-row"><div class="result-label"><i class="fa fa-facebook"></i>Facebook:';
  echo '<button onclick="copyToClipboard(\'#Facebooklink\')" class="btn btn-small btn-copy">Copy</button>';
  echo '</div><div class="result-short">';
  echo '<a href="' . $shortFB . '" id="Facebooklink">' . $shortFB . '</a>';
  echo '<div class="result-long">' . str_replace('&', '<wbr>&', str_replace('/', '<wbr>/', $fbUrl)) . '</div></div></div>';


  echo '<div class="result-row"><div class="result-label"><i class="fa fa-instagram"></i>Instagram:';
  echo '<button onclick="copyToClipboard(\'#instagramlink\')" class="btn btn-small btn-copy">Copy</button>';
  echo '</div><div class="result-short">';
  echo '<a href="' . $shortInstagram . '" id="instagramlink">' . $shortInstagram . '</a>';
  
  echo '<div class="result-long">' . str_replace('&', '<wbr>&', str_replace('/', '<wbr>/', $instagramUrl)) . '</div></div></div>';

  echo '<div class="result-row"><div class="result-label"><i class="fa fa-linkedin"></i>linkedIn:';
  echo '<button onclick="copyToClipboard(\'#linkedinlink\')" class="btn btn-small btn-copy">Copy</button>';
  echo '</div><div class="result-short">';
  echo '<a href="' . $shortLinkedin . '" id="linkedinlink">' . $shortLinkedin . '</a>';
  
  echo '<div class="result-long">' . str_replace('&', '<wbr>&', str_replace('/', '<wbr>/', $linkedinUrl)) . '</div></div></div>';
  
  
  
  echo '<div class="result-row"><div class="result-label"><i class="fab fa-weixin"></i>WeChat:';
  echo '<button onclick="copyToClipboard(\'#weChatlink\')" class="btn btn-small btn-copy">Copy</button>';
  echo '</div><div class="result-short">';
  echo '<a href="' . $shortWeChat . '" id="weChatlink">' . $shortWeChat . '</a>';
  
  echo '<div class="result-long">' . str_replace('&', '<wbr>&', str_replace('/', '<wbr>/', $weChatUrl)) . '</div></div></div>';


  echo '<div class="result-row"><div class="result-label"><i class="fab fa-whatsapp"></i>WhatsApp:';
  echo '<button onclick="copyToClipboard(\'#whatsApplink\')" class="btn btn-small btn-copy">Copy</button>';
  echo '</div><div class="result-short">';
  echo '<a href="' . $shortWhatsApp . '" id="whatsApplink">' . $shortWhatsApp . '</a>';
  
  echo '<div class="result-long">' . str_replace('&', '<wbr>&', str_replace('/', '<wbr>/', $whatsAppUrl)) . '</div></div></div>';
  
  
  echo '<div class="result-row"><div class="result-label"><i class="fab fa-line"></i>LINE:';
  echo '<button onclick="copyToClipboard(\'#linelink\')" class="btn btn-small btn-copy">Copy</button>';
  echo '</div><div class="result-short">';
  echo '<a href="' . $shortLine . '" id="linelink">' . $shortLine . '</a>';
  
  echo '<div class="result-long">' . str_replace('&', '<wbr>&', str_replace('/', '<wbr>/', $lineUrl)) . '</div></div></div>';
  
  
  echo '<div class="result-row"><div class="result-label"><img src="https://developers.kakao.com/assets/img/about/logos/kakaolink/kakaolink_btn_medium_ov.png" style="width: 13px; margin-right: 6px;">KakaoTalk:';
  echo '<button onclick="copyToClipboard(\'#kakaotalklink\')" class="btn btn-small btn-copy">Copy</button>';
  echo '</div><div class="result-short">';
  echo '<a href="' . $shortKakaoTalk . '" id="kakaotalklink">' . $shortKakaoTalk . '</a>';
  
  echo '<div class="result-long">' . str_replace('&', '<wbr>&', str_replace('/', '<wbr>/', $kakaoTalkUrl)) . '</div></div></div>';



  echo '<div class="result-row"><div class="result-label"><i class="fa fa-envelope"></i>Email:';
  echo '<button onclick="copyToClipboard(\'#emaillink\')" class="btn btn-small btn-copy">Copy</button>';
  echo '</div><div class="result-short">';
  echo '<a href="' . $shortEmail . '" id="emaillink">' . $shortEmail . '</a>';
  echo '<div class="result-long">' . str_replace('&', '<wbr>&', str_replace('/', '<wbr>/', $emailUrl)) . '</div></div></div>';

  if ($customOther) {
    $shortOther = getBitly($otherUrl, $domain);
    echo '<div class="result-row"><div class="result-label"><i class="fa fa-pencil"></i>Custom:';
    echo '<button onclick="copyToClipboard(\'#otherlink\')" class="btn btn-small btn-copy">Copy</button>';
    echo '</div><div class="result-short">';
    echo '<a href="' . $shortOther . '" id="otherlink">' . $shortOther . '</a>';
    echo '<div class="result-long">' . str_replace('&', '<wbr>&', str_replace('/', '<wbr>/', $otherUrl)) . '</div></div></div>';
  }

  echo '<div class="result-row"><div class="result-label"><i class="fa fa-close"></i>No UTM:';
  echo '<button onclick="copyToClipboard(\'#genericlink\')" class="btn btn-small btn-copy">Copy</button>';
  echo '</div><div class="result-short">';
  echo '<a href="' . $shortGeneric . '" id="genericlink">' . $shortGeneric . '</a>';
  echo '<div class="result-long">' . str_replace('&', '<wbr>&', str_replace('/', '<wbr>/', $originalUrl)) . '</div></div></div>';



}
?>


  </div><!-- /#bitly-results -->
  </div><!-- /#bitly-outer -->

  <script>
    $('#row-sources input').change(function() {
      if (jQuery('#row-sources input:checked').length > 0) {
        jQuery('#choice-branded').slideDown();
      }
      else {
        jQuery('#choice-branded').slideUp();  
      }
    })

    $('#utm-submit').on('click', function(e) {
      var error = false;

      if ($('#utm-url').val() == '') {
        $('#utm-url').addClass('input-error');
        error = true;
      }
      if ($('#utm-campaign').val() == '') {
        $('#utm-campaign').addClass('input-error');
        error = true;
      }

      if ($('#utm-medium').val() == '' && $('#utm-source').val().length > 0) {
        $('#utm-medium').addClass('input-error');
        error = true;
      }
      if ($('#utm-source').val() == '' && $('#utm-medium').val().length > 0) {
        $('#utm-source').addClass('input-error');
        error = true;
      }


      if (error) {
        e.preventDefault()
      }
      else {
        $('.input-error').removeClass('input-error')
      }

    })

    function copyToClipboard(element) {
      var $temp = $("<input>");
      $("body").append($temp);
      $temp.val($(element).text()).select();
      document.execCommand("copy");
      $temp.remove();
    }

  </script>




<?php
	function getBitly($url, $site)
	{

    switch ($site) {
      case 'wewill':
        $login = 'northwesternu';
        $apikey = 'ef92c2b367c7e23872b17a451e86e1208271ba4a';
        $domain = 'wewill.nu';
        break;

      case 'giving':
        $login = 'ardmarcomm%40northwestern.edu';
        $apikey = '514bcbae703db90161967a432e3febefafe383f3';
        $domain = 'giving.nu';
        break;

      case 'NAA':
        $login = 'ardsocial%40northwestern.edu';
        $apikey ='0c3b654dae04b0e1b77c98381873b67ca4725056';
        $domain = 'alum.nu';
        break;
      
      default:
        $login = 'ardsocial%40northwestern.edu';
        $apikey ='0c3b654dae04b0e1b77c98381873b67ca4725056';
        $domain = 'bit.ly';
        break;
    }
	  //create the URL

    $bitly = 'https://api-ssl.bitly.com/v4/shorten?access_token=' . $apikey . '&longUrl=' . urlencode($url) . '&domain=' . urlencode($domain);

	  //get the url
	  $response = file_get_contents($bitly);
    $json = @json_decode($response,true);
    $short = $json['data']['url']; 
  	if ($short) // If it worked, return shorted URL
  		{return $short;}
  	else {return $url;} // If not, return full URL

	}


?>

</body></html>
