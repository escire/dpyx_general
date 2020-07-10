$('.has-tooltip').tooltip();

$(function () { 
  $('[data-toggle="tooltip"]').tooltip({trigger: 'manual'}).tooltip('show');
});

$(function() {
	$(".switch-checkbox").bootstrapSwitch();
});

$('.open-page-popover').popover({
	title : '<div>-<a class="close" data-dismiss="alert">&times;</button></a>',
	template: '<div class="popover inline-page" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>',
	html: true,
	container: 'body',
    content: function(){
        var divID =  "tmp-id-" + $.now();
        return loadPopOverContent($(this).attr('href'), divID);
    }
});

function loadPopOverContent(link, divID){
    $.ajax({
        url: link,
        success: function(response){
            $('#' + divID).html(response);
        }
	});
	//var footer = '<div class="card-footer text-right"><a class="btn btn-sm btn-secondary close-btn">&times;</a></div>';
    return '<div class="reset-grids" id="'+ divID +'">' + pageLoadingIndicator + '</div>';// + footer;
}

(function() {
	var forms = document.getElementsByClassName('needs-validation');
	// Loop over them and prevent submission
	var validation = Array.prototype.filter.call(forms, function(form) {
		form.addEventListener('submit', function(event) {
			if (form.checkValidity() === false) {
				event.preventDefault();
				event.stopPropagation();
			}
			form.classList.add('was-validated');
			$("input:required:invalid").parents('.dropzone').css("borderColor", "red");
			$("input:required:invalid").parents('.custom-file').find('.custom-file-label').css("borderColor", "red");
			$("textarea:required:invalid").parents('.form-group').find('.note-editor').css("borderColor", "red");
		}, false);
	});
})();


$.fn.editableform.buttons = '<button type="submit" class="btn btn-sm btn-primary editable-submit">&check;</button><button type="button" class="btn btn-sm btn-secondary editable-cancel">&times;</button>';
$(function(){
	$.fn.editable.defaults.ajaxOptions = {type: "post"};
	$.fn.editable.defaults.params = {csrf_token : csrfToken};
	$.fn.editable.defaults.emptytext = '...';
	$.fn.editable.defaults.textFieldName = 'label';
	
	$('.is-editable').editable();
	
	$(document).on('click', '.inline-edit-btn', function(e){
		e.stopPropagation();
		$(this).closest('td').find('.make-editable').editable('toggle');
	});
});







$(function(){
	$('.smartwizard').each(function(){
		var theme = $(this).data('theme') || "dots";
		$(this).smartWizard({
			selected: 0,  // Initial selected step, 0 = first step 
			keyNavigation:true, // Enable/Disable keyboard navigation(left and right keys are used if enabled)
			autoAdjustHeight:false, // Automatically adjust content height
			cycleSteps: false, // Allows to cycle the navigation of steps
			backButtonSupport: true, // Enable the back button support
			useURLhash: true, // Enable selection of the step based on url hash
			toolbarSettings: {
				toolbarPosition: 'bottom', // none, top, bottom, both
				toolbarButtonPosition: 'left', // left, right
				showNextButton: false, // show/hide a Next button
				showPreviousButton: false, // show/hide a Previous button
			}, 
			anchorSettings: {
				anchorClickable: true, // Enable/Disable anchor navigation
				enableAllAnchors: false, // Activates all anchors clickable all times
				markDoneStep: true, // add done css
				enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
			},            
			theme: theme, // dots,circles,arrows
			transitionEffect: 'fade', // Effect on navigation, none/slide/fade
			transitionSpeed: '400'
		});
		
	});
	
	$('.smartwizard form').submit(function(e){
		var currentForm = $(this)[0];
		
		if(currentForm.checkValidity()){
			e.preventDefault();
			
			var nextPage = $(this).closest('.formtab').data('next-page');
			var submitAction = $(this).closest('.formtab').data('submit-action');
			
			var method = $(this).attr('method');
			
			var url = $(this).attr('action');
			var formData = '';
			
			if(submitAction == 'SUBMIT-STEP-FORM'){
				formData = $(currentForm).serialize();
			}
			else if(submitAction == 'SUBMIT-ALL-FORMS'){
				
				$('.smartwizard form').each(function(e){
					formData = formData + '&' + $(this).serialize();
				});
				
				var allFormUrl = $(this).closest('.formtab').data('form-action');
				
				if(allFormUrl){
					url = allFormUrl
				}
				
			}
			
			if(formData){
				$.ajax({
					type: method,
					url: url,
					data: formData,
					success: function (data) {
						console.log('Submission was successful.');
						window.location.href = '#' + nextPage;
					},
					error: function (data) {
						console.log('An error occurred subiting the form');
					},
				});
			}
			else{
				window.location.href = '#' + nextPage;
			}
		}
	})
});



