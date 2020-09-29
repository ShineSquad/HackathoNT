<!DOCTYPE html>
<html>
	<head>
		<title>HackathoNT</title>
		<meta charset="utf-8">
		<link rel="shortcut icon" href="images/logo.ico" type="image/png">

		<link rel="stylesheet" type="text/css" href="styles/styles.css">
		<?php
			require_once "php/check_mobile.php";
			if ( check_mobile() ) {
				?>
					<link rel="stylesheet" type="text/css" href="styles/mobile/main.css">
					<link rel="stylesheet" type="text/css" href="styles/mobile/waiting.css">
					<link rel="stylesheet" type="text/css" href="styles/mobile/prize_fund.css">
					<link rel="stylesheet" type="text/css" href="styles/mobile/about.css">
					<link rel="stylesheet" type="text/css" href="styles/mobile/tasks.css">
					<link rel="stylesheet" type="text/css" href="styles/mobile/requirements.css">
					<link rel="stylesheet" type="text/css" href="styles/mobile/schedule.css">
					<link rel="stylesheet" type="text/css" href="styles/mobile/ooter.css">
				<?
			}
			else {
				?>
					<link rel="stylesheet" type="text/css" href="styles/main.css">
					<link rel="stylesheet" type="text/css" href="styles/waiting.css">
					<link rel="stylesheet" type="text/css" href="styles/prize_fund.css">
					<link rel="stylesheet" type="text/css" href="styles/about.css">
					<link rel="stylesheet" type="text/css" href="styles/tasks.css">
					<link rel="stylesheet" type="text/css" href="styles/requirements.css">
					<link rel="stylesheet" type="text/css" href="styles/schedule.css">
					<link rel="stylesheet" type="text/css" href="styles/footer.css">
				<?
			}
		?>

		<script type="text/javascript" src="scripts/script.js"></script>

	</head>
	<body>
		<div id="main">
			<div class="container">
				<header>
					<div class="logo">
						<img src="images/white_irid_logo.svg">
					</div>
					<ul class="navigation">
						<li class="nav_item"><a href="#prize_fund">Призы</a></li>
						<li class="nav_item"><a href="#about">О хакатоне</a></li>
						<li class="nav_item"><a href="#waiting">Кого мы ждем</a></li>
						<li class="nav_item"><a href="#tasks">Задачи</a></li>
						<li class="nav_item"><a href="#requirements">Правила</a></li>
						<li class="nav_item"><a href="#footer">Организаторы</a></li>
					</ul>
				</header>
				<main>
					<div class="main_content">
						<div class="main_content_date">16-18 октября 2020</div>
						<div class="main_content_title">HackathoNT<br> Умный дом</div>
						<div class="main_content_about">
							<b>HackathoNT «Умный дом»</b> - это офлайн хакатон <br>новых технологий в сфере Smart House<br> для опытных и начинающих разработчиков<br> в Нижнем Тагиле, площадка пр. Мира 2А
						</div>
						<div class="main_content_button" onclick="openForm()">Принять участие</div>
					</div>
					<div class="main_house">
						<img src="images/house.svg">
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
					<p class="about_left_left">Осталось:</p>
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
						Главная цель – улучшение окружения и качества жизни <br>людей, поэтому компания Иридиум активно внедряет <br>технологии «Умный дом» в Нижнем Тагиле и других городах <br>России. <br><br>
						16-18 октября 2020 состоится уникальное событие – <br>«HackathoNT - Умный дом», который поможет реализовать <br>новые идеи и помочь развитию десяткам проектов. <br><br>
						Во время хакатона команды IT-специалистов и начинающих <br>разработчиков займутся проектированием цифровых <br>сервисов, которые будут отвечать на существующие запросы <br>в рамках темы Smart House. <br><br>
						Мы приглашаем участников реализовать свои идеи вместе с <br>опытными наставниками и побороться за денежный приз. <br><br>
						Хакатон «Умный дом» не просто конкурс - с утра до 00 ночи <br>тебя ждет атмосфера увлекательного общения с <br>интересными людьми, новые знакомства, активные <br>соревнования, дневная и вечерняя развлекательная <br>программа. <br><br>
						Собирай свою команду 2-4 человек или регистрируйся один <br>и мы подберем для тебя команду. В любом случае, это будут <br>незабываемые и плодотворные выходные. Присоединяйся!
					</p>
				</div>
			</div>
		</div>
		<div id="waiting">
			<div class="container">
				<div class="waiting_left">
					<img src="images/man.png">
				</div>
				<div class="waiting_right">
					<div class="fix">
						<div class="waiting_right_title">Кого мы ждем?</div>
						<ul class="waiting_right_list_role">
							<li class="list_role_item">
								Программистов
								<p>
									Разработчики веб и мобильных интерфейсов. <br>
									Full-stack, frontend, backend, CV, NLP.
								</p>
							</li>
							<li class="list_role_item">
								Дизайнеров
								<p>
									Дизайнеров Web, mobil, Ui, UX, <br>
									а также графические и пром. дизайнеры
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
					Задачи
				</div>
				<div class="tasks_list">
					<div class="tasks_list_item">
						<div>
							<img class="tasks_list_item_logo" src="images/blue_irid_logo.svg">
							<p class="tasks_list_item_type">Климатконтроль</p>
							<p class="tasks_list_item_title">Система автоматизированного управления климатом в помещении </p>
							<p class="tasks_list_item_descriptions">Текст описание задачи. Управление с помощью IR команд. В данном случае команды от системы автоматизации идут не по проводам, напрямую в контроллер системы кондиционирования, а от ИК излучателя Умного дома в ИК приемник кондиционера.</p>
						</div>
					</div>
					<div class="tasks_list_item">
						<div>
							<img class="tasks_list_item_logo" src="images/blue_irid_logo.svg">
							<p class="tasks_list_item_type">Безопасность</p>
							<p class="tasks_list_item_title">Система контроля и мониторинга частного дома</p>
							<p class="tasks_list_item_descriptions">Текст описание задачи. Управление с помощью IR команд. В данном случае команды от системы автоматизации идут не по проводам, напрямую в контроллер системы кондиционирования, а от ИК излучателя Умного дома в ИК приемник кондиционера.</p>
						</div>
					</div>
					<div class="tasks_list_item">
						<div>
							<img class="tasks_list_item_logo" src="images/mts_logo.svg">
							<p class="tasks_list_item_type">Умная квартира</p>
							<p class="tasks_list_item_title">Создание сценариев управления устройствами Умного дома</p>
							<p class="tasks_list_item_descriptions">Текст описание задачи. Управление с помощью IR команд. В данном случае команды от системы автоматизации идут не по проводам, напрямую в контроллер системы кондиционирования, а от ИК излучателя Умного дома в ИК приемник кондиционера.</p>
						</div>
					</div>
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
							Команда может состоять из 2-5 человек
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
					* Внутреннее расписание мероприятия может слегка меняться. <br>
					** Время отведенное на работу каждый участник организует самостоятельно (определяет перерывы и время на развлечения)
				</p>
			</div>
		</div>
		<div id="footer">
			<div class="container">
				<div class="footer_irid">
					<div class="footer_title">Учредитель мероприятия:</div>
					<img class="footer_irid_logo" src="images/blue_irid_logo.svg">
					<p class="footer_irid_company">ООО «Иридиум»</p>
					<p class="footer_irid_address">Нижний Тагил, пр.Мира, 56 Б</p>
					<p class="footer_irid_phone">+7 (343) 271-47-13</p>
					<a href="https://iridi.com/" class="footer_irid_link">iridi.com</a>
				</div>
				<div class="footer_shinesquad">
					<p class="footer_shinesquad_prev">Разработчики и <br>организаторы HackathoNT:</p>
					<div class="footer_shinesquad_desc">
						<div class="footer_shinesquad_description_name">
							Команда <br>Shine Squad
						</div>
						<div class="footer_shinesquad_desc_description">
							<p class="one">Будем курировать мероприятие, всё расскажем и поможем. Вопросы пишите нам на почту:</p>
							<p class="two">shinesquad.tech@gmail.com</p>
							<p class="three">Или в соц. сети</p>
						</div>
					</div>
				</div>
				<div class="cards">
					<div class="card">
						<div class="avatar">
							<img src="images/photos/nikita.png">
						</div>
						<p class="fi">Киселев Никита</p>
						<p class="card_desc">Преподаватель кафедры ИТ НТГСПИ, Финалист многочисленных хакатонов</p>
						<p class="skills"><b>Skils:</b> Back-end, Arduino</p>
						<a href="https://vk.com/rick_sun">Подробнее</a>
					</div>
					<div class="card">
						<div class="avatar">
							<img src="images/photos/nekit.jpg">
						</div>
						<p class="fi">Турищев Инвер</p>
						<p class="card_desc">Победитель нескольких ИТ-конкурсов по России, успешный спикер</p>
						<p class="skills"><b>Skils:</b> Projekt, Speech, Arduino</p>
						<a href="https://vk.com/pussycat_in_boots">Подробнее</a>
					</div>
					<div class="card">
						<div class="avatar">
							<img src="images/photos/arina.png">
						</div>
						<p class="fi">Бояршинова Арина</p>
						<p class="card_desc">Участник и финалист хакатонов. Проектировщик и дизайнер веб-сервисов</p>
						<p class="skills"><b>Skils:</b> UX design, Events</p>
						<a href="https://vk.com/arina_boyarshinova">Подробнее</a>
					</div>
					<div class="card">
						<div class="avatar">
							<img src="images/photos/artem.png">
						</div>
						<p class="fi">Бурасов Артём</p>
						<p class="card_desc">Участник и финалист хакатонов, координатор ИТ-мероприятий</p>
						<p class="skills"><b>Skils:</b> Front-end, Arduino</p>
						<a href="https://vk.com/id471609274">Подробнее</a>
					</div>
				</div>
			</div>
		</div>
		<div id="main_footer">
			<div class="container">
				<div class="madeby">© HackathoNT Smart House 2020</div>
				<ul class="menu">
					<li class="nav_item"><a href="#prize_fund">Призы</a></li>
					<li class="nav_item"><a href="#about">О хакатоне</a></li>
					<li class="nav_item"><a href="#waiting">Кого мы ждем</a></li>
					<li class="nav_item"><a href="#tasks">Задачи</a></li>
					<li class="nav_item"><a href="#requirements">Правила</a></li>
					<li class="nav_item"><a href="#footer">Организаторы</a></li>
				</ul>
				<div class="footer_button" onclick="openForm()">Зарегистрироваться</div>
			</div>
		</div>
	</body>
</html>