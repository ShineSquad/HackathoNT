createTeam = () => {
	var formData = new FormData(document.getElementById("team_lead")),
		postData = {},
		roles = [];
	for(var pair of formData.entries()) {
	   postData[pair[0]]=pair[1];
		if (pair[0] == 'role' && pair[1] != "") {
			roles.push(pair[1]);
		}
	}
	postData['role'] = roles.join(', ');
	let teamArr = {
		name_team: postData['name_team'],
		optional_equipment: postData['optional_equipment'],
		participants: {
			1: {
				name_part: postData['name_part'],
				mail_part: postData['mail_part'],
				link_social: postData['link_social'],
				role: postData['role'],
				work_place: postData['work_place']
			}
		}
	}
	firebase
		.database()
		.ref("teams/")
		.child(postData['name_team'])
			.set(teamArr);

	localStorage.setItem('team', postData['name_team']);
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
		"design": "Дизайнер"
	};
	let form = document.createElement('form'),
		name_part = document.createElement('input'),
		mail_part = document.createElement('input'),
		link_social = document.createElement('input'),
		work_place = document.createElement('input'),
		role_hidden = document.createElement('input'),
		role_container = document.createElement('div'),
		role_title = document.createElement('p'),
		button = document.createElement('button');

	main.appendChild(form);

	form.setAttribute("method", "post");
	form.setAttribute("onSubmit", "return false;");
	form.classList.add("form_part");
	form.id = "form_part" + count;

	form.appendChild(name_part);
	form.appendChild(mail_part);
	form.appendChild(link_social);
	form.appendChild(work_place);
	form.appendChild(role_hidden);
	form.appendChild(role_container);
	form.appendChild(button);

	name_part.name = "name_part";
	mail_part.name = "mail_part";
	link_social.name = "link_social";
	work_place.name = "work_place";
	role_hidden.name = "role";

	name_part.pattern = "[a-zA-Zа-яА-Я\s]{3,}";
	mail_part.pattern = "^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,}$";
	link_social.pattern = "[0-9a-zA-Zа-яА-Я!-_\s]{3,}";
	work_place.pattern = "[a-zA-Zа-яА-Я\s]{3,}";

	name_part.placeholder = "ФИО участника";
	mail_part.placeholder = "Почта участника";
	link_social.placeholder = "Ссылка на социальные сети";
	work_place.placeholder = "Учебное заведение или место работы участника";

	name_part.type = "text";
	mail_part.type = "text";
	link_social.type = "text";
	work_place.type = "text";
	role_hidden.type = "text";

	role_container.appendChild(role_title);

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
		team = localStorage.getItem('team');
	for(var pair of formData.entries()) {
	   postData[pair[0]]=pair[1];
		if (pair[0] == 'role' && pair[1] != "") {
			roles.push(pair[1]);
		}
	}
	postData['role'] = roles.join(', ');

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
		team = localStorage.getItem('team');
	for(var pair of formData.entries()) {
	   postData[pair[0]]=pair[1];
		if (pair[0] == 'role' && pair[1] != "") {
			roles.push(pair[1]);
		}
	}
	postData['role'] = roles.join(', ');

	firebase
		.database()
		.ref("teams/")
			.child(team)
			.child('participants')
			.child(formNumber)
				.set(postData);

	document.getElementById("form").lastChild.style.display = "none";

	let main = document.getElementById("form"),
		text = document.createElement('p'),
		back = document.createElement('a');

	back.innerText = "Вернуться на сайт";
	back.href = "./index.php";	
	text.innerText = "Регистрация завершена";
	main.appendChild(text);
	main.appendChild(back);

	localStorage.clear();
}