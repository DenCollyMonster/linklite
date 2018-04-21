// JavaScript Document

if (typeof jQuery === 'undefined') {
  throw new Error('Diary Server JavaScript API requires jQuery');
}

$( function() {
	
	var json, out;
	
	if ( "" === window.location.hash ) { /* Проверяем, если хеш пустой, то */
		window.location.hash = "home";   /* кидаем на главную. */
	}
	dod( window.location.hash.substring( 1 ) ); /* Обновляем страницу после проверки. */
	$( window ).bind( "hashchange", function(){ /* Если сменился, то */
		dod( window.location.hash.substring( 1 ) ); /* обновлям страницу. */
	});
	function dod( hash ) {
		$.get( "./get-page.php",
			  { hash: hash },
			  function( data ){
				  $( "body" ).scrollTop( 0 );
				  $( "#content" ).html( data );
		});
		if ( window.location.hash.substring( 1 ) == "home" ) { /* Если главная, то */
			loadPostList(); /* обновляем список записей. */
		}
	}
	
	function loadPostList() {
		$.ajax({
			url: "./api.php",
			data: { action: "getPostsList" },
			success: function( data ) {
				json = eval( '(' + data + ')' );
				
				out = '111';
				
				for(var i = 1; i < 3; i++) {
					out = out + '<tr class="tr-post-info">' +
						'<td>' + json.postlist[i].create_timestamp + '</td>' +
						'<td>' + json.postlist[i].name + '</td>' +
						'<td><a href="#">' + json.postlist[i].id + '</a></td>' +
					'</tr>';
				}
				
				$( "table#tbl-post-list tbody" ).html( out )
				//alert( data );
			}
		});
		
		
		
	}
	
	$.ajax({
		url: "./api.php",
		data: { action: "test", v1: "111", v2: "sss" },
		success: function( data ) {
			//alert( data );
		}
	});
});