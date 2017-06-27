'use strict';

/*---------------------------------------------------------------------------
                                HEADER MENU
---------------------------------------------------------------------------*/

$('.menu-icon').click(function() {
	var menu = $(this).siblings('.menu');

	menu.toggleClass('hide');

	setTimeout(function() {
		menu.toggleClass('show-menu');
	}, 100);
});

// Close open elements if someplace else in the body is clicked
$('body').on('click', function(event) {
	event.stopPropagation();

	// Close menu
	if (!($(event.target).hasClass('menu')) && !($(event.target).hasClass('menu-icon'))) {
		// console.log('menu will close');
		$('.header .menu').addClass('hide').removeClass('show-menu');
	}

	// Close dropdown
	if ($(event.target).closest('.dropdown').length == 0) {
		// console.log('dropdown will close');
		$('.dropdown').removeClass('dropdown-open').find('.dropdown-options').hide();
	}
});

/*---------------------------------------------------------------------------
                                   MODAL
---------------------------------------------------------------------------*/
var modalGlass = $('.modal-glass');

// Populate and show modal
$('[data-modal').click(function() {
	var modalData = $('[data-modal-content="'+$(this).attr('data-modal')+'"]');

	modalGlass.find('.modal-heading').text(modalData.find('[data-modal-heading]').text());
	modalGlass.find('.modal-body').html(modalData.find('[data-modal-body]').html());

	modalGlass.removeClass('hide');
	setTimeout(function() { modalGlass.find('.modal').addClass('show-modal'); }, 10);
});

// Close modal
modalGlass.find('.modal-close').click(closeModal);
modalGlass.click(function(event) {
	if ($(event.target).hasClass('modal-glass')) {
		closeModal();
	}
});

function closeModal() {
	modalGlass.addClass('hide').find('.modal').removeClass('show-modal').children().empty();
}


/*---------------------------------------------------------------------------
                                   ACCORDION
---------------------------------------------------------------------------*/

$('.accordion-title').on('click', function() {	
	if ($(this).closest('.accordion-group')[0].hasAttribute('data-single-expand')) {
		$(this).parent().siblings('.accordion').removeClass('accordion-expanded').children('.accordion-content').slideUp();
	}

	$(this).siblings('.accordion-content').slideToggle().parent().toggleClass('accordion-expanded');
});

/*---------------------------------------------------------------------------
                                   DROPDOWN
---------------------------------------------------------------------------*/
$('.dropdown').click(function() {
	var dropdown = this;

	$('.dropdown').each(function() {
		if (this != dropdown) { $(this).removeClass('dropdown-open').find('.dropdown-options').hide(); }
	});

	if ($(this).hasClass('dropdown-open')) {
		$(this).removeClass('dropdown-open').find('.dropdown-options').hide();
	}
	else {
		$(this).addClass('dropdown-open').find('.dropdown-options').slideToggle(300);
	}

});

$('.dropdown-options1 li').click(function(event) {
	$(this).parent().siblings('.selected-option').text($(this).text());
	$(this).parent().siblings('input[type=hidden]').val($(this).attr('value'));
	//$(this).parent().siblings('input[type=hidden]').val('test');
	
});

$('.motto .dropdown-options li').click(function(event) {
	$(this).parent().siblings('.selected-option').text($(this).text());
	//$(this).parent().siblings('input[type=hidden]').val($(this).attr('value'));
	$('#org_motto').val('test');
	
});

function checkForm(form, event)
{
	if(!form.agree.checked) {
		
		$('.agree-error').show();
		$('.agree-error').html("Please indicate that you accept the Terms and Conditions");
		form.agree.focus();
		event.preventDefault();
	} else {
		return true;
	}

}
function addMonths(date, year) {
  date.setYear(date.getYear() - year);
  return date;
  
}

$('#age').pickadate({
  selectYears: true,
  selectMonths: true,
  min: addMonths(new Date(), 100),
   max: addMonths(new Date(), 20),
   selectYears:80,
	formatSubmit: 'yyyy-mm-dd'
   
  });

function selectValues(classname) {
	var valu = [];
	var checkedVals = $('.'+classname+':checkbox:checked').map(function() {
	valu.push(this.value);
    return this.id;
	}).get();

	$('#'+classname+'-list').val(valu.join(','));
	$('#'+classname+'s').val(checkedVals.join(','));

	$('.modal-glass').addClass('hide').find('.modal').removeClass('show-modal').children().empty();
  
}  
