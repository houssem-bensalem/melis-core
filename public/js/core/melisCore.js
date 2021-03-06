// GLOABAL SCOPE / GLOBAL VARIABLES ===================================================================================================

// current tab open
var activeTabId;

//Melis Core Functionalities 
var melisCore = (function(window){
    
    var version = "2.0.0";
    
    //CACHE SELECTORS =================================================================================================================
    var $body = $("body");
    var $navTabs = $("#melis-id-nav-bar-tabs");
    var $flashMessenger = $("#flash-messenger");
    var $centerContent = $("#melis-id-body-content-load");
    var screenSize = jQuery(window).width();

    // MAIN FUNCTIONS =================================================================================================================
    
    // CHANGE LANGUAGE
    window.melisChangeLanguage = function(langId){
        var datastring = { langId: langId };
        $.ajax({
            type        : 'GET', 
            url         : '/melis/change-language',
            data        : datastring,
            dataType    : 'json',
            encode      : true
        }).success(function(data){
            if (data.success){
            	location.reload();
            }
            else{
            	alert( translations.tr_meliscore_error_language );
            }
        }).error(function(){
        	alert( translations.tr_meliscore_error_message );
        });
    }
    
    // REQUEST LOST PASSWORD
    $('#idformmeliscoreforgot').submit(function(event) {
        var datastring = $("#idformmeliscoreforgot").serialize();
        console.log(datastring);
        $.ajax({
            type        : 'POST', 
            url         : '/melis/lost-password-request',
            data        : datastring,
            dataType    : 'json',
            encode      : true
        }).success(function(data){
            if (data.success) {
            	melisTool.alerts.showSuccess('#lostpassprompt', "", data.message);
               $('#idformmeliscoreforgot')[0].reset();
            }
            else{
            	melisTool.alerts.showDanger('#lostpassprompt', translations.tr_meliscore_common_error+"!", data.message);
            }
        }).error(function(){
        	alert( translations.tr_meliscore_error_message );
        });
        event.preventDefault();
    });
    
	function sessionCheck() {
		var checkEvery = 1; 
		setInterval(function() {
	        $.ajax({
	            type: 'GET',
	            url: '/melis/islogin',
	            dataType: 'json',
	        }).success(function(data){
	        	if(!data.login) {
	        		window.location.reload(true);
	        	}
	        });
		}, (checkEvery * 60) * 1000);
	}

    function escapeHtml (string) {
        var entityMap = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#39;',
            '/': '&#x2F;',
            '`': '&#x60;',
            '=': '&#x3D;'
        };

        return String(string).replace(/[&<>"'`=\/]/g, function (s) {
            return entityMap[s];
        });
    }

    // FLASH MESSENGER 
    function flashMessenger() {
        $.ajax({
            type: 'GET',
            url: '/melis/MelisCore/MelisFlashMessenger/getflashMessage',
            dataType: 'json',
        }).success(function(data, status, xhr){
        	// check if there is a flash message
            if(data.flashMessage.length) {
            	$flashMessenger.removeClass("empty-notif");
            	$body.find("#flash-messenger").prev().find(".badge").removeClass("hidden");
            	
                var ctr = 0;
                $body.find("#flash-messenger").empty();
                var tempData = '';
                $.each(data, function(index, element) {
                    $.each(element, function(index, fm){
                        tempData += "" +
                                "<li>" +
                                "	<span class='img-circle media-object "+fm.image+"'></span>" +
                                "   <div class='media'>" +
                                "       <div class='media-body'>" +
                                "           <a  class='strong text-primary'>"+(fm.title)+"</a><span class='time-email'>"+fm.date_trans+' '+fm.time+"</span>" +
                                            "<div class='clearfix'></div>"+(fm.message)+
                                        "</div>" +
                                    "</div>" +
                                "</li>";
                        ctr++;
                    });
                });
                $body.find("#flash-messenger").append(tempData);
                $body.find("#id_meliscore_header_flash_messenger.dropdown.notification a span.badge").text(ctr);
            }
        }).error(function(){
        	alert( translations.tr_meliscore_error_message );
        });
    }
    
    // FIRST RENDER - runs when the page is first loaded
    function firstRender(){
        $(".nav-tabs li:first-child").addClass("active")
        $(".tab-content > div:first-child").addClass("active");
    }
    
    // OPEN TOOLS - opens the tools from the sidebar
    function openTools(){
        var data = $(this).data();
        melisHelper.tabOpen( data.toolName, data.toolIcon, data.toolId, data.toolMeliskey );
    }
    
    // OPEN DASHBOARD - opens the dashboard from the sidebar
    function openDashboard(){
        melisHelper.tabOpen( 'Dashboard', 'fa-dashboard', 'id_meliscore_center_dashboard', 'meliscore_center_dashboard' );
    }
    
    // REFRESH DASHBOARD ITEMS - refreshes the dashboard widgets
    function refreshZone(){
    	var melisKey = $(this).closest("div.widget-parent").data("meliskey");
    	var zoneId = $(this).closest("div.widget-parent").attr("id");
    	melisHelper.zoneReload(zoneId, melisKey); 
    }
    
    // REFRESH TABLE ITEMS
    function refreshTable(){
    	var melisKey = $(this).parents(".container-level-a").data("meliskey");
    	var zoneId = $(this).parents(".container-level-a").attr("id");
    	melisHelper.zoneReload(zoneId, melisKey); 
    }

    // IFRAME HEIGHT CONTROLS (for onload, displaySettings & sidebar collapse)
    function iframeLoad(){
    	var height = $("#"+ activeTabId + " .melis-iframe").contents().height();
    	$("#"+ activeTabId + " .melis-iframe").css("height", height);
    	$("#"+ activeTabId + " .melis-iframe").css("min-height", "700px");  
    	
    	// Saving all the editable component from edition
		// Saving all content to xml for publish
		
		var x, dataStringTags =[],dataTagVal = [];		
				
		$("#"+ activeTabId + " iframe").contents().find('.melis-editable').each(function(){
			var data = {
				'tagID' : $(this).attr('data-tag-id'),
				'tagVal': $(this).html()
			}
			dataTagVal.push(data);
		});
		
		// check and Get all Editable Value and dataTags from Editor TinyMCE
		$.ajax({
			type        : 'POST', 
			url         : '/melis/MelisCms/PageEdition/savePageTagSession?idPage='+$("#"+ activeTabId + " iframe").attr('data-iframe-id'),
			/* url         : '/MelisCms/PageEdition/savePageTagSession?idPage='+idPage, */
			data        : {'myArray': dataTagVal}, 
			dataType    : 'json',
			encode		: true
		}).success(function(data){
			//console.log(data)
		});
    }	
   
    // SIDEBAR MENU CLICK (toggle)
    function sidebarMenuClick(){
    	$body.toggleClass('sidebar-mini');
    	
    	// for the sidebar functionalities
    	var sidebarOffsetLeft = $( "#id_meliscore_leftmenu" ).position().left;
    	var sidebarWidth =  $( "#id_meliscore_leftmenu" ).outerWidth();
    	
		if( sidebarOffsetLeft == 0){
			$( "#id_meliscore_leftmenu" ).css("left", -sidebarWidth );
		}
		else{
			$( "#id_meliscore_leftmenu" ).css("left", '0' );
		}
    			
    	$("#newplugin-cont").removeClass("show-menu");
    	
    	// HOOK - scroll the page by 1px to trigger the scroll event that resizes the pageActions container
    	// check if activeTabId has a number. if it has then we assume its a page
    	var matches = activeTabId.match(/\d+/g);
    	if (matches != null) {
    		$("html, body").animate({scrollTop: jQuery(window).scrollTop()+1 },0);
    	}

    	// footer display
    	$("#id_meliscore_footer").toggleClass('slide-left');
    	
    	// fix for the iframe height scrollbar issue when we open/close the sidebar. the timeout is for the sidebar transition
    	setTimeout(function(){
    		iframeLoad();
    		
    		// dataTable responsive plugin ----=[ PLUGIN BUG FIX ]=-----
    		$("table.dataTable").DataTable().columns.adjust().responsive.recalc();
    	}, 300);	
    }
    
    // MAIN TAB MENU CLICK - run codes when a tab in the main tab menu is clicked
    function tabMenuClick(){
    	activeTabId = $(this).data("id");
    	
        // iframe height issue in pages
        if ($.browser) {
		    // Firefox bug issue temp fix
		    var iHeight;
		    setTimeout(function(){
		    	iHeight = $("#"+activeTabId+" .melis-iframe").contents().find("html").height();
		        $("#"+activeTabId+" .melis-iframe").height(iHeight);
		    }, 1);  
		}
        else{
        	var iHeight = $("#"+activeTabId+" .melis-iframe").contents().find("html").height();
        	$("#"+activeTabId+" .melis-iframe").height( iHeight+20 );
        }
        
        // if in mobile hide 'PAGES' menu when clicking / opening a page
        if(screenSize <= 768){
            $("#res-page-cont").trigger('click');
            $("#res-page-cont i").removeClass("move-arrow");
            
            $('html, body').animate({scrollTop:0},500);
        }
        
        // scroll top every time we click a tab to RESET the scrollbars and return page actions to original position
        $("#"+ activeTabId + " .page-head-container").removeAttr("style");
        $("#"+ activeTabId + " .page-head-container > .innerAll").removeClass('sticky-pageactions');
        $("#"+ activeTabId + " .page-head-container > .innerAll").removeAttr("style");
        $('html, body').animate({scrollTop:0},0);
        
        // dataTable responsive plugin ----=[ PLUGIN BUG FIX ]=-----
        $("table.dataTable").DataTable().columns.adjust().responsive.recalc();
    }
    
    // --=[ MULTI LAYER MODAL FEATURE ]=--
	$(document).on('show.bs.modal', '.modal', function (event) {
        var zIndex = 1040 + (10 * $('.modal:visible').length);
        $(this).css('z-index', zIndex);
        setTimeout(function() {
            $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
        }, 0);
    });
	
	// ---=[ MODAL BUGFIX ]=--- for showing 2 level modals 
	$(document).on('hidden.bs.modal', '.modal', function (event) {
		var check = $body.find(".modal-backdrop").length;
		if(check){ 
			$body.addClass("modal-open");
		}
		else{
			// clear melis modals container
			$("#melis-modals-container").empty();
		}
	});

    // ---=[ START ]=--- MULTI VALUE INPUT FILED JS --------------------------------------------------
    
    // focus the tag box when we click
    $body.on("click", ".multi-value-input", function(){
    	$(this).find(".tag-creator input").focus();
    });
    
    // remove a specific tag
    $body.on("click", ".multi-value-input .remove-tag", function(){
    	var that = $(this).parents('.multi-value-input');
    	$(this).parent('li').fadeOut(500, function(){  // run it when the fadeOut completes the action
    		
    		$(this).remove(); 
    	
    		// get all datas
    		var tagDatas = [];
    		that.children('li:not(:last-child)').each(function(index){
    			tagDatas.push( $(this).children('span').text() );
    		});
    		
    		// set the datas in data-tags and the actual data inside the input
    		that.find(".melis-multi-val-input").data("tags", tagDatas);
    		that.find(".melis-multi-val-input").attr("data-tags", tagDatas);
    	});
    });
    
    // add a specific tag. triggered by a comma (,)
    var commaHandler = false;
    $body.on("keydown", ".multi-value-input .tag-creator input", function(event){
    	
    	var tagValue = $(this).val();
    	
    	// check if comma was pressed
    	if(event.keyCode == 188) {
    		if( commaHandler === false && tagValue && tagValue !== ',' ){
    			
    			var newLi = '<li><span>' + tagValue + '</span><a class="remove-tag fa fa-times"></a></li>';
        		$(newLi).insertBefore( $(this).parent("li") );
        		$(this).val('');
        		commaHandler = true;
        		
        		// get all datas 
        		var tagDatas = [];
        		$(this).parents('.multi-value-input').children('li:not(:last-child)').each(function(index){
        			tagDatas.push( $(this).children('span').text() );
        		});
        		
        		// set the datas
        		$(this).data("tags", tagDatas); //sets actual data that can be called using .data();
        		$(this).attr("data-tags", tagDatas); //sets data inside attr for viewing only
    		}
    		else{
    			$(this).val('');
    		}
        }
    });
    
    // add a specific tag. triggered by a comma (,)
    $body.on("keyup", ".multi-value-input .tag-creator input", function(event){
    	if(event.keyCode == 188) {
    		$(this).val('').focus();
    		commaHandler = false;
    	}
    });
    // ---=[ END ]=--- MULTI VALUE INPUT FILED JS --------------------------------------------------

    // detect IE8 and above, and edge
    if (document.documentMode || /Edge/.test(navigator.userAgent)) {
        // remove flickering issue on edge
        $('html').css('overflow', 'hidden');
        $body.css('overflow', 'auto');
    }

    
    // BIND & DELEGATE EVENTS =================================================================================================================
    
    // toggle plugin menu in mobile
	$body.on("click", "#plugin-menu", function(){
		
		$("#id_meliscore_leftmenu").removeAttr('style');
		$("#id_meliscore_footer").removeClass('slide-left');
		
		$("#newplugin-cont").toggleClass("show-menu");
		$body.removeClass('sidebar-mini');
	});
    
	// responsive menu functionalities 
    $body.on("click", "#res-page-cont", function(){
        $("#melis-id-nav-bar-tabs").slideToggle(300);
        $("#res-page-cont i").toggleClass("move-arrow");
    });
    
    // toggle sidebar menu
    $body.on("click", "#sidebar-menu", sidebarMenuClick);
    
	// main tab menu clicks (using bootstrap 'shown.bs.tab' event)
    $body.on("shown.bs.tab", '#melis-id-nav-bar-tabs li a.tab-element', tabMenuClick);
	
    // open tool treeview
    $body.on("click", '.melis-opentools', openTools);
    
    // open dashboard
    $body.on("click", '.melis-opendashboard', openDashboard);
    
    // refresh dashboard widgets
    $body.on("click", '.melis-refreshZone', refreshZone);
    
    // refresh tables
    $body.on("click", '.melis-refreshTable', refreshTable);

    
    
    
    
    
    
    
    
    
	// WINDOW RESIZE FUNCTIONALITIES ========================================================================================================
    $(window).resize(function(){
        
        screenSize = jQuery(window).width();
        
        // dataTable responsive plugin ----=[ PLUGIN BUG FIX ]=-----
        $("table.dataTable").DataTable().columns.adjust().responsive.recalc();
        
        //check tabExpander() when window is resized
        if( screenSize >= 768 ){

        	// put plugins back to its original container
        	$("#newplugin-cont ul.ul-cont > li").each(function(key, value){
        		$(this).find("span.title").remove();
        		$("#id_meliscore_header .navbar-right").append( $(this) );
        	});
        	
        	// check tabExpander();
        	tabExpander.checkTE();
        	
        	//hide plugins & reset defaults
        	$("#newplugin-cont").removeClass("show-menu");
        	$("#res-page-cont i").removeClass("move-arrow");

        }
        else{
        	
        	$body.removeClass("sidebar-mini");
        	
        	// reset layout and remove styles
        	$("#content, #id_meliscore_leftmenu, #id_meliscore_footer").removeAttr("style");
        	
        	// check tabExpander();
        	tabExpander.Disable();
        	
        	// move plugins to another <div>
        	$("#id_meliscore_header .navbar-right > li").each(function(key, value){
        		$(this).children("a").append("<span class='title'>"+ $(this).data("title") +"</span>");
        		$("#newplugin-cont ul.ul-cont").append( $(this) );
        	});
        }
		
		
    });

    
    
    
    
    
    
    
    
    
    // WINDOW SCROLL FUNCTIONALITIES ========================================================================================================
	if(screenSize <= 767){
		
		jQuery(window).scroll(function(){
			// show or hide menu when scrolling
	        if (jQuery(window).scrollTop() > 100 && screenSize <= 767){
	            $navTabs.slideUp();
	            $("#res-page-cont i").removeClass("move-arrow");
	            $("#melis-navtabs-container-outer").addClass("hide-res-menus");
	        }
	        else{
	            $("#melis-navtabs-container-outer").removeClass("hide-res-menus");
	        }     
	    });
		
        // move plugins to another <div>
    	$("#id_meliscore_header .navbar-right > li").each(function(key, value){
    		$(this).children("a").append("<span class='title'>"+ $(this).data("title") +"</span>");
    		$("#newplugin-cont ul.ul-cont").append( $(this) );
    	});

	}
	

	
	
	
	
	
	
	
	
	
	// INITIALIZE ===================================================================================================================
    	    
    // set active tabs etc, flash messenger etc
	firstRender();

    // active tab Id
    activeTabId = $navTabs.find('li.active').children("a").data("id");

	// flash messenger
	flashMessenger();
	
	sessionCheck();

	/* Responsive Fix on Dashboard */
	$('.dashboard-workflow-container .nav-tabs li').height($('.dashboard-workflow-container .nav-tabs').height());
		
	
	
	
	
	
	
	
    /* 
    * RETURN ======================================================================================================================== 
    * include your newly created functions inside the object so it will be accessible in the outside scope
    * sample syntax in calling it outside - melisCore.firstRender;
    */
    
    return{
        // key - access name outside                                 // value - name of function above
        
        flashMessenger                                  :           flashMessenger,
        firstRender                                     :           firstRender,
        openTools		                                :           openTools,
        melisChangeLanguage                             :           melisChangeLanguage,
        resizeScreen                                    :           window.resizeScreen,
        screenSize										:			screenSize,    
        iframeLoad										:			iframeLoad,
		escapeHtml										: 			escapeHtml
    };
    
    
})(window);