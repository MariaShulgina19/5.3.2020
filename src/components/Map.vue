<template>
  <div id="Map" class="Map">
    <!-- <h5>{{ msg7 }}</h5> -->
    <!-- <div class="Map" ></div> -->
     <!--<div id="Map" class="Map"></div>  -->
     <!-- markers
    <h3>{{markers}}</h3>  
        -->

   <!-- <h5>{{ testing }}</h5> -->
   <!-- <h5>{{ myMap }}</h5> --> 
   <!-- <AllShips msg6="ALL DATA" /> //printing hole stuff -->

  </div>
</template>

<script>
// import axios from 'axios';
// import * as ol from 'ol';
// import 'ol/ol.css';
import Map from 'ol/Map';
import View from 'ol/View';
import TileLayer from 'ol/layer/Tile';
import OSM from 'ol/source/OSM';
import * as proj from 'ol/proj'; 
// import {fromLonLat} from 'ol/proj';

import VectorLayer from 'ol/layer/Vector';
import VectorSource from 'ol/source/Vector';
import Feature from 'ol/Feature';
import Point from 'ol/geom/Point';
import Style from 'ol/style/Style';
import Icon from 'ol/style/Icon';
// import newlist from './components/AllShips.vue'
// import {defaults as defaultControls, ZoomToExtent} from 'ol/control';

 import newlist from './AllShips.vue'
  // import pako from 'pako';

export default {
  name: 'Map',
  // components: { //?
  //   AllShips},
  props: {
    msg7: String,
    
    
  },
  data() {
    return {
      // testing: 'SomeTests',
      myMap: null,
      myVectorLayer:null,
      // ccor: null,
      myCoordinates:[  //change this one to newlist

        [22.825317, 64.04662],
        [23.03862, 63.859912],
        [23.034148, 63.860683],
        [23.034148, 63.868],
        [23.036452, 63.861915],
         [ 19.915923, 59.622662 ], 
        [ 22.589988, 57.857078 ], 
        [ 19.135317, 60.16767 ], 
        [ 22.173235, 64.973288 ], 
        [ 19.396698, 60.792863 ], 
        [ 23.902812, 59.732588 ]
      ],
      markers: null, //can be delited after
      myFeature: [],
      myFeatureItem: null

      // MyNewStyle:null
      
    }
  },
  
  mounted() {
    console.log('HELLO'+''+ newlist)

    this.markers=JSON.parse(window.localStorage.getItem('newlist'))
    console.log('markers from local storage' + this.markers)
    // const data = JSON.stringify(this.newlist)
        // window.localStorage.setItem('newlist', data);
        // console.log(JSON.parse(window.localStorage.getItem('newlist')))
    //  let newlist2=JSON.parse(pako.inflate(newlist, {to:'string'}))
     
    
    //  console.log('HELLO2'+ JSON.parse(pako.inflate(newlist, {to:'string'})))
    //  console.log('HELLO2'+ newlist2)
    //   console.log(newlist)
    
    this.$nextTick(function () {
      
      // function initMap(){
  this.myMap = new Map({
     target: 'Map',
  //    controls: defaultControls().extend([
  //     new ZoomToExtent({
  //     extent: [
  //       23.03, 63.85,
  //       23.03, 63.8545
  //     ]
  //   })
  // ]),
      layers: [
      new TileLayer({
      source: new OSM(),
      url: "map.osm",
 })
            ],
             //  The view allows to specify the center, resolution, and rotation of the map.
    view: new View({
      center: proj.fromLonLat([23.03862, 63.859912]),
      zoom: 13
    })
});   

     
//  for (var i=0; i<this.myCoordinates.length; i++) {   
   for (var i=0; i<this.markers.length; i++) { 
this.myFeatureItem = new Feature({  // new marker
        // geometry: new Point(proj.fromLonLat(this.myCoordinates[i]) reads information from  readymade array
        geometry: new Point(proj.fromLonLat(this.markers[i]) //shall read from local storage..
        ),
         }),
         this.myFeature.push(this.myFeatureItem);
        //  console.log(this.myFeatureItem);
        //  console.log(this.myFeature);

 }   

this.mySource= new VectorSource({
  features: this.myFeature,
      style: new Style({
           image: new Icon(({
            // crossOrigin: 'anonymous',
            src: 'icons8-cargo-ship-50.png'
        }))
          })
          });
 this.myVectorLayer = new VectorLayer({
  source: this.mySource,
});
//     this.mySource.addFeatures(this.newFeature);

this.myMap.addLayer(this.myVectorLayer); 
  
})
}
}


</script>
<style >
.Map {
    border: 3px solid green; 
    padding: 20px;
    margin: 20px;
    height: 600px;
    width: 900px;
    text-align: left;
    
    /* display: inline-block; */
}

/* move controls to the side ?*/
 .ol-controls {
     left: unset;
     right: -20px;
  }

</style>
