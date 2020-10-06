function updateTimer() {
	const end = new Date(2020, 9, 14, 23, 59, 0);
	let current = new Date(),
		diff = (end - current) / 1000,
		s = Math.round( diff % 60 ),
		m = Math.floor( (diff / 60) % 60 ),
		h = Math.floor( (diff / (60 * 60)) % 24 ),
		d = Math.floor( diff / (60 * 60 * 24) )

	return {
		"days": d,
		"hours": h,
		"minutes": m,
		"seconds": s
	}
}

function displayTimer(_nodes, _times) {
	for (i in _times) {
		_nodes[i].innerText = _times[i]
	}
}

window.onload = () => {
	let setFormat = (num) => {return (num < 10) ? "0"+num : ""+num};
	let startPos = updateTimer();
	const nodes = {
		"days": document.querySelector("#timer > .timer_item > .timer_item_block > ._days"),
		"hours": document.querySelector("#timer > .timer_item > .timer_item_block > ._hours"),
		"minutes": document.querySelector("#timer > .timer_item > .timer_item_block > ._minutes"),
		"seconds": document.querySelector("#timer > .timer_item > .timer_item_block > ._seconds")
	}

	displayTimer(nodes, updateTimer());

	setInterval(() => displayTimer(nodes, updateTimer()) , 1000)

	setTimeout(() => {
		document.body.classList.toggle("onload");
		document.body.removeChild(
			document.getElementById("loader"));
	}, 1000)
}