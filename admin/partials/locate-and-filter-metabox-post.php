<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php wp_nonce_field ('I961JpJQTj0crLKH0mGB', 'locate_anything_class_nonce' );

if ( isset($post_type) && $post_type == "user" ) {
	$post_params=Locate_And_Filter_Admin::getUserMetas($object->ID);
} else {
	$post_params=Locate_And_Filter_Admin::getPostMetas($object->ID);
}

if ( !isset($post_type)) { $post_type = ''; }
if ( !isset($post_params['locate-anything-street'])) { $post_params['locate-anything-street'] = ''; }
if ( !isset($post_params['locate-anything-streetnumber'])) { $post_params['locate-anything-streetnumber'] = ''; }
if ( !isset($post_params['locate-anything-city'])) { $post_params['locate-anything-city'] = ''; }
if ( !isset($post_params['locate-anything-zip'])) { $post_params['locate-anything-zip'] = ''; }
if ( !isset($post_params['locate-anything-state'])) { $post_params['locate-anything-state'] = ''; }
if ( !isset($post_params['locate-anything-country'])) { $post_params['locate-anything-country'] = ''; }

if ( !isset($post_params['locate-anything-lat'])) { $post_params['locate-anything-lat'] = ''; }
if ( !isset($post_params['locate-anything-lon'])) { $post_params['locate-anything-lon'] = ''; }

if ( !isset($post_params['locate-anything-nice-tooltips-img-height'])) { $post_params['locate-anything-nice-tooltips-img-height'] = ''; }
if ( !isset($post_params['locate-anything-marker-html-template'])) { $post_params['locate-anything-marker-html-template'] = ''; }

if ( !isset($post_params['locate-anything-marker-type'])) { $post_params['locate-anything-marker-type'] = false; }
if ( !isset($post_params['locate-anything-custom-marker'])) { $post_params['locate-anything-custom-marker'] = ''; }

if ( !isset($post_params['locate-anything-default-marker-media'])) { $post_params['locate-anything-default-marker-media'] = ''; }
if ( !isset($post_params['locate-anything-marker-symbol-color'])) { $post_params['locate-anything-marker-symbol-color'] = ''; }
if ( !isset($post_params['locate-anything-marker-color'])) { $post_params['locate-anything-marker-color'] = ''; }

?>

<div id="locate-anything-wrapper-post">

	<h2 class="nav-tab-wrapper">
	    <a  data-pane="1" class="active nav-tab"><?php esc_html_e("Geo settings","locateandfilter")?></a>
	    <a  class="nav-tab" data-pane="2"><?php esc_html_e("Marker","locateandfilter")?></a>
	    <a  class="nav-tab" data-pane="4"><?php esc_html_e("Tooltip","locateandfilter")?></a>
	    <a  class="nav-tab" data-pane="3"><?php esc_html_e("Additional Fields","locateandfilter")?></a>
	</h2>

	<div id="locate-anything-map-settings-page-1" class="locate-anything-map-option-pane locate-anything-map-settings-list-ul" style="width:auto" >
		<table>
			<tr><td><h2><?php esc_html_e("Geo settings","locateandfilter")?></h2></td></tr> 

			<tr>
				<td><?php esc_html_e("Street name","locateandfilter")?></td>
				<td><input type="text"	name="locate-anything-street" value="<?php echo esc_attr($post_params['locate-anything-street']); ?>"></td>			
			</tr>
			<tr>
				<td><?php esc_html_e("Number","locateandfilter")?></td>
				<td><input type="text" name="locate-anything-streetnumber" value="<?php echo esc_attr($post_params['locate-anything-streetnumber']); ?>"></td>
			</tr>
			<tr>
				<td><?php esc_html_e("City","locateandfilter")?></td>
				<td><input type="text" name="locate-anything-city" value="<?php echo esc_attr($post_params['locate-anything-city']); ?>"></td>
			</tr>
			<tr>
				<td><?php esc_html_e("Zip code","locateandfilter")?></td>
				<td><input type="text" name="locate-anything-zip" value="<?php echo esc_attr($post_params['locate-anything-zip']); ?>"></td>
			</tr>
			<tr>
				<td><?php esc_html_e("State / Province","locateandfilter")?></td>
				<td><input type="text" name="locate-anything-state" value="<?php echo esc_attr($post_params['locate-anything-state']); ?>"></td>
			</tr>
			<tr>
				<td><?php esc_html_e("Country","locateandfilter")?></td>
				<td><input type="text" name="locate-anything-country" value="<?php echo esc_attr($post_params['locate-anything-country']); ?>"></td>
			</tr>
		</table>
		<br>
				
		<?php $googlemaps_key = unserialize (get_option("locate-anything-option-googlemaps-key")); ?>
		<?php if ( $googlemaps_key ) { ?>
			<input class="button-admin" type="button" onclick="GetLocation()" value="Geolocate this address - Google" />
		<?php } ?>
		<input class="button-admin" type="button" onclick="addr_search()" value="Geolocate this address - nominatim" />
		<div id="results"></div>
		<br><br>

		<?php esc_html_e("Latitude","locateandfilter")?> <input type="text" name="locate-anything-lat" value="<?php echo esc_attr($post_params['locate-anything-lat']); ?>">
		<?php esc_html_e("Longitude","locateandfilter")?> <input type="text" name="locate-anything-lon" value="<?php echo esc_attr($post_params['locate-anything-lon']); ?>">

		<input class="append-markers button-admin" type="button" value="View Latitude,Longitude on map">

		<!-- add a marker using the map -->
		<div id="map-marker" data-mode="" style="height:300px;margin: 15px 0;">
		    <input type="hidden" data-map-markers="" value="" name="map-geojson-data" />
		</div>
		<div>
		    <input class="get-markers button-admin" type="button" value="Get the Marker" />
		</div>
		<!-- end -->

	</div> <!-- /locate-anything-map-settings-page-1 -->
							
			      
  
     <table id="locate-anything-map-settings-page-4" class="locate-anything-map-option-pane locate-anything-map-settings-list-ul" style='width:auto;display:none'>
        <tr><td><h2><?php esc_html_e("Customize Tooltip template","locateandfilter")?></h2></td></tr>  
        <tr>
           <td><b><?php esc_html_e("Tooltip Preset","locateandfilter")?> </b>:</td>
           <td>

				<select name="locate-anything-tooltip-preset" id="locate-anything-tooltip-preset">
				    <?php 
				        $u = Locate_And_Filter_Admin::getDefaultTemplates();
				        /* tooltip presets */
				        $tooltip_presets = array(
				            (object)array("class" => 'default', "name" => __('Default', "locateandfilter"), "template" => ''),
				            (object)array("class" => '', "name" => __('none', "locateandfilter"), "template" => $u["tooltip"]),
				            (object)array("class" => 'nice-tooltips', "name" => __('Nice Tooltips', "locateandfilter"), "template" => $u["nice-tooltip"])
				        );                       
				        $tooltip_presets = apply_filters("locate_anything_tooltip_presets", $tooltip_presets);
				        $selectedPreset = isset($post_params["locate-anything-tooltip-preset"]) ? $post_params["locate-anything-tooltip-preset"] : 'default';

				        foreach ($tooltip_presets as $preset) {
				            // Check if the preset is selected
				            $say = ($selectedPreset === $preset->class) ? "selected" : '';

				            // Use esc_attr to escape attributes for safety
				            echo '<option ' . esc_attr($say) . ' value="' . esc_attr($preset->class) . '" data-template="' . esc_attr($preset->template) . '">' . esc_html($preset->name) . '</option>';
				        }
				    ?>
				</select>

			</td>
        </tr>
        <tr id="nice-tooltips-settings">
			<td><?php esc_html_e("Nice Tooltips settings","locateandfilter")?> : &nbsp;<input type="button" data-target="nice-tooltips-settings" class="locate-anything-help"></td>
			<td><?php esc_html_e("Main image max-height","locateandfilter")?> : <input type="text" value="<?php echo esc_attr($post_params["locate-anything-nice-tooltips-img-height"]); ?>" name="locate-anything-nice-tooltips-img-height"></td>
		</tr>
        <tr>
           <td id="customtemplate" width="40%">
	           	<div id="locate-anything-marker-html-template">
					<b><?php esc_html_e("Custom HTML template","locateandfilter");?></b>&nbsp;<input type="button" data-target="customtemplate" class="locate-anything-help">
					<div class="LA_custom_template_editor">
					<textarea name="locate-anything-marker-html-template" id="marker-html-template" style="width: 70%; height: 20em"><?php echo esc_attr($post_params['locate-anything-marker-html-template']); ?></textarea>
					</div>
				</div>
			</td>
			<td id="addifields">
				<div class="LA_additional_fields_notice">
					<b><?php esc_html_e("Available fields","locateandfilter")?></b>&nbsp;<input type="button" data-target="addifields" class="locate-anything-help">
					<p><?php esc_html_e("Here is a list of the additional fields available for display in the template. To use them just copy/paste the corresponding tag in the template editor","locateandfilter"); ?></p>
					<?php Locate_And_Filter_Admin::displayAdditionalFieldNotice($post_type); ?>
				</div>
            </td>
        </tr>
    </table> <!-- /locate-anything-map-settings-page-4 -->
  
   
    <table id="locate-anything-map-settings-page-2" class="locate-anything-map-option-pane locate-anything-map-settings-list-ul" style='display:none'>
        <tr>
       		<td><h2><?php esc_html_e("Choose a marker icon","locateandfilter")?></h2></td>
       	</tr>  
        <tr>
            <td width="40%">               	
               	<input type="radio" name="locate-anything-marker-type" value="standard" <?php if ($post_params["locate-anything-marker-type"]=="standard" || $post_params["locate-anything-marker-type"]==false ) echo 'checked' ?>> <b><?php esc_html_e("Choose an icon","locateandfilter")?></b> :  
			</td>
			<td>

				<select style="width: 50% !important" name="locate-anything-custom-marker" id="locate-anything-custom-marker">
				    <option value=""><?php esc_html_e("Use default marker", "locateandfilter"); ?></option>
				    <?php 
				    foreach (Locate_And_Filter_Assets::getMarkers() as $marker) { 
				        $selected = (isset($post_params["locate-anything-custom-marker"]) && esc_attr($post_params["locate-anything-custom-marker"]) == $marker->id) ? "selected" : '';
				        ?>
				        <option value="<?php echo esc_attr($marker->id); ?>" <?php echo  esc_attr($selected); ?>>
				            <?php echo esc_attr($marker->url); ?>
				        </option> 
				    <?php } ?>  
				</select>

			</td>
	    </tr>

		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>

		<!-- medialibrary -->
		<tr>
			<td colspan="2">&nbsp;</td></tr>
		<tr>
			<td><a href='https://locateandfilter.com/locateandfilter-pro-version/' class='proversion2' target='_blank'>available only for PRO version</a></td>
		</tr>
		<tr>
			<td id="medialibrary" class="only_pro">
				<input type="radio" <?php if ($post_params["locate-anything-marker-type"] == "medialibrary") echo 'checked' ?> name="locate-anything-marker-type" value="medialibrary"> 
				<b><?php esc_html_e("Add an icon from the media library","locateandfilter");?></b>&nbsp;
				<input type="button" data-target="medialibrary" class="locate-anything-help">
			</td>
			<td>
				<img id="default-marker-media">
				<div class="uploader">
					<input id="locate-anything-marker-type" name="locate-anything-default-marker-media" type="hidden" value="<?php echo esc_attr($post_params["locate-anything-default-marker-media"]); ?>" />
					<input id="locate-anything-marker-type_button" class="button-admin"  name="locate-anything-marker-type_button" type="text" value="<?php esc_html_e("Add","locateandfilter"); ?>" />
				</div>

			</td>
		</tr>

		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td>
				<input type="radio" <?php if ($post_params["locate-anything-marker-type"]=="awesomemarker") echo 'checked'; ?> name="locate-anything-marker-type" value="awesomemarker"> 
				<b><?php esc_html_e("Create an icon","locateandfilter"); ?> </b> 
			</td>
			<td style="padding: 15px;line-height: 35px;">	
				<!-- Awesome marker creator -->
				<?php esc_html_e("Symbol","locateandfilter"); ?> : 
					<select name="locate-anything-marker-symbol" id="locate-anything-marker-symbol">
						<?php 
							$selected_awesome = $post_params["locate-anything-marker-symbol"];
							include plugin_dir_path ( __FILE__ ) . "../../includes/ionicon-options.php";
						?>
					</select>
				<br>
				<?php esc_html_e("Symbol color","locateandfilter")?> : 
					<input type="color" value="<?php echo  esc_attr($post_params["locate-anything-marker-symbol-color"]); ?>" name="locate-anything-marker-symbol-color">
				<br>
				<?php esc_html_e("Marker color","locateandfilter")?> : 
					<select name="locate-anything-marker-color">
					    <?php 
					    $colors = array('red', 'darkred', 'orange', 'green', 'darkgreen', 'blue', 'purple', 'darkpurple', 'cadetblue');
					    
					    foreach( $colors as $color ) { 
					        $selected = (isset($post_params["locate-anything-marker-color"]) && esc_attr($post_params["locate-anything-marker-color"]) == $color) ? 'selected' : '';
					        ?>
					        <option value="<?php echo esc_attr($color); ?>" <?php echo  esc_attr($selected); ?>>
					            <?php echo esc_html($color); ?>
					        </option>
					    <?php } ?>
					</select>
			</td>
		</tr>
	</table> <!-- / locate-anything-map-settings-page-2	 -->

	<table id="locate-anything-map-settings-page-3" class="locate-anything-map-option-pane locate-anything-map-settings-list-ul"  style='display:none' >
		<tr>
			<td><h2><?php esc_html_e("Additional fields","locateandfilter")?></h2></td>
		</tr>  
		<tr>
			<td>
				<div id="locate-anything-additional_fields">			
					<?php Locate_And_Filter_Admin::displayAdditionalFields($object); ?>			  
				</div>   
			</td>
		</tr>    
	</table> <!-- /locate-anything-map-settings-page-3 -->

</div> <!-- / #locate-anything-wrapper-post -->

<script type="text/javascript">
	jQuery(document).ready(function() {
		
		/* help texts */
		<?php include plugin_dir_path(__FILE__)."locate-and-filter-help.php";?>
			
		/* initializes marker selector */ 
		initialize_marker_selector("locate-anything-custom-marker");

		/* initializes the media uploader*/
		initialize_media_uploader();

		jQuery("#locate-anything-tooltip-preset").change(function(e){locate_anything_select_preset(e)});

	});

	function locate_anything_select_preset(e){
	  if (confirm("<?php esc_html_e('Do you want to overwrite the current tooltip template?','locateandfilter'); ?>")) jQuery("#marker-html-template").val( jQuery('#locate-anything-tooltip-preset :selected').attr("data-template") );
	}
</script>   

<!-- add a marker using the map -->
<script>
	jQuery(document).ready(function($){

		// We’ll add a OSM tile layer to our map
		var osmUrl = 'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
		  osmAttrib = '&copy; <a href="http://openstreetmap.org/copyright">OpenStreetMap</a> contributors',
		  osm = L.tileLayer(osmUrl, {
		      maxZoom: 18,
		      attribution: osmAttrib
		  });


		// initialize the map on the "map" div with a given center and zoom
		var map = L.map('map-marker').setView([44.510275, 10.767032], 2).addLayer(osm);
		var markersLayer = new L.LayerGroup(); // NOTE: Layer is created here!
		markersLayer.addTo(map);
		setTimeout(function () {
		   map.invalidateSize(true);
		}, 100);

		//init marker
		if( $("input[name='locate-anything-lat']").val() || $("input[name='locate-anything-lon']").val() ) {
			initMarker();
		}

		$('.append-markers').click(function(event) {
				if( $("input[name='locate-anything-lat']").val() || $("input[name='locate-anything-lon']").val() ) {
					markersLayer.clearLayers();
					initMarker();
				}
		});

		// attaching function on map click
		map.on('click', onMapClick);

		function initMarker() {
					
				  var input_lat = $("input[name='locate-anything-lat']").val();
				  var input_lon = $("input[name='locate-anything-lon']").val();

				  var geojsonFeature = {
			          "type": "Feature",
			              "properties": {},
			              "geometry": {
			                  "type": "Point",
			                  "coordinates": [input_lat, input_lon]
			          }
			      }

			      var marker;

			      L.geoJson(geojsonFeature, {
			          
			          pointToLayer: function(feature, latlng){
			              
			              marker = L.marker([input_lat, input_lon], {
			                  
			                  title: "Resource Location",
			                  alt: "Resource Location",
			                  riseOnHover: true,
			                  draggable: true,

			              }).bindPopup("<input type='button' value='Delete this marker' class='marker-delete-button'/>");

			              marker.on("popupopen", onPopupOpen);
			              markersLayer.addLayer(marker);
			         
			              return marker;
			          }
			      }).addTo(map);

		}

		// Script for adding marker on map click
		function onMapClick(e) {

			var allMarkersObjArray = [];//new Array();
			var allMarkersGeoJsonArray = [];//new Array();

		  	$.each(map._layers, function (ml) {
		          //console.log(map._layers)

		          if (map._layers[ml].feature) {   
		            allMarkersObjArray.push(this);
		            allMarkersGeoJsonArray.push(JSON.stringify(this.toGeoJSON()));
		          }
		    });
		    //console.log(allMarkersGeoJsonArray.length);

			if ( allMarkersGeoJsonArray.length == 0 ) {

			    var geojsonFeature = {
			        "type": "Feature",
					"properties": {},
					"geometry": {
					    "type": "Point",
					    "coordinates": [e.latlng.lat, e.latlng.lng]
					}
			    }

			    var marker;

			      L.geoJson(geojsonFeature, {
			          
			          pointToLayer: function(feature, latlng){
			              
			              marker = L.marker(e.latlng, {
			                  
			                  title: "Resource Location",
			                  alt: "Resource Location",
			                  riseOnHover: true,
			                  draggable: true,

			              }).bindPopup("<input type='button' value='Delete this marker' class='marker-delete-button'/>");

			              marker.on("popupopen", onPopupOpen);
			         
			              return marker;
			          }
			      }).addTo(map);

		    } //end if

		}


		// Function to handle delete as well as other events on marker popup open
		function onPopupOpen() {

			var tempMarker = this;

			//var tempMarkerGeoJSON = this.toGeoJSON();

			//var lID = tempMarker._leaflet_id; // Getting Leaflet ID of this marker

			// To remove marker on click of delete
			$(".marker-delete-button:visible").click(function () {
			  map.removeLayer(tempMarker);
			});
		}


		// getting all the markers at once
		function getAllMarkers() {
		      
			var allMarkersObjArray = [];//new Array();
			var allMarkersGeoJsonArray = [];//new Array();

			$.each(map._layers, function (ml) {
			  //console.log(map._layers)
			  if (map._layers[ml].feature) {
			      
			    allMarkersObjArray.push(this);
			    allMarkersGeoJsonArray.push(JSON.stringify(this.toGeoJSON()));
			  }
			})

			console.log(allMarkersObjArray);
			//alert("total Markers : " + allMarkersGeoJsonArray.length + "\n\n" + allMarkersGeoJsonArray + "\n\n Also see your console for object view of this array" );

			if(allMarkersGeoJsonArray.length>0){
			$(this).parent().parent().find("input[name='locate-anything-lat']").val( allMarkersObjArray[0]['_latlng']['lat'] );
			$(this).parent().parent().find("input[name='locate-anything-lon']").val( allMarkersObjArray[0]['_latlng']['lng'] );
			}

		}

	  $(".get-markers").on("click", getAllMarkers);

	}); 
</script>    