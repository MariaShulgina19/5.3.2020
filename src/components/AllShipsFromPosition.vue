<template>
  <div class="allshipsFromPosition">

     <div class="label">
        <h5>Vessels in 30 km distance</h5>
        <button class="Buttion1" v-on:click ="Showcontent">Show/Hide Content</button>
     </div>

    <div class="content" v-show="isOpen">
         <!-- <li v-for= "item in allShipsList" v-bind:key = "item.id">{{ item.vesselName }} ,   {{ item.mmsi }} </li> -->
         Testtable
         <li v-for= "item in testtable" v-bind:key = "item.id">{{item}}  </li>
         Testtable2
          <li v-for= "item in testtable2" v-bind:key = "item.id">{{item}}  </li>
          Test merge
          <li v-for= "item in combinedtable" v-bind:key = "item.id">{{item}}  </li>
  </div>

  </div>
</template>

<script>
import axios from 'axios';
// import { stateMerge } from "vue-object-merge"



export default {
  name: 'AllShips',
  props: {
    msg6: String,
    
    
  },
  data: function() {
      return {
      allShips: null,
      allShipsMmsi: null, // added to try to do new list with coordinates /MMSI list
      mmsifromVessel:null, //this mmsi piked from another course
      allShipsCoordinates: null,
      adress: null,
      allShipsList: [], 
      vesselName: null,
      exportlist:[],
      isOpen: false,

       nextID: 1,
       nextIDcomb:1,


       testtable:null,
       testtable2:null,
       combinedtable:[],

           //     currentDate:new Date().getFullYear()+'-'+(new Date().getMonth()+1)+'-'+new Date().getDate(),
           // yesterdayDate:this.currentDate-1,
       newadress: `https://meri.digitraffic.fi/api/v1/locations/latitude/63.859912/longitude/23.03862/radius/30/from/2020-03-24T00:00Z`,
          // All port calles for today
       newadress2: `https://meri.digitraffic.fi/api/v1/locations/latitude/63.859912/longitude/23.03862/radius/30/from/` + new Date().getFullYear()+'-'+(new Date().getMonth()+1)+'-'+new Date().getDate()+'T'+new Date().getHours()+':'+new Date().getMinutes()+'Z',
            // Vessel location by mmsi
       newadress3:`https://meri.digitraffic.fi/api/v1/metadata/vessels/`,
      //  newadress4:`https://meri.digitraffic.fi/api/v1/metadata/vessels/`+allShipsMmsi //24.03 try
           //    newadress2: `https://meri.digitraffic.fi/api/v1/locations/latest/` //+ 356364000, 10.03
   
   
      } //return end
     }, //data end

    methods:{
            Showcontent: function(){
        
            this.isOpen = !this.isOpen; //this.isOpen if just open this
          
            
               },
    },
//  computed: {
//         full_name: function(){
//             return this.first_name + this.last_name; //Вася Пупкин   
//         }
//     }, 

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
                    this.exportlist.push({coordinate:this.allShipsCoordinates, mmsi:this.allShipsMmsi} )
                    const dataNearbyPort = JSON.stringify(this.exportlist)
                    window.localStorage.setItem('allShipsList', dataNearbyPort);

                    this.adress=this.newadress3+this.allShipsMmsi
                    // console.log(' this adress '+ this.adress);

                          axios.get(this.adress)  //
                              
                    .then(response => {
                          this.vesselName = response.data.name
                          this.mmsifromVessel = response.data.mmsi
                          // console.log(' this.vesselNameHERE '+ this.vesselName)
                          // console.log(' this.allShipsMmsiHERE '+ this.allShipsMmsi) //sama??
                          //  console.log(' this.mmsifromVesselHERE '+ this.mmsifromVessel) //different
                          
                          this.allShipsList.push({id: this.nextID, vesselName:this.vesselName, mmsi:this.mmsifromVessel}) //undefined
                          // console.log(' this.allShipsListHERE '+ this.allShipsList)

                           //pushing data to local storage
                          // this.exportlist.push({coordinate:this.allShipsCoordinates, mmsi:this.allShipsMmsi} )
                             const dataNearbyPort2 = JSON.stringify(this.allShipsList)
                              window.localStorage.setItem('allShipsList2', dataNearbyPort2);
                        

                          this.nextID++;


                    }) .catch (function(error){
                      console.log(error);
                    
                    });
                  console.log(' this.vesselName2 '+ this.vesselName) //null??


                }
          }).catch (function(error){
            console.log(error);
          });// catch end

          //try to combine two lists from local storage that in includes evth
console.log(' AAAA this.vesselName3 '+ this.vesselName) //null??
 // taking coordinates2 from local storage




 //24.3.2020
     this.testtable=JSON.parse(window.localStorage.getItem('allShipsList'))
    // console.log('testtable from local storage ' + this.testtable[0].coordinate)

     this.testtable2=JSON.parse(window.localStorage.getItem('allShipsList2'))
    console.log('testtable from local storage2 ' + this.testtable2[0].vesselName)
    console.log('testtable from local storage2 ' + this.testtable2[0].mmsi)

    console.log('testtable from local storage ' + this.testtable[0].coordinate)

    // this.combinedtable = stateMerge(this.testtable, this.testtable2)
    // console.log('TEST MERGE' + this.combinedtable)




    //  for (var i=0; i<this.testtable.length; i++) {
    // // //   console.log('testtable from local storage' + this.testtable)
    // // //     for (var k=0; k<this.testtable2.length; k++) {


    // //       // if (this.testtable[i].mmsi=this.testtable2[i].mmsi)
    // this.combinedtable.push(1)
    // const tablelengh = this.testtable.length
    for (var i=0; i<this.testtable.length; i++) {
    this.combinedtable.push({id_: this.nextIDcomb, vesselName:this.testtable2[i].vesselName, mmsi:this.testtable2[i].mmsi, coordinate:this.testtable[i].coordinate})
    this.nextIDcomb++;
          }

    //pushing combined data to local storage
                    // this.exportlist.push({coordinate:this.allShipsCoordinates, mmsi:this.allShipsMmsi} )
                    // const dataNearbyPort = JSON.stringify(this.exportlist)
          //  window.localStorage.setItem('combinedtable', JSON.stringify(this.combinedtable));
         


    // }
    


    // this.combinedtable.push({id: this.nextID, vesselName:this.vesselName, mmsi:this.mmsifromVessel, coordinate:})
    // this.allShipsList.push({id: this.nextID, vesselName:this.vesselName, mmsi:this.mmsifromVessel})
},// created end



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
