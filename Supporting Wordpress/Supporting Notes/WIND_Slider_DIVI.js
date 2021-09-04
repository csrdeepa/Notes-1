/***** Header *****/
jQuery( document ).ready(function() {
	jQuery('#cslider .et_pb_module').addClass('back-pos');
	
	var i = jQuery('#cslider .et_pb_module').length;
	jQuery('#cslider .et_pb_module').eq(i).removeClass('back-pos').addClass('left-pos');
	
 	jQuery('#cslider .et_pb_module').eq(1).removeClass('back-pos').addClass('main-pos');
	jQuery('#cslider .et_pb_module').eq(2).removeClass('back-pos').addClass('right-pos');	

	jQuery( "#cslider .et_pb_module" ).each(function( index ) {
		jQuery("#cslider .et_pb_module").eq(index).attr("id",index+1);	
	});

});	
 


function onPageLoad(){
	jQuery('#latest_news').find('article').prepend('<div class="rpublished" > </div>');
	//jQuery("#latest_news .pagination a").attr("onclick","javascript:onPageLoad()");

	var id = jQuery('#latest_news').find('article');
	var val ="";	
	for (var i = 0; i < id.length; i++) {
		val=  jQuery('#latest_news').find('article').eq( i ).find('.post-meta .published').text();
		jQuery('#latest_news article .rpublished')[i].prepend(val);
	}
}

/********** Footer *********/
jQuery(document).ready(function() {
// 	jQuery('#cslider .et_pb_module').addClass('back-pos');
// 	jQuery('#cslider .et_pb_module').eq(1).removeClass('back-pos').addClass('main-pos');
// 	jQuery('#cslider .et_pb_module').eq(2).removeClass('back-pos').addClass('right-pos');	

// 	var i = jQuery('#cslider .et_pb_module').length;
// 	jQuery('#cslider .et_pb_module').eq(i).removeClass('back-pos').addClass('left-pos');	
	
	jQuery('#cslider .et_pb_column').after('<div class="arrows"><div id="prev" class="button" ><img src="https://image.ibb.co/mRsEb7/left_arrow.png" alt=""></div><div id="next" class="button" ><img src="https://image.ibb.co/dfPSw7/right_arrow.png" alt=""></div></div>');
});

//slideshow style interval
var autoSwap = setInterval(swap, 6000);

//pause slideshow and reinstantiate on mouseout
jQuery('#cslider .et_pb_module').hover(
	function () {
		clearInterval(autoSwap);
	},
	function () {
		autoSwap = setInterval(swap, 6000);
	}
);

//global variables
var items = [];
var startItem = 1;
var position = 0;
var itemCount = jQuery('#cslider .et_pb_module').length;
var leftpos = itemCount;
var resetCount = itemCount;
// console.log("itemCount",itemCount);

// jQuery( "#cslider .et_pb_module" ).each(function( index ) {
// 	jQuery("#cslider .et_pb_module").eq(index).attr("id",index+1);	
// });

//unused: gather text inside items class
jQuery('#cslider .et_pb_module').each(function (index) {
	items[index] = jQuery(this).text();
});

//swap images function
function swap(action) {
	var direction = action;

	//moving carousel backwards
	if (direction == 'counter-clockwise') {
		var leftitem = jQuery('.left-pos').attr('id') - 1;
		if (leftitem == 0) {
			leftitem = itemCount;
		}

		jQuery('.right-pos').removeClass('right-pos').addClass('back-pos');
		jQuery('.main-pos').removeClass('main-pos').addClass('right-pos');
		jQuery('.left-pos').removeClass('left-pos').addClass('main-pos');
		jQuery('#' + leftitem + '').removeClass('back-pos').addClass('left-pos');

		startItem--;
		if (startItem < 1) {
			startItem = itemCount;
		}
	}

	//moving carousel forward
	if (direction == 'clockwise' || direction == '' || direction == null) {
		function pos(positionvalue) {
			if (positionvalue != 'leftposition') {
				position++;                //increment image list id

				if (startItem + position > resetCount) {                //if final result is greater than image count, reset position.
					position = 1 - startItem;
				}
			}

			//setting the left positioned item
			if (positionvalue == 'leftposition') {
				position = startItem - 1;          //left positioned image should always be one left than main positioned image.
				if (position < 1) {                //reset last image in list to left position if first image is in main position
					position = itemCount;
				}
			}

			return position;
		}

		jQuery('#' + startItem + '').removeClass('main-pos').addClass('left-pos');
		jQuery('#' + (startItem + pos()) + '').removeClass('right-pos').addClass('main-pos');
		jQuery('#' + (startItem + pos()) + '').removeClass('back-pos').addClass('right-pos');
		jQuery('#' + pos('leftposition') + '').removeClass('left-pos').addClass('back-pos');

		startItem++;
		position = 0;
		if (startItem > itemCount) {
			startItem = 1;
		}
	}
}

//next button click function
// jQuery('#next').click(function () {	swap('clockwise');});
jQuery(document).on("click", "#next", function () { swap('clockwise'); });

//prev button click function
// jQuery('#prev').click(function () {	swap('counter-clockwise');});
jQuery(document).on("click", "#prev", function () { swap('counter-clockwise'); });

//if any visible items are clicked
jQuery('#cslider .et_pb_module').click(function () {
	if ( jQuery("#cslider .et_pb_module").hasClass("left-pos") ) {  
		swap('counter-clockwise');
	} else
	{
		swap('clockwise');
	}
});
 
