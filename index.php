<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<script>
var places = {
	init:function(){
		this.initialEvents();
		this.loadPlaces();
	},
	initialEvents:function(){
		$("#places").on("swipeleft", 'p',{parent:this}, function( e ){
			e.data.parent.pop();
			$( this ).hide();
			e.data.parent.show();
		});                       
		
		$("#places").on("swiperight", 'p', {parent:this}, function( e ){
			e.data.parent.pop();
			$(this).hide();
			e.data.parent.show();
		});                       

	},
	loadPlaces:function(){
		this.mPlaces = this.getPlaces();
		
		this.show();
	//	this.initialEvents();
	},
	getPlaces:function(){
		return [
			new Place( 'Sunrise Cafe', 'images/food1.jpg' ),
			new Place( 'Forrest Point', 'images/food2.jpg' ),
			new Place( 'Sycamore', 'images/food3.jpg' ),
			new Place( 'Giorgio\s Restaurant', 'images/food4.jpg' ),
			new Place('Montana Trail', 'images/food5.jpg' )
		];
	},
	show:function(){
		if( this.mPlaces.length < 1 ){
			this.done();
			return;
		}
		
		$( '#places' ).html( this.mPlaces[ 0 ].get() );
	},
	pop:function(){
		this.mPlaces.splice( 0, 1 );
	},
	done:function(){
		$( '#places').html( '<h1>Thank you for participating!' );
	}
	
};

function Place( name,  image){
	this.name = name;
	this.image = image;
	this.get = function(){
		return '<p>'+this.name+'<br/><img src="'+this.image+'"></p>';
	}
}

$( function(){
	places.init();
});

</script>
</head>
<body>

<div data-role="page" id="pageone">
  <div data-role="header">
    <h1>The swipe Event</h1>
  </div>

  <div data-role="main" class="ui-content" id="places">
  </div>

  <div data-role="footer">
    <h1>Footer Text</h1>
  </div>
</div> 

</body>
</html>
