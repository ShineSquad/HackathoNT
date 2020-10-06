<!DOCTYPE html>
<html>
	<head>
		<title>HackathoNT</title>
		<meta charset="utf-8">
		<link rel="shortcut icon" href="images/logo.svg" type="image/png">

		<script type="text/javascript" src="scripts/main.js"></script>
		<?php
			require_once "php/check_mobile.php";
			if ( check_mobile() ) {
				?>
					<script type="text/javascript" src="scripts/mobile_scripts.js"></script>

					<link rel="stylesheet" type="text/css" href="styles/mobile/styles.css">

					<link rel="stylesheet" type="text/css" href="styles/mobile/main.css">
					<link rel="stylesheet" type="text/css" href="styles/mobile/waiting.css">
					<link rel="stylesheet" type="text/css" href="styles/mobile/prize_fund.css">
					<link rel="stylesheet" type="text/css" href="styles/mobile/about.css">
					<link rel="stylesheet" type="text/css" href="styles/mobile/tasks.css">
					<link rel="stylesheet" type="text/css" href="styles/mobile/requirements.css">
					<link rel="stylesheet" type="text/css" href="styles/mobile/schedule.css">
					<link rel="stylesheet" type="text/css" href="styles/mobile/footer.css">
				<?php
			}
			else {
				?>
					<script type="text/javascript" src="scripts/script.js"></script>

					<link rel="stylesheet" type="text/css" href="styles/styles.css">

					<link rel="stylesheet" type="text/css" href="styles/main.css">
					<link rel="stylesheet" type="text/css" href="styles/waiting.css">
					<link rel="stylesheet" type="text/css" href="styles/prize_fund.css">
					<link rel="stylesheet" type="text/css" href="styles/about.css">
					<link rel="stylesheet" type="text/css" href="styles/tasks.css">
					<link rel="stylesheet" type="text/css" href="styles/requirements.css">
					<link rel="stylesheet" type="text/css" href="styles/schedule.css">
					<link rel="stylesheet" type="text/css" href="styles/footer.css">
				<?php
			}
		?>
	</head>
	<body class="onload">
		<div id="loader" class="active"><img src="images/loader.svg"></div>
		<div id="main">
			<div class="container">
				<header>
					<div class="logo">
						<img src="images/white_hackathont_logo.svg">
						<p>HackathoNT 1.0</p>
					</div>
					<ul class="navigation">
						<li class="nav_item"><a href="#prize_fund">Призы</a></li>
						<li class="nav_item"><a href="#about">О хакатоне</a></li>
						<li class="nav_item"><a href="#waiting">Кого мы ждем</a></li>
						<li class="nav_item"><a href="#tasks">Задача</a></li>
						<li class="nav_item"><a href="#requirements">Правила</a></li>
						<li class="nav_item"><a href="#footer">Организаторы</a></li>
					</ul>
					<div class="mobile_block">
						<div class="mobile_logo">
							<img src="images/white_hackathont_logo.svg">
							<p>HackathoNT 1.0</p>
						</div>
						<div class="mobile_burger">
							<img id="open_burger" src="images/open_burger.svg">
							<img id="close_burger" src="images/close_burger.svg">
						</div>
					</div>

					<div class="mobile_content">
						<ul class="nav_menu">
							<li class="nav_item"><a href="#prize_fund">Призы</a></li>
							<li class="nav_item"><a href="#about">О хакатоне</a></li>
							<li class="nav_item"><a href="#waiting">Кого мы ждем</a></li>
							<li class="nav_item"><a href="#tasks">Задача</a></li>
							<li class="nav_item"><a href="#requirements">Правила</a></li>
							<li class="nav_item"><a href="#footer">Организаторы</a></li>
						</ul>
						<p class="address">Нижний Тагил, пр. Мира 2А <br>16-18 окт 2020</p>
						<div class="mobile_content_button" onclick="openForm()">Принять участие</div>
						<p class="text">Курирует хакатон <br>команда <b>Shine Squad</b>. <br>Вопросы пишите нам на почту:</p>
						<p class="mail"><a href="mailto:shinesquad.tech@gmail.com">shinesquad.tech@gmail.com</a></p>
						<div class="social">
							или в соц. сети
							<a href="https://vk.com/hackatont"><img src="images/vk.svg"></a>
							<a href="https://www.instagram.com/hackatho.nt/?r=nametag"><img src="images/instagram.svg"></a>
						</div>
					</div>

				</header>
				<main>
					<div class="main_content">
						<div class="main_content_date">16-18 октября 2020</div>
						<div class="main_content_title">HackathoNT<br> Большие данные</div>
						<div class="main_content_about">
							<b style="font-family: MontserratBold">HackathoNT «Большие данные»</b> - это оффлайн <br>хакатон новых решений в сфере Big Data для <br>опытных и начинающих разработчиков <br>в Нижнем Тагиле, площадка пр. Мира 2А
						</div>
						<div class="main_content_button" onclick="openForm()">Принять участие</div>
					</div>
					<div class="main_house">
						<img src="images/bigData.svg">
					</div>
				</main>
			</div>
		</div>
		<div id="prize_fund">
			<div class="container">
				<img src="images/cup.svg">
				<p class="prize_fund_title">Призовой фонд</p>
				<p class="prize_fund_count">50 000 ₽</p>
			</div>
		</div>
		<div id="about">
			<div class="container">
				<div class="about_left">
					<ul class="about_left_list_questions">
						<li class="list_questions_item">Занимаешь мобильными или <br>веб-разработками?</li><br>
						<li class="list_questions_item">Мечтаешь улучшить город и домашнее <br>пространство?</li><br>
						<li class="list_questions_item">Желаешь попробовать силы и заявить <br>о себе в мире IT?</li><br>
					</ul>
					<p class="about_left_call">Тогда HackathoNT <br>для тебя!</p>
					<div class="about_left_button" onclick="openForm()">Зарегистрироваться</div>
					<p class="about_left_left">Заявки на участие принимаются до 14 октября <br>Осталось:</p>
					<div id="timer">
						<div class="timer_item">
							<div class="timer_item_block">
								<div class="_days"></div>
							</div>
							<div class="timer_item_name">дней</div>
						</div> <p>:</p>
						<div class="timer_item">
							<div class="timer_item_block">
								<div class="_hours"></div>
							</div>
							<div class="timer_item_name">часов</div>
						</div> <p>:</p>
						<div class="timer_item">
							<div class="timer_item_block">
								<div class="_minutes"></div>
							</div>
							<div class="timer_item_name">минут</div>
						</div> <p>:</p>
						<div class="timer_item">
							<div class="timer_item_block">
								<div class="_seconds"></div>
							</div>
							<div class="timer_item_name">секунд</div>
						</div>
					</div>
				</div>
				<div class="about_right">
					<p class="about_right_title">О хакатоне</p>
					<p class="about_right_description">
						Главная цель – создание прикладных бизнес-решений и <br> системного подхода в сфере Big Data. <br><br>
						16-18 октября 2020 состоится уникальное событие – <br>«HackathoNT - Большие данные», который поможет <br>реализовать новые идеи по технологиям поиска, <br>обработки и систематизации большого количества <br>информации. <br><br>
						Во время хакатона команды IT-специалистов и <br>начинающих разработчиков займутся созданием <br>бизнес-идей по задачам, предложенным <br>компанией «Мотив». <br><br>
						Мы приглашаем участников реализовать свои идеи вместе с <br>опытными наставниками и побороться за денежный приз. <br><br>
						Хакатон «Большие данные» не просто конкурс - с утра до ночи, <br>тебя ждет атмосфера увлекательного общения с <br>интересными людьми, новые знакомства, активные <br>соревнования, дневная и вечерняя развлекательная <br>программа. <br><br>
						Собирай свою команду 2-4 человек. Это будут <br>незабываемые и плодотворные выходные. <br>Присоединяйся!
					</p>
				</div>
			</div>
		</div>
		<div id="waiting">
			<div class="container">
				<div class="waiting_left">
					<img src="images/waiting_bigData.svg">
				</div>
				<div class="waiting_right">
					<div class="fix">
						<div class="waiting_right_title">Кого мы ждем?</div>
						<ul class="waiting_right_list_role">
							<li class="list_role_item">
								Программистов
								<p>
									Разработчики веб и мобильных интерфейсов. <br>
									Full-stack, frontend, backend, NLP, Big Data, ML.
								</p>
							</li>
							<li class="list_role_item">
								Дизайнеров
								<p>
									Дизайнеров Web, mobil, Ui, UX
								</p>
							</li>
							<li class="list_role_item">
								Аналитиков и менеджеров
								<p>Project, Product</p>
							</li>
							<li class="list_role_item">
								Студентов
								<p>По специальностям IT</p>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div id="tasks">
			<div class="container">
				<div class="tasks_title">
					Задача
				</div>
				<div class="tasks_list">

					<div class="tasks_list_item">
						<div>
							<div class="tasks_list_item_top">
								<p class="tasks_list_item_type">Big Data</p>
								<img class="tasks_list_item_logo" src="images/logo/motiv.png">
							</div>
							<p class="tasks_list_item_title">Система оптимизированного внедрения <br>новых сотрудников в компанию </p>
							<p class="tasks_list_item_descriptions">Создание модели помощника для стажировки новых сотрудников. Моделирование системы управления данными (документация, инструкции и т.д.). Это могут быть: чат-бот, голосовой помощник и другое. Приветствуются новые идеи, прототипы и инновационные решения на усмотрение участников.</p>
							<p class="tasks_list_item_goals">Цели:</p>
							<ul class="tasks_list_item_goals_list">
								<li>Автоматизация внедрения новых сотрудников</li>
								<li>Сокращение текучки кадров</li>
								<li>Сокращение расходов на обучение</li>
							</ul>
						</div>
					</div>

<!-- 					<div class="tasks_list_item">
						<div>
							<img class="tasks_list_item_logo" src="images/blue_irid_logo.svg">
							<p class="tasks_list_item_type">Безопасность</p>
							<p class="tasks_list_item_title">Система контроля и мониторинга частного дома</p>
							<p class="tasks_list_item_descriptions">Текст описание задачи. Управление с помощью IR команд. В данном случае команды от системы автоматизации идут не по проводам, напрямую в контроллер системы кондиционирования, а от ИК излучателя Умного дома в ИК приемник кондиционера.</p>
						</div>
					</div>
					<div class="tasks_list_item">
						<div>
							<img class="tasks_list_item_logo" src="images/motiv_logo.png">
							<p class="tasks_list_item_type">Умная квартира</p>
							<p class="tasks_list_item_title">Создание сценариев управления устройствами Умного дома</p>
							<p class="tasks_list_item_descriptions">Текст описание задачи. Управление с помощью IR команд. В данном случае команды от системы автоматизации идут не по проводам, напрямую в контроллер системы кондиционирования, а от ИК излучателя Умного дома в ИК приемник кондиционера.</p>
						</div>
					</div> -->
				</div>
			</div>
		</div>
		<div id="requirements">
			<div class="container">
				<div class="requirements_title">Требования к командам</div>
				<div class="requirements_content">
					<div class="requirements_list_left">
						<div class="requirements_list_item">
							Каждый Участник может входить в состав только <br>одной Команды и не может выступать <br>индивидуально
						</div>
						<div class="requirements_list_item">
							Команда может состоять из 2-4 человек
						</div>
					</div>
					<div class="requirements_list_right">
						<div class="requirements_list_item">
							Участник имеет право покидать <br>площадку мероприятия, но присутствие на чек-пойнтах <br>является обязательным
						</div>
						<div class="requirements_list_item">
							Вы можете зарегистрировать всю команду от своего <br>имени, указав количество человек и всю <br>необходимую информацию в форме заявки
						</div>
					</div>
				</div>
				<div class="requirements_button" onclick="openForm()">Принять участие</div>
				<a href="https://drive.google.com/file/d/10XRh2i5BeVaXxgaDBNELAyi7ar8-DoNF/view?usp=sharing" target="_blank" class="link_requirements">Регламент</a>
			</div>
		</div>
		<div id="schedule">
			<div class="container">
				<div class="schedule_title">Расписание хакатона</div>
				<div class="schedule_content">
					<img src="images/day1.svg">
					<img src="images/day2.svg">
					<img src="images/day3.svg">
				</div>
				<p class="schedule_description">
					* Внутреннее расписание мероприятия может слегка меняться. <br><br>
					** Время отведенное на работу каждый участник организует самостоятельно (определяет перерывы и время на развлечения)
				</p>
			</div>
		</div>
		<div id="footer">
			<div class="container">
				<div class="footer_irid">
					<div class="footer_title">Партнеры:</div>
					<div class="footer_logo_container">
						<a href="https://www.ntspi.ru/" target="_blank"><img src="images/logo/ntgspi.svg"></a>
						<a href="https://motivtelecom.ru/" target="_blank"><img src="images/logo/motiv.png"></a>
						<a href="https://nt.sofp.ru/" target="_blank"><img src="images/logo/fond.png"></a>
					</div>
				</div>
				<div class="footer_shinesquad">
					<p class="footer_shinesquad_prev">Разработчики и <br>организаторы HackathoNT:</p>
					<div class="footer_shinesquad_desc">
						<div class="footer_shinesquad_description_name">
							Команда <br>Shine Squad
						</div>
						<div class="footer_shinesquad_desc_description">
							<p class="one">Будем курировать мероприятие, всё расскажем и поможем. Вопросы пишите нам на почту:</p>
							<a href="mailto:shinesquad.tech@gmail.com"><p class="two">shinesquad.tech@gmail.com</p></a>
							<div class="three">
								Или в соц. сети 
								<a href="https://vk.com/hackatont" target="_blank"><img class="icons" src="./images/vk.svg"></a>
								<a href="https://www.instagram.com/hackatho.nt/?r=nametag" target="_blank"><img class="icons" src="./images/instagram.svg"></a>
							</div>
						</div>
					</div>
				</div>
				<div class="cards">
					<div class="card">
						<div class="avatar">
							<img src="images/photos/nikita.svg">
						</div>
						<div class="shine_sq_user_description">
							<p class="fi">Киселев Никита</p>
							<p class="card_desc">Преподаватель кафедры ИТ НТГСПИ, Финалист многочисленных хакатонов</p>
							<p class="skills"><b>Skills:</b> Back-end, Arduino</p>
							<a href="https://vk.com/rick_sun" target="_blank">Подробнее</a>
						</div>
					</div>
					<div class="card">
						<div class="avatar">
							<img src="images/photos/nekit.svg">
						</div>
						<div class="shine_sq_user_description">
							<p class="fi">Турищев Инвер</p>
							<p class="card_desc">Победитель нескольких ИТ-конкурсов по России, успешный спикер</p>
							<p class="skills"><b>Skills:</b> Project, Speech, Arduino</p>
							<a href="https://vk.com/pussycat_in_boots" target="_blank">Подробнее</a>
						</div>
					</div>
					<div class="card">
						<div class="avatar">
							<img src="images/photos/arina.svg">
						</div>
						<div class="shine_sq_user_description">
							<p class="fi">Бояршинова Арина</p>
							<p class="card_desc">Участник и финалист хакатонов. Проектировщик и дизайнер веб-сервисов</p>
							<p class="skills"><b>Skills:</b> UX design, Events</p>
							<a href="https://vk.com/arina_boyarshinova" target="_blank">Подробнее</a>
						</div>
					</div>
					<div class="card">
						<div class="avatar">
							<img src="images/photos/artem.svg">
						</div>
						<div class="shine_sq_user_description">
							<p class="fi">Бурасов Артём</p>
							<p class="card_desc">Участник и финалист хакатонов, координатор ИТ-мероприятий</p>
							<p class="skills"><b>Skills:</b> Front-end, Arduino</p>
							<a href="https://vk.com/id471609274" target="_blank">Подробнее</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="main_footer">
			<div class="container">
				<div class="madeby">© HackathoNT 1.0 Big Data 2020</div>
				<ul class="menu">
					<li class="nav_item"><a href="#prize_fund">Призы</a></li>
					<li class="nav_item"><a href="#about">О хакатоне</a></li>
					<li class="nav_item"><a href="#waiting">Кого мы ждем</a></li>
					<li class="nav_item"><a href="#tasks">Задача</a></li>
					<li class="nav_item"><a href="#requirements">Правила</a></li>
					<li class="nav_item"><a href="#footer">Организаторы</a></li>
				</ul>
				<div class="footer_button" onclick="openForm()">Зарегистрироваться</div>
			</div>
		</div>
		<a id="scroll_top" draggable="false" href="#main"></a>
	</body>
</html>