
/* MAIN */

if (typeof jQuery === 'undefined') {
  throw new Error('Diary Server JavaScript API requires jQuery');
}

function MAIN() {
	this.PL_V = 0.1;
	this.STAGE = "beta";
	this.POST_TOTAL = 0;
	
	this._TO_TAG = 0;
	this._TO_SHA = 1;
}

MAIN.prototype.hashchange = function() {
	if ( window.location.hash.substring( 1 ) == "home" ) { /* Если главная, то */
		SERVER.loadTemplate( "home" );
		SERVER.loadPostList(); /* обновляем список записей. */
		for( var i = 0; i <= MAIN.POST_TOTAL; i++ ) {
			$( "tr[count=" + i + "]" ).click( function() {
				MAIN.selectpost( i );
			});
		}
	} else if ( window.location.hash.substring( 1 ).search(/post/i) != -1 ) {
		pos = window.location.hash.substring( 1 );
		id = pos.substring( pos.length - 1 );
		SERVER.loadTemplate( "post" );
		SERVER.loadPost( id );
	} else {
		SERVER.loadTemplate( window.location.hash.substring( 1 ) ); /* обновлям страницу. */
	}
}

MAIN.prototype.selectpost = function( id ) {
	window.location.hash = "post" + id;
	//alert("Click! " + MAIN.POST_TOTAL);
}

MAIN.prototype.tagconvert = function( str, mode = MAIN._TO_TAG ) {
	switch( mode ) {
		case 0:
			
			break;
		
		case 1:
			
			break;
	}
}

var MAIN = new MAIN()

/* AJAX */

function AJAX(){
	this.URL_API = "./api.php";
	//this.URL_
	
	this.hash_home = "home";
	
	this.json = "";
	this.template = "";
}

AJAX.prototype.loadPostList = function() {
	$.ajax({
		url: this.URL_API,
		data: { "action": "getPostsList" },
		success: function( data ) {
			IO.updatePostList( data );
		}
	});
}

AJAX.prototype.loadPost = function( id ) {
	$.ajax({
		url: this.URL_API,
		data: { "action": "getPost", "id": id },
		success: function( data ) {
			IO.updatePost( data );
		}
	});
}

/*AJAX.prototype.loadTemplate = function( hash ) {    <<<------- version 0.1 beta
	$.ajax({
		url: this.URL_API,
		data: { action: "getTemplate", hash: hash },
		success: function( data ) {
			IO.updateTemplate( data );
		}
	});
}*/

AJAX.prototype.loadTemplate = function( name ) {
	$.ajax({
		url: this.URL_API,
		data: { "action": "getTemplate", "name": name },
		success: function( data ) {
			data = eval( data );
			//IO.updateTemplate( data );
			return data;
		}
	});
}

var SERVER = new AJAX();

/* IO */

function IO() {
	this.template;
}

IO.prototype.updateTemplate = function( data ) {
	//data = eval( '(' + data + ')' );
	
	/*if( ( data.template['name'] != window.location.hash.substring( 1 ) ) || ( data.status != 1 ) ) {
		throw new Error( "Сбой в работе сервера или ваше интернет подключение кто-то прослушивает!" );
	}*/
	
	$( "body" ).scrollTop( 0 );
	$( "#content" ).html( data.template.text );
}

IO.prototype.updatePostList = function( data ) {
	data = eval( '(' + data + ')' );
	var out = "";
	
	MAIN.POST_TOTAL = data.postlist.length;
	
	for( var i = 0; i < data.postlist.length; i++ ) {
		out = out + '<tr class="tr-post-info" count="' + data.postlist[i].id + '">' +
			'<td>' + data.postlist[i].create_timestamp + '</td>' +
			'<td>' + data.postlist[i].name + '</td>' +
			'<td><a href="#">' + data.postlist[i].id + '</a></td>' +
		'</tr>';
	}
	
	$( "table#tbl-post-list tbody" ).html( out );
}

IO.prototype.updatePost = function( data ) {
	data = eval( '(' + data + ')' );
	var out = 1511;
	
	
	
	$( "#content" ).html( out );
}

var IO = new IO();