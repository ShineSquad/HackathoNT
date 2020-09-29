window.onscroll = function() {
  var scrolled = window.pageYOffset || document.documentElement.scrollTop;
  if (scrolled > 2500) {
  	document.getElementById('scroll_top').style.display = 'block';
  } else {
  	document.getElementById('scroll_top').style.display = 'none';
  }
}