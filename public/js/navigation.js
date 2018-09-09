//For Navigation Responsive Toggle

jQuery("#responsive-nav-button").click(function (){
	 
	 jQuery("#main_menu").slideToggle()
	 
  }
);

jQuery(".menu-button").click(function (){
	
	 //jQuery(".menu-button").removeClass("active");
	 
	 jQuery(this).next(".mega_menu").slideToggle();
	 
	 jQuery(this).next(".small_menu").slideToggle();
	 
	 jQuery(this).toggleClass("active");
	 
	 
  }
);