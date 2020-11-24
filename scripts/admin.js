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
		let table = document.getElementById('team_list1');
		for (i in resp.val()) {
			let tr = document.createElement('tr'),
				td = document.createElement('td'),
				team = resp.val()[i];
			table.appendChild(tr);
			tr.appendChild(td);
			td.colSpan = 8;
			td.innerText = team.team_name;
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
					td_roles = document.createElement('td');

				table.appendChild(tr_td);
				tr_td.appendChild(td_name);
				tr_td.appendChild(td_mail);
				tr_td.appendChild(td_phone);
				tr_td.appendChild(td_date);
				tr_td.appendChild(td_city);
				tr_td.appendChild(td_work);
				tr_td.appendChild(td_social);
				tr_td.appendChild(td_roles);
				td_social.innerText = team.participants[j].link_social;
				td_name.innerText = team.participants[j].name;
				td_phone.innerText = team.participants[j].phone;
				td_city.innerText = team.participants[j].city;
				td_work.innerText = team.participants[j].work_place;
				td_date.innerText = team.participants[j].birth_date;
				td_mail.innerText = team.participants[j].mail;
				td_roles.innerText = team.participants[j].role;
			}
		}
	})
}

createTable2 = () => {
	firebase.database().ref('teams').once('value', (resp) => {
		let table = document.getElementById('team_list2');
		for (i in resp.val()) {
			let tr = document.createElement('tr'),
				td = document.createElement('td'),
				team = resp.val()[i];
			table.appendChild(tr);
			tr.appendChild(td);
			td.colSpan = 2;
			td.innerText = team.team_name;
			td.classList.add('title_team');
			for (j in team.participants) {
				let tr_td = document.createElement('tr'),
					td_name = document.createElement('td'),
					td_mail = document.createElement('td');

				table.appendChild(tr_td);
				tr_td.appendChild(td_name);
				tr_td.appendChild(td_mail);
				td_name.innerText = team.participants[j].name;
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