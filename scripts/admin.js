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