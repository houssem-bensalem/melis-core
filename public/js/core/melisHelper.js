var melisHelper = (function(){

	var version = "2.0.0";

	// CACHE SELECTORS
	var $body = $("body");
	var $navTabs = $("#melis-id-nav-bar-tabs");
	
	function melisTranslator(transKey){
		var translated = translations[transKey]
		if(translated === undefined){
			translated = transKey;
		}
		return translated;
	}
	
	// OK NOTIFICATION
	function melisOkNotification(title, message, color){
		if(!color) color = "#72af46";
		$.gritter.add({
				title: melisTranslator(title),
				text: melisTranslator(message),
				time: 3000,
				image: '/melis/MelisCore/MelisAuth/getProfilePicture?v=' + new Date().getTime(),
		}); 
		//set the color
		$(".gritter-item").css("background",color);
	}
	  
	// KO NOTIFICATION
	function melisKoNotification(title, message, errors, closeByButtonOnly){
		if(!closeByButtonOnly) closeByButtonOnly = "closeByButtonOnly";
		( closeByButtonOnly !== 'closeByButtonOnly' ) ? closeByButtonOnly = 'overlay-hideonclick' : closeByButtonOnly = '';

		var errorTexts = '<h3>'+ melisTranslator(title) +'</h3>';
		
			errorTexts +='<h4>'+ melisTranslator(message) +'</h4>';
			$.each( errors, function( key, error ) {
				if(key !== 'label'){
					errorTexts += '<p class="modal-error-cont"><b>'+ (( errors[key]['label'] == undefined ) ? ((errors['label']== undefined) ? key : errors['label'] ) : errors[key]['label'] )+ ': </b>  ';

					// catch error level of object
					try {
						$.each( error, function( key, value ) {
							if(key !== 'label'){
								 errorTexts += '<span><i class="fa fa-circle"></i>'+ value + '</span>';
							}
						});
					} catch(Tryerror) {
						if(key !== 'label'){
							 errorTexts +=  '<span><i class="fa fa-circle"></i>'+ error + '</span>';
						} 
					}	
					errorTexts += '</p>';
				}
			});
			
		var div = "<div class='melis-modaloverlay "+ closeByButtonOnly +"'></div>";
		div += "<div class='melis-modal-cont KOnotif'>  <div class='modal-content'>"+ errorTexts +" <span class='btn btn-block btn-primary'>"+ translations.tr_meliscore_notification_modal_Close +"</span></div> </div>";
		$body.append(div);
	}
	/**
	 * KO NOTIFICATION for Multiple Form
	 */
	function melisMultiKoNotification(title, message, errors, closeByButtonOnly){
		if(!closeByButtonOnly) closeByButtonOnly = true;
		var closeByButtonOnly = ( closeByButtonOnly !== true ) ?  'overlay-hideonclick' : '';

		var errorTexts = '<h3>'+ melisHelper.melisTranslator(title) +'</h3>';
			errorTexts +='<h4>'+ melisHelper.melisTranslator(message) +'</h4>';
		
		$.each( errors, function( key, error ) {
			if(key !== 'label'){
				errorTexts += '<p class="modal-error-cont"><b>'+ (( errors[key]['label'] == undefined ) ? ((errors['label']== undefined) ? key : errors['label'] ) : errors[key]['label'] )+ ': </b>  ';
				// catch error level of object
				try {
					$.each( error, function( key, value ) {
						if(key !== 'label' && key !== 'form'){
							
							$errMsg = '';
							if(value instanceof Object){
								$errMsg = value[0];
							}else{
								$errMsg = value;
							}
							errorTexts += '<span><i class="fa fa-circle"></i>'+ $errMsg + '</span>';
						}
					});
				} catch(Tryerror) {
					if(key !== 'label' && key !== 'form'){
						 errorTexts +=  '<span><i class="fa fa-circle"></i>'+ error + '</span>';
					} 
				}	
				errorTexts += '</p>';
			}
		});
			
		var div = "<div class='melis-modaloverlay "+ closeByButtonOnly +"'></div>";
		div += "<div class='melis-modal-cont KOnotif'>  <div class='modal-content'>"+ errorTexts +" <span class='btn btn-block btn-primary'>"+ translations.tr_meliscore_notification_modal_Close +"</span></div> </div>";
		$body.append(div);
	}
	
	/**
	 * This method will Highlight an input label where an error occured
	 * @param success, 1 or 0
	 * @param errors, Object array
	 * @param selector, element selector 
	 */
	function highlightMultiErrors(success, errors, selector){
		if(!selector) selector = activeTabId;
		// remove red color for correctly inputted fields
		$("" + selector + " .form-group label").css("color", "inherit");
		// if all form fields are error color them red
		if(success === 0){
			$.each( errors, function( key, error ) { 
				if("form" in error){
					$.each(this.form, function( fkey, fvalue ){
						$("#" + fvalue + " .form-control[name='"+key +"']").prev("label").css("color","red");
					});
				}
			});
		}
	}
	
	/**
	 * This method will initialize a element to DataRangePicker plugin
	 * @param selector, element selector
	 * @param callBackFunction, callback function of the date range picker
	 */
	function initDateRangePicker(selector, callBackFunction){
		setTimeout(function(){ 
			var target = $(selector);
			target.addClass("dt-date-range-picker");
			target.html(''+translations.tr_meliscore_datepicker_select_date+' <i class="glyphicon glyphicon-calendar fa fa-calendar"></i> <span></span> <b class="caret"></b>');
		    var sToday = translations.tr_meliscore_datepicker_today;
			var sYesterday = translations.tr_meliscore_datepicker_yesterday;
			var sLast7Days = translations.tr_meliscore_datepicker_last_7_days;
			var sLast30Days = translations.tr_meliscore_datepicker_last_30_days;
			var sThisMonth = translations.tr_meliscore_datepicker_this_month;
			var sLastMonth = translations.tr_meliscore_datepicker_last_month;
			
			var rangeStringParam = {};
			rangeStringParam[sToday] = [moment(), moment()];
			rangeStringParam[sYesterday] = [moment().subtract(1, 'days'), moment().subtract(1, 'days')];
			rangeStringParam[sLast7Days] = [moment().subtract(6, 'days'), moment()];
			rangeStringParam[sLast30Days] = [moment().subtract(29, 'days'), moment()];
			rangeStringParam[sThisMonth] = [moment().startOf('month'), moment().endOf('month')];
			rangeStringParam[sLastMonth] = [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')];
			
			target.daterangepicker({
				startDate: moment().subtract(10, 'years'),
		        endDate: moment(),
		    	locale : {
					format: melisDateFormat,
					applyLabel: translations.tr_meliscore_datepicker_apply,
					cancelLabel: translations.tr_meliscore_datepicker_cancel,
					customRangeLabel: translations.tr_meliscore_datepicker_custom_range,
				},
		        ranges: rangeStringParam
		    }, function(start, end) {
		    	target.find("span").html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
		    });
		    
			target.on('apply.daterangepicker', function(ev, picker){
				if(callBackFunction !== undefined){
					callBackFunction(ev, picker);
				}
		    });
		}, 1000);
	}
	
	function initSwitch(selector){
		var targetInput = $(selector);
		if(targetInput.length){
			var parentDiv = targetInput.parent("div.form-group");
			var switchBtn = '<label for="'+targetInput.attr("name")+'">'+targetInput.data("label")+'</label>'
							+'<div class="make-switch user-admin-switch" data-label-icon="glyphicon glyphicon-resize-horizontal" data-on-label="'+translations.tr_meliscore_common_yes+'" data-off-label="'+translations.tr_meliscore_common_no+'" style="display: block;">'
								+'<input type="checkbox" name="'+targetInput.attr("name")+'" id="'+targetInput.attr("name")+'">'
							+'</div>';
			parentDiv.html(switchBtn);
			$('.user-admin-switch').bootstrapSwitch('destroy', true);
			$('.user-admin-switch').bootstrapSwitch();
		}else{
			console.log("Selector not found");
		}
		
	}

	// SWITCH ACTIVE TABS =============================================================================================================
	function tabSwitch(tabID){
		
		// update new activeTabId
		activeTabId = tabID;
		
		// run and check all the <li> to remove the 'active class'
	    $("#melis-id-nav-bar-tabs li, .container-level-a").each(function(){
	      $(this).removeClass('active');
	    });
	    
	    //add active class to the parent of the cliked <a> ( to the <li> )
	    $("#melis-id-nav-bar-tabs a.tab-element[data-id='"+ tabID +"']").parent("li").addClass("active");
	    
	    //show current selected container
	    $("#" + tabID).addClass("active");
	}
 
	// CLOSE TAB AND REMOVE ===========================================================================================================
	function tabClose(ID){
		var tabContentID =  (typeof ID === 'string') ? ID :  $(this).data("id");
		var currentParent = $(".tabsbar a[data-id='"+tabContentID+"']").parent("li");
		var nextActiveTab = currentParent.next("li").children().data("id");
		var prevActiveTab = currentParent.prev("li").children().data("id");
		var tabCount = $navTabs.children("li").length;
		var removedWidth = currentParent.width();
		
		if( currentParent.index() === 0 ){
			currentParent.remove();
			$("#"+tabContentID).remove();
			
			if( tabCount >= 1){
				if(activeTabId === tabContentID){ 
					tabSwitch(nextActiveTab);
				}
			}
		}
		else{
			currentParent.remove();
			$("#"+tabContentID).remove();
			
			if( tabCount >= 1){
				if(activeTabId === tabContentID){ 
					tabSwitch(prevActiveTab);
				}
			}
		}
		
		// get the <ul> container width and disable the tabExpander
		var navUlContainer = 1;
		$('#id_meliscore_header #melis-id-nav-bar-tabs li').each(function() {
			navUlContainer += $(this).outerWidth();
		});
		
		if( navUlContainer < $("#melis-navtabs-container-inner").width() ){
			tabExpander.checkTE();
		}
		else{
			var leftOffset = $navTabs.position().left;
			if( leftOffset === -1 ) {}
			else if( leftOffset !== 0 ){
				$("#melis-id-nav-bar-tabs").animate({
	                left: (leftOffset + removedWidth)
	            }, 0); 
			} 
		}
		
		// [ Mobile ] when closing a page
		if( melisCore.screenSize <= 767 ){
			$("#res-page-cont").trigger("click");
			
			// check if there are no contents open
			if( $navTabs.children("li").length === 0){
				var empty = '<b>(' + translations.tr_meliscore_empty +')</b>';
				$("#res-page-cont span").append(empty);
			}
		}
		
		// dataTable responsive plugin ----=[ PLUGIN BUG FIX ]=-----
        $("table.dataTable").DataTable().columns.adjust().responsive.recalc();
	}

	// TAB OPEN =====================================================================================================================
	function tabOpen(title, icon, zoneId, melisKey, parameters){
		//check if the tab is already open and added to the main nav
		var alreadyOpen = $("body #melis-id-nav-bar-tabs li a.tab-element[data-id='"+ zoneId +"']");
		
		if(alreadyOpen.length < 1){
    		var li = "<li>"; 
    		li += "<a data-toggle='tab' class='dropdown-toggle menu-icon tab-element' href='#"+ zoneId + "' data-id='" + zoneId + "'>";
    		li += "<i class='fa "+ icon +" fa-2x'></i><span class='navtab-pagename'>";
    		li += title + "</span></a>";
    		li += "<a class='close close-tab' data-id='" + zoneId + "'>"+ translations.tr_meliscore_notification_modal_Close +"</a>";
    		li += "</li>";
    		
    		// append the <li> to the menu
    	    $("body #melis-id-nav-bar-tabs").append(li);
    	    
    	    // [ Mobile ] when opening a page
    		if( melisCore.screenSize <= 767 ){
    			// check if there are no contents open
    			if( $navTabs.children("li").length > 0){
    				$("#res-page-cont span b").remove();
    			}
    			
    			// close sidebar after opening a page from it
    			$body.removeClass('sidebar-mini');
    			$("#id_meliscore_leftmenu, #id_meliscore_footer").removeAttr('style'); 
    			
    			// slide up the dropdown menu
    			$("#melis-id-nav-bar-tabs").slideUp(300);
    	        $("#res-page-cont i").removeClass("move-arrow");
    		}
    	    
    		var div = "<div data-meliskey='" + melisKey + "' id='" + zoneId + "' class='tab-pane container-level-a'></div>";
    		$('#melis-id-body-content-load').append(div);
    		
    		//set active tab ID
    		activeTabId = zoneId;
    		
    		//make the new tab active
    		tabSwitch(zoneId);
    		
    		//load the page content
    		zoneReload(zoneId, melisKey, parameters);
    		
    		// check if tabExpander(); needs to be activated or not
    		tabExpander.checkTE();
    			
    		//focus the newly opened tab if tabExpander() is enabled
    		if( tabExpander.checkStatus() === 'enabled' ){
                $(".melis-tabnext").trigger("click");
    		}
		}
		else{
			//make the new tab and content active instead of realoading
    		tabSwitch(zoneId);
		}	
	}

	// EXECUTE CALLBACK FUNCTIONS FROM ZONE RELOADING =================================================================================
	function executeCallbackFunction(functionName, context) {
		  var namespaces = functionName.split(".");
		  var func = namespaces.pop();
		  for(var i = 0; i < namespaces.length; i++) {
		    context = context[namespaces[i]];
		  }
		  
		  // check the validity of the JS callback function
		  if( context[func] !== undefined){
			  return context[func].apply(context);
		  }
	}
	
	// ZONE RELOADING =================================================================================================================
    function zoneReload(zoneId, melisKey, parameters){
    	
    	var datastring = { cpath: melisKey };
    	
    	//add parameters value to datastring object if available
    	if ( parameters !== undefined ) {
    		$.each(parameters, function( index, value ) {
    		  datastring[index] = value;
    		});
        }
		
		// add the temp loader
		var tempLoader = '<div id="loader" class="overlay-loader"><img class="loader-icon spinning-cog" src="/MelisCore/assets/images/cog12.svg" data-cog="cog12"></div>';
		$("#"+zoneId).append(tempLoader);

		$.ajax({
	        url         : '/melis/zoneview',
	        data        : datastring,
	        encode		: true,
	        dataType	: "json"
	    }).success(function(data, status, xhr){
	    	
	    	// hide the loader
	    	$('.loader-icon').removeClass('spinning-cog').addClass('shrinking-cog');
	    	
	    	setTimeout(function() {
	    		if( data !== null ){
	    			$("#"+zoneId).html(data.html).children().unwrap();
		    		
		    		// set the current active tab based from 'activeTabId' value
		    		tabSwitch(activeTabId);
		    		
		    		// set active the the 'Edition' tab and its 'Tab Content'
		    		$("#" + zoneId + " .nav-tabs li:first-child").addClass("active");
		    		$("#" + zoneId + " .tab-content > div:first-child").addClass("active");
		    		
		    		// --------------------------------------------------------------
		    		// Run callback scripts here | from app.interface
		    		// --------------------------------------------------------------
		    		var jsCallbacks = data.jsCallbacks;
		    		
		    		$.each( jsCallbacks, function( key, value ) {
		    			
		    			// check if there is more than 1 function in a single jsCallback from app.interface
		    			// example: 'jscallback' => 'simpleChartInit(); anotherFunction();'  separated by (space)
		    			var splitFunctions = value.split(" ");

			    		if( splitFunctions.length > 1){
			    			// run all the function extracted from a single jsCallback
			    			$.each( splitFunctions, function( key, value ) {
			    				value = value.slice(0, -3);
				    			executeCallbackFunction(value, window);
			    			});
			    		}
			    		else{
			    			value = value.slice(0, -3);
			    			executeCallbackFunction(value, window);
			    		}
		    		});
	    		}
	    		else{
	    			$('#melis-id-nav-bar-tabs a[data-id="' + zoneId + '"]').parent("li").remove();
			    	$('#'+zoneId).remove();
			    	
			    	melisHelper.melisKoNotification( "Error Fetching data", "No result was retreived while doing this operation.", "no error datas returned", '#000' );
	    		}
	    	}, 300);
	    }).error(function(xhr, textStatus, errorThrown){
	    	
	    	alert( translations.tr_meliscore_error_message );
	    	
	    	//hide the loader
	    	$('.loader-icon').removeClass('spinning-cog').addClass('shrinking-cog');
	    	$('#melis-id-nav-bar-tabs a[data-id="' + zoneId + '"]').parent("li").remove();
	    	$('#'+zoneId).remove();
	    	
	    });	   
    }
    
    // Requesting flag set to false so this function will set state to ready 
	var createModalRequestingFlag = false;
    // CREATE MODAL =================================================================================================================
    function createModal(zoneId, melisKey, hasCloseBtn, parameters, modalUrl, callback){
    	
    	if (createModalRequestingFlag == false){
    		
    		// Requesting flag set to true so this function will execute any action while still requesting
    		createModalRequestingFlag = true;
    		
	    	// if no modalUrl is supplied it will use the default modal layout from melisCore
	    	if(modalUrl === undefined || modalUrl == null){
	    		modalUrl = '/melis/MelisCore/MelisGenericModal/genericModal';
	    	}
	    		
	    	var datastring = {
	    			id : zoneId,
	    			melisKey : melisKey,
	    			hasCloseBtn : hasCloseBtn,
	    	};
	    	
	    	$.ajax({
	    	    url         : modalUrl,
	    	    data        : datastring,
	    	    encode		: true
	    	}).success(function(data){
	    		// Requesting flag set to false so this function will set state to ready 
	    		createModalRequestingFlag = false;
	    		
	    		$("#melis-modals-container").append(data);
				var modalID = $(data).find(".modal").attr("id");
				melisHelper.zoneReload(zoneId, melisKey, parameters);
				
				$("#" + modalID).modal({ 
					show: true, 
					keyboard : false,
					backdrop : "static"
				});
				if(typeof callback !== "undefined") {
					callback();
				}
	    	}).error(function(xhr, textStatus, errorThrown){
	    		alert("ERROR !! Status = "+ textStatus + "\n Error = "+ errorThrown + "\n xhr = "+ xhr.statusText);
	    		// Requesting flag set to false so this function will set state to ready 
	    		createModalRequestingFlag = true;
	    	});
    	}
    }
    
    // Stating zone to loading
    function loadingZone(targetElem){
    	if(targetElem.length){
    		var tempLoader = '<div id="loadingZone" class="overlay-loader"><img class="loader-icon spinning-cog" src="/MelisCore/assets/images/cog12.svg" data-cog="cog12"></div>';
    		targetElem.attr("style", "position: relative");
    		targetElem.append(tempLoader);
    	}
    }
    
    // Removing loading state on zone
    function removeLoadingZone(targetElem){
    	if(targetElem.length){
    		targetElem.find("#loadingZone").remove();
    	}
    }
    
    
    // BIND AND DELEGATE EVENTS =====================================================================================================
    
    // close tab
    $body.on("click", ".close-tab", tabClose );
    
	// close the KO notification
	$("body").on("click", ".melis-modal-cont.KOnotif span.btn, .overlay-hideonclick, .delete-page-modal .cancel, .melis-prompt, melis-prompt .cancel", function(){
	  $(".melis-modaloverlay, .melis-modal-cont").remove();
	});
	
	
    /* 
	* RETURN ======================================================================================================================== 
	* include your newly created functions inside the array so it will be accessable in the outside scope
	* sample syntax in calling it outside - melisHelper.zoneReload(parameters);
    */
	
	return{
		//key - access name outside									// value - name of function above
		
		// javascript translator function
		melisTranslator									:			melisTranslator,
		
		// notifications
		melisOkNotification 							:       	melisOkNotification,
		melisKoNotification 							: 			melisKoNotification,
		
		// multiple KO notifications
		melisMultiKoNotification						: 			melisMultiKoNotification,
		highlightMultiErrors							: 			highlightMultiErrors,
		
		// initialize dateRangePicker
		initDateRangePicker								:			initDateRangePicker,
		
		// initialize bootstrap switch
		initSwitch										: 			initSwitch,
		
		// tabs
		tabSwitch 										: 			tabSwitch,
		tabClose 										: 			tabClose,
		tabOpen 										: 			tabOpen,

		// zone realod
		zoneReload 										: 			zoneReload,
		
		// modal
		createModal										:			createModal,
		
		// Loading zone
		loadingZone										:			loadingZone,
		removeLoadingZone								:			removeLoadingZone,
	};
	
})();