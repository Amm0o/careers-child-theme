
setTimeout(() => {
// Get all dates
const allEvents = document.querySelectorAll('.info-box__wrapper-web');

// Get first date
const firstDate = allEvents[0].querySelector('.shape');

// Activate first date
firstDate.querySelector('.svg-wrap').style.transform = "scale(1)";

// Activate and deactivate the dates
allEvents.forEach((date, index) => {
    if(index > 0) {
        date.addEventListener('mouseover', () => {
	    firstDate.querySelector('.svg-wrap').style.transform = "scale(0)";
	});

	date.addEventListener('mouseleave', () => {
	    firstDate.querySelector('.svg-wrap').style.transform = "scale(1)";
	});
    }
});
}, 5000)
