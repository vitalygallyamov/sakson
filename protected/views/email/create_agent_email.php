<h2>Доступы в систему управления объектами недвижимости</h2>
<p>Создана новая учетная запись.</p>
<p>Данные для входа в систему:</p>
<strong>Логин: </strong> <?=CHtml::encode($model->login)?><br>
<strong>Пароль: </strong> <?=CHtml::encode($model->pass)?>
<p><a href="<?=Yii::app()->createAbsoluteUrl('admin')?>">Ссылка</a> для входа в систему.</p>