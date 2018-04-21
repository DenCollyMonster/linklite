
if ( MAIN.PL_V <= 0.0 ) {
  throw new Error('Diary Server JavaScript API requires PL_V');
}

$( function() {
	
	if ( "" == window.location.hash ) { /* Проверяем, если хеш пустой, то */
		window.location.hash = "home";   /* кидаем на главную. */
	}
	MAIN.hashchange();
	
	$( window ).bind( "hashchange", function(){ /* Если сменился, то */
		MAIN.hashchange();
	});
	
	/*$( ".tr-post-info" ).click();
	function() {
		window.location.hash = "post";
		alert("Click!");
	});*/
	
	
	
	
});
