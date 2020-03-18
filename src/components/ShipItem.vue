<template>
  <div class="shipItem">
  <h5>{{msg8}}</h5>
    <!-- <h5>{{ allShips }}</h5>' --> 
    
    <h3>{{ locbyMMSI }}</h3>
     <!-- <AllShips   /> -->
    <!-- <li v-for= "item in allShips" v-bind:key = "item.id"> {{ item.vesselName }}, {{item.mmsi }}</li> -->
    
  </div>
</template>

<script>
import axios from 'axios';
// import pako from 'pako'; // for Inflate and Deflate convert JSON to
// import allShips from './components/AllShips.vue' //import to import hole mmsi

export default {
  name: 'ShipItem',
  props: {
    msg8: String,
    
  },
  data: function() {
      return {
   
  locbyMMSI: null,
  //  ships: null
    
    
    
      }
      },
      created(){ //mikä se on?
        this.setup="..almost there"
          // axios.get('https://meri.digitraffic.fi/api/v1/port-calls')
          // axios.get('https://meri.digitraffic.fi/api/v1/locations/latitude/23.033/longitude/63.8625/radius/10/from/2016-10-31T06%3A30%3A00.000Z')
          // axios.get('https://meri.digitraffic.fi/api/v1/locations/latitude/23.033/longitude/63.8625/radius/30')
          axios.get('https://meri.digitraffic.fi/api/v1/locations/latest/356364000') //MMSI{356364000}
          // axios.get('https://meri.digitraffic.fi/api/v1/port-calls/FIKOK?date=2020-03-09')  //FIKOK by date
.then(response => {
this.locbyMMSI = response.data.features[0].geometry.coordinates //[ 23.02774, 63.864088 ]

})
//  this.ships = allShips.get('allShips')
}



      }
  

</script>
<style >
div.ShipItem{
    border: 3px solid green;
    padding: 20px;
    /* display: inline-block; */
}

</style>
