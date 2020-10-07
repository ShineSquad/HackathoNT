var header;

window.addEventListener("load", () => {
	header = document.querySelector("header");
		nav = document.querySelector("header > .navigation")

	console.log(nav)
	header.addEventListener("click", () => {
		// console.log(1);
		nav.classList.toggle("active");
	})
})