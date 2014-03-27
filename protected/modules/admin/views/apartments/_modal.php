<?php $this->widget('bootstrap.widgets.TbModal', array(
    'id' => 'confirmDelete',
    'header' => 'Напишите причину удаления',
    'content' => $this->renderPartial('/deleteApartments/_form', array('model' => $deleteApartment), true),
    'footer' => array(
        TbHtml::button('Сохранить', array('color' => TbHtml::BUTTON_COLOR_PRIMARY, 'class'=>'save-delete-form', 'data-id' => $model->id)),
        TbHtml::button('Закрыть', array('data-dismiss' => 'modal')),
     ),
)); ?>
