# Notes


####### Example witj ERRRROR

function getProductInfo(){
   var url = '/wp-json/wc/v2/products/',
   auth = '?consumer_key=OUR_KEY_HERE&oauth_signature_method=HMAC-SHA1&oauth_timestamp=1458225139&oauth_nonce=nVq4rX&consumer_secret=OUR_SECRET_HERE',
   url = url + $wcId + auth;

   $.get( url, function( data ) {
      $singleProduct = data;
      setProductInfo();
      setOrderButton();
   });
}
