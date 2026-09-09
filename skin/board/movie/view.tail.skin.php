<?php if (!defined("_GNUBOARD_")) exit; ?>
<script>
function changeMedia() {
	for (yt34 of arguments[0].getElementsByTagName("a")) {
		if (yt34.href.slice(-4).toLowerCase() == ".mp3") {
			yt34.insertAdjacentHTML("afterend", "<audio style=display:block src='" + yt34.href + "' loop controls></audio>");
			yt34.style.display = "none"; 
		}
		else if (yt34.href.slice(-4).toLowerCase() == ".mp4") {
			yt34.insertAdjacentHTML("afterend", "<video style=display:block;width:100% src='" + yt34.href + "' loop controls></video>");
			yt34.style.display = "none"; 
		}
		else if (yt34.href.slice(0, 16) == "https://youtu.be") {
			yt34.insertAdjacentHTML("afterend", "<div style=position:relative;padding-bottom:56.25%;overflow:hidden;width:100%><iframe style=position:absolute;top:0px;left:0px;width:100%;height:100%;display:block src=https://www.youtube.com/embed/?loop=1&playlist=" + yt34.href.slice(-11) + " frameborder=0 allowfullscreen></iframe></div>");
			yt34.style.display = "none"; 
		}
	}
}
changeMedia(bo_v_con);
changeMedia(bo_vc);
</script>