/* jQuery */

function setCookie(key, value, expiry) {
	var expires = new Date();
	expires.setTime(expires.getTime() + (expiry * 24 * 60 * 60 * 1000));
	document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
}

function getCookie(key) {
	var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
	return keyValue ? keyValue[2] : null;
}

function eraseCookie(key) {
	var keyValue = getCookie(key);
	setCookie(key, keyValue, '-1');
}

$('select').select2();
$("input").attr("autocomplete", "off");
$('input').attr('aria-autocomplete', 'none');

// $(document).ready(function(){
// 	const firstVisit = getCookie('summitFirstVisit');
// 	console.log(firstVisit);
// 	if ( firstVisit === null ) {
// 		setCookie('summitFirstVisit', 'firstVisit', '30');
// 		$('.summit-intro-cover').css('z-index', '10000');
// 		$('.summit-intro-cover').css('opacity', '1');
// 		$('body').addClass('no-scroll');
// 		setTimeout(() => {
// 			$('.summit-intro-cover h2').addClass('fadeIn')
// 		}, 750)
// 		setTimeout(() => {
// 			$('.site').addClass('fadeIn');
// 			$('.summit-intro-cover').addClass('fadeOut');
// 			$('body').removeClass('no-scroll');
// 		}, 4500);
// 		setTimeout(() => {
// 			$('.summit-intro-cover').css('z-index', '-100000');
// 		}, 5500);
// 	} else {
// 		$('.summit-intro-cover').css('z-index', '-100000');
// 		$('.site').css('opacity', '1');
// 	}
	
// });

$(document).ready(function(){
	$('.summit-search-trigger').on('click', function() {
		$( 'nav' ).removeClass( "toggled" );
		// $('.summit-professionals-login').removveClass('open-professionals');
		$('.summit-retail-login').removeClass('open-retail');
		$('.summit-search-form').toggleClass('open-search');
	});
	
	$('.summit-retail-trigger').on('click', function(e) {
		e.stopPropagation();
		$( 'nav' ).removeClass( "toggled" );
		// $('.summit-professionals-login').removeClass('open-professionals');
		$('.summit-search-form').removeClass('open-search');
		$('.summit-retail-login').toggleClass('open-retail');
	});
	
		$('.gtranslate_wrapper a').each(function() {
			const selector = this.attributes[3] !== undefined ? this.attributes[3].value : this.innerText;
			if (selector === 'en' || selector === 'English') {
				this.innerText = 'EN'
			}
			if (selector === 'fr' || selector === 'French') {
				this.innerText = 'FR'
			}
			if (selector === 'it' || selector === 'Italian') {
				this.innerText = 'IT'
			}
			if (selector === 'es' || selector === 'Spanish') {
				this.innerText = 'ES'
			}
		});
	
	$('.summit-menu .menu-item-has-children a').on('click', function() {
		$(this).toggleClass('show-sub-menu');
	});
	
	if (window.location.search.includes('?s=')) {
		$('.summit-search-form').addClass('open-search');
	}
	
	var $grid = $('.collection-gallery').imagesLoaded( function() {
  	// init Masonry after all images have loaded
  		$grid.masonry({
   			itemSelector: 'img',
			columnWidth: 'img',
			gutter: 20,
  		});
	});

});

$(document).on('click', function(event) {
    if (!$(event.target).closest('.summit-search-form').length &&
        !$(event.target).is('.summit-search-trigger')) {
        $('.summit-search-form').removeClass('open-search');
    }

    if (!$(event.target).closest('.summit-retail-login').length &&
        !$(event.target).closest('.summit-retail-trigger').length) {
        $('.summit-retail-login').removeClass('open-retail');
    }
});

$(document).on('keydown', function(event) {
	if (event.key == "Escape") {
		$('.summit-search-form').removeClass('open-search');
		$('.summit-professionals-login').removeClass('open-professionals');
		$('.summit-retail-login').removeClass('open-retail');
		$('.summit-login-modal').removeClass('open-modal');
	}
});

	function toggleDropdown(toggle) {
		$(toggle).toggleClass('open-toggle');
	}

    // Function to close dropdown
    function closeDropdown(toggle) {
        $(toggle).removeClass('open-toggle');
    }

    // Event listener for header click to toggle dropdown
    $('.summit-dropdown h4').on('click', function(event) {
        toggleDropdown(this);
        event.stopPropagation(); // Prevents the click event from reaching the document click handler immediately
    });

    // Event listener for clicks outside the dropdown
    $(document).on('click', function(event) {
        var dropdown = $('.dropdown-content');
        var dropdownHeader = $('.summit-dropdown h4');
        if (!dropdown.is(event.target) && dropdown.has(event.target).length === 0 && !dropdownHeader.is(event.target)) {
            closeDropdown(dropdownHeader);
        }
    });




// Function to get URL parameter by name
function getUrlParam(param) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(param);
}

// Function to close the modal when clicking outside of it
function closeModalOnClickOutside(modal) {
    document.addEventListener('click', function(event) {
        if (!modal.contains(event.target)) {
            modal.classList.remove('open-modal');
			const cookieConsent = document.querySelector('#hu');
			cookieConsent.classList.remove('hide-consent');
        }
    });
}

// Check if the 'sclsrc' parameter exists, the cookie is not set, and show the modal if needed
setTimeout(() => {
	if (!getCookie('modalShown')) { //getUrlParam('sclsrc') && 
		const cookieConsent = document.querySelector('#hu');
		cookieConsent.classList.add('hide-consent');
		const modal = document.querySelector('div.summit-modal.social');
		modal.classList.add('open-modal');

		// Set a cookie to expire in 2 months (60 days)
		setCookie('modalShown', 'true', 60);

		// Add event listener to close the modal when clicking outside
		closeModalOnClickOutside(modal);
	}
}, 1500)


document.addEventListener('click', function(event) {
    // Check if the div with ID 'hu' has the class 'hu-visible'
    var huDiv = document.getElementById('hu');
    if (huDiv && huDiv.classList.contains('hu-visible') && !huDiv.classList.contains('hide-consent')) {
        // Check if the click happened outside the div with ID 'hu'
        if (!huDiv.contains(event.target)) {
            // Trigger click on input#hu-cookies-notice-consent-choices-3-toggle
            var consentToggle = document.querySelector('input#hu-cookies-notice-consent-choices-3-toggle');
            if (consentToggle) {
                consentToggle.click();
            }

            // Trigger click on button#hu-cookies-save
            var saveButton = document.querySelector('button#hu-cookies-save');
            if (saveButton) {
                saveButton.click();
            }
        }
    }
});
