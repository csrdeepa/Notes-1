/**/
jQuery( document ).ready(function() {
// 	jQuery('#latest_news').find('.pagination').prepend('<div class="test" style="width: fit-content;">test</div>');	
// 	jQuery('#latest_news').find('article').prepend('<div class="rpublished" > </div>');	
 
// 	var id = jQuery('#latest_news').find('article'); //document.getElementsById('#latest_news');
// 	var val ="";	
// 	for (var i = 0; i < id.length; i++) {
// 		val=  jQuery('#latest_news').find('article').eq( i ).find('.post-meta .published').text();
// 		jQuery('#latest_news article .rpublished')[i].prepend(val);
// 	}

// 	jQuery( " .pagination a" ).click(function() {
// 	   onPageLoad();
// 	});	
	jQuery("#latest_news .et_pb_posts").attr("id","test");
	onPageLoad();
	jQuery("#latest_news .pagination a").attr("onclick","javascript:onPageLoad()");
});	
// jQuery(document).on('click','a[href]',function(){
// 	 onPageLoad();
// });
// jQuery(window).on('beforeunload', function () {
// 	onPageLoad();
// }); onclick="javascript:triggerMe()"

 
//   jQuery('#latest_news .et_pb_posts .et_pb_ajax_pagination_container').on('load', function() {
//      onPageLoad();
//   }());
 
jQuery('body').on('DOMSubtreeModified', '.et_pb_posts', function(){
   onPageLoad();
});
jQuery('.et_pb_posts').on('DOMSubtreeModified', function(){
    onPageLoad();
});
  jQuery('.et_pb_posts').bind('DOMSubtreeModified', function() {
     onPageLoad();
  }());
function onPageLoad(){
	jQuery('#latest_news').find('article').prepend('<div class="rpublished" > </div>');
	jQuery("#latest_news .pagination a").attr("onclick","javascript:onPageLoad()");

	var id = jQuery('#latest_news').find('article');
	var val ="";	
	for (var i = 0; i < id.length; i++) {
		val=  jQuery('#latest_news').find('article').eq( i ).find('.post-meta .published').text();
		jQuery('#latest_news article .rpublished')[i].prepend(val);
	}
}
 
 /////////////////////

 jQuery('#latest_news').find('article').eq( i ).find('.post-meta .published').text();

// 	jQuery('article:nth-child(n+1)').before(jQuery('article:nth-child(n+1) .published').html());
var secondDiv = document.getElementsByTagName('article')[2];
var $secondDiv = $(document.getElementsByClassName('div'));
console.log("secondDiv :", secondDiv);
console.log("secondDivddd :", $secondDiv);

jQuery(document).on('click','a[href]',function(){
	 onPageLoad();
});
jQuery(window).on('beforeunload', function () {
	onPageLoad();
});
