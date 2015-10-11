jQuery(document).ready(function() {  
		jQuery('.sidebarmenu ul:first > li ').addClass("main-links");	
	});
	
//Slidemenu
var menuids=["sidebarmenu1"] //Enter id(s) of each Side Bar Menu's main UL, separated by commas

function initsidebarmenu(){
for (var i=0; i<menuids.length; i++){
  var ultags=document.getElementById(menuids[i]).getElementsByTagName("ul")
    for (var t=0; t<ultags.length; t++){
    ultags[t].parentNode.getElementsByTagName("a")[0].className+=" subfolderstyle"
  if (ultags[t].parentNode.parentNode.id==menuids[i]) //if this is a first level submenu
   ultags[t].style.left=ultags[t].parentNode.offsetWidth+"px" //dynamically position first level submenus to be width of main menu item
  else //else if this is a sub level submenu (ul)
    ultags[t].style.left=ultags[t-1].getElementsByTagName("a")[0].offsetWidth+"px" //position menu to the right of menu item that activated it
    ultags[t].parentNode.onmouseover=function(){
    this.getElementsByTagName("ul")[0].style.display="block"
    }
    ultags[t].parentNode.onmouseout=function(){
    this.getElementsByTagName("ul")[0].style.display="none"
    }
    }
  for (var t=ultags.length-1; t>-1; t--){ //loop through all sub menus again, and use "display:none" to hide menus (to prevent possible page scrollbars
  ultags[t].style.visibility="visible"
  ultags[t].style.display="none"
  }
  }
}


	//Nested Side Bar Menu (Mar 20th, 09)
if (window.addEventListener)
window.addEventListener("load", initsidebarmenu, false)
else if (window.attachEvent)
window.attachEvent("onload", initsidebarmenu)


//slider
//    jQuery(document).ready(function(){	
//        var sudoSlider = jQuery("#slider").sudoSlider({
//           numeric:true,
//		   auto:true,
//		    continuous:false
//        });
//    });

// Main_slider Document
jQuery(document).ready(function(){	
	var sudoSlider = jQuery("#slider").sudoSlider({
		continuous:true,
		auto:true,
		vertical:false,      
		 numeric:true,
		beforeAniFunc: function(t){ 
        jQuery(this).children('.slider_text').hide();	
            },
         afterAniFunc: function(t){ 
         jQuery(this).children('.slider_text').slideDown(200);
            }
		});
	
		});	


//slider_2
jQuery(document).ready(function(){	
        var sudoSlider = jQuery("#slider_2").sudoSlider({
            continuous:true,
			auto:false,
			autowidth:false,
			slideCount:1,
			numeric:'pages',
			moveCount:4,
			numeric:false
        });
    });



//slider_3
jQuery(document).ready(function(){	
        var sudoSlider = jQuery("#slider_3").sudoSlider({
           vertical:false,
			continuous:true,
			auto:true,
			autowidth:true,
			numeric:false
        });
    });

//slider_4
jQuery(document).ready(function(){	
        var sudoSlider = jQuery("#testimonials").sudoSlider({
           vertical:true,
			continuous:true,
			auto:false,
			autowidth:true,
			numeric:false
        });
    });



//Tabs
jQuery(document).ready(function () {
				jQuery('#menu').tabify();
			});
