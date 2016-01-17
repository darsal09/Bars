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
        this.mPlaces = new Places();
		this.initialEvents();
		this.loadPlaces();
//        this.setImageSize();
	},
    setImageSize:function(){
        $width = $('#page').width();
        $('#page img').css({
            'max-width' : $width , 'height' : 'auto'
        });

    },
	initialEvents:function(){
		$("#places").on("swipeleft", 'img',{parent:this}, function( e ){
			e.data.parent.pop();
			$( this ).hide();
			e.data.parent.show();
		});                       
		
		$("#places").on("swiperight", 'img', {parent:this}, function( e ){
			e.data.parent.pop();
			$(this).hide();
			e.data.parent.show();
		});                       

	},
	loadPlaces:function(){
		this.addPlaces();
		this.show();
	},
    addPlaces:function(){
        var places = this.getPlaces();

        for( var index in places ){
            this.mPlaces.add( places[ index ] );
        }
    },
	getPlaces:function(){
		return [
			new Place( 'Sunrise Cafe', 'images/food1.jpg' ),
			new Place( 'Forrest Point', 'images/food2.jpg' ),
			new Place( 'Sycamore', 'images/food3.jpg' ),
			new Place( 'Giorgio\'s Restaurant', 'images/food4.jpg' ),
			new Place('Montana Trail', 'images/food5.jpg' )
		];
	},
	show:function(){
        if( this.mPlaces.getLength() <= 2 ){
            this.addPlaces();
        }

		if( this.mPlaces.getLength() < 1 ){
			this.done();
			return;
		}
		
		$( '#places' ).html( this.mPlaces.get() );
	},
	pop:function(){
		this.mPlaces.remove();
	},
	done:function(){
		$( '#places').html( '<h1>Thank you for participating!</h1>' );
	}
	
};

function Places( ){
    this.mPlaces = [];
    this.mLength = 0;

    this.add = function( Place ){
        this.mPlaces[ this.mLength ] = Place;
        this.mLength++;
    };

    this.remove = function( ){
        this.mPlaces.splice( 0, 1 );
        this.mLength--;
    };
    this.get = function(){
        return this.mPlaces[ 0].get();
    };
    this.getLength = function(){
        return this.mLength;
    };
}

function Place( name,  image){
	this.name = name;
	this.image = image;
	this.get = function(){
		return '<h3>'+this.name+'</h3><img src="'+this.image+'">';
	};
}

$( function(){
	places.init();
});

</script>
<style>
.ui-content{
    padding:0px;
}
IMG{
    width:100%;
}


</style>
</head>
<body>

<div role="page" data-theme="a" data-form="ui-page-theme-a" class="ui-content ui-page-theme-a">
    <div data-role="header">
        <h1>My Places</h1>
        <a data-form="ui-icon" title=" Navigation " class="ui-btn-right ui-btn-corner-all ui-btn ui-icon-grid ui-btn-icon-notext ui-shadow" data-role="button" role="button"> Navigation </a>
    </div>
    <div class="ui-body ui-body-a" data-form="ui-body-a" data-theme="a"  id="places" role="main">
    </div>
  <div data-role="footer"  data-theme="a" data-form="ui-page-theme-a" class="ui-content ui-page-theme-a">
    <h1>&copy; 2016 My Places</h1>
  </div>
</div> 

</body>
</html>
