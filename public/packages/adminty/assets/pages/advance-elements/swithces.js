"use strict";
$(function() {

	var elemprimary = document.querySelector('.js-success');

	if(elemprimary !== null){
        new Switchery(elemprimary, { color: '#93BE52', jackColor: '#fff' });
	}

	// Maximum tags option
	$('.tags_max').tagsinput({
			maxTags: 3
		});

	// Maximum charcters option
	$('.tags_max_char').tagsinput({
			maxChars: 8
		});

	// Multiple tags option
	$(".tags_add_multiple").tagsinput('items');
	// Tags plugins ends

// Max-length js start

	// Default max-length
    $('input[maxlength]').maxlength();

    // Thresold value
    $('input.thresold-i').maxlength({
        threshold: 20
    });

    //Color class
    $('input.color-class').maxlength({
        alwaysShow: true,
        threshold: 10,
        warningClass: "label label-success",
        limitReachedClass: "label label-danger"
    });

    //Position class
    $('input.position-class').maxlength({
        alwaysShow: true,
        placement: 'top-left'
    });

    // Textareas max-length
    $('textarea.max-textarea').maxlength({
        alwaysShow: true
    });
// Max-length js ends

});
