/*
 *	jQuery FullCalendar Extendable Plugin
 *	An Ajax (PHP - Mysql - jquery) script that extends the functionalities of the fullcalendar plugin
 *  Dependencies: 
 *   - jquery
 *   - jquery Ui
 * 	 - jquery spectrum (since 2.0)
 *   - jquery timepicker (since 1.6.4)
 *   - jquery Fullcalendar
 *   - Twitter Bootstrap
 *  Author: Paulo Regina
 *  Website: www.pauloreg.com
 *  Contributions: Patrik Iden, Jan-Paul Kleemans, Bob Mulder
 *	Version 3.0, February - 2017
 *  Fullcalendar 3.2.0
 *	Released Under Envato Regular or Extended Licenses
 */
 
(function($, undefined) 
{
	$.fn.extend 
	({
		// FullCalendar Extendable Plugin
		FullCalendarExt: function(options) 
		{	
			var token = 'token='+$('#cal_token').val();
			
			// Default Configurations (General)
            var defaults = 
			{
				calendarSelector: '#calendar',
				
				lang: 'en',
				
				token: '',
								
				ajaxJsonFetch: 'cal/includes/cal_events.php?'+token,
				ajaxUiUpdate: 'cal/includes/cal_update.php?'+token,
				ajaxEventQuickSave: 'cal/includes/cal_quicksave.php?'+token,
				ajaxEventDelete: 'cal/includes/cal_delete.php?'+token,
				ajaxEventEdit: 'cal/includes/cal_edit_update.php?'+token,
				ajaxEventExport: 'cal/includes/cal_export.php?'+token,
				ajaxRepeatCheck: 'cal/includes/cal_check_rep_events.php?'+token,
				ajaxRetrieveDescription: 'cal/includes/cal_description.php?'+token,
				ajaxImport: 'importer.php?'+token,
				
				modalSelector: '#calendarModal',
				modalPromptSelector: '#cal_prompt',
				modalEditPromptSelector: '#cal_edit_prompt_save',
				formSearchSelector:"form#search",
				
				formAddEventSelector: 'form#add_event',
				formFilterSelector: 'form#filter-category select',
				formEditEventSelector: 'form#edit_event', // php version
				formSearchSelector:"form#search",
				
				newEventText: 'Add New Event',
				successAddEventMessage: 'Successfully Added Event',
				successDeleteEventMessage: 'Successfully Deleted Event',
				successUpdateEventMessage: 'Successfully Updated Event',
				failureAddEventMessage: 'Failed To Add Event',
				failureDeleteEventMessage: 'Failed To Delete Event',
				failureUpdateEventMessage: 'Failed To Update Event',
				generalFailureMessage: 'Failed To Execute Action',
				ajaxError: 'Failed to load content',
				emptyForm: 'Form cannot be empty',
				
				eventText: 'Event: ',
				repetitiveEventActionText: 'This is a repetitive event, what do you want to do?',
								
				isRTL: false,				
				weekNumberTitle: 'W',
				
				defaultColor: '#587ca3',
				
				weekType: 'agendaWeek', // basicWeek
				dayType: 'agendaDay', // basicDay
				listType: 'listWeek', // list, listYear, listWeek, listMonth, listDay
				
				editable: true,
				ignoreTimezone: true,
				lazyFetching: true,
				filter: true,
				quickSave: true,
				navLinks: true,
				firstDay: 0,
				
				gcal: false,
				
				version: 'modal',
				
				defaultView: 'month', // basicWeek or basicDay or agendaWeek or any list
				aspectRatio: 1.35, // will make day boxes bigger
				weekends: true, // show (true) the weekend or not (false)
				weekNumbers: false, // show week numbers (true) or not (false)
				weekNumberCalculation: 'iso',
				
				hiddenDays: [], // [0,1,2,3,4,5,6] to hide days as you wish
				
				theme: false,
				themePrev: 'circle-triangle-w',
				themeNext: 'circle-triangle-e',
				
				titleFormatMonth: '',
				titleFormatWeek: '',
				titleFormatDay: '',
				columnFormatMonth: '',
				columnFormatWeek: '',
				columnFormatDay: '',
				timeFormat: 'H:mm',
				
				weekMode: true, // 'fixed' (true), 'liquid' (false), 'variable' (auto)
				
				allDaySlot: true, // true, false
				allDayText: 'all-day',
				axisFormat: 'h(:mm)a',
				
				slotDuration: '00:30:00',
				minTime: '00:00:00',
				maxTime: '24:00:00',
				
				slotEventOverlap: true,
								
				savedRedirect: 'index.php',
				removedRedirect: 'index.php',
				updatedRedirect: 'index.php',
				
				ajaxLoaderMarkup: '<div class="loadingDiv"></div>',
				prev: "left-single-arrow",
				next: "right-single-arrow",
				prevYear: "left-double-arrow",
				nextYear: "right-double-arrow",  
				
				otherSource: '',
				
				modalFormBody: $('#modal-form-body').html(),
				
				eventLimit: true,
				eventLimitClick: 'popover', // 'popover', 'week', 'day', view name, function
				palette: [
							["#0b57a4","#8bbdeb","#000000","#2a82d7","#148aa5","#3714a4","#587ca3","#a50516"],
							["#fb3c8f","#1b4f15","#1b4f15","#686868","#3aa03a","#ff0080","#fee233","#fc1cad"],
							["#7f2b14","#000066","#2b4726","#fd7222","#fc331c","#af31f2","#fc0d1b","#2b8a6d"],
							["#ea9999","#f9cb9c","#ffe599","#b6d7a8","#a2c4c9","#9fc5e8","#b4a7d6","#d5a6bd"]
						]
            }

			var ops =  $.extend(defaults, options);
			
			var opt = ops;
									
			if(opt.gcal == true) { opt.weekType = ''; opt.dayType = ''; }
			
			// fullCalendar
			$(opt.calendarSelector).fullCalendar
			({
				locale: opt.lang,
				editable: opt.editable,
				eventLimit: opt.eventLimit,
				eventLimitClick: opt.eventLimitClick, 
				navLinks: opt.navLinks,
				
				defaultView: opt.defaultView,
				aspectRatio: opt.aspectRatio,
				weekends: opt.weekends,
				weekNumbers: opt.weekNumbers,
				weekNumberCalculation: opt.weekNumberCalculation,
				weekNumberTitle: opt.weekNumberTitle,
				views: {
					month: { 
						titleFormat: opt.titleFormatMonth,
						columnFormat: opt.columnFormatMonth,
					},
					week: { 
						titleFormat: opt.titleFormatWeek,
						columnFormat: opt.columnFormatWeek,						
					},
					day: { 
						titleFormat: opt.titleFormatDay,
						columnFormat: opt.columnFormatDay,						
					}
				},
				isRTL: opt.isRTL,
				hiddenDays: opt.hiddenDays,
				theme: opt.theme,
				buttonIcons: {
					prev: opt.prev,
					next: opt.next,
					prevYear: opt.prevYear,
					nextYear: opt.nextYear
				},
				themeButtonIcons: {
					prev: opt.themePrev,
					next: opt.themeNext
				},
				allDaySlot: opt.allDaySlot,
				allDayText: opt.allDayText,
				slotLabelFormat: opt.axisFormat,
				slotDuration: opt.slotDuration,
				minTime: opt.minTime,
				maxTime: opt.maxTime,
				slotEventOverlap: opt.slotEventOverlap,
				fixedWeekCount: opt.weekMode, 
				timeFormat: opt.timeFormat,
				header: 
				{
						left: 'prev,next',
						center: 'title',
						right: 'month,'+opt.weekType+','+opt.dayType+','+opt.listType	
				},
				monthNames: opt.monthNames,
				monthNamesShort: opt.monthNamesShort,
				dayNames: opt.dayNames,
				dayNamesShort: opt.dayNamesShort,
				buttonText: {
					today: opt.today,
					month: opt.month,
					week: opt.week,
					day: opt.day
				},
				ignoreTimezone: opt.ignoreTimezone,
				firstDay: opt.firstDay,
				lazyFetching: opt.lazyFetching,
				selectable: opt.quickSave,
				selectHelper: opt.quickSave,
				select: function(start, end, allDay, view) 
				{ 
					calendar.view = view.name;
					if(opt.version == 'modal')
					{
						calendar.quickModal(start, end, allDay);
						$(opt.calendarSelector).fullCalendar('unselect');
					}
				},
				eventSources: [
					opt.otherSource, 
					{
						url: opt.ajaxJsonFetch
					}
				],
				eventDrop: 
					function(event) 
					{ 
						var ed_startDate = moment(event.start).format('YYYY-MM-DD');
						var ed_startTime = moment(event.start).format('HH:mm');
						var ed_endDate = moment(event.end).format('YYYY-MM-DD');
						var ed_endTime = moment(event.end).format('HH:mm');
						
						var e_val = moment(event.end).isValid();
						
						if(event.end === null || event.end === 'null' || e_val == false)
						{ 
							Eend = ed_startDate+' '+ed_startTime;
							EaD = event.allDay;	
						} else {
							Eend = ed_endDate+' '+ed_endTime;
							EaD = event.allDay;	
						}
						
						var theEvent = 'start=' + ed_startDate + ' ' + ed_startTime + 
									   '&end=' + Eend +
									   '&id=' + event.id + 
									   '&allDay=' + EaD + 
									   '&original_id=' + event.original_id;
						
						$.post(opt.ajaxUiUpdate, theEvent, function(response) {
							$(opt.calendarSelector).fullCalendar('refetchEvents');
						});
					},
				eventResize:
					function(event) 
					{ 
						var er_startDate = moment(event.start).format('YYYY-MM-DD');
						var er_startTime = moment(event.start).format('HH:mm');
						var er_endDate = moment(event.end).format('YYYY-MM-DD');
						var er_endTime = moment(event.end).format('HH:mm');
						
						var e_val = moment(event.end).isValid();
						
						if(event.end === null || event.end === 'null' || e_val == false)
						{
							Eend = er_startDate+' '+er_startTime;
							EaD = 'false';		
						} else {
							Eend = er_endDate+' '+er_endTime;
							EaD = event.allDay;	
						}
						
						var theEvent = 'start=' + er_startDate + ' ' + er_startTime + 
									   '&end=' + Eend +
									   '&id=' + event.id + 
									   '&allDay=' + EaD + 
									   '&original_id=' + event.original_id;
						
						$.post(opt.ajaxUiUpdate, theEvent, function(response) {
							$(opt.calendarSelector).fullCalendar('refetchEvents');
						});
					},
				eventRender: 
					function(event, element, view) 
					{	
						var d_color = event.color;	
						var d_startDate = moment(event.start).format('YYYY-MM-DD');
						var d_startTime = moment(event.start).format('HH:mm');
						var d_endDate = moment(event.end).format('YYYY-MM-DD');
						var d_endTime = moment(event.end).format('HH:mm');
						
						var e_val = moment(event.end).isValid();
						if(e_val == false) 
						{ 
							var d_endDate = d_startDate; 
							var d_endTime = d_startTime; 
						}
						
						if(event.end !== null && view.name == 'month')
						{
							if(opt.timeFormat == 'H:mm' || opt.timeFormat == 'h:mm')
							{
								timeformat = event.start.format('H:mm') + ' - ' + event.end.format('H:mm');
								element.find('.fc-time').html(timeformat);	
							}
						}
						
						if(opt.version == 'modal')
						{	
							// Open action (modalView Mode)
							element.attr('data-toggle', 'modal');
							element.attr('href', 'javascript:void(0)');
							element.attr('onclick', 'calendar.openModal("' + event.title + '","' + event.url + '","' + event.original_id + '","' + event.id + '","' + event.start + '","' + event.end + '","' + d_color + '","' + d_startDate + '","' + d_startTime + '","' + d_endDate + '","' + d_endTime + '");');  
						} 
					}	
				}); //fullCalendar
				
				 // Function to Open Modal
				calendar.openModal = function(title, url, id, rep_id, eStart, eEnd, color, startDate, startTime, endDate, endTime)
				{					 
					 $('#modal-form-body').hide();
					 $('#details-body').show();
					 
					 calendar.title = title;
					 calendar.id = id;
					 calendar.rep_id = rep_id;
					 
					 calendar.eventStart = eStart;
					 calendar.eventEnd = eEnd;	
					 
					 ExpS = startDate + ' ' + startTime; 
					 ExpE = endDate+' '+endTime;
					  
					  $.ajax({
						type: "POST",
						url: opt.ajaxRetrieveDescription,
						data: {id: calendar.id, mode: 'edit'},
						cache: false,
						beforeSend: function() { $('.loadingDiv').show(); $('.modal-footer').hide() },
						error: function() { $('.loadingDiv').hide(); alert(opt.ajaxError) },
						success: function(json_enc) 
						{ 
							 $('.loadingDiv').hide();
							 var json = $.parseJSON(json_enc);
							 var dsc = json.description.replace('$null', '');
							 var color = json.color.replace('$null', '');
							 var cat = json.category.replace('$null', '');
						
							 calendar.description_editable = json.description_editable.replace('&amp;', '&');
							 calendar.description = dsc.replace('&amp;', '&');
							 calendar.category = cat.replace('&amp;', '&');
							 calendar.color = color; 
							 calendar.data = json;
							 var thisData = JSON.parse(JSON.stringify(json));
							 
							 $('#details-body-title').html(title);
							 
							 calendar.removeObjProp(thisData, ['all-day','categorie','categories','category','color','description','description_editable','end','start','id','repeat_id','repeat_type','title','url','user_id']);
							 
							 var html_pair = '';
							 if($('.custom-fields').children().length > 0)
							 {
								if(Object.keys(thisData).length > 0) 
								 { 
									html_pair = '<hr />';
									for(var key in thisData) 
									{
										var value = thisData[key];
										if(key == 'file')
										{
											if(value !== undefined && value !== "undefined") 
											{
												value = '<a href="'+value+'">'+value+'</a>';
											} else {
												value = '';
											}
										}
										html_pair += '<p><strong>'+key+': </strong>' + value + '</p>';
									} 
								 }
							 }
							 
							 $('#details-body-content').html(dsc + html_pair);
							 
							 $('#export-event, #delete-event, #edit-event').show();
							 $('#save-changes, #add-event').hide();
					
							 $('.modal-footer').show();
							 $(opt.modalSelector).modal('show');
						}
					  });
					
					// Delete button
					$('#delete-event').off().on('click', function(e) 
					{
						calendar.remove(calendar.id);	
						e.preventDefault();
					 });
					 
					 // Export button
					$('#export-event').off().on('click', function(e) 
					{
						calendar.exportIcal(calendar.id, calendar.title, calendar.description, ExpS, ExpE);	
						e.preventDefault();
					 });
					 
					 // Edit Button
					 $('#edit-event').off().on('click', function(e) {
						 												 
						document.getElementById("modal-form-body").reset();
						$('#modal-form-body').html(opt.modalFormBody);
						
						$('#export-event, #delete-event, #edit-event, #add-event').hide();
						$('#save-changes').show().css('width', '100%');
						
						$('#details-body, #event-type-select').hide();
						$('#repeat-type-select, #repeat-type-selected').hide();
						$('#event-type-selected').show();
						$('#modal-form-body').show(); 
						$(opt.modalSelector).modal('show');
				
						$('#modal-form-body :input').each(function() {
							var name = $(this).attr('name');
							var tag = $(this)[0].tagName;
							
							switch(tag) 
							{
								case "SELECT":
									var typeData = calendar.data[name]; 
									if(typeData !== undefined)
									{ 
										$('option[value="'+typeData.replace('&amp;', '&')+'"]').attr('selected', 'selected');
									}
								break;
								
								case "INPUT":
									var name = name.replace(/\[.*?\]/g,"");
									var typeName = $(this).attr('type');
									var typeData = calendar.data[name];
									
									if(typeName == 'checkbox')
									{ 
										if(typeData !== undefined)
										{
											var values = typeData.split(',');
											for(var i = 0; i < values.length; i++) 
											{
												$('input[value="'+values[i].trim()+'"]').attr('checked', 'checked');
											}
										}
									}
									
									if(typeName == 'radio')
									{ 
										if(typeData !== undefined)
										{
											$('input[value="'+typeData+'"]').attr('checked', 'checked');
										}
									}
									
									if(typeName == 'file')
									{
										if(typeData !== undefined && typeData !== "undefined")
										{
											$(this).before('<p class="file-attachment"><a href="'+typeData+'">'+typeData+'</a></p>');
										}
									}
									
									if(typeName == 'text')
									{ 
										$('input[name="'+name+'"]').val(calendar.data[name]);
										$('input[name=title]').val(calendar.data['title']);
										$("#colorp").spectrum("set", calendar.data['color']);
										$('#startDate').val(startDate);
										$('input#startTime').val(startTime);
										$('#endDate').val(endDate);
										$('input#endTime').val(endTime);
									}
								break;
								
								case "TEXTAREA": 
									var typeData = calendar.data[name]; 
									$('textarea[name="'+name+'"]').val(typeData);
									$('textarea[name="description"]').val( calendar.data['description_editable'] );
								break;
								
								default: 
									$(':input[name="'+name+'"]').val(calendar.data[name]);
								break;
							}
						});
						
						// save action
						$('#save-changes').off().on('click', function(e) {
							if($('input[name=title]').val().length == 0)
							{
								alert(opt.emptyForm);
							} else {
								editFormData = new FormData($('#modal-form-body').get(0));
								if($('#file')[0])
								{
									editFormData.append('file', $('#file')[0].files[0]);
								}
								calendar.update(id, editFormData);
							}
							e.preventDefault();
						})
						
					 });
					 									
				} //-- End openModal

				// Function to quickModal
				calendar.quickModal = function(start, end, allDay)
				{ 	
					document.getElementById("modal-form-body").reset();
					$('#modal-form-body').html(opt.modalFormBody);
					
					var start_factor = moment(start).format('YYYY-MM-DD');
					var startTime_factor = moment(start).format('HH:mm');
					var end_factor = moment(end).format('YYYY-MM-DD');
					var endTime_factor = moment(end).format('HH:mm');
					
					var e_val = moment(end).isValid();
					if(e_val == false) 
					{ 
						var end_factor = start_factor; 
						var endTime_factor = startTime_factor; 
					}
						
					$('#startDate').val(start_factor);
					$('#startTime').val(startTime_factor);
					$('#endDate').val(end_factor);
					$('#endTime').val(endTime_factor);
										
					$('#details-body').hide();
					
					$('#event-type-select').show();
					$('#event-type-selected').hide();
					
					$('#repeat-type-select').show();
					$('#repeat-type-selected').hide();
					
					$('#export-event, #delete-event, #edit-event, #save-changes').hide();
					$('#add-event').show().css('width', '100%');
					
					$('.modal-footer').show();
					$('#modal-form-body').show();
					
					$('#details-body-title').html(opt.newEventText);
					$(opt.modalSelector).modal('show');
					
					$('#event-type').on('change', function() {
						var event_type_value = $(this).val();
						if(event_type_value == 'false')
						{
							$('#event-type-select').show();
							$('#event-type-selected').show();
						} else if (event_type_value == 'true') {
							$('#event-type-select').show();
							$('#event-type-selected').hide();	
						}
					})
					
					$('#repeat_select').on('change', function() {
						var value = $(this).val();
						if(value !== 'no')
						{
							$('#repeat-type-select').show();
							$('#repeat-type-selected').show();
						} else if (value == 'no') {
							$('#repeat-type-select').show();
							$('#repeat-type-selected').hide();	
						}
					})
					
					// add action
					$('#add-event').off().on('click', function(e) {
						if($('input[name=title]').val().length == 0)
						{
							alert(opt.emptyForm);
						} else {
							formData = new FormData($('#modal-form-body').get(0));
							if($('#file')[0])
							{
								formData.append('file', $('#file')[0].files[0]);
							}
							calendar.quickSave(formData);	
						}
						e.preventDefault();
					})

				} //-- End quickModal
					
				// Function quickSave 
				calendar.quickSave = function(formData)
				{ 
					$.ajax({
						url: opt.ajaxEventQuickSave,
						data: formData,
						type: "POST",
						cache: false,
						processData: false,
						contentType: false,
						beforeSend: function() { $('.loadingDiv').show(); $('.modal-footer').hide() },
						error: function() { $('.loadingDiv').hide(); alert(opt.ajaxError); },
						success: function(res) 
						{ 
							$('.loadingDiv').hide();
							if(res == 1) 
							{
								$(opt.modalSelector).modal('hide');
								$(opt.calendarSelector).fullCalendar('refetchEvents');
							} else {
								alert(opt.failureAddEventMessage);	
								$('.modal-footer').show();
							}
						}
						
					});
				} //-- End quickSave
					  
				// Function to Update Event to the Database
				calendar.update = function(id, theEvent)
				{
					var construct = "id="+id;
					
					// First check if the event is a repetitive event
					$.ajax({
						type: "POST",
						url: opt.ajaxRepeatCheck,
						data: construct,
						cache: false,
						beforeSend: function() { $('.loadingDiv').show(); },
						error: function() { $('.loadingDiv').hide(); alert(opt.ajaxError) },
						success: function(response) { 
							$('.loadingDiv').hide();
							if(response == 'REP_FOUND') 
							{
								// prompt user	
								$(opt.modalSelector).modal('hide');	
								
								$(opt.modalEditPromptSelector+" .modal-header").html('<h4>'+opt.eventText+calendar.title+'</h4>');
								$(opt.modalEditPromptSelector+" .modal-body-custom").css('padding', '15px').html(opt.repetitiveEventActionText);
								
								$(opt.modalEditPromptSelector).modal('show');
								
								// Action - save this
								$('[data-option="save-this"]').unbind('click').on('click', function(e) 
								{ 
									calendar.update_this(id, theEvent);
									$(opt.modalEditPromptSelector).modal('hide');
									$(opt.modalSelector).modal('hide');
									e.preventDefault();
								 });
								
								// Action - save repetitives
								$('[data-option="save-repetitives"]').unbind('click').on('click', function(e) 
								{
									var construct_two = 'true';

									calendar.update_this(id, theEvent, construct_two);
									$(opt.modalEditPromptSelector).modal('hide');
									$(opt.modalSelector).modal('hide');
									e.preventDefault();
								 });
								
							} else {
								calendar.update_this(id, theEvent);
							}
						},
						error: function(response) {
							alert(opt.generalFailureMessage);	
						}
					});	
				}
				
				// Function to update single and repetitive events
				calendar.update_this = function(id, theEvent, construct_two)
				{ 
					if(construct_two === undefined)
					{
						editFormData.append('id', id);
					} else {
						editFormData.append('id', id); 
						editFormData.append('rep_id', calendar.rep_id);
						editFormData.append('method', 'repetitive_event');							
					}
					
					$.ajax({
						type: "POST",
						url: opt.ajaxEventEdit,
						data: theEvent,
						cache: false,
						processData: false,
						contentType: false,
						beforeSend: function() { $('.loadingDiv').show(); },
						error: function() { $('.loadingDiv').hide(); alert(opt.ajaxError) },
						success: function(response) {
							$('.loadingDiv').hide();
							if(response == '') 
							{
								$(opt.modalSelector).modal('hide');
								$(opt.calendarSelector).fullCalendar('refetchEvents');
							} else {
								alert(opt.failureUpdateEventMessage);	
							}
						},
						error: function(response) {
							alert(opt.failureUpdateEventMessage);	
						}
					});	
				}
				
				// Function to Remove Event ID from the Database
				calendar.remove = function(id)
				{
					// First check if the event is a repetitive event
					var construct = 'id='+id;

					$.ajax({
						type: "POST",
						url: opt.ajaxRepeatCheck,
						data: {id: id},
						cache: false,
						beforeSend: function() { $('.loadingDiv').show(); },
						error: function() { $('.loadingDiv').hide(); alert(opt.ajaxError) },
						success: function(response) 
						{
							$('.loadingDiv').hide();
							if(response == 'REP_FOUND') 
							{
								// prompt user
								$(opt.modalSelector).modal('hide');
								
								$(opt.modalPromptSelector+" .modal-header").html('<h4>'+opt.eventText+calendar.title+'</h4>');
								$(opt.modalPromptSelector+" .modal-body").html(opt.repetitiveEventActionText);	
								
								$(opt.modalPromptSelector).modal('show');
								
								// Action - remove this
								$('[data-option="remove-this"]').unbind('click').on('click', function(e) 
								{
									calendar.remove_this(construct);
									$(opt.modalPromptSelector).modal('hide');
									e.preventDefault();
								 });
								
								// Action - remove repetitive
								$('[data-option="remove-repetitives"]').unbind('click').on('click', function(e) 
								{
									var construct = "id="+id+'&rep_id='+calendar.rep_id+'&method=repetitive_event';
									
									calendar.remove_this(construct);
									$(opt.modalPromptSelector).modal('hide');
									e.preventDefault();
								 });
								
							} else {
								calendar.remove_this(construct);
							}
						},
						error: function(response) {
							alert(opt.generalFailureMessage);	
						}
					});	
				};
				
				// Functo to Remove Event from the database
				calendar.remove_this = function(construct)
				{
					// just remove this	
					$.ajax({
						type: "POST",
						url: opt.ajaxEventDelete,
						data: construct,
						cache: false,
						beforeSend: function() { $('.loadingDiv').show(); },
						error: function() { $('.loadingDiv').hide(); alert(opt.ajaxError) },
						success: function(response) 
						{ 
							$('.loadingDiv').hide();
							if(response == '') 
							{
								$(opt.modalSelector).modal('hide');
								$(opt.calendarSelector).fullCalendar('refetchEvents');	
							} else {
								alert(opt.failureDeleteEventMessage);
							}
						}
					});
				}
				
				// Function to Export Calendar
				calendar.exportIcal = function(expID, expTitle, expDescription, expStart, expEnd)
				{ 
					var start_factor = expStart;
					var end_factor = expEnd;
					
					var construct = '&method=export&id='+encodeURIComponent(expID)+'&title='+encodeURIComponent(expTitle)+'&description='+encodeURIComponent(expDescription)+'&start_date='+encodeURIComponent(start_factor)+'&end_date='+encodeURIComponent(end_factor);	
					
					window.location = opt.ajaxEventExport+construct;
					
				} // -- End export Calendar
				
				// Import
				calendar.calendarImport = function()
				{
					txt = 'import='+encodeURIComponent($('#import_content').val());	
					$.post(opt.ajaxImport, txt, function(response) 
					{
						alert(response);
						$(opt.calendarSelector).fullCalendar('refetchEvents');
						$('#cal_import').modal('hide');
						$('#import_content').val('');	
					});
				} // -- End Import Calendar
				
				// Remove Obj Prop
				calendar.removeObjProp = function(obj, props) 
				{
					for(var i = 0; i < props.length; i++) {
						if(obj.hasOwnProperty(props[i])) {
							delete obj[props[i]];
						}
					}
				};
				// -- End Remove of Obj Prop
			
			// Fiter
			if(opt.filter == true)
			{
				$(opt.formFilterSelector).on('change', function(e) 
				{
					 selected_value = $(this).val();
					 
					 construct = 'filter='+encodeURIComponent(selected_value);
					 
					 $.post('cal/includes/loader.php', construct, function(response)
					{
						$(opt.calendarSelector).fullCalendar('refetchEvents');
					});	
					 
					 e.preventDefault();  
				});
				
			// Search Form
			// keypress
			$(opt.formSearchSelector).keypress(function(e) 
			{
				if(e.which == 13)
				{
					search_me();
					e.preventDefault();
				}
			});
			
			// submit button
			$(opt.formSearchSelector+' button').on('click', function(e) 
			{
				search_me();
			});
			
			function search_me()
			{
				 value = $(opt.formSearchSelector+' input').val();
				 
				 construct = 'search='+encodeURIComponent(value);
				 
				 $.post('cal/includes/loader.php', construct, function(response)
				{
					$(opt.calendarSelector).fullCalendar('refetchEvents');
				});		
			}
				
			}
					   
		} // FullCalendar Ext
		
	}); // fn
	 
})(jQuery);

// define object at end of plugin to fix ie bug
var calendar = {};
