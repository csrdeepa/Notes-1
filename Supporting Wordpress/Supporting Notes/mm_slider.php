<style>

/** ***** **/
.sliders_mobile_contnew .arrow_click {
    display: flex;
	align-items: center;
    justify-content: space-between;
    background-color: #fff;
    position: absolute;
    z-index: 9;
    width: 100%;
    max-width: 550px;
}
.sliders_mobile_contnew .arrow_click,
.sliders_mobile_contnew .arrow_click h3{
	color: #222f93 !important;
}
.sliders_mobile_contnew .arrow_click h3{
	padding-bottom: 0px;
}
.sliders_mobile_contnew .arrow_click i{
	font-size: 40px;
}
/* .sliders_mobile_contnew .arrow_click, */
.sliders_mobile_contnew .formobilearrow {
    padding: 3px 0px 3px 15px;
}
.sliders_mobile_contnew .arrow_click {
    padding: 20px 20px 3px;
}
.sliders_mobile_contnew .et_pb_blurb_zero.et_pb_blurb .sliinner {
    background-image: url(/wp-content/uploads/Situational_Depression_solution_desktop_2.jpg);
}
.sliders_mobile_contnew .et_pb_blurb_one.et_pb_blurb .sliinner {
    background-image: url(/wp-content/uploads/Anxiety_slider_3.png);   
}
.sliders_mobile_contnew .et_pb_blurb_two.et_pb_blurb .sliinner {
    background-image: url(/wp-content/uploads/Cognitive_decline_MOBILE_2.png);   
}
.sliders_mobile_contnew .et_pb_blurb_three.et_pb_blurb .sliinner {
    background-image: url(/wp-content/uploads/new-sidelined.jpg); 
}
.sliders_mobile_contnew .et_pb_blurb_four.et_pb_blurb .sliinner{
    background-image: url(/wp-content/uploads/Stress_slider_3.png);    
}

.sliders_mobile_contnew .et_pb_blurb_content.sliinner {
    font-weight: 300;
    font-size: 1.3em;
    color: rgba(0,0,0,0) !important;
    background-blend-mode: multiply;
    overflow-x: hidden;
    overflow-y: hidden;
    padding-top: 230px !important;
    flex: 1;
    position: relative !important;
    transition: flex 800ms !important;
    height: 0px;
    width: 100%;
    background-position: center 20%;
    transform: scale(1,1);
}

.sliders_mobile_contnew .et_pb_blurb_zero .sliinner.newimg {
    background-image: url(/wp-content/uploads/Situational_Depression_solution_desktop_2.jpg);
    background-color: rgba(49,145,130,0.7); 
}
.sliders_mobile_contnew .et_pb_blurb_one .sliinner.newimg {
    background-image: url(/wp-content/uploads/Anxiety_slider_3.png);
    background-color: rgba(232,229,78,0.8);
}
.sliders_mobile_contnew .et_pb_blurb_two .sliinner.newimg {
    background-image: url(/wp-content/uploads/Cognitive_decline_MOBILE.png);
    background-color: rgba(90,42,144,0.65);
}
.sliders_mobile_contnew .et_pb_blurb_three .sliinner.newimg {
    background-image: url(/wp-content/uploads/quino-al-ibe1yWLksg-unsplash_BW_2-scaled.jpg);
    background-color: rgba(255,138,21,0.85);
}
.sliders_mobile_contnew .et_pb_blurb_four .sliinner.newimg {
    background-image: url(/wp-content/uploads/Stress_slider_3.png);
    background-color: #569bae;
}
.sliders_mobile_contnew .sliinner.newimg {
    height: initial;
    background-size: cover;
}
.sliders_mobile_contnew h3.et_pb_module_header {
    display: none;
}
.sliders_mobile_contnew .et_pb_column .et_pb_module {
    margin-bottom: 0px;
}
.sliders_mobile_contnew .newimg .et_pb_blurb_description {
    color: #fff;
}
.sliders_mobile_contnew .et_pb_blurb_content.sliinner ,
.sliders_mobile_contnew .et_pb_blurb_content.sliinner.newimg,
.sliders_mobile_contnew .arrow_click i,
.sliders_mobile_contnew .arrow_click h3 {
    animation-duration: 30s;
    animation-iteration-count: infinite;
    animation: 10s ease-in infinite;
    transition: all .9s cubic-bezier(0,0.41,0.99,0.6)!important;
}
.sliders_mobile_contnew .et_pb_blurb_content.sliinner.newimg {
    padding: 40px 20px 35px 20px;
    /* height: 100% !important;
    padding-top: 85px!important;   */
    height: 100% !important;
    max-height: 385px !important;
    padding-top: 135px!important ;
    padding-bottom: 90px !important;  
}
.sliders_mobile_contnew .arrow_click.is_active_hover {
    background-color: #fff0;
}
.sliders_mobile_contnew .arrow_click.is_active_hover, 
.sliders_mobile_contnew .arrow_click.is_active_hover h3 {
    color: #fff!important;
}
.et_pb_blurb_position_left .et_pb_blurb_container {
    padding-left: 0px;
}
@media only screen and (min-width: 981px) {
    .customslidenew .sliders_mobile_contnew{
        display: none;
    }
}
@media only screen and (max-width: 980px) {
	.sliders_mobile_contnew .arrow_click h3{
		font-size: 23px;
		line-height: 1.5;
	}
	.sliders_mobile_contnew .et_pb_blurb_content p {
		font-size: 14px;
		line-height: 1.7;
    	text-align: left;		
	}
}
@media only screen and (max-width: 767px) {
	.sliders_mobile_contnew.et_pb_row {
		width: 100%;
		margin: 0;
		padding: 10px;
		margin-left: 0;
		margin-right: 0;
	}
	.sliders_mobile_contnew .arrow_click h3{
		font-size: 18px;
		line-height: 1.4;
	}
	.sliders_mobile_contnew .et_pb_blurb_content p {
		font-size: 13px;
		line-height: 1.5;
	}
	.sliders_mobile_contnew .arrow_click i {
    	font-size: 30px;
	}
	/* .sliders_mobile_contnew .formobilearrow,
	.sliders_mobile_contnew .arrow_click {
	    padding: 3px 10px;
	} */
}

@media ( max-width: 980px){
    .et-custom-row {
        max-height: 99vh !important;
        overflow-y: scroll;
    }
    .et-custom-row span.et-lb-close {
        top: 20%;
    }
}

@media ( max-width: 980px){
    .et-lb-content-1, .et-lb-content-1 .et-custom-row {
        padding:0 !important
    }
}
@media only screen and (max-width: 345px) {
    .sliders_mobile_contnew .formobilearrow {
        padding: 3px 0px 3px 7px !important;
    }
    .sliders_mobile_contnew .arrow_click h3 {
        font-size: 16px;
    }
    .sliders_mobile_contnew .et_pb_blurb_content.sliinner.newimg {
        padding-top: 125px!important;
        padding-bottom: 70px!important;
    }
}
</style>
<script>
jQuery(document).ready(function($){
	if($('*').hasClass('customslidenew')) {
// 	if($('body').hasClass('page-id-38925')) {
// 		$('.page-id-38925 ').addClass('customslide');
		var content_to_dupe = $('.et_pb_section_0 .et_pb_row_0').html();
		
		$('.et_pb_section_0 ').append('<div class="sliders_mobile_contnew et_pb_row">' + content_to_dupe + '</div>');

		$('.sliders_mobile_contnew .et_pb_blurb_0').addClass('et_pb_blurb_zero');
		$('.sliders_mobile_contnew .et_pb_blurb').removeClass('et_pb_blurb_0');

		$('.sliders_mobile_contnew .et_pb_blurb_1').addClass('et_pb_blurb_one');
		$('.sliders_mobile_contnew .et_pb_blurb').removeClass('et_pb_blurb_1');

		$('.sliders_mobile_contnew .et_pb_blurb_2').addClass('et_pb_blurb_two');
		$('.sliders_mobile_contnew .et_pb_blurb').removeClass('et_pb_blurb_2');

		$('.sliders_mobile_contnew .et_pb_blurb_3').addClass('et_pb_blurb_three');
		$('.sliders_mobile_contnew .et_pb_blurb').removeClass('et_pb_blurb_3');

		$('.sliders_mobile_contnew .et_pb_blurb_4').addClass('et_pb_blurb_four');
		$('.sliders_mobile_contnew .et_pb_blurb').removeClass('et_pb_blurb_4');		
	}
	$('.sliders_mobile_contnew .et_pb_blurb .et_pb_blurb_content').addClass('sliinner');
	$('.sliders_mobile_contnew .et_pb_blurb').removeClass('et_clickable');
	
	//###Zero
	$('.sliders_mobile_contnew .et_pb_blurb_zero').prepend('<div class="arrow_click"><div class="formobilelbl"><h3>Emotional imbalance</h3></div> <div class="formobilearrow "><i class="fa fa-angle-down" aria-hidden="true"></i></div> </div>');
    $('.et_pb_blurb_zero .arrow_click').on('click', function(e){
		e.preventDefault();
		if($(this).hasClass('is_active_hover')) {
			 $(this).removeClass('is_active_hover');
			 $('.sliders_mobile_contnew .et_pb_blurb .sliinner').removeClass('newimg');
            $('.sliders_mobile_contnew .arrow_click .formobilearrow i').removeClass('fa-angle-up').addClass('fa-angle-down');				
		} else {
			$('.sliders_mobile_contnew .et_pb_blurb .arrow_click').removeClass('is_active_hover');
			$(this).addClass('is_active_hover');
			$('.sliders_mobile_contnew .et_pb_blurb .sliinner').removeClass('newimg');				
			$('.sliders_mobile_contnew .et_pb_blurb_zero .sliinner').addClass('newimg');
			$('.sliders_mobile_contnew .arrow_click .formobilearrow i').removeClass('fa-angle-up').addClass('fa-angle-down');
            $('.sliders_mobile_contnew .arrow_click.is_active_hover .formobilearrow i').removeClass('fa-angle-down').addClass('fa-angle-up');				
		}
	});

    $('.et_pb_blurb_zero .sliinner').on('click', function(e){
		e.preventDefault();
		if($(this).hasClass('newimg')) {
			 window.location = 'https://mindmarbles.com.au/emotional-balance/';
		}else{
        }
	});
    //###One 
    $('.sliders_mobile_contnew .et_pb_blurb_one').prepend('<div class="arrow_click"><div class="formobilelbl"><h3>Mental uncertainty</h3></div> <div class="formobilearrow "><i class="fa fa-angle-down" aria-hidden="true"></i></div> </div>');
    $('.et_pb_blurb_one .arrow_click').on('click', function(e){
		e.preventDefault();
		if($(this).hasClass('is_active_hover')) {
			 $(this).removeClass('is_active_hover');
			 $('.sliders_mobile_contnew .et_pb_blurb .sliinner').removeClass('newimg');
            $('.sliders_mobile_contnew .arrow_click .formobilearrow i').removeClass('fa-angle-up').addClass('fa-angle-down');				
		} else {
			$('.sliders_mobile_contnew .et_pb_blurb .arrow_click').removeClass('is_active_hover');
			$(this).addClass('is_active_hover');
			$('.sliders_mobile_contnew .et_pb_blurb .sliinner').removeClass('newimg');				
			$('.sliders_mobile_contnew .et_pb_blurb_one .sliinner').addClass('newimg');		
			$('.sliders_mobile_contnew .arrow_click .formobilearrow i').removeClass('fa-angle-up').addClass('fa-angle-down');
            $('.sliders_mobile_contnew .arrow_click.is_active_hover .formobilearrow i').removeClass('fa-angle-down').addClass('fa-angle-up');					
		}
	});
    $('.et_pb_blurb_one .sliinner').on('click', function(e){
		e.preventDefault();
		if($(this).hasClass('newimg')) {
			 window.location = 'https://mindmarbles.com.au/Mental-resilience/';
		}else{
        }
	});
    //###Two	
    $('.sliders_mobile_contnew .et_pb_blurb_two').prepend('<div class="arrow_click"><div class="formobilelbl"><h3>Cognitive vitality</h3></div> <div class="formobilearrow  "><i class="fa fa-angle-down" aria-hidden="true"></i></div> </div>');
    $('.et_pb_blurb_two .arrow_click').on('click', function(e){
		e.preventDefault();
		if($(this).hasClass('is_active_hover')) {
			 $(this).removeClass('is_active_hover');
			 $('.sliders_mobile_contnew .et_pb_blurb .sliinner').removeClass('newimg');
            $('.sliders_mobile_contnew .arrow_click .formobilearrow i').removeClass('fa-angle-up').addClass('fa-angle-down');				
		} else {
			$('.sliders_mobile_contnew .et_pb_blurb .arrow_click').removeClass('is_active_hover');
			$(this).addClass('is_active_hover');
			$('.sliders_mobile_contnew .et_pb_blurb .sliinner').removeClass('newimg');				
			$('.sliders_mobile_contnew .et_pb_blurb_two .sliinner').addClass('newimg');	
			$('.sliders_mobile_contnew .arrow_click .formobilearrow i').removeClass('fa-angle-up').addClass('fa-angle-down');
            $('.sliders_mobile_contnew .arrow_click.is_active_hover .formobilearrow i').removeClass('fa-angle-down').addClass('fa-angle-up');					
		}
	});
    $('.et_pb_blurb_two .sliinner').on('click', function(e){
		e.preventDefault();
		if($(this).hasClass('newimg')) {
			 window.location = 'https://mindmarbles.com.au/cognitive-vitality/';
		}else{
        }
	});
    //###Three	
    $('.sliders_mobile_contnew .et_pb_blurb_three').prepend('<div class="arrow_click"> <div class="formobilelbl"><h3>Head-knocks, blows & jolts</h3></div><div class="formobilearrow"><i class="fa fa-angle-down" aria-hidden="true"></i></div> </div>');
    $('.et_pb_blurb_three .arrow_click').on('click', function(e){
		e.preventDefault();
		if($(this).hasClass('is_active_hover')) {
			 $(this).removeClass('is_active_hover');
			 $('.sliders_mobile_contnew .et_pb_blurb .sliinner').removeClass('newimg');
            $('.sliders_mobile_contnew .arrow_click .formobilearrow i').removeClass('fa-angle-up').addClass('fa-angle-down');				
		} else {
			$('.sliders_mobile_contnew .et_pb_blurb .arrow_click').removeClass('is_active_hover');
			$(this).addClass('is_active_hover');
			$('.sliders_mobile_contnew .et_pb_blurb .sliinner').removeClass('newimg');				
			$('.sliders_mobile_contnew .et_pb_blurb_three .sliinner').addClass('newimg');		
			$('.sliders_mobile_contnew .arrow_click .formobilearrow i').removeClass('fa-angle-up').addClass('fa-angle-down');
            $('.sliders_mobile_contnew .arrow_click.is_active_hover .formobilearrow i').removeClass('fa-angle-down').addClass('fa-angle-up');					
		}
	});
    $('.et_pb_blurb_three .sliinner').on('click', function(e){
		e.preventDefault();
		if($(this).hasClass('newimg')) {
			 window.location = 'https://mindmarbles.com.au/brain-health-and-resilience/';
		}else{
        }
	});
    //###Four	
    $('.sliders_mobile_contnew .et_pb_blurb_four').prepend('<div class="arrow_click"> <div class="formobilelbl"><h3>Modern living & burnout</h3></div><div class="formobilearrow  "><i class="fa fa-angle-down" aria-hidden="true"></i></div> </div>');
    $('.et_pb_blurb_four .arrow_click').on('click', function(e){
		e.preventDefault();
		if($(this).hasClass('is_active_hover')) {
			 $(this).removeClass('is_active_hover');
			 $('.sliders_mobile_contnew .et_pb_blurb .sliinner').removeClass('newimg');
            $('.sliders_mobile_contnew .arrow_click .formobilearrow i').removeClass('fa-angle-up').addClass('fa-angle-down');				
		} else {
			$('.sliders_mobile_contnew .et_pb_blurb .arrow_click').removeClass('is_active_hover');
			$(this).addClass('is_active_hover');
			$('.sliders_mobile_contnew .et_pb_blurb .sliinner').removeClass('newimg');				
			$('.sliders_mobile_contnew .et_pb_blurb_four .sliinner').addClass('newimg');	
			$('.sliders_mobile_contnew .arrow_click .formobilearrow i').removeClass('fa-angle-up').addClass('fa-angle-down');
            $('.sliders_mobile_contnew .arrow_click.is_active_hover .formobilearrow i').removeClass('fa-angle-down').addClass('fa-angle-up');					
		}
	});
    $('.et_pb_blurb_four .sliinner').on('click', function(e){
		e.preventDefault();
		if($(this).hasClass('newimg')) {
			 window.location = 'https://mindmarbles.com.au/mood-stability/';
		}else{
        }
	});
});
</script>
