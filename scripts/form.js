date = () => {
	let day = document.querySelector('.day'),
		month = document.querySelector('.month'),
		year = document.querySelector('.year'),
		months = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];
	for (i = 1; i < 32; i++) {
		let option = document.createElement('option');
		option.value = i;
		option.innerText = i;
		day.appendChild(option);
	}
	for (j = 0; j < months.length; j++) {
		let option = document.createElement('option');
		option.value = j+1;
		option.innerText = months[j];
		month.appendChild(option);
	}
	for (k = 1900; k < new Date().getFullYear()+1; k++) {
		let option = document.createElement('option');
		option.value = k;
		option.innerText = k;
		year.appendChild(option);
	}
}

createTeam = () => {
	var formData = new FormData(document.getElementById("team_lead")),
		postData = {},
		roles = [],
		date = [],
		optional = [];
	for(var pair of formData.entries()) {
	   postData[pair[0]]=pair[1];
		if (pair[0] == 'role' && pair[1] != "") {
			roles.push(pair[1]);
		}
		if (pair[0] == 'birth_date' && pair[1] != "") {
			date.push(pair[1]);
		}
		if (pair[0] == 'optional_equipment' && pair[1] != "") {
			optional.push(pair[1]);
		}
	}
	postData['role'] = roles.join(', ');
	postData['birth_date'] = date.join('/');
	postData['optional_equipment'] = optional.join('');
	let teamArr = {
		team_name: postData['team_name'],
		target: postData['target'],
		participants: {
			1: {
				name: postData['name'],
				optional_equipment: postData['optional_equipment'],
				mail: postData['mail'],
				phone: postData['phone'],
				city: postData['city'],
				birth_date: postData['birth_date'],
				link_social: postData['link_social'],
				role: postData['role'],
				work_place: postData['work_place']
			}
		}
	}
	firebase
		.database()
		.ref("teams/")
		.child(postData['team_name'])
			.set(teamArr);

	localStorage.setItem('team', postData['team_name']);
	createNewForm(1, postData['participants_count']);

}

createNewForm = (count, maxPart) => {
	if (count >= 2) { document.getElementById("form").lastChild.style.display = "none"; } 
	else { console.log('first') }

	document.getElementById("team_lead").style.display = "none";

	let main = document.getElementById("form");
	let roles = {
		"project": "Проект-менеджер", 
		"front": "Frontend-разработчик", 
		"back": "Backend-разработчик", 
		"design": "Дизайнер",
		"other": "Другое"
	};
	let months = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];
	let form = document.createElement('form'),
		form_container = document.createElement('div'),
		left_part = document.createElement('div'),
		right_part = document.createElement('div'),
		name_title = document.createElement('p'),
			name_part = document.createElement('input'),
		mail_title = document.createElement('p'),
			mail_part = document.createElement('input'),
		phone_title = document.createElement('p'),
			phone_part = document.createElement('input'),
		city_title = document.createElement('p'),
			city_part = document.createElement('input'),
		link_social_title = document.createElement('p'),
			link_social = document.createElement('input'),
		optional_equipment_hidden = document.createElement('input'),
		optional_equipment_title = document.createElement('p'),
		optional_equipment_container = document.createElement('div'),
			label1 = document.createElement('label'),
			label2 = document.createElement('label'),
			target = document.createElement('textarea'),
		work_place_title = document.createElement('p'),
			work_place = document.createElement('input'),
		date_hidden = document.createElement('input'),
		date_title = document.createElement('p'),
			birth_date = document.createElement('div'),
				day = document.createElement('select'),
				month = document.createElement('select'),
				year = document.createElement('select'),
		role_hidden = document.createElement('input'),
		role_container = document.createElement('div'),
		role_title = document.createElement('p'),
		feedback_container = document.createElement('div'),
		button = document.createElement('button'),
		end_button = document.createElement('button'),
		error = document.createElement('p'),
		title = document.querySelector('.title'),
		under_subtitle = document.querySelector('.under_subtitle');

	title.innerText = "2. Добавление участников в команду";
	under_subtitle.style.display = 'none';

	end_button.classList.add('end_button');
	end_button.innerText = "Закончить";

	for (i = 1; i < 32; i++) {
		let option = document.createElement('option');
		option.value = i;
		option.innerText = i;
		day.appendChild(option);
	}
	for (j = 0; j < months.length; j++) {
		let option = document.createElement('option');
		option.value = j+1;
		option.innerText = months[j];
		month.appendChild(option);
	}
	for (k = 1900; k < new Date().getFullYear()+1; k++) {
		let option = document.createElement('option');
		option.value = k;
		option.innerText = k;
		year.appendChild(option);
	}

	main.appendChild(form);

	form.setAttribute("method", "post");
	form.setAttribute("onSubmit", "return false;");
	form.classList.add("form_part");
	form.id = "form_part" + count;

	form.appendChild(form_container);
	
	form_container.appendChild(left_part);
	form_container.appendChild(right_part);

	form_container.classList.add('form_container');
	left_part.classList.add('left_part');
	right_part.classList.add('right_part');

	name_title.innerText = 'Ваше ФИО';
	mail_title.innerText = 'E-mail';
	link_social_title.innerText = 'Ссылка на соц.сети';
	work_place_title.innerText = 'Место работы или учебы';
	phone_title.innerText = 'Телефон';
	city_title.innerText = 'Город';
	optional_equipment_title.innerText = 'Требуется ли вам доп. оборудование (компьютер)?';
	date_title.innerText = 'Дата рождения';

	name_title.classList.add('input_title');
	date_title.classList.add('input_title');
	role_title.classList.add('input_title');
	city_title.classList.add('input_title');
	work_place_title.classList.add('input_title');
	optional_equipment_title.classList.add('input_title');
	link_social_title.classList.add('input_title');
	mail_title.classList.add('input_title');
	phone_title.classList.add('input_title');

	left_part.appendChild(name_title);
	left_part.appendChild(name_part);
	left_part.appendChild(date_title);
	left_part.appendChild(date_hidden);
	left_part.appendChild(birth_date);
		birth_date.appendChild(day);
		birth_date.appendChild(month);
		birth_date.appendChild(year);
	left_part.appendChild(role_hidden);
	left_part.appendChild(role_title);
		left_part.appendChild(role_container);
	left_part.appendChild(work_place_title);
		left_part.appendChild(work_place);

	right_part.appendChild(city_title);
		right_part.appendChild(city_part);
	right_part.appendChild(optional_equipment_hidden);
	right_part.appendChild(optional_equipment_title);
	right_part.appendChild(optional_equipment_container);
	right_part.appendChild(link_social_title);
		right_part.appendChild(link_social);
	right_part.appendChild(mail_title);
		right_part.appendChild(mail_part);
	right_part.appendChild(phone_title);
		right_part.appendChild(phone_part);
	
	form.appendChild(feedback_container);
	feedback_container.appendChild(error);
	feedback_container.appendChild(button);
	
	error.id = 'error';

	optional_equipment_container.classList.add('optional_equipment_container');
	optional_equipment_container.appendChild(label1);
	optional_equipment_container.appendChild(label2);
	label1.innerHTML = "<input type='radio' name='optional_equipment' value='yes'>Да";
	label2.innerHTML = "<input type='radio' name='optional_equipment' value='no'>Нет, есть своё";


	feedback_container.classList.add('feedback_container');

	optional_equipment_hidden.name = "optional_equipment";
	name_part.name = "name";
	mail_part.name = "mail";
	link_social.name = "link_social";
	work_place.name = "work_place";
	role_hidden.name = "role";
	phone_part.name = "phone";
	city_part.name = "city";
	target.name = "target";
	date_hidden.name = "birth_date";
	day.name = "birth_date";
	month.name = "birth_date";
	year.name = "birth_date";

	birth_date.id = 'birth_date';
	day.classList.add('day');
	month.classList.add('month');
	year.classList.add('year');

	date_hidden.style.display = "none";
	optional_equipment_hidden.style.display = "none";

	name_part.pattern = "[a-zA-Zа-яА-Я\s]{3,}";
	mail_part.pattern = "^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,}$";
	link_social.pattern = "[0-9a-zA-Zа-яА-Я!-_\s]{3,}";
	work_place.pattern = "[a-zA-Zа-яА-Я\s]{3,}";

	name_part.type = "text";
	mail_part.type = "text";
	link_social.type = "text";
	work_place.type = "text";
	role_hidden.type = "text";
	phone_part.type = 'text';
	city_part.type = 'text';
	date_hidden.type = 'text';

	role_hidden.style.display = "none";
	role_container.classList.add('role');
	role_title.innerText = "Роль в команде";

	Object.keys(roles).forEach(function(key) {
	    var value = roles[key];
	    let role_item = document.createElement('input'),
	    	role_label = document.createElement('label');
	    role_container.appendChild(role_label);
	    role_label.appendChild(role_item);
	    role_item.type = "checkbox";
	    role_item.name = key;
	    role_label.innerHTML = "<input type='checkbox' name='role' value='" + key + "' />" + value;
	});

	if (count == (maxPart-1)) {
		button.innerText = "Закончить";
		button.setAttribute("onclick", "end("+ (count+1) +", " + maxPart + ")");
	} else {
		button.innerText = "Далее";
		button.setAttribute("onclick", "addParticipant("+ (count+1) +", " + maxPart + ")");
	}
	
	
}

addParticipant = (formNumber, maxPart) => {
	var formName = "form_part"+(formNumber-1),
		formData = new FormData(document.getElementById(formName)),
		postData = {},
		roles = [],
		date = [],
		optional = [],
		team = localStorage.getItem('team');
	for(var pair of formData.entries()) {
	   postData[pair[0]]=pair[1];
		if (pair[0] == 'role' && pair[1] != "") {
			roles.push(pair[1]);
		}
		if (pair[0] == 'birth_date' && pair[1] != "") {
			date.push(pair[1]);
		}
		if (pair[0] == 'optional_equipment' && pair[1] != "") {
			optional.push(pair[1]);
		}
	}
	postData['role'] = roles.join(', ');
	postData['birth_date'] = date.join('/');

	firebase
		.database()
		.ref("teams/")
			.child(team)
			.child('participants')
			.child(formNumber)
				.set(postData);

	createNewForm(formNumber, maxPart);
}

end = (formNumber, maxPart) => {
	var formName = "form_part"+(formNumber-1),
		formData = new FormData(document.getElementById(formName)),
		postData = {},
		roles = [],
		date = [],
		optional = [],
		team = localStorage.getItem('team');
	for(var pair of formData.entries()) {
	   postData[pair[0]]=pair[1];
		if (pair[0] == 'role' && pair[1] != "") {
			roles.push(pair[1]);
		}
		if (pair[0] == 'birth_date' && pair[1] != "") {
			date.push(pair[1]);
		}
		if (pair[0] == 'optional_equipment' && pair[1] != "") {
			optional.push(pair[1]);
		}
	}
	postData['role'] = roles.join(', ');
	postData['birth_date'] = date.join('/');

	firebase
		.database()
		.ref("teams/")
			.child(team)
			.child('participants')
			.child(formNumber)
				.set(postData);

	// document.getElementById("form").lastChild.style.display = "none";

	let container = document.createElement('div'),
		modal = document.createElement('div'),
		modalView = document.createElement('div'),
		back = document.createElement('img'),
		like = document.createElement('img'),
		title = document.createElement('p'),
		subtitle = document.createElement('p'),
		button = document.createElement('button');

	document.body.appendChild(container);
	document.body.appendChild(modal);
	modal.appendChild(modalView);

	back.src = "./images/back.svg";
	back.classList.add('back_icon');

	like.src="./images/like.svg";
	like.classList.add('like_icon');

	title.innerText = 'Заявка на участие отправлена';
	subtitle.innerText = 'Ожидайте ответа на указанную Вами почту.';
	button.innerText = 'Понятно';
	title.classList.add('title');
	subtitle.classList.add('subtitle');

	back.setAttribute('onclick', 'back()');
	button.setAttribute('onclick', 'back()');

	document.body.style.overflowY = 'hidden';
	scroll(0, 0);
	container.id = 'shadow';
	modal.id = 'modal_container';
	modal.classList.add('modal_container');
	modalView.classList.add('modal');

	modalView.appendChild(back);
	modalView.appendChild(like);
	modalView.appendChild(title);
	modalView.appendChild(subtitle);
	modalView.appendChild(button);

	localStorage.clear();
}

function back() {
	// let shadow = document.getElementById('shadow'),
	// 	modal = document.getElementById('modal_container');
	// document.body.style.overflowY = 'scroll';
	// shadow.style.display = "none";
	// modal.style.display = "none";
	location.href = "./index.php";
}