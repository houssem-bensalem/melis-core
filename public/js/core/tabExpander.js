/* 
   tabExpander ---------------------------------------------------------------------------------------------------------------------
   script that handles when there are too many tabs open.
   creates a a slider effect so user can slide through each tabs.
*/

var tabExpander = (function($, window){
	
	// CACHE SELECTORS
	var $body = $("body");
	var $navTabs = $("#melis-id-nav-bar-tabs");
	
	// GLOBAL VARIABLES
	var tabContainerWidthPercent, rightMenuWidthPercent, navUlContainer = 0;
	var status = 'disabled';
	
	//get width width
    var screenSize = jQuery(window).width();
    
    // CHECK IF ENABLED
    function checkStatus(){
    	return status;
    }

	// ENABLE tabExpander(); ---------------------------------------------------------------------------------------------------------
	function Enable(){
			
	    //set the parent container width and right icons container
        $("#melis-navtabs-container-outer").css({"width": (tabContainerWidthPercent)+"%" });
        $("#plugins-container").css({"width": (rightMenuWidthPercent)+"%"});
        
        //get the width in % of #melis-navtabs-container-inner based from #melis-navtabs-container-outer - 56px for the prevnext buttons
        
        // var innerUlWidthPercent = 99 - ( (100 * 65) / $("#melis-navtabs-container-outer").outerWidth() ); 
        var innerUlWidthPercent = 100 - ( (100 * 65) / $("#melis-navtabs-container-outer").outerWidth() );
        
        $("#melis-navtabs-container-inner").css({"width": (innerUlWidthPercent)+"%" , "overflow":"hidden"});
        $navTabs.css({"width": navUlContainer });
        
        $(".melis-tabprev, .melis-tabnext").show();
        
	}
		
	// DISABLE tabExpander(); ---------------------------------------------------------------------------------------------------------
	function Disable(){
		$(".melis-tabprev, .melis-tabnext").hide();
        $("#melis-navtabs-container-outer, #melis-navtabs-container-inner, #plugins-container, #melis-id-nav-bar-tabs").removeAttr("style")
	}
    
    
	// CHECK TO ACTIVATE tabExpander(); ---------------------------------------------------------------------------------------------
	function checkTE(){

		// CALCULATE ALL POSSIBLE WIDTH FOR THE LEFT, CENTER AND RIGHT MENUS
	    
		//total width of the header
        var totalHeaderWidthPx = $("#id_meliscore_header").width();
        
        // left
        var leftMenuWidthPx = $(".navbar-header").width();
        var leftMenuWidthPercent = (100 * 274) / totalHeaderWidthPx;
        
        // right
        var rightMenuWidthPx = 0;
        $('#id_meliscore_header .navbar-right > li').each(function() {
            rightMenuWidthPx += $(this).outerWidth();
        });
        rightMenuWidthPercent = (( 100 * rightMenuWidthPx ) / totalHeaderWidthPx ) + 1;
        
        //center
        var tabContainerWidthPx = totalHeaderWidthPx - ( leftMenuWidthPx + rightMenuWidthPx ) - 320;
        /* tabContainerWidthPercent = 99 - ( leftMenuWidthPercent + rightMenuWidthPercent); */
		tabContainerWidthPercent = 100.5 - ( leftMenuWidthPercent + rightMenuWidthPercent);
        
        // <ul>
        navUlContainer = 1;
        $('#id_meliscore_header #melis-id-nav-bar-tabs > li').each(function() {
            navUlContainer += $(this).outerWidth();
        });
		
		// determines if TE should be activated or not
        if( navUlContainer > tabContainerWidthPx && screenSize  > 768 ){
        	Enable();
        	status = 'enabled';
        } else if( navUlContainer < tabContainerWidthPx){
			Disable();
        } else if(status == 'disabled'){
			Disable();
		} else {
        	if(status === 'enabled'){
				Enable();
        		/* Disable(); */
        	}
        	status = 'disabled';
        }
	}
	
	// TAB EXPANDER CONTROLS  --------------------------------------------------------------------------------------------------------
    var xleft, xright, ulContainer;
    function calcOffset(){
        ulContainer = $("#melis-navtabs-container-inner").outerWidth();
        var leftOffset = $navTabs.position().left;
        
        var ulWidth = 1; 
        $('#id_meliscore_header #melis-id-nav-bar-tabs > li').each(function() {
            ulWidth += $(this).outerWidth();
        });
        
        var rightOffset = ( $("#melis-navtabs-container-inner").outerWidth() - ulWidth ) - leftOffset;
        xleft = Math.abs( $navTabs.position().left );
        xright = Math.abs( ( $("#melis-navtabs-container-inner").outerWidth() - ulWidth ) - leftOffset);
    }
    
    //NEXT 
    $(".melis-tabnext").on("click", function(){
        calcOffset();
        if( xright > ulContainer ){
            $navTabs.animate({
                left: '-='+ulContainer
            },0);   
        }
        else{
            $navTabs.animate({
                left: '-=' + xright
            },0);
        }
    });
    
    //PREV
    $(".melis-tabprev").on("click", function(){
        calcOffset();
        if( xleft > ulContainer ){
            $navTabs.animate({
                left: '+='+ulContainer
            },0);
        }
        else{
            $navTabs.animate({
                left: '+=' + xleft
            },0);
        }
    }); 
    
	// FOCUS TAB ON CLICK (new functionality)
    function focusTab(){
    	
    }

    // CHECK tabExpander() WHEN WINDOW IS RESIZED
    $(window).resize(function(){
        screenSize = jQuery(window).width();
        if( screenSize >= 768 ){
        	checkTE();     
        }
    });

    
    
    
    
    
    
    
    
    
	/* 
    * RETURN ======================================================================================================================== 
    * include your newly created functions inside the object so it will be accessible outside scope
    * sample syntax in calling it outside - tabExpander.checkTE();
    */
	
	return{
		//key - access name outside                                 // value - name of function above
		
		checkTE						:						checkTE,
		focusTab					:						focusTab,
		Enable						:						Enable,
		Disable						:						Disable,
		checkStatus					:						checkStatus,
		
	}

})(jQuery, window);