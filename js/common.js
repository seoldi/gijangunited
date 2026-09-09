$(document).ready(function(){
	let lastScroll = 0;

	window.addEventListener("scroll", function () {
		let currentScroll = window.scrollY;

		if (currentScroll > lastScroll) {
			// 스크롤 내릴 때 (헤더 숨김)
			document.getElementById("header").style.top = "-120px";
		} else {
			// 스크롤 올릴 때 (헤더 보임)
			document.getElementById("header").style.top = "0";
		}

		lastScroll = currentScroll;
	});

});
