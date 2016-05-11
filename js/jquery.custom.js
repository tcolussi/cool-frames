/*-----------------------------------------------------------------------------------

 	Custom JS - All front-end jQuery
 
-----------------------------------------------------------------------------------*/

// Get image source
function getFrame(){
	if (document.getElementById('icon')){
		var pic_src = document.getElementById('icon').value;
		return pic_src;
	}else{
		return '0';
	}
}

function setCamera(api_url){
	webcam.set_swf_url('js/webcam.swf');
	webcam.set_api_url(api_url);	
	webcam.set_quality(90);				
	webcam.set_shutter_sound(true, 'js/shutter.mp3');
}

// Frame replacement
function change(i) {
	name = 'images/frames/' + i + '.png';
	elem = document.getElementById('icon');
	elem.value = name;
	badge = i;
	$('#ajaxload').css('visibility','visible');
	$('#description, #camera').css("visibility","hidden");
	$('#frame').load('images/frames/'+i+'.png', function() {
		$('#ajaxload').css('visibility','hidden');
		$('#description, #camera').css('visibility','visible');	
		$('#frame').html('<img id="preview" src="images/frames/'+i+'.png"/>');
	});
}

$(function() {

	// Preloader
	$(window).load(function(){
		$('#preloader').fadeOut(500,function(){$(this).remove();});
	});
	
	// Scrollable
    $('.scrollable').scrollable({ 
		vertical: true 
	});
		
	// Tooltip
	$('.trigger').tooltip({
		relative: true, 
		position: 'bottom right', 
		effect: 'slide', 
		offset: [15, -180], 
		delay: 500 
	});
	
	// Frame Highlight
	$('#frames ul li').click(function(){
		$('#frames ul li').removeClass('selected');
		$(this).addClass('selected');
	});
	
	// Loading Message
	$('#upload').click(function(){		
		$('#loading').slideDown(500);
		$('body,html').animate({scrollTop:0},800);
	});
	
	$('#upload').click(function(){		
		message = document.getElementById('description').value;
		document.getElementById('message').value = message;
		document.getElementById('upload_form').submit();
		return false;
	});
		
	// Alert Messages
	setTimeout(function() {
		$("#success, #error").slideUp(500);
	}, 10000);
	
	// Banner animation
	var offset = $(".banner").offset();
	var topPadding = 20;
	$(window).scroll(function() {
		if ($(window).scrollTop() > offset.top) {
			$(".banner").stop().animate({
				marginTop: $(window).scrollTop() - offset.top + topPadding
			});
		} else {
			$(".banner").stop().animate({
				marginTop: 0
			});
		};
	});

	// Setting up the web camera
	var camera = $('#camera'),
		screen = $('#screen');

	// Temporary values
	setCamera('upload.php');
		
	screen.html(
		webcam.get_html(screen.width(), screen.height())
	);

	// Binding event listeners
	var shootEnabled = true;
	
	$('#shoot').click(function(){
		if(!shootEnabled){
			return false;
		}
		var validate = function() {
			val = document.getElementById('icon').value;
			if (val == ''){
				alert("Please select a frame for your webcam picture");
			}else{	
				webcam.freeze();
				setTimeout(function() {
					setCamera('upload.php?frame=' + getFrame());
					webcam.upload();
				}, 1000);
				generatePic();	
				return false;
			}
     	};
		validate();	
		return false;
	});

	$('#cancel').click(function(){
		webcam.reset();
		togglePane();
		resetValue();
		return false;
	});

	camera.find('#settings').click(function(){
		if(!shootEnabled){
			return false;
		}
		webcam.configure('camera');
		resetValue();
	});

	// Callbacks
	webcam.set_hook('onLoad',function(){
		shootEnabled = true;
	});
	
	webcam.set_hook('onComplete', function(msg){
		msg = $.parseJSON(msg);
		if(msg.error){
			$("#error").show();
		}
		else {
			$("#download").attr('href','download.php?photo=' + msg.filename);
			$("#photo").attr('value',msg.filename);
			togglePane();	
		}
	});
	
	webcam.set_hook('onError',function(e){
		screen.html(e);
	});

	// Helper functions
	function togglePane(){
		var visible = $('#camera .buttons-pane:visible:first');
		var hidden = $('#camera .buttons-pane:hidden:first');
		visible.fadeOut('fast',function(){
			hidden.show();
		});
	}
	
	function generatePic(){
		var change = $('#shoot').html('Generating...');
		var block = $('#overlay').fadeIn(500);
	}
	
	function resetValue(){
		var clear = document.getElementById("icon").value = "";
		var remove = $('#preview').remove();
		var highlight = $('#frames ul li').removeClass('selected');
		var change = $('#shoot').html('Shoot Picture');
		var block = $('#overlay').fadeOut(500);
	}
	
});