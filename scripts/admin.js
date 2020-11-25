switchAllTable = () => {
	let all = document.querySelector('.all_btn'),
		short = document.querySelector('.small_btn'),
		all_container = document.querySelector('.all_container'),
		short_container = document.querySelector('.short_container');
	short.classList.remove('active_btn');
	short_container.style.display = "none";
	all.classList.add('active_btn');
	all_container.style.display = "flex";
}

switchShortTable = () => {
	let all = document.querySelector('.all_btn'),
		short = document.querySelector('.small_btn'),
		all_container = document.querySelector('.all_container'),
		short_container = document.querySelector('.short_container');
	all.classList.remove('active_btn');
	all_container.style.display = "none";
	short.classList.add('active_btn');
	short_container.style.display = "flex";
}

reg = () => {
	var formData = new FormData(document.getElementById("regAdmin")),
		postData = {};
	for(var pair of formData.entries()) {
	   	postData[pair[0]]=pair[1];
	}
	postData['password'] = md5(postData['password']);
	firebase.database().ref("admins/").push(postData);
}

auth = () => {
	var formData = new FormData(document.getElementById("authAdmin")),
		postData = {},
		error = document.getElementById('error'),
		name = document.getElementById('name-input'),
		password = document.getElementById('password-input');
	for(var pair of formData.entries()) {
		if (pair[1] === "") {
			error.innerText = '* Заполните все поля';
			name.style.backgroundColor = "#EEB1C6";
			password.style.backgroundColor = "#EEB1C6";
			return false;
		} else {
			postData[pair[0]]=pair[1];
		}
	}
	postData['password'] = md5(postData['password']);
	let users = firebase.database().ref("admins").orderByChild("name").equalTo(postData['name']).once("value", (resp) => {
		if (resp.val() == null) {
			error.innerText = '* Пользователя с таким именем не существует';
			name.style.backgroundColor = "#EEB1C6";
			password.style.backgroundColor = "#B7D4F0";
		} else {
			for (i in resp.val()) {
				let passhash = postData['password'];
				if (passhash == resp.val()[i].password) {
					localStorage.setItem("user", postData['name']);
					window.location.href = "./admin.php";
				} else {
					error.innerText = '* Неверный пароль';
					password.style.backgroundColor = "#EEB1C6";
					name.style.backgroundColor = "#B7D4F0";
				}
			}
		}
	})
}

createTable = () => {
	firebase.database().ref('teams').once('value', (resp) => {
		let table = document.getElementById('team_list1'),
			count_team = 1,
			count_user = 1;
		for (i in resp.val()) {
			let tr = document.createElement('tr'),
				td = document.createElement('td'),
				team = resp.val()[i];
			table.appendChild(tr);
			tr.appendChild(td);
			td.colSpan = 9;
			td.innerText = count_team + " - " + team.team_name;
			count_team++;
			td.classList.add('title_team');
			for (j in team.participants) {
				let tr_td = document.createElement('tr'),
					td_name = document.createElement('td'),
					td_mail = document.createElement('td'),
					td_phone = document.createElement('td'),
					td_city = document.createElement('td'),
					td_date = document.createElement('td'),
					td_work = document.createElement('td'),
					td_social = document.createElement('td'),
					td_roles = document.createElement('td'),
					td_optional_equipment = document.createElement('td');

				table.appendChild(tr_td);
				tr_td.appendChild(td_name);
				tr_td.appendChild(td_date);
				tr_td.appendChild(td_roles);
				tr_td.appendChild(td_phone);
				tr_td.appendChild(td_mail);
				tr_td.appendChild(td_social);
				tr_td.appendChild(td_city);
				tr_td.appendChild(td_work);
				tr_td.appendChild(td_optional_equipment);

				tr_td.classList.add('item_line');

				td_social.innerHTML = "<a href='" + team.participants[j].link_social + "' class='link' target='_blank'>" + team.participants[j].link_social + "</a>";
				td_name.innerText = count_user + ". " + team.participants[j].name;
				td_phone.innerText = team.participants[j].phone;
				td_city.innerText = team.participants[j].city;
				td_work.innerText = team.participants[j].work_place;
				td_date.innerText = team.participants[j].birth_date;
				td_mail.innerHTML = "<a href='mailto:" + team.participants[j].mail + "' class='link'>" + team.participants[j].mail + "</a>";
				td_roles.innerText = team.participants[j].role;
				if (team.participants[j].optional_equipment == 'yes') { td_optional_equipment.innerText = 'да'; } 
				else { td_optional_equipment.innerText = 'нет'; }
				count_user++;
			}
		}
	})
}

createTable2 = () => {
	firebase.database().ref('teams').once('value', (resp) => {
		let table = document.getElementById('team_list2'),
			count_team = 1,
			count_user = 1;
		for (i in resp.val()) {
			let tr = document.createElement('tr'),
				td = document.createElement('td'),
				team = resp.val()[i];
			table.appendChild(tr);
			tr.appendChild(td);
			td.colSpan = 2;
			td.innerText = count_team + " - " + team.team_name;
			count_team++;
			td.classList.add('title_team');
			for (j in team.participants) {
				let tr_td = document.createElement('tr'),
					td_name = document.createElement('td'),
					td_mail = document.createElement('td');

				tr_td.classList.add('item_line');

				table.appendChild(tr_td);
				tr_td.appendChild(td_name);
				tr_td.appendChild(td_mail);
				td_name.innerText = count_user + ". " + team.participants[j].name;
				count_user++;
			}
		}
	})
}

function show_hide_password(target){
	var input = document.getElementById('password-input');
	if (input.getAttribute('type') == 'password') {
		target.classList.add('view');
		input.setAttribute('type', 'text');
	} else {
		target.classList.remove('view');
		input.setAttribute('type', 'password');
	}
	return false;
}