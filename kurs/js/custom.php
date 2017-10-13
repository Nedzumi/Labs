function send(wrap,genres,years,obj) {
    jQuery.ajax({
        url: '/tmpl/random.php',
        method: 'POST',
        data: 'genres='+genres+'&years='+years,
        success: function(resp){
            obj.counter++;
            if (!resp && obj.counter <= obj.requests) {
        	setTimeout(send(wrap,genres,years,obj),2000);
            }
            wrap.empty();
            if (resp) {
        	wrap.append(resp);
        	ninja.hide();
    	    }
            
            if (!resp && obj.counter > obj.requests) {
        	wrap.html('<h2>Ничего не найдено :(</h2><p>Попробуйте изменить параметры поиска и попробовать снова</p>');
        	ninja.hide();
            }
            
        }
                
    });
}

jQuery(document).ready(function(){
    jQuery('#ex2').slider({});
    
    btnrand = jQuery('#getrandom');
    wrap = jQuery('#wrap');
    ninja = jQuery('#ninja');
    btnrand.click(function(){
	ninja.show();
	var obj = {};
	obj.requests = 10;
	obj.counter = 1;
	
	//get genres
	genres = '';
	jQuery.each(jQuery('#genres input:checked'),function(){
	    genres = genres + jQuery(this).val() + ' ';
	});
	genres = genres.trim();
	//get years
	years = jQuery('#ex2').val();
	//send AJAX
	send(wrap,genres,years,obj);
	
	
    });
    
})

