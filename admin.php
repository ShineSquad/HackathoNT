<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Админка</title>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.18.0/js/md5.min.js" integrity="sha512-Hmp6qDy9imQmd15Ds1WQJ3uoyGCUz5myyr5ijainC1z+tP7wuXcze5ZZR3dF7+rkRALfNy7jcfgS5hH8wJ/2dQ==" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
		<script src="https://www.gstatic.com/firebasejs/8.0.1/firebase-app.js"></script>
		<script src="https://www.gstatic.com/firebasejs/8.0.1/firebase-auth.js"></script>
		<script src="https://www.gstatic.com/firebasejs/8.0.1/firebase-database.js"></script>
		<script type="text/javascript" src="scripts/fb_init.js"></script>
		<script type="text/javascript" src="scripts/admin.js"></script>
		<link rel="stylesheet" type="text/css" href="styles/admin.css">
	</head>
	<body>
		<script type="text/javascript">
			window.onload = () => {
				fb_init();
				let user = localStorage.getItem("user");
				if (user == null) { window.location.href = "auth.html"; }
				else { createTable(); createTable2(); }
			}
		</script>
		<div>
			<form method="post" onSubmit="return false;" id="regAdmin">
				<input type="text" name="name" placeholder="Имя">
				<input type="password" name="password" placeholder="Пароль">
				<button onclick="reg()">Регистрация</button>
			</form>
			<hr>
		</div>
		<div class="tables">
			<div class="table_container">
				<table id="team_list1" border="1">
					<tr>
						<th>ФИО</th>
						<th>Почта</th>
					</tr>
				</table>
				<a href="admin.php?infoReport=1" class="btn">Сформировать отчет с информацией</a>
			</div>
			<div class="table_container">
				<table id="team_list2" border="1">
					<tr>
						<th>ФИО</th>
						<th>Росписи</th>
					</tr>
				</table>
				<a href="admin.php?signReport=1" class="btn">Сформировать отчет с подписями</a>
			</div>
		</div>
		<?php

			ini_set("display_errors", 1);
			// error_reporting(0);

			require './vendor/autoload.php';

			use Kreait\Firebase\Factory;
			use Kreait\Firebase\ServiceAccount;

			use PhpOffice\PhpWord\PhpWord;

			function createReportInfo() {
				$factory = (new Factory)->withServiceAccount('./php/hackathont-d9b44-ef6940892e5a.json');

				$database = $factory->createDatabase();
				$reference = $database->getReference('teams');
				$snapshot = $reference->getSnapshot();
				$data = $snapshot->getValue();

				$phpWord = new PhpWord();

				$phpWord -> setDefaultFontName('Times New Roman');
				$phpWord -> setDefaultFontSize(14);

				$properties = $phpWord -> getDocInfo();

				$properties->setCreator('Morty');
				$properties->setCompany('ShineSquad');
				$properties->setTitle('Report');
				$properties->setDescription('This is my report');
				$properties->setCategory('My category');
				$properties->setLastModifiedBy('Morty');
				$properties->setCreated(mktime(0, 0, 0, 3, 12, 2014));
				$properties->setModified(mktime(0, 0, 0, 3, 14, 2014));
				$properties->setSubject('My subject');
				$properties->setKeywords('my, key, word');

				$cellRowContinue = array(
					'vMerge' => 'continue',
					'valign' => 'center'
				);
				$cellRowRestart = array(
					'vMerge' => 'restart',
					'valign' => 'center'
				);
				$sectionStyle = array(
					'orientation' => 'landscape',
				);
				$cellHCentered = array(
					'align' => 'center'
				);
				$cellVCentered = array(
					'valign' => 'center'
				);
				$styleTable = array(
					'borderSize' => 6, 
					'borderColor' => '999999',
				);

				$section = $phpWord -> addSection($sectionStyle);

				$phpWord->addTableStyle('Colspan Rowspan', $styleTable);
				$table = $section->addTable('Colspan Rowspan');
				$table->addRow(null, array('tblHeader' => true));
				$table->addCell(7000, $cellVCentered)->addText(
					'ФИО', 
					array('bold' => true), 
					$cellHCentered
				);
				$table->addCell(7000, $cellVCentered) -> addText(
					'Почта', 
					array('bold' => true), 
					$cellHCentered
				);

				foreach ($data as $key => $value) {
					$team_name = $value["name_team"];
					$participants = $value["participants"];
					$table->addRow(null, array('tblHeader' => true));
					$table->addCell(14000, $cellVCentered) -> addText(
						$team_name, 
						array('bold' => true), 
						$cellHCentered
					);
					foreach ($participants as $key => $val) {
						$mail = $val["mail_part"];
						$name = $val["name_part"];
						if ($name == NULL) {  } else {
							$table->addRow(null, array('tblHeader' => true));
							$table->addCell(7000, $cellVCentered) -> addText(
								$name, 
								array('bold' => false), 
								$cellHCentered
							);
							$table->addCell(7000, $cellVCentered) -> addText(
								$mail, 
								array('bold' => false), 
								$cellHCentered
							);
						}
						
					}
				}

				$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007', $download = true);
	 
				header('Content-Disposition: attachment; filename="report.docx"');
				header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
				
				ob_clean();
				$objWriter->save('php://output');
				exit;
			}

			function createReportSign() {
				$factory = (new Factory)->withServiceAccount('./php/hackathont-d9b44-ef6940892e5a.json');

				$database = $factory->createDatabase();
				$reference = $database->getReference('teams');
				$snapshot = $reference->getSnapshot();
				$data = $snapshot->getValue();

				$phpWord = new PhpWord(); 

				$phpWord -> setDefaultFontName('Times New Roman');
				$phpWord -> setDefaultFontSize(14);

				$properties = $phpWord -> getDocInfo();

				$properties->setCreator('Morty');
				$properties->setCompany('ShineSquad');
				$properties->setTitle('Report');
				$properties->setDescription('This is my report');
				$properties->setCategory('My category');
				$properties->setLastModifiedBy('Morty');
				$properties->setCreated(mktime(0, 0, 0, 3, 12, 2014));
				$properties->setModified(mktime(0, 0, 0, 3, 14, 2014));
				$properties->setSubject('My subject');
				$properties->setKeywords('my, key, word');

				$cellRowContinue = array(
					'vMerge' => 'continue',
					'valign' => 'center'
				);
				$cellRowRestart = array(
					'vMerge' => 'restart',
					'valign' => 'center'
				);
				$sectionStyle = array(
					'orientation' => 'landscape',
				);
				$cellHCentered = array(
					'align' => 'center'
				);
				$cellVCentered = array(
					'valign' => 'center'
				);
				$styleTable = array(
					'borderSize' => 6, 
					'borderColor' => '999999',
				);

				$section = $phpWord -> addSection($sectionStyle);

				$phpWord->addTableStyle('Colspan Rowspan', $styleTable);
				$table = $section->addTable('Colspan Rowspan');
				$table->addRow(null, array('tblHeader' => true));
				$table->addCell(7000, $cellVCentered)->addText(
					'ФИО', 
					array('bold' => true), 
					$cellHCentered
				);
				$table->addCell(7000, $cellVCentered) -> addText(
					'Роспись', 
					array('bold' => true), 
					$cellHCentered
				);

				foreach ($data as $key => $value) {
					$team_name = $value["name_team"];
					$participants = $value["participants"];
					$table->addRow(null, array('tblHeader' => true));
					$table->addCell(14000, $cellVCentered) -> addText(
						$team_name, 
						array('bold' => true), 
						$cellHCentered
					);
					foreach ($participants as $key => $val) {
						$name = $val["name_part"];
						if ($name == NULL) {  } else {
							$table->addRow(null, array('tblHeader' => true));
							$table->addCell(7000, $cellVCentered) -> addText(
								$name, 
								array('bold' => false), 
								$cellHCentered
							);
							$table->addCell(7000, $cellVCentered) -> addText(
								'', 
								array('bold' => false), 
								$cellHCentered
							);
						}
						
					}
				}

				$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
	 
				header('Content-Disposition: attachment; filename="Отчет для сбора подписей.docx"');
				header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
				
				ob_clean();
				$objWriter->save('php://output');
				exit;
			}

			if($_GET['infoReport']){
			   createReportInfo();
			}

			if($_GET['signReport']){
			   createReportSign();
			}
			
		?>
	</body>
</html>