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
		postData = {};
	for(var pair of formData.entries()) {
	   	postData[pair[0]]=pair[1];
	}
	postData['password'] = md5(postData['password']);
	let users = firebase.database().ref("admins").orderByChild("name").equalTo(postData['name']).once("value", (resp) => {
		if (resp.val() == null) {
			alert('Пользователя с таким именем не существует')
		} else {
			for (i in resp.val()) {
				let passhash = postData['password'];
				if (passhash == resp.val()[i].password) {
					localStorage.setItem("user", postData['name']);
					window.location.href = "./admin.php";
				} else {
					alert('Неверный пароль')
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
			td.rowSpan = 2;
			td.innerText = team.name_team;
			td.classList.add('title_team');
			for (j in team.participants) {
				let tr_td = document.createElement('tr'),
					td_name = document.createElement('td'),
					td_mail = document.createElement('td');

				table.appendChild(tr_td);
				tr_td.appendChild(td_name);
				tr_td.appendChild(td_mail);
				td_name.innerText = team.participants[j].name_part;
				td_mail.innerText = team.participants[j].mail_part
				console.log(team.participants[j].name_part);
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
			td.rowSpan = 2;
			td.innerText = team.name_team;
			td.classList.add('title_team');
			for (j in team.participants) {
				let tr_td = document.createElement('tr'),
					td_name = document.createElement('td'),
					td_mail = document.createElement('td');

				table.appendChild(tr_td);
				tr_td.appendChild(td_name);
				tr_td.appendChild(td_mail);
				td_name.innerText = team.participants[j].name_part;
				console.log(team.participants[j].name_part);
			}
		}
	})
}