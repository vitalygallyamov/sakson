$(document).ready(function() {
	var timeId = false;
	var card = false;

	if($('.items .empty').length)
		$('.to_mail').hide();
	// var stopEvent = function stopEvent(evt) {
	// 	(evt && evt.stopPropagation) ? evt.stopPropagation() : window.event.cancelBubble = true;
	// };
	$('.catalog').on('click', '.center_col .izb, .izb-detail', function(e){
		// e.preventDefault();
		e.stopPropagation();
	});

	$('.catalog').on('click', '.link-photo', function(e){
		e.preventDefault();
		e.stopPropagation();

		$(this).closest('.media').find('.pull-left').click();
	});

	$('.catalog').on('change', '.center_col .izb, .izb-detail', function(e){
		//e.stopPropagation();
		e.preventDefault();

		var $this = $(this),
			id = $this.data('id'),
			type = $this.data('type');

		var checked = $this.find('input[type=checkbox]').is(':checked'),
			inIzb = $this.closest('.izb_block').length;

		checked ? $this.attr('title', "Удалить из избранного") : $this.attr('title', "Добавить в избранное");

		if(timeId) clearTimeout(timeId);

		if(!checked && inIzb){
			$this.closest('.media').hide(300, function(){
				$(this).remove();
			});
		}

		timeId = setTimeout(function(){
			$.ajax({
				url: checked ? "/favorites/add" : "/favorites/delete",
				data: {id: id, type: type},
				success: function(data){
					if(inIzb)
						$.fn.yiiListView.update("favorites-list",{ajaxType: 'GET'});
					
				}
			});
		}, 400);

	});


	$('.catalog').on('click', '.media-item, .card .media-body', function(e){
		e.preventDefault();

		var $this = $(this),
			id = $this.data('id');

		if($this.closest('.card').length){
			$this.closest('.card').hide();
			$this.closest('.card').prev().fadeIn(500);
		}else{
			$this.hide();
			$this.next().fadeIn(500);
		}

		/*$.ajax({
			url: '/catalog/getDetailView',
			data: {id: id},
			success: function(res){
				// var $body = $(res).find('.media').html();
				// console.log($(res).find('.media'));
				$this.addClass('card').html(res);
			}
		});*/
	});

	/*$('.catalog .media').hover(function(){
		var $this = $(this);

		$this.find('.izb').show();
	}, function(){
		var $this = $(this);

		$this.find('.izb').hide();
	});*/
	
});
