<template>
  <div class="allshipsFromPosition">

     <div class="label">
        <h5>Vessels in 30 km distance</h5>
        <button class="Buttion1" v-on:click ="Showcontent">Show/Hide Content</button>
     </div>

    <div class="content" v-show="isOpen">
         <li v-for= "item in allShipsList" v-bind:key = "item.id">{{ item.vesselName }} ,   {{ item.mmsi }} </li>
  </div>

  </div>
</template>

<script>
import axios from 'axios';



export default {
  name: 'AllShips',
  props: {
    msg6: String,
    
    
  },
  data: function() {
      return {
      allShips: null,
      allShipsMmsi: null, // added to try to do new list with coordinates /MMSI list
      allShipsCoordinates: null,
      adress: null,
      allShipsList: [], 
      vesselName: null,
      exportlist:[],
      isOpen: false,

       nextID: 1,

           //     currentDate:new Date().getFullYear()+'-'+(new Date().getMonth()+1)+'-'+new Date().getDate(),
           // yesterdayDate:this.currentDate-1,
       newadress: `https://meri.digitraffic.fi/api/v1/locations/latitude/63.859912/longitude/23.03862/radius/30/from/2020-03-19T00:00Z`,
          // All port calles for today
       newadress2: `https://meri.digitraffic.fi/api/v1/locations/latitude/63.859912/longitude/23.03862/radius/30/from/` + new Date().getFullYear()+'-'+(new Date().getMonth()+1)+'-'+new Date().getDate()+'T'+new Date().getHours()+':'+new Date().getMinutes()+'Z',
            // Vessel location by mmsi
        newadress3:`https://meri.digitraffic.fi/api/v1/metadata/vessels/`
           //    newadress2: `https://meri.digitraffic.fi/api/v1/locations/latest/` //+ 356364000, 10.03
   
   
      } //return end
     }, //data end

    methods:{
            Showcontent: function(){
        
            this.isOpen = !this.isOpen; //this.isOpen if just open this
          
            
               },
    },


    created(){ //mikä se on?
           this.adress=this.newadress2

           axios.get(this.newadress)  //FIKOK by date
                    // DATE has to change!
                    //how to do list from it?
                
          .then(response => {

                this.allShips = response.data.features


                for (var i=0; i<this.allShips.length; i++) {


                    this.allShipsMmsi = response.data.features[i].mmsi //[ 23.02774, 63.864088 ]
                    this.allShipsCoordinates= response.data.features[i].geometry.coordinates

                    //pushing data to local storage
                    this.exportlist.push(this.allShipsCoordinates)
                    const dataNearbyPort = JSON.stringify(this.exportlist)
                        window.localStorage.setItem('allShipsList', dataNearbyPort);

                    this.adress=this.newadress3+this.allShipsMmsi

                          axios.get(this.adress)  //
                              
                    .then(response => {
                          this.vesselName = response.data.name
                          
                          this.allShipsList.push({id: this.nextID, vesselName:this.vesselName, mmsi:this.allShipsMmsi})

                          this.nextID++;


                    }) .catch (function(error){
                      console.log(error);
                    });

                }
          }).catch (function(error){
            console.log(error);
          });// catch end

}// created end

   } //export default end

</script>
<style >
div.allshipsFromPosition{
    border: 3px solid orange;
    padding: 20px;
    margin: 20px;
    width: 900px;
    text-align: left;
    display: inline-block;
}
.Buttion1{

border: 1px solid orange;


}

</style>
