<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<script>
var display = {
    init:function(){
        this.mPage = $( '#places' );
        if( this.mPage.length == 0 ){
            return;
        }

        this.load();
    }
};


var menuController={
    init:function(){
        this.mPage = $( '#menu' );
        this.events();
    },
    events:function(){
        this.mPage.on( 'click', 'A', {parent:this}, this.ui.onMenuClicked );
    },
    ui:{
        onMenuClicked:function( e ){
            e.preventDefault();

            switch( $( this).data( 'type' ) ){
                case 'cities':
                    break;
                case 'neighborhoods':
                    areas.init();
                    break;
                case 'boroughs':
                    break;
                default:
                    console.log( 'the option, '+type+' is not on the list' );
            }

        }
    }
};


var areas = {
    init:function(){
      this.mPage = $( '#places' );
      this.mAreas = new Areas();
      this.events();
      this.loadAreas();
    },
    events:function(){
        this.mPage.on( 'click', 'A.areas', {parent:this}, this.ui.onAreaClicked);
    },
    ui:{
        onAreaClicked:function( e ){
            e.preventDefault();
            if( $( this).data( 'type' ) !== 'Neighborhood'){
                return;
            }
            var id = $( this).data( 'id' );

            e.data.parent.loadTypes( id );
        }
    },
    loadAreas:function(){
        var areas = this.getAreas();

        for( var i in areas ){
            this.mAreas.add( areas[ i ]);
        }
        this.show();
    },
    show:function(){
        this.mPage.html( '<h1>Neighborhoods</h1><ul data-role="listview">'+ this.mAreas.get()+ '</ul>' );
    },
    getAreas:function(){
        return [
            new Area( 1, 'Bushwick', []),
            new Area( 2, 'Flatbush', [] ),
            new Area( 3, 'Park Slope', []),
            new Area( 4, 'Williamsburg', [] )
        ];
    },
    loadTypes:function( id ){
        types.init( id );
    }
};

var places = {
	init:function( id ){
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

var types = {
    init:function( id ){
        this.mNeighborhoodID  = parseInt( id );
        if( isNaN( this.mNeighborhoodID  ) || this.mNeighborhoodID < 1 ){
            areas.init();
            return 0;
        }

        this.mPage = $( '#places' );

        if( this.mPage.length == 0 ){
            return 0;
        }

        this.mTypes = new Types();
        this.loadTypes();
        this.events();
    },
    events:function(){
        this.mPage.on( 'click', 'A.types', {parent:this}, this.ui.onNeighborhoodClicked);
    },
    ui:{
        onNeighborhoodClicked:function( e ){
            e.preventDefault();

            var id = parseInt( $( this).data( 'id' ) );

            places.init( id );
        }
    },
    loadTypes:function(){
        var types = this.getTypes();

        for( var i in types ){
            this.mTypes.add( types[ i ] );
        }
        this.show();
    },
    getTypes:function(){
      return [
          new Type( 1, 'Restaurants'),
          new Type( 2, 'Bars' ),
          new Type( 3, 'Stores' )
      ];
    },
    show:function(){
        this.mPage.html( '<h3>Select Type:</h3>'+this.mTypes.get() );
    }
};

function Types(){
    this.mTypes = [];
    this.mLength = 0;

    this.add = function( Type ){
        this.mTypes[ this.mLength ] = Type;
        this.mLength++;
    };

    this.get = function(){
        var values = '';

        for( var i in this.mTypes ){
            values += this.mTypes[ i].get();
        }

        return values;
    }
}

function Type(id, name ){
    this.mID = id;
    this.mName = name;

    this.get = function(){
        return '<p><a href="#" class="types" data-id="'+this.mID+'" data-type="Type" data-transition="slide">'+this.mName+'</a></p>';
    }
}

function Areas(){
    this.mAreas = [];
    this.mLength = 0;

    this.add = function( Area ){
        this.mAreas[ this.mLength ] = Area;
        this.mLength++;
    };
    this.get = function(){
        var values = '';

        for( var i in this.mAreas ) {
            values += this.mAreas[i].get();
        }

        return values;
    };
}

function Area( id, title, options ){
    this.mID = id;
    this.mTitle = title;
    this.mOptions = options;

    this.get = function(){
        return '<li><a href="#" class="areas" data-id="'+this.mID+'" data-type="Neighborhood">'+this.mTitle+'</a></li>';
    }
}

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

function Place( name,  image ){
	this.name = name;
	this.image = image;
	this.get = function(){
		return '<h3>'+this.name+'</h3><img src="'+this.image+'">';
	};
}

$( function(){
    areas.init();
    menuController.init();
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
<div role="page" data-theme="a" data-form="ui-page-theme-a" class="ui-page-theme-a" id="pageone">
    <div data-role="header">
        <h1>My Places</h1>
        <a data-form="ui-icon" title=" Navigation " class="ui-btn-right ui-btn-corner-all ui-btn ui-icon-grid ui-btn-icon-notext ui-shadow" data-role="button" role="button" href="#menu"> Navigation </a>
    </div>
    <div data-role="panel" id="menu">
        <ul data-role="listview">
            <li><a href="#" data-rel="close" data-type="cities">Cities</a></li>
            <li><a href="#" data-rel="close" data-type="neighborhoods">Neighborhoods</a></li>
            <li><a href="#" data-rel="close" data-type="boroughs">Boroughs</a></li>
        </ul>
    </div>
    <div class="ui-body ui-body-a ui-content" data-form="ui-body-a" data-theme="a"  id="places" data-role="main">

    </div>
  <div data-role="footer"  data-theme="a" data-form="ui-page-theme-a" class="ui-content ui-page-theme-a">
    <h1>&copy; 2016 My Places</h1>
  </div>
</div>
</body>
</html>
