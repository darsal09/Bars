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
    <ul data-inset="true" data-role="listview" class="ui-listview ui-listview-inset ui-corner-all ui-shadow">
        <li data-form="ui-bar-a" data-swatch="a" data-theme="a" data-role="list-divider" role="heading" class="ui-li-divider ui-bar-a ui-first-child">List Header</li>
        <li data-theme="a" data-swatch="a" data-form="ui-body-a" class="ui-li-static ui-body-a">Read-only list item</li>
        <li class="ui-last-child"><a href="#" data-theme="a" data-swatch="a" data-form="ui-btn-up-a" class="ui-btn-a ui-btn ui-btn-icon-right ui-icon-carat-r">Linked list item</a></li>
    </ul>

    <div data-role="fieldcontain" class="ui-field-contain">
        <fieldset data-role="controlgroup" class="ui-controlgroup ui-controlgroup-vertical ui-corner-all"><div class="ui-controlgroup-controls ">
                <div class="ui-radio"><label data-form="ui-btn-up-a" for="radio-choice-1-a" class="ui-btn ui-corner-all ui-btn-a ui-btn-icon-left ui-radio-on ui-first-child">Radio</label><input type="radio" checked="checked" value="choice-1" id="radio-choice-1-a" name="radio-choice-a" data-theme="a"></div>


                <div class="ui-checkbox"><label data-form="ui-btn-up-a" for="checkbox-a" class="ui-btn ui-corner-all ui-btn-a ui-btn-icon-left ui-checkbox-on ui-last-child">Checkbox</label><input type="checkbox" checked="checked" id="checkbox-a" name="checkbox-a" data-theme="a"></div>


            </div></fieldset>
    </div>

    <div data-role="fieldcontain" class="ui-field-contain">
        <fieldset data-type="horizontal" data-role="controlgroup" class="ui-controlgroup ui-controlgroup-horizontal ui-corner-all"><div class="ui-controlgroup-controls ">
                <div class="ui-radio"><label data-form="ui-btn-up-a" for="radio-view-a-a" class="ui-btn ui-corner-all ui-btn-a ui-radio-on ui-btn-active ui-first-child">On</label><input type="radio" checked="checked" value="list" id="radio-view-a-a" name="radio-view-a" data-theme="a"></div>

                <div class="ui-radio"><label data-form="ui-btn-up-a" for="radio-view-b-a" class="ui-btn ui-corner-all ui-btn-a ui-radio-off ui-last-child">Off</label><input type="radio" value="grid" id="radio-view-b-a" name="radio-view-a" data-theme="a"></div>

            </div></fieldset>
    </div>

    <div data-role="fieldcontain" class="ui-field-contain">
        <div class="ui-select"><a href="#" role="button" id="select-choice-a-button" aria-haspopup="true" class="ui-btn ui-icon-carat-d ui-btn-icon-right ui-btn-a ui-corner-all ui-shadow" data-theme="a" data-form="ui-btn-up-a"><span>Option 1</span></a><select data-form="ui-btn-up-a" data-theme="a" data-native-menu="false" id="select-choice-a" name="select-choice" tabindex="-1">
                <option value="standard">Option 1</option>
                <option value="rush">Option 2</option>
                <option value="express">Option 3</option>
                <option value="overnight">Option 4</option>
            </select><div style="display: none;" id="select-choice-a-listbox-placeholder"></div></div>
    </div>

    <div class="ui-input-text ui-body-a ui-corner-all ui-shadow-inset"><input type="text" data-form="ui-body-a" class="input" value="Text Input" data-theme="a"></div>

    <div data-role="fieldcontain" class="ui-field-contain">
        <div class="ui-slider"><input type="number" data-type="range" data-highlight="true" data-theme="a" data-form="ui-body-a" max="100" min="0" value="50" name="slider" class="ui-shadow-inset ui-body-a ui-corner-all ui-slider-input"><div role="application" class="ui-slider-track ui-shadow-inset ui-bar-a ui-corner-all ui-btn-up-a" data-form="ui-btn-up-a" data-theme="a"><div class="ui-slider-bg ui-btn-active" style="width: 50%;"></div><a href="#" class="ui-slider-handle ui-btn ui-btn-a ui-shadow" role="slider" aria-valuemin="0" aria-valuemax="100" aria-valuenow="50" aria-valuetext="50" title="50" aria-labelledby="undefined-label" style="left: 50%;" data-form="ui-btn-up-a" data-theme="a"></a></div></div>
    </div>

    <button data-form="ui-btn-up-a" data-theme="a" data-icon="star" class=" ui-btn ui-btn-a ui-icon-star ui-btn-icon-left ui-shadow ui-corner-all">Button</button>
</div>

  <div data-role="footer"  data-theme="a" data-form="ui-page-theme-a" class="ui-content ui-page-theme-a">
    <h1>&copy; 2016 My Places</h1>
  </div>
</div> 

</body>
</html>
